<?php

class Usuarios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuarios_model');
		$this->very_session();
	}

	public function index()
	{
		if ($this->input->get('campo'))
		{
			$campo = $this->input->get('campo');
		}
		else
		{
			$campo = "";
		}
		// Indicamos el numero de filas y links
		$filas = $this->usuarios_model->num_users();
		$per_page = 12;
		// Configuramos la paginacion
		$config['base_url'] = base_url().'usuarios/index';
		$config['total_rows'] = $filas;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data = array(
			'titulo' => 'Usuarios de Sistema',
			'contenido' => 'usuarios/index_view',
			'menu' => 'usuarios',
			'num_users' => $filas,
			'usuarios' => $this->usuarios_model->listar_usuarios($per_page),
			'pagination' => $this->pagination->create_links(),
			'campo' => $campo,
			'preguntas' => $this->preguntas(),
			'tipos' => $this->tipos(),
			);
		$this->load->view('plantilla', $data);
	}

	public function agregar()
	{
		if (!$this->input->is_ajax_request())
		{
			redirect(base_url().'usuarios');
		}
		else
		{
			// Rules
			$this->validar_persona();
			$this->form_validation->set_rules('username', 'Usuario', 'required|min_length[8]|callback_very_user');
			$this->form_validation->set_rules('tipo', 'Tipo', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[8]');
			$this->form_validation->set_rules('conf', 'Confirmar', 'required|matches[password]');
			$this->form_validation->set_rules('preg', 'Pregunta de Seguridad', 'required');
			$this->form_validation->set_rules('respuesta', 'Respuesta secreta', 'required');
			// Messages
			$this->form_validation->set_message('very_user', 'El {field} ya se encuentra en uso');
			if ($this->form_validation->run() == false)
			{
				echo validation_errors('<li>','</li>');
			}
			else
			{
				if ($_FILES['userfile']['name'] != "")
				{
					if (!$this->upload->do_upload())
		            {
		                echo $this->upload->display_errors();
		            }
		            else
		            {
	            		$foto = $this->upload->data('file_name');
	            		$this->personas_model->agregar($foto);
						$this->usuarios_model->agregar();
						echo "guardo";
		            }
				}
				else
				{
					$foto = "no-avatar.jpg";
					$this->personas_model->agregar($foto);
					$this->usuarios_model->agregar();
					echo "guardo";
				}
			}
		}
	}

	public function editar($id, $foto)
	{
		if (!$this->input->is_ajax_request())
		{
			redirect(base_url().'usuarios');
		}
		else
		{
			// Rules
			$this->validar_persona();
			$this->form_validation->set_rules('username', 'Usuario', 'required|min_length[8]|callback_very_user');
			$this->form_validation->set_rules('tipo', 'Tipo', 'required');
			// Messages
			$this->form_validation->set_message('very_user', 'El {field} ya se encuentra en uso');
			if ($this->form_validation->run() == false)
			{
				echo validation_errors('<li>','</li>');
			}
			else
			{
				if ($_FILES['userfile']['name'] != "")
				{
					if (!$this->upload->do_upload())
		            {
		                echo $this->upload->display_errors();
		            }
		            else
		            {
	            		if ($foto != "no-avatar.jpg")
	            		{
	            			$directorio = 'assets/images/personas/'.$foto;
		            		unlink($directorio);
	            		}
	            		$foto = $this->upload->data('file_name');
						$this->personas_model->editar($id, $foto);
						$this->usuarios_model->editar($id);
						echo "guardo";
		            }
				}
				else
				{
					$this->personas_model->editar($id, $foto);
					$this->usuarios_model->editar($id);
					echo "guardo";
				}
			}

		}
	}

	private function preguntas()
	{
		$options = array(
			'' => '-',
			'¿Cuál es su clave más utilizada en redes sociales?' => '¿Cuál es su clave más utilizada en redes sociales?',
			'¿Una Fecha a recordar?' => '¿Una Fecha a recordar?',
			'¿Cuál es su número de calzado?' => '¿Cuál es su número de calzado?',
			'¿Cuál es su secreto jamás contado?' => '¿Cuál es su secreto jamás contado?',
			'¿Cómo se apellidaba su maestro (a)  de 4to Grado?' => '¿Cómo se apellidaba su maestro (a)  de 4to Grado?',
			'¿Cuál es el 4to número de su clave secreta bancaria mas utilizada?' => '¿Cuál es el 4to número de su clave secreta bancaria mas utilizada?',
			);
		return $options;
	}

	private function tipos()
	{
		$options = array(
			'' => '-',
			'Administrador' => 'Administrador',
			'Editor' => 'Editor',
			);
		return $options;
	}

	private function validar_persona()
	{
		//Rules
		$this->form_validation->set_rules('nombre', 'Nombre Completo', 'required');
		$this->form_validation->set_rules('documento', 'Documento de Identidad', 'required|integer|callback_very_cedula|trim');
		$this->form_validation->set_rules('sexo', 'Sexo', 'required');
		$this->form_validation->set_rules('email', 'Correo Electrónico', 'required|valid_email|callback_very_email|trim');
		$this->form_validation->set_rules('tlf', 'Teléfono', 'is_natural_no_zero');
		//Messages
		$this->form_validation->set_message('very_cedula', 'La {field} ya se encuentra registrada en otra persona');
		$this->form_validation->set_message('very_email', 'El {field} ya fue registrado en una cuenta de usuario');
	}

	function very_user($username)
	{
		$very = $this->usuarios_model->verificar('username', $username);
		if ($very == false)
		{
			return true;
		}
		else
		{
			if ($this->input->post('id'))
			{
				if ($this->input->post('id') == $very->id)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	}

	function very_email($email)
	{
		$very = $this->personas_model->verificar('email', $email);
		if ($very == false)
		{
			return true;
		}
		else
		{
			if ($this->input->post('id'))
			{
				if ($this->input->post('id') == $very->id)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	}

	function very_cedula($documento)
	{
		$very = $this->personas_model->verificar('documento', $documento);
		if ($very == false)
		{
			return true;
		}
		else
		{
			if ($this->input->post('id'))
			{
				if ($this->input->post('id') == $very->id)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	}

	function eliminar($id)
	{
		$detalles = $this->usuarios_model->detalles($id);
		if ($detalles = false)
		{
			redirect('404');
		}
		else
		{
			$this->personas_model->eliminar($id);
			redirect(base_url().'usuarios');
		}
	}

	private function very_session()
	{
		if ($this->session->userdata('username') == '')
		{
			redirect(base_url());
		}
	}
}

?>
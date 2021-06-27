<?php

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('usuarios_model');
		$this->very_session();
	}

	public function index()
	{
		$data = array(
			'contenido' => 'admin/menu_view',
			'no_sidebar' => true,
			'preguntas' => $this->preguntas(),
			);
		$this->load->view('plantilla', $data);
	}

	public function editar()
	{
		if (!$this->input->is_ajax_request())
		{
			redirect(base_url().'admin');
		}
		else
		{
			// Rules
			$this->form_validation->set_rules('username', 'Usuario', 'required|min_length[8]|callback_very_user');
			$this->form_validation->set_rules('preg', 'Pregunta de Seguridad', 'required');
			$this->form_validation->set_rules('respuesta', 'Respuesta secreta', 'required');
			$this->form_validation->set_message('very_user', 'El {field} ya se encuentra en uso');
			if ($this->form_validation->run() == false)
			{
				echo validation_errors('<li>','</li>');
			}
			else
			{
				$id = $this->session->userdata('id');
				$foto = $this->session->userdata('foto');
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
						$this->admin_model->editar($id);
						$data = array(
							'nombre' => $this->input->post('nombre', true),
							'documento' => $this->input->post('documento', true),
							'sexo' => $this->input->post('sexo', true),
							'email' => $this->input->post('email', true),
							'tlf' => $this->input->post('tlf', true),
							'foto' => $foto,
							'username' => $this->input->post('username', true),
							'preg' => $this->input->post('preg', true),
							'resp' => $this->input->post('respuesta', true),
							);
						$this->session->set_userdata($data);
						echo "guardo";
		            }
				}
				else
				{
					$this->personas_model->editar($id, $foto);
					$this->admin_model->editar($id);
					$data = array(
						'nombre' => $this->input->post('nombre', true),
						'documento' => $this->input->post('documento', true),
						'sexo' => $this->input->post('sexo', true),
						'email' => $this->input->post('email', true),
						'tlf' => $this->input->post('tlf', true),
						'foto' => $foto,
						'username' => $this->input->post('username', true),
						'preg' => $this->input->post('preg', true),
						'resp' => $this->input->post('respuesta', true),
						);
					$this->session->set_userdata($data);
					echo "guardo";
				}
			}
		}
	}

	public function cambio_clave()
	{
		if (!$this->input->is_ajax_request())
		{
			redirect(base_url().'admin');
		}
		else
		{
			// Rules
			$this->form_validation->set_rules('actual', 'Contraseña actual', 'required|callback_very_clave');
			$this->form_validation->set_rules('nueva', 'Nueva Contraseña', 'required|min_length[8]|differs[actual]');
			$this->form_validation->set_rules('conf', 'Confirmar Contraseña', 'required|matches[nueva]');
			// Messages
			$this->form_validation->set_message('very_clave', '{field} no es correcto');
			if ($this->form_validation->run() == false)
			{
				echo validation_errors('<li>', '</li>');
			}
			else
			{
				$this->admin_model->cambiar_clave();
				$this->session->set_userdata('password', $this->input->post('conf'));
				echo "bien";
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

	private function validar_persona()
	{
		//Rules
		$this->form_validation->set_rules('nombre', 'Nombre Completo', 'required');
		$this->form_validation->set_rules('documento', 'Documento de Identidad', 'required|integer|callback_very_cedula|trim');
		$this->form_validation->set_rules('sexo', 'Sexo', 'required');
		$this->form_validation->set_rules('email', 'Correo Electrónico', 'required|valid_email|callback_very_email|trim');
		$this->form_validation->set_rules('tlf', 'Teléfono', 'is_natural_no_zero');
		//Messages
		$this->form_validation->set_message('very_cedula', 'La {field} ya se encuentra registrada en otro usuario');
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
			if ($this->session->userdata('id') == $very->id)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	function very_email($email)
	{
		$very = $this->usuarios_model->verificar('email', $email);
		if ($very == false)
		{
			return true;
		}
		else
		{
			if ($this->session->userdata('id') == $very->id)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	function very_cedula($documento)
	{
		$very = $this->usuarios_model->verificar('documento', $documento);
		if ($very == false)
		{
			return true;
		}
		else
		{
			if ($this->session->userdata('id') == $very->id)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	function very_clave($password)
	{
		if ($password == $this->session->userdata('password'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
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
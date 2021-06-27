<?php

class Pacientes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pacientes_model');
		$this->very_session();
	}

	public function index()
	{
		if ($this->input->get('campo'))
		{
			$campo = $this->input->get('campo');
			$mensaje = 'La busqueda "'.$campo.'" no arrojó resultados.';
		}
		else
		{
			$campo = "";
			$mensaje = 'No hay pacientes registrados en el sistema.';
		}
		// Indicamos el numero de filas y links
		$filas = $this->pacientes_model->num_pacientes();
		$per_page = 12;
		// Configuramos la paginacion
		$config['base_url'] = base_url().'pacientes/index';
		$config['total_rows'] = $filas;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data = array(
			'titulo' => 'Pacientes',
			'contenido' => 'pacientes/index_view',
			'menu' => 'pacientes',
			'num_pacientes' => $filas,
			'pacientes' => $this->pacientes_model->listar_pacientes($per_page),
			'pagination' => $this->pagination->create_links(),
			'campo' => $campo,
			'mensaje' => $mensaje,
			'sangres' => $this->sangres(),
			);
		$this->load->view('plantilla', $data);
	}

	public function agregar()
	{
		if (!$this->input->is_ajax_request())
		{
			redirect('pacientes');
		}
		else
		{
			// Rules
			$this->validar_persona();
			$this->validar();
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
						$this->pacientes_model->agregar();
						echo "guardo";
		            }
				}
				else
				{
					$foto = "no-avatar.jpg";
					$this->personas_model->agregar($foto);
					$this->pacientes_model->agregar();
					echo "guardo";
				}
			}
		}
	}

	public function editar($id, $foto)
	{
		if (!$this->input->is_ajax_request())
		{
			redirect('pacientes');
		}
		else
		{
			// Rules
			$this->validar_persona();
			$this->validar();
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
						$this->pacientes_model->editar($id);
						echo "guardo";
		            }
				}
				else
				{
					$this->personas_model->editar($id, $foto);
					$this->pacientes_model->editar($id);
					echo "guardo";
				}
			}
		}
	}

	private function validar()
	{
		//Rules
		$this->form_validation->set_rules('nacimiento', 'Fecha de Nacimiento', 'required');
		$this->form_validation->set_rules('adn', 'Tipo de Sangre', 'required');
		$this->form_validation->set_rules('peso', 'Peso', 'numeric');
		$this->form_validation->set_rules('altura', 'Altura', 'numeric');
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

	private function sangres()
	{
		$options = array(
			'' => '-',
			'AB+' => 'AB+',
			'AB-' => 'AB-',
			'A+' => 'A+',
			'A-' => 'A-',
			'B+' => 'B+',
			'B-' => 'B-',
			'O+' => 'O+',
			'O-' => 'O-',
			);
		return $options;
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
		$detalles = $this->pacientes_model->detalles($id);
		if ($detalles = false)
		{
			redirect('404');
		}
		else
		{
			$this->personas_model->eliminar($id);
			redirect('pacientes');
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
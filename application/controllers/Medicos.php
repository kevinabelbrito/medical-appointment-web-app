<?php

class Medicos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('medicos_model');
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
			$mensaje = 'No hay médicos registrados en el sistema.';
		}
		// Indicamos el numero de filas y links
		$filas = $this->medicos_model->num_medicos();
		$per_page = 12;
		// Configuramos la paginacion
		$config['base_url'] = base_url().'medicos/index';
		$config['total_rows'] = $filas;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data = array(
			'titulo' => 'Médicos',
			'contenido' => 'medicos/index_view',
			'menu' => 'medicos',
			'num_medicos' => $filas,
			'medicos' => $this->medicos_model->listar_medicos($per_page),
			'pagination' => $this->pagination->create_links(),
			'campo' => $campo,
			'mensaje' => $mensaje,
			'especialidades' => $this->especialidades(),
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
						$this->medicos_model->agregar();
						echo "guardo";
		            }
				}
				else
				{
					$foto = "no-avatar.jpg";
					$this->personas_model->agregar($foto);
					$this->medicos_model->agregar();
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
						$this->medicos_model->editar($id);
						echo "guardo";
		            }
				}
				else
				{
					$this->personas_model->editar($id, $foto);
					$this->medicos_model->editar($id);
					echo "guardo";
				}
			}
		}
	}

	private function validar()
	{
		//Rules
		$this->form_validation->set_rules('especialidad', 'Especialidad', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('ingreso', 'Fecha de Ingreso', 'required');
		$this->form_validation->set_rules('consultorio', 'Consultorio', 'required');
		$this->form_validation->set_rules('precio_consulta', 'Precio de la consulta', 'required|numeric');
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

	private function especialidades()
	{
		$options = array('' => '-',);
		$especialidades = $this->medicos_model->cargar_esp();
		foreach ($especialidades as $esp)
		{
			$options += array($esp->id => $esp->descripcion,);
		}
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
		$detalles = $this->medicos_model->detalles($id);
		if ($detalles = false)
		{
			redirect('404');
		}
		else
		{
			$this->personas_model->eliminar($id);
			redirect('medicos');
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
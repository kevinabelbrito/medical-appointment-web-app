<?php

class Especialidades extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('especialidades_model');
		$this->very_session();
	}

	public function index()
	{
		if ($this->input->get('campo'))
		{
			$campo = $this->input->get('campo');
			$mensaje = 'La busqueda "'.$campo.'" no arrojo resultados';
		}
		else
		{
			$campo = "";
			$mensaje = "No hay especialidades médicas registradas en el sistema";
		}
		// Indicamos el numero de filas y links
		$filas = $this->especialidades_model->num_esp();
		$per_page = 12;
		// Configuramos la paginacion
		$config['base_url'] = base_url().'especialidades/index';
		$config['total_rows'] = $filas;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data = array(
			'titulo' => 'Especialidades Médicas',
			'contenido' => 'especialidades/index_view',
			'menu' => 'especialidades',
			'num_esp' => $filas,
			'especialidades' => $this->especialidades_model->listar_esp($per_page),
			'pagination' => $this->pagination->create_links(),
			'campo' => $campo,
			'mensaje' => $mensaje,
			);
		$this->load->view('plantilla', $data);
	}

	public function agregar()
	{
		if (!$this->input->is_ajax_request())
		{
			redirect('especialidades');
		}
		else
		{
			$this->validar();
			if ($this->form_validation->run() == false)
			{
				echo validation_errors('<li>', '</li>');
			}
			else
			{
				$this->especialidades_model->agregar();
				echo "guardo";
			}
		}
	}

	public function editar($id)
	{
		if (!$this->input->is_ajax_request())
		{
			redirect('especialidades');
		}
		else
		{
			$this->validar();
			if ($this->form_validation->run() == false)
			{
				echo validation_errors('<li>', '</li>');
			}
			else
			{
				$this->especialidades_model->editar($id);
				echo "guardo";
			}
		}
	}

	private function validar()
	{
		//Rules
		$this->form_validation->set_rules('descripcion', 'Descripción', 'required|min_length[4]|callback_very_descripcion');
		//Messages
		$this->form_validation->set_message('very_descripcion', '{field} ya se encuentra registrada en el sistema');
	}

	function very_descripcion($descripcion)
	{
		$very = $this->especialidades_model->verificar('descripcion', $descripcion);
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

	public function eliminar($id)
	{
		$query = $this->especialidades_model->detalles($id);
		if ($query != false)
		{
			$this->especialidades_model->eliminar($id);
		}
		redirect('especialidades');
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
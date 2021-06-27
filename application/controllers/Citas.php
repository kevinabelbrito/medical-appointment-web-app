<?php

class Citas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('citas_model');
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
			$mensaje = 'Por los momentos no se han programado citas.';
		}
		// Indicamos el numero de filas y links
		$filas = $this->citas_model->num_citas();
		$per_page = 20;
		// Configuramos la paginacion
		$config['base_url'] = base_url().'citas/index';
		$config['total_rows'] = $filas;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data = array(
			'titulo' => 'Citas Médicas',
			'contenido' => 'citas/index_view',
			'menu' => 'citas',
			'num_citas' => $filas,
			'citas' => $this->citas_model->listar_citas($per_page),
			'pagination' => $this->pagination->create_links(),
			'campo' => $campo,
			'mensaje' => $mensaje,
			'turnos' => $this->turnos(),
			'medicos' => $this->medicos(),
			'pacientes' => $this->pacientes(),
			);
		$this->load->view('plantilla', $data);
	}

	public function agregar()
	{
		if (!$this->input->is_ajax_request())
		{
			redirect('citas');
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
				$this->citas_model->agregar();
				echo "guardo";
			}
		}
	}

	public function editar($id)
	{
		if (!$this->input->is_ajax_request())
		{
			redirect('citas');
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
				$this->citas_model->editar($id);
				echo "guardo";
			}
		}
	}

	public function pagar($id)
	{
		if (!$this->input->is_ajax_request())
		{
			redirect('404');
		}
		else
		{
			//Rules
			$this->form_validation->set_rules('fecha_pago', 'Fecha del Pago', 'required');
			$this->form_validation->set_rules('monto', 'Monto a Pagar', 'required|numeric');
			if ($this->form_validation->run() == false)
			{
				echo validation_errors('<li>', '</li>');
			}
			else
			{
				$this->citas_model->pagar($id);
				echo "guardo";
			}
		}
	}

	public function consulta($id)
	{
		if (!$this->input->is_ajax_request())
		{
			redirect('404');
		}
		else
		{
			//Rules
			$this->form_validation->set_rules('sintomas', 'Sintomas', 'required|min_length[10]');
			$this->form_validation->set_rules('diagnostico', 'Diagnostico', 'required|min_length[10]');
			$this->form_validation->set_rules('tratamiento', 'Tratamiento', 'required|min_length[10]');
			$this->form_validation->set_rules('observaciones', 'Observaciones', 'min_length[10]');
			if ($this->form_validation->run() == false)
			{
				echo validation_errors('<li>', '</li>');
			}
			else
			{
				$this->citas_model->consulta_paciente($id);
				echo "guardo";
			}
		}
	}

	private function validar()
	{
		//Rules
		$this->form_validation->set_rules('medico', 'Médico Tratante', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('paciente', 'Paciente', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('fecha', 'Fecha', 'required|callback_very_fecha');
		$this->form_validation->set_rules('turno', 'Turno', 'required');
		//Messages
		$this->form_validation->set_message('very_fecha', '{field} no puede ser menor a la fecha actual');
	}

	function very_fecha($fecha)
	{
		if ($fecha < date("Y-m-d"))
		{
			return false;
		}
		else
		{
			return true;
		}
		
	}

	private function turnos()
	{
		$options = array(
			'' => '-',
			'Mañana' => 'Mañana',
			'Tarde' => 'Tarde',
			);
		return $options;
	}
	private function medicos()
	{
		$options = array('' => '-',);
		$medicos = $this->citas_model->cargar_medicos();
		foreach ($medicos as $doctor)
		{
			$options += array($doctor->id => $doctor->nombre,);
		}
		return $options;
	}

	private function pacientes()
	{
		$options = array('' => '-',);
		$pacientes = $this->citas_model->cargar_pacientes();
		foreach ($pacientes as $paciente)
		{
			$options += array($paciente->id => $paciente->nombre,);
		}
		return $options;
	}

	public function eliminar($id)
	{
		$query = $this->citas_model->detalles($id);
		if ($query != false)
		{
			$this->citas_model->eliminar($id);
		}
		redirect('citas');
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
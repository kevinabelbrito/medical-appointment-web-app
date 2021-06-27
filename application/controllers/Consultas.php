<?php

class Consultas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('consultas_model');
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
			$mensaje = 'Por los momentos no se han efectuado consultas médicas.';
		}
		// Indicamos el numero de filas y links
		$filas = $this->consultas_model->num_consultas();
		$per_page = 20;
		// Configuramos la paginacion
		$config['base_url'] = base_url().'consultas/index';
		$config['total_rows'] = $filas;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data = array(
			'titulo' => 'Consultas',
			'contenido' => 'consultas/index_view',
			'menu' => 'consultas',
			'num_consultas' => $filas,
			'consultas' => $this->consultas_model->listar_consultas($per_page),
			'pagination' => $this->pagination->create_links(),
			'campo' => $campo,
			'mensaje' => $mensaje,
			);
		$this->load->view('plantilla', $data);
	}

	public function detalles($id)
	{
		$query = $this->consultas_model->detalles($id);
		if ($query == false)
		{
			redirect('404');
		}
		else
		{
			$data = array(
				'titulo' => 'Consulta Nº '.$id,
				'contenido' => 'consultas/consulta_view',
				'menu' => 'consultas',
				'id' => $query->id,
				//Datos del paciente
				'nombre_paciente' => $query->nombre_paciente,
				'doc_paciente' => $query->doc_paciente,
				'sexo' => $query->sexo,
				'adn' => $query->adn,
				'peso' => $query->peso,
				'altura' => $query->altura,
				//Datos del medico
				'nombre_medico' => $query->nombre_medico,
				'doc_medico' => $query->doc_medico,
				'especialidad' => $query->especialidad,
				'email_medico' => $query->email_medico,
				'ingreso' => $query->ingreso,
				'consultorio' => $query->consultorio,
				//Datos de la consulta
				'nro_cita' => $query->nro_cita,
				'fecha_cita' => $query->fecha_cita,
				'sintomas' => $query->sintomas,
				'diagnostico' => $query->diagnostico,
				'tratamiento' => $query->tratamiento,
				'observaciones' => $query->observaciones,
				);
			$this->load->view('plantilla', $data);
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
				$this->consultas_model->editar($id);
				echo "guardo";
			}
		}
	}

	public function imprimir($id)
	{
		$query = $this->consultas_model->detalles($id);
		if ($query == false)
		{
			redirect('404');
		}
		else
		{
			$name_doc = "Consulta_nro".$id."_".$query->nombre_paciente;
			$view = "consultas/imprimir_view";
			$data = array(
				'id' => $query->id,
				//Datos del paciente
				'nombre_paciente' => $query->nombre_paciente,
				'doc_paciente' => $query->doc_paciente,
				'sexo' => $query->sexo,
				'adn' => $query->adn,
				'peso' => $query->peso,
				'altura' => $query->altura,
				//Datos del medico
				'nombre_medico' => $query->nombre_medico,
				'doc_medico' => $query->doc_medico,
				'especialidad' => $query->especialidad,
				'email_medico' => $query->email_medico,
				'ingreso' => $query->ingreso,
				'consultorio' => $query->consultorio,
				//Datos de la consulta
				'nro_cita' => $query->nro_cita,
				'fecha_cita' => $query->fecha_cita,
				'sintomas' => $query->sintomas,
				'diagnostico' => $query->diagnostico,
				'tratamiento' => $query->tratamiento,
				'observaciones' => $query->observaciones,
			);
			$this->reporte_pdf($name_doc, $view, $data);
		}
	}

	//Generar los reportes en formato PDF
	private function reporte_pdf($name_doc, $view, $data)
	{
		header('Cache-Control: no-cache');
		header('Pragma: no-cache');
		set_time_limit(320);
		ob_start();
		$this->load->view($view, $data);
		$doc = $name_doc.'.pdf';
		$content = ob_get_clean();
		require_once(APPPATH.'third_party/html2pdf/html2pdf.class.php');
		//Si indicamos el valor P sale vertical y L seria horizontal
		$pdf = new HTML2PDF('P', 'A4', 'es', 'UTF-8');
		$pdf->writeHTML($content);
		//$pdf->pdf->IncludeJS('print(TRUE)');
		$pdf->output($doc);
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
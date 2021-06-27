<?php

class Pagos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pagos_model');
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
			$mensaje = 'Por los momentos no se han reportado pagos.';
		}
		// Indicamos el numero de filas y links
		$filas = $this->pagos_model->num_pagos();
		$per_page = 20;
		// Configuramos la paginacion
		$config['base_url'] = base_url().'pagos/index';
		$config['total_rows'] = $filas;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data = array(
			'titulo' => 'Pagos',
			'contenido' => 'pagos/index_view',
			'menu' => 'pagos',
			'num_pagos' => $filas,
			'pagos' => $this->pagos_model->listar_pagos($per_page),
			'pagination' => $this->pagination->create_links(),
			'campo' => $campo,
			'mensaje' => $mensaje,
			);
		$this->load->view('plantilla', $data);
	}

	public function detalles($id)
	{
		$query = $this->pagos_model->detalles($id);
		if ($query == false)
		{
			redirect('404');
		}
		else
		{
			$data = array(
				'titulo' => 'Recibo Nº '.$id,
				'contenido' => 'pagos/pago_view',
				'menu' => 'pagos',
				'id' => $query->id,
				'nombre_paciente' => $query->nombre_paciente,
				'doc_paciente' => $query->doc_paciente,
				'nombre_medico' => $query->nombre_medico,
				'doc_medico' => $query->doc_medico,
				'fecha_cita' => $query->fecha_cita,
				'fecha_pago' => $query->fecha_pago,
				'turno' => $query->turno,
				'monto' => $query->monto,
				);
			$this->load->view('plantilla', $data);
		}
	}

	public function imprimir($id)
	{
		$query = $this->pagos_model->detalles($id);
		if ($query == false)
		{
			redirect('404');
		}
		else
		{
			$name_doc = "Recibo_nro".$id."_".$query->nombre_paciente;
			$view = "pagos/imprimir_view";
			$data = array(
				'id' => $query->id,
				'nombre_paciente' => $query->nombre_paciente,
				'doc_paciente' => $query->doc_paciente,
				'nombre_medico' => $query->nombre_medico,
				'doc_medico' => $query->doc_medico,
				'fecha_cita' => $query->fecha_cita,
				'fecha_pago' => $query->fecha_pago,
				'turno' => $query->turno,
				'monto' => $query->monto,
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
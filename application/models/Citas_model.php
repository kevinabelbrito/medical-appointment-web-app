<?php

class Citas_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function num_citas()
	{
		$this->consulta();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function listar_citas($per_page)
	{
		$this->consulta();
		$this->db->order_by('c.fecha', 'desc');
		$this->db->limit($per_page, $this->uri->segment(3));
		$query = $this->db->get();
		return $query->result();
	}

	public function agregar()
	{
		$data = array(
			'id_medico' => $this->input->post('medico', true),
			'id_paciente' => $this->input->post('paciente', true),
			'fecha' => $this->input->post('fecha', true),
			'turno' => $this->input->post('turno', true),
			'status' => "Pendiente de Pago",
			);
		$this->db->insert('citas', $data);
	}

	public function editar($id)
	{
		$set = array(
			'id_medico' => $this->input->post('medico', true),
			'id_paciente' => $this->input->post('paciente', true),
			'fecha' => $this->input->post('fecha', true),
			'turno' => $this->input->post('turno', true),
			);
		$condition = array('id' => $id);
		$this->db->update('citas', $set, $condition);
	}

	public function detalles($id)
	{
		$query = $this->db->get_where('citas', array('id' => $id));
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	public function eliminar($id)
	{
		$this->db->delete('citas', array('id' => $id));
	}

	public function cargar_medicos()
	{
		$this->db->select('m.id, p.nombre');
		$this->db->from('medicos m');
		$this->db->join('personas p', 'm.id_persona = p.id');
		$this->db->order_by('p.nombre', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function cargar_pacientes()
	{
		$this->db->select('a.id, p.nombre, p.documento');
		$this->db->from('pacientes a');
		$this->db->join('personas p', 'a.id_persona = p.id');
		$this->db->order_by('p.nombre', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function pagar($id)
	{
		//Agregamos el pago
		$data = array(
			'id_cita' => $id,
			'fecha' => $this->input->post('fecha_pago', true),
			'monto' => $this->input->post('monto', true),
			);
		$this->db->insert('pagos', $data);
		//Actualizamos el estatus a pagada
		$set = array('status' => 'Pagada');
		$condition = array('id' => $id);
		$this->db->update('citas', $set, $condition);
	}

	public function consulta_paciente($id)
	{
		$data = array(
			'id_cita' => $id,
			'sintomas' => $this->input->post('sintomas', true),
			'diagnostico' => $this->input->post('diagnostico', true),
			'tratamiento' => $this->input->post('tratamiento', true),
			'observaciones' => $this->input->post('observaciones', true),
			);
		$this->db->insert('consultas', $data);
	}

	public function num_consultas($id)
	{
		$query = $this->db->get_where('consultas', array('id_cita' => $id));
		return $query->num_rows();
	}

	private function consulta()
	{
		$this->db->select('c.id, c.fecha, c.turno, c.status, p.id as paciente, m.id as medico, e.descripcion as especialidad, h.nombre as nombre_paciente, h.documento as doc_paciente, q.nombre as nombre_medico, m.precio_consulta');
		$this->db->from('citas c');
		$this->db->join('pacientes p', 'c.id_paciente = p.id');
		$this->db->join('personas h', 'p.id_persona = h.id');
		$this->db->join('medicos m', 'c.id_medico = m.id');
		$this->db->join('especialidades e', 'm.id_especialidad = e.id');
		$this->db->join('personas q', 'm.id_persona = q.id');
		if ($this->input->get('campo'))
		{
			$this->db->like('h.nombre', $this->input->get('campo'));
			$this->db->or_like('q.nombre', $this->input->get('campo'));
			$this->db->or_like('h.documento', $this->input->get('campo'));
			$this->db->or_like('q.documento', $this->input->get('campo'));
		}
	}
}

?>
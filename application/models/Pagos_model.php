<?php

class Pagos_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function num_pagos()
	{
		$this->consulta();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function listar_pagos($per_page)
	{
		$this->consulta();
		$this->db->order_by('g.fecha', 'desc');
		$this->db->limit($per_page, $this->uri->segment(3));
		$query = $this->db->get();
		return $query->result();
	}

	public function detalles($id)
	{
		$this->consulta();
		$this->db->where('g.id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	private function consulta()
	{
		$this->db->select('g.id, g.fecha as fecha_pago, g.monto, c.turno, c.fecha as fecha_cita, h.nombre as nombre_paciente, h.documento as doc_paciente, q.nombre as nombre_medico, q.documento as doc_medico');
		$this->db->from('pagos g');
		$this->db->join('citas c', 'g.id_cita = c.id');
		$this->db->join('pacientes p', 'c.id_paciente = p.id');
		$this->db->join('personas h', 'p.id_persona = h.id');
		$this->db->join('medicos m', 'c.id_medico = m.id');
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
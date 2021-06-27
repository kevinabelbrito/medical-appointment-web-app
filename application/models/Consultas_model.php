<?php

class Consultas_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function num_consultas()
	{
		$this->consulta();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function listar_consultas($per_page)
	{
		$this->consulta();
		$this->db->order_by('c.fecha', 'desc');
		$this->db->limit($per_page, $this->uri->segment(3));
		$query = $this->db->get();
		return $query->result();
	}

	public function detalles($id)
	{
		$this->consulta();
		$this->db->where('d.id', $id);
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

	public function editar($id)
	{
		$set = array(
			'sintomas' => $this->input->post('sintomas', true),
			'diagnostico' => $this->input->post('diagnostico', true),
			'tratamiento' => $this->input->post('tratamiento', true),
			'observaciones' => $this->input->post('observaciones', true),
			);
		$condition = array('id' => $id);
		$this->db->update('consultas', $set, $condition);
	}

	private function consulta()
	{
		$this->db->select('d.id, d.sintomas, d.diagnostico, d.tratamiento, d.observaciones, c.id as nro_cita, c.turno, c.fecha as fecha_cita, p.nacimiento, p.adn, p.peso, p.altura, e.descripcion as especialidad, m.ingreso, m.consultorio, h.nombre as nombre_paciente, h.documento as doc_paciente, h.sexo, q.nombre as nombre_medico, q.documento as doc_medico, q.email as email_medico');
		$this->db->from('consultas d');
		$this->db->join('citas c', 'd.id_cita = c.id');
		$this->db->join('pacientes p', 'c.id_paciente = p.id');
		$this->db->join('personas h', 'p.id_persona = h.id');
		$this->db->join('medicos m', 'c.id_medico = m.id');
		$this->db->join('personas q', 'm.id_persona = q.id');
		$this->db->join('especialidades e', 'm.id_especialidad = e.id');
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
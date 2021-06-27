<?php

class Medicos_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function num_medicos()
	{
		$this->db->select('m.id_persona as id, p.nombre, p.documento, p.sexo, p.email, p.tlf, p.foto, e.descripcion as especialidad, m.id_especialidad, m.ingreso, m.consultorio, m.precio_consulta');
		$this->db->from('medicos m');
		$this->db->join('personas p', 'm.id_persona = p.id');
		$this->db->join('especialidades e', 'm.id_especialidad = e.id');
		if ($this->input->get('campo'))
		{
			$this->db->like('p.nombre', $this->input->get('campo'));
			$this->db->or_like('p.documento', $this->input->get('campo'));
		}
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function listar_medicos($per_page)
	{
		$this->db->select('m.id_persona as id, p.nombre, p.documento, p.sexo, p.email, p.tlf, p.foto, e.descripcion as especialidad, m.id_especialidad, m.ingreso, m.consultorio, m.precio_consulta');
		$this->db->from('medicos m');
		$this->db->join('personas p', 'm.id_persona = p.id');
		$this->db->join('especialidades e', 'm.id_especialidad = e.id');
		if ($this->input->get('campo'))
		{
			$this->db->like('p.nombre', $this->input->get('campo'));
			$this->db->or_like('p.documento', $this->input->get('campo'));
		}
		$this->db->order_by('p.nombre', 'asc');
		$this->db->limit($per_page, $this->uri->segment(3));
		$query = $this->db->get();
		return $query->result();
	}

	public function agregar()
	{
		$data = array(
			'id_persona' => $this->db->insert_id(),
			'id_especialidad' => $this->input->post('especialidad', true),
			'ingreso' => $this->input->post('ingreso', true),
			'consultorio' => $this->input->post('consultorio', true),
			'precio_consulta' => $this->input->post('precio_consulta', true),
			);
		$this->db->insert('medicos', $data);
	}

	public function detalles($id)
	{
		$this->db->select('m.id_persona as id, p.nombre, p.documento, p.sexo, p.email, p.tlf, p.foto, e.descripcion as especialidad, m.id_especialidad, m.ingreso, m.consultorio, m.precio_consulta');
		$this->db->from('medicos m');
		$this->db->join('personas p', 'm.id_persona = p.id');
		$this->db->join('especialidades e', 'm.id_especialidad = e.id');
		$this->db->where('id_persona', $id);
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
			'id_especialidad' => $this->input->post('especialidad', true),
			'ingreso' => $this->input->post('ingreso', true),
			'consultorio' => $this->input->post('consultorio', true),
			'precio_consulta' => $this->input->post('precio_consulta', true),
			);
		$condition = array('id_persona' => $id);
		$this->db->update('medicos', $set, $condition);
	}

	public function cargar_esp()
	{
		$this->db->order_by('descripcion', 'asc');
		$query = $this->db->get('especialidades');
		return $query->result();
	}
}

?>
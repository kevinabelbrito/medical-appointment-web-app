<?php

class Pacientes_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function num_pacientes()
	{
		$this->db->select('a.id_persona as id, p.nombre, p.documento, p.sexo, p.email, p.tlf, p.foto, a.nacimiento, a.adn, a.peso, a.altura');
		$this->db->from('pacientes a');
		$this->db->join('personas p', 'a.id_persona = p.id');
		if ($this->input->get('campo'))
		{
			$this->db->like('p.nombre', $this->input->get('campo'));
			$this->db->or_like('p.documento', $this->input->get('campo'));
		}
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function listar_pacientes($per_page)
	{
		$this->db->select('a.id_persona as id, p.nombre, p.documento, p.sexo, p.email, p.tlf, p.foto, a.nacimiento, a.adn, a.peso, a.altura');
		$this->db->from('pacientes a');
		$this->db->join('personas p', 'a.id_persona = p.id');
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
			'nacimiento' => $this->input->post('nacimiento', true),
			'adn' => $this->input->post('adn', true),
			'peso' => $this->input->post('peso', true),
			'altura' => $this->input->post('altura', true),
			);
		$this->db->insert('pacientes', $data);
	}

	public function detalles($id)
	{
		$this->db->select('a.id_persona as id, p.nombre, p.documento, p.sexo, p.email, p.tlf, p.foto, a.nacimiento, a.adn, a.peso, a.altura');
		$this->db->from('pacientes a');
		$this->db->join('personas p', 'a.id_persona = p.id');
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
			'nacimiento' => $this->input->post('nacimiento', true),
			'adn' => $this->input->post('adn', true),
			'peso' => $this->input->post('peso', true),
			'altura' => $this->input->post('altura', true),
			);
		$condition = array('id_persona' => $id);
		$this->db->update('pacientes', $set, $condition);
	}
}

?>
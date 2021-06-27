<?php

class Usuarios_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function num_users()
	{
		$this->db->select('u.id_persona as id, p.nombre, p.documento, p.sexo, p.email, p.tlf, p.foto, u.username, u.tipo');
		$this->db->from('usuarios u');
		$this->db->join('personas p', 'u.id_persona = p.id');
		if ($this->input->get('campo'))
		{
			$this->db->like('p.nombre', $this->input->get('campo'));
			$this->db->or_like('p.documento', $this->input->get('campo'));
			$this->db->or_like('u.username', $this->input->get('campo'));
		}
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function listar_usuarios($per_page)
	{
		$this->db->select('u.id_persona as id, p.nombre, p.documento, p.sexo, p.email, p.tlf, p.foto, u.username, u.tipo');
		$this->db->from('usuarios u');
		$this->db->join('personas p', 'u.id_persona = p.id');
		if ($this->input->get('campo'))
		{
			$this->db->like('p.nombre', $this->input->get('campo'));
			$this->db->or_like('p.documento', $this->input->get('campo'));
			$this->db->or_like('u.username', $this->input->get('campo'));
		}
		$this->db->order_by('p.nombre', 'asc');
		$this->db->limit($per_page, $this->uri->segment(3));
		$query = $this->db->get();
		return $query->result();
	}
	
	public function verificar($campo, $dato)
	{
		$where = array($campo => $dato);
		$query = $this->db->get_where('usuarios', $where);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	public function agregar()
	{
		$data = array(
			'id_persona' => $this->db->insert_id(),
			'username' => $this->input->post('username', true),
			'tipo' => $this->input->post('tipo', true),
			'password' => $this->input->post('password', true),
			'preg' => $this->input->post('preg', true),
			'resp' => $this->input->post('respuesta', true),
			);
		$this->db->insert('usuarios', $data);
	}

	public function detalles($id)
	{
		$this->db->select('u.id_persona, p.nombre, p.documento, p.sexo, p.email, p.tlf, p.foto, u.username, u.tipo, u.password, u.preg, u.resp');
		$this->db->from('usuarios u');
		$this->db->join('personas p', 'u.id_persona = p.id');
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
			'username' => $this->input->post('username', true),
			'tipo' => $this->input->post('tipo', true),
			);
		$condition = array('id_persona' => $id);
		$this->db->update('usuarios', $set, $condition);
	}
}

?>
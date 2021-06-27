<?php

class Admin_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$this->db->select('u.id_persona as id, p.nombre, p.documento, p.sexo, p.email, p.tlf, p.foto, u.username, u.tipo, u.password, u.preg, u.resp');
		$this->db->from('usuarios u');
		$this->db->join('personas p', 'u.id_persona = p.id');
		$where = array(
			'username' => $this->input->post('username', true),
			'password' => $this->input->post('password', true),
			);
		$this->db->where($where);
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
			'preg' => $this->input->post('preg', true),
			'resp' => $this->input->post('respuesta', true),
			);
		$condition = array('id_persona' => $id);
		$this->db->update('usuarios', $set, $condition);
	}

	public function recuperar()
	{
		$this->db->select('p.nombre, p.email, u.username, u.password');
		$this->db->from('usuarios u');
		$this->db->join('personas p', 'u.id_persona = p.id');
		$where = array(
			'p.documento' => $this->input->post('documento'),
			'u.preg' => $this->input->post('preg'),
			'u.resp' => $this->input->post('respuesta'),
			);
		$this->db->where($where);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	public function cambiar_clave()
	{
		$set = array('password' => $this->input->post('nueva'));
		$condition = array('id_persona' => $this->session->userdata('id'));
		$this->db->update('usuarios', $set, $condition);
	}
}

?>
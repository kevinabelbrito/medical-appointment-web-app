<?php

class Personas_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function verificar($campo, $dato)
	{
		$where = array($campo => $dato);
		$query = $this->db->get_where('personas', $where);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	public function agregar($foto)
	{
		/*if ($this->input->post('tlf'))
		{
			$tlf = $this->input->post('tlf', true);
		}
		else
		{
			$tlf = "";
		}*/
		$data = array(
			'nombre' => $this->input->post('nombre', true),
			'documento' => $this->input->post('documento', true),
			'sexo' => $this->input->post('sexo', true),
			'email' => $this->input->post('email', true),
			'tlf' => $this->input->post('tlf', true),
			'foto' => $foto,
			);
		$this->db->insert('personas', $data);
	}

	public function editar($id, $foto)
	{
		$set = array(
			'nombre' => $this->input->post('nombre', true),
			'documento' => $this->input->post('documento', true),
			'sexo' => $this->input->post('sexo', true),
			'email' => $this->input->post('email', true),
			'tlf' => $this->input->post('tlf', true),
			'foto' => $foto,
			);
		$condition = array('id' => $id);
		$this->db->update('personas', $set, $condition);
	}

	public function eliminar($id)
	{
		$this->db->delete('personas', array('id' => $id));
	}
}

?>
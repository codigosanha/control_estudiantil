<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_lectores_model extends CI_Model {

	public function getTipoLectores(){
		$resultados = $this->db->get("tipo_lectores");
		return $resultados->result();
	}

	public function getTipolector($id){
		$this->db->where("id",$id);
		$consulta = $this->db->get("tipo_lectores");
		return $consulta->row();
	}

	public function save($datos){
		return $this->db->insert("tipo_lectores",$datos);
	}

	public function update($id,$datos){
		$this->db->where("id",$id);
		return $this->db->update("tipo_lectores",$datos);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("tipo_lectores");
	}
}

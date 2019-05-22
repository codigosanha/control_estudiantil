<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

	public function getCategorias(){
		$resultados = $this->db->get("categorias");
		return $resultados->result();
	}

	public function getCategoria($id){
		$this->db->where("id",$id);
		$consulta = $this->db->get("categorias");
		return $consulta->row();
	}

	public function save($datos){
		return $this->db->insert("categorias",$datos);
	}

	public function update($id,$datos){
		$this->db->where("id",$id);
		return $this->db->update("categorias",$datos);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("categorias");
	}
}

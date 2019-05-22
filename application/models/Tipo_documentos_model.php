<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_documentos_model extends CI_Model {

	public function getTipoDocumentos(){
		$resultados = $this->db->get("tipo_documentos");
		return $resultados->result();
	}

	public function getTipodocumento($id){
		$this->db->where("id",$id);
		$consulta = $this->db->get("tipo_documentos");
		return $consulta->row();
	}

	public function save($datos){
		return $this->db->insert("tipo_documentos",$datos);
	}

	public function update($id,$datos){
		$this->db->where("id",$id);
		return $this->db->update("tipo_documentos",$datos);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("tipo_documentos");
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiantes_model extends CI_Model {

	public function getInfoEstudiante($search){
		$this->db->like('nombres', $search); 
		$this->db->or_like('apellidos', $search);
		$this->db->or_like('dni', $search);
		$resultados = $this->db->get("estudiantes");
		return $resultados->result();
	}

	public function getModulos($idEstudiante){
		$this->db->select("em.*, m.nombre");
		$this->db->from("estudiantes_modulos em");
		$this->db->join("modulos m", "em.modulo_id = m.id");
		$this->db->where('em.estudiante_id', $idEstudiante); 
		
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function updateEstudianteModulo($estudiante_id, $modulo_id, $data){
		$this->db->where('estudiante_id', $estudiante_id);
		$this->db->where('modulo_id', $modulo_id);
		return $this->db->update("estudiantes_modulos",$data);
	}
}

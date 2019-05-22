<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestamos_model extends CI_Model
{
    public function getPrestamos($estado = false,$renovacion = false)
    {
        $this->db->select("p.*, le.num_documento,le.nombres,le.apellidos,li.codigo_topografico");
        $this->db->join("lectores le", "le.id = p.lector_id");
        $this->db->join("libros li", "li.id= p.libro_id");
        if ($estado !== false) {
            $this->db->where("p.estado",$estado);
        }

        if ($renovacion!== false) {
            $this->db->where("p.renovacion",$renovacion);
        }
        $resultados = $this->db->get("prestamos p");
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getPrestamo($id)
    {

        $this->db->select("*");
        $this->db->where("id", $id);
        $resultados = $this->db->get("prestamos");
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }

    }

    public function guardar($datos)
    {
        return $this->db->insert("prestamos", $datos);
    }

    public function update($id, $data)
    {
        $this->db->where("id", $id);
        return $this->db->update("prestamos", $data);
    }

    public function delete($id)
    {
        $this->db->where("id_libro", $id);
        return $this->db->delete("libros");
    }

}

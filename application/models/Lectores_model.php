<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lectores_model extends CI_Model
{
    public function getLectores()
    {
        $this->db->select("l.*, td.nombre as tipodocumento, tl.nombre as tipolector");
        $this->db->join("tipo_documentos td", "td.id = l.tipo_documento_id");
        $this->db->join("tipo_lectores tl", "tl.id = l.tipo_lector_id");
        $resultados = $this->db->get("lectores l");
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getLector($id)
    {

        
        $this->db->where("id", $id);
        $resultados = $this->db->get("lectores");
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }

    }

    public function save($datos)
    {
        return $this->db->insert("lectores", $datos);
    }

    public function update($id, $data)
    {
        $this->db->where("id", $id);
        return $this->db->update("lectores", $data);
    }

    public function delete($id)
    {
        $this->db->where("id_libro", $id);
        return $this->db->delete("lectores");
    }
    public function disponibilidad($codigo)
    {
        

        $this->db->select("l.*, f.nombre as facultad");
        $this->db->join("facultades f", "f.id = l.id_facultad");
        $this->db->where("l.codigo_libro", $codigo);
        $resultados = $this->db->get("lectores l");
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }
    public function verificar($codtitulo, $idfacultad, $campo)
    {
        $this->db->select("l.*,f.nombre as facultad");
        $this->db->join("facultades f", "f.id = l.id_facultad");
        if ($idfacultad !== "") {
            $this->db->where("l.id_facultad", $idfacultad);
        }
       
        if ($campo == 1) {
            $this->db->like('l.titulo_libro', $codtitulo);
        }
        else{
            $this->db->where('l.codigo_libro', $codtitulo);
        }
         
        
        

        $resultados = $this->db->get('lectores l');
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function comprobardocumento($num_documento)
    {
        $this->db->select("*");
        $this->db->where('num_documento', $num_documento);
        $resultados = $this->db->get('lectores');
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }
}

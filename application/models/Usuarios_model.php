<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{
    public function getUsuarios()
    {
       
        $resultados = $this->db->get("usuarios");
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getUsuario($id)
    {
        $this->db->where("id", $id);
        $resultados = $this->db->get("usuarios");
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }

    }

    public function save($datos)
    {
        return $this->db->insert("usuarios", $datos);
    }

    public function update($id, $data)
    {
        $this->db->where("id", $id);
        return $this->db->update("usuarios", $data);
    }

    public function delete($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete("usuarios");
    }

    public function logear($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $resultados = $this->db->get("usuarios");
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }
}

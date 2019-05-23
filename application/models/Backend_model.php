<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_model extends CI_Model {

	function get_records($table, $where=NULL)
    {
        if(!empty($where))
        {
            $this->db->where($where);
        }
        $query=$this->db->get($table);
        if($query->num_rows() >0)
        {
            return $query->result();
        }
        else
        {
            return array();
        }
    }

    function get_record($table, $where=NULL)
    {
        if(!empty($where))
        {
            $this->db->where($where);
        }
        $query=$this->db->get($table);
        if($query->num_rows()>0)
        {
            return $query->row();
        }
        else
        {
            return 0;
        }
    }

    function insert($table,$data)
	{
        if($this->db->insert($table, $data)){
        	$query = $this->db->where('id', $this->db->insert_id())
                            ->get($table);

        	return $query->row();
        } else {
        	return false;
        }
	}

    function update($table ,$where=NULL ,$data)
	{
	    if(!empty($where))
	    {
	        $this->db->where($where);
	    }
	    return $this->db->update($table,$data);
	    

	}

	function delete($table , $where=NULL)
    {
        if(!empty($where))
        {
            $this->db->where($where);
        }
        return $this->db->delete($table);
        
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_model extends CI_Model {

	public function getCategorias($año)
	{
	    $query = $this->db->get('categorias');
	    $return = array();

	    foreach ($query->result() as $categoria)
	    {
	        $return[$categoria->id] = $categoria;
	        $return[$categoria->id]->cantidades = $this->getCantidades($categoria->id,$año); // Get the categories sub categories
	    }

	    return $return;
	}


	public function getCantidades($categoria_id,$año)
	{
		$sql = "SELECT 
			    IFNULL(SUM(IF(month = 'Jan', total, 0)),0) AS 'jan',
			    IFNULL(SUM(IF(month = 'Feb', total, 0)),0) AS 'feb',
			    IFNULL(SUM(IF(month = 'Mar', total, 0)),0) AS 'mar',
			    IFNULL(SUM(IF(month = 'Apr', total, 0)),0) AS 'apr',
			    IFNULL(SUM(IF(month = 'May', total, 0)),0) AS 'may',
			    IFNULL(SUM(IF(month = 'Jun', total, 0)),0) AS 'jun',
			    IFNULL(SUM(IF(month = 'Jul', total, 0)),0) AS 'jul',
			    IFNULL(SUM(IF(month = 'Aug', total, 0)),0) AS 'aug',
			    IFNULL(SUM(IF(month = 'Sep', total, 0)),0) AS 'sep',
			    IFNULL(SUM(IF(month = 'Oct', total, 0)),0) AS 'oct',
			    IFNULL(SUM(IF(month = 'Nov', total, 0)),0) AS 'nov',
			    IFNULL(SUM(IF(month = 'Dec', total, 0)),0) AS 'dec',
			    IFNULL(SUM(total),0) AS total_yearly
			 
			    FROM (
			SELECT DATE_FORMAT(p.fecha_prestamo, '%b') AS month, COUNT(p.libro_id) as total
			FROM prestamos p 
			JOIN libros l ON p.libro_id = l.id
			JOIN categorias c ON c.id = l.categoria_id

			WHERE p.fecha_prestamo <= NOW() and p.fecha_prestamo >= Date_add(Now(),interval - 12 month)
			        AND c.id = {$categoria_id}
			        AND YEAR(p.fecha_prestamo) = {$año}
			GROUP BY DATE_FORMAT(p.fecha_prestamo, '%m-%Y')) as sub";


	    $query = $this->db->query($sql);
	    return $query->row();
	}
	public function getCategoriasMonth($mes, $año){
		$query = $this->db->get('categorias');
	    $return = array();

	    foreach ($query->result() as $categoria)
	    {
	        $return[$categoria->id] = $categoria;
	        $return[$categoria->id]->amountPerDays = $this->amountPerDay($categoria->id,$mes,$año); // Get the categories sub categories
	    }

	    return $return;
	}
	public function amountPerDay($categoria, $mes, $año){
		$cantidades = [];
		$num_of_days = cal_days_in_month(CAL_GREGORIAN, $mes, $año);
        for( $i=1; $i<= $num_of_days; $i++)
            $dates[]= str_pad($i,2,'0', STR_PAD_LEFT);

        foreach($dates as $date){
     
            $this->db->select("IFNULL(COUNT(p.id),0) as total");
            $this->db->from("prestamos p");
            $this->db->join("libros l", "p.libro_id = l.id");
            $this->db->join("categorias c", "l.categoria_id = c.id");
			$this->db->where("p.fecha_prestamo", $año."-".$mes."-".$date);
			$this->db->where("c.id",$categoria);
			$this->db->group_by("p.fecha_prestamo");
			$resultado = $this->db->get();

			if ($resultado->num_rows() > 0) {
				$cantidades[] = $resultado->row()->total;
			}
			else{
				$cantidades[] = 0;
			}

        }
        return $cantidades;

		
	}

	public function amountPerDay3($categoria, $mes, $año){
		$date = $año."-".$mes."-01";
        $end = $año."-".$mes."-" . date('t', strtotime($date)); //get end date of month

        while(strtotime($date) <= strtotime($end)) {
            /*$day_num = date('d', strtotime($date));
            $day_name = date('l', strtotime($date));
            $day_number = date('w', strtotime($date));
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
            if ($day_number != 0) {
                echo $day_num." - ".$day_name."-".$day_number."<br>";
            }*/
            if (date('w', strtotime($date)) != 0) {
            	$this->db->select("IFNULL(COUNT(p.id),0) as total");
	            $this->db->from("prestamos p");
	            $this->db->join("libros l", "p.libro_id = l.id");
	            $this->db->join("categorias c", "l.categoria_id = c.id");
				$this->db->where("p.fecha_prestamo",$date);
				$this->db->where("c.id",$categoria);
				$this->db->group_by("p.fecha_prestamo");
				$resultado = $this->db->get();

				if ($resultado->num_rows() > 0) {
					$cantidades[] = $resultado->row()->total;
				}
				else{
					$cantidades[] = 0;
				}
            }
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        }
        return $cantidades;
	}

	public function prueba(){

		$this->db->select("IFNULL(COUNT(*),'0') as total");
        $this->db->from("prestamos");
		$this->db->where("fecha_prestamo", '2018-11-01');
		$this->db->group_by("fecha_prestamo");
		$resultado = $this->db->get();

		if ($resultado > 0) {
			# code...
		}

		return $resultado->row()->total;
			
	}

	public function getPrestamos()
    {
        $this->db->select("p.*, le.num_documento,le.nombres,le.apellidos,li.codigo_topografico,li.titulo,tl.nombre as tipolector");
        $this->db->join("lectores le", "le.id = p.lector_id");
        $this->db->join("tipo_lectores tl", "le.tipo_lector_id = tl.id");
        $this->db->join("libros li", "li.id= p.libro_id");

        $resultados = $this->db->get("prestamos p");
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

}

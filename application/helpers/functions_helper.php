<?php 

if(!function_exists('getEspecialidad'))
{
	function getEspecialidad($idEspecialidad)
	{
		$ci = & get_instance();
		$ci->db->where('id',$idEspecialidad);
		$query = $ci->db->get('especialidades');
		return $query->row();
	}
}

if(!function_exists('getModulo'))
{
	function getModulo($idModulo)
	{
		$ci = & get_instance();
		$ci->db->where('id',$idModulo);
		$query = $ci->db->get('modulos');
		return $query->row();
	 
	}
}

if(!function_exists('getNumeroRomano'))
{
	function getNumeroRomano($numero)
	{	
		$array = ['I','II','III','IV','V','VI',"Te"];
	    return $array[$numero-1];
	 
	}
}

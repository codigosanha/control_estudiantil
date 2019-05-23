
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('getEspecialidad'))
{
	function getEspecialidad($idEspecialidad)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
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
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci = & get_instance();

		$ci->db->where('id',$idModulo);
		$query = $ci->db->get('modulo');
		return $query->row();
	 
	}
}

if(!function_exists('getNumeroRomano'))
{
	function getNumeroRomano($numero)
	{	
		$array = ['I','II','III','IV','V','VI'];

	    return $array[$numero-1];
	 
	}
}

//end application/helpers/ayuda_helper.php
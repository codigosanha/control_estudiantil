<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Estudiantes_model");
        $this->load->helper("functions");
	}

	public function index()
	{
        $this->load->view('welcome_message');
	}
	public function getInfoEstudiante(){
        $valor = $this->input->post("valor");
        $estudiantes = $this->Estudiantes_model->getInfoEstudiante($valor);

        $data  = array();

        foreach ($estudiantes as $e) {
            $dataEstudiante['id'] = $e->id;
            $dataEstudiante['nombres'] = $e->nombres;
            $dataEstudiante['apellidos'] = $e->apellidos;
            $dataEstudiante['dni'] = $e->dni;
            $dataEstudiante['label'] = $e->dni ." - ".$e->nombres." ".$e->apellidos;
            $dataEstudiante['semestre'] = getNumeroRomano($e->semestre);
            $dataEstudiante['especialidad'] = getEspecialidad($e->especialidad_id)->nombre;
            $modulos = $this->Estudiantes_model->getModulos($e->id);
            $dataEstudiante['modulos'] = $modulos;

            $data [] = $dataEstudiante;
        }

        echo json_encode($data);
    }
}

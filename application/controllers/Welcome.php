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
        $dni = $this->input->post("dni");
        $estudiante = $this->Backend_model->get_record("estudiantes","dni='$dni'");


        if ($estudiante) {
            $dataEstudiante = array(
                'id' => $estudiante->id, 
                'nombres' => $estudiante->nombres,
                'apellidos' => $estudiante->apellidos,
                'dni' => $estudiante->dni,
                'semestre' => $estudiante->semestre,
                'programa_estudio' => getEspecialidad($estudiante->especialidad_id)->nombre,
            );
            $data  = array(
                'estudiante' => $dataEstudiante,
                'modulos' => $this->Estudiantes_model->getModulos($estudiante->id)
            );
            echo json_encode($data);
        }else{
            echo "0";
        }
    }
}

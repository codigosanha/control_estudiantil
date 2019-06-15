<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Estudiantes_model");
        $this->load->helper("functions");
         $this->load->helper("download");
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
                'semestre' => getNumeroRomano($estudiante->semestre),
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

       public function reporte_practica($id){
        $this->load->library('pdfgenerator');
        $infoEstMod = $this->Backend_model->get_record("estudiantes_modulos","id=$id");
        $data = array(
            "estudiante" => $this->Backend_model->get_record("estudiantes","id=$infoEstMod->estudiante_id"),
            'informe' => $infoEstMod
        );
        $html = $this->load->view('estudiantes/reporte_informe',$data, true);
        $filename = 'Información_practica';
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'landscape');
    }

    public function informe_practica(){
        $idEstMod = $this->input->post("idEstMod");
        $data  = array(
            'informe' => $this->Backend_model->get_record("estudiantes_modulos","id=$idEstMod"), 
        );
        $this->load->view("estudiantes/view_informe", $data);
    }

    public function resoluciones($id){
        $filename = $this->Backend_model->get_record("estudiantes_modulos","id='$id'")->archivo_resolucion;
        $file = 'assets/resoluciones/'.$filename;
        force_download($file, NULL);
    }
}

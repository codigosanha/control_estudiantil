<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct(){

        parent::__construct();

		

        if (!$this->session->userdata('login')) {

            redirect(base_url()."auth");

        }
        $this->load->model('Estudiantes_model');
        $this->load->helper("functions");


	}



	public function index()

	{

        $data = array(

            'title'     => 'Principal',

            'contenido' => $this->load->view('principal', '', true),

        );



        $this->load->view('template', $data);

	}

    public function reporte($id){
        $this->load->library('pdfgenerator');
        
        $data = array(
            "estudiante" => $this->Backend_model->get_record("estudiantes","id=$id"),
            "modulos" => $this->Estudiantes_model->getModulos($id),
        );
        $html = $this->load->view('estudiantes/reporte',$data, true);
        $filename = 'Reporte_estudiantil';
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'landscape');
    }



}


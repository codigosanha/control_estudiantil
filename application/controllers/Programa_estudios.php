<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programa_estudios extends CI_Controller {

	public function __construct(){
		parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url()."auth");
        }
	}


	public function index()
	{
		$contenido_interno = array(
            'especialidades' => $this->Backend_model->get_records('especialidades'),
        );

        $contenido_exterior = array(
            'title'     => 'Listado de Programas de Estudio',
            'contenido' => $this->load->view('especialidades/list', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function add(){
        $contenido_exterior = array(
            'title'     => 'Agregar Programa de Estudio',
            'contenido' => $this->load->view('especialidades/add', '', true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function store(){
        $nombre        = $this->input->post("nombre");

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|is_unique[especialidades.nombre]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'El %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $dataEspecialidad = array(
                'nombre'        	=> $nombre,
            );

            if ($this->Backend_model->insert('especialidades',$dataEspecialidad)) {
            	$this->session->set_flashdata("success","La Especialidad fue registrado exitosamente");
                redirect(base_url() . "programa_estudios");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "programa_estudios/add");
            }
        }
	}

	public function edit($id)
    {
        $contenido_interno = array(
            'especialidad'      => $this->Backend_model->get_record('especialidades',"id=$id"),
            
        );

        $contenido_exterior = array(
            'title'     => 'Editar Programa de estudio',
            'contenido' => $this->load->view('especialidades/edit', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
    }

    public function update(){
        $idEspecialidad      = $this->input->post("idEspecialidad");
    	$nombre      = $this->input->post("nombre");
        

        $especialidadActual = $this->Backend_model->get_record('especialidades',"id=$idEspecialidad");
        $is_unique_nombre = '';
        if ($especialidadActual->nombre != $nombre) {
            $is_unique_nombre = '|is_unique[especialidades.nombre]';
        }

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required'.$is_unique_nombre, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'El %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idEspecialidad);
        } else {
          
            $dataEspecialidad = array(
                'nombre'         => $nombre,
            );

            if ($this->Backend_model->update('especialidades',"id=$idEspecialidad",$dataEspecialidad)) {
            	$this->session->set_flashdata("success","La informacion de la Especialidad fue actualizada correctamente");
                redirect(base_url() . "programa_estudios");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "programa_estudios/edit/".$idEspecialidad);
            }
        }
    }

    public function inactivar(){
        $id = $this->input->post("id");
        $data  = array(
            'estado' => 0, 
        );
        if ($this->Backend_model->update("especialidades","id=$id", $data)) {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function activar(){
        $id = $this->input->post("id");
        $data  = array(
            'estado' => 1, 
        );
        if ($this->Backend_model->update("especialidades","id=$id", $data)) {
            echo "1";
        }else{
            echo "0";
        }
    }

}

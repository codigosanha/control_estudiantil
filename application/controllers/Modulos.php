<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulos extends CI_Controller {

	public function __construct(){
		parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url()."auth");
        }

        $this->load->helper("functions");
	}


	public function index()
	{
		$contenido_interno = array(
            'modulos' => $this->Backend_model->get_records('modulos'),
        );

        $contenido_exterior = array(
            'title'     => 'Listado de Modulos',
            'contenido' => $this->load->view('modulos/list', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function add(){

        $contenido_interno = array(
            'especialidades' => $this->Backend_model->get_records('especialidades'),
        );

        $contenido_exterior = array(
            'title'     => 'Agregar Modulo',
            'contenido' => $this->load->view('modulos/add', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function store(){
        $nombre        = $this->input->post("nombre");
        $especialidad_id        = $this->input->post("especialidad_id");

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|is_unique[modulos.nombre]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'El %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $dataModulo = array(
                'nombre'        	=> $nombre,
                'especialidad_id'            => $especialidad_id,
            );

            if ($this->Backend_model->insert('modulos',$dataModulo)) {
            	$this->session->set_flashdata("success","El Modulo fue registrado exitosamente");
                redirect(base_url() . "modulos");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "modulos/add");
            }
        }
	}

	public function edit($id)
    {
        $contenido_interno = array(
            'modulo'      => $this->Backend_model->get_record('modulos',"id=$id"),
            'especialidades' => $this->Backend_model->get_records('especialidades')
            
        );

        $contenido_exterior = array(
            'title'     => 'Editar Modulo',
            'contenido' => $this->load->view('modulos/edit', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
    }

    public function update(){
        $idModulo      = $this->input->post("idModulo");
    	$nombre      = $this->input->post("nombre");
        $especialidad_id      = $this->input->post("especialidad_id");

        $moduloActual = $this->Backend_model->get_record('modulos',"id=$idModulo");
        $is_unique_nombre = '';
        if ($moduloActual->nombre != $nombre) {
            $is_unique_nombre = '|is_unique[modulos.nombre]';
        }

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required'.$is_unique_nombre, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'El %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idModulo);
        } else {
          
            $dataModulo = array(
                'nombre'         => $nombre,
                'especialidad_id'         => $especialidad_id,
            );

            if ($this->Backend_model->update('modulos',"id=$idModulo",$dataModulo)) {
            	$this->session->set_flashdata("success","La informacion del Modulo fue actualizada correctamente");
                redirect(base_url() . "modulos");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "modulos/edit/".$idModulo);
            }
        }
    }

    public function inactivar(){
        $id = $this->input->post("id");
        $data  = array(
            'estado' => 0, 
        );
        if ($this->Backend_model->update("modulos","id=$id", $data)) {
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
        if ($this->Backend_model->update("modulos","id=$id", $data)) {
            echo "1";
        }else{
            echo "0";
        }
    }

}

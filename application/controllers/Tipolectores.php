<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tipolectores extends CI_Controller {

	public function __construct(){
		parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
		$this->load->model('Tipo_lectores_model');
	}


	public function index()
	{
		$contenido_interno = array(
            'tipolectores' => $this->Tipo_lectores_model->getTipolectores(),
        );

        $contenido_exterior = array(
            'title'     => 'Listado de Tipo Lectores',
            'contenido' => $this->load->view('tipolectores/list', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function add(){
        $contenido_exterior = array(
            'title'     => 'Agregar Tipo Lector',
            'contenido' => $this->load->view('tipolectores/add', '', true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function store(){
        $nombre        = $this->input->post("nombre");

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|is_unique[tipo_lectores.nombre]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $dataTipolector = array(
                'nombre'        	=> $nombre,
            );

            if ($this->Tipo_lectores_model->save($dataTipolector)) {
            	$this->session->set_flashdata("success","El Tipo de Lector fue registrado exitosamente");
                redirect(base_url() . "tipolectores/add");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "tipolectores/add");
            }
        }
	}

	public function edit($id)
    {
        $contenido_interno = array(
            'tipolector'      => $this->Tipo_lectores_model->getTipolector($id),
            
        );

        $contenido_exterior = array(
            'title'     => 'Editar Tipo Lector',
            'contenido' => $this->load->view('tipolectores/edit', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
    }

    public function update(){
        $idTipolector      = $this->input->post("idTipolector");
    	$nombre      = $this->input->post("nombre");

        $tipolectorActual = $this->Tipo_lectores_model->getTipolector($idTipolector);

        $is_unique_nombre = '';
       
        if ($tipolectorActual->nombre != $nombre) {
            $is_unique_nombre = '|is_unique[tipo_lectores.nombre]';
        }

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required'.$is_unique_nombre, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idTipolector);
        } else {
          
            $dataTipolector = array(
                'nombre'         => $nombre,
            );

            if ($this->Tipo_lectores_model->update($idTipolector,$dataTipolector)) {
            	$this->session->set_flashdata("success","La informacion del tipolector fue actualizada correctamente");
                redirect(base_url() . "tipolectores");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "tipolectores/edit/".$idTipolector);
            }
        }
    }

    public function delete($id){
        $this->Tipo_lectores_model->delete($id);
        echo "1";
    }

}

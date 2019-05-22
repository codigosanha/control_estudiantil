<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipodocumentos extends CI_Controller {

	public function __construct(){
		parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
		$this->load->model('Tipo_documentos_model');
	}


	public function index()
	{
		$contenido_interno = array(
            'tipodocumentos' => $this->Tipo_documentos_model->getTipodocumentos(),
        );

        $contenido_exterior = array(
            'title'     => 'Listado de tipodocumentos',
            'contenido' => $this->load->view('tipodocumentos/list', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function add(){
        $contenido_exterior = array(
            'title'     => 'Agregar Tipo documento',
            'contenido' => $this->load->view('tipodocumentos/add', '', true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function store(){
        $nombre        = $this->input->post("nombre");

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|is_unique[tipo_documentos.nombre]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $dataTipodocumento = array(
                'nombre'        	=> $nombre,
            );

            if ($this->Tipo_documentos_model->save($dataTipodocumento)) {
            	$this->session->set_flashdata("success","El Tipo de Documentos fue registrado exitosamente");
                redirect(base_url() . "tipodocumentos/add");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "tipodocumentos/add");
            }
        }
	}

	public function edit($id)
    {
        $contenido_interno = array(
            'tipodocumento'      => $this->Tipo_documentos_model->getTipodocumento($id),
            
        );

        $contenido_exterior = array(
            'title'     => 'Editar Tipo Documento',
            'contenido' => $this->load->view('tipodocumentos/edit', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
    }

    public function update(){
        $idTipodocumento      = $this->input->post("idTipodocumento");
    	$nombre      = $this->input->post("nombre");

        $tipodocumentoActual = $this->Tipo_documentos_model->getTipodocumento($idTipodocumento);

        $is_unique_nombre = '';
       
        if ($tipodocumentoActual->nombre != $nombre) {
            $is_unique_nombre = '|is_unique[tipo_documentos.nombre]';
        }

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required'.$is_unique_nombre, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idTipodocumento);
        } else {
          
            $dataTipodocumento = array(
                'nombre'         => $nombre,
            );

            if ($this->Tipo_documentos_model->update($idTipodocumento,$dataTipodocumento)) {
            	$this->session->set_flashdata("success","La informacion del tipodocumento fue actualizada correctamente");
                redirect(base_url() . "tipodocumentos");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "tipodocumentos/edit/".$idTipodocumento);
            }
        }
    }

    public function delete($id){
        $this->Tipo_documentos_model->delete($id);
        echo "1";
    }

}

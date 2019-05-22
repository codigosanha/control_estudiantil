<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lectores extends CI_Controller {

	public function __construct(){
		parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
		$this->load->model('Lectores_model');
		$this->load->model('Tipo_documentos_model');
        $this->load->model('Tipo_Lectores_model');
	}


	public function index()
	{
		$contenido_interno = array(
            'lectores' => $this->Lectores_model->getLectores(),
        );

        $contenido_exterior = array(
            'title'     => 'Catalogo de lectores',
            'contenido' => $this->load->view('lectores/list', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function add(){
		$contenido_interno = array(
            'tipodocumentos' => $this->Tipo_documentos_model->getTipoDocumentos(),
            'tipolectores' => $this->Tipo_Lectores_model->getTipoLectores(),
        );

        $contenido_exterior = array(
            'title'     => 'Agregar Lector',
            'contenido' => $this->load->view('lectores/add', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function store(){
		$nombres      = $this->input->post("nombres");
        $apellidos        = $this->input->post("apellidos");
        $tipo_documento_id      = $this->input->post("tipo_documento_id");
        $tipo_lector_id   = $this->input->post("tipo_lector_id");
        $telefono       = $this->input->post("telefono");
        $direccion       = $this->input->post("direccion");
        $num_documento = $this->input->post("num_documento");
        $distrito_provincia = $this->input->post("distrito_provincia");
        $this->form_validation->set_rules('num_documento', 'Numero de Documento', 'trim|required|is_unique[lectores.num_documento]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $dataLector = array(
                'nombres'    => $nombres,
                'apellidos'        	=> $apellidos,
                'num_documento'      			=> $num_documento,
                'tipo_documento_id'   			=> $tipo_documento_id,
                'tipo_lector_id'       			=> $tipo_lector_id,
                'telefono' 			=> $telefono,
                'direccion'   			=> $direccion,
                'distrito_provincia'             => $distrito_provincia,
            );

            if ($this->Lectores_model->save($dataLector)) {
            	$this->session->set_flashdata("success","El Libro fue registrado exitosamente");
                redirect(base_url() . "lectores/add");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "lectores/add");
            }
        }
	}

	public function edit($id)
    {
        $contenido_interno = array(
            'lector'      => $this->Lectores_model->getLector($id),
            'tipodocumentos' => $this->Tipo_documentos_model->getTipoDocumentos(),
            'tipolectores' => $this->Tipo_Lectores_model->getTipoLectores(),
        );

        $contenido_exterior = array(
            'title'     => 'Editar Lector',
            'contenido' => $this->load->view('lectores/edit', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
    }

    public function update(){
        $idLector      = $this->input->post("idLector");
    	$nombres      = $this->input->post("nombres");
        $apellidos        = $this->input->post("apellidos");
        $tipo_documento_id      = $this->input->post("tipo_documento_id");
        $tipo_lector_id   = $this->input->post("tipo_lector_id");
        $telefono       = $this->input->post("telefono");
        $num_documento = $this->input->post("num_documento");
        $distrito_provincia = $this->input->post("distrito_provincia");

        $lectorActual = $this->Lectores_model->getLector($idLector);
        $is_unique = "";
        if ($lectorActual->num_documento != $num_documento) {
            $is_unique = "|is_unique[lectores.num_documento]";
        }

        $this->form_validation->set_rules('num_documento', 'Codigo Topografico', 'trim|required'.$is_unique, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idLector);
        } else {
          
            $dataLector = array(
                'nombres'    => $nombres,
                'apellidos'         => $apellidos,
                'num_documento'                 => $num_documento,
                'tipo_documento_id'             => $tipo_documento_id,
                'tipo_lector_id'                => $tipo_lector_id,
                'telefono'          => $telefono,
                'direccion'             => $direccion,
                'distrito_provincia'             => $distrito_provincia,
            );

            if ($this->Lectores_model->update($idLector,$dataLector)) {
            	$this->session->set_flashdata("success","La informacion del lector fue actualizada correctamente");
                redirect(base_url() . "lectores");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "lectores/edit/".$idLector);
            }
        }
    }

    public function comprobardocumento()
    {
        $num_documento = $this->input->post("num_documento");
        $res = $this->Lectores_model->comprobardocumento($num_documento);
        if ($res) {
            if ($res->estado == 1) {
                echo json_encode($res);
            } else {
                echo "na"; // not available
            }

        } else {
            echo "nf"; // not found
        }
    }
}

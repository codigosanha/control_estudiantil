<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct(){
		parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
		$this->load->model('Categorias_model');
	}


	public function index()
	{
		$contenido_interno = array(
            'categorias' => $this->Categorias_model->getcategorias(),
        );

        $contenido_exterior = array(
            'title'     => 'Catalogo de categorias',
            'contenido' => $this->load->view('categorias/list', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function add(){
        $contenido_exterior = array(
            'title'     => 'Agregar categoria',
            'contenido' => $this->load->view('categorias/add', '', true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function store(){
		$codigo      = $this->input->post("codigo");
        $nombre        = $this->input->post("nombre");

        $this->form_validation->set_rules('codigo', 'Codigo', 'trim|required|is_unique[categorias.codigo]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|is_unique[categorias.nombre]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $datacategoria = array(
                'codigo'    => $codigo,
                'nombre'        	=> $nombre,
            );

            if ($this->Categorias_model->save($datacategoria)) {
            	$this->session->set_flashdata("success","La Categoria fue registrado exitosamente");
                redirect(base_url() . "categorias/add");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "categorias/add");
            }
        }
	}

	public function edit($id)
    {
        $contenido_interno = array(
            'categoria'      => $this->Categorias_model->getCategoria($id),
            
        );

        $contenido_exterior = array(
            'title'     => 'Editar Categoria',
            'contenido' => $this->load->view('categorias/edit', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
    }

    public function update(){
        $idCategoria      = $this->input->post("idCategoria");
    	$nombre      = $this->input->post("nombre");
        $codigo      = $this->input->post("codigo");

        $categoriaActual = $this->Categorias_model->getCategoria($idCategoria);
        $is_unique_codigo = '';
        $is_unique_nombre = '';
        if ($categoriaActual->codigo != $codigo) {
            $is_unique_codigo = '|is_unique[categorias.codigo]';
        }
        if ($categoriaActual->nombre != $nombre) {
            $is_unique_nombre = '|is_unique[categorias.nombre]';
        }

        $this->form_validation->set_rules('codigo', 'Codigo', 'trim|required'.$is_unique_codigo, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required'.$is_unique_nombre, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idCategoria);
        } else {
          
            $datacategoria = array(
                'codigo'    => $codigo,
                'nombre'         => $nombre,
            );

            if ($this->Categorias_model->update($idCategoria,$datacategoria)) {
            	$this->session->set_flashdata("success","La informacion del categoria fue actualizada correctamente");
                redirect(base_url() . "categorias");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "categorias/edit/".$idcategoria);
            }
        }
    }

}

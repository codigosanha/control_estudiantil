<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libros extends CI_Controller {

	public function __construct(){
		parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
		$this->load->model('Libros_model');
		$this->load->model('Categorias_model');
	}


	public function index()
	{
		$contenido_interno = array(
            'libros' => $this->Libros_model->getLibros(),
        );

        $contenido_exterior = array(
            'title'     => 'Catalogo de Libros',
            'contenido' => $this->load->view('libros/list', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function add(){
		$contenido_interno = array(
            'categorias' => $this->Categorias_model->getCategorias(),
        );

        $contenido_exterior = array(
            'title'     => 'Agregar Libro',
            'contenido' => $this->load->view('libros/add', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function store(){
		$codigo_topografico      = $this->input->post("codigo_topografico");
        $codigo_barras        = $this->input->post("codigo_barras");
        $titulo      = $this->input->post("titulo");
        $autor       = $this->input->post("autor");
        $publicacion = $this->input->post("publicacion");
        $editorial   = $this->input->post("editorial");
        $ediccion    = $this->input->post("ediccion");
        $idioma      = $this->input->post("idioma");
        $ejemplares  = $this->input->post("ejemplares");
        $categoria_id  = $this->input->post("categoria_id");

        $this->form_validation->set_rules('codigo_topografico', 'Codigo Topografico', 'trim|required|is_unique[libros.codigo_topografico]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_rules('codigo_barras', 'Codigo de Barras', 'trim|required|is_unique[libros.codigo_barras]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_rules('titulo', 'Titulo', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('autor', 'Autor', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('ejemplares', 'Ejemplares', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('categoria_id', 'Categoria', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $config['upload_path']   = './assets/images/libros';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('imagen')) {
                $imagen = "default-book.png";
            } else {
                $data   = array('upload_data' => $this->upload->data());
                $imagen = $data["upload_data"]["file_name"];
            }

            $dataLibro = array(
                'codigo_topografico'    => $codigo_topografico,
                'codigo_barras'        	=> $codigo_barras,
                'titulo'      			=> $titulo,
                'autor'       			=> $autor,
                'año_publicacion' 			=> $publicacion,
                'editorial'   			=> $editorial,
                'ediccion'    			=> $ediccion,
                'idioma'      			=> $idioma,
                'ejemplares'  			=> $ejemplares,
                'prestados'   			=> 0,
                'categoria_id'       	=> $categoria_id,
                "imagen"      			=> $imagen,
            );

            if ($this->Libros_model->save($dataLibro)) {
            	$this->session->set_flashdata("success","El Libro fue registrado exitosamente");
                redirect(base_url() . "libros/add");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "libros/add");
            }
        }
	}

	public function edit($id)
    {
        $contenido_interno = array(
            'libro'      => $this->Libros_model->getLibro($id),
            'categorias' => $this->Categorias_model->getCategorias(),
        );

        $contenido_exterior = array(
            'title'     => 'Editar Libro',
            'contenido' => $this->load->view('libros/edit', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
    }

    public function update(){
    	$idLibro = $this->input->post("idLibro");
    	$codigo_topografico      = $this->input->post("codigo_topografico");
        $codigo_barras        = $this->input->post("codigo_barras");
        $titulo      = $this->input->post("titulo");
        $autor       = $this->input->post("autor");
        $publicacion = $this->input->post("publicacion");
        $editorial   = $this->input->post("editorial");
        $ediccion    = $this->input->post("ediccion");
        $idioma      = $this->input->post("idioma");
        $ejemplares  = $this->input->post("ejemplares");
        $categoria_id  = $this->input->post("categoria_id");
        $imagenLast  = $this->input->post("imagenLast");

        $libroActual = $this->Libros_model->getLibro($idLibro);
        $is_unique = '';
        if ($libroActual->codigo_topografico != $codigo_topografico) {
        	$is_unique = '|is_unique[libros.codigo_topografico]';
        }
        if ($libroActual->codigo_barras != $codigo_barras) {
            $is_unique = '|is_unique[libros.codigo_barras]';
        }

        $this->form_validation->set_rules('codigo_topografico', 'Codigo Topografico', 'trim|required'.$is_unique, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_rules('codigo_barras', 'Codigo de Barras', 'trim|required'.$is_unique, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_rules('titulo', 'Titulo', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('autor', 'Autor', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('ejemplares', 'Ejemplares', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('categoria_id', 'Categoria', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idLibro);
        } else {
            $config['upload_path']   = './assets/images/libros';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('imagen')) {
                $imagen = $imagenLast;
            } else {
                $data   = array('upload_data' => $this->upload->data());
                $imagen = $data["upload_data"]["file_name"];
            }

            $dataLibro = array(
                'codigo_topografico'    => $codigo_topografico,
                'codigo_barras'        	=> $codigo_barras,
                'titulo'      			=> $titulo,
                'autor'       			=> $autor,
                'año_publicacion' 			=> $publicacion,
                'editorial'   			=> $editorial,
                'ediccion'    			=> $ediccion,
                'idioma'      			=> $idioma,
                'ejemplares'  			=> $ejemplares,
                'prestados'   			=> 0,
                'categoria_id'       	=> $categoria_id,
                "imagen"      			=> $imagen,
            );

            if ($this->Libros_model->update($idLibro,$dataLibro)) {
            	$this->session->set_flashdata("success","La informacion del libro fue actualizada correctamente");
                redirect(base_url() . "libros");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "libros/edit/".$idLibro);
            }
        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestamos extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
		$this->load->model("Libros_model");
		$this->load->model("Lectores_model");
		$this->load->model("Prestamos_model");
	}

	public function index(){
		$contenido_interno = array(
            'prestamos' => $this->Prestamos_model->getPrestamos(),
        );

        $contenido_exterior = array(
            'title'     => 'Listado de Prestamos',
            'contenido' => $this->load->view('prestamos/list', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function add()
	{
		$contenido_interno = array(
            'libros' => $this->Libros_model->getLibros(),
        );
        $contenido_exterior = array(
            'title'     => 'Agregar Prestamos',
            'contenido' => $this->load->view('prestamos/add', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function store()
    {
        $idLibro     = $this->input->post("idLibro");
        $idLector    = $this->input->post("idLector");
        $fecprestamo = $this->input->post("fecprestamo");
        $fecdevolucion = $this->input->post("fecdevolucion");
        $hora = $this->input->post("hora");
        $infolibro   = $this->Libros_model->getLibro($idLibro);
        $datos       = array(
            "libro_id"        => $idLibro,
            "lector_id"       => $idLector,
            "fecha_prestamo"   => $fecprestamo,
            "fecha_devolucion"   => $fecdevolucion,
            "hora"   => $hora,
            "estado" => 0,
            "usuario_id"      => $this->session->userdata("id_user"),
        );
        if ($this->Prestamos_model->guardar($datos)) {
            $dataLibro = array(
                'prestados' => $infolibro->prestados + 1,
            );
            $dataLector = array(
                'estado' => 0,
            );
            $this->Lectores_model->update($idLector, $dataLector);
            $this->Libros_model->update($idLibro, $dataLibro);
            //$this->session->set_flashdata("msg_success","La categoria ".$nombre." ha sido registrado");
            redirect(base_url()."prestamos/pendientes");
        } else {
            //$this->session->set_flashdata("msg_error","La categoria ".$name." no pudo registrarse");
            redirect(base_url() . "backend/facultades/add");
        }
    }

    public function pendientes(){
    	$contenido_interno = array(
            'prestamos' => $this->Prestamos_model->getPrestamos(0),
        );

        $contenido_exterior = array(
            'title'     => 'Prestamos Pendientes',
            'contenido' => $this->load->view('prestamos/pendientes', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
    }
    public function update($idprestamo)
    {
        date_default_timezone_set('America/Lima');
        $res       = $this->Prestamos_model->getPrestamo($idprestamo);
        $infolibro = $this->Libros_model->getLibro($res->libro_id);

        $dataPrestamo = array(
            'fecha_entrega' => date('Y-m-d'),
            'estado' => 1,
        );
        if ($this->Prestamos_model->update($idprestamo, $dataPrestamo)) {
            $dataLibro = array(
                'prestados' => $infolibro->prestados - 1,
            );
            $dataLector = array(
                'estado' => 1,
            );

            if ($this->Libros_model->update($res->libro_id, $dataLibro) && $this->Lectores_model->update($res->lector_id, $dataLector)) {
                //$this->session->set_flashdata("msg_success","La informacion de la categoria  ".$name." se actualizo correctamente");
                redirect(base_url() . "prestamos");
            } else {
                //$this->session->set_flashdata("msg_error","La informacion de la categoria ".$name." no pudo actualizarse");
                redirect(base_url() . "prestamos");
            }
        } else {
            redirect(base_url() . "prestamos");
        }

    }

    public function renovar(){
        $prestamo = json_decode($this->input->post("prestamo"));
        $dataFinalizar = array(
            'fecha_entrega' => date('Y-m-d'),
            'estado' => 1,
        );
        if ($this->Prestamos_model->update($prestamo->id, $dataFinalizar)) {
            $fecha_prestamo = date('Y-m-d');
            $fecha_devolucion = strtotime ('+5 day', strtotime($fecha_prestamo));
            $fecha_devolucion = date ( 'Y-m-d' , $fecha_devolucion );
            $dataRegistrar = array(
                "libro_id"        => $prestamo->libro_id,
                "lector_id"       => $prestamo->lector_id,
                "fecha_prestamo"   => $fecha_prestamo,
                "fecha_devolucion"   => $fecha_devolucion,
                "hora"   => date("H:i"),
                "estado" => 0,
                "usuario_id"      => $this->session->userdata("id_user"),
                "renovacion" => 1
            );
            $this->Prestamos_model->guardar($dataRegistrar);
            echo "1";
            
        } else {
            echo "0";
        }
    }

    public function renovaciones(){
        $contenido_interno = array(
            'prestamos' => $this->Prestamos_model->getPrestamos(0,1),
        );

        $contenido_exterior = array(
            'title'     => 'Listado de Prestamos',
            'contenido' => $this->load->view('prestamos/renovaciones', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
    }
}

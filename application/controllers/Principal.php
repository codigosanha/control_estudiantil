<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->model('Usuarios_model');
        if (!$this->session->userdata('login')) {
            redirect(base_url()."auth");
        }
	}

	public function index()
	{
        $data = array(
            'title'     => 'Principal',
            'contenido' => $this->load->view('principal', '', true),
        );

        $this->load->view('template', $data);
	}

}

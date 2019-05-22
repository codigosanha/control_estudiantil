<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->model('Usuarios_model');
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
	}

	public function index()
	{
        $data = array(
            'title'     => 'Tablero Principal',
            'contenido' => $this->load->view('dashboard', '', true),
        );

        $this->load->view('template', $data);
	}

}

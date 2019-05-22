<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    protected $time_attempt = 300;
    protected $limit_attempts = 5;

	public function __construct(){
		parent::__construct();
        $this->load->model('Usuarios_model');
        //$this->session->set_userdata("attempts",0);
        if (!$this->session->userdata("attempts")) {
            $this->session->set_userdata("attempts",0);
            $this->session->set_userdata("add_time_last_attempt",0);
        }

        if ($this->session->userdata("add_time_last_attempt") > 0) {
            $add_time_last_attempt = $this->session->userdata("add_time_last_attempt");
            if (time() > $add_time_last_attempt) {
                $this->session->set_userdata("attempts",0);
                $this->session->unset_userdata('add_time_last_attempt');

            }
        }
	}

	public function login()
	{
        if ($this->session->userdata('login')) {
            redirect(base_url().'dashboard');
        }
		$this->load->view('auth/login');
	}

	public function validar(){
		$email = $this->input->post("email");
        $pass  = $this->input->post("password");
        $res = $this->Usuarios_model->logear($email, md5($pass));
        if ($res) {
            $this->session->unset_userdata(['attempts','add_time_last_attempt']);
            $data = array(
                'id_user' => $res->id,
                'user'    => $res->nombres,
                'login'   => true,
            );
            $this->session->set_userdata($data);
            redirect(base_url() . "dashboard");
        } else {
            $attempts = $this->session->userdata("attempts") + 1;
            $this->session->set_userdata("attempts",$attempts);
            if ($attempts == $this->limit_attempts) {
                $this->session->set_userdata("add_time_last_attempt",time() + $this->time_attempt);
            }
            $this->session->set_flashdata("error","<span><strong>Lo sentimos,</strong> el email y contraseña ingresados no coinciden con nuestros registros</span>");
            redirect(base_url());
        }
	}

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }
}

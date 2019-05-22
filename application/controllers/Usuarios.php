<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct(){
		parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
		$this->load->model('Usuarios_model');
	}


	public function index()
	{
		$contenido_interno = array(
            'usuarios' => $this->Usuarios_model->getUsuarios(),
        );

        $contenido_exterior = array(
            'title'     => 'Listado de usuarios',
            'contenido' => $this->load->view('usuarios/list', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function add(){
		$contenido_exterior = array(
            'title'     => 'Agregar Lector',
            'contenido' => $this->load->view('usuarios/add', '', true),
        );
        $this->load->view('template', $contenido_exterior);
	}

	public function store(){
		$nombres      = $this->input->post("nombres");
        $apellidos        = $this->input->post("apellidos");
        $email      = $this->input->post("email");
        $dni   = $this->input->post("dni");
        $telefono       = $this->input->post("telefono");
        $password       = $this->input->post("password");

        $this->form_validation->set_rules('dni', 'Numero de Documento', 'trim|required|is_unique[usuarios.dni]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[usuarios.email]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $dataUsuario = array(
                'nombres'    => $nombres,
                'apellidos'        	=> $apellidos,
                'dni'      			=> $dni,
                'telefono'   			=> $telefono,
                'password' 			=> md5($password),
                'email'   			=> $email,
            );

            if ($this->Usuarios_model->save($dataUsuario)) {
            	$this->session->set_flashdata("success","El Usuario fue registrado exitosamente");
                redirect(base_url() . "usuarios/add");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "usuarios/add");
            }
        }
	}

	public function edit($id)
    {
        $contenido_interno = array(
            'usuario'      => $this->Usuarios_model->getUsuario($id),
        );

        $contenido_exterior = array(
            'title'     => 'Editar Usuario',
            'contenido' => $this->load->view('usuarios/edit', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
    }

    public function update(){
        $idUsuario  = $this->input->post("idUsuario");
    	$nombres    = $this->input->post("nombres");
        $apellidos  = $this->input->post("apellidos");
        $email      = $this->input->post("email");
        $dni        = $this->input->post("dni");
        $telefono   = $this->input->post("telefono");
        $password   = $this->input->post("password");
        $changePassword   = $this->input->post("checkChangePassword");



        $usuarioActual = $this->Usuarios_model->getUsuario($idUsuario);
        $is_unique_email = '';
        $is_unique_dni = '';
        if ($usuarioActual->email != $email) {
            $is_unique_email = '|is_unique[usuarios.email]';
        }
        if ($usuarioActual->dni != $dni) {
            $is_unique_dni = '|is_unique[usuarios.dni]';
        }

        if (empty($changePassword)) {
            $password = $usuarioActual->password;
        }else{
            $password = md5($password);
        }
        $this->form_validation->set_rules('dni', 'Numero de Documento', 'trim|required'.$is_unique_dni, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required'.$is_unique_email, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idUsuario);
        } else {
          
            $dataUsuario = array(
                'nombres'    => $nombres,
                'apellidos'  => $apellidos,
                'dni'        => $dni,
                'telefono'   => $telefono,
                'email'      => $email,
                'password'   => $password
            );

            if ($this->Usuarios_model->update($idUsuario,$dataUsuario)) {
            	$this->session->set_flashdata("success","La informacion del Usuario fue actualizada correctamente");
                redirect(base_url() . "usuarios");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "usuarios/edit/".$idLector);
            }
        }
    }

    public function delete(){
        $idUsuario = $this->input->post("id");
        if ($this->Usuarios_model->delete($idUsuario)) {
            echo "1";
        } else {
            echo "0";
        }
    }
}

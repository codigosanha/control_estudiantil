<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiantes extends CI_Controller {

	public function __construct(){
		parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model("Estudiantes_model");
        $this->load->helper("functions");
	}


	public function index()
	{
		$contenido_interno = array(
            'estudiantes' => $this->Backend_model->get_records('estudiantes'),
        );

        $contenido_exterior = array(
            'title'     => 'Listado de Estudiantes',
            'contenido' => $this->load->view('estudiantes/list', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function add(){

        $contenido_interno = array(
            'especialidades' => $this->Backend_model->get_records('especialidades'),
        );

        $contenido_exterior = array(
            'title'     => 'Agregar Estudiante',
            'contenido' => $this->load->view('estudiantes/add', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
	}

	public function store(){
        $nombres        = $this->input->post("nombres");
        $apellidos        = $this->input->post("apellidos");
        $especialidad_id        = $this->input->post("especialidad_id");
        $semestre        = $this->input->post("semestre");
        $dni        = $this->input->post("dni");

        $this->form_validation->set_rules('dni', 'DNI', 'trim|required|is_unique[estudiantes.dni]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'El %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $dataEstudiante = array(
                'nombres'        	=> $nombres,
                'apellidos'            => $apellidos,
                'semestre'            => $semestre,
                'dni'            => $dni,
                'especialidad_id'            => $especialidad_id,
            );
            $resp = $this->Backend_model->insert('estudiantes',$dataEstudiante);
            if ($resp) {

                $this->saveEstudianteModulos($resp);

            	$this->session->set_flashdata("success","El Estudiante fue registrado exitosamente");
                redirect(base_url() . "estudiantes");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "estudiantes/add");
            }
        }
	}

    public function saveEstudianteModulos($objEstudiante){
        $modulos = $this->Backend_model->get_records('modulos',"especialidad_id = $objEstudiante->especialidad_id");
        foreach ($modulos as $modulo) {
            $dataEstudianteModulo  = array(
                'estudiante_id' => $objEstudiante->id,
                'modulo_id' => $modulo->id 
            );

            $this->Backend_model->insert('estudiantes_modulos', $dataEstudianteModulo);
        }
    }

	public function edit($id)
    {
        $contenido_interno = array(
            'estudiante'      => $this->Backend_model->get_record('estudiantes',"id=$id"),
            'especialidades' => $this->Backend_model->get_records('especialidades')
            
        );

        $contenido_exterior = array(
            'title'     => 'Editar Estudiante',
            'contenido' => $this->load->view('estudiantes/edit', $contenido_interno, true),
        );

        $this->load->view('template', $contenido_exterior);
    }

    public function update(){
        $idEstudiante      = $this->input->post("idEstudiante");
    	$nombres      = $this->input->post("nombres");
        $apellidos      = $this->input->post("apellidos");
        $dni      = $this->input->post("dni");
        $semestre      = $this->input->post("semestre");
        $especialidad_id      = $this->input->post("especialidad_id");

        $estudianteActual = $this->Backend_model->get_record('estudiantes',"id=$idEstudiante");
        $is_unique_dni = '';
        if ($estudianteActual->dni != $dni) {
            $is_unique_dni = '|is_unique[estudiantes.dni]';
        }

        $this->form_validation->set_rules('dni', 'DNI', 'trim|required'.$is_unique_dni, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'El %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idEstudiante);
        } else {

            $estudiante = $this->Backend_model->get_record('estudiantes',"id=$idEstudiante");
          
            $dataEstudiante = array(
                'nombres'           => $nombres,
                'apellidos'            => $apellidos,
                'semestre'            => $semestre,
                'dni'            => $dni,
                'especialidad_id'            => $especialidad_id,
            );

            $changeEspecialidad = 0;

            if ($estudiante->especialidad_id != $especialidad_id) {
                $changeEspecialidad = 1;
                $this->Backend_model->delete('estudiantes_modulos',"estudiante_id = $idEstudiante");
            }

            if ($this->Backend_model->update('estudiantes',"id=$idEstudiante",$dataEstudiante)) {

                if ($changeEspecialidad) {
                    $estudianteModificado = $this->Backend_model->get_record('estudiantes',"id=$idEstudiante");
                    $this->saveEstudianteModulos($estudianteModificado);
                }
                

            	$this->session->set_flashdata("success","La informacion de la Especialidad fue actualizada correctamente");
                redirect(base_url() . "estudiantes");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "estudiantes/edit/".$idModulo);
            }
        }
    }


    public function getInfoEstudiante(){
        $valor = $this->input->post("valor");
        $estudiantes = $this->Estudiantes_model->getInfoEstudiante($valor);

        $data  = array();

        foreach ($estudiantes as $e) {
            $dataEstudiante['id'] = $e->id;
            $dataEstudiante['nombres'] = $e->nombres;
            $dataEstudiante['apellidos'] = $e->apellidos;
            $dataEstudiante['dni'] = $e->dni;
            $dataEstudiante['label'] = $e->dni ." - ".$e->nombres." ".$e->apellidos;
            $dataEstudiante['semestre'] = getNumeroRomano($e->semestre);
            $dataEstudiante['especialidad'] = getEspecialidad($e->especialidad_id)->nombre;
            $modulos = $this->Estudiantes_model->getModulos($e->id);
            $dataEstudiante['modulos'] = $modulos;

            $data [] = $dataEstudiante;
        }

        echo json_encode($data);
    }

}

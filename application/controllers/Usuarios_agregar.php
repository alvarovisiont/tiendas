<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_agregar extends CI_Controller 
{
	public function index()
	{
		$this->session->set_userdata('nivel', 1);
		
		if(!$this->session->has_userdata('nivel'))
		{
			$this->load->view("login");		
		}
		else
		{
			$this->load->model('Auditoria_Model');
			$ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));
			$array = ['hora_desconexion' => $ahora];
			$this->Auditoria_Model->grabar_ultima_conexion($array);
			
			$this->load->model('Usuarios_model');
			$datos = $this->Usuarios_model->traer_usuarios();
			$this->load->view("encabezado");
			$this->load->view("usuarios_agregar", compact('datos'));
			$this->load->view('footer_usuarios');
		}
	}

	public function agregar_usuarios()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model('Usuarios_model');
			$array = [
				'usuario' => $this->input->post('usuario'),
				'clave' => $this->input->post('clave'),
				'nivel' => $this->input->post('perfil')
			];
			$datos = $this->Usuarios_model->agregar($array);
			if($datos != "repetido")
			{
				$array = ['exito' => "agregado con exito"];
				echo json_encode($array);
			}
			else
			{
				$array = ['registrado' => "Ya existe un usuario con este nombre"];
				echo json_encode($array);
			}
		}
	}
}
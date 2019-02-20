<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_agregar extends CI_Controller 
{
	public function index()
	{
		if(!$this->session->has_userdata('nivel'))
		{
			$this->load->view("login");		
		}
		else
		{
			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();
			
			$this->load->model('Usuarios_Model');
			$datos = $this->Usuarios_Model->traer_usuarios();
			$this->load->view("encabezado");
			$this->load->view("usuarios_agregar", compact('datos'));
			$this->load->view('footer_usuarios');
		}
	}

	public function agregar_usuarios()
	{
		if($this->input->is_ajax_request())
		{

			
			$telefono = $this->input->post('telefono');
			$comision = $this->input->post('comision');
			$sueldo   = $this->input->post('sueldo');

			$this->load->model('Usuarios_Model');

			$array = [
				'usuario' => $this->input->post('usuario'),
				'clave' => $this->input->post('clave'),
				'nivel' => $this->input->post('perfil'),
				'nombre_apellido' => $this->input->post('nombre_apellido'),
				'telefono' => $telefono ? $telefono : null ,
				'comision' => $comision ? $comision : null,
				'sueldo' => $sueldo ? $sueldo : null
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
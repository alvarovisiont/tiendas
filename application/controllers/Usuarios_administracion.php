<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_administracion extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct();
         
         $this->load->model("Usuarios_Model"); 
	}

	public function index()
	{	
		
		if($this->session->has_userdata('nivel'))
		{	
			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();
			
			$datos = $this->Usuarios_Model->traer_usuarios();
			$this->load->view("encabezado");
			$this->load->view("administracion_usuarios", compact('datos'));
			$this->load->view('footer_usuarios');
		}
	}

	public function modificar()
	{
		$id = $this->input->post('id_modificar');
		$array = [
			'usuario' => $this->input->post('usuario_modi'),
			'clave' => $this->input->post('clave_modi'),
			'nivel' => $this->input->post('perfil_modi'),
			'nombre_apellido' => $this->input->post('nombre_apellido_modi'),
			'sueldo' => $this->input->post('sueldo_modi'),
			'telefono' => $this->input->post('telefono_modi'),
			'comision' => $this->input->post('comision_modi')
		];

		$this->Usuarios_Model->modificar($id, $array);
		redirect(base_url()."Usuarios_administracion");
	}

	public function eliminar()
	{
		$id = $this->uri->segment(3);
		$this->Usuarios_model->eliminar($id);
		redirect(base_url()."Usuarios_administracion");
	}
}
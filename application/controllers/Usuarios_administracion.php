<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_administracion extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct();
         
         $this->load->model("Usuarios_model"); 
	}

	public function index()
	{	
		$this->session->set_userdata('nivel', 1);
		
		if($this->session->has_userdata('nivel'))
		{	
			$this->load->model('Auditoria_Model');
			$ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));
			$array = ['hora_desconexion' => $ahora];
			$this->Auditoria_Model->grabar_ultima_conexion($array);
			
			$datos = $this->Usuarios_model->traer_usuarios();
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
			'nivel' => $this->input->post('perfil_modi')
		];

		$this->Usuarios_model->modificar($id, $array);
		redirect(base_url()."Usuarios_administracion");
	}

	public function eliminar()
	{
		$id = $this->uri->segment(3);
		$this->Usuarios_model->eliminar($id);
		redirect(base_url()."Usuarios_administracion");
	}
}
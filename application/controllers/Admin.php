<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	function __Construct()
	{
          
    parent:: __Construct(); 
    $this->load->model(["Admin_Model","Usuarios_Model"]); 
	}

	public function index()
	{
		//if($this->session->has_userdata('nivel'))
		if(1==1)
		{

			$this->load->model('Empleados_Model');

			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();

			$datos = $this->Admin_Model->traer_datos();
			$data = $this->Admin_Model->traer_compras_ventas();
			$empleados = $this->Usuarios_Model->traer_trabajadores();

			$this->load->view("encabezado");
			$this->load->view("admin", compact('datos', 'empleados'));
			$this->load->view("footer_admin", compact('data'));
		}
		else
		{
			$this->load->view("login");
		}
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	function __Construct()
	{
          
    parent:: __Construct(); 
    $this->load->model(["Admin_Model","Empleados_Model"]); 
	}

	public function index()
	{
		if($this->session->has_userdata('nivel'))
		{

			$this->load->model('Empleados_Model');

			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();

			$datos = $this->Admin_Model->traer_datos();
			$data = $this->Admin_Model->traer_compras_ventas();
			$empleados = $this->Empleados_Model->traer_datos();

			$this->load->view("encabezado");
			$this->load->view("admin", compact('datos', 'empleados'));
			$this->load->view("footer_admin", compact('data'));
		}
		else
		{

			$this->load->model('Empleados_Model');

			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();

			$datos = $this->Admin_Model->traer_datos();
			$data = $this->Admin_Model->traer_compras_ventas();
			$empleados = $this->Empleados_Model->traer_datos();

			$this->load->view("encabezado");
			$this->load->view("admin", compact('datos', 'empleados'));
			$this->load->view("footer_admin", compact('data'));

			//$this->load->view("login");
		}
	}
}
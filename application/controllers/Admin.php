<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	 public function __construct() {
         parent:: __Construct(); 
         $this->load->model(["Admin_Model","Empleados_Model"]); 
        
    }



	public function index()
	{
		if($this->session->userdata('nivel') == 1 )
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
			$this->load->view("login");
		}
	}
}
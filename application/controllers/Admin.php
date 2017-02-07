<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function index()
	{
		if($this->session->has_userdata('nivel'))
		{

			$this->load->model('Admin_Model');
			$this->load->model('Empleados_Model');

			$this->load->model('Auditoria_Model');
			$ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));
			$array = ['hora_desconexion' => $ahora];
			$this->Auditoria_Model->grabar_ultima_conexion($array);

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
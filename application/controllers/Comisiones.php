<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comisiones extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
          $array = ['Comision_Model','Auditoria_Model'];
          $this->load->model($array);
	}

	public function index(){
		$data = $this->Comision_Model->get();
		$datos= $this->Comision_Model->get_total_by_month();

		$this->load->model('Auditoria_Model');
		$this->Auditoria_Model->grabar_ultima_conexion();
		
		$this->load->view("encabezado");
		$this->load->view("comision", compact('data','datos'));
		$this->load->view("footer");

	}

}
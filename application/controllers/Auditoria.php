<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditoria extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
          $this->load->model("Auditoria_Model"); 
	}

	public function index()
	{
		$this->session->set_userdata('nivel', 1);
		$datos = $this->Auditoria_Model->traer_datos();
		$this->load->view('encabezado');
		$this->load->view('auditoria', compact('datos'));
		$this->load->view('footer');
	}
}
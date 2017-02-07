<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja_chica extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
	}

	public function index()
	{
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
			
			$this->load->model("Caja_chica_Model"); 
			$cajas_chicas = $this->Caja_chica_Model->traer_datos();
			$this->load->view('encabezado_descuentos');
			$this->load->view('caja_chica', compact('cajas_chicas'));
			$this->load->view('footer_caja_chica');
		}
	}

	public function agregar()
	{
		$this->load->model("Caja_chica_Model");
		$arreglo = ['nombre' => $this->input->post('nombre_caja', TRUE),
					'monto' => $this->input->post('monto_caja', TRUE)];
		$this->Caja_chica_Model->agregar($arreglo);
		redirect(base_url().'Caja_chica');
	}
}
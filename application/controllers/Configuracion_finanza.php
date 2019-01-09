<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_finanza extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
	}

	public function index()
	{	
		$this->session->set_userdata('nivel', 1);
		if($this->session->has_userdata('nivel'))
		{
			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();
			
			$this->load->model('Configuracion_Finanza_Model');
			$datos = $this->Configuracion_Finanza_Model->traer_datos();
			$this->load->view('encabezado_descuentos');
			$this->load->view('configuracion_finanza', compact('datos'));
			$this->load->view('footer_configuracion_finanza');
		}
		else
		{
			return view('login');
		}
			
	}

	public function grabar()
	{
		$array = [
					'siglas' => $this->input->post('siglas', TRUE),
					'iva' => $this->input->post('iva', TRUE),
					'retencion' => $this->input->post('retencion', TRUE),
					'dolar_value' => $this->input->post('dolar_value', TRUE),
				];
		$this->load->model('Configuracion_Finanza_Model');

		$this->Configuracion_Finanza_Model->grabar($array);

		redirect(base_url().'Configuracion_finanza');
	}

	public function modificar()
	{
		$id = $this->input->post('id_modificar');

		$array = [
					'siglas' => $this->input->post('siglas_modi', TRUE),
					'iva' => $this->input->post('iva_modi', TRUE),
					'retencion' => $this->input->post('retencion_modi', TRUE),
					'dolar_value' => $this->input->post('dolar_value_modi', TRUE)
				];
		$this->load->model('Configuracion_Finanza_Model');

		$this->Configuracion_Finanza_Model->modificar($array, $id);

		redirect(base_url().'Configuracion_finanza');	
	}

}
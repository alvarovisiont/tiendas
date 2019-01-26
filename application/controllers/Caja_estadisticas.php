<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja_estadisticas extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
	}

	public function index()
	{
		$this->session->set_userdata('nivel', 1);
		
		if(!$this->session->has_userdata('nivel'))
		{
			$this->load->view("login");		
		}
		else
		{
			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();
			
			$this->load->model("Caja_Model"); 
			$año = date('Y');
			$mes = date('m');
			$estadistica_dia = $this->Caja_Model->saldo_estadistica_dia($mes, $año);
			$estadistica_mes = $this->Caja_Model->saldo_estadistica_mes($año);
			$estadistica_año = $this->Caja_Model->saldo_estadistica_año($año);
			
			$this->load->view("encabezado");
			$this->load->view("caja_estadisticas");
			$this->load->view("footer_caja_estadistica", compact('estadistica_mes', 'estadistica_año', 'estadistica_dia'));
		}	
	}

	public function traer_graficos_mes()
	{
		$año = $this->input->get('año');

		$this->load->model("Caja_Model");

		$datos = $this->Caja_Model->saldo_estadistica_mes($año);
		if($datos != false)
		{
			$array = "";
			foreach ($datos as $row) 
			{
				$array = $datos;
			}
			echo json_encode($array);
		}
		else
		{
			echo "fallido";
		}

	}

	public function traer_graficos_dias()
	{
		$this->load->model("Caja_Model");
		
		$año = $this->input->get('año');
		$mes = $this->input->get('mes');
		$estadistica_dia = $this->Caja_Model->saldo_estadistica_dia($mes, $año);
		if($estadistica_dia != false)
		{
			$array = [];
			foreach ($estadistica_dia as $row)
			{
				$array[] = $row;
			}
			echo json_encode($array);
		}
		else
		{
			echo "fallido";
		}
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_estadisticas extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
          
          $this->load->model('Compras_Model');
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

			$año = date('Y');
			$mes = date('m', strtotime('-5 hour'));
			$estadistica_dia = $this->Compras_Model->graficas_estadisticas_dia($mes, $año);
			$estadistica_mes = $this->Compras_Model->grafico_estadistica_mes($año);
			$estadistica_año = $this->Compras_Model->grafico_estadistica_año();
			$this->load->view("encabezado");
			$this->load->view("compras_grafico");
			$this->load->view("footer_compras_estadisticas", compact('estadistica_mes', 'estadistica_año', 'estadistica_dia'));
		}
	}

	public function traer_graficos_mes()
	{
		$año = $this->input->get('año');

		$datos = $this->Compras_Model->grafico_estadistica_mes($año);
		if($datos != false)
		{
			echo json_encode($datos);
		}
		else
		{
			echo "fallido";
		}
	}

	public function traer_graficos_dias()
	{
		
		$año = $this->input->get('año');
		$mes = $this->input->get('mes');
		$estadistica_dia = $this->Compras_Model->graficas_estadisticas_dia($mes, $año);
		if($estadistica_dia != false)
		{
			echo json_encode($estadistica_dia);
		}
		else
		{
			echo "fallido";
		}
	}
 }
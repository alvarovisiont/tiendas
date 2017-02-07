<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
          $this->load->model("Caja_Model"); 
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
			
			$mes = date('m');
			$datos = $this->Caja_Model->traer_datos($mes);
			$monto = $this->Caja_Model->saldo($mes);
			$monto = $monto->total_monto - $monto->total_vuelto;
			$this->load->view("encabezado");
			$this->load->view("caja", compact('datos', 'monto'));
			$this->load->view("footer_caja");
		}	
	}

	public function detalles_venta()
	{
		$id_venta = $this->input->get('id_venta');
		$datos = $this->Caja_Model->detalle_venta($id_venta);
		if($datos != false)
		{
			foreach ($datos as $row)
			{
				$array[] = $row; 	
			}
			echo json_encode($array);
		}
		else
		{
			$array = ['fallido' => "vacio"];
			echo json_encode($array);
		}
	}

	public function detalles_cliente()
	{
		$id_venta = $this->input->get('id_venta');
		$datos = $this->Caja_Model->detalle_cliente($id_venta);
		if($datos != false)
		{
			echo json_encode($datos);
		}
		else
		{
			echo "fallido";
		}
	}
}
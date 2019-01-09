<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct();
         
         $this->load->model("Clientes_Model"); 
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
			
			$datos = $this->Clientes_Model->traer_datos();
			$this->load->view("encabezado");
			$this->load->view("clientes", compact('datos'));
			$this->load->view("footer_clientes");
		}
	}

	public function traer_articulos()
	{
		$id_venta = $this->input->get('id_venta');
		$datos = $this->Clientes_Model->traer_articulos($id_venta);
		if($datos != false)
		{
			$array = [];
			foreach ($datos as $row) 
			{
				$array[] = $row;
			}
			echo json_encode($array);
		}
		else
		{
			$array = ['fallido' => "El array esta vacio"];
			echo json_encode($array);
		}
	}
}
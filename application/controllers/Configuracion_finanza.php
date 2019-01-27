<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_finanza extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
          $this->load->model(["Inventario_Model",'Configuracion_Finanza_Model']); 
	}

	public function index()
	{	
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

		$this->load->model('Configuracion_Finanza_Model');
		$datos = $this->Configuracion_Finanza_Model->traer_datos();

		$array = [
					'siglas' => $this->input->post('siglas_modi', TRUE),
					'iva' => $this->input->post('iva_modi', TRUE),
					'retencion' => $this->input->post('retencion_modi', TRUE),
					'dolar_value' => $this->input->post('dolar_value_modi', TRUE),
					'dolar_today' => $this->input->post('dolar_today_modi', TRUE)
				];
		$this->load->model('Configuracion_Finanza_Model');

		$this->Configuracion_Finanza_Model->modificar($array, $id);


		if ($datos->retencion <>  $this->input->post('retencion_modi', TRUE))
		   {
		   	//cambiar el precio de venta de el inventario

		   	echo $this->input->post('retencion_modi', TRUE)."ssss";

		   	$inventario = $this->Inventario_Model->traer_datos();

		   	foreach ($inventario as $row){

		   		$valor_nuevo = 0;
		   		$valor_nuevo = $row->precio_proveedor * $this->input->post('retencion_modi', TRUE);
		   		$valor_nuevo = $valor_nuevo / 100;
		   		$valor_nuevo = $valor_nuevo + $row->precio_proveedor;

			    $dataInventario = ['precio' => $valor_nuevo];
		
				$id = $row->id;
				$this->Inventario_Model->modificar($id, $dataInventario);


		   	} 

		   	$this->load->model('Auditoria_Model');

				$accion_var =  "Configuración de Moneda ";

				$arreglito = ["accion" => $accion_var,
						      "motivo" => "Se cambio el porcentaje de ganancia de --> ". $datos->retencion." al monto nuevo --> ".$this->input->post('retencion_modi', TRUE),
						     ];
				
				$id = $this->Auditoria_Model->grabar_conexion_all($arreglito);

		 }  	
	

		$this->load->model('Auditoria_Model');

				$accion_var =  "Configuración de Moneda ";

				$arreglito = ["accion" => $accion_var,
						      "motivo" => "Cambio de moneda",
						     ];
				
				$id = $this->Auditoria_Model->grabar_conexion_all($arreglito);

		redirect(base_url().'Configuracion_finanza');	
	}

}
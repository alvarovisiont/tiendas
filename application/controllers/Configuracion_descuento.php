<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_descuento extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
	}

	public function index($error = null)
	{	
		if($this->session->has_userdata('nivel'))
		{
			 $this->session->set_flashdata('message','');
			
			$this->load->model('Configuracion_Descuento_Model');
			$datos = $this->Configuracion_Descuento_Model->traer_datos();

			$this->load->view('encabezado_descuentos');
			$this->load->view('configuracion_descuento', compact('datos'));
			$this->load->view('footer_descuento_nuevo');
		}
		else
		{
			return view('login');
		}
			
	}

	/*public function grabar()
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
	*/

	public function activar()
	{

		$this->load->model('Configuracion_Model');
		$empresa = $this->Configuracion_Model->traer_datos_empresa();

		$empresa->rif = 1234;

		if ($pass = $this->input->post('pass') == $empresa->rif)
		{
	
			$id = $this->input->post('id_modificar');
			$sw = $this->input->post('sw_modificar');

			$fecha = date('Y-m-d', strtotime("-5 hour"));

			if ($sw == 1){

				$array = [
					'cantidad' => $this->input->post('cantidad', TRUE),
					'status' => 1,
					'activacion' => $fecha,
				];	


				$accion_var =  "Configuración de Descuentos ";

				$arreglito = ["accion" => $accion_var,
						      "motivo" => "Activar Descuentos",
						     ];

			}

			if ($sw == 2){

				$array = [
					'cantidad' => 0,
					'status' => 0,
					'activacion' => $fecha,
				];	

				$accion_var =  "Configuración de Descuentos ";

				$arreglito = ["accion" => $accion_var,
						      "motivo" => "Desactivar Descuentos",
						     ];
			}
		
			

		$this->load->model('Configuracion_Descuento_Model');

		$this->Configuracion_Descuento_Model->modificar($array, $id);


		$this->load->model('Auditoria_Model');
	
				$id = $this->Auditoria_Model->grabar_conexion_all($arreglito);

		
		redirect(base_url().'Configuracion_descuento');	

		}else
		{

		
          $this->session->set_flashdata('message','Debe colocar la clave de autorización Correctamente');


		  redirect(base_url().'Configuracion_descuento');	

		}

	}

}
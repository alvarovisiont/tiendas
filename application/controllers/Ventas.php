<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include_once FCPATH.'\vendor\autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

class Ventas extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct(); 

          $array_model = ['Ventas_Model','Usuarios_Model','Comision_Model'];
          $array_model1= ['Configuracion_Finanza_Model','Banco_Model','Ventas_Historial_Model'];

          $this->load->model(array_merge($array_model,$array_model1));
	}

	public function index()
	{
		$this->session->set_userdata('nivel', 1);
		
		if($this->session->has_userdata('nivel'))
		{	
			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();
			
			$clientes = $this->Ventas_Model->traer_clientes();
			$articulos = $this->Ventas_Model->articulos_modal();
			$workers = $this->Usuarios_Model->traer_trabajadores();
			$bancos = $this->Banco_Model->get();
			$config = $this->Configuracion_Finanza_Model->traer_datos();
			$seller = $this->Usuarios_Model->getById($this->session->userdata('id'));

			$option_bancos = "<option>Seleccione</option>";
			foreach ($bancos as $row) {
				$option_bancos.= "<option value='$row->id'>$row->nombre</option>";
			}

			$this->Ventas_Model->eliminar_articulos_flotantes();
			$this->load->view("encabezado_compras");
			$this->load->view("ventas", compact('clientes', 'articulos','workers','option_bancos','seller'));
			$this->load->view("footer_ventas",compact('config'));
		}
		else
		{
			$this->load->view("login");
		}
	}

	public function buscar_clientes()
	{
		if($this->input->is_ajax_request())
		{
			sleep(2);
			$cedula = $this->input->post('cedula', TRUE);
			$string = $this->input->post('isString', TRUE);
			$datos = $this->Ventas_Model->buscar_clientes($cedula,$string);
			$array = [];
			if($datos != false)
			{
				echo json_encode($datos);
			}
			else
			{
				$array = ['vacio' => "Este cliente no se encuentra registrado, debe registrarlo"];
				echo json_encode($array);
			}
		}
	}

	public function traer_articulos()
	{
		$articulo = $this->input->post('art');
		$datos = $this->Ventas_Model->traer_articulos($articulo);
		$array = [];
		if($datos != false)
		{
			foreach ($datos as $row)
			{
				$array[] = $row->nombre;
			}
			echo json_encode($array);
		}
		else
		{
			echo "Error en la petición";
		}
	}

	public function agregar_tabla()
	{
		if($this->input->is_ajax_request())
		{
			$art = $this->input->post('articulo');
			$cantidad = $this->input->post('cantidad');
			$config = $this->Configuracion_Finanza_Model->traer_datos();

			$datos = $this->Ventas_Model->agregar_tabla($art, $cantidad,$config);
			if($datos != false && $datos != "Repetido")
			{
				echo json_encode($datos);
			}
			elseif($datos == "Repetido")
			{
				$array = ['repetido' => "Ya este artículo ha sido registrado"];
				echo json_encode($array);
			}
			elseif($datos == false)
			{	
				$array = ['inventario_insuficiente' => "No hay suficiente material en el inventario para realizar esta venta"];
				echo json_encode($array);
			}
		}
	}

	public function grabar_compra()
	{
		if($this->input->is_ajax_request())
		{

			$config = $this->Configuracion_Finanza_Model->traer_datos();

			$array_cliente = [
								'nombre' => $this->input->post('nombre_cliente', TRUE),
								'cedula' => $this->input->post('cedula_cliente', TRUE),
								'telefono' => $this->input->post('telefono_cliente', TRUE),
								'direccion' => $this->input->post('direccion_cliente', TRUE),
								'fecha_compra' => date('Y-m-d')
							];

			$vuelto = $this->input->post('vuelto');
			$tipo_venta = $this->input->post('metodo_pago');
			$monto_pagado  = $this->input->post('monto_pago');
		
			$arreglo_metodo_pago = [
				'monto_dolares' => $this->input->post('monto_dolares'),
				'nro_transferencia' => $this->input->post('nro_transferencia'),
				'banco_debito' => $this->input->post('banco_debito'),
				'banco_transferencia' =>  $this->input->post('banco_transferencia'),
				'dolar_value' => $config->dolar_value
			];

			$id_venta = $this->Ventas_Model->grabar_compra($monto_pagado, $tipo_venta, $vuelto,$arreglo_metodo_pago);
			
			$id_empleado = !empty($this->input->post('id_empleado')) ? $this->input->post('id_empleado') : $this->session->userdata('id');

			if(!empty($id_empleado)){
				
				$seller = $this->Usuarios_Model->getById($id_empleado);

				$sub_total_neto = $this->Ventas_Historial_Model->get_sub_total_sell($id_venta);

				$monto_comision = ($sub_total_neto->sub_total * $seller->comision) /100;

				$array_comision = [
					'id_empleado' => $id_empleado,
					'porcentaje' => $seller->comision,
					'monto' =>  $monto_comision,
					'id_venta' => $id_venta,
					'created_at' => date('Y-m-d H:i:s')
				];

				$this->Comision_Model->store($array_comision);
			}

			$this->Ventas_Model->agregar_clientes($array_cliente);
		}
	}

	public function imprimir_factura()
	{
		$datos = $this->Ventas_Model->buscar_cliente_factura();
		$data = $this->Ventas_Model->imprimir_factura();

		if($datos != false && $data != false)
		{

			$html = $this->load->view('imprimir_factura_ventas', compact('datos', 'data'), TRUE);
			
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', [190, 236] ] );
			$mpdf->WriteHTML($html);
			$mpdf->Output('Reporte de facturas.pdf', "I");
		}else
		{
			echo "Comuniquese con soporte del sistema";
		     die();
		}

	}

	public function eliminar_articulo()
	{
		$nombre = $this->input->post('nombre');
		$this->Ventas_Model->eliminar_articulo($nombre);
	}
}
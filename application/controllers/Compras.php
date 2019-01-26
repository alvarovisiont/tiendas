<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__ . '/../../vendor/autoload.php';


class Compras extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
          $array = ['Auditoria_Model','Compras_Model','Configuracion_Finanza_Model'];
          $this->load->model($array);
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
			$this->Auditoria_Model->grabar_ultima_conexion();

			 $proveedores = $this->Compras_Model->traer_proveedores();
			 $this->Compras_Model->eliminar_articulos_flotantes();

			 $this->load->view('encabezado_compras');
			 $this->load->view('compras', compact('proveedores'));
			 $this->load->view('footer_compras');
		}
	}

	public function traer_articulos()
	{
		$arreglo = [];
		
		$id = $this->input->post('id');
		$datos = $this->Compras_Model->traer_articulos($id);
		if($datos != false)
		{
			foreach ($datos as $row) 
			{
				$arreglo[] = $row;
			}
			echo json_encode($arreglo);
		}
		else
		{
			$arreglo['vacio'] = "No existen artículos relacionados con este proveedor";
			echo json_encode($arreglo);
		}
	}

	public function agregar_tabla()
	{
		$arreglo = [];
		$cantidad = $this->input->post('cantidad');
		$id_proveedor = $this->input->post('id_proveedor');
		$id_articulo = $this->input->post('id_articulo');
		$datos = $this->Compras_Model->agregar_tabla($id_proveedor, $id_articulo, $cantidad);
		if($datos != false && $datos != "Repetido")
		{
			foreach ($datos as $row) 
			{
				$arreglo = $datos;
			}


			$this->load->model('Auditoria_Model');

				$accion_var =  "Ingreso Compra en el sistema ";

				$arreglito = ["accion" => $accion_var,
						      "motivo" => "Compras",
						     ];
				
				$id = $this->Auditoria_Model->grabar_conexion_all($arreglito);


			echo json_encode($arreglo);
		}
		else if ($datos == "Repetido")
		{
			$arreglo['repetido'] = "No se puede agregar un artículo que ya ha sido agregado";
			echo json_encode($arreglo);
		}
		else
		{
			$arreglo['fallo'] = "operación fallida";
			echo json_encode($arreglo);	
		}
	}

	public function eliminar_articulo()
	{
		$nombre = $this->input->post('nombre');
		$this->Compras_Model->eliminar_articulo($nombre);
	}

	public function agregar_compra()
	{
		if($this->input->is_ajax_request())
		{
			if(!empty($this->input->post('accion')))
			{
				$total = $this->input->post('total');
				$this->Compras_Model->agregar_compra($total);
			}
		}
	}

	public function imprimir_factura()
	{
        $datos = $this->Compras_Model->imprimir_factura();
        $data = $this->Compras_Model->encabezado_factura();
        if($datos != "Error")
        {

			$html = $this->load->view('factura_compras', compact('datos', 'data'), TRUE);
			
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', [190, 236] ] );
			$mpdf->WriteHTML($html);
			$mpdf->Output('FacturaCompras.pdf', "I");
		
        }
        else
        {
        	echo "Comuniquese con soporte del sistema";
		     die();
        }
	}
}
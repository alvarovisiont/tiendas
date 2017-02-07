<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller 
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
			
			 $this->load->model('Compras_Model');	 
			 $proveedores = $this->Compras_Model->traer_proveedores();
			 $this->Compras_Model->eliminar_articulos_flotantes();
			 $this->load->view('encabezado_compras');
			 $this->load->view('compras', compact('proveedores', 'moneda'));
			 $this->load->view('footer_compras');
		}
	}

	public function traer_articulos()
	{
		$arreglo = [];
		$this->load->model('Compras_Model');	 
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
		$this->load->model('Compras_Model');	
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
		$this->load->model('Compras_Model');	
		$nombre = $this->input->post('nombre');
		$this->Compras_Model->eliminar_articulo($nombre);
	}

	public function agregar_compra()
	{
		if($this->input->is_ajax_request())
		{
			if(!empty($this->input->post('accion')))
			{
				$this->load->model('Compras_Model');
				$total = $this->input->post('total');
				$this->Compras_Model->agregar_compra($total);
			}
		}
	}

	public function imprimir_factura()
	{
		$this->load->model('Compras_Model');
        $datos = $this->Compras_Model->imprimir_factura();
        $data = $this->Compras_Model->encabezado_factura();
        if($datos != "Error")
        {

        	$html = $this->load->view('factura_compras', compact('datos', 'data'), TRUE);

        	//this the the PDF filename that user will get to download
        	$pdfFilePath = "Factura de Compras.pdf";
        	//load mPDF library
	        $this->load->library('m_pdf');
	 
	       //generate the PDF from the given html
	        $this->m_pdf->pdf->WriteHTML($html);
	 		
	 		//$this->m_pdf->pdf->setFooter('{PAGENO}');
	        //download it.
	        $this->m_pdf->pdf->Output($pdfFilePath, "I");
        }
        else
        {
        	print_r($datos);
        }
	}
}
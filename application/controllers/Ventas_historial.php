<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include_once FCPATH.'\vendor\autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

class Ventas_historial extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct(); 
          $this->load->model(['Ventas_Historial_Model','Configuracion_Finanza_Model']);
	}

	public function index()
	{
		$this->session->set_userdata('nivel', 1);
		
		if($this->session->has_userdata('nivel'))
		{
			$datos = $this->Ventas_Historial_Model->traer_datos_cliente();
			
			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();
			
			$conf = $this->Configuracion_Finanza_Model->traer_datos();

			$this->load->view('encabezado_inventario');
			$this->load->view('ventas_historial', compact('datos','conf'));
			$this->load->view('footer_ventas_historial','conf');
			
		}
	}

	public function traer_detalle()
	{
		$id_venta = $this->input->get('id_venta', TRUE);
		$datos = $this->Ventas_Historial_Model->traer_detalle($id_venta);
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
			echo "fallo";
		}
	}

	public function traer_cliente()
	{
		$id_buscar = $this->input->get('id_buscar');
		$datos = $this->Ventas_Historial_Model->traer_cliente($id_buscar);
		if($datos != false)
		{
			echo json_encode($datos);
		}
		else
		{
			echo "fallido";
		}
	}

	public function imprimir_factura()
	{

		$id_venta = $this->uri->segment(3);
		$datos = $this->Ventas_Historial_Model->buscar_cliente_factura($id_venta);
		$data = $this->Ventas_Historial_Model->detalles_compra_factura($id_venta);
		$config = $this->Configuracion_Finanza_Model->traer_datos();

		if($datos != false && $data != false)
		{

			$html = $this->load->view('imprimir_factura_ventas_seleccionada', compact('datos', 'data', 'config'), TRUE);
			
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', [190, 236] ] );
			$mpdf->WriteHTML($html);
			$mpdf->Output('Reporte de facturas.pdf', "I");
		}else
		{
			echo "ver3";
		     die();
		}
	}
}
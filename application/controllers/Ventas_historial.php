<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_historial extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct(); 
          $this->load->model('Ventas_Historial_Model');
	}

	public function index()
	{
		if($this->session->has_userdata('nivel'))
		{
			$datos = $this->Ventas_Historial_Model->traer_datos();
			
			$this->load->model('Auditoria_Model');
			$ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));
			$array = ['hora_desconexion' => $ahora];
			$this->Auditoria_Model->grabar_ultima_conexion($array);
		
			$this->load->view('encabezado_inventario');
			$this->load->view('ventas_historial', compact('datos'));
			$this->load->view('footer_ventas_historial');
			
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

		if($datos != false && $data != false)
		{
			$html = $this->load->view('imprimir_factura_ventas_seleccionada', compact('datos', 'data'), TRUE);
			
			$this->load->library('m_pdf');

			$this->m_pdf->pdf->WriteHTML($html);

			$this->m_pdf->pdf->Output('Reporte de facturas.pdf', "I");
		}
	}
}
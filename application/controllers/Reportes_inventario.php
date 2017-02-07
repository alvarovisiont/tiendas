<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_inventario extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct();
         
         $this->load->model("Inventario_Model"); 
	}

	public function index()
	{
		if($this->session->has_userdata('nivel'))
		{	
			$this->load->model('Auditoria_Model');
			$ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));
			$array = ['hora_desconexion' => $ahora];
			$this->Auditoria_Model->grabar_ultima_conexion($array);
			
			$datos = $this->Inventario_Model->traer_proveedores();
			$this->load->view('encabezado_inventario');
			$this->load->view('reportes_inventario_detallados', compact('datos'));
			$this->load->view('footer_reportes_inventario');
		}	
	}

	public function traer_reporte()
	{
		sleep(1.5);
		$proveedor = $this->input->get('proveedor');
		$fecha_desde = "";
		$fecha_hasta = "";
		if(!empty($this->input->get('fecha_desde')))
		{
			$fecha_desde = date('Y-m-d', strtotime($this->input->get('fecha_desde')));
		}
		if(!empty($this->input->get('fecha_hasta')))
		{
			$fecha_hasta = date('Y-m-d', strtotime($this->input->get('fecha_hasta')));
		}
		$cantidad_menor_que = $this->input->get('cantidad_menor_que');
		$cantidad_mayor_que = $this->input->get('cantidad_mayor_que');
		$where = [];

		if(!empty($proveedor))
		{
			$where["i.id_proveedor ="] = "$proveedor";
		}
		if(!empty($fecha_desde))
		{
			$where["i.fecha_agregado >"] = "$fecha_desde";
		}
		if(!empty($fecha_hasta))
		{
			$where["i.fecha_agregado <"] = "$fecha_hasta";	
		}
		if(!empty($cantidad_mayor_que))
		{
			$where["i.cantidad >"] = "$cantidad_mayor_que";		
		}
		if(!empty($cantidad_menor_que))
		{
			$where["i.cantidad <"] = "$cantidad_menor_que";			
		}
		$datos = $this->Inventario_Model->exportar_inventario_filtrado($where);
		if($datos != false)
		{
			$array = [];
			foreach ($datos as $row) 
			{
				$array[] = ['proveedor' => $row->proveedor,
							'nombre' => $row->nombre,
							'marca' => $row->marca,
							'grupo' => $row->grupo,
							'cantidad' => $row->cantidad,
							'precio_proveedor' => $row->precio_proveedor,
							'precio' => $row->precio,
							'fecha_agregado' => date('d-m-Y', strtotime($row->fecha_agregado))];
			}
			echo json_encode($array);
		}
		else
		{
			$array[] = ['vacio' => "No hay datos para mostrar que correspondan con esa busqueda"];
			echo json_encode($array);
		}
	}

	public function imprimir_excel()
	{
		$proveedor = base64_decode($this->input->get('proveedor'));
		$fecha_desde = "";
		$fecha_hasta = "";
		if(!empty(base64_decode($this->input->get('fecha_desde'))))
		{
			$fecha_desde = date('Y-m-d', strtotime(base64_decode($this->input->get('fecha_desde'))));
		}
		if(!empty(base64_decode($this->input->get('fecha_hasta'))))
		{
			$fecha_hasta = date('Y-m-d', strtotime(base64_decode($this->input->get('fecha_hasta'))));
		}
		$cantidad_menor_que = base64_decode($this->input->get('cantidad_menor_que'));
		$cantidad_mayor_que = base64_decode($this->input->get('cantidad_mayor_que'));
		$where = [];

		if(!empty($proveedor))
		{
			$where["i.id_proveedor ="] = "$proveedor";
		}
		if(!empty($fecha_desde))
		{
			$where["i.fecha_agregado >"] = "$fecha_desde";
		}
		if(!empty($fecha_hasta))
		{
			$where["i.fecha_agregado <"] = "$fecha_hasta";	
		}
		if(!empty($cantidad_mayor_que))
		{
			$where["i.cantidad >"] = "$cantidad_mayor_que";		
		}
		if(!empty($cantidad_menor_que))
		{
			$where["i.cantidad <"] = "$cantidad_menor_que";			
		}
		$datos = $this->Inventario_Model->exportar_inventario_filtrado($where);
		print_r($datos);
		if($datos != false)
		{
			$this->load->view('imprimir_inventario_excel', compact('datos'));
		}
	}

	public function imprimir_pdf()
	{
		$proveedor = base64_decode($this->input->get('proveedor'));
		$fecha_desde = "";
		$fecha_hasta = "";
		if(!empty(base64_decode($this->input->get('fecha_desde'))))
		{
			$fecha_desde = date('Y-m-d', strtotime(base64_decode($this->input->get('fecha_desde'))));
		}
		if(!empty(base64_decode($this->input->get('fecha_hasta'))))
		{
			$fecha_hasta = date('Y-m-d', strtotime(base64_decode($this->input->get('fecha_hasta'))));
		}
		$cantidad_menor_que = base64_decode($this->input->get('cantidad_menor_que'));
		$cantidad_mayor_que = base64_decode($this->input->get('cantidad_mayor_que'));
		$where = [];

		if(!empty($proveedor))
		{
			$where["i.id_proveedor ="] = "$proveedor";
		}
		if(!empty($fecha_desde))
		{
			$where["i.fecha_agregado >"] = "$fecha_desde";
		}
		if(!empty($fecha_hasta))
		{
			$where["i.fecha_agregado <"] = "$fecha_hasta";	
		}
		if(!empty($cantidad_mayor_que))
		{
			$where["i.cantidad >"] = "$cantidad_mayor_que";		
		}
		if(!empty($cantidad_menor_que))
		{
			$where["i.cantidad <"] = "$cantidad_menor_que";			
		}
		$datos = $this->Inventario_Model->exportar_inventario_filtrado($where);
		if($datos != false)
		{
			$html = $this->load->view('imprimir_inventario_pdf', compact('datos'), TRUE);
			$this->load->library('m_pdf');
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output('Inventario.pdf', "I");
		}
	}
}
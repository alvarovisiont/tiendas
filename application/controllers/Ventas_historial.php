<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include_once FCPATH.'\vendor\autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

class Ventas_historial extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct(); 
          $this->load->model(['Ventas_Historial_Model','Configuracion_Finanza_Model','Usuarios_Model']);
	}

	public function index()
	{
		if($this->session->has_userdata('nivel'))
		{

			if($this->session->userdata('nivel') == 1){		
				$datos = $this->Ventas_Historial_Model->traer_datos_cliente();
				$empleados = $this->Usuarios_Model->traer_trabajadores();
			}else{	
				$where= "usu.id = ".$this->session->userdata('id');

				$datos = $this->Ventas_Historial_Model->traer_datos_cliente_id($this->session->userdata('id'),$where);	
				$empleados = $this->Usuarios_Model->traer_trabajadores($this->session->userdata('id'));
			}

			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();
			
			$conf = $this->Configuracion_Finanza_Model->traer_datos();

			$select_worker = "<option value=''>Todos</option>";
			foreach ($empleados as $row) {
				$select_worker.="<option value='$row->id'>$row->nombre_apellido</option>";
			}

			$this->load->view('encabezado_inventario');
			$this->load->view('ventas_historial', compact('datos','conf','select_worker'));
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

	public function imprimir_factura(){

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

	public function get_registers_by_filter(){

		$desde = $this->input->get('desde');
		$hasta = $this->input->get('hasta');
		$worker = $this->input->get('worker');
		$status = $this->input->get('status');

		$where = null;

		if(!empty($desde)){
			$where = "( CAST(v.fecha_venta as DATE) >= '$desde'";
		}

		if(!empty($hasta)){
			if(!empty($where)){
				$where .= " AND CAST(v.fecha_venta as DATE) <= '$hasta' )";
			}else{
				$where = "CAST(v.fecha_venta as DATE) <= '$hasta'";
			}
		}else{
			if(!empty($where)){
				$where.= " )";
			}
		}

		if(!empty($worker)){
			if(!empty($where)){
				$where .= " AND v.id_usuario = $worker";
			}else{
				$where = "v.id_usuario = $worker";
			}	
		}

		if(!empty($status)){
			
			$status = $status == 1 ?  $status : 0;

			if(!empty($where)){
				$where .= " AND v.status = $status";
			}else{
				$where = "v.status = $status";
			}	
		}
		
		if(!empty($where)){
			$where.= " AND usu.id = ".$this->session->userdata('id');
		}else{
			$where.= "usu.id = ".$this->session->userdata('id');
		}

		if($this->session->userdata('nivel') == 1){		
				$datos = $this->Ventas_Historial_Model->traer_datos_cliente($where);
		}else{	
			$datos = $this->Ventas_Historial_Model->traer_datos_cliente_id($this->session->userdata('id'),$where);	
		}

			echo json_encode($datos);
	}


}
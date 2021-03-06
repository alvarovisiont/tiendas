<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
          $modelos = ["Caja_Model","Configuracion_Finanza_Model"];
          $this->load->model($modelos); 
	}

	public function index(){
		
		if(!$this->session->has_userdata('nivel')){
			redirect('Login','refresh');
		}else{
			
			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();
			
			$search = "CAST(t.fecha_venta AS DATE) = '".date('Y-m-d')."'";


			$totales_by_day = $this->Caja_Model->count_all_stadistics($search);
			
			$config = $this->Configuracion_Finanza_Model->traer_datos();

			$totales = $this->Caja_Model->count_all_stadistics();


			$totales_debito = $this->Caja_Model->count_all_debit($search);


			$totales_transferencia_dia = $this->Caja_Model->count_all_transfers($search);

			$totales->total_dolares = numbers_decimal_format($totales->total_dolares);

			$totales_by_day->total_dolares = numbers_decimal_format($totales_by_day->total_dolares);

			$totales_debito_all = $this->Caja_Model->count_all_debit();
			$totales_transferencia_all =  $this->Caja_Model->count_all_transfers();


			$array = ['totales' => $totales, 'config' => $config];
			$array1 = ['totales_day' => $totales_by_day,'transferencia_dia' => $totales_transferencia_dia,'debito_total' => $totales_debito];

			$data = array_merge($array,$array1);

			$data_footer = ['transferencia_dia' => $totales_transferencia_all,'config' => $config,'debito_total' => $totales_debito_all];



			$this->load->view("encabezado_inventario");
			$this->load->view("caja",$data);
			$this->load->view("footer_caja",$data_footer);
		}	
	}

	public function get_registers_by_filter(){
		
		$desde = $this->input->get('desde_filtro',true);
		$hasta = $this->input->get('hasta_filtro',true);
		$where = null;

		if(!empty($desde)){
			$where = "(CAST(t.fecha_venta AS DATE) >= '$desde')";
		}

		if(!empty($hasta)){
			if(!empty($where)){
				$where.= " AND (CAST(t.fecha_venta AS DATE) <= '$hasta')";
			}else{
				$where = "(CAST(t.fecha_venta AS DATE) <= '$hasta')";				
			}
		}

		$total_general = $this->Caja_Model->count_all_stadistics($where);
		$total_transfer_general = $this->Caja_Model->count_all_transfers($where);
		$total_debito = $this->Caja_Model->count_all_debit($where);

		echo json_encode(['general' => $total_general, 'total_transfer' => $total_transfer_general,'total_debito' => $total_debito]);

	}
}
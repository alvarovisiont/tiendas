<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__ . '/../../vendor/autoload.php';

class Comisiones extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
          $array = ['Comision_Model','Auditoria_Model','Usuarios_Model'];
          $this->load->model($array);
	}

	public function index(){

		if($this->session->userdata('nivel') == 1){		
			
			$data = $this->Comision_Model->get();
			$datos= $this->Comision_Model->get_total_by_month();
			$empleados = $this->Usuarios_Model->traer_trabajadores();

		}else{

			$data = $this->Comision_Model->get(null, null, $this->session->userdata('id'));
			$datos= $this->Comision_Model->get_total_by_month(null, null, $this->session->userdata('id'));
			$empleados = $this->Usuarios_Model->traer_trabajadores($this->session->userdata('id'));

		}

		$this->load->model('Auditoria_Model');
		$this->Auditoria_Model->grabar_ultima_conexion();
		
		$select_worker = "<option value=''>Todos</option>";
		foreach ($empleados as $row) {
			$select_worker.="<option value='$row->id'>$row->nombre_apellido</option>";
		}

		$this->load->view("encabezado");
		$this->load->view("comision", compact('data','datos','select_worker'));
		$this->load->view("footer_comision");

	}

	public function get_registers_by_date(){

		$desde = $this->input->get('desde');
		$hasta = $this->input->get('hasta');
		$worker = $this->input->get('worker');
		$varfechaDesde = "";
		$varfechaHasta = "";

		$where = null;

		if(!empty($desde)){
			$where = "( CAST(comision.created_at as DATE) >= '$desde'";
		


		}

		if(!empty($hasta)){
			if(!empty($where)){
				$where .= " AND CAST(comision.created_at as DATE) <= '$hasta' )";
			}else{
				$where = "CAST(comision.created_at as DATE) <= '$hasta'";
			}
		}else{
			if(!empty($where)){
				$where.= " )";
			}
		}

		if(!empty($worker)){
			if(!empty($where)){
				$where .= " AND id_empleado = $worker";
			}else{
				$where = "id_empleado = $worker";
			}	
		}

			

		if($this->session->userdata('nivel') == 1){
				
			$data = $this->Comision_Model->get(null,$where);
			$datos= $this->Comision_Model->get_total_by_month(null,$where);

	  }else{
			$data = $this->Comision_Model->get(null,$where, $this->session->userdata('id'));
			$datos= $this->Comision_Model->get_total_by_month(null,$where, $this->session->userdata('id'));
		}	
		echo json_encode(['individual' => $data, 'grupal' => $datos]);


	}


	public function pdf(){

		$desde =$this->input->post('desde', TRUE);
		$hasta = $this->input->post('hasta', TRUE);
		$worker = $this->input->post('worker', TRUE);
		$where = null;

		if(!empty($desde)){
			$where = "( CAST(comision.created_at as DATE) >= '$desde'";
		}

		if(!empty($hasta)){
			if(!empty($where)){
				$where .= " AND CAST(comision.created_at as DATE) <= '$hasta' )";
			}else{
				$where = "CAST(comision.created_at as DATE) <= '$hasta'";
			}
		}else{
			if(!empty($where)){
				$where.= " )";
			}
		}

		if(!empty($worker)){
			if(!empty($where)){
				$where .= " AND id_empleado = $worker";
			}else{
				$where = "id_empleado = $worker";
			}	
		}

			

		if($this->session->userdata('nivel') == 1){
				
			$data = $this->Comision_Model->get(null,$where);
			$datos= $this->Comision_Model->get_total_by_month(null,$where);
			$datos_anulate = $this->Comision_Model->get_total_by_month_anulate(null,$where);

	  }else{
			$data = $this->Comision_Model->get(null,$where, $this->session->userdata('id'));
			$datos= $this->Comision_Model->get_total_by_month(null,$where, $this->session->userdata('id'));
			$datos_anulate = $this->Comision_Model->get_total_by_month_anulate(null,$where, $this->session->userdata('id'));

		}	

		$data_by_month = [];

		foreach ($datos as $row) {
			
			foreach ($datos_anulate as $row1) {
				if(($row->mes === $row1->mes) && ($row->año === $row1->año) && 	($row->id_empleado === $row1->id_empleado)) {
					$row->total = $row->total - $row1->total;
				}
			}

			$data_by_month[] = $row;
		}

		$html = $this->load->view('imprimir_comisiones_venta', compact('$data_by_month', 'data'), TRUE);
			
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', [190, 236] ] );
			$mpdf->WriteHTML($html);
			$mpdf->Output('Reporte de comisiones.pdf', "I");

		//echo json_encode(['individual' => $data, 'grupal' => $data_by_month]);

    
	} //fin pdf




}
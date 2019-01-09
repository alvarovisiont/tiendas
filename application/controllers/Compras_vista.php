<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_vista extends CI_Controller 
{

	function __Construct()
	{
          parent:: __Construct(); 
          
          $array = ['Auditoria_Model','Compras_Vista_Model','Configuracion_Finanza_Model'];
          $this->load->model($array);
	}

	public function index()
	{
		$this->session->set_userdata('nivel', 1);
		
		if($this->session->has_userdata('nivel'))
		{
			$this->Auditoria_Model->grabar_ultima_conexion();
			
			$datos = $this->Compras_Vista_Model->traer_datos();
			$conf  = $this->Configuracion_Finanza_Model->traer_datos();

			$this->load->view('encabezado_descuentos');
			$this->load->view('compras_vista',compact('datos','conf'));
			$this->load->view('footer_compras_vista',compact('conf'));
		}
		else
		{
			return view('login');
		}
			
	}

	public function ver_detalle()
	{
		if($this->input->is_ajax_request())
		{
			$id = $this->input->post('id');
			$datos = $this->Compras_Vista_Model->traer_detalle($id);
			$array = [];
			if($datos != false)
			{
				foreach ($datos as $row) 
				{
					$array[] = $row;
				}
				echo json_encode($array);
			}
			else
			{
				$array = ['vacio' => "Ha ocurrido un error"];
				echo json_encode($array);
			}

		}
	}

	public function imprimir_factura()
	{
		$id = $this->uri->segment(3);
		$data = $this->Compras_Vista_Model->encabezado_factura($id);
		$datos = $this->Compras_Vista_Model->imprimir_factura($id);
		if($datos != false)
		{
			$html = $this->load->view('imprimir_factura_compra_vista', compact('datos', 'data'), TRUE);

			$pdfFilePath = "Factura de Compras.pdf";

			$this->load->library('m_pdf');
	 
	       //generate the PDF from the given html
	        $this->m_pdf->pdf->WriteHTML($html);
	 		
	 		//$this->m_pdf->pdf->setFooter('{PAGENO}');
	        //download it.
	        $this->m_pdf->pdf->Output($pdfFilePath, "I");
		}
	}
}
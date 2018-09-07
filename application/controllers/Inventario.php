<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct();
         
         $this->load->model("Inventario_Model"); 
	}

	public function index()
	{
		$this->session->set_userdata('nivel', 1);
		
		if($this->session->has_userdata('nivel'))
		{	

			$this->load->model('Auditoria_Model');
			$ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));
			$array = ['hora_desconexion' => $ahora];
			$this->Auditoria_Model->grabar_ultima_conexion($array);
				
			$datos = $this->Inventario_Model->traer_datos();
			$proveedores = $this->Inventario_Model->traer_proveedores();
			$grupo = $this->Inventario_Model->traer_grupo();
			$this->load->view("encabezado_inventario");
			$this->load->view("inventario", compact('datos', 'proveedores', 'grupo'));
			$this->load->view("footer_inventario");
		}
		else
		{
			return view('login');
		}
	}

	public function agregar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$data = ['nombre' => $this->input->post('nombre', TRUE),
					'id_proveedor' => $this->input->post('proveedor', TRUE),
					'marca' => $this->input->post('marca', TRUE),
					'grupo' => $this->input->post('grupo', TRUE),
					'cantidad' => $this->input->post('cantidad', TRUE),
					'precio_proveedor' => $this->input->post('costo', TRUE),
					'iva' => $this->input->post('iva', TRUE),
					'precio' => $this->input->post('precio', TRUE),
					'fecha_agregado' => date('Y-m-d', strtotime($this->input->post('fecha_registro', TRUE))),
					'observacion' => $this->input->post('observacion', TRUE)
					];
			$this->Inventario_Model->agregar($data);
			$datos = ['exito' => 'Agregado con éxito'];
			echo json_encode($datos);
		}

	}

	public function modificar()
	{
		$data = ['nombre' => $this->input->post('nombre_modi', TRUE),
					'id_proveedor' => $this->input->post('proveedor_modi', TRUE),
					'marca' => $this->input->post('marca_modi', TRUE),
					'grupo' => $this->input->post('grupo_modi', TRUE),
					'cantidad' => $this->input->post('cantidad_modi', TRUE),
					'precio_proveedor' => $this->input->post('costo_modi', TRUE),
					'precio' => $this->input->post('precio_modi', TRUE),
					'fecha_agregado' => date('Y-m-d', strtotime($this->input->post('fecha_registro_modi', TRUE))),
					'observacion' => $this->input->post('observacion_modi', TRUE)
					];
		$id = $this->input->post('id_modificar');
		$this->Inventario_Model->modificar($id, $data);
		redirect(base_url()."Inventario");
	}

	public function exportar_pdf()
	{
		$datos = $this->Inventario_Model->exportar_inventario();
		if($datos != false)
		{
			$html = $this->load->view('imprimir_inventario_pdf', compact('datos'), TRUE);
			$this->load->library('m_pdf');
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output('Inventario.pdf', "I");
		}
	}

	public function exportar_excel()
	{
		$datos = $this->Inventario_Model->exportar_inventario();
		if($datos != false)
		{
			$this->load->view('imprimir_inventario_excel', compact('datos'));
		}
	}

	public function eliminar()
	{
		$id = $this->uri->segment(3);
		$this->Inventario_Model->eliminar($id);
		redirect(base_url()."Inventario");
	}
}
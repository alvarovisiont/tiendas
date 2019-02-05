<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__ . '/../../vendor/autoload.php';

class Inventario extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct();
         
         $this->load->model(["Inventario_Model",'Configuracion_Finanza_Model']); 
	}

	public function index()
	{
		//$this->session->set_userdata('nivel', 1);
		
		if($this->session->has_userdata('nivel'))
		{	

			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();
			
			$conf  = $this->Configuracion_Finanza_Model->traer_datos();

			$datos = $this->Inventario_Model->traer_datos();
			$proveedores = $this->Inventario_Model->traer_proveedores();
			$grupo = $this->Inventario_Model->traer_grupo_aux();

			$this->load->view("encabezado_inventario");
			$this->load->view("inventario", compact('datos', 'proveedores', 'grupo','conf'));
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
			$data = ['nombre' => strtoupper($this->input->post('nombre', TRUE)),
					'id_proveedor' => 1,
					'marca' => $this->input->post('marca', TRUE),
					'grupo' => $this->input->post('grupo', TRUE),
					'cantidad' => $this->input->post('cantidad', TRUE),
					'precio_proveedor' => $this->input->post('costo', TRUE),
					'ref' => $this->input->post('ref', TRUE),
					'iva' => 16,
					'precio' => $this->input->post('precio', TRUE),
					'fecha_agregado' => date('Y-m-d', strtotime($this->input->post('fecha_registro', TRUE))),
					'observacion' => $this->input->post('observacion', TRUE),
					'mostrar' => 0,
					];


			 $variableref = $this->Inventario_Model->verificarRef($this->input->post('ref', TRUE));

			if ($variableref == 0)
			{ 	

			$this->Inventario_Model->agregar($data);
			$datos = ['exito' => 'Agregado con éxito'];


			$this->load->model('Auditoria_Model');

				$accion_var =  "Ingreso Artículo en el sistema ".
								strtoupper($this->input->post('nombre'));

				$arreglito = ["accion" => $accion_var,
						      "motivo" => "Inventario",
						     ];
				
				$id = $this->Auditoria_Model->grabar_conexion_all($arreglito);

			}else
			{
				$datos = ['refere' => 'Referencia Duplicada'];

			}		

			echo json_encode($datos);
		}

	}

	public function modificar()
	{
		//'id_proveedor' => $this->input->post('proveedor_modi', TRUE),

		$data = ['nombre' => strtoupper($this->input->post('nombre_modi', TRUE)),
					
					'marca' => $this->input->post('marca_modi', TRUE),
					'ref' => $this->input->post('ref_modi', TRUE),
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
		$config = $this->Configuracion_Finanza_Model->traer_datos();
		$datos = $this->Inventario_Model->exportar_inventario();

		if($datos != false)
		{
			$html = $this->load->view('imprimir_inventario_pdf', compact('datos', 'config'), TRUE);
			
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', [190, 236] ] );
			$mpdf->WriteHTML($html);
			$mpdf->Output('Inventario.pdf', "I");
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
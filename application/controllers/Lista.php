<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__ . '/../../vendor/autoload.php';

class Lista extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct();
         
         $this->load->model(["Inventario_Model",'Configuracion_Finanza_Model']); 
	}

	public function index()
	{
		
		if($this->session->has_userdata('nivel'))
		{	

			$grupo_aux = $this->Inventario_Model->traer_grupo_aux();

			//ingresar grupos en la tabla grupos
			foreach ($grupo_aux as $row) {
				$this->Inventario_Model->verificargrupo($row->grupo);
			}	

			$conf  = $this->Configuracion_Finanza_Model->traer_datos();

			$datos = $this->Inventario_Model->traer_datos_orden();
			$proveedores = $this->Inventario_Model->traer_proveedores();
			

			$grupo = $this->Inventario_Model->traer_grupo();


			$this->load->view("encabezado_inventario");
			$this->load->view("lista", compact('datos', 'proveedores', 'grupo','conf'));
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
					'observacion' => $this->input->post('observacion', TRUE)
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

	public function exportar_pdf_bss()
	{
		$config = $this->Configuracion_Finanza_Model->traer_datos();
		$datos = $this->Inventario_Model->traer_datos_orden_mostrar();

		if($datos != false)
		{
			$html = $this->load->view('imprimir_inventario_pdf_bss', compact('datos', 'config'), TRUE);
			
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', [190, 236] ] );
			$mpdf->WriteHTML($html);
			$mpdf->Output('Inventario.pdf', "I");
		}
	}

	public function exportar_pdf_visa()
	{
		$config = $this->Configuracion_Finanza_Model->traer_datos();
		$datos = $this->Inventario_Model->traer_datos_orden_mostrar();

		if($datos != false)
		{
			$html = $this->load->view('imprimir_inventario_pdf_visa', compact('datos', 'config'), TRUE);
			
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', [190, 236] ] );
			$mpdf->WriteHTML($html);
			$mpdf->Output('Inventario.pdf', "I");
		}
	}

	public function exportar_excel_bss()
	{
		$config = $this->Configuracion_Finanza_Model->traer_datos();	
		$datos = $this->Inventario_Model->traer_datos_orden_mostrar();
		
			$this->load->view('imprimir_inventario_excel_bss', compact('datos','config'));
		
	}

	public function exportar_excel_visa()
	{
		$config = $this->Configuracion_Finanza_Model->traer_datos();	
		$datos = $this->Inventario_Model->traer_datos_orden_mostrar();
		
			$this->load->view('imprimir_inventario_excel_visa', compact('datos','config'));
		
	}


	public function eliminar()
	{
		$id = $this->uri->segment(3);
		$this->Inventario_Model->eliminar($id);
		redirect(base_url()."Inventario");
	}

	public function filtro()
	{

		$datos = $this->input->post('grupo', TRUE); 

		$datos = $this->input->post('grupo', TRUE); 

		$this->Inventario_Model->inicializar();


		foreach ($datos as $row) {
			$this->Inventario_Model->marcar($row);
		}

		redirect(base_url()."Lista");
	}


	public function cambio($id, $mostrar)
	{
		$this->Inventario_Model->mostrar($id, $mostrar);
		redirect(base_url()."Lista");
	}
}
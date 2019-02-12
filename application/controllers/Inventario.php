<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__ . '/../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Inventario extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct();
					
				 $arreglo_model = ["Inventario_Model",'Configuracion_Finanza_Model'];
				 $arreglo_model2 = ['Auditoria_Inventario_Model'];

         $this->load->model(array_merge($arreglo_model,$arreglo_model2)); 
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
		$config = $this->Configuracion_Finanza_Model->traer_datos();	
		$datos = $this->Inventario_Model->exportar_inventario();
		if($datos != false)
		{
			$this->load->view('imprimir_inventario_excel', compact('datos','config'));
		}
	}

	public function modificar_excel(){

		$file = $_FILES['excel_file'];
		$location_file = $file['tmp_name'];
		$name_file = $file['name'];
		$destination = __DIR__ .'\\'."inventario.xlsx";

		if(move_uploaded_file($location_file,$destination)){

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($destination);

			$sheet = $spreadsheet->getSheet(0);
			$arreglo = $sheet->toArray(null, true, true, true); 
			$highestRow = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();
			$con = 0;

			$insert_auditoria = [
				'id_usuario' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			];

			$id_auditoria_inventario = $this->Auditoria_Inventario_Model->store_auditoria_invetario($insert_auditoria);

			foreach ($arreglo as $value) {
				# code.
				if($con > 4){
					
					/*--------------------------------------------------------------- 

					  Se empieza a leer desde el primer producto y se busca sus
					  datos por el número de ref y nombre del artículo

					----------------------------------------------------------------*/


					$update = [];

					$where = "i.ref = '".trim($value['A'])."' and i.nombre like '".trim($value['B'])."'";

					$data = $this->Inventario_Model->exportar_inventario_filtrado($where)[0];

					if($data){
						if( $data->cantidad != $value['C'] ){
							
							// si la cantidad es diferente entonces se agg la cantidad al modificar

							$update['cantidad'] = (INT)$value['C'];
						}

						if( $data->precio != $value['I'] ){

							// si el precio es diferente al precio de venta entonces se agg la precio al modificar

							$update['precio'] = (FLOAT)$value['I'];
						}
						
						if(count($update) > 0){

							/*--------------------------------------------------------------- 

								Mira mi amor aquí antes del modificar vas a hacer tus calculos
								con el porcentaje de yo no se que con que y le agg 
								el key => valor en el arreglo update 

							----------------------------------------------------------------*/

							if(isset($update['precio'])){

							}
							
							//$this->Inventario_Model->modificar($data->id,$update);


							/*--------------------------------------------------------------- 

												Insert del detalle de la auditoria inventario

							----------------------------------------------------------------*/

							$insert_auditoria_detalle = [
								'id_auditoria_inventario' => $id_auditoria_inventario,
								'precio' => isset($update['precio']) ? $update['precio'] : null,
								'cantidad' => isset($update['cantidad']) ? $update['cantidad'] : null,
								'created_at' => date('Y-m-d H:i:s'),
								'id_inventario' => $data->id
							];

							$this->Auditoria_Inventario_Model->store_auditoria_invetario_detalle($insert_auditoria_detalle);
						
						} // fin si se va a modificar

					} // fin si data del inventario se encontro
						
				} // fin if celda 4

				$con++;

			} // fin foreach

			unlink($destination);
			redirect(base_url().'Inventario','refresh');
		}else{
			redirect(base_url().'Inventario','refresh');
		}


	}

	public function eliminar()
	{
		$id = $this->uri->segment(3);
		$this->Inventario_Model->eliminar($id);
		redirect(base_url()."Inventario");
	}



	public function cargar()
	{
		
		$datos = $this->Inventario_Model->cargar();


		foreach ($datos as $row) 
		{


			$data = ['nombre' => strtoupper($row->descripcion),
					'ref' => $row->codigo,
					'id_proveedor' => 1,
					'marca' => $row->precio,
					'grupo' => $row->fabricante,
					'cantidad' => 0,
					'precio_proveedor' => 0,
					'iva' => 16,
					'precio' => 0,
					'fecha_agregado' => date('Y-m-d', strtotime($this->input->post('fecha_registro', TRUE))),
					'observacion' => "",
					'mostrar' => 0,
					];


			$variableref = $this->Inventario_Model->verificarRef($row->codigo);

			if ($variableref == 0)
			{ 	

			$this->Inventario_Model->agregar($data);
			echo 'Agregado con éxito';
			echo "<br>";
			 

			}else
			{
				echo '**********************************************************'.$row->codigo;
			echo "<br>";
			}

		}	



	}



}
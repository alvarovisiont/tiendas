<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller 
{
	function __Construct()
	{
          
          parent:: __Construct();
         
         $this->load->model("Proveedores_Model"); 
	}

	public function index()
	{
		
		if($this->session->has_userdata('nivel'))
		{	
			$this->load->model('Auditoria_Model');
			$this->Auditoria_Model->grabar_ultima_conexion();
				
			$datos = $this->Proveedores_Model->traer_datos();
			$this->load->view("encabezado");
			$this->load->view("proveedores", compact('datos'));
			$this->load->view("footer_proveedores");
		}
		else
		{
			return view('login');
		}
	}

	public function traer_articulos()
	{
		if($this->input->is_ajax_request())
		{
			$id = $this->input->post("id", TRUE);
			$datos = $this->Proveedores_Model->traer_articulos($id);
			$array = "";
			if($datos != 0)
			{
				foreach ($datos as $row) 
				{
					$array[] = ['nombre' => $row->nombre,
								'marca' => $row->marca,
								'cantidad' => "<span class='label label-info letras'>".$row->cantidad."</span>",
								'precio' => $row->precio,
								'fecha_agregado' => date('d-m-Y', strtotime($row->fecha_agregado))];
				}
				echo json_encode($array);
			}
			else
			{
				$array[] = ['nombre' => "",
								'marca' => "",
								'cantidad' => "",
								'precio' => "",
								'fecha_agregado' => ""];
				echo json_encode($array);
			}
		}
	}

	public function agregar()
	{
		if(!empty($this->input->post('nombre')))
		{
			$datos = ['nombre' => $this->input->post('nombre', TRUE),
						'telefono' => $this->input->post('telefono', TRUE),
						'email' => $this->input->post('email', TRUE),
						'direccion' => $this->input->post('direccion', TRUE),
						'rif' => $this->input->post('rif', TRUE),
						'fax' => $this->input->post('fax', TRUE)];
			$this->Proveedores_Model->agregar($datos);
			redirect(base_url()."Proveedores");
		}
	}

	public function modificar()
	{
		if(!empty($this->input->post('nombre_modi')))
		{
			$id = $this->input->post('id_modificar');
			$datos = ['nombre' => $this->input->post('nombre_modi', TRUE),
						'telefono' => $this->input->post('telefono_modi', TRUE),
						'email' => $this->input->post('email_modi', TRUE),
						'direccion' => $this->input->post('direccion_modi', TRUE),
						'fax' => $this->input->post('fax_modi', TRUE),
						'rif' => $this->input->post('rif_modi', TRUE),];
			$this->Proveedores_Model->modificar($id, $datos);
			redirect(base_url()."Proveedores");
		}
	}

	public function eliminar()
	{
		if($this->input->is_ajax_request())
		{
			$id = $this->input->post('id');
			$respuesta = $this->Proveedores_Model->eliminar($id);	
			if($respuesta == TRUE)
			{
				echo json_encode($array = ['exito' => 'borrado']);
			}
			else
			{
				echo json_encode($array = ['fallido' => 'aun hay registros']);	
			}
		}
	}
}
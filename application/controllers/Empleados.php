<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
          $this->load->model(['Empleados_Model','Configuracion_Finanza_Model']);
	}

	public function index()
	{	

		$this->session->set_userdata('nivel', 1);
		
		$this->load->model('Auditoria_Model');
		$this->Auditoria_Model->grabar_ultima_conexion();
			
		$datos = $this->Empleados_Model->traer_datos();
		$conf  = $this->Configuracion_Finanza_Model->traer_datos();

		$this->load->view('encabezado');
		$this->load->view('empleados', compact('datos','conf'));
		$this->load->view('footer_empleados');
	}

	public function grabar()
	{
		$array =[
					'nombre' => $this->input->post('nombre'),
					'cedula' => $this->input->post('cedula'),
					'telefono' => $this->input->post('telefono'),
					'sueldo' => $this->input->post('sueldo')
				];

		$this->Empleados_Model->insertar($array);
		$this->session->set_flashdata('exito', 'Empleado agregado con éxito');
		redirect(base_url().'Empleados');
	}

	public function modificar()
	{
		$id = $this->input->post('id_modificar');

		$array =[
					'nombre' => $this->input->post('nombre_modi'),
					'cedula' => $this->input->post('cedula_modi'),
					'telefono' => $this->input->post('telefono_modi'),
					'sueldo' => $this->input->post('sueldo_modi')
				];

		$this->Empleados_Model->modificar($id ,$array);
		$this->session->set_flashdata('exito', 'Empleado modificado con éxito');
		redirect(base_url().'Empleados');	
	}

	public function eliminar()
	{
		$id = $this->uri->segment(3);
		$this->Empleados_Model->eliminar($id);
		$this->session->set_flashdata('exito', 'Empleado eliminado con éxito');
		redirect(base_url().'Empleados');
	}
}
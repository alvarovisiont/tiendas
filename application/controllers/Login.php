<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	 public function __construct() {
         parent::__construct();
        
    }

	public function index()
	{
		$this->load->view('login');
	}

	public function verificar()
	{
		if($this->input->is_ajax_request())
		{


		$sessiones = ['id', 'usuario', 'nivel', 'empresa', 'logo', 'siglas', 
		'id_auditoria', 'direccion', 'telefono', 'email', 'retencion'];
		$this->session->unset_userdata($sessiones);

			$this->load->model("Login_Model");

			$data = ["usuario" => $this->input->post("usuario", TRUE),
						"clave" => $this->input->post("clave", TRUE)];
			
			$datos = $this->Login_Model->login($data);
			$arreglo_sesion = [];

			if(isset($datos->id))
			{
				$empresa = $this->Login_Model->traer_empresa();
				if($empresa != false)
				{	
					$arreglo_sesion['empresa'] = $empresa->nombre;
					$arreglo_sesion['direccion'] = $empresa->direccion;
					$arreglo_sesion['telefono'] = $empresa->telefono;
					$arreglo_sesion['email'] = $empresa->email;
					
					if(!empty($empresa->logo))
					{
						
						$arreglo_sesion['logo'] = $empresa->logo;
					}
				}

				$moneda = $this->Login_Model->traer_moneda();
				
				if($moneda != false)
				{
					$arreglo_sesion['siglas'] = $moneda->siglas;
					$arreglo_sesion['iva'] = $moneda->iva;
					$arreglo_sesion['retencion'] = $moneda->retencion;
				}
				
				$arreglo_sesion['id'] = $datos->id;
				$arreglo_sesion['usuario'] = $datos->usuario;
				$arreglo_sesion['nivel'] = $datos->nivel;

				$data = ['exito' => 'bien'];
				$data['nivel'] = $datos->nivel;
				
				$this->load->model('Auditoria_Model');

				$arreglito = ["accion" => "Entro al sistema",
						      "motivo" => "Login",
						      "usuario" => $datos->id];
				
				$id = $this->Auditoria_Model->grabar_conexion($arreglito);
				
				$arreglo_sesion['id_auditoria'] = $id->id;

				$this->session->set_userdata($arreglo_sesion);

				echo json_encode($data);
			}
			else
			{
				$data = ['error' => 'asda'];
				echo json_encode($data);
			}
		}
	}

	public function acceso()
	{ 

   		if($this->session->userdata('nivel') != NULL)
		{
			switch ($this->session->userdata('nivel')) {
				case 1:
					redirect(base_url()."Admin");	
				break;

				case 2:
					redirect(base_url()."Admin");	
				break;

				case 3:
					redirect(base_url()."Admin");	
				break;

			}
		}
	}

	public function salir()
	{
		$this->load->model('Auditoria_Model');
		$this->Auditoria_Model->grabar_ultima_conexion();

		$sessiones = ['id', 'usuario', 'nivel', 'empresa', 'logo', 'siglas', 'id_auditoria', 'direccion', 'telefono', 'email', 'retencion'];
		$this->session->unset_userdata($sessiones);
		redirect(base_url()."Login");
	}
}
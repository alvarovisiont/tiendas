<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{

	public function index()
	{
		$this->load->view('login');
	}

	public function verificar()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model("Login_Model");

			$data = ["usuario" => $this->input->post("usuario", TRUE),
						"clave" => $this->input->post("clave", TRUE)];
			
			$datos = $this->Login_Model->login($data);
			if(isset($datos->id))
			{
				$empresa = $this->Login_Model->traer_empresa();
				$data = ['exito' => 'bien'];
				if($empresa != false)
				{
					$this->session->set_userdata('empresa', $empresa->nombre);
					$this->session->set_userdata('direccion', $empresa->direccion);
					$this->session->set_userdata('telefono', $empresa->telefono);
					$this->session->set_userdata('email', $empresa->email);
					
					if(!empty($empresa->logo))
					{
						$this->session->set_userdata('logo', $empresa->logo);
					}
				}

				$moneda = $this->Login_Model->traer_moneda();
				
				if($moneda != false)
				{
					$this->session->set_userdata('siglas', $moneda->siglas);
					$this->session->set_userdata('iva', $moneda->iva);
					$this->session->set_userdata('retencion', $moneda->retencion);
				}
				$this->session->set_userdata('id', $datos->id);
				$this->session->set_userdata('usuario', $datos->usuario);
				$this->session->set_userdata('nivel', $datos->nivel);
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
     
        echo "---------------";

        echo $this->session->userdata('nivel');

        

        echo "cccc ---------------";

        echo $this->session->userdata('usuario');

		if($this->session->userdata('nivel') != NULL)
		{
			$this->load->model('Auditoria_Model');
			$ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));
			$array = ['usuario' => $this->session->userdata('id'), 'hora_conexion' => $ahora];
			$id = $this->Auditoria_Model->grabar_conexion($array);

			$this->session->set_userdata('id_auditoria', $id->id);

			echo ".-------------".$this->session->userdata('nivel');

			switch ($this->session->userdata('nivel')) {
				case 1:
					redirect(base_url()."Admin");	
				break;

				case 2:
					redirect(base_url()."Admin");	
				break;

			}
		}
	}

	public function salir()
	{
		$this->load->model('Auditoria_Model');
		$ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));
		$array = ['hora_desconexion' => $ahora];
		$this->Auditoria_Model->grabar_ultima_conexion($array);

		$sessiones = ['id', 'usuario', 'nivel', 'empresa', 'logo', 'siglas', 'id_auditoria', 'direccion', 'telefono', 'email', 'retencion'];
		$this->session->unset_userdata($sessiones);
		redirect(base_url()."Login");
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Configuracion extends CI_Controller 
{

	function __Construct()
	{
          
          parent:: __Construct(); 
	}

	public function index()
	{	
		if($this->session->has_userdata('nivel'))
		{
			$this->load->model('Auditoria_Model');
			$ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));
			$array = ['hora_desconexion' => $ahora];
			$this->Auditoria_Model->grabar_ultima_conexion($array);
			
			$this->load->model('Configuracion_Model');
			$datos = $this->Configuracion_Model->traer_datos_empresa();
			$data = $this->Configuracion_Model->traer_datos_encargado();
			$this->load->view('encabezado_inventario');
			$this->load->view('configuracion_empresa', compact('datos', 'data'));
			$this->load->view('footer_configuracion');
		}
		else
		{
			return view('login');
		}
	}

	public function guardar_empresa()
	{
		if($this->input->is_ajax_request())
		{
			$imagen_nombre = "";
			if(!empty($_FILES['logo_empresa']))
			{
				$imagen = $_FILES['logo_empresa'];
				$config['upload_path']   = './img';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['overwrite'] = TRUE;
                $config['max_width']     = 0;
                $config['max_height']    = 0;

                $this->load->library('upload', $config);

                if ( !$this->upload->do_upload('logo_empresa'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                        $data = ['upload_file' => $this->upload->data()];
                        $imagen_nombre = $data['upload_file']['file_name'];
                }
			}
			$this->load->model('Configuracion_Model');
			$array = ['nombre' => $this->input->post('nombre_empresa', TRUE),
						'direccion' => $this->input->post('direccion_empresa', TRUE),
						'telefono' => $this->input->post('telefono_empresa', TRUE),
						'email' => $this->input->post('email_empresa', TRUE),
						'rif' => $this->input->post('rif_empresa', TRUE),
						'fax' => $this->input->post('fax_empresa', TRUE),
						'logo' => $imagen_nombre];

			$this->Configuracion_Model->guardar_empresa($array);
		}
	}

	public function modificar_empresa()
	{
		$this->load->model('Configuracion_Model');
		$id = $this->input->post('id_modificar_empresa');
		$logo = $this->input->post('nombre_logo');
		if(!empty($_FILES['logo_empresa_modi']))
		{
			$config = [];
			$config['upload_path'] = "./img";
			$config['allowed_types'] = "jpg|png|jpeg";
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('logo_empresa_modi'))
			{
				$error = $this->upload->display_errors();
				print_r($error);
			}
			else
			{
				$data = ['nombre_logo' => $this->upload->data()];
				$logo = $data['nombre_logo']['file_name'];
			}
		}
		$array = [	'nombre' => $this->input->post('nombre_empresa_modi', TRUE),
					'direccion' => $this->input->post('direccion_empresa_modi', TRUE),
					'telefono' => $this->input->post('telefono_empresa_modi', TRUE),
					'email' => $this->input->post('email_empresa_modi', TRUE),
					'rif' => $this->input->post('rif_empresa_modi', TRUE),
					'fax' => $this->input->post('fax_empresa_modi', TRUE),
					'logo' => $logo];

		$this->Configuracion_Model->modificar_empresa($id,$array);
		redirect(base_url().'Configuracion');
	}

	public function guardar_encargado()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model('Configuracion_Model');

			$array = [	'id_empresa' => 1,
						'cedula' => $this->input->post('cedula_encargado', TRUE),
						'nombre_encargado' => $this->input->post('nombre_encargado', TRUE),
						'telefono_encargado' => $this->input->post('telefono_encargado', TRUE),
						'correo_encargado' => $this->input->post('email_encargado', TRUE)
					];

			$this->Configuracion_Model->guardar_encargado($array);
		}	
	}

	public function modificar_encargado()
	{
		$this->load->model('Configuracion_Model');
		$id = $this->input->post('id_modificar');
		$array = [	
					'cedula' => $this->input->post('cedula_encargado_modi', TRUE),
					'nombre_encargado' => $this->input->post('nombre_encargado_modi', TRUE),
					'telefono_encargado' => $this->input->post('telefono_encargado_modi', TRUE),
					'correo_encargado' => $this->input->post('correo_encargado_modi', TRUE)
				];

		$this->Configuracion_Model->modificar_encargado($id,$array);
		redirect(base_url().'Configuracion');
			
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditoria_Model extends CI_Model
{

   function __Construct()
   {

   	parent:: __Construct();
   }

   public function traer_datos()
   {  
         $this->db->select('u.usuario, a.hora_conexion, a.hora_desconexion ');
         $this->db->from('auditoria a');
         $this->db->join('usuarios u', 'u.id = a.usuario');
   		$query = $this->db->get();
         
   		if($query->num_rows() > 0)
   		{
            $filas = $query->result();

            $query->free_result();

   			return $filas;
   		}
   		else
   		{
   			return false;
   		}
   }

   public function grabar_conexion($array)
   {
   		$this->db->insert('auditoria', $array);

   		$this->db->select_max('id');
   		$query = $this->db->get('auditoria');

   		if($query->num_rows() > 0)
   		{
            $fila = $query->row();
            $query->free_result();
   			return $fila;
   		}
   		else
   		{
   			return false;
   		}
   }

   public function grabar_ultima_conexion($array)
   {	
   		$id = $this->session->userdata('id_auditoria');
   		
   		$this->db->where('id', $id);
   		$this->db->update('auditoria', $array);
   }
}

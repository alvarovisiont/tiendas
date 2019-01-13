<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

   public function traer_datos_empresa()
   {     
   		$query = $this->db->get('configuracion_empresa');
   		
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

   public function traer_datos_encargado()
   {
         $query = $this->db->get('encargado');

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

   public function guardar_empresa($array)
   {
   		$this->db->insert("configuracion_empresa",$array);
   }

   public function guardar_encargado($array)
   {
   		$this->db->insert("encargado",$array);
   }

   public function modificar_encargado($id, $array)
   {
   		$this->db->where('id_encargado', $id);
   		$this->db->update('encargado', $array);
   }

   public function modificar_empresa($id, $array)
   {
   		$this->db->where('id', $id);
   		$this->db->update('configuracion_empresa', $array);
   }
}
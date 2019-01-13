<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

   public function traer_datos()
   {
         $query = $this->db->get('clientes');
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

   public function traer_articulos($id_venta)
   {
      $this->db->where('id_venta', $id_venta);
      $query = $this->db->get('ventas_detalle');
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
}
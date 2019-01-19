<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_Descuento_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

   public function traer_datos()
   {
   		$query = $this->db->get('descuentos');
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

  /* public function grabar($array)
   {
   		$this->db->insert('configuracion_moneda', $array);
   }
    */

   public function modificar($array, $id)
   {
   		$this->db->where('id', $id);
   		$this->db->update('descuentos', $array);
   }
  
}
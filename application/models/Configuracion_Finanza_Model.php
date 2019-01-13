<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_Finanza_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

   public function traer_datos()
   {
   		$query = $this->db->get('configuracion_moneda');
   		if($query->num_rows() > 0)
   		{
   			$filas = $query->row();
            $query->free_result();
            return $filas;
   		}
   		else
   		{
   			return false;
   		}
   }

   public function grabar($array)
   {
   		$this->db->insert('configuracion_moneda', $array);
   }

   public function modificar($array, $id)
   {
   		$this->db->where('id', $id);
   		$this->db->update('configuracion_moneda', $array);
         $data = ['iva' => $array['iva']];
         $this->db->where('iva <>', 0);
         $this->db->update('inventario', $data);
   }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja_chica_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

   public function agregar($arreglo)
   {
   		$this->db->insert('caja_chica', $arreglo);
   }

   public function traer_datos()
   {
   		$query = $this->db->get('caja_chica');
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
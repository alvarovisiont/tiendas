<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Descuentos_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

    public function traer_descuentos()
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
}
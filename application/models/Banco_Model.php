<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banco_Model extends CI_Model
{

   public function get($id = null){
   	if($id){
         $this->db->where('id',$id);
      }

      return $this->db->get('banco')->result();
   }


   public function get_all($id = null){
      if($id){
         $this->db->where('op',$id);
      }

      return $this->db->get('banco')->result();
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
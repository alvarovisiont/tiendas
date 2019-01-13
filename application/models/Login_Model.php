<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model
{

   function __Construct(){

   	parent:: __Construct();
   }

   public function login($data)
   {
   		$sql = "SELECT id, usuario, nivel from usuarios where usuario = ".$this->db->escape($data['usuario'])." AND clave = ".$this->db->escape($data['clave']);
      $query=$this->db->query($sql);
            
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

   public function traer_empresa()
   {
      $this->db->select('nombre, logo, direccion, telefono, email');
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

   public function traer_moneda()
   {
      $this->db->select('iva, retencion, siglas');
      $query = $this->db->get('configuracion_moneda');
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
}
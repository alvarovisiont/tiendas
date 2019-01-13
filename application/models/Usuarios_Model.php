<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_Model extends CI_Model
{

   function __Construct(){

   	//parent:: __Construct();
   }

   public function traer_usuarios()
   {    $this->db->order_by('nivel', 'asc');
   		 $query = $this->db->get('usuarios');
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

   public function getById($id){
      return $this->db->where('id',$id)->get('usuarios')->row();
   }

   public function traer_trabajadores(){
      return $this->db->where('nivel',3)->get('usuarios')->result();
   }

   public function agregar($datos)
   {
      $this->db->like('usuario', $datos['usuario']);
      $query = $this->db->get('usuarios');
      if($query->num_rows() > 0)
      {
        return "repetido";
      }
      else
      {
        $this->db->insert('usuarios',$datos);
        return "agregado";
      }
      

   }

   public function modificar($id, $datos)
   {
      $this->db->where('id', $id);
      $this->db->update('usuarios', $datos);
   }

   public function eliminar($id)
   {
      $this->db->where('id', $id);
      $this->db->delete('usuarios');  
   }
}
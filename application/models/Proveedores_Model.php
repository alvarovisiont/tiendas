<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

   public function traer_datos()
   {
         $sql = "SELECT p.id ,p.nombre, p.telefono, p.email, p.direccion, p.pagina_web, p.fax, p.rif FROM proveedores p";
   		$query = $this->db->query($sql);
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

   public function traer_articulos($id)
   {
      $this->db->where('id_proveedor', $id);
      $query = $this->db->get('inventario');
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

   public function agregar($datos)
   {
      $this->db->insert('proveedores', $datos);
   }
   public function modificar($id, $datos)
   {
      $this->db->where('id', $id);
      $this->db->update('proveedores', $datos);
   }

   public function eliminar($id)
   {
      $this->db->where('id_proveedor', $id);
      $this->db->select('id');
      $query = $this->db->get('inventario');
      if($query->num_rows() > 0)
      {
         return false;
      }
      else
      {
         $this->db->where('id', $id);
         $this->db->delete('proveedores');
         return true;
      }

   }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

   public function agregar($datos)
   {
   		$this->db->insert("inventario", $datos);
   }

   public function traer_datos()
   {     
         $this->db->select('inventario.*, proveedores.nombre as proveedor_nombre');
         $this->db->from('inventario');
         $this->db->join('proveedores', 'proveedores.id = inventario.id_proveedor');
   		$query = $this->db->get();
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

   public function traer_proveedores()
   {
      $this->db->select('nombre, id');
      $query = $this->db->get('proveedores');
      if($query->num_rows() > 0)
      {
         $filas = $query->result();
         $query->free_result();
         return $filas;
      }
      else
      {
         return "";
      }

   }

   public function traer_grupo()
   {
      $this->db->select('grupo');
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

   public function exportar_inventario()
   {
      $this->db->select('i.ref, i.nombre, i.marca, i.grupo, i.cantidad, i.precio, i.precio_proveedor, i.fecha_agregado, p.nombre as proveedor');
      $this->db->from('inventario i');
      $this->db->join('proveedores p' , 'p.id = i.id_proveedor');
      $this->db->order_by('nombre', 'ASC');
      $query = $this->db->get();
      if($query->num_rows() > 0)
      {
         $filas = $query->result();
         $query->free_result();
         return $filas;
      }
   }

   public function exportar_inventario_filtrado($where)
   {
      $this->db->select('i.nombre, i.marca, i.grupo, i.cantidad, i.precio, i.precio_proveedor, i.fecha_agregado, p.nombre as proveedor');
      $this->db->from('inventario i');
      $this->db->join('proveedores p' , 'p.id = i.id_proveedor');
      $this->db->where($where);
      $this->db->order_by('nombre', 'ASC');
      $query = $this->db->get();
      if($query->num_rows() > 0)
      {
         $filas = $query->result();
         $query->free_result();
         return $filas;
      }
   }

   public function modificar($id, $data)
   {
   	 $this->db->where('id', $id);
   	 $this->db->update('inventario', $data);
   }

   public function eliminar($id)
   {
   		$this->db->where('id', $id);
   		$this->db->delete("inventario");
   }
}
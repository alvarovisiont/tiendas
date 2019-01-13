<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_Vista_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

   public function traer_datos()
   {
   		$query = $this->db->get('compras');
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

   public function traer_detalle($id)
   {
   		$this->db->where('id_compra', $id);
   		$query = $this->db->get('compras_detalle');
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

   public function encabezado_factura($id)
   {
      $sql = "SELECT c.codigo, cd.proveedor, (SELECT rif from proveedores where nombre like cd.proveedor) as rif,
            (SELECT direccion from proveedores where nombre like cd.proveedor) as direccion
            from compras_detalle cd
            INNER JOIN compras c ON c.id = cd.id_compra
            where c.id = $id";

      $query = $this->db->query($sql);

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

   public function imprimir_factura($id)
   {
      $this->db->select("c.fecha_compra,cd.nombre_articulo,cd.marca,cd.costo,cd.cantidad,cd.total, cd.iva, cd.sub_total");
      $this->db->from('compras c');
      $this->db->join('compras_detalle cd', 'cd.id_compra = c.id');
      $this->db->where('c.id', $id);
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
}
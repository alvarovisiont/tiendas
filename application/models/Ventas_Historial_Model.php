<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_Historial_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }


   public function traer_datos()
   {
         $this->db->order_by("id","desc");
   		$query = $this->db->get('ventas');
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

   public function get_sub_total_sell($id_venta){
      $sql = "SELECT SUM(sub_total) as sub_total from ventas_detalle where id_venta = $id_venta";
      return $this->db->query($sql)->row();
   }

   public function traer_detalle($id_venta)
   {
      $this->db->where('id_venta', $id_venta);
      $query = $this->db->get('ventas_detalle');
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

   public function traer_cliente($id_buscar)
   {
      $this->db->where('id_venta', $id_buscar);
      $this->db->select('nombre, cedula, telefono, direccion');
      $query = $this->db->get('clientes');
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

   public function buscar_cliente_factura($id_venta)
   {
      $this->db->where('id_venta', $id_venta);
      $this->db->select('nombre, cedula, direccion, factura, telefono');
      $this->db->from('clientes');
      $this->db->join('ventas', 'ventas.id = clientes.id_venta');
      $query = $this->db->get();
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

   public function detalles_compra_factura($id_venta)
   {
       $sql = "SELECT vd.ref, v.id_descuento, v.monto_descuento, v.factura, v.fecha_venta, v.monto_pagado, v.tipo_venta, vd.* FROM ventas v 
       INNER JOIN ventas_detalle vd on vd.id_venta = v.id 
       WHERE v.id = $id_venta";
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


      /*$this->db->where('id_venta', $id_venta);
      $query = $this->db->get('ventas_detalle');
      if($query->num_rows() > 0)
      {
         $filas = $query->result();
         $query->free_result();
         return $filas;
      }
      else
      {
         return false;
      }*/
   }

   public function datos_empresa()
   {
      $this->db->select('direccion, telefono, email');
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
}
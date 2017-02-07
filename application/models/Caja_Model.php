<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja_Model extends CI_Model
{

   function __Construct()
   {

   	parent:: __Construct();
   }

   public function traer_datos($mes = NULL)
   {
         if($mes == "")
         {
            $mes = date('m');
         }
         $this->db->where('MONTH(fecha_venta)', $mes);
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

   public function saldo($mes)
   {
         $this->db->where('MONTH(fecha_venta)', $mes);
         $this->db->select('SUM(monto_pagado) as total_monto, SUM(vuelto) as total_vuelto');
         $query = $this->db->get('ventas');
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

   public function saldo_estadistica_dia($mes, $año)
   {
      $sql = "SELECT SUM(monto_pagado) as total_monto, SUM(vuelto) as total_vuelto, DAY(fecha_venta) as dia from ventas where MONTH(fecha_venta) = $mes and YEAR(fecha_venta) = $año GROUP BY dia asc";
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

   public function saldo_estadistica_mes($año)
   {
      
      $sql = "SELECT SUM(monto_pagado) as total_monto, SUM(vuelto) as total_vuelto, MONTH(fecha_venta) as mes from ventas where YEAR(fecha_venta) = $año GROUP BY  mes asc";
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

   public function saldo_estadistica_año($año)
   {
      
      $sql = "SELECT SUM(monto_pagado) as total_monto, SUM(vuelto) as total_vuelto, YEAR(fecha_venta) as año from ventas where YEAR(fecha_venta) = $año GROUP BY  año asc";
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

  public function detalle_venta($id_venta)
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

  public function detalle_cliente($id_venta)
  {   
      $this->db->distinct();
      $this->db->where('id_venta', $id_venta);
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
}
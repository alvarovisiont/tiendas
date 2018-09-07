<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Model extends CI_Model
{

   function __Construct()
   {

   	parent:: __Construct();
   }
   
   	public function traer_datos()
   	{
   		$sql = "SELECT COUNT(*) as inventario, (SELECT COUNT(*) from compras) as compras, (SELECT COUNT(*) from ventas) as ventas from inventario";
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

      public function traer_compras_ventas()
      {
         $mes = date('m');
         $año = date('Y');

        /* $sql = "SELECT SUM(monto_pagado) as total_ventas, MONTH(fecha_venta) as mes,
                (SELECT SUM(monto_pagado) from compras where YEAR(fecha_compra) = $año and MONTH(fecha_compra) = mes) as total_compras 
                from ventas 
                where YEAR(fecha_venta) = $año GROUP BY mes asc";
          */

          $sql = "SELECT * from ventas";       
         
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
}
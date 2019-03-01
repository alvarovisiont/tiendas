<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();

   }

   public function count_all_stadistics($search = null){

    if(!$search){
      $search = "'1'";
    }
    
    $sql = "
    SELECT  
      COALESCE(SUM(total_transferencia),0) as total_transferencia,
      COALESCE(SUM(total_dolares),0) as total_dolares,
      COALESCE(SUM(total_dolares_bs),0) as total_dolares_bs,
      COALESCE(SUM(total_debito),0) as total_debito,
      COALESCE(SUM(total_efectivo),0) as total_efectivo,
      COALESCE(SUM(total_totales),0) as total_totales
    FROM (
      SELECT DISTINCT *,
      ( CAST(total_transferencia as REAL) + CAST(total_dolares_bs AS REAL) 
      + CAST(total_debito AS REAL) + CAST(total_efectivo AS REAL)) as total_totales
      from (
        SELECT 
         COALESCE(((SELECT SUM(monto_pagado) FROM ventas where tipo_venta like 'transferencia' and ventas.fecha_venta = t.fecha_venta) + (SELECT sum(monto_transferencia) from ventas WHERE ventas.fecha_venta = t.fecha_venta)),0) as total_transferencia,
               
         COALESCE((SELECT SUM(monto_dolares) FROM ventas where ventas.fecha_venta = t.fecha_venta),0) as total_dolares,

         COALESCE((SELECT SUM(monto_dolares * COALESCE(CAST(monto_dolar_configuracion AS REAL),1)) FROM ventas where ventas.fecha_venta = t.fecha_venta),0) as total_dolares_bs,

         COALESCE(((SELECT SUM(monto_pagado) FROM ventas where tipo_venta like 'debito' and ventas.fecha_venta = t.fecha_venta) + (SELECT sum(monto_debito) from ventas where  ventas.fecha_venta = t.fecha_venta)),0) as total_debito,

         COALESCE(((SELECT SUM(monto_pagado) FROM ventas where tipo_venta like 'efectivo' and ventas.fecha_venta = t.fecha_venta) + (SELECT sum(monto_efectivo) from ventas where  ventas.fecha_venta = t.fecha_venta)),0) as total_efectivo

         from ventas as t
         WHERE $search
         GROUP BY t.tipo_venta,t.fecha_venta

        ) as t1 
      ) AS T2";
    
    return $this->db->query($sql)->row();

   }

   public function count_all_transfers($search = null){
    
    if(!$search){
      $search = "'1'";
    }

    $sql = "SELECT SUM(total) as total, nombre from (
      SELECT 
       COALESCE(
       (
         COALESCE((SELECT SUM(monto_pagado) FROM ventas as v where v.tipo_venta like 'transferencia' and v.id_banco = t.id_banco
          AND v.fecha_venta = t.fecha_venta
         ),0) 
        + 
        COALESCE(
          (SELECT sum(monto_transferencia) from ventas as v where v.id_banco = t.id_banco and v.fecha_venta = t.fecha_venta),0)
      ),0) as total,

       banco.nombre
       from ventas as t
       LEFT JOIN banco ON banco.id = t.id_banco
       WHERE $search AND (banco.op = 1 and banco.nombre IS NOT NULL)
       GROUP BY t.id_banco,banco.nombre,t.fecha_venta
    ) as t1 GROUP BY nombre";
    return $this->db->query($sql)->result();

   }

   public function count_all_debit($search = null){
    
    if(!$search){
      $search = "'1'";
    }

    $sql = "SELECT SUM(total) as total, nombre from (
      SELECT 
       COALESCE(
       (
         COALESCE((SELECT SUM(monto_pagado) FROM ventas as v where v.tipo_venta like 'debito' and v.id_banco_debito = t.id_banco_debito
          AND v.fecha_venta = t.fecha_venta
         ),0) 
        + 
        COALESCE(
          (SELECT sum(monto_debito) from ventas as v where v.id_banco_debito = t.id_banco_debito and v.fecha_venta = t.fecha_venta),0)
      ),0) as total,

       banco.nombre
       from ventas as t
       LEFT JOIN banco ON banco.id = t.id_banco_debito
       WHERE $search AND (banco.op = 2 and banco.nombre IS NOT NULL)
       GROUP BY t.id_banco_debito,banco.nombre,t.fecha_venta
    ) as t1 GROUP BY nombre";
    return $this->db->query($sql)->result();

   }

   public function saldo($mes)
   {
        $this->db->where('EXTRACT(MONTH FROM fecha_venta) = '.$mes.' and status = 1');
        $this->db->select('monto_pagado as total_monto','vuelto as total_vuelto');
        
       // $this->db->select('*');
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
      $sql = "SELECT SUM(monto_pagado) as total_monto, SUM(vuelto) as total_vuelto, EXTRACT(DAY FROM fecha_venta) as dia from ventas where EXTRACT( MONTH FROM fecha_venta) = $mes and EXTRACT(YEAR FROM fecha_venta) = $año GROUP BY dia";
      

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
      
     $sql = "SELECT SUM(monto_pagado) as total_monto, SUM(vuelto) as total_vuelto, EXTRACT(MONTH FROM fecha_venta) as mes from ventas where EXTRACT(YEAR FROM fecha_venta) = $año GROUP BY  mes";

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
      
      $sql = "SELECT SUM(monto_pagado) as total_monto, SUM(vuelto) as total_vuelto, EXTRACT(YEAR FROM fecha_venta) as año from ventas where EXTRACT(YEAR FROM fecha_venta) = $año GROUP BY  año";
      

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
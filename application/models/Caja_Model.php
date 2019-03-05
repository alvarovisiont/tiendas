<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();

   }

   public function count_all_stadistics($search = null){
    
    // totales generales

    if(!$search){
      $search = "'1'";
    }
    
    $sql = "
    SELECT  
      COALESCE(CAST(SUM(total_transferencia)AS NUMERIC(20,2)),0) as total_transferencia,

      COALESCE(SUM(total_dolares),0) as total_dolares,

      COALESCE(CAST(SUM(total_dolares_bs) AS NUMERIC(20,2)),0) as total_dolares_bs,

      COALESCE(CAST(SUM(total_debito) AS NUMERIC(20,2)),0) as total_debito,

      COALESCE(CAST(SUM(total_efectivo) AS NUMERIC(20,2)),0) as total_efectivo,

      COALESCE(CAST(SUM(total_totales) AS NUMERIC(20,2)),0) as total_totales
    FROM (
      SELECT DISTINCT *,
      ( total_transferencia + total_dolares_bs 
        + total_debito + total_efectivo
      ) 
      as total_totales
      from (
        SELECT 
          COALESCE(
            (
              (SELECT SUM(COALESCE(monto_pagado,0)) FROM ventas where tipo_venta like 'transferencia' and ventas.fecha_venta = t.fecha_venta)
              + 
              (SELECT sum(COALESCE(monto_transferencia,0)) from ventas WHERE ventas.fecha_venta = t.fecha_venta)
            )
          ,0) as total_transferencia,
               
          (
            (SELECT SUM(COALESCE(monto_dolares,0)) 
            FROM ventas where ventas.fecha_venta = t.fecha_venta)
            -
            (SELECT sum(COALESCE(vuelto,0)) from ventas where  ventas.fecha_venta = t.fecha_venta and tipo_venta like 'visa')
          )
          as total_dolares,

          COALESCE(
            (
              (SELECT SUM(COALESCE(monto_dolares,0) 
                * COALESCE(monto_dolar_configuracion,1))
                FROM ventas 
                where ventas.fecha_venta = t.fecha_venta)
              -
              (SELECT sum(COALESCE(vuelto,0) 
                * COALESCE(monto_dolar_configuracion,1))
                from ventas 
                where  ventas.fecha_venta = t.fecha_venta 
                and tipo_venta like 'visa')
            )
          ,0) as total_dolares_bs,

          COALESCE
          (
            (
              (SELECT SUM(COALESCE(monto_pagado,0)) FROM ventas where tipo_venta like 'debito' and ventas.fecha_venta = t.fecha_venta)
              + 
              (SELECT sum(COALESCE(monto_debito,0)) from ventas where  ventas.fecha_venta = t.fecha_venta)
            )
          ,0) 
            as total_debito,

          COALESCE
          (
            (
              (
                (SELECT SUM(COALESCE(monto_pagado,0)) FROM ventas where tipo_venta like 'efectivo' and ventas.fecha_venta = t.fecha_venta)
                +   
                (SELECT sum(COALESCE(monto_efectivo,0)) from ventas where  ventas.fecha_venta = t.fecha_venta)
              )
              -
              (SELECT sum(COALESCE(vuelto,0)) from ventas where  ventas.fecha_venta = t.fecha_venta and tipo_venta not like 'visa')
            )
          ,0) 
          as total_efectivo

         from ventas as t
         WHERE $search
         GROUP BY t.tipo_venta,t.fecha_venta
        ) as t1 
      ) AS T2";
    

    return $this->db->query($sql)->row();

   }

   public function count_all_transfers($search = null){
    
    // totales transferencias

    if(!$search){
      $search = "'1'";
    }

    $sql = "SELECT CAST(SUM(total) AS NUMERIC(20,2)) as total, nombre from (
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
    
    // totales debito

    if(!$search){
      $search = "'1'";
    }

    $sql = "SELECT CAST(SUM(total) AS NUMERIC(20,2)) as total, nombre from (
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
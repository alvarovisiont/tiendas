<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_Model extends CI_Model
{

   function __Construct()
   {

   	parent:: __Construct();
   }

   public function traer_proveedores()
   {
         $sql = "SELECT id, nombre from proveedores";
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

   public function eliminar_articulos_flotantes()
   {
      $this->db->select_max('id');
      $query = $this->db->get('compras');
      if($query->num_rows() > 0)
      {
         $numero = "";
         $fila = $query->row();
         if($fila->id == "")
         {
            $numero = 1;
         }
         else
         {
            $numero = $fila->id;
         }
         $this->db->where('id_compra > ', $numero);
         $this->db->delete('compras_detalle');
      }
   }

   public function traer_articulos($id)
   {
      $this->db->select('id, nombre, marca, cantidad, precio_proveedor');
      $this->db->where('id_proveedor', $id);
      $query = $this->db->get('inventario');
      if($query->num_rows () > 0)
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

   public function agregar_tabla($proveedor, $articulo, $cantidad)
   {
      $sql = "SELECT nombre, marca, precio_proveedor, iva, (SELECT nombre from proveedores where id = inventario.id_proveedor) as nombre_proveedor from inventario where id_proveedor = $proveedor and id = $articulo";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0)
      {
         $filas = $query->row();
         $this->db->select_max('id');
         $query1 = $this->db->get('compras');
         if($query1->num_rows() > 0)
         {
            $filas1 = $query1->row();
            $query1->free_result();
            if($filas1->id != "")
            {
               $id = $filas1->id + 1;

               $this->db->where('nombre_articulo', $filas->nombre);
               $this->db->where('id_compra', $id);
               $query2 = $this->db->get('compras_detalle');
               if($query2->num_rows() > 0)
               {
                  $query2->free_result();
                  return "Repetido";
               }
               else
               {
                  $sub_total = $cantidad * $filas->precio_proveedor;
                  $iva_calculado = $filas->iva / 100;
                  $iva = round($sub_total * $iva_calculado);
                  $total = $sub_total + $iva;
                  
                  $array = [
                              'id_compra' => $id,
                              'nombre_articulo' => $filas->nombre,
                              'marca' => $filas->marca,
                              'costo' => $filas->precio_proveedor,
                              'proveedor' => $filas->nombre_proveedor,
                              'cantidad' => $cantidad,
                              'sub_total' => $sub_total,
                              'iva' => $iva,
                              'total' => $total
                           ];
                  $this->db->insert('compras_detalle', $array);
                  $query2->free_result();
                  $filas = $query->result();
                  $query->free_result();
                  return $filas;
               }
            }
            else
            {
               $id = 1;
               $this->db->like('nombre_articulo', $filas->nombre);
               $this->db->where('id_compra', $id);
               $query2 = $this->db->get('compras_detalle');
               if($query2->num_rows() > 0)
               {
                  $query2->free_result();
                  return "Repetido";
               }
               else
               {
                  $sub_total = $cantidad * $filas->precio_proveedor;
                  $iva_calculado = $filas->iva / 100;
                  $iva = round($sub_total * $iva_calculado);
                  $total = $sub_total + $iva;

                  $array = [
                              'id_compra' => $id,
                              'nombre_articulo' => $filas->nombre,
                              'marca' => $filas->marca,
                              'costo' => $filas->precio_proveedor,
                              'proveedor' => $filas->nombre_proveedor,
                              'cantidad' => $cantidad,
                              'sub_total' => $sub_total,
                              'iva' => $iva,
                              'total' => $total
                           ];
                  $this->db->insert('compras_detalle', $array);  
                  $query2->free_result();
                  $filas = $query->result();
                  $query->free_result();
                  return $filas;
               }
            }
               
         }
         else
         {
            $id = 1;
               $this->db->where('nombre_articulo', $filas->nombre);
               $this->db->where('id_compra', $id);
               $query2 = $this->db->get('compras_detalle');
               if($query2->num_rows() > 0)
               {
                  $query2->free_result();
                  return "Repetido";
               }
               else
               {
                  $sub_total = $cantidad * $filas->precio_proveedor;
                  $iva_calculado = $filas->iva / 100;
                  $iva = round($sub_total * $iva_calculado);
                  $total = $sub_total + $iva;

                  $array = [
                              'id_compra' => $id,
                              'nombre_articulo' => $filas->nombre,
                              'marca' => $filas->marca,
                              'costo' => $filas->precio_proveedor,
                              'proveedor' => $filas->nombre_proveedor,
                              'cantidad' => $cantidad,
                              'sub_total' => $sub_total,
                              'iva' => $iva,
                              'total' => $total
                           ];
                  $this->db->insert('compras_detalle', $array);  
                  $query2->free_result();
                  $filas = $query->result();
                  $query->free_result();
                  return $filas;
               }
                  
         }
      }
      else
      {
         return false;
      }
   }

   public function eliminar_articulo($nombre)
   {
      $this->db->select_max('id_compra');
      $query = $this->db->get('compras_detalle');
      if($query->num_rows() > 0)
      {
         $filas = $query->row();
         $sql = "DELETE from compras_detalle where nombre_articulo LIKE '%$nombre%' and id_compra = $filas->id_compra";
         $this->db->query($sql);
      }
   }

   public function agregar_compra($total)
   {
      $this->verificar($total);
   }

   private function verificar($total)
   {
         $codigo = "fac-".rand(10000, 10000000);
         $this->db->where('codigo', $codigo);
         $query = $this->db->get('compras');
         if($query->num_rows() > 0)
         {
            $query->free_result();
            $this->verificar();
         }
         else
         {
            $query->free_result();
               $array = [ 'codigo' => $codigo,
                        'fecha_compra' => date('Y-m-d'),
                        'monto_pagado' => $total];      
               $this->db->insert('compras', $array);
               $this->db->select_max('id');
               $query = $this->db->get('compras');
               if($query->num_rows() > 0)
               {
                  $row = $query->row();
                  $query->free_result();
                  $this->db->select('cantidad, nombre_articulo');
                  $this->db->where('id_compra', $row->id);
                  $query = $this->db->get('compras_detalle');
                  if($query->num_rows() > 0)
                  {
                     foreach ($query->result() as $row1) 
                     {
                        $sql = "UPDATE inventario SET cantidad = cantidad + $row1->cantidad where nombre LIKE '%$row1->nombre_articulo%'";
                        $this->db->query($sql);
                     }

                     $query->free_result();
                  }
               }
         }
   }

   public function encabezado_factura()
   {
      $this->db->select_max('id');
      $query = $this->db->get('compras');
      if($query->num_rows() > 0)
      {
         $row = $query->row(); 
         $query->free_result();
         $sql = "SELECT c.codigo, cd.proveedor, (SELECT rif from proveedores where nombre like cd.proveedor) as rif,
               (SELECT direccion from proveedores where nombre like cd.proveedor) as direccion
               from compras_detalle cd
               INNER JOIN compras c ON c.id = cd.id_compra
               where c.id = $row->id";

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
   }

   public function imprimir_factura()
   {
      $this->db->select_max('id');
      $query = $this->db->get('compras');
      if($query->num_rows() > 0)
      {
         $row = $query->row();
         $query->free_result();

         $this->db->select("c.fecha_compra,cd.nombre_articulo,cd.marca,cd.costo,cd.cantidad,cd.total, cd.iva, cd.sub_total");
         $this->db->from('compras c');
         $this->db->join('compras_detalle cd', 'cd.id_compra = c.id');
         $this->db->where('c.id', $row->id);
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

   public function graficas_estadisticas_dia($mes, $año)
   {
     /* $sql = "SELECT SUM(monto_pagado) as monto, DAY(fecha_compra) as dia from compras where MONTH(fecha_compra) = $mes and YEAR(fecha_compra) = $año GROUP BY dia asc";
    */
        $sql = "SELECT monto_pagado as monto, fecha_compra as dia from compras";


      $query = $this->db->query($sql);
      if($query->num_rows() > 0)
      {
         $array = [];
         foreach ($query->result() as $row)
         {
            $array[] = $row;
         }
         $query->free_result();
         return $array;
      }
   }

   public function grafico_estadistica_mes($año)
   {
      /*$sql = "SELECT SUM(monto_pagado) as monto, MONTH(fecha_compra) as mes from compras where YEAR(fecha_compra) = $año GROUP BY mes asc";
      */
       $sql = "SELECT monto_pagado as monto, fecha_compra as mes from compras";

      $query = $this->db->query($sql);
      if($query->num_rows() > 0)
      {
         $array = [];
         foreach ($query->result() as $row)
         {
            $array[] = $row;
         }
         $query->free_result();
         return $array;
      }
   }

   public function grafico_estadistica_año()
   {
      /*$sql = "SELECT SUM(monto_pagado) as monto, YEAR(fecha_compra) as año from compras GROUP BY año asc";*/

      $sql = "SELECT monto_pagado as monto, fecha_compra as año from compras GROUP BY año asc";
   

      $query = $this->db->query($sql);
      if($query->num_rows() > 0)
      {
         $array = [];
         foreach ($query->result() as $row)
         {
            $array[] = $row;
         }
         $query->free_result();
         return $array;
      }
   }
}
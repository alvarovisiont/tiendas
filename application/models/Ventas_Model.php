<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

   public function traer_clientes()
   {  
         $this->db->distinct();
   		$this->db->select('nombre, cedula, telefono, direccion');
   		$query = $this->db->get('clientes');
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

   public function articulos_modal()
   {
      $this->db->select('nombre, cantidad, precio, marca, grupo');
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

   public function buscar_clientes($filtro,$string)
   {  
         if($string == 1){
            $this->db->like('nombre',$filtro);
            $this->db->or_like('telefono',$filtro);
         }else{
            $this->db->where('cedula', $filtro);
            $this->db->or_like('nombre',$filtro);
            $this->db->or_like('telefono',$filtro);
         }

         $this->db->select('nombre, telefono, direccion');
         $query = $this->db->get('clientes',1);
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
   
   public function traer_articulos($art)
   {	
         $this->db->where('cantidad >', 0);
   		$this->db->like('grupo', $art, 'both');
   		$this->db->or_like('marca', $art, 'both');
   		$this->db->or_like('nombre', $art, 'both');
   		$this->db->select('nombre');
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

   public function agregar_tabla($art, $cantidad,$conf)
   {     
   		$this->db->where('nombre', $art);
         $this->db->where('cantidad >=', $cantidad);
   		$this->db->select('nombre, precio, marca, iva');
   		$query = $this->db->get('inventario');
         
   		if($query->num_rows() > 0)
   		{
   			$fila = $query->row();
            $query->free_result();

            $this->db->select_max('id');
            $query1 = $this->db->get('ventas');
            if($query1->num_rows() > 0)
            {
               
               $filas1 = $query1->row();

               $fila->precio = $fila->precio * $conf->dolar_value;

               $query1->free_result();

               if($filas1->id != "")
               {
                  $id = $filas1->id + 1;
                  $this->db->like('nombre_articulo', $fila->nombre);
                  $this->db->where('id_venta', $id);
                  $query2 = $this->db->get('ventas_detalle');
                  if($query2->num_rows() > 0)
                  {
                     $query2->free_result();
                     return "Repetido";
                  }
                  else
                  {  
                        $sub_total = $cantidad * $fila->precio;
                        $iva_calculado = $conf->iva / 100;
                        $iva = round($sub_total * $iva_calculado);
                        $total = $sub_total + $iva;

                        $array = [  
                                 'id_venta' => $id,
                                 'nombre_articulo' => $fila->nombre,
                                 'marca' => $fila->marca,   
                                 'precio' => $fila->precio,
                                 'cantidad' => $cantidad,
                                 'sub_total' => $sub_total,
                                 'iva' => $iva,
                                 'total' => $total
                              ];
                        $this->db->insert('ventas_detalle', $array);
                        $query2->free_result();
                  }
               }
               else
               {
                  $id = 1;
                  $sub_total = $cantidad * $fila->precio;
                  $iva_calculado = $conf->iva / 100;
                  $iva = round($sub_total * $iva_calculado);
                  $total = $sub_total + $iva;
                  $array = [  
                           'id_venta' => $id,
                           'nombre_articulo' => $fila->nombre,
                           'marca' => $fila->marca,   
                           'precio' => $fila->precio,
                           'cantidad' => $cantidad,
                           'sub_total' => $sub_total,
                           'iva' => $iva,
                           'total' => $total
                        ];
                  $this->db->insert('ventas_detalle', $array);     
               }
            }  
            else
            {
                  $id = 1;
                  $sub_total = $cantidad * $fila->precio;
                  $iva_calculado = $conf->iva / 100;
                  $iva = round($sub_total * $iva_calculado);
                  $total = $sub_total + $iva;
                  $array = [  
                           'id_venta' => $id,
                           'nombre_articulo' => $fila->nombre,
                           'marca' => $fila->marca,   
                           'precio' => $fila->precio,
                           'cantidad' => $cantidad,
                           'sub_total' => $sub_total,
                           'iva' => $iva,
                           'total' => $total
                        ];
                  $this->db->insert('ventas_detalle', $array);
            }
   			return $fila;
   		}
   		else
   		{
   			return false;
   		}
   }

   public function grabar_compra($monto, $tipo, $vuelto,$arreglo_pago)
   {
      return $this->verificar($monto, $tipo, $vuelto,$arreglo_pago);
   }

   private function verificar($monto, $tipo, $vuelto,$arreglo_pago)
   {
      $codigo = "fac-".rand(10000, 100000000);
      $this->db->where('factura', $codigo);
      $query = $this->db->get('ventas');
      if($query->num_rows() > 0)
      {
         $query->free_result();
         $this->verificar();
      }
      else
      {
       
            $array = [ 
               'factura' => $codigo,
               'fecha_venta' => date('Y-m-d'),  
               'monto_pagado' => $monto,
               'vuelto' => $vuelto,
               'tipo_venta' => $tipo,
               'id_descuento' => $arreglo_pago['id_descuento'],
               'monto_descuento' => empty($arreglo_pago['monto_descuento']) ? 0 :  $arreglo_pago['monto_descuento']
            ];      

            if($tipo === "mixto"){
               $array['monto_dolares'] = $arreglo_pago['monto_dolares'];
            }elseif($tipo === "transferencia"){
               $array['nro_transferencia'] = $arreglo_pago['nro_transferencia'];
               $array['id_banco'] = $arreglo_pago['banco_transferencia'];
            }elseif($tipo === "debito"){
               $array['id_banco'] = $arreglo_pago['banco_debito'];
            }elseif($tipo === "visa"){
               $array['monto_dolares'] = $monto;
               $array['monto_pagado'] = $monto * $arreglo_pago['dolar_value'];
            }
                  
            $this->db->insert('ventas', $array);
            $this->db->select_max('id');
            $query = $this->db->get('ventas');
            $id_venta = 0;
            if($query->num_rows() > 0)
            {
               $row = $query->row();
               $id_venta = $row->id;
               $query->free_result();

               $this->set_cantidad_inventario("resta",$id_venta);
            }

         return $id_venta;
      }
   }

   private function set_cantidad_inventario($type,$id_venta){
      $this->db->select('cantidad, nombre_articulo');
      $this->db->where('id_venta', $id_venta);
      $query = $this->db->get('ventas_detalle');

      if($query->num_rows() > 0){
         if($type == "resta"){
            foreach ($query->result() as $row1) {
               $sql = "UPDATE inventario SET cantidad = cantidad - $row1->cantidad where nombre LIKE '%$row1->nombre_articulo%'";
               $this->db->query($sql);
            }
            $query->free_result();
         }else{

            foreach ($query->result() as $row1) {
               $sql = "UPDATE inventario SET cantidad = cantidad + $row1->cantidad where nombre LIKE '%$row1->nombre_articulo%'";
               $this->db->query($sql);
            }
            $query->free_result();
         }
      }

   }

   public function agregar_clientes($array)
   {
      $this->db->select_max('id');
      $query = $this->db->get('ventas');
      if($query->num_rows() > 0)
      {
         $row = $query->row();
         $query->free_result();

         if($row->id < 1 || $row->id == null)
         {
            $array['id_venta'] = 1;
            $this->db->insert('clientes', $array);   
         }
         else
         {
            $array['id_venta'] = $row->id;
            $this->db->insert('clientes', $array);
         }
      }  
   }

   public function eliminar_articulos_flotantes()
   {
      $this->db->select_max('id');
      $query = $this->db->get('ventas');
      if($query->num_rows() > 0)
      {
         $row = $query->row();
         $query->free_result();

         if($row->id < 1 || $row->id == "")
         {
            $this->db->where('id_venta >', 0);
            $this->db->delete('ventas_detalle');   
         }
         else
         {
            $this->db->where('id_venta >', $row->id);
            $this->db->delete('ventas_detalle');     
         }
         
      }
   }

   public function eliminar_articulo($nombre)
   {
      $this->db->select_max('id_venta');
      $query = $this->db->get('ventas_detalle');
      if($query->num_rows() > 0)
      {
         $filas = $query->row();
         $query->free_result();

         $sql = "DELETE from ventas_detalle where nombre_articulo LIKE '%$nombre%' and id_venta = $filas->id_venta";
         $this->db->query($sql);
      }
   }

   public function imprimir_factura()
   {
      $sql = "SELECT v.factura, v.fecha_venta, v.monto_pagado, v.tipo_venta, vd.* FROM ventas v INNER JOIN ventas_detalle vd on vd.id_venta = v.id WHERE v.id = (SELECT MAX(id) from ventas)";
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

   public function buscar_cliente_factura()
   {
      $sql = "SELECT nombre, cedula, telefono, direccion, (SELECT factura from ventas where id = clientes.id_venta) as factura from clientes where id_venta = (SELECT max(id_venta) from clientes)";
      /*$this->db->where('id_venta', $this->db->select_max());
      $this->db->select('nombre, cedula, telefono, direccion, factura');
      $this->db->from('clientes');
      $this->db->join('ventas', 'ventas.id = clientes.id_venta');*/
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

   public function rollback_sell($id){

      $this->set_cantidad_inventario("suma",$id);
      $this->db->where('id_venta',$id)->delete('ventas_detalle');
      $this->db->where('id_venta',$id)->delete('comision');
      $this->db->where('id',$id)->delete('ventas');

   }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }


   public function verificargrupo($grupo)
   {
      $this->db->where('nombre', $grupo);
      $query = $this->db->get('grupo');
      if($query->num_rows() > 0)
      {
         return false;
      }
      else
      {
        $datos = [ 
               'nombre' => $grupo,
               'activo' => 1
            ];     

        $this->db->insert("grupo", $datos);
        return true; 
      }
    }


     public function inicializar()
   {
       $datos = [ 
               'activo' => 0
            ];

       $this->db->update('grupo', $datos);
   }    

    public function marcar($grupo)
   {
       $datos = [ 
               'activo' => 1
            ];
        $this->db->where('nombre', $grupo);     
       $this->db->update('grupo', $datos);
   }    

   public function verificarRef($ref)
   {
      $this->db->where('ref', $ref);
      $query = $this->db->get('inventario');
      if($query->num_rows() > 0)
      {
         return 1;
      }
      else
      {
         return 0;  
      }
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
          $this->db->order_by("inventario.nombre","asc");
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

   public function traer_datos_orden()
   {     
         $this->db->select('inventario.*, proveedores.nombre as proveedor_nombre');
         $this->db->from('inventario');
         $this->db->join('proveedores', 'proveedores.id = inventario.id_proveedor');
         $this->db->join('grupo' , 'grupo.nombre = inventario.grupo');
         $this->db->where('grupo.activo', 1);   

         $this->db->order_by("grupo","ASC");
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


   public function traer_datos_orden_mostrar()
   {     
         $this->db->select('inventario.*, proveedores.nombre as proveedor_nombre');
         $this->db->from('inventario');
         $this->db->join('proveedores', 'proveedores.id = inventario.id_proveedor');
         $this->db->join('grupo' , 'grupo.nombre = inventario.grupo');
         $this->db->where('grupo.activo', 1); 
         $this->db->where('inventario.mostrar', 0);   

         $this->db->order_by("grupo","ASC");
         $this->db->order_by("nombre","ASC");

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


   public function traer_grupo_aux()
   {
      $this->db->distinct();
      $this->db->select('grupo');
      $this->db->order_by("grupo","desc");
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

   public function traer_grupo()
   {
      $this->db->distinct();
      $this->db->select('i.grupo, g.activo');
      $this->db->from('inventario i');
      $this->db->join('grupo g' , 'g.nombre = i.grupo');
      
      $this->db->order_by("i.grupo","desc");
      
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
      $this->db->select('i.id,i.ref, i.nombre, i.marca, i.grupo, i.cantidad, i.precio, i.precio_proveedor, i.fecha_agregado, p.nombre as proveedor');
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


   public function mostrar($id, $mostrar)
   {
       $datos = [ 
               'mostrar' => $mostrar
            ];
        $this->db->where('id', $id);     
       $this->db->update('inventario', $datos);
   }   



   public function cargar()
  {
           //con esta línea cargamos la base de datos prueba
           //y la asignamos a $db_prueba
 
    $db_prueba = $this->load->database('prueba', TRUE);
           //y de esta forma accedemos, no con $this->db->get,
           //sino con $db_prueba->get que contiene la conexión
           //a la base de datos prueba
                $db_prueba->where('id >', 1538);
                $db_prueba->order_by('nombre', 'ASC');

    $usuarios = $db_prueba->get('inventario');

    foreach($usuarios->result() as $fila)
    {
    $data[] = $fila;
    }
    return $data;
  } 
}
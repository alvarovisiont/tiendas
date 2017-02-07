<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados_Model extends CI_Model
{

   function __Construct()
   {

   	parent:: __Construct();
   }

   public function traer_datos()
   {
   	 	$query = $this->db->get('empleados');
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

   public function insertar($array)
   {
   	 $this->db->insert('empleados', $array);
   }

   public function modificar($id, $datos)
   {
   	 $this->db->where('id', $id);
   	 $this->db->update('empleados', $datos);
   }

   public function eliminar($id)
   {
   		$this->db->where('id', $id);
   		$this->db->delete('empleados');
   }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditoria_Model extends CI_Model
{

   function __Construct()
   {

 	//parent:: __Construct();
   }

   public function traer_datos()
   {  
         $this->db->select('u.usuario, a.hora_conexion, a.hora_desconexion, a.motivo, a.accion, a.hora ');
         $this->db->from('auditoria a');
         $this->db->join('usuarios u', 'u.id = a.usuario');
         $this->db->order_by("a.id","ASC");
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

   public function grabar_conexion($arreglito = null)
   {
         $ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));

         $array = [ 
                   'hora_conexion' => $ahora,
                   'hora_desconexion' => $ahora,
                   'accion' => $arreglito['accion'],
                   'motivo' => $arreglito['motivo'],
                   'usuario' => $arreglito['usuario'],
                   'hora' => $ahora,
                  ];

   		$this->db->insert('auditoria', $array);

   		$this->db->select_max('id');
   		$query = $this->db->get('auditoria');

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


   public function grabar_conexion_all($arreglito = null)
   {
         $ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));

         $array = ['usuario' => $this->session->userdata('id'), 
                   'hora_conexion' => $ahora,
                   'hora_desconexion' => $ahora,
                   'accion' => $arreglito['accion'],
                   'motivo' => $arreglito['motivo'],
                   'hora' => $ahora,
                  ];

      $this->db->insert('auditoria', $array);

      $this->db->select_max('id');
      $query = $this->db->get('auditoria');

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




   public function grabar_ultima_conexion()
   {	
		$id = $this->session->userdata('id_auditoria');
      $ahora = date('Y-n-j H:i:s', strtotime('-5 hour'));
      $array = ['hora_desconexion' => $ahora];

		$this->db->where('id', $id);
		$this->db->update('auditoria', $array);
   }
}

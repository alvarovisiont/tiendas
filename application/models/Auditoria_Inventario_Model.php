<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditoria_Inventario_Model extends CI_Model
{

   function __Construct()
   {

   //	parent:: __Construct();
   }
   
   	public function get_auditorias($id_usuario = null){
   		
   		if($id_usuario){
   			$this->db->where('id_usuario',$id_usuario);
   		}
   		return $this->db->get('auditoria_inventario')->result();
   		
   	}

   	public function get_detalle_auditoria($id){
   		return $this->db->where('id_auditoria_inventario',$id)
   					->get('auditoria_inventario_detalle')->result();
   	}

   	public function store_auditoria_invetario($data){
   		
   		$this->db->insert('auditoria_inventario',$data);

   		if($this->db->affected_rows() > 0){
   			return $this->db->insert_id('auditoria_inventario_id_seq');
   		}else{
   			return false;
   		}
   	}

   	public function store_auditoria_invetario_detalle($data){

   		$this->db->insert('auditoria_inventario_detalle',$data);

   		if($this->db->affected_rows() > 0){
   			return $this->db->insert_id('auditoria_inventario_detalle_id_seq');
   		}else{
   			return false;
   		}	


   	}


}
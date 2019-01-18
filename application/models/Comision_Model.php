<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comision_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

  public function get($id = null){
    if($id){
      return $this->db->where('id',$id)->get('comision')->row();
    }else{

    return $this->db->select('comision.*,usuarios.nombre_apellido,ventas.factura')
          ->from('comision')
          ->join('usuarios','usuarios.id = comision.id_empleado','join')
          ->join('ventas','ventas.id = comision.id_venta','join')
          ->order_by('created_at','desc')
          ->get()
          ->result();
    }
  }

  public function get_total_by_month($month = null){
      $sql = "SELECT * from (
                SELECT
                EXTRACT(MONTH from created_at) as mes,
                EXTRACT(YEAR from created_at) as año, 
                SUM(monto) as total, usuarios.nombre_apellido
                FROM comision
                INNER JOIN usuarios ON usuarios.id = comision.id_empleado
                GROUP BY mes,año,nombre_apellido
              ) as t1 order by año desc ,mes desc";

    return $this->db->query($sql)->result();
  }

  public function store($data){
  	$this->db->insert('comision',$data);
  	if($this->db->affected_rows() === 1){
  		return true;
  	}else{
  		return false;
  	}
  }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comision_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

  public function get($id = null,$search = null){
    if($id){
      return $this->db->where('id',$id)->get('comision')->row();
    }else{

      if($search){
        $search.= " AND ventas.status = 1";
      }else{
        $search = "ventas.status = 1";
      }

      return $this->db->select("comision.*,usuarios.nombre_apellido,ventas.factura,TO_CHAR(comision.created_at,'DD-MM-YYYY HH:mm:SS') as fecha1")
          ->from('comision')
          ->join('usuarios','usuarios.id = comision.id_empleado','join')
          ->join('ventas','ventas.id = comision.id_venta','join')
          ->order_by('comision.created_at','desc')
          ->where($search)
          ->get()
          ->result();
    }
  }

  public function get_total_by_month($month = null,$search = null){

      if($search){
        $search.= " AND comision.id_venta IN (SELECT id from ventas where status = 1)";
      }else{
        $search = "comision.id_venta IN (SELECT id from ventas where status = 1)";
      }

      $sql = "SELECT * from (
                SELECT
                EXTRACT(MONTH from created_at) as mes,
                EXTRACT(YEAR from created_at) as año, 
                SUM(monto) as total, usuarios.nombre_apellido
                FROM comision
                INNER JOIN usuarios ON usuarios.id = comision.id_empleado
                WHERE $search
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
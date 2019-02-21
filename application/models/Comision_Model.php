<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comision_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

  public function get($id = null,$search = null, $idempleado = null){
    if($id){
      return $this->db->where('id',$id)->get('comision')->row();
    }else{

      if($idempleado){
        $search.= " and comision.id_empleado = ".$idempleado;
      }
      $sql = "comision.*,usuarios.nombre_apellido,ventas.factura,
       TO_CHAR(comision.created_at,'DD-MM-YYYY HH:MI:SS') as fecha1 ,
        CASE comision.type 
        WHEN true THEN 'acredita' 
        ELSE 'debito' 
        END as type,
        TO_CHAR(comision.anulate_at,'DD-MM-YYYY HH:MI:SS') as fecha2
        ";

      $this->db->select($sql)
          ->from('comision')
          ->join('usuarios','usuarios.id = comision.id_empleado','join')
          ->join('ventas','ventas.id = comision.id_venta','join')
          ->order_by('comision.created_at','desc');
      
      if($search){
        $this->db->where($search);
      }
      return $this->db->get()->result();
    }
  }

  public function get_total_by_month($month = null,$search = null, $idempleado = null){

      if($idempleado){
        $search.= " and comision.id_empleado = ".$idempleado;
      }

      if(!$search){
        $search = "'1'";
      }

      $sql = "SELECT * from (
                SELECT
                EXTRACT(MONTH from t1.created_at) as mes,
                EXTRACT(YEAR from t1.created_at) as año, 
                SUM(monto)as total, usuarios.nombre_apellido,
                t1.id_empleado
                FROM comision as t1
                INNER JOIN usuarios ON usuarios.id = t1.id_empleado
                WHERE $search AND t1.type = true
                GROUP BY mes,año,nombre_apellido,id_empleado
              ) as t1 order by año desc ,mes desc";

    return $this->db->query($sql)->result();
  }

  public function get_total_by_month_anulate($month = null,$search = null, $idempleado = null){

      if($idempleado){
        $search.= " and comision.id_empleado = ".$idempleado;
      }

      if(!$search){
        $search = "'1'";
      }

      $sql = "SELECT * from (
                SELECT
                EXTRACT(MONTH from t1.anulate_at) as mes,
                EXTRACT(YEAR from t1.anulate_at) as año, 
                SUM(monto)as total, usuarios.nombre_apellido,
                t1.id_empleado
                FROM comision as t1
                INNER JOIN usuarios ON usuarios.id = t1.id_empleado
                WHERE $search AND t1.type = false
                GROUP BY mes,año,nombre_apellido,id_empleado
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
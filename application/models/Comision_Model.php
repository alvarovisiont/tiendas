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
        if($search){
          $search.= " and comision.id_empleado = ".$idempleado;
        }else{
          $search.= " comision.id_empleado = ".$idempleado;
        }
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
        if($search){
          $search.= " and comision.id_empleado = ".$idempleado;
        }else{
          $search.= " comision.id_empleado = ".$idempleado;
        }
      }

      if(!$search){
        $search = "'1'";
      }

      $sql = "SELECT *, 
      (total - 
        (
          SELECT COALESCE(sum(monto),0) from comision as t 
          where t.type = false and t1.id_empleado = t.id_empleado
          AND(t1.mes = EXTRACT(MONTH FROM t.anulate_at) AND t1.mes <> EXTRACT(MONTH FROM t.created_at))
          AND ( t1.año = EXTRACT(YEAR FROM t.anulate_at)
        )
      )) as total_nuevo
      from (
        SELECT
        EXTRACT(MONTH from comision.created_at) as mes,
        EXTRACT(YEAR from comision.created_at) as año,
        SUM(comision.monto) as total,
        usuarios.nombre_apellido,
        comision.id_empleado
        FROM comision as comision
        INNER JOIN usuarios ON usuarios.id = comision.id_empleado
        WHERE $search and comision.type = true
        GROUP BY mes,año,nombre_apellido,id_empleado
      ) as t1 order by año desc ,mes desc";

    return $this->db->query($sql)->result();
  }

  /*public function get_total_by_month_anulate($month = null,$search = null, $idempleado = null){

      if($idempleado){
        if($search){
          $search.= " and comision.id_empleado = ".$idempleado;
        }else{
          $search.= " comision.id_empleado = ".$idempleado;
        }
      }

      if(!$search){
        $search = "'1'";
      }

      $sql = "SELECT * from (
                SELECT
                EXTRACT(MONTH from comision.anulate_at) as mes,
                EXTRACT(YEAR from comision.anulate_at) as año, 
                EXTRACT(MONTH from comision.created_at) as mes_creado,
                EXTRACT(YEAR from comision.created_at) as año_creado, 
                SUM(monto)as total, usuarios.nombre_apellido,
                comision.id_empleado
                FROM comision as comision
                INNER JOIN usuarios ON usuarios.id = comision.id_empleado
                WHERE $search AND comision.type = false
                GROUP BY mes,año,nombre_apellido,id_empleado,comision.created_at
              ) as t1 order by año desc ,mes desc";

    return $this->db->query($sql)->result();
  }*/

  public function store($data){
  	$this->db->insert('comision',$data);
  	if($this->db->affected_rows() === 1){
  		return true;
  	}else{
  		return false;
  	}
  }
}
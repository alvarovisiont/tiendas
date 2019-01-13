<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comision_Model extends CI_Model
{

   function __Construct()
   {

   	//parent:: __Construct();
   }

  public function get($id = null){

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
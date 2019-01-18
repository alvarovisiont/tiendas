<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('month_return'))
{
    function month_return($val)
    {
    	$month = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

        return $month[$val - 1];
    }   
}
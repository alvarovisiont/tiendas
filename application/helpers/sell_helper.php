<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('type_payment'))
{
    function type_payment($type,$val){
    	if($type === "mixto"){
    		
    		$val2 = "";
    		$val1 = "";
    		if(count($val) > 0){
    			switch ((INT)$val[0]) {
		    		case 1:
		    			$val2 = "Débito";
		    		break;
					
						case 2:
		    			$val2 = "Visa";
		    		break;

		    		case 3:
		    			$val2 = "Efectivo";
		    		break;

		    		case 4:
		    			$val2 = "Transferencia";
		    		break;    		
		    	}

		    	switch ((INT)$val[1]) {
		    		case 1:
		    			$val1 = "Débito";
		    		break;
					
						case 2:
		    			$val1 = "Visa";
		    		break;

		    		case 3:
		    			$val1 = "Efectivo";
		    		break;

		    		case 4:
		    			$val1 = "Transferencia";
		    		break;    		
		    	}
    		}
		    	
	    	return $type."<br/>(".$val2.','.$val1.")";

    	}else{
    		return $type;
    	}

        return $month[$val - 1];
    }   
}
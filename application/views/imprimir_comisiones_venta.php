<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title></title>
<style type="text/css">

html {
  margin: -10;
}
body {
  font-family: "Arial", serif;
}

.table1 {     font-family: "Arial", "Lucida Grande", Sans-Serif;
    font-size: 12px;     width: 200px; text-align: center;    border-collapse: collapse; }


.table2 {  
    font-family: "Arial", "Lucida Grande", 
    Sans-Serif;
    font-size: 12px;     
    width: 100%; 
    text-align: center;   
     border-collapse: collapse; }

  .table3 {  
    font-family: "Arial", "Lucida Grande", 
    Sans-Serif;
    font-size: 9px;     
    width: 100%; 
     border-collapse: collapse; } 


   .td1{
  padding: 3px;
  text-align: left;
   border-bottom: 0px;
   border-top: 0px;
   border-right: 1px solid black; 
   border-left: 1px solid black;
}

.tr1{
  padding: 8px;
  text-align: left;
   border-bottom: 1px solid black; 
   border-top: 0px;
   border-right: 1px solid black; 
   border-left:  1px solid black; 
}   


</style>
</head>

<body>

<header>

   <table border="1" align="right" class="table1" >
     <tr>
     	<td>FECHA</td>
     </tr>
     <tr>
     	<td> <?php $time = time(); echo date("d/m/Y", $time); ?></td>
     </tr>
   </table>

   <br>

   <?PHP /*

   <table border="1" align="right" class="table2">
     <tr>
     	<td align="left" width="70%">Nombre o Razón Social <br> <B><?php echo $datos->nombre; ?><B> </td>
     	<td align="left"  width="30%" >C.I / R.I.F <br> <B> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $datos->cedula; ?><B> </td>
     </tr>
   </table>
  <table border="1" align="right" class="table2">
     <tr>
     	<td align="left" width="70%">Dirección Físcal <br> <B><?php echo $datos->direccion; ?><B> </td>	
     </tr>
   </table>
  <table border="1" align="right" class="table2">
     <tr>
     	<td align="left" width="70%">Teléfono <br> <B><?php echo $datos->telefono; ?><B> </td>	
     </tr>
   </table>
   <br>
    
   */ 
   ?>
   <table border="1" class="table2" >
  
     <tr>
      <th align="center" width="15%">Usuario</th>
      <th align="center" width="15%">Factura</th>
     	<th align="center" width="10%">Porcentaje</th>
     	<th align="center" width="15%">Monto</th>
     	<th align="center" width="15%">Fecha Venta</th>
     	<th align="center" width="15%">Tipo</th>	
      <th align="center" width="15%">Fecha Anulación</th>  
     </tr>  
 </table>

 <table border="1" class="table2" >

 	   <?php 
				foreach ($data as $row) 
				 { ?>

           <tr>
              <td align="center"  height="4" width="15%"> 
                <?php echo $row->nombre_apellido; ?>    
              </td>

              <td align="center"  height="4" width="15%"> 
                <?php echo $row->factura; ?>    
              </td>

               <td align="center"  height="4" width="10%"> 
                <?php echo $row->porcentaje.' %';  ?>    
              </td>

               <td align="center"  height="4" width="15%"> 
                <span class="badge letras" 
                style="background-color: darkred; color: white;"> <?php echo 
                number_format($row->monto,2,',','.'); ?> Bs.S</span>   
              </td>

               <td align="center"  height="4" width="15%"> 
                <?php echo $row->fecha1; ?>    
              </td>

               <td align="center"  height="4" width="15%"> 
                <?php echo $row->type; ?>    
              </td>

               <td align="center"  height="4" width="15%"> 
                <?php echo $row->fecha2; ?>    
              </td>
           </tr>   


				<?php } ?>		

 </table>	
 
   <br>
   <br> 

  <div style="width: 45%; float: left; padding-right: 10%">
				Observaciones: <br>
				_____________________________________________
				
	</div>

</body>
</html>


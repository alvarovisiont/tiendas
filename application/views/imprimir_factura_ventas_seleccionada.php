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
  <?php $cd = substr ($datos->factura, 0, 3);

  if ($cd == 'Pre'){ } else { ?>
  <br>
  <br>
  <br>
  <br>  
 <?php } ?>
  
   <table border="1" align="right" class="table1" >
     <tr>
      <td>FECHA</td>
      <td>N° FACTURA</td>
     </tr>
     <tr>
      <td> <?php $time = time(); echo date("d/m/Y", $time); ?></td>
      <td> <B><?php echo $datos->factura; ?></B></td>
     </tr>
   </table>

   <br>

   <table border="1" align="right" class="table2">
     <tr>
      <td align="left" width="70%">Nombre o Razón Social <br> <B><?php echo strtoupper($datos->nombre); ?><B> </td>
      <td align="left"  width="30%" >C.I / R.I.F <br> <B> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($datos->cedula); ?><B> </td>
     </tr>
   </table>
  <table border="1" align="right" class="table2">
     <tr>
      <td align="left" width="70%">Dirección Físcal <br> <B><?php echo strtoupper($datos->direccion); ?><B> </td>  
     </tr>
   </table>
  <table border="1" align="right" class="table2">
     <tr>
      <td align="left" width="70%">Teléfono <br> <B><?php echo $datos->telefono; ?><B> </td>  
     </tr>
   </table>
   <br>


   <table border="1" class="table3" >
  
     <tr>
      <th align="center" width="10%">CODIGO</th>
      <th align="center" width="55%">DESCRIPCIÓN</th>
      <th align="center" width="5%">CANT</th>
      <th align="center" width="15%">PRECIO</th>
      <th align="center" width="15%">IMPORTE</th> 
     </tr>
    
 </table>

 <table border="1" class="table3" >

     <?php 
         if(!empty($data))
        {
            $sub_total = 0;
            $total = 0;
            $iva = 0;

        }
        foreach ($data as $row) 
         {
              $sub_total = $sub_total + $row->sub_total;
              $total = $total + $row->total;
              $iva = $iva + $row->iva;

         ?>
          <tr>
              <td align="center"  height="4" width="10%" class="td1"> <?php echo $row->ref; ?></td>
                 <td align="center" height="4" width="55%" class="td1"> <?php echo $row->nombre_articulo; ?></td>
                 <td align="center" height="4" width="5%" class="td1"><?php echo $row->cantidad; ?></td>
                 <td align="center" height="4" width="15%" class="td1"><?php echo $pre = number_format($row->precio,2,",","."); ?></td>
                 
                 <td align="center" height="4" width="15%" class="td1"><?php echo $sub = number_format($row->sub_total,2,",","."); ?></td>  
               </tr>

        <?php }   


              $total = $total - $row->monto_descuento;
        
     ?>   

 <tr>
    <td align="center" width="10%" class="td1" > &nbsp;</td>
      <td align="center" width="55%" class="td1"> &nbsp;</td>
      <td align="center" width="5%" class="td1" > &nbsp;</td>
      <td align="center" width="15%"  class="td1"> &nbsp;</td>
   
      <td align="center" width="15%"  class="td1"> &nbsp;</td>  
     </tr>

 <tr>
    <td align="center" width="10%" class="td1" > &nbsp;</td>
      <td align="center" width="55%" class="td1"> &nbsp;</td>
      <td align="center" width="5%" class="td1" > &nbsp;</td>
      <td align="center" width="15%"  class="td1"> &nbsp;</td>
   
      <td align="center" width="15%"  class="td1"> &nbsp;</td>  
     </tr>

<tr>
    <td align="center" width="10%" class="td1" > &nbsp;</td>
      <td align="center" width="55%" class="td1"> &nbsp;</td>
      <td align="center" width="5%" class="td1" > &nbsp;</td>
      <td align="center" width="15%"  class="td1"> &nbsp;</td>
   
      <td align="center" width="15%"  class="td1"> &nbsp;</td>  
     </tr>     


 </table> 

  <table border="1" class="table2" >
  
     <tr>
      <th align="center" width="20%">Subtotal</th>
      <th align="center" width="20%">Descuento</th>
      <th align="center" width="20%">Base imponible</th>
      <th align="center" width="30%">Total Impuesto</th>
      <th align="center" width="30%">TOTAL FACTURA </th>  
     </tr>
      <tr>
      <th align="center" width="20%"><?php echo $sub1 = number_format($sub_total,2,",","."); ?></th>
       <th align="center" width="20%"><?php 
        $variporce = $row->monto_descuento * 100;
        $variporce = $variporce / $sub_total;

        $variporce = number_format($variporce);

       echo $variporce." % ---->".$sub2 = number_format($row->monto_descuento,2,",","."); ?></th>
      <th align="center" width="20%"><?php 
      echo $sub3 = number_format($sub_total - $row->monto_descuento ,2,",",".");?></th>
      <th align="center" width="30%"><?php 
      echo "Iva ".$config->iva." % = ".$iva1 = number_format($iva,2,",","."); ?></th>
      <th align="center" width="30%"><?php echo $total1 = number_format($total,2,",","."); ?> </th> 
     </tr>
    
 </table>
   <br>
     <table border="1" align="right" class="table1" >
     <tr>
     
      <td align="center"  > Forma de Pago</td>
       <td align="center" > <?php echo strtoupper($row->tipo_venta); ?></td>
     </tr>
    <?php $cadetipo = strtoupper($row->tipo_venta); 

        if ($cadetipo == 'TRANSFERENCIA'){

          if ($row->id_banco == 1 ){
            $banco = "VENEZOLANO";
          } 

           if ($row->id_banco == 2 ){
            $banco = "BANESCO";
          } 

           if ($row->id_banco == 3 ){
            $banco = "MERCANTIL";
          } 

          ?>

      <tr>
     
      <td align="center"  ><?php echo $banco ?></td>
       <td align="center" > <?php echo $row->nro_transferencia; ?></td>
     </tr>


       <?php }
      ?>
   </table>

</body>
</html>

<?php /*


              <tr>
                 <td align="center" width="50%" class="td1"> <?php echo $row->nombre_articulo." Marca: ".$row->marca; ?></td>
                 <td align="center" width="10%" class="td1"><?php echo $row->cantidad; ?></td>
                 <td align="center" width="15%" class="td1"><?php echo $pre = number_format($row->precio,2,",","."); ?></td>
                 <td align="center" width="10%" class="td1"> &nbsp;</td>
                 <td align="center" width="15%" class="td1"><?php echo $sub = number_format($row->sub_total,2,",","."); ?></td> 
               </tr>

             <?php    

             /*
              echo '
              <tr>
                <td>'.$row->nombre_articulo.'</td>
                <td>'.$row->marca.'</td>
                <td>'.number_format($row->precio,2,",",".").'</td>
                <td>'.$row->cantidad.'</td>
                <td>'.number_format($row->sub_total,2,",",".").'</td>
                <td>'.number_format($row->iva,2,",",".").'</td>
                <td>'.number_format($row->total,2,",",".")." ".$this->session->userdata('siglas').'</td>
              </tr>';   
            }

              echo '<tr>
                  <td colspan="2">Sub-total</td>
                  <td colspan="6" align="right" style="padding-right: 9%"><strong>'.number_format($sub_total,2,",",".")." ".$this->session->userdata('siglas').'</strong></td>
                </tr>
                <tr>
                  <td colspan="2">Iva</td>
                  <td colspan="6" align="right" style="padding-right: 9%"><strong>'.number_format($iva,2,",",".")." ".$this->session->userdata('siglas').'</strong></td>
                </tr>
                <tr>
                  <td colspan="2">Total</td>
                  <td colspan="6" align="right" style="padding-right: 9%"><strong>'.number_format($total,2,",",".")." ".$this->session->userdata('siglas').'</strong></td>
                </tr>';
          */
                ?>
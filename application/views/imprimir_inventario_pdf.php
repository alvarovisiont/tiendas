<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title></title>
<style type="text/css">

html {
  margin: 0;
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
    font-size: 12px;     
    width: 100%; 
     border-collapse: collapse; } 


   .td1{
  padding: 8px;
  text-align: left;
   border-bottom: 0px;
   border-top: 0px;
   border-right: 1px solid black; 
   border-left: 1px solid black;
}

 .td2{
  padding: 8px;
  text-align: left;
   border-bottom: 1px solid black; 
   border-top: 1px solid black; 
   border-right: 1px solid black;  
   border-left: 0px; 
}

.td3{
  padding: 8px;
  text-align: left;
   border-bottom: 1px solid black; 
   border-top: 1px solid black; 
   border-right: 0px;  
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


tr:nth-child(even) {
	
    background-color:#f2f2f2;
	
}
	
tr:nth-child(odd) {
	
    background-color:#FFFFFF;
	
}  


</style>
</head>

<body>

<header>

   <table border="1" align="right" class="table2">
     <tr>
      <td align="left" width="50%" class="td3"><h1>Inventario </h1>
      <B><?php $time = time(); echo date("d/m/Y H:i:s", $time); ?></B></td>
      <td align="left" width="50%" class="td2"><h2>INVERSIONES BET- SUR AL, C.A </h2>   
     </tr>
   </table>

		<table cellpadding="" border="1" cellspacing=""  class="table2">
  			<thead>
				<tr>
					<th style="text-align: center;">&nbsp;Referencia&nbsp;</th>
					<th style="text-align: center;">&nbsp;Descripción del Artículo&nbsp;</th>
					<th style="text-align: center;">&nbsp;Existencias&nbsp;</th>
          <th style="text-align: center;">&nbsp;&nbsp;Físico&nbsp;&nbsp;</th>
					<th style="text-align: center;">&nbsp;Coste Un.&nbsp;</th>
					<th style="text-align: center;">&nbsp;P. M. Coste&nbsp;</th>
					<th style="text-align: center;">&nbsp;Coste Total&nbsp;</th>
					<th style="text-align: center;">&nbsp;Precio Venta&nbsp;</th>
				</tr>
			</thead>
			<tbody style="text-align: center;">
				<?php 
					if(!empty($datos))
					{
						foreach ($datos as $row) 
						{
               $variableprecio = 0;
               $variableprecio = number_format($row->precio * $config->dolar_value);


							echo '
							<tr>
								<td></td>
								<td>'.$row->nombre.' '.$row->marca.'</td>
								<td>'.$row->cantidad.'</td>
                <td></td>
								<td>'.$row->precio_proveedor.'</td>
								<td></td>
								<td></td>
								<td>'.$variableprecio.' Bs.S</td>
							</tr>';		
						}
					}
				?>	
			</tbody>
		</table>
	
</body>
</html>


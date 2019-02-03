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
      <td align="left" width="50%" class="td3"><h2>INVERSIONES BET- SUR AL, C.A </h2>   
      <B><?php $time = time(); echo date("d/m/Y H:i:s", $time); ?></B></td>
      <td align="left" width="50%" class="td2"><h1>Listado de Precios </h1>
     </tr>
   </table>

		<table cellpadding="" border="1" cellspacing=""  class="table2">
  			<thead>
				<tr>
					<th style="text-align: center;">&nbsp;Referencia&nbsp;</th>
					<th style="text-align: center;">&nbsp;Descripción del Artículo&nbsp;</th>
					<th style="text-align: center;">&nbsp;Marca&nbsp;</th>
					<th style="text-align: center;">&nbsp;Precio Venta&nbsp;</th>
				</tr>
			</thead>
			<tbody style="text-align: center;">
				<?php 
					if(!empty($datos))
					{
            $total = 0;
            $total_total = 0;
            $total_total_sub = 0;
            $aux = "";

						foreach ($datos as $row) 
						{
               $variableprecio = 0;
               $costo_total = 0;
          
               $variableprecio = number_format($row->precio * $config->dolar_value,2,',','.');
               $variablecosto = number_format($row->cantidad * $row->precio,2,',','.');
               $total = $total + $row->cantidad;
               $total_total = $row->cantidad * $row->precio;
               $total_total_sub = $total_total_sub + $total_total;

               if ($aux <> $row->grupo)
               {

                echo '
              <tr>
                <td colspan="4" align="left">'.$row->grupo.'</td>
              </tr>';  

               }

               $aux = $row->grupo;
      
							echo '
							<tr>
								<td>'.$row->ref.'</td>
								<td>'.$row->nombre.'</td>
								<td>'.$row->marca.'</td>
								<td>'.$variableprecio.' Bs.S</td>
							</tr>';		
						}

          ?>
				<?php	}
				?>	
			</tbody>
		</table>
	
</body>
</html>


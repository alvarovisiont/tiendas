<?php 
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = $dias[date('w',strtotime("- 5 hour"))]." ".date('d',strtotime("- 5 hour"))." de ".$meses[date('n')-1]. " del ".date('Y');

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Inventario.xls");
?>
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
  margin: 20mm 8mm 15mm 8mm;
}

table {     font-family: "Arial", "Lucida Grande", Sans-Serif;
    font-size: 12px;    margin: 45px;     width: 480px; text-align: center;    border-collapse: collapse; }

th {     font-size: 13px;     font-weight: bold;     padding: 8px;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid black; }

td {    padding: 8px; border-bottom: 1px solid black;
    border-top: 1px solid transparent; }

</style>
</head>
<body>
<header>
	<div>
	<span style=""><?php echo $fecha; ?></span>
	</div>
	<br>
<br>			
</header>
	<section>
		<table width="100%" cellpadding="" border="1" cellspacing="">
  			<thead>
  			<tr>
    			<td colspan="8" style="font-size: 15px"><CENTER><strong style="text-decoration: underline;">Inventario de la empresa</strong></CENTER></td>
  			</tr>
				<tr>
					<th style="text-align: center;">Referencia</th>
					<th style="text-align: center;">Descripción del Artícul</th>
					<th style="text-align: center;">Existencia</th>
					<th style="text-align: center;">Físico</th>
					<th style="text-align: center;">Costo Proveedor.</th>
					<th style="text-align: center;">Costo Nuevo.</th>
					<th style="text-align: center;">Costo Unitario.</th>
					<th style="text-align: center;">Costo Subtotal</th>
					<th style="text-align: center;">Precio Venta</th>
				</tr>
			</thead>
			<tbody style="text-align: center;">
				<?php 
				  $total = 0;
	              $total_total = 0;
	              $total_total_sub = 0;

					if(!empty($datos))
					{
						foreach ($datos as $row) 
						{
						   $variableprecio = 0;
			               $costo_total = 0;
			          
			               $variableprecio = number_format($row->precio * $config->dolar_value,2,',','.');

			               $variablecosto = number_format($row->cantidad * $row->precio,2,',','.');
			               $total = $total + $row->cantidad;
			               $total_total = $row->cantidad * $row->precio;
			               $total_total_sub = $total_total_sub + $total_total;

						echo '
							<tr>
								<td>'.$row->ref.'</td>
								<td>'.$row->nombre.'</td>
								<td>'.$row->cantidad.'</td>
								<td></td>
								<td>'.$row->precio_proveedor.'</td>
								<td></td>
								<td>'.$row->precio.'</td>
								<td>'.$variablecosto.'</td>
								<td>'.$variableprecio.'</td>
							</tr>';		
						}
					}
				?>	

				 <tr>
          <th style="text-align: center;"></th>
          <th style="text-align: center;">&nbsp;Existencia de piezas&nbsp;</th>
          <th style="text-align: center;">&nbsp;<?php echo $total;?>&nbsp;</th>
          <th style="text-align: center;">&nbsp;&nbsp;</th>
          <th style="text-align: center;">&nbsp;Costo Total Inventario&nbsp;</th>
          <th style="text-align: center;">&nbsp;<?php echo $total_total_sub = number_format($total_total_sub,2,',','.');?>&nbsp;</th>
          <th style="text-align: center;">&nbsp;&nbsp;</th>
        </tr>
			</tbody>
		</table>
	</section>
</body>
</html>


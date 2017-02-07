<?php
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = $dias[date('w',strtotime("- 5 hour"))]." ".date('d',strtotime("- 5 hour"))." de ".$meses[date('n')-1]. " del ".date('Y');

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
  
}

table {     font-family: "Arial", "Lucida Grande", Sans-Serif;
    font-size: 12px;     width: 480px; text-align: center;    border-collapse: collapse; }

th {     font-size: 13px;     font-weight: bold;     padding: 8px;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid black; }

td {    padding: 8px; border-bottom: 1px solid black;
    border-top: 1px solid transparent; }

.logo{
text-align: right;
padding: 20px;
}
.centrar {
text-align: center;
}

.logo
{
	float: left;
}
.clear{
clear: both;
}

.div_proveedor
{
	border: solid 1px skyblue;
	width: 100%;
	height: 30px;
}

</style>
</head>
<body>
<header>
	<div class="clear"></div>
	<div class="logo">
		<?php echo $fecha; ?>
	</div>
	<div class="logo">
		<?php
		if(!empty($this->session->userdata('logo')))
		{
		?>
			<img src="./img/<?php echo $this->session->userdata('logo'); ?>" alt="" width="100px" height="100px" style='float: left; display:inline-block'>
		<?php
		}
		?>	
		<h2 class="centrar"><?php echo $this->session->userdata('empresa'); ?></h2>
	</div>
	<div class="clear"></div>
	<div class="">
		<p><strong>Factura Nº </strong><span style="color: darkred;"><?php echo $datos->factura; ?></span></p>
	</div>
	<div class="div_proveedor">
		<p>Nombre y Apellido o razón Social: <span style="text-decoration: underline;"><?php echo $datos->nombre; ?></span></p>
		<p>Rif/C.I: <span style="text-decoration: underline;"><?php echo $datos->cedula; ?></span></p>
		<p>Domicilio Físcal: <span style="text-decoration: underline;"><?php echo $datos->direccion; ?></span></p>
	</div>
</header>
	<section>
		<br><br>
		<table width="100%" cellpadding="" border="1" cellspacing="" class="table">
  			<thead>
  			<tr>
    			<td colspan="7" style="font-size: 15px"><CENTER><strong style="text-decoration: underline;">Artículos Comprados</strong></CENTER></td>
  			</tr>
				<tr>
					<th style="text-align: center;">Nombre_Artículo</th>
					<th style="text-align: center;">Marca</th>
					<th style="text-align: center;">Precio</th>
					<th style="text-align: center;">Cantidad</th>
					<th style="text-align: center;">Sub-total</th>
					<th style="text-align: center;">Iva</th>
					<th style="text-align: center;">Total</th>
				</tr>
			</thead>
			<tbody style="text-align: center;">
				<?php 
					if(!empty($data))
					{
						$sub_total = "";
						$total = "";
						$iva = "";
						foreach ($data as $row) 
						{
							$sub_total = $sub_total + $row->sub_total;
							$total = $total + $row->total;
							$iva = $iva + $row->iva;
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
									<td>Sub-total</td>
									<td colspan="6" align="right" style="padding-right: 5%"><strong>'.number_format($sub_total,2,",",".")." ".$this->session->userdata('siglas').'</strong></td>
								</tr>
								<tr>
									<td>Iva</td>
									<td colspan="6" align="right" style="padding-right: 5%"><strong>'.number_format($iva,2,",",".")." ".$this->session->userdata('siglas').'</strong></td>
								</tr>
								<tr>
									<td>Total</td>
									<td colspan="6" align="right" style="padding-right: 5%"><strong>'.number_format($total,2,",",".")." ".$this->session->userdata('siglas').'</strong></td>
								</tr>';
					}
				?>	
			</tbody>
		</table>
		<br><br>
		<div style="width: 100%">
			<div style="width: 30%; float: left; padding-right: 5%;">
				<strong>Condiciones de Pago:</strong><br>
				Contado( ) Crédito a ___ Días
			</div>
			<div style="width: 30%; float: left; padding-right: 5%;">
				<strong>Esta factura va sin tachadura ni enmendadura</strong>
			</div>
			<div style="width: 30%;">
				<strong>Iva: </strong><?php echo $this->session->userdata('iva')."%"; ?>
			</div>
		</div>
		<br><br>
		<div style="width: 100%">
			 <div style="width: 45%; float: left; padding-right: 10%">
				_____________________________________________<br>
				Nombre y Apellido de quien recibe Sello y Firma
			</div>
			<div>
				<span style="color: darkred">Copia: SIN DERECHO A CREDITO FíSCAL</span>
			</div>
		</div>
		<br>
		<div style="width: 100%; border: solid 1px lightgray; text-align: center">
			ESTA FACTURA GENERA INTERESES DE MORA A LA FECHA DE SU VENCIMIENTO A LA TASA VIGENTE DEL MERCADO
		</div>
	</section>
</body>
</html>


<div class="row">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal_filtro">Filtrar&nbsp;<i class="fa fa-search"></i></button>
			</div>
		</div>
		<div class="col-md-3" style="margin-top: 30px;">
			<h3 class="text-center">Totales Generales</h3>
			<div class="col-md-12 box_total">
				<h3>Transferencia</h3>
				<br>
				<span class="badge verde_badge" id="badge_transferencia"><?= number_format($totales->total_transferencia,2,',','.')." ".$config->siglas; ?></span>
			</div>
			
			<div class="col-md-12 box_total">
				<h3>Dolares</h3>
				<span class="badge verde_badge" id="badge_dolares">
					<?= $totales->total_dolares.'$' ?></span>
				<br>
				<br>
				<span class="badge verde_badge" id="badge_dolares_bs">
					<?= number_format($totales->total_dolares_bs,2,',','.').' '.$config->siglas ?></span>
			</div>
			<div class="col-md-12 box_total">
				<h3>Efectivo</h3>
				<br>
				<span class="badge verde_badge" id="badge_efectivo"><?= number_format($totales->total_efectivo,2,',','.')." ".$config->siglas; ?></span>
			</div>
			<div class="col-md-12 box_total">
				<h3>Debito</h3>
				<br>
				<span class="badge verde_badge" id="badge_debito"><?= number_format($totales->total_debito,2,',','.')." ".$config->siglas; ?></span>
			</div>
			<div class="clearfix"></div>
			<br>
			<button class="btn btn-warning btn-block" data-toggle="modal" data-target="#modal_transferencias"><b>Total Transferencias y Montos</b></button>
			
		</div>
		<div class="col-md-9" style="margin-top: 50px;">
			<div class="panel panel-black">
				<div class="panel-heading">
					<h3>Totales del día</h3>
				</div>
				<div class="panel-body">	
					<table class="table table-bordered" id="tabla_totales">  
						<thead>
							<tr>
								<th class="text-center">Método de pago</th>
								<th class="text-center">Monto</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="letras_black">Transferencia</td>
								<td class="text-right"><span class="badge rojo_badge"><?= number_format($totales_day->total_transferencia,2,',','.')." ".$config->siglas; ?></span></td>
							</tr>
							<tr>
								<td class="letras_black">Visa</td>
								<td class="text-right"><span class="badge rojo_badge"><?= $totales_day->total_dolares."$ - ". number_format($totales_day->total_dolares_bs,2,',','.')." ".$config->siglas; ?></span></td>
							</tr>
							<tr>
								<td class="letras_black">Efectivo</td>
								<td class="text-right"><span class="badge rojo_badge"><?= number_format($totales_day->total_efectivo,2,',','.')." ".$config->siglas; ?></span></td>
							</tr>
							<tr>
								<td class="letras_black">Débito</td>
								<td class="text-right"><span class="badge rojo_badge"><?= number_format($totales_day->total_debito,2,',','.')." ".$config->siglas; ?></span></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" class="text-right"><b style="font-size: 20px;">TOTAL: <?= number_format($totales_day->total_totales,2,',','.')." ".$config->siglas; ?></b></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<br>
			
			<div class="panel panel-black">
				<div class="panel-heading">
					<h3>Monto de transferencias hechas por banco</h3>
				</div>
				<div class="panel-body">

					<table class="table table-striped" id="tabla_trans">
						<thead>
							<tr>
								<th class="text-center">Punto</th>
								<th class="text-center">Monto</th>
							</tr>
						</thead>
						<tbody class="text-center">
							<?
								foreach ($transferencia_dia as $row) {
									echo "<tr>
													<td>{$row->nombre}</td>
													<td><span class='badge rojo_badge'>".number_format($row->total,2,',','.')."</span></td>
												</tr>";
								}
							?>
						</tbody>
					</table>

					<!--
					<div id="chart_trans_day" style="width: 100%; height: 200px;"></div>
					-->
				</div>
			</div>
			<br>
			<div class="panel panel-black">
				<div class="panel-heading">
					<h3>Monto de debito</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped" id="tabla_debito">
						<thead>
							<tr>
								<th class="text-center">Punto</th>
								<th class="text-center">Monto</th>
							</tr>
						</thead>
						<tbody class="text-center">
							<?
								foreach ($debito_total as $row) {
									echo "<tr>
													<td>{$row->nombre}</td>
													<td><span class='badge rojo_badge'>".number_format($row->total,2,',','.')."</span></td>
												</tr>";
								}
							?>
						</tbody>
					</table>
					<!--
					<div id="chart_debit_day" style="width: 100%; height: 200px;"></div>
					-->
				</div>
			</div>	
		</div>
	</div>	
</div>
<div class="modal fade" id="modal_filtro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Filtros de Busqueda</h3>
	      </div>
	      <form id="form_filter" class="form-horizontal">
		      <div class="modal-body">
		      	<div class="form-group">
		      		<div class="col-md-6">
		      			<label class="control-label">Desde</label>
		      			<input type="date" name="desde_filtro" id="desde_filtro" class="form-control">
		      		</div>
		      		<div class="col-md-6">
		      			<label class="control-label">hasta</label>
		      			<input type="date" name="hasta_filtro" id="hasta_filtro" class="form-control">
		      		</div>
		      	</div>
		      </div>
		      <div class="modal-footer">
		      	<button class="btn btn-default" type="button" data-dismiss='modal'>Cerrar&nbsp;<i class="fa fa-remove"></i></button>
		      	<button class="btn btn-success" type="submit" id="btn_filter">Aceptar&nbsp;<i class="fa fa-thumbs-up"></i></button>
		      </div>
		    </form>
    </div>
	</div>
</div>

<div class="modal fade" id="modal_transferencias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Total de Transferencias y pagos por Puntos</h3>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="panel panel-dark">
	      				<div class="panel-heading">
	      					<h3>Historial pago por Transferencias</h3>
	      				</div>
	      				<div class="panel-body">
	      					<div id="chart_trans_day" style="width: 100%; height: 200px;"></div>
	      				</div>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="panel panel-dark">
	      				<div class="panel-heading">
	      					<h3>Historial pago por Puntos</h3>
	      				</div>
	      				<div class="panel-body">
	      					<div id="chart_debit_day" style="width: 100%; height: 200px;"></div>
	      				</div>
	      			</div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	      	<button class="btn btn-default" type="button" data-dismiss='modal'>Cerrar&nbsp;<i class="fa fa-remove"></i></button>
	      </div>
    </div>
	</div>
</div>


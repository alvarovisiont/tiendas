<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br>
			<div class="col-md-6 col-sm-6 col-xl-12 col-md-offset-3 col-sm-offset-3">
				<button class="btn btn-primary btn-block" data-target="#modal_filtros" data-toggle="modal">Filtrar&nbsp;<i class="fa fa-search"></i></button>
			</div>
			<br>
			<br>
			<br>
			<div class="panel panel-black">
				<div class="panel-heading">
					<h3>Comisiones Registradas&nbsp;&nbsp;<i class="fa fa-percentaje"></i></h3>	
				</div>
				<div class="panel-body">
					<table class="table table-streped table-hover" id="tabla">
						<thead>
							<th class="text-center">Trabajador</th>
							<th class="text-center">Factura</th>
							<th class="text-center">Porcentaje</th>
							<th class="text-center">Monto</th>
							<th class="text-center">Fecha Venta</th>
						</thead>
						<tbody class="text-center">
							<?php
								foreach ($data as $row) {
									echo "<tr>
											<td>$row->nombre_apellido</td>
											<td>$row->factura</td>
											<td>$row->porcentaje %</td>
											<td><span class='badge letras' style='background-color: darkred; color: white;'>".number_format($row->monto,2,',','.')." Bs.S</span></td>
											<td>$row->fecha1</td>
										</tr>";
								}
							?>
						</tbody>
					</table>	
				</div>
			</div>
			<div class="panel panel-black">
				<div class="panel-heading">
					<h3>Total Pagar por Mes</h3>	
				</div>
				<div class="panel-body">
					<table class="table table-streped table-hover" id="tabla_grupal">
						<thead>
							<th class="text-center">Trabajador</th>
							<th class="text-center">Monto</th>
							<th class="text-center">Mes</th>
							<th class="text-center">Año</th>
						</thead>
						<tbody class="text-center">
							<?php

								foreach ($datos as $row) 
								{
									echo "<tr>
											<td>$row->nombre_apellido</td>
											<td><span class='badge letras' style='background-color: darkred; color: white;'>".number_format($row->total,2,',','.')."</span></td>
											<td>".month_return($row->mes)."</td>
											<td>$row->año</td>
										</tr>";
								}
								
							?>
						</tbody>
					</table>	
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_filtros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Filtros de Registros</h3>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
    				<div class="col-md-6">
    					<label class="control-label">Desde</label>
							<input type="date" name="desde" id="desde" class="form-control">
						</div>
						<div class="col-md-6">
							<label class="control-label">Hasta</label>
							<input type="date" name="hasta" id="hasta" class="form-control">
						</div>  
						<br/>			
						<div class="col-md-6">
							<label class="control-label">Trabajador</label>
							<select class="form-control" id="worker" name="worker">
								<?= $select_worker; ?>
							</select>
						</div>  			
	      	</div>
	      </div>
	      <div class="modal-footer">
	      	<button class="btn btn-default btn-md" type="button" data-dismiss="modal">Cerrar&nbsp;<i class="fa fa-remove"></i></button>
	      	<button class="btn btn-success" id="btn_filter"><span id="span_filter">Fitrar</span>&nbsp;<i class="fa fa-search"></i></button>
	      </div>
    	</div>
	</div>
</div>
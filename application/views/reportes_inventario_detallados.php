<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br><br>
			<form action="<?php echo base_url().'Reportes_inventario/imprimir_reporte'; ?>" id="form_reporte" method="POST" class="form-horizontal">
				<div class="form-group">
					<label for="" class="control-label col-md-2">Proveedores</label>
					<div class="col-md-2">
						<select name="proveedor" id="proveedor" class="form-control">
							<option value=""></option>
							<?php
							if(!empty($datos))
							{
								foreach ($datos as $row)
								{
									echo "<option value='$row->id'>$row->nombre</option>";
								}
							}
							?>
						</select>
					</div>
					<label for="" class="control-label col-md-2">Fecha_agregado_desde</label>
					<div class="col-md-2">
						<input type="text" name="fecha_desde" id="fecha_desde" class="form-control">
					</div>
					<label for="" class="control-label col-md-2">Fecha_agregado_hasta</label>
					<div class="col-md-2">
						<input type="text" name="fecha_hasta" id="fecha_hasta" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-2">Cantidad mayor que</label>
					<div class="col-md-2">
						 <input type="number" name="cantidad_mayor_que" id="cantidad_mayor_que" class="form-control">
					</div>
					<label for="" class="control-label col-md-2">Cantidad menor que</label>
					<div class="col-md-2">
						 <input type="number" name="cantidad_menor_que" id="cantidad_menor_que" class="form-control">
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="col-md-offset-1 col-md-3">
						<button type="button" class="btn btn-primary btn-block btn-md" id="mostrar_reporte">Mostrar Reporte&nbsp;<i class="fa fa-arrow-down"></i></button>
					</div>
					<div class="col-md-3">
						<button type="button" class="btn btn-danger btn-block btn-md" id="imprimir_pdf">Reporte PDF&nbsp;<i class="fa fa-file-pdf-o"></i></button>
					</div>
					<div class="col-md-3">
						<button type="button" class="btn btn-success btn-block btn-md" id="imprimir_excel">Reporte EXCEL&nbsp;<i class="fa fa-file-excel-o"></i></button>
					</div>
				</div>
				<br><br>
				<div class="form-group">
					<div class="col-md-4 col-md-offset-3" id="barra_oculta" style="display:none">
						<div class="progress progress-striped active">
							  	<div class="progress-bar progress-bar-warning" role="progressbar"
							       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
							       style="width: 100%">
							       <span>Cargando...</span>
							    	<span class="sr-only">45% completado</span>
							  </div>
						</div>
					</div>
				</div>
			</form>
			<br><br>
			<table class="table table-striped table-hover" id="tabla_reporte">
				<thead>
					<th>Proveedor</th>
					<th>Nombre</th>
					<th>Marca</th>
					<th>Grupo</th>
					<th>Cantidad</th>
					<th>Costo</th>
					<th>Precio</th>
					<th>Fecha_agregado</th>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
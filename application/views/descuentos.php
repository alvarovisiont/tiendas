<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br>
			<br>
			<div class="col-md-12">
				<section id="section_datos">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-4">
									<h3 style="color: white; display: inline-block;">Descuentos Realizados</h3>	
								</div>
								<div class="col-md-offset-5 col-md-3">
									<button class="btn btn-success btn-md" id="agregar_descuentos">Agregar Descuento <i class="fa fa-plus"></i></button>	
								</div>
							</div>
						</div>
						<div class="panel-body">
							<table class="table table-streped table-hover">
								<thead>
									<th class="text-center">Nombre</th>
									<th class="text-center">Tipo</th>
									<th></th>
								</thead>
								<tbody class="text-center">
									<?php
										if(!empty($descuentos))
										{
											foreach ($descuentos as $row) 
											{
												if($row->status == 1)
												{
													$boton = "<button class='btn btn-success btn-md activar' data-id= '$row->id'>Activar</button>";
												}
												else
												{
													$boton = "<button class='btn btn-success btn-md desactivar' data-id= '$row->id'>Desactivar</button>";	
												}
												echo "<tr>
														<td>$row->nombre</td>
														<td>$row->tipo</td>
														<td>$boton</td>
														<td>
															<button class='btn btn-warning btn-sm'>&nbsp;&nbsp;<i class='fa fa-edit'></i></button>
															<button class='btn btn-danger btn-sm eliminar_descuento' data-ruta ='".base_url()."Caja/eliminar/descuento".$row->id."'>&nbsp;&nbsp;<i class='fa fa-trash'></i></button>
														</td>
													</tr>";
											}
										}
										else
										{
											echo "<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>";
										}
									?>
								</tbody>
							</table>	
						</div>
					</div>
				</section>
				<section id="section_oculto" style="display: none">
					<div class="col-md-12 text-center">
						<button class="btn btn-primary btn-md" id="ver_descuentos">Ver descuentos <i class="fa fa-eye"></i></button>
					</div>
					<br>
					<br><br>
					<form class="form-horizontal" id="form_agregar" action="<?php echo base_url().'Caja/agregar_descuento'; ?>" method="POST">
						<div class="form-group">
							<label class="control-label col-md-3">Nombre</label>
							<div class="col-md-8">
								<input type="text" name="nombre_descuento" id="nombre_descuento" required="" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Tipo de Descuento</label>
							<div class="col-md-3">
								<label class="radio-inline"><input type="radio" name="tipo" id="tipo" required="" value="1">Para Facturazión Nomal</label>
							</div>
							<div class="col-md-3">
								<label class="radio-inline"><input type="radio" name="tipo" id="tipo"  value="2">Para Puntos de Venta</label>
							</div>
							<div class="col-md-3">
								<label class="radio-inline"><input type="radio" name="tipo" id="tipo"  value="3">Para Ambos</label>
							</div>
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
</div>
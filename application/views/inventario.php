<?php
	$session = $this->session->userdata('nivel');
?>
<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br>
			<div class="col-md-12">
				<div class="col-md-offset-6 col-md-3">
					<button type="button" class="btn btn-danger btn-md btn-block btn-outline" data-ruta="<?php echo base_url().'Inventario/exportar_pdf';?>" id="exportar_pdf">Exportar a PDF&nbsp;<i class="fa fa-file-pdf-o"></i></button>
				</div>
				<div class="col-md-3">
					<button class="btn btn-success btn-md btn-block btn-outline" data-ruta="<?php echo base_url().'Inventario/exportar_excel';?>" id="exportar_excel">Exportar a EXCEL&nbsp;<i class="fa fa-file-excel-o"></i></button>
				</div>
			</div>
			<br><br>
			<br>
			<div class="panel panel-green">
				<div class="panel-heading">
					<h3>Inventario del Almacen&nbsp;&nbsp;<i class="fa fa-book"></i>
					<?php 
					if($session == 1)
					{
					?>
						<button class="btn btn-default btn-md" style="float: right" data-toggle="modal" data-target="#agg_articulo">Agregar Artículo&nbsp;<i class="fa fa-plus"></i></button>
					<?php
					}
					?>
					</h3>
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-bordered table-hover table-condensed">
						<thead>
							<th class="text-center">Artículo</th>
							<th class="text-center">Marca</th>
							<th class="text-center">Grupo</th>
							<th class="text-center">Costo</th>
							<th class="text-center">Precio Venta</th>
							<th class="text-center">Cantidad</th>
							<th class="text-center">Fecha_Registro</th>
							<th class="text-center">Proveedor</th>
							<th class="text-center">Observación</th>
							<?php 
								if($session == 1)
								{
								?>
									<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<?php
								}
							 ?>
						</thead>
						<tbody class="text-center">
							<?php
								if(!empty($datos))
								{
									foreach ($datos as $row) 
									{
										if($row->cantidad < 10)
										{
											if($session == 1)
											{
												echo "<tr class='alert alert-danger'>
														<td>$row->nombre</td>
														<td>$row->marca</td>
														<td>$row->grupo</td>
														<td>$row->precio_proveedor</td>
														<td>$row->precio</td>
														<td><span class='label label-info letras'>$row->cantidad</span></td>
														<td>".date('d-m-Y' ,strtotime($row->fecha_agregado))."</td>
														<td>$row->proveedor_nombre</td>
														<td>$row->observacion</td>
														
														<td>
															<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modi_articulo'
																data-id_modi = '$row->id'
																data-nombre_modi = '$row->nombre'
																data-marca_modi = '$row->marca'
																data-precio_modi = '$row->precio'
																data-iva_modi = '$row->iva'
																data-cantidad_modi = '$row->cantidad'
																data-grupo_modi = '$row->grupo'
																data-proveedor_modi = '$row->id_proveedor'
																data-fecha_modi = '".date('d-m-Y',strtotime($row->fecha_agregado))."'
																data-observacion_modi = '$row->observacion'><i class='fa fa-edit'></i>
																</button>
															<button class='btn btn-danger btn-sm' id='eliminar_articulo' data-ruta ='".base_url()."Inventario/eliminar/".$row->id."'><i class='fa fa-trash'></i></button>
														</td>
													</tr>";
											}
											else
											{
												echo "<tr class='alert alert-danger'>
														<td>$row->nombre</td>
														<td>$row->marca</td>
														<td>$row->grupo</td>
														<td>$row->precio_proveedor</td>
														<td>$row->precio</td>
														<td><span class='label label-info letras'>$row->cantidad</span></td>
														<td>".date('d-m-Y' ,strtotime($row->fecha_agregado))."</td>
														<td>$row->proveedor_nombre</td>
														<td>$row->observacion</td>
													</tr>";	
											}

										}
										elseif ($row->cantidad >= 10 && $row->cantidad < 100) 
										{
											if($session == 1)
											{
												echo "<tr class='alert alert-warning'>
														<td>$row->nombre</td>
														<td>$row->marca</td>
														<td>$row->grupo</td>
														<td>$row->precio_proveedor</td>
														<td>$row->precio</td>
														<td><span class='label label-info letras'>$row->cantidad</span></td>
														<td>".date('d-m-Y' ,strtotime($row->fecha_agregado))."</td>
														<td>$row->proveedor_nombre</td>
														<td>$row->observacion</td>
														<td>
															<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modi_articulo'
																data-id_modi = '$row->id'
																data-nombre_modi = '$row->nombre'
																data-marca_modi = '$row->marca'
																data-precio_modi = '$row->precio'
																data-cantidad_modi = '$row->cantidad'
																data-grupo_modi = '$row->grupo'
																data-proveedor_modi = '$row->id_proveedor'
																data-fecha_modi = '".date('d-m-Y',strtotime($row->fecha_agregado))."'
																data-observacion_modi = '$row->observacion'><i class='fa fa-edit'></i>
																</button>
															<button class='btn btn-danger btn-sm' id='eliminar_articulo' data-ruta ='".base_url()."Inventario/eliminar/".$row->id."'><i class='fa fa-trash'></i></button>
														</td>
													</tr>";	
											}
											else
											{
												echo "<tr class='alert alert-warning'>
														<td>$row->nombre</td>
														<td>$row->marca</td>
														<td>$row->grupo</td>
														<td>$row->precio_proveedor</td>
														<td>$row->precio</td>
														<td><span class='label label-info letras'>$row->cantidad</span></td>
														<td>".date('d-m-Y' ,strtotime($row->fecha_agregado))."</td>
														<td>$row->proveedor_nombre</td>
														<td>$row->observacion</td>
													</tr>";		
											}
												
										}
										elseif ($row->cantidad >= 100) 
										{
											if($session == 1)
											{
												echo "<tr class='alert alert-success'>
														<td>$row->nombre</td>
														<td>$row->marca</td>
														<td>$row->grupo</td>
														<td>$row->precio_proveedor</td>
														<td>$row->precio</td>
														<td><span class='label label-info letras'>$row->cantidad</span></td>
														<td>".date('d-m-Y' ,strtotime($row->fecha_agregado))."</td>
														<td>$row->proveedor_nombre</td>
														<td>$row->observacion</td>
														<td>
															<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modi_articulo'
																data-id_modi = '$row->id'
																data-nombre_modi = '$row->nombre'
																data-marca_modi = '$row->marca'
																data-costo_modi = '$row->precio_proveedor'
																data-precio_modi = '$row->precio'
																data-grupo_modi = '$row->grupo'
																data-cantidad_modi = '$row->cantidad'
																data-proveedor_modi = '$row->id_proveedor'
																data-fecha_modi = '".date('d-m-Y',strtotime($row->fecha_agregado))."'
																data-observacion_modi = '$row->observacion'><i class='fa fa-edit'></i>
																</button>
															<button class='btn btn-danger btn-sm eliminar_articulo' data-ruta ='".base_url()."Inventario/eliminar/".$row->id."'><i class='fa fa-trash'></i></button>
														</td>
													</tr>";
											}
											else
											{
												echo "<tr class='alert alert-success'>
														<td>$row->nombre</td>
														<td>$row->marca</td>
														<td>$row->grupo</td>
														<td>$row->precio_proveedor</td>
														<td>$row->precio</td>
														<td><span class='label label-info letras'>$row->cantidad</span></td>
														<td>".date('d-m-Y' ,strtotime($row->fecha_agregado))."</td>
														<td>$row->proveedor_nombre</td>
														<td>$row->observacion</td>
													</tr>";	
											}
												
										}
											//
									}
								}
								else
								{
									if($session == 1)
									{
										echo "<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>";
									}
									else
									{
										echo "<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>";	
									}
								}
							?>
						</tbody>
					</table>	
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modi_articulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-header2" style="background-color: #FFF">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Modificar Artículo&nbsp;<i class="fa fa-book"></i></h3>
	      </div>
			<form action="<?php echo base_url().'Inventario/modificar'; ?>" method="POST" id="form_modi" class="form-horizontal">
			<input type="hidden" id="id_modificar" name="id_modificar">
	          	<div class="modal-body">
	          		<div class="row">
	          			<div class="form-group">
	          				<label for="marca" class="control-label col-md-3">Marca</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-github-alt" aria-hidden="true"></i></span> 
	              					<input type="text" class="form-control" name="marca_modi" id="marca_modi" required="">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="marca" class="control-label col-md-3">Proveedor</label>
	          				<div class="col-md-8">
	          					<select class="form-control" id="proveedor_modi" name="proveedor_modi">
	          						<option></option>
	          						<?php
	          							if($proveedores != "")
	          							{
	          								foreach ($proveedores as $row) 
	          								{
	          									echo "<option value='$row->id'>$row->nombre</option>";
	          								}
	          							}
	          						?>
	          					</select>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="nombre_modi" class="control-label col-md-3">Nombre</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-cart-plus" aria-hidden="true"></i></span> 
	              					<input type="text" class="form-control" name="nombre_modi" id="nombre_modi" required="">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="marca" class="control-label col-md-3">Grupo</label>
	          				<div class="col-md-7">
	          					<select class="form-control" id="grupo_modi" name="grupo_modi">
	          						<option></option>
	          						<?php
	          							if($grupo != "")
	          							{
	          								foreach ($grupo as $row) 
	          								{
	          									echo "<option value='$row->grupo'>$row->grupo</option>";
	          								}
	          							}
	          						?>
	          					</select>
	          				</div>
	          				<div class="col-md-1">
	          					<button type="button" class="btn btn-info btn-sm" title="Agregar grupo" data-toggle="modal" data-target="#agg_grupo"><i class="fa fa-plus"></i></button>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="precio" class="control-label col-md-3">Costo</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span> 
	              					<input type="number" class="form-control" name="costo_modi" id="costo_modi" required="">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="precio" class="control-label col-md-3">Precio de venta</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span> 
	              					<input type="number" class="form-control" name="precio_modi" id="precio_modi" required="">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="marca" class="control-label col-md-3">Iva</label>
	          				<div class="col-md-8">
	          					<select class="form-control" id="iva_modi" name="iva_modi">
	          						<?php 
	          							if($this->session->has_userdata('iva'))
	          							{
	          								echo "<option value='".$this->session->userdata('iva')."'>".$this->session->userdata('iva')."</option>
	          									<option value='0'>Excento de Iva</option>";
	          							}
	          							else
	          							{
	          								echo "<option>Debe Completar los datos en el modulo de configuración</option>";
	          							}
	          						 ?>
	          					</select>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="marca" class="control-label col-md-3">Proveedor</label>
	          				<div class="col-md-8">
	          					<select class="form-control" id="proveedor_modi" name="proveedor_modi">
	          						<option></option>
	          						<?php
	          							if($proveedores != "")
	          							{
	          								foreach ($proveedores as $row) 
	          								{
	          									echo "<option value='$row->id'>$row->nombre</option>";
	          								}
	          							}
	          						?>
	          					</select>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="cantidad" class="control-label col-md-3">Cantidad</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"> 
	              					<input type="number" class="form-control" name="cantidad_modi" id="cantidad_modi" required="">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="nombre" class="control-label col-md-3">Fecha de registro</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span> 
	              					<input type="text" class="form-control text-center" name="fecha_registro_modi" id="fecha_registro_modi" required="" readonly="" style="font-weight: bold;">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="observacion" class="control-label col-md-3">Observación</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i></span> 
	              					<textarea name="observacion_modi" id="observacion_modi" cols="30" rows="4" class="form-control" placeholder="No es obligatorio"></textarea>
	          					</div>
	          				</div>
	          			</div>
	          		</div>
	          	</div>
	          	<div class="modal-footer">
	              	<button type="submit" class="btn btn-danger">Modificar&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i></button>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar&nbsp;&nbsp;<i class="fa fa-remove"></i></button>
	            </div>
	      </form>
	    </div>
	  </div>
</div>
<div class="modal fade" id="agg_articulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-header2" style="background-color: #FFF">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Agregar Artículo&nbsp;<i class="fa fa-book"></i></h3>
	      </div>
			<form action="<?php echo base_url();?>Inventario/agregar" method="POST" id="form_agregar" class="form-horizontal">
	          	<div class="modal-body">
	          		<div class="row">
	          			<div class="form-group">
	          				<label for="marca" class="control-label col-md-3">Marca</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-github-alt" aria-hidden="true"></i></span> 
	              					<input type="text" class="form-control" name="marca" id="marca" required="">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="marca" class="control-label col-md-3">Proveedor</label>
	          				<div class="col-md-8">
	          					<select class="form-control" id="proveedor" name="proveedor">
	          						<option></option>
	          						<?php
	          							if($proveedores != "")
	          							{
	          								foreach ($proveedores as $row) 
	          								{
	          									echo "<option value='$row->id'>$row->nombre</option>";
	          								}
	          							}
	          						?>
	          					</select>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="nombre" class="control-label col-md-3">Nombre Producto</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-cart-plus" aria-hidden="true"></i></span> 
	              					<input type="text" class="form-control" name="nombre" id="nombre" required="">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="marca" class="control-label col-md-3">Grupo</label>
	          				<div class="col-md-7">
	          					<select class="form-control" id="grupo" name="grupo">
	          						<option></option>
	          						<?php
	          							if($grupo != "")
	          							{
	          								foreach ($grupo as $row) 
	          								{
	          									echo "<option value='$row->grupo'>$row->grupo</option>";
	          								}
	          							}
	          						?>
	          					</select>
	          				</div>
	          				<div class="col-md-1">
	          					<button type="button" class="btn btn-info btn-sm" title="Agregar grupo" data-toggle="modal" data-target="#agg_grupo"><i class="fa fa-plus"></i></button>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="precio" class="control-label col-md-3">Costo</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span> 
	              					<input type="number" class="form-control" name="costo" id="costo" required="">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="precio" class="control-label col-md-3">Precio de venta</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span> 
	              					<input type="number" class="form-control" name="precio" id="precio" required="">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="marca" class="control-label col-md-3">Iva</label>
	          				<div class="col-md-8">
	          					<select class="form-control" id="iva" name="iva">
	          						<?php 
	          							if($this->session->has_userdata('iva'))
	          							{
	          								echo "<option value='".$this->session->userdata('iva')."'>".$this->session->userdata('iva')."</option>
	          									<option value='0'>Excento de Iva</option>";
	          							}
	          							else
	          							{
	          								echo "<option>Debe Completar los datos en el modulo de configuración</option>";
	          							}
	          						 ?>
	          					</select>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="cantidad" class="control-label col-md-3">Cantidad</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"> 
	              					<input type="number" class="form-control" name="cantidad" id="cantidad" required="">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="nombre" class="control-label col-md-3">Fecha de registro</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span> 
	              					<input type="text" class="form-control text-center" name="fecha_registro" id="fecha_registro" required="" readonly="" value="<?php echo date('d-m-Y', strtotime("-5 hour")); ?>" style="font-weight: bold;">
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="observacion" class="control-label col-md-3">Observación</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i></span> 
	              					<textarea name="observacion" id="observacion" cols="30" rows="4" class="form-control" placeholder="No es obligatorio"></textarea>
	          					</div>
	          				</div>
	          			</div>
	          		</div>
	          	</div>
	          	<div class="modal-footer">
	          		<?php 
	          			if($this->session->has_userdata('iva'))
	          			{
	          				echo '<button type="submit" class="btn btn-danger">Agregar&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i></button>';
	          			}
	          			else
	          			{
	          				echo '<button type="submit" class="btn btn-danger" disabled>Agregar&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i></button>';
	          			}
	          		 ?>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar&nbsp;&nbsp;<i class="fa fa-remove"></i></button>
	            </div>
	      </form>
	    </div>
	  </div>
</div>
<div class="modal fade" id="agg_grupo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      <div class="modal-header modal-header2" style="background-color: #FFF">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Agregar Grupo&nbsp;<i class="fa fa-file"></i></h3>
	      </div>
	      <div class="modal-body">
	      	<input type="text" name="agregar_grupo" id="agregar_grupo" required="" class="form-control">
	      </div>
	      <div class="modal-footer">
	      	<button class="btn btn-success btn-md" type="button" id="boton_agregar_grupo">Agregar&nbsp;<i class="fa fa-thumbs-up"></i></button>
	      </div>
    	</div>
	</div>
</div>
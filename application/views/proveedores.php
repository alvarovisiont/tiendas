<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br>
			<br>
			<br>
			<section id="section_table">
				<div class="panel panel-green">
					<div class="panel-heading">
						<h3 style="display: inline-block">Proveedores&nbsp;&nbsp;<i class="fa fa-truck"></i></h3>
						<button class="btn btn-default btn-md col-md-offset-7" id="agregar_proveedor">Agregar Proveedor&nbsp;<i class="fa fa-plus"></i>&nbsp;<i class="fa fa-users"></i></button>
					</div>
					<div class="panel-body tabla_modal">
						<table class="table table-streped table-hover" id="tabla">
							<thead>
								<th class="text-center">Nombre</th>
								<th class="text-center">Teléfono</th>
								<th class="text-center">Email</th>
								<th class="text-center">Dirección</th>
								<th class="text-center">Rif</th>
								<th class="text-center">Fax</th>
							
								<th class="text-center">Acción&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
							</thead>
							<tbody class="text-center">
								<?php
									if(!empty($datos))
									{
										foreach ($datos as $row) 
										{
											echo "<tr>
													<td>$row->nombre</td>
													<td><span class='label label-success letras'>$row->telefono</span></td>
													<td>$row->email</td>
													<td>$row->direccion</td>
													<td>$row->rif</td>
													<td>$row->fax</td>
													";

													if ($row->id <> 1){

													echo "<td>
															<button class='btn btn-warning btn-md' data-toggle='modal' title='Modificar' data-target='#modi_provee'
															data-id = '$row->id'
															data-nombre = '$row->nombre'
															data-telefono = '$row->telefono'
															data-email = '$row->email'
															data-direccion = '$row->direccion'
															data-fax = '$row->fax'
															data-rif = '$row->rif'>
															<i class='fa fa-edit'></i></button>
															<button class='btn btn-danger btn-md eliminar_provee' title='Eliminar' data-ruta ='".base_url()."Proveedores/eliminar' data-id = '$row->id'><i class='fa fa-trash'></i></button>
													</td>";
													}	
													else
													{

													 echo "<td>	</td>";
													} 
										
												   echo "</tr>";
										}
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
											</tr>";
									}
								?>
							</tbody>
						</table>
					</div>		
				</div>
			</section>
			<section id="section_oculto" style="display: none;">
			<button class="btn btn-primary btn-md" id="mostrar_datos" style="display:none">Mostrar Datos&nbsp;<i class="fa fa-eye"></i></button>
				<h3 class="text-center">
					Agregar Proveedor
				</h3>
				<form class="form-horizontal" action="<?php echo base_url().'Proveedores/agregar'; ?>" id="form_agregar" method="POST">
	      			<div class="form-group">
	      				<label class="control-label col-md-2">Nombre</label>
	      				<div class="col-md-8">
		      				<div class="input-group">
      							<span class="input-group-addon"><i class="fa fa-building"></i></span>
		      					<input type="text" name="nombre" id="nombre" required="" class="form-control" placeholder="Nombre de la Empresa">
		      				</div>
		      			</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-2">Telefono</label>
	      				<div class="col-md-8">
	      					<div class="input-group">
	      						<span class="input-group-addon"><i class="fa fa-phone"></i></span>
	      						<input type="number" name="telefono" id="telefono" pattern="[0-9]{11}" required="" class="form-control" placeholder="Teléfono de la Empresa">
	      					</div>
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-2">Dirección</label>
	      				<div class="col-md-8">
	      					<div class="input-group">
	      						<span class="input-group-addon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
	      						<input type="text" name="direccion" id="direccion" required="" class="form-control" placeholder="Dirección de la Empresa">
	      					</div>
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-2">Rif</label>
	      				<div class="col-md-8">
	      					<div class="input-group">
	      						<span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
	      						<input type="text" name="rif" id="rif" required="" class="form-control" placeholder="Rif de la Empresa">
	      					</div>
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-2">Página Web</label>
	      				<div class="col-md-8">
	      					<div class="input-group">
	      						<span class="input-group-addon"><i class="fa fa-laptop" aria-hidden="true"></i></span>
	      						<input type="text" name="pagina_web" id="pagina_web" class="form-control" placeholder="Página de la Empresa">
	      					</div>
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-2">Fax</label>
	      				<div class="col-md-8">
	      					<div class="input-group">
	      						<span class="input-group-addon"><i class="fa fa-fax" aria-hidden="true"></i></span>
	      						<input type="text" name="fax" id="fax" class="form-control" placeholder="Fax de la Empresa">
	      					</div>
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-2">Email</label>
	      				<div class="col-md-8">
	      					<div class="input-group">
      							<span class="input-group-addon">@</span>
	      						<input type="email" name="email" id="email" class="form-control" placeholder="Correo de la Empresa">
	      					</div>
	      				</div>
	      			</div>
	      	<div class="form-group text-center">
	      		<div class="col-md-offset-4 col-md-4">
	      			<button type="submit" class="btn btn-danger btn-block">Agregar&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i></button>
	      		</div>
	        </div>
	      </form>
			</section>
		</div>
	</div>
</div>
<div class="modal fade" id="articulos_provee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document" class="tabla_modal">
	    <div class="modal-content">
	      <div class="modal-header modal-header2" style="background-color: #FFF">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Artículos del Proovedor&nbsp;<i class="fa fa-book"></i></h3>
	      </div>
	      	<div class="modal-body">
	      		<div class="row">
					<div class="col-md-12" id="div_tabla">
						
					</div>
	      		</div>
	      	</div>
	      	<div class="modal-footer">
	      	<?php
	      	/*
	          	<button type="submit" class="btn btn-danger">Modificar&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i></button>
	            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar&nbsp;&nbsp;<i class="fa fa-remove"></i></button>
	           */
	        ?>
	        </div>
	    </div>
	  </div>
</div>
<!--<div class="modal fade" id="agg_provee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document" class="tabla_modal">
	    <div class="modal-content">
	      <div class="modal-header modal-header2" style="background-color: #FFF">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Agregar Proveedor&nbsp;<i class="fa fa-user-plus"></i></h3>
	      </div>
	      <form class="form-horizontal" action="<?php// echo base_url().'Proveedores/agregar'; ?>" id="form_agregar" method="POST">
	      	<div class="modal-body">
	      		<div class="row">
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Nombre</label>
	      				<div class="col-md-8">
	      					<input type="text" name="nombre" id="nombre" required="" class="form-control">
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Telefono</label>
	      				<div class="col-md-8">
	      					<input type="number" name="telefono" id="telefono" pattern="[0-9]{11}" required="" class="form-control">
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Email</label>
	      				<div class="col-md-8">
	      					<input type="email" name="email" id="email" class="form-control">
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Dirección</label>
	      				<div class="col-md-8">
	      					<input type="text" name="direccion" id="direccion" class="form-control">
	      				</div>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="modal-footer">
	          	<button type="submit" class="btn btn-danger">Agregar&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i></button>
	            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar&nbsp;&nbsp;<i class="fa fa-remove"></i></button>
	        </div>
	      </form>
	    </div>
	  </div>
</div>-->
<div class="modal fade" id="modi_provee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document" class="tabla_modal">
	    <div class="modal-content">
	      <div class="modal-header modal-header2" style="background-color: #FFF">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Modificar Proveedor&nbsp;<i class="fa fa-user-plus"></i></h3>
	      </div>
	      <form class="form-horizontal" action="<?php echo base_url().'Proveedores/modificar'; ?>" id="form_agregar" method="POST">
	      <input type="hidden" name="id_modificar" id="id_modificar">
	      	<div class="modal-body">
	      		<div class="row">
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Nombre</label>
	      				<div class="col-md-8">
	      					<input type="text" name="nombre_modi" id="nombre_modi" required="" class="form-control">
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Telefono</label>
	      				<div class="col-md-8">
	      					<input type="number" name="telefono_modi" id="telefono_modi" pattern="[0-9]{11}" required="" class="form-control">
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Email</label>
	      				<div class="col-md-8">
	      					<input type="email" name="email_modi" id="email_modi" class="form-control">
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Dirección</label>
	      				<div class="col-md-8">
	      					<input type="text" name="direccion_modi" id="direccion_modi" class="form-control">
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Fax</label>
	      				<div class="col-md-8">
	      					<input type="text" name="fax_modi" id="fax_modi" class="form-control">
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Rif</label>
	      				<div class="col-md-8">
	      					<input type="text" name="rif_modi" id="rif_modi" class="form-control">
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

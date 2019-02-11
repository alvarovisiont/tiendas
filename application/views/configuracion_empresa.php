<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<section id="section_table">
				<div class="col-md-12">
					<div class="col-md-6">
						<h2 style="display: inline-block">Datos de la Empresa&nbsp;&nbsp;<i class="fa fa-building"></i></h2>		
					</div>
					<div class="col-md-3">
					<br>
						<?php
							if(empty($datos))
							{
							?>
								<button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#agg_datos_empresa">Agregar datos&nbsp;&nbsp;<i class="fa fa-building"></i>&nbsp;&nbsp;<i class="fa fa-plus"></i></button>
							<?php
							}
							else
							{
								?>	
								<button type="button" class="btn btn-warning  btn-md" data-toggle="modal" data-target="#modi_datos_empresa"
									data-id = "<?php echo $datos->id; ?>"
									data-nombre = '<?php echo $datos->nombre; ?>'
									data-direccion = "<?php echo $datos->direccion; ?>"
									data-telefono = "<?php echo $datos->telefono; ?>"
									data-rif = "<?php echo $datos->rif; ?>"
									data-fax = "<?php echo $datos->fax; ?>"
									data-factura = "<?php echo $datos->factura; ?>"
									data-prefactura = "<?php echo $datos->prefactura; ?>"
									data-email = "<?php echo $datos->email; ?>"
									data-logo = "<?php echo $datos->logo; ?>">Modificar Datos&nbsp;&nbsp;<i class="fa fa-building"></i>&nbsp;&nbsp;<i class="fa fa-pencil"></i></button>
					</div>
							<?php
							}
						?>
				</div>
			<br><br><br><br><br>
				<table class="table table-striped table-responsive">
					<tbody class="text-center">
						<tr>
							<td><label class="control-label col-md-2">Factura</label><span class="control-label col-md-10" id="factura"><?php if(!empty($datos)){ echo $datos->factura; } ?></span></td>
							<td><label class="control-label col-md-2">PreFactura</label><span class="control-label col-md-10" id="prefactura">
							<?php if(!empty($datos)){ echo $datos->prefactura;} ?></span></td>
						</tr>

						<tr>
							<td><label class="control-label col-md-2">Nombre</label><span class="control-label col-md-10" id="nombre"><?php if(!empty($datos)){ echo $datos->nombre; } ?></span></td>
							<td><label class="control-label col-md-2">Dirección</label><span class="control-label col-md-10" id="direccion"><?php if(!empty($datos)){ echo $datos->direccion;} ?></span></td>
						</tr>
						<tr>
							<td><label class="control-label col-md-2">Telefonos</label><span class="control-label col-md-10" id="telefono"><?php if(!empty($datos)){ echo $datos->telefono;} ?></span></td>
							<td><label class="control-label col-md-2">Rif</label><span class="control-label col-md-10" id="rif"><?php if(!empty($datos)){ echo $datos->rif;} ?></span></td>
						</tr>
						<tr>
							<td><label class="control-label col-md-2">Email</label><span class="control-label col-md-10" id="email"><?php if(!empty($datos)){ echo $datos->email;} ?></span></td>
							<td><label class="control-label col-md-2">Fax</label><span class="control-label col-md-10" id="fax"><?php if(!empty($datos)){ echo $datos->fax;} ?></span></td>
						</tr>
						<tr>
							<td><label class="control-label col-md-2">Logo</label><span class="col-md-offset-3 col-md-4" id="fax"><?php if(!empty($datos->logo)){ echo "<img src='./img/$datos->logo' class='img-responsive' width='100px'>";} ?></span></td>
						</tr>
					</tbody>
				</table>
			</section>
			<br><br>
			<section id="section_encargado">
				<div class="col-md-12">
					<div class="col-md-6">
						<h2 style="display: inline-block">Datos del Encargado&nbsp;&nbsp;<i class="fa fa-user"></i></h2>		
					</div>
					<div class="col-md-3">
					<br>
						<?php
							if(empty($data->nombre_encargado))
							{
							?>
							<button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#agg_datos_encargado">Agregar datos&nbsp;&nbsp;<i class="fa fa-user-plus"></i>&nbsp;&nbsp;<i class="fa fa-plus"></i></button>	
							<?php
							}
							else
							{
								?>
								<button type="button" class="btn btn-warning  btn-md" data-toggle="modal" data-target="#modi_datos_encargado"
									data-id_encargado = "<?php echo $data->id_encargado; ?>"
									data-nombre_encargado = "<?php echo $data->nombre_encargado; ?>"
									data-cedula_encargado = "<?php echo $data->cedula; ?>"
									data-telefono_encargado = "<?php echo $data->telefono_encargado; ?>"
									data-correo_encargado = "<?php echo $data->correo_encargado; ?>"
									>Modificar Datos&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;&nbsp;<i class="fa fa-pencil"></i></button>
							<?php
							}
						?>
					</div>
				</div>	
				<table class="table table-striped table-responsive">
					<tbody class="text-center">
						<tr>
							<td><label class="control-label col-md-2">Nombre</label><span class="control-label col-md-10" id="nombre"><?php if(!empty($data->nombre_encargado)){ echo $data->nombre_encargado; } ?></span></td>
							<td><label class="control-label col-md-2">Cédula</label><span class="control-label col-md-10" id="direccion"><?php if(!empty($data->cedula)){ echo $data->cedula;} ?></span></td>
						</tr>
						<tr>
							<td><label class="control-label col-md-2">Teléfono</label><span class="control-label col-md-10" id="telefono"><?php if(!empty($data->telefono_encargado)){ echo $data->telefono_encargado;} ?></span></td>
							<td><label class="control-label col-md-2">Email</label><span class="control-label col-md-10" id="rif"><?php if(!empty($data->correo_encargado)){ echo $data->correo_encargado;} ?></span></td>
						</tr>
					</tbody>
				</table>
			</section>
		</div>
	</div>
</div>
<div class="row">
	<div class="modal fade" id="agg_datos_encargado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
		      <div class="modal-header modal-header2" style="background-color: #FFF">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        <h3 class="text-center">Agregar Datos&nbsp;<i class="fa fa-user-plus"></i></h3>
		      </div>
		      <form action="<?php echo base_url().'Configuracion/guardar_encargado';?>" class="form-horizontal" method="POST" id="form_agregar_encargado">
		      	<div class="modal-body">
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Nombre Completo</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-building-o"></i></span>
		      					<input type="text" required="" name="nombre_encargado" id="nombre_encargado" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Cédula</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-home"></i></span>
		      					<input type="text" required="" name="cedula_encargado" id="cedula_encargado" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">telefono</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
		      					<input type="text" required="" name="telefono_encargado" id="telefono_encargado" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Email</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon">@</span>
		      					<input type="email" required="" name="email_encargado" id="email_encargado" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Email</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon">@</span>
		      					<input type="email" required="" name="email_encargado" id="email_encargado" class="form-control">
		      				</div>
		      			</div>
		      		</div>
			    <div class="modal-footer">
			      	<button class="btn btn-success btn-md" type="submit" id="boton_agregar_grupo">Agregar&nbsp;<i class="fa fa-thumbs-up"></i></button>
			      	<button class="btn btn-default btn-md" type="button" data-dismiss="modal">cerrar&nbsp;<i class="fa fa-remove"></i></button>
			    </div>
		      </form>
	    	</div>
		</div>
	</div>	
</div>
<div class="row">
	<div class="modal fade" id="modi_datos_encargado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
		      <div class="modal-header modal-header2" style="background-color: #FFF">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        <h3 class="text-center">Modificar Datos&nbsp;<i class="fa fa-user"></i>&nbsp;&nbsp;<i class="fa fa-pencil"></i></h3>
		      </div>
		      <form action="<?php echo base_url().'Configuracion/modificar_encargado';?>" class="form-horizontal" method="POST" id="form_agregar_encargado">
		      <input type="hidden" id="id_modificar" name="id_modificar">
		      	<div class="modal-body">
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Nombre Completo</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-building-o"></i></span>
		      					<input type="text" required="" name="nombre_encargado_modi" id="nombre_encargado_modi" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Cédula</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-home"></i></span>
		      					<input type="text" required="" name="cedula_encargado_modi" id="cedula_encargado_modi" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">telefono</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
		      					<input type="text" required="" name="telefono_encargado_modi" id="telefono_encargado_modi" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Email</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon">@</span>
		      					<input type="email" name="correo_encargado_modi" id="correo_encargado_modi" class="form-control">
		      				</div>
		      			</div>
		      		</div>
			    <div class="modal-footer">
			      	<button class="btn btn-success btn-md" type="submit" id="boton_agregar_grupo">Modificar&nbsp;<i class="fa fa-thumbs-up"></i></button>
			      	<button class="btn btn-default btn-md" type="button" data-dismiss="modal">cerrar&nbsp;<i class="fa fa-remove"></i></button>
			    </div>
		      </form>
	    	</div>
		</div>
	</div>	
</div>
<div class="row">
	<div class="modal fade" id="agg_datos_empresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
		      <div class="modal-header modal-header2" style="background-color: #FFF">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        <h3 class="text-center">Agregar Datos&nbsp;<i class="fa fa-building"></i></h3>
		      </div>
		      <form action="<?php echo base_url().'Configuracion/guardar_empresa';?>" class="form-horizontal" method="POST" id="form_agregar" enctype="multipart/form-data">
		      	<div class="modal-body">
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Nombre</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-building-o"></i></span>
		      					<input type="text" required="" pattern="[a-zA-Z]" name="nombre_empresa" id="nombre_empresa" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Dirección</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-home"></i></span>
		      					<input type="text" required="" name="direccion_empresa" id="direccion_empresa" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">telefono</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
		      					<input type="text" required="" name="telefono_empresa" id="telefono_empresa" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Rif</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
		      					<input type="text" required="" name="rif_empresa" id="rif_empresa" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Email</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon">@</span>
		      					<input type="email" required="" name="email_empresa" id="email_empresa" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Fax</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-fax" aria-hidden="true"></i></span>
		      					<input type="text" name="fax_empresa" id="fax_empresa" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Logo</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-picture" aria-hidden="true"></i></span>
		      					<input type="file" id="logo_empresa" name="logo_empresa" class="form-control">
		      				</div>
		      			</div>
		      		</div>
			    <div class="modal-footer">
			      	<button class="btn btn-success btn-md" type="submit" id="boton_agregar_grupo">Agregar&nbsp;<i class="fa fa-thumbs-up"></i></button>
			      	<button class="btn btn-default btn-md" type="button" data-dismiss="modal">cerrar&nbsp;<i class="fa fa-remove"></i></button>
			    </div>
		      </form>
	    	</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="modal fade" id="modi_datos_empresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
		      <div class="modal-header modal-header2" style="background-color: #FFF">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        <h3 class="text-center">Modicar Datos&nbsp;<i class="fa fa-building"></i>&nbsp;&nbsp;<i class="fa fa-pencil"></i></h3>
		      </div>
		      <form action="<?php echo base_url().'Configuracion/modificar_empresa';?>" class="form-horizontal" method="POST" id="form_agregar" enctype="multipart/form-data">
		      <input type="hidden" id="id_modificar_empresa" name="id_modificar_empresa">
		      <input type="hidden" id="nombre_logo" name="nombre_logo">
		      	<div class="modal-body">

		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Factura</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-picture" aria-hidden="true"></i></span>
		      					<input type="text" required="" name="factura_empresa_modi" id="factura_empresa_modi" class="form-control">
		      					
		      				</div>
		      			</div>
		      		</div>

		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Prefactura</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-picture" aria-hidden="true"></i></span>

		      					<input type="text" required="" name="prefactura_empresa_modi" id="prefactura_empresa_modi" class="form-control">
		      					
		      					
		      				</div>
		      			</div>
		      		</div>

		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Nombre</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-building-o"></i></span>
		      					<input type="text" required="" name="nombre_empresa_modi" id="nombre_empresa_modi" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Dirección</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-home"></i></span>
		      					<input type="text" required="" name="direccion_empresa_modi" id="direccion_empresa_modi" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">telefono</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
		      					<input type="text" required="" name="telefono_empresa_modi" id="telefono_empresa_modi" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Rif</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
		      					<input type="text" required="" name="rif_empresa_modi" id="rif_empresa_modi" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Email</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon">@</span>
		      					<input type="email" required="" name="email_empresa_modi" id="email_empresa_modi" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Fax</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-fax" aria-hidden="true"></i></span>
		      					<input type="text" name="fax_empresa_modi" id="fax_empresa_modi" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group">
		      			<label for="" class="control-label col-md-3">Logo</label>
		      			<div class="col-md-8">
		      				<div class="input-group">
		      					<span class="input-group-addon"><i class="fa fa-picture" aria-hidden="true"></i></span>
		      					<input type="file" id="logo_empresa_modi" name="logo_empresa_modi" class="form-control">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="form-group" id="div_logo" style="display: none;">
		      			 <div class="col-md-offset-3 col-md-3">
		      			 	
		      			 </div>
		      		</div>



			    <div class="modal-footer">
			      	<button class="btn btn-success btn-md" type="submit" id="boton_agregar_grupo">Modificar&nbsp;<i class="fa fa-thumbs-up"></i></button>
			      	<button class="btn btn-default btn-md" type="button" data-dismiss="modal">cerrar&nbsp;<i class="fa fa-remove"></i></button>
			    </div>
		      </form>
	    	</div>
		</div>
	</div>
</div>
	
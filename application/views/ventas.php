<div class="row">
	<div class="container-fixed">
		<div class="col-md-12">
			<form class="form-horizontal" id="form_agregar_compra" action="<?php echo base_url().'Ventas/grabar_compra';?>" method="POST">
			
			<input type="hidden" name="vuelto" id="vuelto" value="0">
			<input type="hidden" id="id_empleado" name="id_empleado">
			<input type="hidden" id="id_descuento" name="id_descuento">
			<input type="hidden" id="descuento_value" name="descuento_value">

			<br>
				<div class="form-group">
					<label class="control-label col-md-2">Cédula del Cliente</label>
					<div class="col-md-4">
						<div class="input-group">
							<input type="text" name="cedula_cliente" id="cedula_cliente" class="form-control" placeholder="solo números">
							<div class="input-group-btn">
							 	<button type="button" class="btn btn-danger btn-md btn-block" id="buscar_clientes">Buscar&nbsp;<i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
					<div class="col-md-2" id="div_btn_buscar_usuario">
						<button type="button" class="btn btn-info btn-block" title="Buscar Usuario" data-toggle="modal" data-target="#mod_buscar_clientes"><i class="fa fa-user fa-1x"></i>&nbsp;<i class="fa fa-search fa-1x"></i></button>
					</div>
	
				</div>
				<div class="form-group">
					<div class="col-md-4 col-md-offset-1" id="barra_oculta" style="display:none">
						<div class="progress progress-striped active">
							  	<div class="progress-bar" role="progressbar"
							       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
							       style="width: 100%">
							       <span>Cargando...</span>
							    	<span class="sr-only">45% completado</span>
							  </div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">Nombre Y Apellido</label>
					<div class="col-md-7">
						<input type="text" name="nombre_cliente" id="nombre_cliente" required="" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">Teléfono</label>
					<div class="col-md-3">
						<input type="number" name="telefono_cliente" id="telefono_cliente" required="" class="form-control">
					</div>
					<label class="control-label col-md-1">Dirección</label>
					<div class="col-md-3">
						<input type="text" name="direccion_cliente" id="direccion_cliente" required="" class="form-control">
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="control-label col-md-1">Artículos</label>
					<div class="col-md-4">
						<input type="text" name="nombre_articulo" id="nombre_articulo" class="form-control">
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-success btn-block" title="Buscar Articulos" data-toggle="modal" data-target="#mod_buscar_articulos"><i class="fa fa-shopping-cart fa-1x"></i>&nbsp;<i class="fa fa-search fa-1x"></i></button>
					</div>
					<label class="control-label col-md-1">Cantidad</label>
					<div class="col-md-3">
						<input type="number" name="cantidad" id="cantidad" class="form-control">
					</div>
				</div>
				<div class="form-group text-center">
					<p class="alet alert-info" id="aviso" style="display: none; font-size: 14px; font-weight: bold;"></p>
				</div>
				<div class="form-group">
					<div class="col-md-offset-3 col-md-4">
						<button type="button" class="btn btn-warning btn-md btn-block" id="boton_agregar_tabla">Agregar&nbsp;<i class="fa fa-arrow-down"></i></button>
					</div>
					<div class="col-md-3">
						<button type="button" class="btn btn-danger btn-md btn-block" id="imprimir_factura" data-ruta = "<?php echo base_url().'Ventas/imprimir_factura'; ?>" style="display: none;">Imprimir Factura&nbsp;<i class="fa fa-share"></i></button>
					</div>
				</div>
				<div class="form-group" id="div_tabla">
					<div class="col-md-12">
						<table class="table table-striped table-hover" id="tabla_productos">
							<thead>
								<th class="text-center">Artículo</th>
								<th class="text-center">Marca</th>
								<th class="text-center">Precio</th>
								<th class="text-center">Cantidad</th>
								<th class="text-center">Sub-total</th>
								<th class="text-center">Iva</th>
								<th class="text-center">Total</th>
								<th></th>
							</thead>
							<tbody class="text-center">
								
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-group text-center">
					<p class="alert alert-success" style="color: black; font-weight: bold;"><span id="total">Total a Pagar:&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<?php echo $this->session->userdata('siglas'); ?> </span><br><br> <span style="font-size: 15px;" class="badge alert-danger" id="cliente_encargado">Encargado de la Venta: <?= $seller->nombre_apellido ?></span></p>
					<p class="alert alert-danger letras" id="falta_dinero" style="display: none; color: black; font-weight: bold;"></p>
					<p class="alert alert-success letras" id="monto_suficiente" style="display: none; color: black; font-weight: bold;"></p>
				</div>
				<section id="section_registrar" style="display: none"> 
					<div class="form-group">
						<label class="control-label col-md-2" for="aplicar_descuento">Aplicar Descuento</label>
						<div class="col-md-2">
							<input type="checkbox" name="aplicar_descuento" id="aplicar_descuento">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-2">Metodo de pago</label>
						<div class="col-md-2">
							 <label class="radio-inline"><input type="radio" id="metodo_pago" name="metodo_pago" required="" value="debito">Debito</label>
						</div>
						<div class="col-md-2">
							 <label class="radio-inline"><input type="radio" id="metodo_pago" name="metodo_pago" required="" value="visa">Visa</label>
						</div>
						<div class="col-md-2">
							 <label class="radio-inline"><input type="radio" id="metodo_pago" name="metodo_pago" required="" value="mixto">Mixto</label>
						</div>
						<div class="col-md-2">
							 <label class="radio-inline"><input type="radio" id="metodo_pago" name="metodo_pago" required="" value="transferencia">Transferencia</label>
						</div>
						<div class="col-md-2">
							 <label class="radio-inline"><input type="radio" id="metodo_pago" name="metodo_pago" required="" value="efectivo">Efectivo</label>
						</div>
					</div>
					<div class="form-group" id="section_trans" style="display: none;">
						<label class="control-label col-md-2">Nro° Transferencia</label>
						<div class="col-md-4">
							<input type="text" name="nro_transferencia" id="nro_transferencia" class="form-control">
						</div>
						<label class="control-label col-md-2">Banco</label>
						<div class="col-md-4">
							<select name="banco_transferencia" class="form-control">
								<?= $$option_bancos ?>
							</select>
						</div>
					</div>
					<div class="form-group" id="section_debito" style="display: none;">
						<label class="control-label col-md-3">Banco</label>
						<div class="col-md-3">
							<select name="banco_debito" class="form-control">
								<?= $$option_bancos ?>
							</select>
						</div>
					</div>
					<div class="form-group" id="section_mixto" style="display: none;">
						<label class="control-label col-md-3">Cantidad en Dolares</label>
						<div class="col-md-3">
							<input type="number" name="monto_dolares" id="monto_dolares" class="form-control" value="0" step="any">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-3">Monto pagado</label>
						<div class="col-md-3">
							<input type="number" class="form-control" name="monto_pago" id="monto_pago" required="" step="any">
						</div>
						<label for="" class="control-label col-md-2">Tipo Documento</label>
						<div class="col-md-4">
							<input type="text" readonly="" id="factura" name="factura" value="Factura" class="form-control" style="text-align: center; font-size: 14px; font-weight: bold;">
						</div>
					</div>
					<div class="form-group" id="section_dolar_cancelar" style="display: none;">
						<label for="" class="control-label col-md-3">Dolares a Cancelar</label>
						<div class="col-md-3">
							<input type="text" class="form-control" id="dolares_cancelar" readonly="">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-4 col-md-4">
							<button type="submit" class="btn btn-primary btn-block btn-md" disabled="" id="grabar_compra">Grabar Compra&nbsp;&nbsp;<i class="fa fa-check"></i></button>
						</div>
					</div>

				</section>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="mod_buscar_clientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog tabla_modal" role="document">
    	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Clientes Agregados&nbsp;<i class="fa fa-user"></i>&nbsp;<i class="fa fa-pencil"></i></h3>
	      </div>
	      <div class="modal-body">
	      	<table class="table table-striped table-hover" id="tabla_clientes">
	      		<thead>
	      			<th class="text-center">Cédula</th>
	      			<th class="text-center">Nombre y Apellido</th>
	      			<th class="text-center">Dirección</th>
	      			<th class="text-center">Teléfono</th>
	      			<th></th>
	      		</thead>
	      		<tbody>
	      			<?php
	      				if(!empty($clientes))
	      				{
	      					foreach ($clientes as $row) 
	      					{
	      						$button = "<button class='btn btn-md btn-danger escoger_cliente'
	      									data-nombre = '$row->nombre'
	      									data-cedula = '$row->cedula'
	      									data-direccion = '$row->direccion'
	      									data-telefono = '$row->telefono'>
	      									Agregar&nbsp;<i class='fa fa-thumbs-up'></i></button>";
	      						echo "<tr>
	      								<td>$row->cedula</td>
	      								<td>$row->nombre</td>
	      								<td>$row->direccion</td>
	      								<td>$row->telefono</td>
	      								<td>".$button."</td>";
	      					}
	      				}
	      				else
	      				{
	      					echo 	"<tr>
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
	      <div class="modal-footer">
	      	<button class="btn btn-primary btn-md" type="button" data-dismiss="modal">Cerrar&nbsp;<i class="fa fa-remove"></i></button>
	      </div>
    	</div>
	</div>
</div>

<div class="modal fade" id="mod_buscar_articulos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Productos Inventario&nbsp;<i class="fa fa-book"></i>&nbsp;<i class="fa fa-pencil"></i></h3>
	      </div>
	      <div class="modal-body">
	      	<table class="table table-striped table-hover" id="tabla_articulos">
	      		<thead>
	      			<th class="text-center">Artículo</th>
	      			<th class="text-center">Marca</th>
	      			<th class="text-center">Grupo</th>
	      			<th class="text-center">Cantidad</th>
	      			<th class="text-center">Precio</th>
	      			<th class="text-center">Agregar Producto</th>
	      		</thead>
	      		<tbody class="text-center">
	      			<?php
	      				if(!empty($articulos))
	      				{
	      					foreach ($articulos as $row) 
	      					{
	      						$button = "";
	      						if($row->cantidad > 0){

		      						$button = "<button class='btn btn-md btn-danger escoger_producto'
		      									data-nombre = '".strtoupper($row->nombre)."'>
		      									Agregar&nbsp;<i class='fa fa-thumbs-up'></i></button>";
	      						}

	      						echo "<tr>
	      								<td>$row->nombre</td>
	      								<td>$row->marca</td>
	      								<td>$row->grupo</td>
	      								<td><span class='label label-warning letras'>$row->cantidad</span></td>
	      								<td>".number_format($row->precio * $config->dolar_value)."</td>
	      								<td>$button</td>";
	      					}
	      				}
	      				else
	      				{
	      					echo 	"<tr>
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
	      <div class="modal-footer">
	      	<button class="btn btn-primary btn-md" type="button" data-dismiss="modal">Cerrar&nbsp;<i class="fa fa-remove"></i></button>
	      </div>
    	</div>
	</div>
</div>
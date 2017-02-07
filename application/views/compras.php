<br><br>
<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<h3 style="display:inline-block"><i class="fa fa-truck fa-2x"></i>&nbsp;&nbsp;Compra de Artículos</h3>
			<hr>
			<form action="<?php echo base_url().'Compras/imprimir_factura'; ?>" method="POST" id='form_registro' class='form-horizontal'>
				<div class="form-group">
					<label class="control-label col-md-3">Proveedor</label>
					<div class="col-md-7">
						<select name="provedores" id="proveedores" class="form-control">
							<option value=""></option>							
							<?php
								if (!empty($proveedores)) 
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
					<label class="control-label col-md-2">Artículos</label>
					<div class="col-md-4">
						<select name="articulos" id="articulos" class="form-control">
							<option value=""></option>
						</select>
					</div>
					<label class="control-label col-md-2">Cantidad</label>
					<div class="col-md-3">
						<input type="number" id="cantidad" name="cantidad" placeholder="Indique la cantidad a adquirir" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-2 col-md-3">
						<button type="button" class="btn btn-success btn-block btn-md" id="agregar_articulo">Agregar Artículo&nbsp;&nbsp;<i class="fa fa-plus"></i></button>
					</div>
					<div class="col-md-3">
						<button type="button" class="btn btn-info btn-block btn-md" data-toggle="modal" data-target="#ver_articulos">Ver Artículo&nbsp;&nbsp;<i class="fa fa-search"></i></button>
					</div>
					<div class="col-md-3">
						<button type="button" data-ruta ="<?php echo base_url().'Compras/imprimir_factura'; ?>" class="btn btn-danger btn-block btn-md" id="imprimir_factura" disabled="">Imprimir Factura&nbsp;&nbsp;<i class="fa fa-file-text"></i></button>
					</div>
				</div>
				<div class="form-group text-center">
					<p class="label label-info" style="color: white; font-size: 14px; font-weight: bold;" id="aviso"></p>
				</div>
			</form>
			<table class="table table-streped table-hover" id="tabla_articulos">
				<thead>
					<th class="text-center">Artículo</th>
					<th class="text-center">Marca</th>
					<th class="text-center">Precio</th>
					<th class="text-center">Proveedor</th>
					<th class="text-center">Cantidad</th>
					<th class="text-center">Total</th>
					<th></th>
				</thead>
				<tbody class="text-center">
					
				</tbody>
			</table>
			<section id="section_pagar_oculto" style="display: none">
				<div class="col-md-offset-4 col-md-3">
					<button class="btn btn-primary btn-md" id="registrar_compra">Registrar Compra&nbsp;&nbsp;<i class="fa fa-check"></i></button>
				</div>
				<div class="col-md-5">
					<div class="panel panel-red">
						<div class="panel-heading">
							<h3>Total a pagar</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-offset-2 col-md-10" style="font-family: Arial;">
								<h4>Sub-Total:&nbsp;&nbsp;&nbsp;<span class="text-right letras" id="sub-total" style="color: black"></span></h4>
							</div>
							<div class="col-md-offset-2 col-md-10" style="font-family: Arial;">
								<h4>Iva:&nbsp;&nbsp;&nbsp;<span class="badge text-right letras" id="iva" style="background-color: white; color: black"></span></h4>
							</div>
							<div class="col-md-offset-2 col-md-10" style="font-family: Arial;">
								<h4>Total:&nbsp;&nbsp;&nbsp;<span class=" badge text-right letras" id="total" style="background-color: skyblue;"></span></h4>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<div class="modal fade" id="ver_articulos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog tabla_modal" role="document">
    	<div class="modal-content">
	      <div class="modal-header modal-header2" style="background-color: #FFF">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Artículos del Proveedor&nbsp;<i class="fa fa-truck"></i></h3>
	      </div>
	      <div class="modal-body">
	      	<div class="row" id="div_tabla">
	      	</div>
	      </div>
	      <div class="modal-footer">
	      	<!--<button class="btn btn-success btn-md" type="button" id="boton_agregar_grupo">Agregar&nbsp;<i class="fa fa-thumbs-up"></i></button>-->
	      </div>
    	</div>
	</div>
</div>

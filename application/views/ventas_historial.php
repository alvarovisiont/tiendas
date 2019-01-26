<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<?php
				if($this->session->flashdata('message')){
					echo "<br></br><p class='alert alert-info alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$this->session->flashdata('message')."</p>";
				}
			?>
		<br><br>

			<div class="panel panel-yellow">
				<div class="panel-heading">
					<h3 style="color: white; display: inline-block;">Historial de ventas</h3>
				</div>
				<div class="panel-body">
					<table class="table table-streped table-hover table-responsive" id="tabla">
						<thead>
							<th class="text-center">Factura</th>
							<th class="text-center">Fecha Venta</th>
							<th class="text-center">monto_pagado</th>
							<th class="text-center">Vuelto</th>
							<th class="text-center">Tipo de Venta</th>
							<th>Detalle Venta</th>
							<th>Imprimir</th>
							<th>Anular</th>
						</thead>
						<tbody class="text-center">
							<?php
								
									foreach ($datos as $row) 
									{
										$detalle = "<button class='btn btn-info btn-sm' data-toggle='modal' data-target='#modal_detalle'
										data-id_venta = '$row->id'><i class='fa fa-search'></i></button>";
										
										$imprimir = "<button class='btn btn-danger btn-sm imprimir'
										data-ruta = '".base_url().'Ventas_historial/imprimir_factura/'.$row->id."'><i class='fa fa-download'></i></button>";
										$deshacer = "";
										if($row->status == 1){

											$deshacer = "<button class='btn btn-warning btn-sm devolver'
											data-ruta = '".base_url().'Ventas/rollback/'.$row->id."'><i class='fa fa-refresh'></i></button>";
										}
										
										$anulado = $row->status == 1 ? "" : "#F28D62";

										echo "<tr style='background-color:".$anulado.";'>
												<td>$row->factura</td>
												<td>".date('d-m-Y' ,strtotime($row->fecha_venta))."</td>
												<td>".number_format($row->monto_pagado,2,',','.')."</td>
												<td>".number_format($row->vuelto,2,',','.')."</td>
												<td>$row->tipo_venta</td>
												<td>".$detalle."</td>
												<td>".$imprimir."</td>
												<td>".$deshacer."</td>
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
<div class="modal fade" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        	<h3 class="text-center">Detalles de la venta&nbsp;<i class="fa fa-file-text"></i></h3>
	      </div>
	      	<div class="modal-body">
	      		<div class="row" id="div_datos">
	      			<table class="table table-striped table-hover" id="tabla_detalle">
	      				<thead>
	      					<th class="text-center">Nombre Arículo</th>
		      				<th class="text-center">Marca</th>
		      				<th class="text-center">Precio</th>
		      				<th class="text-center">Cantidad</th>
		      				<th class="text-center">Sub_Total</th>
		      				<th class="text-center">Iva</th>
		      				<th class="text-center">Total</th>
		      				<th></th>
	      				</thead>
	      				<tbody class="text-center">
	      					
	      				</tbody>
	      			</table>
				</div>
	      	</div>
	      	<div class="modal-footer">
	          	
	        </div>
	    </div>
	</div>
</div>
<div class="modal fade" id="modal_clientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog tabla_modal" role="document" class="tabla_modal">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        	<h3 class="text-center">Detalles del cliente&nbsp;<i class="fa fa-user"></i></h3>
	      </div>
	      	<div class="modal-body">
	      		<div class="row" id="div_clientes">
	      			<table class="table table-striped table-hover" id="tabla_clientes">
	      				<thead>
	      					<th class="text-center">Cédula</th>
		      				<th class="text-center">Nombre</th>
		      				<th class="text-center">Teléfono</th>
		      				<th class="text-center">Dirección</th>
	      				</thead>
	      				<tbody class="text-center">
	      					
	      				</tbody>
	      			</table>
				</div>
	      	</div>
	      	<div class="modal-footer">
	          	<button type='button' class='btn btn-default' data-dismiss='modal'>cerrar&nbsp;&nbsp;<i class='fa fa-remove'></i></button>
	        </div>
	    </div>
	</div>
</div>

<div class="modal fade" id="modal_aviso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        	<h3 class="text-center">Aviso&nbsp;<i class="fa fa-exclamation"></i></h3>
	      </div>
	      	<div class="modal-body">
	      		<h3 class="text-center">Esta seguro de querer Anular esta venta?</h3>
	      	</div>
	      	<div class="modal-footer">
	      			<button type='button' class='btn btn-primary' id="dismiss_sell">Aceptar&nbsp;&nbsp;<i class='fa fa-thumbs-up'></i></button>
	          	<button type='button' class='btn btn-danger' data-dismiss='modal'>cerrar&nbsp;&nbsp;<i class='fa fa-remove'></i></button>
	        </div>
	    </div>
	</div>
</div>
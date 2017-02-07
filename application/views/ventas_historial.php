<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
		<br><br>
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<h3 style="color: white; display: inline-block;">Historial de ventas</h3>
				</div>
				<div class="panel-body">
					<table class="table table-streped table-hover" id="tabla">
						<thead>
							<th class="text-center">Factura</th>
							<th class="text-center">Fecha Venta</th>
							<th class="text-center">monto_pagado</th>
							<th class="text-center">Vuelto</th>
							<th class="text-center">Tipo de Venta</th>
							<th>Detalle Venta</th>
							<th>Imprimir</th>
						</thead>
						<tbody class="text-center">
							<?php
								if(!empty($datos))
								{
									foreach ($datos as $row) 
									{
										$detalle = "<button class='btn btn-info btn-sm' data-toggle='modal' data-target='#modal_detalle'
										data-id_venta = '$row->id'><i class='fa fa-search'></i></button>";
										$imprimir = "<button class='btn btn-danger btn-sm imprimir'
										data-ruta = '".base_url().'Ventas_historial/imprimir_factura/'.$row->id."'><i class='fa fa-share'></i></button>";
										echo "<tr>
												<td>$row->factura</td>
												<td>".date('d-m-Y' ,strtotime($row->fecha_venta))."</td>
												<td>$row->monto_pagado</td>
												<td>$row->vuelto</td>
												<td>$row->tipo_venta</td>
												<td>".$detalle."</td>
												<td>".$imprimir."</td>
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
		</div>
	</div>
</div>
<div class="modal fade" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog tabla_modal" role="document" class="tabla_modal">
	    <div class="modal-content">
	      	<div class="modal-header modal-header2" style="background-color: #FFF">
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
	      	<div class="modal-header modal-header2" style="background-color: #FFF">
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
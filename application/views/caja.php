<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
		<br>
		<br>
		<h2 class="text-center alert alert-warning">Monto de la caja mensual:&nbsp;&nbsp;
					<span class="badge" style="background-color: darkred; color: white; font-size: 16px;"> 
						<?php 
							if ($monto < 0) 
							{
								$monto = "- ".$monto;
							}
							else
							{
								$monto = "+ ".$monto;	
							}
							echo $monto;
						?>
					</span>
				</h2>
			<div class="col-md-12">	
				<div class="panel panel-red">
					<div class="panel-heading">
						<h3 style="color: white; display: inline-block;">Movimientos de la caja</h3>
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
								<th>Cliente</th>
							</thead>
							<tbody class="text-center">
								<?php
									if(!empty($datos))
									{
										foreach ($datos as $row) 
										{
											$detalle = "<button class='btn btn-info btn-sm' data-toggle='modal' data-target='#modal_detalle'
											data-id_venta = '$row->id'><i class='fa fa-search'></i></button>";
											$cliente = "<button class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modal_cliente'
											data-id_venta = '$row->id'><i class='fa fa-user'></i></button>";

											echo "<tr>
													<td>$row->factura</td>
													<td>".date('d-m-Y' ,strtotime($row->fecha_venta))."</td>
													<td>".number_format($row->monto_pagado,2,",",".")."</td>
													<td>".number_format($row->vuelto,2,",",".")."</td>
													<td>$row->tipo_venta</td>
													<td>".$detalle."</td>
													<td>".$cliente."</td>
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
</div>
<div class="modal fade" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog tabla_modal modal-lg" role="document">
    	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Detalles de la Venta&nbsp;<i class="fa fa-file-text"></i></h3>
	      </div>
	      <div class="modal-body">
	      	<div class="row" id="div_detalle">
	      		<table class="table table-streped table-hover" id="tabla_detalle">
	      			<thead>
	      				<th class="text-center">Nombre Arículo</th>
	      				<th class="text-center">Marca</th>
	      				<th class="text-center">Precio</th>
	      				<th class="text-center">Cantidad</th>
	      				<th class="text-center">Sub_Total</th>
	      				<th class="text-center">Iva</th>
	      				<th class="text-center">Total</th>
	      			</thead>
	      			<tbody class="text-center">
	      				
	      			</tbody>
	      		</table>
	      	</div>
	      </div>
	      <div class="modal-footer">
	      	<button class="btn btn-primary btn-md" type="button" data-dismiss='modal'>cerrar&nbsp;<i class="fa fa-remove"></i></button>
	      </div>
    	</div>
	</div>
</div>
<div class="modal fade" id="modal_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog tabla_modal" role="document">
    	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Detalles de la Venta&nbsp;<i class="fa fa-file-text"></i></h3>
	      </div>
	      <div class="modal-body">
	      	<div class="row" id="div_detalle_cliente">
	      		<table class="table table-streped table-hover" id="tabla_detalle_cliente">
	      			<thead>
	      				<th class="text-center">Nombre</th>
	      				<th class="text-center">Cedúla</th>
	      				<th class="text-center">Teléfono</th>
	      				<th class="text-center">Dirección</th>
	      			</thead>
	      			<tbody class="text-center">
	      				
	      			</tbody>
	      		</table>
	      	</div>
	      </div>
	      <div class="modal-footer">
	      	<button class="btn btn-primary btn-md" type="button" data-dismiss='modal'>cerrar&nbsp;<i class="fa fa-remove"></i></button>
	      </div>
    	</div>
	</div>
</div>


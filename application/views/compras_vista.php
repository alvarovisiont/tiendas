<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
		<br><br>
			<div class="panel panel-black">
				<div class="panel-heading">
					<h3>Historial de Compras&nbsp;&nbsp;<i class="fa fa-book"></i></h3>
				</div>
				<div class="panel-body">
					<table class="table table-streped table-hover" id="tabla1">
						<thead>
							<th class="text-center">Número de Factura</th>
							<th class="text-center">Fecha_Compra</th>
							<th class="text-center">Detalles de la compra</th>
							<th class="text-center">Imprimir Compra</th>
						</thead>
						<tbody class="text-center">
							<?php
								if(!empty($datos))
								{
									foreach ($datos as $row) 
									{
										echo "	<tr>
													<td>$row->codigo</td>
													<td>".date('d-m-Y', strtotime($row->fecha_compra))."</td>
													<td><button type='button' class='btn btn-md btn-info' data-target='#ver_detalle' data-toggle='modal'
														data-id = '$row->id'>
														Ver&nbsp;<i class='fa fa-search'></i>
														</button>
													</td>
													<td><button class='btn btn-danger btn-md imprimir_factura'
														data-id= '$row->id'
														data-ruta = '".base_url().'Compras_vista/imprimir_factura'."'>
														Imprimir&nbsp;<i class='fa fa-download' aria-hidden='true'></i>
														</button>
													</td>
												</tr>";
									}
								}
								else
								{
									echo "	<tr>
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
<div class="modal fade" id="ver_detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog tabla_modal" role="document">
    	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Detalles de la Compra&nbsp;<i class="fa fa-shopping-cart"></i></h3>
	      </div>
	      <div class="modal-body">
	      	<div class="row" id="div_tabla" style="padding: 15px;">
	      			
	      	</div>
	      </div>
	      <div class="modal-footer">
	      	<button class="btn btn-default btn-md" type="button" data-dismiss="modal">Cerrar&nbsp;<i class="fa fa-remove"></i></button>
	      </div>
    	</div>
	</div>
</div>
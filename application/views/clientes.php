<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br>
			<br>
			<br>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3>Clientes Registrados&nbsp;&nbsp;<i class="fa fa-user">&nbsp;&nbsp;</i><i class="fa fa-pencil"></i><i class="fa fa-book"></i></h3>	
				</div>
				<div class="panel-body">
					<table class="table table-streped table-hover" id="tabla">
						<thead>
							<th class="text-center">Nombre y Apellido</th>
							<th class="text-center">Cédula</th>
							<th class="text-center">Teléfono</th>
							<th class="text-center">Fecha_Compra</th>
							<th></th>
						</thead>
						<tbody class="text-center">
							<?php
								if(!empty($datos))
								{
									foreach ($datos as $row) 
									{
										echo "<tr>
												<td>$row->nombre</td>
												<td>$row->cedula</td>
												<td><span class='label label-success letras'>$row->telefono</span></td>
												<td>".date('d-m-Y', strtotime($row->fecha_compra))."</td>
												<td>
													<button class='btn btn-info btn-sm' id='ver_articulos' data-toggle='modal' data-target='#modal_articulos'
														data-id_venta = '$row->id_venta'>Ver artículos&nbsp;&nbsp;<i class='fa fa-search'></i></button>
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
<div class="modal fade" id="modal_articulos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog tabla_modal" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-header2" style="background-color: #FFF">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Artículos Comprados&nbsp;<i class="fa fa-cart-plus"></i></h3>
	      </div>
	      	<div class="modal-body">
	      		<div class="row" id="div_tabla">
					<table class="table table-striped table-hover" id="tabla_articulos">
						<thead>
							<th class="text-center">Nombre_Artículo</th>
							<th class="text-center">Marca</th>
							<th class="text-center">Precio</th>
							<th class="text-center">Cantidad</th>
							<th class="text-center">Sub_Total</th>
							<th class="text-center">Iva</th>
							<th class="text-center">Total</th>
						</thead>
						<tbody>
							
						</tbody>
					</table>
	      		</div>
	      	</div>
	      	<div class="modal-footer">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar&nbsp;&nbsp;<i class="fa fa-remove"></i></button>
	        </div>
	    </div>
	  </div>
</div>

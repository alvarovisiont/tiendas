<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br>
			<br>
			<br>
			<div class="panel panel-black">
				<div class="panel-heading">
					<h3>Comisiones Registradas&nbsp;&nbsp;<i class="fa fa-percentaje"></i></h3>	
				</div>
				<div class="panel-body">
					<table class="table table-streped table-hover" id="tabla">
						<thead>
							<th class="text-center">Trabajador</th>
							<th class="text-center">Factura</th>
							<th class="text-center">Porcentaje</th>
							<th class="text-center">Monto</th>
							<th class="text-center">Fecha Venta</th>
						</thead>
						<tbody class="text-center">
							<?php
								if(!empty($data))
								{
									foreach ($data as $row) 
									{
										echo "<tr>
												<td>$row->nombre_apellido</td>
												<td>$row->factura</td>
												<td>$row->porcentaje %</td>
												<td><span class='badge letras' style='background-color: darkred; color: white;'>".number_format($row->monto,2,',','.')." Bs.S</span></td>
												<td>".date('d-m-Y', strtotime($row->created_at))."</td>
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
			<div class="panel panel-black">
				<div class="panel-heading">
					<h3>Total Pagar por Mes</h3>	
				</div>
				<div class="panel-body">
					<table class="table table-streped table-hover" id="tabla">
						<thead>
							<th class="text-center">Trabajador</th>
							<th class="text-center">Monto</th>
							<th class="text-center">Mes</th>
							<th class="text-center">Año</th>
						</thead>
						<tbody class="text-center">
							<?php
								if(!empty($datos))
								{

									foreach ($datos as $row) 
									{
										echo "<tr>
												<td>$row->nombre_apellido</td>
												<td><span class='badge letras' style='background-color: darkred; color: white;'>".number_format($row->total,2,',','.')."</span></td>
												<td>".month_return($row->mes)."</td>
												<td>$row->año</td>
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
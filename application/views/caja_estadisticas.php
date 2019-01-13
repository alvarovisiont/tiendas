<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br>
			<section id="section_graficos">
				<div class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading text-center">
							<h3>Ventas Diarias</h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<div class="col-md-4">
									<select id="mes_dia" class="form-control">
										<option value=""></option>
										<option value="01">Enero</option>
										<option value="02">Febrero</option>
										<option value="03">Marzo</option>
										<option value="04">Abril</option>
										<option value="05">Mayo</option>
										<option value="06">Junio</option>
										<option value="07">Julio</option>
										<option value="08">Agosto</option>
										<option value="09">Septiembre</option>
										<option value="10">Octubre</option>
										<option value="11">Noviembre</option>
										<option value="12">Diciembre</option>
									</select>
								</div>
								<div class="col-md-4">
									<select id="año_dia" class="form-control">
										<option></option>
										<?php 
										$x = 1;
										$año = 2014;
										while ($x <= 20) 
										{
											echo "<option value='$año'>$año</option>";
											$año++;
											$x++;
										}
										?>
									</select>
								</div>
								<div class="col-md-4">
									<button class="btn btn-danger btn-md" id="buscar_grafico_dia">Buscar&nbsp;<i class="fa fa-search"></i></button>
								</div>
							</div>
							<section id="section_dia">
								<div id="chartdivdia" style="width: 100%; height: 400px;"></div>
							</section>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-danger">
						<div class="panel-heading text-center">
							<h3>Ventas Mensual</h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<div class="col-md-6 col-md-offset-2">
									<select id="año_mes" class="form-control">
										<option></option>
										<?php 
										$x = 1;
										$año = 2014;
										while ($x <= 20) 
										{
											echo "<option value='$año'>$año</option>";
											$año++;
											$x++;
										}
										?>
									</select>
								</div>
								<div class="col-md-4">
									<button class="btn btn-danger btn-md btn-block" id="buscar_grafico_mes">buscar&nbsp;&nbsp;<i class="fa fa-search"></i></button>
								</div>
							</div>
							<section id="section_mes">
								<div id="chartdivmes" style="width: 100%; height: 400px;"></div>
							</section>		
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="panel panel-success">
						<div class="panel-heading text-center">
							<h3>Venta Anual</h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<div id="chartdivaño" style="width: 100%; height: 400px;"></div>
							</div>		
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br>
			<?php
				$x = "";
				if(!empty($this->session->flashdata('exito')))
				{
					$x = $this->session->flashdata('exito');
					echo "<p class='alert alert-success' id='alerta'>$x</p>";
				}
			?>
			<br><br>
			<form action="<?php echo base_url().'Empleados/grabar'; ?>" class="form-horizontal" id="form_agregar" method="POST">
				<h3 class="text-center">Registrar Empleados</h3>
				<br>
				<div class="form-group">
					<label for="" class="control-label col-md-2">Nombre</label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="nombre" id="nombre" required="">
					</div>
					<label for="" class="control-label col-md-2">Cédula</label>
					<div class="col-md-4">
						<input type="number" class="form-control" name="cedula" id="cedula" required="">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-2">Teléfono</label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="telefono" id="telefono" required="">
					</div>
					<label for="" class="control-label col-md-2">Sueldo</label>
					<div class="col-md-4">
						<input type="number" class="form-control" name="sueldo" id="sueldo" required="">
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-4">
						<button class="btn btn-success btn-block">Agregar&nbsp;<i class="fa fa-thumbs-up"></i></button>
					</div>
				</div>
			</form>
			<br>
			<table class="table table-bordered table-hover">
				<thead>
					<th class="text-center">Nombre</th>
					<th class="text-center">Cédula</th>
					<th class="text-center">Teléfono</th>
					<th class="text-center">Sueldo</th>
					<th class="text-center"></th>
				</thead>
				<tbody class="text-center">
					<?php
						if(!empty($datos))
						{
							foreach ($datos as  $row)
							{
								$sueldo = number_format($row->sueldo,2,',','.').$conf->siglas;
								
								$sueldo_dolares = number_format($row->sueldo * $conf->dolar_value,2,',','.')."Bs.S";

								$botones = "<button class='btn btn-warning btn-md' data-toggle='modal' data-target='#modal_editar' 
									data-id= '$row->id'
									data-nombre= '$row->nombre'
									data-cedula= '$row->cedula'
									data-telefono= '$row->telefono'
									data-sueldo= '$row->sueldo'>Modifcar</button>
									<button class='btn btn-danger btn-md eliminar' data-id='$row->id'>Eliminar</button>";
								echo "<tr>
										<td>$row->nombre</td>
										<td>$row->cedula</td>
										<td>$row->telefono</td>
										<td>".$sueldo." / <br/> ".$sueldo_dolares."</td>
										<td>$botones</td>
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
			<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				      <div class="modal-header modal-header2" style="background-color: #FFF">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				        <h3 class="text-center">Modificar Empleado&nbsp;<i class="fa fa-user"></i>&nbsp;<i class="fa fa-edit"></i></h3>
				      </div>
				      <form action="<?php echo base_url().'Empleados/modificar'; ?>" class="form-horizontal" id="form_agregar" method="POST">
				      <input type="hidden" id="id_modificar" name="id_modificar">
				      <div class="modal-body">
				      	<div class="row">
			      			<div class="form-group">
								<label for="" class="control-label col-md-2">Nombre</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="nombre_modi" id="nombre_modi" required="">
								</div>
								<label for="" class="control-label col-md-2">Cédula</label>
								<div class="col-md-4">
									<input type="number" class="form-control" name="cedula_modi" id="cedula_modi" required="">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label col-md-2">Teléfono</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="telefono_modi" id="telefono_modi" required="">
								</div>
								<label for="" class="control-label col-md-2">Sueldo</label>
								<div class="col-md-4">
									<input type="number" class="form-control" name="sueldo_modi" id="sueldo_modi" required="">
								</div>
							</div>
							<br>
				      	</div>
				      </div>
				      <div class="modal-footer">
							<button type="submit" class="btn btn-success">Modificar&nbsp;<i class="fa fa-remove"></i></button>
							<button type="button" class="btn btn-default" data-dismiss='modal'>Salir&nbsp;<i class="fa fa-remove"></i></button>
					  </div>
				    </form>
			    	</div>
				</div>
			</div>
		</div>
	</div>
</div>
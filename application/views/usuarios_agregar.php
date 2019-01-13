<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br><br>
			<form action="<?php echo base_url().'Usuarios_agregar/agregar_usuario'; ?>" id="form_agregar" method="POST" class="form-horizontal">
				<h3 class="text-center">Agregar Usuario</h3>
				<br>
				<div class="form-group">
					<label for="" class="control-label col-md-2">Usuario</label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="usuario" required="" placeholder="Indique el nombre de usuario de esta cuenta">
					</div>
					<label for="" class="control-label col-md-2">Clave</label>
					<div class="col-md-4">
						<input type="password" id="clave" name="clave" class="form-control" required="">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-2">Pefil</label>
					<div class="col-md-4">
						<select name="perfil" id="perfil" class="form-control" required="">
							<option value=""></option>
							<option value="1">Administrador</option>
							<option value="2">Contador</option>
							<option value="3">Operador</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-4 text-center">
						<p class="label label-info" id="aviso" style="display:none; font-size: 14px; font-weight:bold;"></p>
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="col-md-4 col-md-offset-4">
						<button class="btn btn-primary btn-md btn-block">Guardar</button>
					</div>
				</div>
			</form>
			<br><br>
			<table class="table table-hover table-striped">
				<thead>
					<th class="text-center">Usuario</th>
					<th class="text-center">Nivel</th>
				</thead>
				<tbody class="text-center">
					<?php 
						if(!empty($datos))
						{
							foreach ($datos as $row) 
							{
								if($row->nivel == 1)
								{
									$nivel = "<span class='label label-warning letras'>Administrador</span>";
								}
								elseif($row->nivel == 2)
								{
									$nivel = "<span class='label label-danger letras'>Contador</span>";	
								}
								else
								{
									$nivel = "<span class='label label-warning letras'>Operador</span>";		
								}
								echo "<tr>
											<td>$row->usuario</td>
											<td>$nivel</td>
										</tr>";
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

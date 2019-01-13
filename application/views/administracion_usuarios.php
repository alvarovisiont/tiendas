<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br><br>
				<h3 class="text-center">Administración de Usuarios</h3>
			<br><br>
			<table class="table table-hover table-striped">
				<thead>
					<th class="text-center">Nombre y Apellido</th>
					<th class="text-center">Usuario</th>
					<th class="text-center">Nivel</th>
					<th class="text-center">Acción</th>
				</thead>
				<tbody class="text-center">
					<?php 
						if(!empty($datos))
						{
							foreach ($datos as $row) 
							{
								$button = "<button class='btn btn-info btn-md' data-toggle='modal' data-target='#modal_edit'
								data-id = '$row->id'
								data-usuario = '$row->usuario'
								data-clave = '$row->clave'
								data-telefono = '$row->telefono'
								data-sueldo = '$row->sueldo'
								data-comision = '$row->comision'
								data-nombre_apellido = '$row->nombre_apellido'
								data-perfil = '$row->nivel'>Editar&nbsp;<i class='fa fa-edit'></i></button>
								<button class='btn btn-danger btn-md eliminar' data-id ='$row->id'>Eliminar&nbsp;<i class='fa fa-trash'></i></button>";

								if($row->nivel == 1)
								{
									$nivel = "<span class='label label-primary letras'>Administrador</span>";
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
											<td>$row->nombre_apellido</td>
											<td>$row->usuario</td>
											<td>$nivel</td>
											<td>$button</td>
										</tr>";
							}
						}
						else
						{
							echo "<tr>
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
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" class="tabla_modal">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        	<h3 class="text-center">Modificar Usuario&nbsp;<i class="fa fa-user"></i><i class="fa fa-edit"></i></h3>
	      </div>
	      	<form class="form-horizontal" action="<?php echo base_url().'Usuarios_administracion/modificar'; ?>" method='POST' id='form_modificar'>
	      	<input type="hidden" name="id_modificar" id="id_modificar">
	      	<div class="modal-body">
	      		
      			<div class="form-group">
      				<label class="control-label col-md-2">Nombre Apellido</label>
					<div class="col-md-4">
						<input type="text" name="nombre_apellido_modi" id="nombre_apellido_modi" class="form-control" required="">
					</div>
      			</div>
				<div class="form-group">
					<label class="control-label col-md-2">Usuario</label>
					<div class="col-md-4">
						<input type="text" name="usuario_modi" id="usuario_modi" class="form-control" required="">
					</div>
					<label class="control-label col-md-2">Clave</label>
					<div class="col-md-4">
						<input type="text" name="clave_modi" id="clave_modi" class="form-control" required="">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">Nivel</label>
					<div class="col-md-4">
						<select class="form-control" name="perfil_modi" id="perfil_modi" required="">
							<option></option>
							<option value="1">Administrador</option>
							<option value="2">Contador</option>
							<option value="3">Operador</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">Teléfono</label>
					<div class="col-md-4">
						<input type="text" name="telefono_modi" id="telefono_modi" class="form-control" required="">
					</div>
					<label class="control-label col-md-2">Sueldo</label>
					<div class="col-md-4">
						<input type="text" name="sueldo_modi" id="sueldo_modi" class="form-control" required="">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">Comisión</label>
					<div class="col-md-4">
						<input type="text" name="comision_modi" id="comision_modi" class="form-control" required="">
					</div>
				</div>
	      	</div>
	      	<div class="modal-footer">
	          	<button type="submit" class="btn btn-success ">Modificar&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i></button>
	            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar&nbsp;&nbsp;<i class="fa fa-remove"></i></button>
	        </div>
	       	</form>
	    </div>
	</div>
</div>
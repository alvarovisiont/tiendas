<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<h3>Configuración de Moneda&nbsp;&nbsp;<i class="fa fa-money"></i>
				<?php 
					if(empty($datos))
					{
						echo "<button class='btn btn-success btn-md pull-right' data-toggle='modal' data-target='#modal_configuracion'>Agregar Configuración&nbsp;<i class='fa fa-cog'></i></button>";
					}
					else
					{
						echo "<button class='btn btn-warning btn-md pull-right' data-toggle='modal' data-target='#modal_configuracion_modi'
							data-id_modi = '$datos->id'
							data-siglas_modi = '$datos->siglas'
							data-iva_modi = '$datos->iva'
							data-retencion_modi = '$datos->retencion'
							data-dolar_modi = '$datos->dolar_value'
							>Modificar Configuración&nbsp;<i class='fa fa-cog'></i></button>";	
					}
				 ?>
			</h3>
			<br><br>
			<table class="table table-striped table-hover">
				<tbody>
					<tr>
						<td>
							<label class="control-label col-md-2">
								<h4><b>Móneda</b></h4>
							</label>
							<span class="col-md-10 text-center">
								<h4><?php if(!empty($datos->siglas)){echo $datos->siglas;}?>
									
								</h4>
							</span>
						</td>
						<td><label class="control-label col-md-2">Iva Impuesto: </label><span class="col-md-10 text-center"><h4><?php if(!empty($datos->iva)){echo $datos->iva."%";}?></h4></span></td>									
					</tr>
					<tr>
						<td><label for="" class="control-label col-md-2">% de Retención</label><span class="col-md-10 text-center"><h4><?php if(!empty($datos->retencion)){echo $datos->retencion."%";}?></h4></span></td>
						<td><label class="control-label col-md-2">Valor Dolar en Bs.S </label>
							<span class="col-md-10 text-center">
								<h4>
									<?= number_format($datos->dolar_value,2,',','.'); ?>
								</h4>
							</span>
						</td>		
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_configuracion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog tabla_modal" role="document">
    	<div class="modal-content">
	      <div class="modal-header modal-header2" style="background-color: #FFF">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Agregar Configuración&nbsp;<i class="fa fa-cog"></i></h3>
	      </div>
	      <form action="<?php echo base_url().'Configuracion_finanza/grabar'; ?>" id='form_agregar' class='form-horizontal' method='POST'>
	      <div class="modal-body">
	      	<div class="form-group">
	      		<label for="" class="control-label col-md-3">Siglas de la moneda</label>
	      		<div class="col-md-7">
	      			<input type="text" id="siglas" name="siglas" pattern="[a-zA-Z]{2,}" class="form-control" placeholder="Ejemplo: Moneda: Bolivares Siglas(BSF)" required="">
	      		</div>
	      	</div>
	      	<div class="form-group">
	      		<label for="" class="control-label col-md-3">Iva Impuesto</label>
	      		<div class="col-md-7">
	      			<input type="number" id="iva" name="iva" pattern="[0-9]" class="form-control" required="" placeholder="Expresión en números enteros">
	      		</div>
	      	</div>
	      	<div class="form-group">
	      		<label for="" class="control-label col-md-3">Retención Monetaria</label>
	      		<div class="col-md-7">
	      			<input type="number" id="retencion" name="retencion" pattern="[0-9]" class="form-control" required="" placeholder="Expresión en números enteros">
	      		</div>
	      	</div>
	      	<div class="form-group">
	      		<label for="" class="control-label col-md-3">Dolar en <?= !isset($datos->siglas) ? 'BSS' : $datos->siglas ?></label>
	      		<div class="col-md-7">
	      			<input type="number" id="dolar_value" name="dolar_value" step="any" class="form-control" required="" placeholder="">
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	      	<button class="btn btn-success" type="submit" id="boton_agregar_grupo">Agregar&nbsp;<i class="fa fa-thumbs-up"></i></button>
	      	<button class="btn btn-default" type="button" data-dismiss='modal'>Cerrar&nbsp;<i class="fa fa-remove"></i></button>
	      </div>
	      </form>
    	</div>
	</div>
</div>
<div class="modal fade" id="modal_configuracion_modi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog tabla_modal" role="document">
    	<div class="modal-content">
	      <div class="modal-header modal-header2" style="background-color: #FFF">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Agregar Configuración&nbsp;<i class="fa fa-cog"></i></h3>
	      </div>
	      <form action="<?php echo base_url().'Configuracion_finanza/modificar'; ?>" id='form_agregar' class='form-horizontal' method='POST'>
	      <input type="hidden" id="id_modificar" name="id_modificar">
	      <div class="modal-body">
	      	<div class="form-group">
	      		<label for="" class="control-label col-md-3">Siglas de la moneda</label>
	      		<div class="col-md-7">
	      			<input type="text" id="siglas_modi" name="siglas_modi" class="form-control" placeholder="Ejemplo: Moneda: Bolivares Siglas(BSS)" required="">
	      		</div>
	      	</div>
	      	<div class="form-group">
	      		<label for="" class="control-label col-md-3">Iva Impuesto</label>
	      		<div class="col-md-7">
	      			<input type="number" id="iva_modi" name="iva_modi" pattern="[0-9]" class="form-control" required="" placeholder="Expresión en números enteros">
	      		</div>
	      	</div>
	      	<div class="form-group">
	      		<label for="" class="control-label col-md-3">Retención Monetaria</label>
	      		<div class="col-md-7">
	      			<input type="number" id="retencion_modi" name="retencion_modi" pattern="[0-9]" class="form-control" required="" placeholder="Expresión en números enteros">
	      		</div>
	      	</div>
	      	<div class="form-group">
	      		<label for="" class="control-label col-md-3">Dolar en <?= !isset($datos->siglas) ? 'BSS' : $datos->siglas ?></label>
	      		<div class="col-md-7">
	      			<input type="number" id="dolar_value_modi" name="dolar_value_modi" step="any" class="form-control" required="" placeholder="">
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	      	<button class="btn btn-primary" type="submit" id="boton_agregar_grupo">Modificar&nbsp;<i class="fa fa-thumbs-up"></i></button>
	      	<button class="btn btn-default" type="button" data-dismiss='modal'>Cerrar&nbsp;<i class="fa fa-remove"></i></button>
	      </div>
	      </form>
    	</div>
	</div>
</div>

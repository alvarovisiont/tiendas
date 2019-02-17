<?php
	$session = 1;
	//$this->session->userdata('nivel');
?>

<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br>
			<div class="col-md-12">
				<div class="col-md-offset-6 col-md-3">
					<button type="button" class="btn btn-danger btn-md btn-block btn-outline" data-ruta="<?php echo base_url().'Lista/exportar_pdf_bss';?>" id="exportar_pdf_bss">Exportar a PDF Bs.S&nbsp;<i class="fa fa-file-pdf-o"></i></button>
				</div>
				<div class="col-md-3">
					<button class="btn btn-success btn-md btn-block btn-outline" data-ruta="<?php echo base_url().'Lista/exportar_excel_bss';?>" id="exportar_excel_bss">Exportar a EXCEL Bs.S&nbsp;<i class="fa fa-file-excel-o"></i></button>
				</div>
			</div>

			<br><br>
			
			<div class="col-md-12">
				<div class="col-md-offset-6 col-md-3">
					<button type="button" class="btn btn-danger btn-md btn-block btn-outline" data-ruta="<?php echo base_url().'Lista/exportar_pdf_visa';?>" id="exportar_pdf_visa">Exportar a PDF Visa&nbsp;<i class="fa fa-file-pdf-o"></i></button>
				</div>
				<div class="col-md-3">
					<button class="btn btn-success btn-md btn-block btn-outline" data-ruta="<?php echo base_url().'Lista/exportar_excel_visa';?>" id="exportar_excel_visa">Exportar a EXCEL Visa&nbsp;<i class="fa fa-file-excel-o"></i></button>
				</div>
			</div>
			
			<br><br>
			<br>
			<div class="panel panel-green">
				<div class="panel-heading">
					<h3>Lista de Precios&nbsp;&nbsp;<i class="fa fa-book"></i>
					</h3>

					<div class="col-md-2" id="">
						<button type="button" class="btn btn-info btn-block" title="Ver descuentos activos" data-toggle="modal" data-target="#mod_descuentos_activos">Filtro Grupos&nbsp;<i class="fa fa-search fa-1x"></i></button>
					</div>
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-bordered table-hover table-condensed">
						<thead>
							<th class="text-center">Referencia</th>
							<th class="text-center">Artículo</th>
							<th class="text-center">Marca</th>
							<th class="text-center">Grupo</th>
							<th class="text-center">Costo</th>
							<th class="text-center">Precio Venta</th>
							<th class="text-center">Cantidad</th>
							
							<?php 
								if($session == 1)
								{
								?>
									<th>&nbsp;&nbsp;&nbsp;&nbsp;Mostrar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<?php
								}
							 ?>
						</thead>
						<tbody class="text-center">
							<?php
								if(!empty($datos))
								{
									foreach ($datos as $row) 
									{
										$class = "";

										if($row->cantidad < 10)
										{
											$class = 'alert alert-danger';

										}
										elseif ($row->cantidad >= 10 && $row->cantidad < 100) 
										{
											$class = 'alert alert-warning';
												
										}
										elseif ($row->cantidad >= 100) 
										{
											$class = 'alert alert-success';
										}
										if($session == 1)
										{

											echo "<tr class='".$class."'>
													<td>$row->ref</td>
													<td>$row->nombre</td>
													<td>$row->marca</td>
													<td>$row->grupo</td>
													
													<td> ".number_format($row->precio_proveedor,2,',','.')." ".$conf->siglas." <br> <img src='./img/bolivar.png' class='img-responsive' width='30px'>".number_format($row->precio_proveedor * $conf->dolar_value,2,',','.')." Bs.S</td>

													<td> ".number_format($row->precio,2,',','.')." ".$conf->siglas." <br> <img src='./img/bolivar.png' class='img-responsive' width='30px'> ".number_format($row->precio * $conf->dolar_value,2,',','.')." Bs.S</td>
													<td><span class='label label-info letras'>$row->cantidad</span></td>";?>
												
											 <?php if ($row->mostrar <> 1){ ?>
											 	
												<td>
											  <a href="<?= base_url().'index.php/lista/cambio/'.$row->id.'/1'?>" class="btn btn-app btn-success">
													Mostrar&nbsp;
												</a></td>
											<?php } else { ?>
												<td>  <a href="<?= base_url().'index.php/lista/cambio/'.$row->id.'/0'?>" class="btn btn-app btn-danger">Esconder&nbsp; </td>
											<?php }	?>



												</tr> 
										<?php }
										else
										{
											echo "<tr class='".$class."'>
													<td>$row->nombre</td>
													<td>$row->marca</td>
													<td>$row->grupo</td>
													<td>$row->precio_proveedor</td>
													<td>$row->precio</td>
													<td><span class='label label-info letras'>$row->cantidad</span></td>
													<td></td>
													<td></td>
													
												</tr>";	
										}
											
									}
											//
								}
								else
								{
									if($session == 1)
									{
										echo "<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>

												
											</tr>";
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
												<td></td>
												
											</tr>";	
									}
								}
							?>
						</tbody>
					</table>	
				</div>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="mod_descuentos_activos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


	<form action="<?php echo base_url();?>Lista/filtro" method="POST" class="form-horizontal">

  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Grupo Filtrados																						</h3>
	      </div>
	      <div class="modal-body">
	      
	      			<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<h1 class="text-center">
				Grupo filtrado
			</h1>
		</div>
		<div class="col-md-6">
			<h1 class="text-center">
				Seleccione
			</h1>
		</div>
	</div>

	<?php
      					foreach ($grupo as $row) { ?>

      						<div class="row">

	      						<div class="col-md-6">
									<h5 class="text-center">
										<?php echo $row->grupo; ?>
									</h5>
								</div>
								<div class="col-md-6">
									<?php if ($row->activo == 1){?>	
      								<div align="center">
      								<input type="checkbox" id="grupo[]" name="grupo[]" value="<?php echo $row->grupo; ?>" checked> 
      								</div>

      								 <?php } else { ?>

      								 	<div align="center">
      								 	<input type="checkbox" id="grupo[]" name="grupo[]" value="<?php echo $row->grupo; ?>">
      								 	</div>
      								 	

      								<?php } ?>
								</div>

							</div>	
      					<?php }
	      				
	      			?>

 </div>
	      		
	      </div>
	      	<div class="modal-footer">
	          		<?php 
	          			//if($this->session->has_userdata('iva'))
	          			
	          				if(1 == 1)

	          			{
	          				echo '<button type="submit" class="btn btn-danger">Filtrar&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i></button>';
	          			}
	          			else
	          			{
	          				echo '<button type="submit" class="btn btn-danger" disabled>Agregar&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i></button>';
	          			}
	          		 ?>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar&nbsp;&nbsp;<i class="fa fa-remove"></i></button>
	            </div>
	      </form>
    	</div>

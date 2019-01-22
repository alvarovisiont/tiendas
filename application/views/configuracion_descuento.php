<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<h3>Configuración de Descuento&nbsp;&nbsp;<i class="fa fa-money"></i></h3>
			<br><br>
			
		</div>
	</div>

	<?php
    if ($this->session->flashdata('message')) 
    {
    ?>
       <span id="registroCorrecto"><?php echo $this->session->flashdata('message'); ?></span>
    <?php
    }
    ?>


</div>



<?php
	if(!empty($datos))
	{ ?>

		<div class="container-fluid">
	    <div class="row" align="center">

	   <table width="100%" cellpadding="" border="0" cellspacing=""> 	
	   	<tr>
	  <?php
		foreach ($datos as $row) 
		{ ?>

		

		<td>	
			<h3>
				<?php echo $row->nombre; ?>
			</h3>

		<?php if ($row->status == 0){ $sw = 1;?>

			<button class="btn btn-default btn-md" style="float: center" data-toggle="modal" data-target="#agg_activar" data-id_modi = "<?php echo $row->id;?>" data-sw_modi = "<?php echo $sw;?>"><img src='./img/apagar.png' class='img-responsive' width='100px'  class="rounded-circle"></button>
		<?php }

         if ($row->status == 1){ $sw = 2; ?>

         	<button class="btn btn-default btn-md" style="float: center" data-toggle="modal" data-target="#agg_activar" data-id_modi = "<?php echo $row->id;?>"  data-sw_modi = "<?php echo $sw;?>"><img src='./img/encender.png' class='img-responsive' width='100px'  class="rounded-circle"></button>

         	<br><br>
						<div class="alert alert-success alert-dismissable">
							 
							<h3>
								Activo
							</h3> <strong>Porcentaje <?php echo $row->cantidad?> %</strong> <br>

							<strong>Fecha de Activación <?php echo date('d/m/Y', strtotime($row->activacion))?></strong>
						</div>
			
		<?php	}else { ?>

			<br><br>

			<div class="alert alert-danger alert-dismissable">
							 
							 <h3>
								Desactivado
							</h3> <strong>Puede activarlo con la clave maestra del sistema</strong> <br>
							<strong>Active colocando un porcentaje de descuento</strong>
						</div>

		<?php } ?>

		</td>
		<td>
			 &nbsp; &nbsp;
		</td>	

		
	<?php	} ?>

      </tr>

  </table>

	</div>
	
	</div>

	<?php
		
	}
	
 ?>		

 <div class="container">
  
  <div class="alert alert-info alert-dismissable">
							 
							 <h3>
								Clave maestra
							</h3> <strong>Para realizar las pruebas la clave es 1234</strong> <br>
							<strong>Luego se cambiara a una clave que el administrador pueda manejar</strong>
						</div>
</div>



<div class="modal fade" id="agg_activar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h3 class="text-center">Autorizar<i class="fa fa-book"></i></h3>
	      </div>
			<form action="<?php echo base_url();?>Configuracion_descuento/activar" method="POST" id="form_agregar" class="form-horizontal">

				<input type="hidden" id="id_modificar" name="id_modificar">
				<input type="hidden" id="sw_modificar" name="sw_modificar">

	          	<div class="modal-body">
	          		<div class="row">
	     
	          			<div class="form-group">
	          				<label for="cant" class="control-label col-md-3">Porcentaje</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-cart-plus" aria-hidden="true"></i></span> 
	              					<input type="text" class="form-control" name="cantidad" id="cantidad" required="" value=0>
	          					</div>
	          				</div>
	          			</div>
	          			<div class="form-group">
	          				<label for="pass" class="control-label col-md-3">Clave</label>
	          				<div class="col-md-8">
	          					<div class="input-group">
	              					<span class="input-group-addon"><i class="fa fa-cart-plus" aria-hidden="true"></i></span> 
	              					<input type="password" class="form-control" name="pass" id="pass" required="">
	          					</div>
	          				</div>
	          				

	          			</div>
	          		</div>
	          	</div>
	          	<div class="modal-footer">
	          		<?php 
	          				echo '<button type="submit" class="btn btn-danger">Activar&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i></button>';
	          		 ?>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar&nbsp;&nbsp;<i class="fa fa-remove"></i></button>
	            </div>
	      </form>
	    </div>
	  </div>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});


$(function(){
        $("#agg_activar").on('show.bs.modal', function(e){

            var  x = $(e.relatedTarget).data().id_modi;
                     $("#id_modificar").val(x);
            var  x = $(e.relatedTarget).data().sw_modi;
                     $("#sw_modi").val(x);         
        });
    
        });
    
</script>	


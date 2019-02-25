<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="<?= base_url().'css/login_css.css' ?>" rel="stylesheet" id="bootstrap-css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="login-reg-panel">
		<div class="login-info-box">
			<h2>Have an account?</h2>
			<p>Lorem ipsum dolor sit amet</p>
			<label id="label-register" for="log-reg-show">Login</label>
			<input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
		</div>
							
		<div class="register-info-box">
			<!-- 
			<h2>Don't have an account?</h2>
			<p>Lorem ipsum dolor sit amet</p>
			<label id="label-login" for="log-login-show">Register</label>
			<input type="radio" name="active-log-panel" id="log-login-show">
			-->
			<h2>Problemas en Cache?</h2>
			<p>Puedes resetear el navegador para borrar datos en cache</p>
			<label id="label-login" for="log-login-show">Resetear</label>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>
							
		<div class="white-panel">
			<form class="form-signin" action="" method="POST" id="form_registro">
				<div class="login-show">
					<div class="row">
						<div class="offset-md-3 col-md-4">
							<img id="profile-img" class="profile-img-card" src="./img/logotipo.png"  width="160px" />
						</div>
					</div>
					</h2>
					<input type="text" id="usuario" name="usuario" placeholder="Usuario" required="" class="form-control">
					<input type="password" id="clave" name="clave" class="form-control" placeholder="Clave" required="">

					<input type="button" value="Login" onclick="submitForm()">
					<button type="submit" id="btn_form" style="display: none"></button>
					<a href="">Olvido su Contraseña?</a>
					<p id="aviso" class="alert alert-danger mt-5" style="display: none;"></p>
				</div>
			</form>
			<div class="register-show">
				<h2>REGISTER</h2>
				<input type="text" placeholder="Email">
				<input type="password" placeholder="Password">
				<input type="password" placeholder="Confirm Password">
				<input type="button" value="Register">
			</div>
		</div>
	</div>
	<script type="text/javascript">
		
    $(document).ready(function(){
	    $('.login-info-box').fadeOut();
	    $('.login-show').addClass('show-log-panel');
	});


    function submitForm(){
    	$('#btn_form').click()
    }

	$('.login-reg-panel input[type="radio"]').on('change', function() {
	    if($('#log-login-show').is(':checked')) {
	        /*$('.register-info-box').fadeOut(); 
	        $('.login-info-box').fadeIn();
	        
	        $('.white-panel').addClass('right-log');
	        $('.register-show').addClass('show-log-panel');
	        $('.login-show').removeClass('show-log-panel');*/
	        window.location.href = "<?= base_url().'index.php/login/salir'?>"
	    }
	    else if($('#log-reg-show').is(':checked')) {

	        /*$('.register-info-box').fadeIn();
	        $('.login-info-box').fadeOut();
	        
	        $('.white-panel').removeClass('right-log');
	        
	        $('.login-show').addClass('show-log-panel');
	        $('.register-show').removeClass('show-log-panel');*/
	    }
	});

	$("#form_registro").submit(function(e){
		
		e.preventDefault()

		let user = $('#usuario').val(),
			pass = $('#clave').val()

			if(user === "" || pass === ""){
				alert('El usuario y la clave son requeridos')
			}else{		
		    $.ajax({
		        url: "<?php echo base_url()?>Login/verificar",
		        type: "POST",
		        data: $(this).serialize(),
		        dataType: "JSON",
		        success: function(data)
		        {
		            if(typeof(data.exito) != "undefined")
		            {
		              if(data.nivel == 1){
		                window.location.href = "<?php echo base_url()?>Admin";
		              }else{
		                window.location.href = "<?php echo base_url()?>Admin";
		              }
		            }
		            else
		            {
		                $("#aviso").html('');
		                $("#aviso").show('slow/400/fast');
		                $("#aviso").text("El usuario o la contraseña son incorrectos");
		            }
		        }
		    });
			}

      return false;
    });
  
	</script>
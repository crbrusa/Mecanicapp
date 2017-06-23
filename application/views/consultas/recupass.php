<div class="login-box-body">

<?php

	  		if($mensaje!= null)
			{
				echo '<div class="alert alert-danger">';
				echo $mensaje;
				echo '</div>';
				
			}
			if(validation_errors()!= null)
			{

				echo '<div class="alert alert-danger">';
				echo validation_errors();
				echo '</div>';


			}

			?>
<p class="login-box-msg">Ingrese su e-mail </p>
<?php echo form_open('mecanicapp/recpass/'); ?>
     <div class="form-group has-feedback">


        <input type="email" name="mail" class="form-control" placeholder="Email">  

<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

<div class="">
        
        <div class="">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Enviar Constraseña</button>
        </div>
        <!-- /.col -->
      </div>

     
</form>

<div class="login-box-body">
<?php

$error = $this->session->flashdata('usuario_incorrecto');
	  		if($error)
			{
				echo '<div class="alert alert-danger">';
				echo $error;
				echo '</div>';
				
			}

			if(validation_errors()!= null)
			{

				echo '<div class="alert alert-danger">';
				echo validation_errors();
				echo '</div>';


			}

			?>



<p class="login-box-msg"><?php echo $subtitle1; ?></p>

<?php echo form_open('mecanicapp'); ?>
       

       <div class="form-group has-feedback">
        <input type="email" name="mail" class="form-control" placeholder="Email">


   

<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

 <div class="form-group has-feedback">
        <input type="password" name="pass" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

<div class="">
        
        <div class="">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>

</form>

<div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->



    <a href="<?php echo site_url('Mecanicapp/recpass'); ?>">Recuperar contraseña</a>
<br>
<a href='<?php echo site_url('Mecanicapp/reguser/cli'); ?>'" class="text-center">Registrar</a>

</div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


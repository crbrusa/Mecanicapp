<?php  
            if(validation_errors()!= null)
            {

                echo '<div class="alert alert-danger">';
                echo validation_errors();
                echo '</div>';


            }

            ?>
<?php echo form_open('mecanicapp/reguser/cli'); ?>
        <h2><?php echo $subtitle1; ?></h2>

    <label for="rut">Rut</label>
    <input type="text" name="rut" /><br />

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" /><br />

    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" /><br />

    <label for="email">E-mail</label>
    <input type="text" name="email" /><br />

    <label for="pass">Contraseña</label>
	<input type="password" name="pass" /><br />


<script type="text/javaScript">
    $(function() {
        $('input[type="checkbox"]').on('change', function() {
            $(this).closest('fieldset').find('.myClass').toggle(this.checked);
        });
    });
</script>

<fieldset>
    <legend><input type="checkbox" name="check" checked> Registrar vehiculo</legend>
    <span class="myClass">
         <label for="rut">Patente</label>
    <input type="text" name="patente" /><br />

    <label for="nombre">Marca</label>
    <input type="text" name="marca" /><br />

    <label for="apellido">Modello</label>
    <input type="text" name="modelo" /><br />

    <label for="email">Año</label>
    <input type="text" name="ano" /><br />

    <label for="pass">Color</label>
    <input type="text" name="color" /><br />

    </span>
</fieldset>




    <input type="submit" name="submit" value="Enviar" />

</form>

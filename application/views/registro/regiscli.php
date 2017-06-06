
<?php echo validation_errors(); ?>

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
	<input type="text" name="pass" /><br />


    <input type="submit" name="submit" value="Enviar" />

</form>

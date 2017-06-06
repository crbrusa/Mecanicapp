<h2><?php echo $subtitle1; ?></h2>
<?php echo validation_errors(); ?>

<?php echo form_open('mecanicapp/regserv'); ?>
       


    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" /><br />

    <label for="descripcion">Descripcion</label>
    <input type="text" name="descripcion" /><br />

    <label for="costo">Costo</label>
    <input type="text" name="costo" /><br />

    <label for="duracion">Duracion</label>
	<input type="text" name="duracion" /><br />


    <input type="submit" name="submit" value="Enviar" />

</form>
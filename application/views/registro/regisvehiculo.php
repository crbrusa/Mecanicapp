 <h2><?php echo $subtitle1; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('mecanicapp/regveh/'. $iduser); ?>
       

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


    <input type="submit" name="submit" value="Agregar" />

</form>

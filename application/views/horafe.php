<?php echo validation_errors(); ?>

<?php echo form_open('mecanicapp/vehfec/'. $idveh); ?>
       

    <label for="fecha">Fecha (AAAA/MM/DD)</label>
    <input type="text" name="fecha" /><br />

    <label for="hora">Hora (HH:MM)</label>
    <input type="text" name="hora" /><br />


    <input type="submit" name="submit" value="Agendar" />

</form>

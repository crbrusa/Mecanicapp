<?php foreach ($trabajos as $news_item): ?>

        <div class="main">
                <?php echo $news_item['nombre']
                 ." ". $news_item['descripcion']
                 ." ". $news_item['costo']
                 ." ". $news_item['duracion']; ?>
                
        </div>
               
<?php endforeach; ?>
</br>
<a href="<?php echo site_url('Mecanicapp/preapro/' . $news_item['patente']); ?>">
            Enviar al cliente
        </a> 
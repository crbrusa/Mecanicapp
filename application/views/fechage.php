<?php foreach ($vehiculos as $news_item): ?>

        <div class="main">
                
                <?php echo $news_item['patente']
                 ." ". $news_item['fecha']
                 ." ". $news_item['hora'] ; ?>
                 <a href="<?php echo site_url('Mecanicapp/entrega/TRUE/' . $news_item['patente']); ?>">
                SI
                 </a>
                &nbsp;
               	<a href="<?php echo site_url('Mecanicapp/entrega/FALSE/' . $news_item['patente']); ?>">
                NO
                 </a>
        </div>
<?php endforeach; ?>
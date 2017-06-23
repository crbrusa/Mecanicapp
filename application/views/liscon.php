<?php foreach ($vehiculos as $news_item): ?>

        <div class="main">
                <a href="<?php echo site_url('Mecanicapp/conftrab/' . $news_item['patente']); ?>">
                <?php echo $news_item['patente']
                 ." ". $news_item['fecha']
                 ." ". $news_item['hora'] ; ?>
                </a>
        </div>
<?php endforeach; ?>
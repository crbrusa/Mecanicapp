<?php foreach ($vehiculos as $news_item): ?>

        <div class="main">
                <a href="<?php echo site_url('Mecanicapp/costotal/' . $news_item['patente']); ?>">
                <?php echo $news_item['patente']
                 ." ". $news_item['marca']
                 ." ". $news_item['modelo']
                 ." ". $news_item['año']
                 ." ". $news_item['color']
                 ." ". $news_item['fecha']
                 ." ". $news_item['hora']; ?>
                </a>
        </div>
<?php endforeach; ?>
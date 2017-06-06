<?php foreach ($vehiculos as $news_item): ?>

        <div class="main">
                <a href="<?php echo site_url('Mecanicapp/vehfec/' . $news_item['patente']); ?>">
                <?php echo $news_item['patente']
                 ." ". $news_item['marca']
                 ." ". $news_item['modelo']
                 ." ". $news_item['año']
                 ." ". $news_item['color']; ?>
                </a>
        </div>
<?php endforeach; ?>
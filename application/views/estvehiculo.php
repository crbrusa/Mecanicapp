//falta mejorar
<?php foreach ($vehiculos as $news_item): ?>

        <div class="main">
                <?php echo $news_item['patente']
                 ." ". $news_item['marca']
                 ." ". $news_item['modelo']
                 ." ". $news_item['año']
                 ." ". $news_item['color']
                 ." ". $news_item['estado']; ?>
                </a>
        </div>
<?php endforeach; ?>
<?php foreach ($usuarios as $news_item): ?>

        <div class="main">
                <a href="<?php echo site_url('Mecanicapp/'. $fun . '/' . $news_item['id']); ?>">
                <?php echo $news_item['rut']
                 ." ". $news_item['acceso']
                 ." ". $news_item['nombre']
                 ." ". $news_item['apellido']
                 ." ". $news_item['email']; ?>
                </a>
        </div>
<?php endforeach; ?>
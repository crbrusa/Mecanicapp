<?php foreach ($vehiculos as $news_item): ?>

        <div class="main">
                <a href="<?php echo site_url('cliente/seltrab/' . $news_item['patente']); ?>">
                
                <?php echo $news_item['patente']
                 ." ". $news_item['marca']
                 ." ". $news_item['modelo']
                 
                  ; ?>
                  </a>

        </div>
<?php endforeach; ?>
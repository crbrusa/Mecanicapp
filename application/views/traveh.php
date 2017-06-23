<?php foreach ($vehiculos as $news_item): ?>

        <div class="main">
                
                <?php foreach ($news_item as $atribute=>$info):


                	echo $info ." ";
                 
                 endforeach; 

                 //echo form_checkbox('newsletter', 'accept', TRUE);?>

        </div>
<?php endforeach; ?>

<?php foreach ($vehiculos as $news_item): ?>

<a href="<?php echo site_url('mecanico/trablis/' . $news_item['patente']); ?>">Finalizar</a>

<?php endforeach; ?>
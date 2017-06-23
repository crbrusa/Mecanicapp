<?php foreach ($vehiculos as $news_item): ?>

        <div class="main">
                
                <?php foreach ($news_item as $atribute=>$info):


                	echo $info ." ";
                 
                 endforeach; 

                 //echo form_checkbox('newsletter', 'accept', TRUE);?>

        


<a href="<?php echo site_url('ejecutivo/vehent/' . $news_item['patente']); ?>">Entregado</a>
</div>
<?php endforeach; ?>
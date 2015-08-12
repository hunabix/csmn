<!-- Formulario de plantillas -->
<form id="plantillas-form" name="plantillas-form" class="plantillas-form form panel-contenido" method="post" action="<?= cs_url; ?>/plantillas" >

    <?php //print_array($plantillas); ?>
    <?php foreach ($plantillas as $key => $value) : ?>
    	<div>
    		<h2><?php echo $value['nombre']; ?></h2>
    		<span>ID: <?php echo $value['ID']; ?></span>
    		<textarea><?php echo $value['contenido']; ?></textarea>
    	</div>
	<?php endforeach; ?>


</form>
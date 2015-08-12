<?php
/**
 * Plantilla [Plantillas de correo]
 **/
require_once("part/header.php"); ?>
	
	<?php // var_dump( $user); ?>

	<!-- Titulo -->
	<h2 class="section-title">Plantillas de correo</h2>

	<!-- Muestreo de variables [PRUEBAS]
	================================================== --> 
	<?php //var_dump($data['configuracion']);  ?>

	<!-- Muestreo de variables [PRUEBAS]
	================================================== --> 

	<section class="panel contenedor configuracion">
	    
	    <!-- Nav tabs -->
		<ul class="nav nav-tabs conf-tabs" role="tablist">
		    <li role="presentation" id="conf-tab-fechas">
		    	<a href="#fechas-tab" aria-controls="fechas-tab" role="tab" data-toggle="tab"><i class="fa fa-calendar"></i> Fechas</a>
		    </li>
		    <li role="presentation" id="conf-tab-usuarios">
		    	<a href="#usuarios-tab" aria-controls="usuarios-tab" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Usuarios</a>
		    </li>
		    <li role="presentation" id="conf-tab-plantillas" class="active">
		    	<a href="#plantillas-tab" aria-controls="plantillas-tab" role="tab" data-toggle="tab"><i class="fa fa-file-text "></i> Plantillas</a>
		    </li>
		</ul>

		<!-- Secciones  -->
		<div class="tab-content">

			<!-- FECHAS -->
			<div role="tabpanel" class="tab-pane fade" id="fechas-tab">
				
				<?php require("part/configuracion-fechas.php");  ?>
		    
		    </div>

			<!-- UCUARIOS -->
			<div role="tabpanel" class="tab-pane fade" id="usuarios-tab"> 

				<?php require("part/configuracion-usuarios.php");  ?>

			</div>
			<!-- PLANTILLAS -->
			<div role="tabpanel" class="tab-pane fade  in active" id="plantillas-tab">
				
				<?php require("part/configuracion-plantillas_b.php");  ?>

			</div>
		</div>
	</section>
	
	<!-- Alertas del sistema -->
	<div class="alert alert-success alerta" id="alerta-exito" role="alert">Hola</div>

<?php
require_once("part/footer.php"); ?>
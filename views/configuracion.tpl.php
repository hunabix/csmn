<?php
/**
 * Plantilla [login]
 **/
require_once("part/header.php"); ?>
	
	<?php // var_dump( $user); ?>

	<!-- Titulo -->
	<h2 class="section-title">Configuración</h2>

	<!-- Muestreo de variables [PRUEBAS]
	================================================== --> 
	<?php // var_dump($data['configuracion']);  ?>
	<!-- Muestreo de variables [PRUEBAS]
	================================================== --> 

	<section class="panel contenedor">
	    
	    <!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active class="panel-titulo"">
		    	<a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-calendar"></i> Fechas</a>
		    </li>
		    <li role="presentation">
		    	<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Usuarios</a>
		    </li>
		    <li role="presentation">
		    	<a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-file-text "></i> Plantillas</a>
		    </li>
		</ul>

		<!-- Secciones  -->
		<div class="tab-content">

			<!-- FECHAS -->
			<div role="tabpanel" class="tab-pane fade in active" id="home">
				
				<?php require("part/configuracion-fechas.php");  ?>
		    
		    </div>

			<!-- UCUARIOS -->
			<div role="tabpanel" class="tab-pane fade" id="profile"> 

				<?php require("part/configuracion-usuarios.php");  ?>

			</div>
			<!-- PLANTILLAS -->
			<div role="tabpanel" class="tab-pane fade" id="messages">
				
				<?php require("part/configuracion-plantillas.php");  ?>

			</div>
		</div>
	</section>

<?php
require_once("part/footer.php"); ?>
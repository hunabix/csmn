<section id="notificaciones" class="Notificaciones">
	<div class="Notificaciones-wrapper">
		<!-- Barra de encabezado -->
		<header class="Notificaciones-header form">
			<!-- toggle button -->
			<button id="notificaciones-toggle-btn" class="Notificaciones-toggleBtn btn btn-primary btn-fill">
				<i class="fa fa-caret-right"></i>
			</button>
			<!-- Título -->
			<h3 class="Notificaciones-title">Notificaciones</h3>
			<!-- Descargar notificaciones -->
			<button class="Notificaciones-downloadBtn btn btn-primary btn-fill">
				<i class="fa fa-cloud-download"></i>
			</button>
		</header>
		
		<!-- Notificaciones contenido -->
		<div class="panel-group Notificaciones-body" id="accordion" role="tablist" aria-multiselectable="true">
			
			<!-- Vencidas 
			================================================== -->
			<?php  if ( !empty($notifications['vencidas'] )) :?>
				<div class="panel panel-default Notificaciones-panel">
				    <div class="panel-heading Notificaciones-panelHeading is-outdate" role="tab" id="headingZero">
					    <h4 class="panel-title Notificaciones-panelTitle">
					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapzeZero" aria-expanded="true" aria-controls="collapzeZero">
					        	<i class="fa fa-exclamation-circle"></i> Vencidas
					        </a>
					    </h4>
				    </div>
				    <div id="collapzeZero" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingZero">
				      	<div class="panel-body Notificaciones-panelBody">
				      	
							<!-- Notificaciones regulares -->
				      		<h4 class="Notificaciones-panelTituloTipo"><i class="fa fa-bell-o"></i> Regular</h4>
					        <!-- Notificaciones -->
							<?php foreach ( $notifications['vencidas']['recordatorio'] as $notificacion ) { ?>
								<?php if( $notificacion['tipo'] == 'recordatorio' ) : ?>
									<?php require("notificaciones-item.php"); ?>
								<?php endif; ?>
							<?php } ?>

					        <!-- Notificaciones llamadas -->
				      		<h4 class="Notificaciones-panelTituloTipo"><i class="fa fa-phone"></i> Llamadas</h4>
					        <!-- Notificaciones -->
							<?php foreach ( $notifications['vencidas']['llamada'] as $notificacion ) { ?>
								<?php if( $notificacion['tipo'] == 'llamada' ) : ?>
									<?php require("notificaciones-item.php"); ?>
							    <?php endif; ?>
							<?php } ?>
				      	</div>
				    </div>
				</div>
			<?php endif; ?>
			<!-- HOY 
			================================================== -->
			<?php  if ( !empty($notifications['hoy'] )) :?>
				<div class="panel panel-default Notificaciones-panel">
				    <div class="panel-heading Notificaciones-panelHeading" role="tab" id="headingOne">
					    <h4 class="panel-title Notificaciones-panelTitle">
					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					        	Hoy
					        </a>
					    </h4>
				    </div>
				    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				      	<div class="panel-body Notificaciones-panelBody">
				      	
				      		<!-- Notificaciones regulares -->
				      		<h4 class="Notificaciones-panelTituloTipo"><i class="fa fa-bell-o"></i> Regular</h4>
					        <!-- Notificaciones -->				        
							<?php foreach ( $notifications['hoy']['recordatorio'] as $notificacion ) { ?>
								<?php if( $notificacion['tipo'] == 'recordatorio' ) : ?>
									<?php require("notificaciones-item.php"); ?>
							       <?php endif; ?>
							<?php } ?>
					        <!-- Notificaciones llamadas -->
				      		<h4 class="Notificaciones-panelTituloTipo"><i class="fa fa-phone"></i> Llamadas</h4>
					        <!-- Notificaciones -->
							<?php foreach ( $notifications['hoy']['llamada'] as $notificacion ) { ?>
								<?php if( $notificacion['tipo'] == 'llamada' ) : ?>
									<?php require("notificaciones-item.php"); ?>
							       <?php endif; ?>
							<?php } ?>

				      	</div>
				    </div>
				</div>
			<?php endif; ?>
			<!-- Próximamente 
			================================================== -->
			<?php  if ( !empty($notifications['proximamente'] )) :?>
				<div class="panel panel-default Notificaciones-panel">
				    <div class="panel-heading Notificaciones-panelHeading" role="tab" id="headingTwo">
				      	<h4 class="panel-title Notificaciones-panelTitle">
					        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					        	Próximamente
					        </a>
				      	</h4>
				    </div>
				    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
				      	<div class="panel-body Notificaciones-panelBody">
					       	
							<!-- Notificaciones regulares -->
				      		<h4 class="Notificaciones-panelTituloTipo"><i class="fa fa-bell-o"></i> Regular</h4>
					        <!-- Notificaciones -->
							<?php foreach ( $notifications['proximamente']['recordatorio'] as $notificacion ) { ?>
								<?php if( $notificacion['tipo'] == 'recordatorio' ) : ?>
									<?php require("notificaciones-item.php"); ?>
							    <?php endif; ?>
							<?php } ?>
					        <!-- Notificaciones llamadas -->
				      		<h4 class="Notificaciones-panelTituloTipo"><i class="fa fa-phone"></i> Llamadas</h4>
					        <!-- Notificaciones -->
							<?php foreach ( $notifications['proximamente']['llamada'] as $notificacion ) { ?>
								<?php if( $notificacion['tipo'] == 'llamada' ) : ?>
									<?php require("notificaciones-item.php"); ?></div>
							    <?php endif; ?>
							<?php } ?>

				      	</div>
				    </div>
				</div>
			<?php endif; ?>
			<!-- Más adelante 
			================================================== -->
			<?php  if ( !empty($notifications['mas_adelante'] )) :?>
				<div class="panel panel-default Notificaciones-panel">
				    <div class="panel-heading Notificaciones-panelHeading" role="tab" id="headingThree">
				      	<h4 class="panel-title Notificaciones-panelTitle">
					        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					        	Más adelante
					        </a>
				      	</h4>
				    </div>
				    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
				      	<div class="panel-body Notificaciones-panelBody">
					    	<!-- Notificaciones regulares -->
				      		<h4 class="Notificaciones-panelTituloTipo"><i class="fa fa-bell-o"></i> Regular</h4>
					        <!-- Notificaciones -->
							<?php foreach ( $notifications['mas_adelante']['recordatorio'] as $notificacion ) { ?>
								<?php if( $notificacion['tipo'] == 'recordatorio' ) : ?>
									<?php require("notificaciones-item.php"); ?>
							    <?php endif; ?>
							<?php } ?>
					        <!-- Notificaciones llamadas -->
				      		<h4 class="Notificaciones-panelTituloTipo"><i class="fa fa-phone"></i> Llamadas</h4>
					        <!-- Notificaciones -->
							<?php foreach ( $notifications['mas_adelante']['llamada'] as $notificacion ) { ?>
								<?php if( $notificacion['tipo'] == 'llamada' ) : ?>
									<?php require("notificaciones-item.php"); ?>
							    <?php endif; ?>
							<?php } ?>
				      	</div>
				    </div>
				</div>
			<?php endif; ?>
		</div>

		<?php require("notificaciones-form.php"); ?>
	</div>
</section>

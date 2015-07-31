<section id="notificaciones" class="Notificaciones">
	
	<!-- Barra de encabezado -->
	<header class="Notificaciones-header is-showing">
		<!-- toggle button -->
		<button class="Notificaciones-headerToggleBtn">
			<i class="fa fa-caret-right"></i>
		</button>
		<!-- Título -->
		<h3 class="Notificaciones-title">Notificaciones</h3>

		<!-- Descargar notificaciones -->
		<!-- <button class="slideout-menu-toggle">
			<i class="fa fa-caret-square-o-right"></i>
		</button> -->
	</header>
	
	<!-- Notificaciones contenido -->
	<div class="panel-group Notificaciones-content" id="accordion" role="tablist" aria-multiselectable="true">
		  
		<!-- HOY -->
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
		      	
					<!-- Notificaciones atrasadas -->
		      		<h4 class="Notificaciones-panelTituloTipo"><i class="fa fa-exclamation-circle"></i> Pasadas</h4>
			        <!-- Notificaciones -->
			        <div id="1" class="Notificaciones-notificacion form">
						<!-- Checkbox & Texto -->
						<div class="Notificaciones-notificacionTexto" for="notificacion_1">
						    <!-- check -->
						    <label class="fancy-check">
						        <input name="notificacion_1" id="notificacion_1" value="1" type="checkbox" class="check Notificaciones-notificacionCheck" form="">
						        <span class="fa fa-square-o check-icon"></span>
						        <!-- Texto -->
						        <span class="Notificaciones-notificacionTexto">
						            Texto de la notificacion
						        </span>
						    </label>
						</div>
						<i class="fa fa-file-text-o" data-toggle="tooltip" data-placement="top" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi, esse."></i>
						<span>31 jul</span>
			        </div>	        
		      		<!-- Notificaciones regulares -->
		      		<h4 class="Notificaciones-panelTituloTipo"><i class="fa fa-bell-o"></i> Regular</h4>
			        <!-- Notificaciones -->
			        ....
			        <!-- Notificaciones llamadas -->
		      		<h4 class="Notificaciones-panelTituloTipo"><i class="fa fa-phone"></i> Llamadas</h4>
			        <!-- Notificaciones -->
			    	...	
		      	</div>
		    </div>
		</div>
		
		<!-- Próximamente -->
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
			        ...
		      	</div>
		    </div>
		</div>
		
		<!-- Más adelante -->
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
			       ...
		      	</div>
		    </div>
		</div>
		

	</div>


</section>

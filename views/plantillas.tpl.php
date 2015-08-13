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
	<?php //var_dump($plantillas );  ?>

	<!-- Muestreo de variables [PRUEBAS]
	================================================== --> 

	<section class="contenedor Plantillas">

		<!-- Formulario de plantillas -->
		<form id="plantillas-form" name="plantillas-form" class="plantillas-form form" method="post" action="<?= cs_url; ?>/plantillas" >
		    <!-- Nuevo plantilla; button modal -->
		    <button type="button" id="nueva-plantilla" class="btn btn-primary btn-fill btn-lg" data-toggle="modal" data-target="#modal-plantilla">
		       	<i class="fa fa-clipboard"></i> Nueva plantilla
		    </button>

			<!-- Plantillas -->
			<section id="template-list" class="templates">
							
				<?php foreach ($plantillas as $plantilla) { ?>
						    
					<div id="<?= $plantilla['ID']; ?>" class="template">		       
					    <!-- plantilla -->
					    <span class="templateimg">
					      	<i class="fa fa-file-code-o userimg"></i> 
					    </span>
					    <span class="templatename"><?= $plantilla['nombre']; ?></span>
					    <!-- Acciones -->
						<aside class="actions">
						    <!-- Editar plantilla -->
						    <a href="#" class="action editar-plantilla" data-toggle="modal" data-target="#modal-plantilla"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar plantilla"></i></a>        
						    <!-- Eliminar plantilla -->
						    <a href="#" class="action eliminar-plantilla" data-toggle="modal" data-target="#modal-plantilla-eliminar" tipo-accion="eliminar"><i class="fa fa-close" data-toggle="tooltip" data-placement="top" title="Eliminar plantilla"></i></a>
						</aside>
					</div>
				<?php } ?>

			</section>	

			<!-- plantilla; modal -->
			<div class="modal fade modal-plantilla" id="modal-plantilla" tabindex="-1" role="dialog" aria-labelledby="modal-plantilla-label">
				<div class="modal-dialog" role="document">
				    <div class="modal-content">
					    <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="titulo-modal-plantilla"> ... </h4>
					    </div>
					    <div class="modal-body">
					    	<!-- Nombre -->
					    	<div class="input-group nombre">
					    	    <input name="nombre" type="text" id="plantilla-nombre" class="form-control" placeholder="Título de la plantilla" value="" required>
					    	    <span class="input-group-addon"><i class="fa"></i></span>
					    	</div>
					    	<!-- Textarea -->
			                <div class="input contenido-plantilla">
			                   <textarea name="contenido" id="plantilla-contenido" type="text-area" class="form-control"></textarea>
			                </div>
					    </div>
					    <div class="modal-footer">
					     	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					        <button  id="modal-plantilla-submit" type="submit" class="btn btn-primary"> ... </button>
					    </div>
				    </div>
				</div>
			</div>

			<!-- Modal | eliminar plantilla-->
			<div class="modal fade" id="modal-plantilla-eliminar" tabindex="-1" role="dialog" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <!-- Encabezado del modal  -->
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                <h4 class="modal-title">
			                    Eliminar plantilla
			                </h4>
			            </div>
			            <!-- Cuerpo del modal  -->
			            <div class="modal-body">
			                <div class="alert alert-danger" role="alert">
			                  ¿Estas seguro de que deseas eliminar la plantilla <strong id="nombre-a-eliminar"></strong>?
			                </div>
			            </div>
			            <!-- Pié del modal  -->
			            <div class="modal-footer">
			                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			                <button type="submit" class="btn btn-primary">Si, por favor</button>
			            </div>
			        </div>
			    </div>
			</div>

			<!-- Datos base a enviar -->
			<input type="hidden" name="formulario" value="plantillas-form">
			<input id="plantilla-id" type="hidden" name="plantilla-id" value="">
			<input id="plantilla-tipo-accion" type="hidden" name="tipo-accion" value="">

		</form>
		
	</section>
	
	<!-- Alertas del sistema -->
	<div class="alert alert-success alerta" id="alerta-exito" role="alert"></div>

<?php
require_once("part/footer.php"); ?>
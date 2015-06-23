<?php
/**
 * Plantilla [login]
 **/
require_once("part/header.php"); ?>
		
		<!-- Muestreo de variables [PRUEBAS]
		================================================== --> 
		<!-- <p class="datos"><?php var_dump($data) ?></p> -->
		<!-- Muestreo de variables [PRUEBAS]
		================================================== --> 

		<!-- Titulo -->
		<h2 class="section-title">Componer mensaje</h2>
		
		<!-- Formulario componer mensaje -->
		<form id="mensaje-form" name="mensaje-form" class="mensaje-form form" method="post" action="<?= cs_url; ?>/componer-mensaje" >
			
			<!-- Lista de destinatarios -->
			<aside id="destinatarios" class="destinatarios">
				<ul>
					
					<li class="destinatario"><strong><?= $data['nombre'] ?> <?= $data['apellidos'] ?></strong>  <?= $data['email'] ?> </li>
					<!-- Valores que se envían en campos escondidos -->
					<input type="hidden" name="id_interesado-<?= $data['lead-id'] ?>" value="<?= $data['lead-id'] ?>"/>
					<input type="hidden" name="nombre-<?= $data['lead-id'] ?>" value="<?= $data['nombre'] ?>"/>
					<input type="hidden" name="email-<?= $data['lead-id'] ?>" value="<?= $data['email'] ?>"/>
			
				</ul>
			</aside>

			<!-- Tipo de mensaje -->				
			<section class="tipo-mensaje">
					
				<h4 class="titulo">Tipo de correo electrónico a redactar</h4>
				
				<!-- Respuesta personalizada -->
			    <label class="fancy-radio">
			        <input name="tipo" value="Se respondió al interesado" type="radio" class="radio">
			        <span class="fa fa-circle-o  radio-icon"></span>
			        <span class="name">
			        	Respuesta personalizada
		            </span>
			    </label>
			    <!-- Información -->
			    <label class="fancy-radio">
			        <input name="tipo" value="Correo de información enviado" type="radio" class="radio">
			        <span class="fa fa-circle-o radio-icon"></span>
			        <span class="name">
			        	Información
		            </span>
			    </label>
			    <!-- Seguimiento -->
			    <label class="fancy-radio">
			        <input name="tipo" value="Correo de seguimiento enviado" type="radio" class="radio">
			        <span class="fa fa-circle-o  radio-icon"></span>
			        <span class="name">
			        	Seguimiento
		            </span>
			    </label>
			    <!-- Inicio de cursos -->
			    <label class="fancy-radio">
			        <input name="tipo" value="Correo de inicio de cursos enviado" type="radio" class="radio">
			        <span class="fa fa-circle-o radio-icon"></span>
			        <span class="name">
			        	Inicio de cursos
		            </span>
			    </label>
			    <!-- Recordatorio de pago -->
			    <label class="fancy-radio">
			        <input name="tipo" value="Recordatorio de pago enviado" type="radio" class="radio">
			        <span class="fa fa-circle-o  radio-icon"></span>
			        <span class="name">
			        	Recordatorio de pago
		            </span>
			    </label>
			    <!-- Completar inscripción -->
			    <label class="fancy-radio">
			        <input name="tipo" value="Recordatorio de pago enviado" type="radio" class="radio">
			        <span class="fa fa-circle-o radio-icon"></span>
			        <span class="name">
			        	Completar inscripción
		            </span>
			    </label>
			</section>
			
			<!-- Redactar mensaje -->
			<h4 class="titulo">Mensaje personalizado al interesado</h4>	
			<section class="redactar-mensaje">

				<!-- Asunto -->
				<div class="input-group mensaje-asunto">
				    <input name="asunto" type="text" class="form-control"  placeholder="Asunto" value="" required>
				    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				</div>

				<!-- SECCIÓN DEL WYSIWYG -->
				<div id="mensaje-op">
					<!-- Se manda a llamar la API de KCeditor -->
					<script src="lib/ckeditor/ckeditor.js"></script>
					<!-- Se coloca un <textarea> cualquiera y se le asigna un identificador en el nombre -->
					<textarea name="mensaje_op"></textarea>
				
						<!-- Se coloca el textarea por una instancia de KCeditor colocando el identificador en la llamada al API -->
				        <script>CKEDITOR.replace( 'mensaje_op', {
							toolbar : [
								{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Preview', '-', 'Templates' ] },
								{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
							{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
								'/',
								{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
								{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
								{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
								{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ] },
								'/',
								{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
								{ name: 'colors', items: [ 'TextColor' ] },
								{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
								{ name: 'others', items: [ '-' ] },
								{ name: 'about', items: [ 'About' ] },
							],
							templates_files : [ 'lib/ckeditor/plugins/templates/templates/cs-mail-templates.php' ]
							} );
						</script>
				</div><!-- #mensaje-op -->


				

			</section>

			<!-- Firmas -->
			<h4 class="titulo">Firma del mensaje</h4>	
			<section class="firmas-mensaje">
				<!-- Musinetwork -->
				<label class="fancy-radio">
				    <input name="firma" value="Equipo Musinetwork" type="radio" class="radio" >
				    <span class="fa fa-circle-o  radio-icon"></span>
				    <span class="name">
				      	Equipo Musinetwork
			        </span>
				</label>
				<!-- Marichú García Salazar -->
				<label class="fancy-radio">
				    <input name="firma" value="Marichú García Salazar" type="radio" class="radio" >
				    <span class="fa fa-circle-o  radio-icon"></span>
				    <span class="name">
				      	Marichú García Salazar
			        </span>
				</label>
			</section>
				
			<!-- Mensaje personalizado -->
			<h4 class="titulo">Comentarios adicionales</h4>
			<div class="input-group comentarios-adicionales">
				<textarea name="comentarios" class="form-control"  placeholder="Agregar un comentario a ésta interacción" value=""></textarea>
				<span class="input-group-addon"><i class="fa fa-file"></i></span>
			</div>


			<!-- Botón enviar mensaje -->
			<div class="login-btn">  
			    <button type="submit" name="nuevo-mensaje" value="Finalizar" class="btn btn-primary btn-fill">Enviar mensaje por correo</button>
			</div>

		</form>

<?php
require_once("part/footer.php"); ?>
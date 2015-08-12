<?php
/**
 * Plantilla [login]
 **/
require_once("part/header.php"); ?>
		
		<!-- Muestreo de variables [PRUEBAS]
		================================================== --> 
		<!-- <p class="datos"><?php var_dump($data['leads_info']) ?></p>  -->
		<!-- Muestreo de variables [PRUEBAS]
		================================================== --> 

		<!-- Titulo -->
		<h2 class="section-title">Componer mensaje</h2>
		
		<!-- Formulario componer mensaje -->
		<form id="mensaje-form" name="mensaje-form" class="mensaje-form form enviar-mensaje contenedor" method="post" action="<?= cs_url; ?>/componer-mensaje" >
			
			<!-- Lista de destinatarios -->
			<aside id="destinatarios" class="destinatarios">
				<ul>
					<?php foreach ($data['leads_info'] as $leads) { ?>
						<li class="destinatario"><i class="fa fa-check"></i> <strong><?= $leads['nombre'] ?></strong>  <?= $leads['email'] ?></li>		
						<!-- Valores que se envían en campos escondidos -->
						<input type="hidden" name="id_interesado-<?= $leads['ID'] ?>" value="<?= $leads['ID'] ?>"/>
						<input type="hidden" name="nombre-<?= $leads['ID'] ?>" value="<?= $leads['nombre'] ?>"/>
						<input type="hidden" name="email-<?= $leads['ID'] ?>" value="<?= $leads['email'] ?>"/>

					<?php } ?>			
				</ul>
			</aside>

			<!-- Tipo de mensaje -->				
			<section id="plantillasBotones" class="tipo-mensaje">
					
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


			    <?php foreach ($plantillas as $key => $value) : ?>
			    	<div>
			    		<input class="btn" onclick="cambiarContenido(<?php echo $value['ID']; ?>);" plantilla="1" value="<?php echo $value['nombre']; ?>" type="button">
			    		<textarea style="display:none;" id="contenidoPlantilla<?php echo $value['ID']; ?>"><?php echo $value['contenido']; ?></textarea>
			    		<span id="asuntoPlantilla<?php echo $value['ID']; ?>" style="display:none;"><?php echo $value['asunto']; ?></span>
			    	</div>
			    	<br />
				<?php endforeach; ?>

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
					<script src="lib/ckeditor/ckeditor.js">
					
					</script>
					<!-- Se coloca un <textarea> cualquiera y se le asigna un identificador en el nombre -->
					<textarea id="mensaje_op"  name="mensaje_op"></textarea>						
				</div>




				<!-- Comienzan scripts para cambiar contenido de plantillas en el EDITOR -->
				<script>

					function cambiarContenido($pid) {
						// Get the editor instance that you want to interact with.
						var editor = CKEDITOR.instances.mensaje_op;
						var plantillaID = $pid;
						console.log(plantillaID);
						var plantilla = document.getElementById( 'contenidoPlantilla'+$pid ).value;
						var nuevoAsunto = document.getElementById( 'asuntoPlantilla'+$pid ).innerHTML;
						var asunto = document.getElementsByName('asunto')[0];
						asunto.value = nuevoAsunto;

						// Set editor content (replace current content).
						// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-setData
						editor.setData(plantilla);

						//console.log(asunto); // true
						
					}

				</script>

				<script>
					// Attaching event listeners to the global CKEDITOR object.
					// The instanceReady event is fired when an instance of CKEditor has finished its initialization.
					CKEDITOR.on( 'instanceReady', function( ev ) {
						// The editor is ready, so template buttons can be displayed.
						document.getElementById( 'plantillasBotones' ).style.display = 'block';
					});

					// Replace the <textarea id="mensaje_op"> with a CKEditor instance.
					// A reference to the editor object is returned by CKEDITOR.replace() allowing you to work with editor instances.
					var editor = CKEDITOR.replace( 'mensaje_op', {
					} );

				</script>
				<!-- Terminan scripts para cambiar contenido de plantillas en el EDITOR -->






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
				<!-- Usuario en turno -->
				<label class="fancy-radio">
				    <input name="firma" value="<?= $user['user_id']; ?>" type="radio" class="radio" > 
				    <span class="fa fa-circle-o  radio-icon"></span>
				    <span class="name">
				      	<?= $user['nombre']; ?>
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
			<div class="finalizar-btn">  
			    <button type="submit" name="nuevo-mensaje" value="Finalizar" class="btn btn-primary btn-fill">
			    	<i class="fa fa-check"></i> OK
			    </button>
			</div>

		</form>

<?php
require_once("part/footer.php"); ?>
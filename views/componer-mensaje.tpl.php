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
		<form id="mensaje-form" name="mensaje-form" class="mensaje-form form enviar-mensaje contenedor" method="post" action="<?= cs_url; ?>/componer-mensaje" >
			
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
					<textarea id="mensaje_op"  name="mensaje_op"></textarea>						
				</div>

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
			<div class="finalizar-btn">  
			    <button type="submit" name="nuevo-mensaje" value="Finalizar" class="btn btn-primary btn-fill">
			    	<i class="fa fa-check"></i> OK
			    </button>
			</div>

		</form>

<?php
require_once("part/footer.php"); ?>
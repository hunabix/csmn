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
		    		<input class="radio" name="tipo" onclick="cambiarContenido(9999);" value="Respuesta personalizada" type="radio">
		    		<span class="fa fa-circle-o radio-icon"></span>
		    		<span class="name">Respuesta personalizada</span>
		    		<textarea style="display:none;" id="contenidoPlantilla9999"></textarea>
		    		<span id="asuntoPlantilla9999" style="display:none;"></span>
		    	</label>

			    <?php foreach ($plantillas as $key => $value) : ?>
			    	<label class="fancy-radio">
			    		<input class="radio" name="tipo" onclick="cambiarContenido(<?php echo $value['ID']; ?>);" value="<?php echo $value['nombre']; ?>" type="radio">
			    		<span class="fa fa-circle-o radio-icon"></span>
			    		<span class="name"><?php echo $value['nombre']; ?></span>
			    		<textarea style="display:none;" id="contenidoPlantilla<?php echo $value['ID']; ?>"><?php echo $value['contenido']; ?></textarea>
			    		<span id="asuntoPlantilla<?php echo $value['ID']; ?>" style="display:none;"><?php echo $value['asunto']; ?></span>
			    	</label>
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
<?php
/**
 * Plantilla [login]
 **/
require_once("part/header.php"); ?>

		<!-- Titulo -->
		<h2 class="section-title">Componer mensaje</h2>
		
		<!-- Formulario componer mensaje -->
		<form id="mensaje-form" name="mensaje-form" class="mensaje-form form" method="post" action="<?= cs_url; ?>/componer-mensaje" >
			
			<!-- Lista de destinatarios -->
			<div id="destinatarios" class="destinatarios">
				<ul>
					
					<li class="destinatario"><strong>Juan Perez</strong> juan@perez.com</li>
					<!-- Valores que se envían en campos escondidos -->
					<input type="hidden" name="id_interesado<?php echo '10'; ?>" value="10"/>
					<input type="hidden" name="nombre<?php echo 'Juan Perez'; ?>" value="Juan Perez"/>
					<input type="hidden" name="email<?php echo 'juan@perez.com'; ?>" value="juan@perez.com"/>
			
				</ul>
			</div>

			<!-- Mensaje -->
			<div id="mensaje" class="contenedor full">
				<h3 class="titulo">Configuración del mensaje</h3>
				
				<h2 class="titulo">Tipo de correo electrónico a redactar</h2>	
					<div id="tipo-mensaje" class="group">

					</div>

				<h2 class="titulo">Mensaje personalizado al interesado</h2>	
				
				<!-- Asunto -->
				<div class="input-group mensaje-asunto">
				    <input name="usuario" type="text" class="form-control"  placeholder="Usuario" value="" required>
				    <span class="input-group-addon"><i class="fa fa-user"></i></span>
				</div>
				<!-- Mensaje personalizado -->
				<div class="input-group mensaje-contenido">
				    <input name="usuario" type="text" class="form-control"  placeholder="Usuario" value="" required>
				    <span class="input-group-addon"><i class="fa fa-user"></i></span>
				</div>


				<!-- Firmas -->
		        <h2 class="titulo">Firma del mensaje</h2>	
		        <div id="firma-mensaje" class="mensaje-firma">
					<label><input name="firma" value="Equipo Musinetwork" type="radio" checked>
					Equipo Musinetwork</label> 
					
				</div>
				
				<h2 class="titulo"><strong>Comentarios adicionales</strong></h2>
				<div id="mensaje-int">
					<textarea name="comentarios"></textarea>
				</div>	

			</div>

			<!-- Botón enviar mensaje -->
			<div class="login-btn">  
			    <button type="submit" name="nuevo-mensaje" value="Finalizar" class="btn btn-primary btn-fill">Enviar mensaje por correo</button>
			</div>

		</form>

<?php
require_once("part/footer.php"); ?>
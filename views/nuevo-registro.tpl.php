<?php
/**
 * Plantilla [login]
 **/
require_once("part/header.php"); ?>
		
		<!-- Titulo -->
		<h2 class="section-title">Nuevo caso de seguimiento</h2>
		
		<!-- Formulario componer mensaje -->
		<form id="nuevo-registro-form" name="nuevo-registro-form" class="nuevo-registro-form form" method="post" action="<?= cs_url; ?>/nuevo-registro" >
			
			<!-- Datos generales -->
			<section class="panel contenedor">
				
				<h3 class="panel-titulo"><i class="fa fa-user-plus "></i> Datos generales</h3>
				<div class="panel-contenido datos-generales">
					<!-- Nombre -->
					<div class="input-group field nombre">
					    <input name="nombre" type="text" id="nombre-prospecto" class="form-control"  placeholder="Nombre" value="">
					    <span class="input-group-addon"><i class="fa fa-user"></i></span>
					</div>
					<!-- Apellidos -->
					<div class="input-group field apellidos">
					    <input name="apellidos" type="text" id="apellidos-prospecto" class="form-control"  placeholder="Apellido(s)" value="">
					    <span class="input-group-addon"><i class="fa"></i></span>
					</div>
					<!-- Correo -->
					<div class="input-group field correo">
					    <input name="correo" type="email" id="correo-prospecto"class="form-control"  placeholder="Correo electrónico" value="">
					    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					</div>
					<!-- Teléfono -->
					<div class="input-group field telefono">
					    <input name="telefono" type="text" id="telefono-prospecto"class="form-control"  placeholder="Teléfono" value="">
					    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
					</div>
					<!-- País -->
					<div class="input-group field pais">
					    <input name="pais" type="text" id="pais-prospecto" class="form-control"  placeholder="País" value="">
					    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
					</div>
					<!-- Ciudad -->
					<div class="input-group field ciudad">
					    <input name="ciudad" type="text" id="ciudad-prospecto" class="form-control"  placeholder="Ciudad" value="">
					    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
					</div>
					<!-- Instrumento -->
					<div class="input-group field instrumento">
					    <input name="instrumento" type="text" id="instrumento-prospecto" class="form-control"  placeholder="Instrumento" value="">
					    <span class="input-group-addon"><i class="fa fa-music"></i></span>
					</div>
				</div>

			</section>
			
			<!-- Información adicional -->
			<section class="panel contenedor info-adicional">

				<h3 class="panel-titulo"><i class="fa fa-info-circle "></i> Información adicional</h3>
				<div class="panel-contenido">
				
					<h4>Medio por el que se enteró de Musinetwork:</h4>	
					<label class="fancy-radio">
					    <input name="medio_contacto" value="Redes Sociales" type="radio" class="radio">
					    <span class="fa fa-circle-o  radio-icon"></span>
					    <span class="name">Redes Sociales</span>
					</label>
					<label class="fancy-radio">
					    <input name="medio_contacto" value="Navegando la Web" type="radio" class="radio">
					    <span class="fa fa-circle-o  radio-icon"></span>
					    <span class="name">Navegando la Web</span>
					</label>
					<label class="fancy-radio">
					    <input name="medio_contacto" value="Correo Electrónico" type="radio" class="radio">
					    <span class="fa fa-circle-o  radio-icon"></span>
					    <span class="name">Correo Electrónico</span>
					</label>
					<label class="fancy-radio" >
					    <input nname="medio_contacto" value="Recomendación de un amigo" type="radio" class="radio">
					    <span class="fa fa-circle-o  radio-icon"></span>
					    <span class="name"> Recomendación de un amigo</span>
					</label>
					
					<h4 class="sub-titulo">Solicitó informes sobre:</h4>
					<label class="fancy-check">
					    <input name="info_sobre1" value="Cursos" type="checkbox" class="check">
					    <span class="fa fa-square-o check-icon"></span>
					    <span class="name">Cursos</span>
					</label>					   
					<div class="caja-opciones">  
						<label class="fancy-check">
						    <input name="info_cursos1" value="Curso de Preparación" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">1) Curso de Preparación</span>
						</label>
						<label class="fancy-check">
						    <input name="info_cursos2" value="Teoría y Armonía Popular Contemporánea" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">2) Teoría y Armonía Popular Contemporánea</span>
						</label>
						<label class="fancy-check">
						    <input name="info_cursos2" value="Teoría y Armonía Popular Contemporánea" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">2) Teoría y Armonía Popular Contemporánea</span>
						</label>
						<label class="fancy-check">
						    <input name="info_cursos3" value="Arreglo Contemporáneo" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">3) Arreglo Contemporáneo</span>
						</label>
						<label class="fancy-check">
						    <input name="info_cursos4" value="Estudios en Jazz" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">4) Estudios en Jazz</span>
						</label>
						<label class="fancy-check">
						    <input name="info_cursos4" value="Estudios en Jazz" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">5) Historia</span>
						</label>
						<label class="fancy-check">
						    <input name="info_cursos6" value="Ejecución Instrumental" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">6) Ejecución Instrumental</span>
						</label>
					</div> 
						   
					<label class="fancy-check">
					    <input name="info_sobre2" value="Certificaciones" type="checkbox" class="check">
					    <span class="fa fa-square-o check-icon"></span>
					    <span class="name">Certificaciones</span>
					</label>

					<div class="caja-opciones">
						<label class="fancy-check">
						    <input name="info_cert1" value="Contemporary Musician Certificate" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">1) Contemporary Musician Certificate</span>
						</label>
						<label class="fancy-check">
						    <input name="info_cert2" value="Jazz Studies Certificate" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">2) Jazz Studies Certificate</span>
						</label>
						<label class="fancy-check">
						    <input name="info_cert3" value="Validez" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">3) Validez</span>
						</label>
						<label class="fancy-check">
						    <input name="info_cert4" value="Financiamiento" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">4) Financiamiento</span>
						</label>
						<label class="fancy-check">
						    <input name="info_cert5" value="Duración" type="checkbox" class="check">
						    <span class="fa fa-square-o check-icon"></span>
						    <span class="name">5) Duración</span>
						</label>    
					</div> 
					<div class="info-sobre"> 
						<label class="fancy-check">
							<input name="info_sobre3" value="Metodología" type="checkbox" class="check">
							<span class="fa fa-square-o check-icon"></span>
							<span class="name">Metodología</span>
						</label>    
						
						<label class="fancy-check">
							<input name="info_sobre4" value="Proceso de Inscripción" type="checkbox" class="check">
							<span class="fa fa-square-o check-icon"></span>
							<span class="name">Proceso de Inscripción</span>
						</label>  
						
						<label class="fancy-check">
							<input name="info_sobre5" value="Costos y Formas de Pago" type="checkbox" class="check">
							<span class="fa fa-square-o check-icon"></span>
							<span class="name">Costos y Formas de Pago</span>
						</label>
						
						<label class="fancy-check">
							<input name="info_sobre6" value="Exámenes de Ingreso" type="checkbox" class="check">
							<span class="fa fa-square-o check-icon"></span>
							<span class="name">Exámenes de Ingreso</span>
						</label>
											
						<label class="fancy-check">
							<input name="info_sobre7" value="Prestigio y Validez" type="checkbox" class="check">
							<span class="fa fa-square-o check-icon"></span>
							<span class="name">Prestigio y Validez</span>
						</label>
					</div>
				</div>

			</section>

			<!-- Mensaje proveniente del usuario -->
			<section class="panel contenedor">

				<h3 class="panel-titulo"><i class="fa fa-comment"></i> Mensaje proveniente del interesado</h3>
				<div class="panel-contenido">
					<div class="input-group comentarios-adicionales">
						<textarea name="mensaje_int" class="form-control"  placeholder="Pega aquí el mensaje que ha enviado el interesado para agregarlo a su historial" value=""></textarea>
						<span class="input-group-addon"><i class="fa fa-file"></i></span>
					</div>
				</div>

			</section>

			<section class="enviar-mensaje panel contenedor">

				<h3 class="panel-titulo"><i class="fa fa-send"></i> Mensaje de respuesta al interesado</h3>
				
				<div class="panel-contenido">
					<!-- Tipo de mensaje -->				
					<section class="tipo-mensaje">

						<label class="fancy-check">
							<input name="responder_ahora" value="si"  type="checkbox" class="check">
							<span class="fa fa-square-o check-icon"></span>
							<span class="name">Responder ahora mismo</span>
						</label>

						<h4 class="titulo">Tipo de correo electrónico a redactar</h4>
						


					</section>
					
					<!-- Redactar mensaje -->
					<h4 class="titulo">Mensaje personalizado al interesado</h4>	
					<section id="plantillasBotones" class="redactar-mensaje">

						<!-- Asunto -->
						<div class="input-group mensaje-asunto">
						    <input name="asunto" type="text" class="form-control"  placeholder="Asunto" value="">
						    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						</div>

						<!-- Respuesta personalizada -->
				    	<label class="fancy-radio">
				    		<input class="radio" name="tipo" onclick="cambiarContenido(9999);" value="Respuesta personalizada" type="radio">
				    		<span class="fa fa-circle-o radio-icon"></span>
				    		<span class="name">Respuesta personalizada</span>
				    		<textarea style="display:none;" id="contenidoPlantilla9999"></textarea>
				    		<span id="asuntoPlantilla9999" style="display:none;"></span>
				    	</label>

						<!-- Respuesta personalizada -->
					    <?php foreach ($plantillas as $key => $value) : ?>
					    	<label class="fancy-radio">
					    		<input class="radio" name="tipo" onclick="cambiarContenido(<?php echo $value['ID']; ?>);" value="<?php echo $value['nombre']; ?>" type="radio">
					    		<span class="fa fa-circle-o radio-icon"></span>
					    		<span class="name"><?php echo $value['nombre']; ?></span>
					    		<textarea style="display:none;" id="contenidoPlantilla<?php echo $value['ID']; ?>"><?php echo $value['contenido']; ?></textarea>
					    		<span id="asuntoPlantilla<?php echo $value['ID']; ?>" style="display:none;"><?php echo $value['asunto']; ?></span>
					    	</label>
						<?php endforeach; ?>

						<!-- SECCIÓN DEL WYSIWYG -->
						<div id="mensaje-op">
							<!-- Se manda a llamar la API de KCeditor -->
							<script src="lib/ckeditor/ckeditor.js"></script>
							<!-- Se usa un <textarea> y se le asigna un identificador en el nombre, el script está en main.js -->
							<textarea id="mensaje_op" name="mensaje_op"></textarea>							
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
				</div>
				
			</section>

			<!-- Botón enviar mensaje -->
			<div class="finalizar-btn">  
			    <button type="submit" name="nuevo-mensaje" value="Finalizar" class="btn btn-primary btn-fill">
			    	<i class="fa fa-check"></i> Registrar nuevo caso de seguimiento
			    </button>
			</div>

		</form>

<?php
require_once("part/footer.php"); ?>
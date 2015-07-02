<?php
/**
 * Plantilla [login]
 **/
require_once("part/header.php"); ?>
	
		<!-- Titulo -->
		<h2 class="section-title">Configuración</h2>

		<!-- Muestreo de variables [PRUEBAS]
		================================================== --> 
		<?php// var_dump($data['configuracion']);  ?>
		<!-- Muestreo de variables [PRUEBAS]
		================================================== --> 
		
		<!-- Formulario componer mensaje -->
		<form id="nuevo-registro-form" name="configuracion-form" class="configuracion-form form" method="post" action="<?= cs_url; ?>/configuracion" >
			
			<!-- Datos generales -->
			<section class="panel contenedor">
				
				<h3 class="panel-titulo"><i class="fa fa-calendar"></i> Fechas</h3>
				<div class="panel-contenido campos-fechas">
					
					<div class="field">
						<label for="inicio-ins">Inicio de inscripciones</label>
						<div class="input-group">
						   <input name="inicio-ins" type="text" id="inicio-ins" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['inicio_ins'] ?>">
						   <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
					<div class="field">
						<label for="ciclo-esc">Cierre de inscripciones</label>
						<div class="input-group">
							<input name="fin-cur" type="text" id="fin-cur" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['fin_ins']; ?>">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
					<div class="field">
						<label for="inicio-cur">Inicio de cursos</label>
						<div class="input-group">
							<input name="inicio-cur" type="text" id="inicio-cur" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['inicio_cur']; ?>">
						    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</div>
					</div>					
					<div class="field">
						<label for="ciclo-esc">Ciclo Escolar</label>
						<div class="input-group">
							<select id="ciclo-esc-conf" name="ciclo-esc" class="form-control"  placeholder="dd/mm/aaaa" seleccionado="<?= $data['configuracion']['ciclo_esc']; ?>">
								<option id="ciclo-conf-op1" value="ENERO - MARZO">ENERO - MARZO</option>
								<option id="ciclo-conf-op2" value="ABRIL - JUNIO">ABRIL - JUNIO</option>
								<option id="ciclo-conf-op3" value="JULIO - SEPTIEMBRE">JULIO - SEPTIEMBRE</option>
								<option id="ciclo-conf-op4" value="OCTUBRE - DICIEMBRE">OCTUBRE - DICIEMBRE</option>
							</select>
						    <span class="input-group-addon"><i class="fa fa-history"></i></span>
						</div>
					</div>

				</div>

			</section>
			
			
			<!-- Botón enviar mensaje -->
			<div class="finalizar-btn">  
			    <button type="submit" name="nuevo-mensaje" value="Finalizar" class="btn btn-primary btn-fill">
			    	<i class="fa fa-check"></i> Guardar cambios
			    </button>
			</div>

		</form>

<?php
require_once("part/footer.php"); ?>
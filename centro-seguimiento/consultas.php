<?php require_once("includes/header.php");  $id_interesado = 1;
// -------------------------------------------------------------------------//
// ---------  SI SE SOLICITA LA CONSULTA DE  -----------------------//
// -------------------------------------------------------------------------//
if (isset($_POST['inscritos-btn'])) { // Si el formulario ha sido enviado pidiendo consulta de inscritos 
	$casos_set =obten_casos_inactivos(); //obtengo array con los casos de interesados inscritos ?>
	<div id="content">
	<h1 class="titulo">Consulta: Lista de interesados que se inscribieron a Musinetwork</h1>  
		<div id="reporte" class="contenedor">
			<!-- Titulos del reporte-->
			<h3 class="titulo titulos-fila">
				<span class="rp-nombre">Nombre del interesado</span>
				<span class="rp-email">Email</span>
				<span class="rp-operaciones">Historial</span>
			</h3>
			<?php while ($caso = mysql_fetch_array($casos_set)) {				
				$interacciones = obten_utima_interaccion($caso['ID']);
				$estatus = mysql_fetch_array($interacciones); 	
				if ($tipo = utf8_encode($estatus['tipo']) == 'Se ha inscrito en Musinetwork') { ?>
					<div class="rp-fila group">
						<!-- nombre del interesado -->	
						<form method="post" id="casos-seguimiento-ind">
							<span class="caso-nombre">								
								<button type="submit"  formaction="historial.php" value="<?php echo $caso['ID'];?>" name="casohist-btn" >
									<?php echo utf8_encode($caso['nombre']); ?>	
								</button>
							</span>
							<!-- Operaciones -->
							<span class="rep-operaciones">
								<!-- Enviar a lista de casos activos -->
								<button type="submit" name="accion-ind-btn" formaction="reactivar.php" value="<?php echo $caso['ID']; ?>" class="accion-ind-btn" onclick="return window.confirm('Advertencia: ¿Estas seguro de querer reactivar elseguimiento a éste caso?');">
									<span class="accion-ind-ico"><img src="imagenes/shift-16.png" /></span>Mover a activos
								</button>
								<!-- Mover caso a inscritos -->
								<button type="submit" name="accion-ind-btn" formaction="nueva-interaccion.php" value="<?php echo $caso['ID']; ?>" class="accion-ind-btn">
									<span class="accion-ind-ico"><img src="imagenes/file.png" /></span>Otras acciones
								</button>
								<!-- Editar datos -->
								<button type="submit" name="id_caso" formaction="editar-interesado.php" value="<?php echo $caso['ID']; ?>" class="accion-ind-btn">
									<span class="accion-ind-ico"><img src="imagenes/edit-6-16.png" /></span>Editar información
								</button>
								<!-- Borrar permanentemente -->
								<button type="submit" name="accion-ind-btn" formaction="borrar-caso.php" value="<?php echo $caso['ID']; ?>" class="accion-ind-btn" onclick="return window.confirm('Advertencia: ¿Estas seguro de querer borrar éste caso de manera permanente?');">
									<span class="accion-ind-ico"><img src="imagenes/x-mark-16.png" /></span>Eliminar
								</button>
							</span>	
						</form>
					</div>
				<?php }
			} ?>
		</div><!-- fin #reporte -->
	</div><!-- fin #content-->  
	
<?php } else if (isset($_POST['lista-btn'])) { // Si el formulario ha sido enviado pidiendo consulta de lista general 
	$casos_set =obten_casos_inactivos(); //obtengo array con los casos de interesados inscritos ?>
	<div id="content">
		<h1 class="titulo">Consulta: Lista de interesados que se enviaron a lista general</h1>  
		<div id="reporte" class="contenedor">
			<!-- Titulos del reporte-->
			<h3 class="titulo titulos-fila">
				<span class="rp-nombre">Nombre del interesado</span>
				<span class="rp-operaciones">Operaciones</span>
			</h3>
			<?php while ($caso = mysql_fetch_array($casos_set)) {				
				$interacciones = obten_utima_interaccion($caso['ID']);
				$estatus = mysql_fetch_array($interacciones); 	
				if ($tipo = utf8_encode($estatus['tipo']) == 'Se ha agregado a la lista general') { ?>
					<div class="rp-fila group">
						<!-- nombre del interesado -->	
						<form method="post" id="casos-seguimiento-ind">
							<span class="caso-nombre">								
								<button type="submit"  formaction="historial.php" value="<?php echo $caso['ID'];?>" name="casohist-btn" >
									<?php echo utf8_encode($caso['nombre']); ?>	
								</button>
							</span>
							<!-- Operaciones -->
							<span class="rep-operaciones">
								<!-- Enviar a lista de casos activos -->
								<button type="submit" name="accion-ind-btn" formaction="reactivar.php" value="<?php echo $caso['ID']; ?>" class="accion-ind-btn" onclick="return window.confirm('Advertencia: ¿Estas seguro de querer reactivar elseguimiento a éste caso?');">
									<span class="accion-ind-ico"><img src="imagenes/shift-16.png" /></span>Mover a activos
								</button>
								<!-- Mover caso a inscritos -->
								<button type="submit" name="accion-ind-btn" formaction="nueva-interaccion.php" value="<?php echo $caso['ID']; ?>" class="accion-ind-btn">
									<span class="accion-ind-ico"><img src="imagenes/file.png" /></span>Otras acciones
								</button>
								<!-- Editar datos -->
								<button type="submit" name="id_caso" formaction="editar-interesado.php" value="<?php echo $caso['ID']; ?>" class="accion-ind-btn">
									<span class="accion-ind-ico"><img src="imagenes/edit-6-16.png" /></span>Editar información
								</button>
								<!-- Borrar permanentemente -->
								<button type="submit" name="accion-ind-btn" formaction="borrar-caso.php" value="<?php echo $caso['ID']; ?>" class="accion-ind-btn" onclick="return window.confirm('Advertencia: ¿Estas seguro de querer borrar éste caso de manera permanente?');">
									<span class="accion-ind-ico"><img src="imagenes/x-mark-16.png" /></span>Eliminar
								</button>
							</span>	
						</form>
					</div>
				<?php }
			} ?>
		</div><!-- fin #reporte -->
	</div><!-- fin #content-->  

<?php } else { // Si no se ha registrado ninguna solicitud de consulta ?>
<div id="content">
	<h1 class="titulo">Consultas</h1>  
	<div id="consultas" class="contenedor">
		<form method="post" action="consultas.php" id="consultas-form">
			<input name="inscritos-btn" type="submit" id="submit" value="Consultar lista de interesados que se inscribieron a Musinetwork" class="btn"/>
			<input name="lista-btn" type="submit" id="submit" value="Consultar lista de interesados que se enviaron a lista general" class="btn"/>
		</form>
		
	</div><!-- fin #casos -->
</div><!-- fin #content-->  
<?php  } 
require_once("includes/footer.php"); ?>
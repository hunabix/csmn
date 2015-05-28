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
					<div class="rp-fila">
						<!-- nombre del interesado -->	
						<span class="rep-nombre">
							<?php echo $caso['nombre']; ?>				
						</span>
						<!-- email del interesado -->
						<span class="rep-email">
							<?php echo $caso['email']; ?>	
						</span>
						<!-- Operaciones -->
						<span class="rep-operaciones">
							<form method="post" action="historial.php">
							<button type="submit"  value="<?php echo $caso['ID'];?>" name="casohist-btn" >
								<?php echo 'Ver historial'; ?>
							</button>		
							</form>
						</span>	
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
				<span class="rp-email">Email</span>
				<span class="rp-operaciones">Historial</span>
			</h3>
			<?php while ($caso = mysql_fetch_array($casos_set)) {				
				$interacciones = obten_utima_interaccion($caso['ID']);
				$estatus = mysql_fetch_array($interacciones); 	
				if ($tipo = utf8_encode($estatus['tipo']) == 'Se ha agregado a la lista general') { ?>
					<div class="rp-fila">
						<!-- nombre del interesado -->	
						<span class="rep-nombre">
							<?php echo $caso['nombre']; ?>				
						</span>
						<!-- email del interesado -->
						<span class="rep-email">
							<?php echo $caso['email']; ?>	
						</span>
						<!-- Operaciones -->
						<span class="rep-operaciones">
							<form method="post" action="historial.php">
							<button type="submit"  value="<?php echo $caso['ID'];?>" name="casohist-btn" >
								<?php echo 'Ver historial'; ?>
							</button>		
							</form>
						</span>	
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
<?php require_once("includes/header.php"); ?>
<?php //confirm_logged_in(); //revisa si el operador ha ingresado ?>
<?php 
if (isset($_POST['casohist-btn'])) { // el formulario ha sido enviado
	$id_interesado = $_POST['casohist-btn'];
	$casos_set = obten_caso_x_id($id_interesado);
	$caso = mysql_fetch_array($casos_set);
	$nombre = utf8_encode($caso['nombre']);	
	$email = utf8_encode($caso['email']);
	$tel = utf8_encode($caso['telefono']);
	$pais = utf8_encode($caso['pais']);
	$ciudad = utf8_encode($caso['ciudad']);
	$instrumento = utf8_encode($caso['instrumento']);
}
?>
<div id="content">
	<h1 class="titulo">Historial de interacciones</h1>  
	<div id="destinatarios" class="group">
			<span class="nombre-hist group">
				<strong><?php echo $nombre; ?></strong>
				<form action="editar-interesado" method="post">
				<button type="submit" name="id_caso" value="<?php echo $id_interesado; ?>" class="editar-interesado">					
						Editar Información del interesado
				</button>
				</form>
			</span>
			<ul>
				<li><span class="hist-ind-ico"><img src="imagenes/email-16.png" /></span>
				<?php echo $email; ?></li>	
				
				<li><span class="hist-ind-ico"><img src="imagenes/phone-16.png" /></span>
				<?php echo $tel; ?></li>	
				
				<li><span class="hist-ind-ico"><img src="imagenes/arrow.png" /></span>
				<?php echo $pais . ', ' . $ciudad; ?></li>					
				
				<li><span class="hist-ind-ico"><img src="imagenes/music.png" /></span>
				<?php echo $instrumento; ?></li>					
				
			</ul>
	</div> <!-- fin #destinatarios-->
	
	<div id="historial" class="contenedor full">
		<h3 class="titulo">Interacciones pasadas</h3>
		<div id="accordion">
			<?php //obtengo datos delas interacciones 
			$interaccion_set = obten_interacciones($id_interesado); 
			while ($interaccion = mysql_fetch_array($interaccion_set)) {	
				$tipo = utf8_encode($interaccion['tipo']);
				$fecha = utf8_encode($interaccion['fecha']);
				$mes = substr($fecha, 5, 2);
				$dia = substr($fecha, 8, 2);
				$ano = substr($fecha, 0, 4);
				$hora = substr($fecha, 11, 8);
				$mes = mes_en_texto_completo($mes);
				$fecha = $dia. '/' . $mes. '/' . $ano . ' - ' . $hora . ' ';
				$mensaje_int = utf8_encode($interaccion['mensaje_int']);
				$mensaje_op = utf8_encode($interaccion['mensaje_op']);
				$observaciones = utf8_encode($interaccion['observaciones']);
				$alerta = utf8_encode($interaccion['alerta']);
				?>
		
				<h3><span class="fecha-int"><?php echo $fecha ?></span><?php echo $tipo; ?></h3>
				<div>
					<?php if($mensaje_int != '') { ?>
						<h4>Mensaje del interesado: </h4>
						<div class="mensaje-hist"><?php echo $mensaje_int ?></div>
					<?php } ?>
					<?php if($mensaje_op != '') { ?>
						<h4>Mensaje del operador Musinetwork: </h4>
						<div class="mensaje-hist"><?php echo $mensaje_op ?></div>
					<?php } ?>
					<?php if($observaciones != '') { ?>
						<div class="obs-hist"><strong>Observaciones:</strong> <?php echo $observaciones ?></div>
					<?php } ?>
					<?php if($alerta != '') { ?>
						<div lass="aviso-hist"><strong>Aviso:</strong> <?php echo $alerta ?></div>
					<?php } ?>
				</div>
				
			<?php }	?>
		</div><!-- fin #acordion -->
	</div> <!-- fin #historial-->
	
</div><!-- fin #content-->  
<script>
  $(function() {
    $( "#accordion" ).accordion({
      heightStyle: "content"
    });
  });
  </script>
<?php  require_once("includes/footer.php"); ?>
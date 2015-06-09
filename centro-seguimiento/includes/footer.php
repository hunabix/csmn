</div> <!-- fin #wrapper -->
<footer>
	<div id="footer-content">
	<?php if (logged_in()) {?>
		<div id="sesion-usuario">
			<span>Hola, <strong><?php $nombre_operador = $_SESSION['nombre'];  echo $nombre_operador; ?></strong> | </span>
			<span class="sesion-cerrar"><a href="logout.php"> Cerrar sesion</a></span>
		</div><!-- fin #sesion-usuario -->
	<?php } ?>	
	</div><!-- fin #footer-content -->
</footer>


</body>
</html>
<?php
	// 5. Cierro la conexion a la BD
	if(isset($connection)) {
		mysql_close($connection);
	}
?>
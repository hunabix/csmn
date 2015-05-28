<?php require_once("includes/header.php"); ?>
<?php //confirm_logged_in(); //revisa si el operador ha ingresado ?>
<?php 

	// 1. encuentro la sesion
	session_start();
	
	//2 selecciono todas las variables de sesion
	$_SESSION = array();
	
	// 3 destruyo la session de cookie
	if (isset($_COOKIE[session_name()])) {
		//setcookie(session_name(), '', time()-42000, '/');
	}
	
	//4 destruyo la sesion
	session_destroy(); ?>
	
	<script type="text/javascript">	
	//setTimeout(redirige(), '',50000);	
		window.location="index.php";			
	</script>
	
	

<?php  require_once("includes/footer.php"); ?>
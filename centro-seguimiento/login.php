<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es-ES" xml:lang="es-ES" xmlns="http://www.w3.org/1999/xhtml">

<head>            
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="all" href="style.css"> 
	<title>Centro de Seguimiento - Musinetwork</title>
	<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
	<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
</head>
<body>

<header id="cabecera">	
	<div id="header-content">
		<div id="logo"><a href="index.php"><img src="imagenes/logo.png" height="75"></a></div><!-- fin #logo -->
		<h1 class="titulo">Centro de Seguimiento a Interesados en Musinetwork</h1>
		<nav id="navigation" role="navigation" class="group">
			<ul id="menu">			
				<li><a href="index.php">Inicio</a></li>
				<li><a href="nuevo-registro.php">Nuevo registro</a></li>
				<li><a class="opcion-final" href="configuracion.php">Configuración</a></li>
			</ul>
		</nav>
	</div>		
</header>
		
<div id="wrapper">
<?php //PUEDES BORRAR TODO EL CONTENIDO DE ARRIBA DE ESTA LÍNEA Y DESCOMENTA LA LÍNEA DE ABAJO PARA DEJAR ESTE ARCHIVO COMO ESTABA ?>
		
<?php //require_once("includes/header.php"); ?>
<?php 
		
		//COMIENZA A PROCESAR EL DOCUMENTO
		if (isset($_POST['ingreso'])) { // el formulario ha sido enviado
		
			// recibo la información		
			
			$usuario = $_POST['usuario'];
			$clave = $_POST['clave'];
			
			//reviso en la base de datos si el usuario existe
			$consulta =  "SELECT *
							FROM operador_mn
							WHERE usuario = '$usuario'
							AND clave = '$clave'
							LIMIT 1";
			$operador_set = mysql_query($consulta, $connection);
			confirm_query($operador_set);
			
			if (mysql_num_rows($operador_set) ==1) {
				// autentificado!!!!!!!!!!
				$operador = mysql_fetch_array($operador_set);
				$_SESSION['user_id'] = $operador['ID'];
				$_SESSION['username'] = $operador['usuario'];
				$_SESSION['nombre'] = $operador['nombre']; 
				//redirijo por javascript a index ?>				
				<script type="text/javascript">			
					window.location="index.php";			
				</script>
			<?php }
			else {
				$mensaje = "Nombre de usuario o contraseña incorrecto";	
			}
			
		} else { // el formulario no ha sido enviado
			$username = "";
			$password = "";
			$mensaje = '';
		}
			

?>

<h1 class="titulo">Ingreso al Centro de Seguimiento Musinetwork</h1>     
                 
<div id="login" class="contenedor">
	<h3 class="titulo">Introduce los datos de acceso</h3>
	<form method="post" action="login.php">
		<input type="text" name="usuario" placeholder="Usuario" required/> 					 
		<input type="password" name="clave" placeholder="Contraseña" required/>
		<h3 class="error"><?php echo $mensaje; ?></h3>
		<input name="ingreso" type="submit" id="submit" value="Entrar" class="btn"/>
	</form>
</div>    	

<?php  require_once("includes/footer.php"); ?>
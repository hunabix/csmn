<?php // archibos a resubir header.php, style.css, consultas.php, componer-mensaje.php, functions.php
header('Content-Type: text/html; charset=utf-8');
//Este header se carga al iniciar sesión, de lo contrario redirige a login.php
require_once("includes/session.php"); ?>
<?php confirm_logged_in(); //revisa si el operador ha ingresado ?>
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
				<li><a href="http://localhost/dev.musinetwork.com/centro-seguimiento">Inicio</a></li>
				<li><a href="nuevo-registro">Nuevo registro</a></li>
				<li><a href="consultas">Consultas</a></li>
				<li><a class="opcion-final" href="configuracion">Configuración</a></li>
			</ul>
		</nav>
	</div>		
</header>
		
<div id="wrapper">
		


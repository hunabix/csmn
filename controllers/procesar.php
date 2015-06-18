<?php
/*
* Controlador que recibe peticiones
*/

// Carga de archivos base
require_once('../config.php');
require_once('../includes.php');

confirm_logged_in(); //revisa si el operador ha ingresado

if (isset($_POST['formulario'])) {

	$nombreFormulario = $_POST['formulario'];
	
	//echo '<h2>Llego por el formulario '. $nombreFormulario . '</h2>';

	// Impresión de parametros para testing
	//echo print_array($_POST);
	echo json_encode($_POST);
	
}
//view('home', compact('casos', 'nombre_vista', 'saludo'));


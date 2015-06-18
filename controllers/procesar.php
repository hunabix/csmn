<?php
/*
* Controlador que recibe peticiones
*/

confirm_logged_in(); //revisa si el operador ha ingresado

if (isset($_POST['formulario'])) {

	$nombreFormulario = $_POST['formulario'];
	
	//echo '<h2>Llego por el formulario '. $nombreFormulario . '</h2>';

	// Impresión de parametros para testing
	echo json_encode($_POST);
	
}
//view('home', compact('casos', 'nombre_vista', 'saludo'));


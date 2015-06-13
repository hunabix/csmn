<?php 
if (isset($_POST['form-name'])) {

	$nombreFormulario = $_POST['form-name'];
	
	echo '<h2>Llego por el formulario '. $nombreFormulario . '</h2>';

	// Impresión de parametros para testing
	var_dump($_POST);


} else {
	echo '<h2>Llego por otro lado</h2>';
}





<?php
/*
* Controlador del Home / Página principal
*/

require_once("includes/session.php"); ?>
<?php confirm_logged_in(); //revisa si el operador ha ingresado ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php");

/*require_once("includes/header.php"); ?>

<?php*/ //confirm_logged_in(); //revisa si el operador ha ingresado 



// Si el formulario ha sido enviado usando el datepicker colectivo

if (isset($_POST['reprogramar'])) { 



	$num_casos = $_POST['num_casos'];

	$casos = array();

	

	for ($i = 1; $i <= $num_casos; $i++) {

		if (isset($_POST['caso' . $i])) { $casos[$i] = $_POST['caso' . $i]; }

	}



	$reprogramar = $_POST['reprogramar'];

	$ano = substr($reprogramar, 6, 4);

	$dia = substr($reprogramar, 3, 2);

	$mes = substr($reprogramar, 0, 2);

	$recordatorio = $ano . '-' . $mes . '-' . $dia;



	//se actualizan los campos 

	for ($i = 1; $i <= $num_casos; $i++) { 

		if (isset($casos[$i])) { actualiza_recordatorio_manual($recordatorio, $casos[$i]);			

		} 

	}

}



// Si el formulario ha sido enviado usando el datepicker individual

if (isset($_POST['casos_rp'])) { // el formulario ha sido enviado

	// obtengo el numero de casos

	$num_casos = $_POST['casos_rp'];

	$casos = array();

	// recorro los casos para saber cual de ellos tiene una fecha a reprogramar 

	for ($i = 1; $i <= $num_casos; $i++) { 

		if ($_POST['reprogramar'. $i] != '') {

			// asigno los valores a procesar del caso que si tuvo una fecha para procesar

			$reprogramar = $_POST['reprogramar'. $i];

			$casos[1] = $_POST['id_rp'. $i];

		}

	} 

	// se ordena la fecha

	$ano = substr($reprogramar, 6, 4);

	$dia = substr($reprogramar, 3, 2);

	$mes = substr($reprogramar, 0, 2);

	$recordatorio = $ano . '-' . $mes . '-' . $dia;	



	//se actualizan los campos 

	for ($i = 1; $i <= $num_casos; $i++) { 

		if (isset($casos[$i])) { actualiza_recordatorio_manual($recordatorio, $casos[$i]); } 

	} 

	

}
$casos_set = obten_casos();

while ($caso = mysql_fetch_array($casos_set)) {

	echo $id_interesado = utf8_encode($caso["ID"]);

}

//$casos = mysql_fetch_array($casos_set);

//echo '<pre style="display:block;">'; print_r($casos); echo '</pre>'; // PRINT_R
	
//Llamando una vista
view('home', compact('titulo', 'nombre_vista', 'saludo'));


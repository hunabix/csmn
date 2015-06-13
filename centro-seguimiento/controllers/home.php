<?php
/*
* Controlador del Home / Página principal
*/


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

		
//Llamando una vista
view('home', compact('titulo', 'nombre_vista', 'saludo'));


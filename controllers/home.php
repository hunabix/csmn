<?php
/*
* Controlador del Home / Página principal
*/

confirm_logged_in(); //revisa si el operador ha ingresado

// Getting leads
$casos = array();
$con = db_con();
$query = $con->prepare('SELECT * FROM interesado_cs WHERE activo = :status ORDER BY recordatorio ASC');
$query->execute(array('status' => 'Si'));
$casos = $query->fetchAll();
$query->closeCursor();

// Adding extra info to leads. Mejora: Guardar el ID de la última interacción en la tabla interesado.
$query = $con->prepare('SELECT * FROM interaccion_cs WHERE id_interesado = :id_interesado ORDER BY fecha DESC LIMIT 1');
foreach ($casos as $caso => $value) {

	$query->execute(array('id_interesado' => $value['ID']));
	$last_interaction = $query->fetch();
	$query->closeCursor(); // Free memory used in this query

	// Adding las interaction info
	$value['ultima_interaccion'] =  $last_interaction;
	$value['fecha_estatus'] =  fecha_hora_en_array($last_interaction['fecha']);;

	// Adding reminder date
	$value['fecha_recordatorio'] =  fecha_en_array($value['recordatorio']);
	
	// Adding suggestion for reminder
	$value['recordatorio_sugerencia'] =  obten_sugerencia(obten_temporada(), $last_interaction['tipo']);
	
	// Saving info
	$casos[$caso] = $value;
}


//print_array($casos);
	
//Llamando una vista
view('home', compact('casos', 'nombre_vista', 'saludo'));


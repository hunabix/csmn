<?php
/*
* Controlador del Home / Página principal
*/

confirm_logged_in(); //revisa si el operador ha ingresado

// Getting leads
$casos = array();
$con = db_con();
$query = $con->prepare('SELECT * FROM interesado_cs WHERE activo = :status ORDER BY recordatorio ASC LIMIT 30');
//$query = $con->prepare('SELECT * FROM interesado_cs WHERE activo = :status ORDER BY FIELD(name = B, 'A', 'D', 'E', 'C')');
$query->execute(array('status' => 'Si'));
$casos = $query->fetchAll();
$query->closeCursor();

// Adding extra info to leads. Mejora: Delete flagging script and create inner join query.
$query = $con->prepare('SELECT * FROM interaccion_cs WHERE id_interesado = :id_interesado AND ultima = :ultima');
foreach ($casos as $caso => $value) {

	//Get last interaction by user id marked as ultima 
	$query->execute(array(
				'id_interesado' => $value['ID'],
				'ultima' => TRUE,
			));
	$last_interaction = $query->fetch();

	//Get last interaction by user id ordering by date and gating last
	if (!$last_interaction) {
		$query = $con->prepare('SELECT * FROM interaccion_cs WHERE id_interesado = :id_interesado ORDER BY fecha DESC LIMIT 1');
		$query->execute(array(
			'id_interesado' => $value['ID'],
		));
		$last_interaction = $query->fetch();
		//echo $last_interaction['ID'];
		
		//Flag last interaction
		$query = $con->prepare('UPDATE interaccion_cs SET ultima = :ultima WHERE ID = :ID');
		$query->execute(array(
			'ultima' => TRUE,
			'ID' => $last_interaction['ID'],
		));
		
		//Reset query for next interaction
		$query = $con->prepare('SELECT * FROM interaccion_cs WHERE id_interesado = :id_interesado AND ultima = :ultima');
	}

	//print_array($last_interaction);
	$query->closeCursor(); // Free memory used in this query

	// Adding last interaction info
	$value['ultima_interaccion'] =  $last_interaction;
	$value['fecha_estatus'] =  fecha_en_array($last_interaction['fecha']);;

	// Adding reminder date
	$value['fecha_recordatorio'] =  fecha_en_array($value['recordatorio']);
	
	// Saving info
	$casos[$caso] = $value;
	//print_array($casos);
}


//print_array($casos);
	
//Llamando una vista
view('home', compact('casos', 'nombre_vista', 'saludo'));


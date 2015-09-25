<?php
/*
* Controlador del Home / Página principal
*/

$user = confirm_logged_in(); //revisa si el operador ha ingresado
//print_array($user);

//Acept parameters for extra custom search

$data = readRawPost($_POST);
$params_busqueda = $data;
$busqueda = array();
// file_put_contents("post.log",print_r($_POST,true));

// Prints post content

//Query search
if ( isset($data['buscar']) ) {

	if ( $data['nombre'] OR $data['apellidos'] OR $data['pais'] ) { //verify search is not empty

		$con = db_con();

		//Building the stament
		$begin_statement = "SELECT * FROM interesado_cs WHERE ";

		$begin_statement .= $data['nombre'] ? ( ($data['apellidos'] OR $data['pais']) ? 'nombre LIKE \'%' . $data['nombre'] . "%' AND " : 'nombre LIKE \'%' . $data['nombre'] . '%\'' ) :'';

		$begin_statement .= $data['apellidos'] ? ( $data['pais'] ? 'apellidos LIKE \'%' . $data['apellidos'] . "%' AND " : 'apellidos LIKE \'%' . $data['apellidos'] . '%\'' ) :'';

		$begin_statement .= $data['pais'] ? 'pais LIKE \'%' . $data['pais'] . '%\'' : '';

		$end_statement = " AND activo = 'Si' ORDER BY FIELD (prioridad, 'rojo', 'verde', 'azul'), recordatorio ASC LIMIT 1000";

		$statement = $begin_statement . $end_statement;
		
		// Execute stament
		$query = $con->prepare($statement);
		$query->execute();
		$busqueda = $query->fetchAll();
		$query->closeCursor();
		if (!empty($busqueda)) {

			// Adding extra info to leads.
			$query = $con->prepare('SELECT * FROM interaccion_cs WHERE id_interesado = :id_interesado AND ultima = :ultima');
			foreach ($busqueda as $caso => $value) {

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

				$query->closeCursor(); // Free memory used in this query

				// Adding last interaction info
				$value['ultima_interaccion'] =  $last_interaction;
				$value['fecha_estatus'] =  fecha_en_array($last_interaction['fecha']);

				// Adding reminder date
				$value['fecha_recordatorio'] =  fecha_en_array($value['recordatorio']);
				
				// Saving info
				$busqueda[$caso] = $value;
			}

		} else {
		
			$busqueda = 'No se encontraron resultados.';
		
		}

	} else { // If search is empty

		$busqueda = 'Debes de llenar por lo menos un campo para realizar una búsqueda.';

	}

}

// Getting leads
$casos = array();
$con = db_con();
$query = $con->prepare("SELECT * FROM interesado_cs WHERE activo = :status ORDER BY FIELD (prioridad, 'rojo', 'verde', 'azul'), recordatorio ASC LIMIT 1000");
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
	$value['fecha_estatus'] =  fecha_en_array($last_interaction['fecha']);

	// Adding reminder date
	$value['fecha_recordatorio'] =  fecha_en_array($value['recordatorio']);
	
	// Saving info
	$casos[$caso] = $value;
	//print_array($casos);
}


//print_array($casos);
$notifications = filter_notifications_by_date_and_status(get_active_notifications());
//print_array($notifications);

//Llamando una vista
view('home', compact('casos', 'nombre_vista', 'saludo', 'user', 'notifications', 'busqueda', 'params_busqueda'));


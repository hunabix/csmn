<?php
/*
* Controlador del modal Lista general
*/

//echo $data['tipo-accion'];

//echo print_array($data);

// Get last interaction
$last_interaction = get_last_interaction($data['lead-id']);

// Send to general list
$lead = array();
$con = db_con();
$query = $con->prepare('INSERT INTO interaccion_cs (tipo, id_interesado, fecha, observaciones) VALUES (:tipo, :id_interesado, :fecha, :observaciones)');

if ($query->execute(array(
			'tipo' => 'Se ha agregado a la lista general',
			'id_interesado' => $data['lead-id'],
			'fecha' => date("Y-m-d H:i:s"),
			'observaciones' => $data['comentario'],
		))) {
			
	//Get last inserted ID
	$lastId = $con->lastInsertId();
	
	//Unflag old last interaction and falg new last interaction
	update_last_interaction($last_interaction['ID'],$lastId);
	
	remove_from_main_list($data['lead-id']);

	//Returning lead ID
	$return['lead-id'] = $data['lead-id'];
	$return['tipo-accion'] = $data['tipo-accion'];
	echo json_encode($return);

}
$query->closeCursor();
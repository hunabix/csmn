<?php
/*
* Controlador del modal Cambiar prioridad
*/

//echo $data['tipo-accion'];

//echo print_array($data);


$lead = array();
$con = db_con();

// Changes priority
$query = $con->prepare('UPDATE interesado_cs SET prioridad = :prioridad WHERE ID = :ID');
if ($query->execute(array(
		'prioridad' => $data['prioridad'],
		'ID' => $data['lead-id'],
	))) {

	//Returning lead ID
	$return['lead_id'] = $data['lead-id'];
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['mensaje'] = 'Se cambió la prioridad a ' . $data['prioridad'];
	echo json_encode($return, JSON_UNESCAPED_UNICODE);
}

$query->closeCursor();
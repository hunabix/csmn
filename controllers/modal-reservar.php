<?php
/*
* Controlador del modal Reservar
*/

//echo $data['tipo-accion'];

//echo print_array($data);

// Get last interaction
$last_interaction = get_last_interaction($data['lead-id']);

$lead_info = get_lead_info_by_id($data['lead-id']);

// Program for future season
$lead = array();
$con = db_con();
$query = $con->prepare('INSERT INTO interaccion_cs (tipo, id_interesado, fecha, mensaje_op, observaciones, alerta) VALUES (:tipo, :id_interesado, :fecha, :mensaje_op, :observaciones, :alerta)');

if ($query->execute(array(
			'tipo' => 'Se ha inscrito en Musinetwork',
			'id_interesado' => $data['lead-id'],
			'fecha' => date("Y-m-d H:i:s"),
			'mensaje_op' => $data['comentario-reserva'],
			'observaciones' => $data['ciclo-reserva'],
			'alerta' => $data['fecha-recordatorio-reserva'],
		))) {

	//Get last inserted ID
	$lastId = $con->lastInsertId($data['lead-id']);
	
	//Unflag old last interaction and falg new last interaction
	update_last_interaction($last_interaction['ID'],$lastId);

	remove_from_main_list($data['lead-id']);

	//Returning lead ID
	$return['lead_id'] = $data['lead-id'];
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['mensaje'] = 'Se reservó al interesado';
	$return['nombre'] = $lead_info['nombre'];
	$return['apellidos'] = $lead_info['apellidos'];
	echo json_encode($return, JSON_UNESCAPED_UNICODE);

}
$query->closeCursor();
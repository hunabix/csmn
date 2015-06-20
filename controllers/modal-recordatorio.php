<?php
/*
* Controlador del modal Recordatorio
*/

//echo $data['tipo-accion'];

//echo print_array($data);

// Get last interaction
$last_interaction = get_last_interaction($data['lead-id']);

$lead_info = get_lead_info_by_id($data['lead-id']);

// Register call
$lead = array();
$con = db_con();
$query = $con->prepare('INSERT INTO interaccion_cs (tipo, id_interesado, fecha, observaciones) VALUES (:tipo, :id_interesado, :fecha, :observaciones)');

$date = date("Y-m-d H:i:s");

if ($query->execute(array(
			'tipo' => 'Se agregó un recordatorio',
			'id_interesado' => $data['lead-id'],
			'fecha' => $date,
			'observaciones' => $data['recordatorio'],
		))) {
			
	//Get last inserted ID
	$lastId = $con->lastInsertId();
	
	//Unflag old last interaction and falg new last interaction
	update_last_interaction($last_interaction['ID'],$lastId);
	
	// Update recordatorio_texto in interesado_cs
	$query = $con->prepare('UPDATE interesado_cs SET recordatorio = :recordatorio, recordatorio_texto = :recordatorio_texto WHERE ID = :ID');
	$query->execute(array(
		'recordatorio' => $data['fecha-recordatorio'],
		'recordatorio_texto' => $data['recordatorio'],
		'ID' => $data['lead-id'],
	));

	$fecha = fecha_en_array($data['fecha-recordatorio']);
	//Returning lead ID
	$return['lead_id'] = $data['lead-id'];
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['mensaje'] = 'Se agregó un recordatorio a';
	$return['nombre'] = $lead_info['nombre'];
	$return['apellidos'] = $lead_info['apellidos'];
	$return['recordatorio'] = $data['recordatorio'];
	$return['fecha_recordatorio'] = $fecha['dia'] . ' ' . $fecha['mes_texto_corto'];
	//echo print_array($return);
	echo json_encode($return, JSON_UNESCAPED_UNICODE);

}
$query->closeCursor();
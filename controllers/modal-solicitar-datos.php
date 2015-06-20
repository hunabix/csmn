<?php
/*
* Controlador del modal Solicitar datos
*/

//echo $data['tipo-accion'];

//echo print_array($data);

// Get data by lead id
$con = db_con();
$query = $con->prepare('SELECT * FROM interesado_cs WHERE ID = :ID');
if ($query->execute(array('ID' => $data['lead-id']))) {
	
	$lead_info = $query->fetch();
	$query->closeCursor();
	
	//Returning lead ID
	$return['lead_id'] = $data['lead-id'];
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['lead_info'] = $lead_info;
	
	echo print_array($return);
	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	
}
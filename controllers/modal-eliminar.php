<?php
/*
* Controlador del modal Eliminar
*/

//echo $data['tipo-accion'];

//echo print_array($data);

// Deleting lead
$lead = array();
$con = db_con();
$query = $con->prepare('DELETE FROM interesado_cs WHERE ID = :id');

if ( $query->execute(array('id' => $data['lead-id'])) ) {

	//Returning lead ID
	$return['lead-id'] = $data['lead-id'];
	$return['tipo-accion'] = $data['tipo-accion'];
	echo json_encode($return);

}
$query->closeCursor();
<?php
/*
* Controlador del modal Editar datos
*/

// file_put_contents("post.log",print_r($_POST,true));

//echo $data['tipo-accion'];

//echo print_array($data);

//Flag last interaction
$con = db_con();
$query = $con->prepare('INSERT INTO plantillas (nombre, asunto, contenido) VALUES (:nombre, :asunto, :contenido)');
if ($query->execute(array(
	'nombre' => $data['nombre'],
	'asunto' => $data['asunto'],	
	'contenido' => $data['contenido'],
))) {
	
	//Get last inserted ID
	$lastId = $con->lastInsertId();

	//Returning usuario ID
	$return['plantilla_id'] = $lastId;
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['mensaje'] = 'Se creó exitosamente';
	$return['nombre'] = $data['nombre'];
	$return['asunto'] = $data['asunto'];
	$return['contenido'] = $data['contenido'];

// file_put_contents("tracker.log",print_r($return,true));

	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	
}
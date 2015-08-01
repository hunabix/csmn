<?php
/*
* Controlador del modal Crear notificaciones
*/

// file_put_contents("post.log",print_r($_POST,true));

//echo $data['tipo-accion'];

//echo print_array($data);

//Flag last interaction
$con = db_con();
$query = $con->prepare('INSERT INTO notificaciones (id_usuario, titulo, descripcion, tipo, fecha_creacion, fecha_notificacion, estado) VALUES (:id_usuario, :titulo, :nombre, :descripcion, :tipo, :fecha_creacion, :fecha_notificacion, :estado)');
if ($query->execute(array(
	'id_usuario' => $data['id_usuario'],
	'titulo' => $data['titulo'],	
	'descripcion' => $data['descripcion'],
	'tipo' => $data['tipo'],
	'fecha_creacion' => $data['fecha_creacion'],
	'fecha_notificacion' => $data['fecha_notificacion'],
	'estado' => $data['estado'],
))) {
	
	//Get last inserted ID
	$lastId = $con->lastInsertId();

	//Returning usuario ID
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['mensaje'] = 'Se creó exitosamente';
	$return['ID'] = $lastId;
	$return['id_usuario'] = $data['id_usuario'];
	$return['titulo'] = 'titulo';
	$return['descripcion'] = $data['descripcion'];
	$return['tipo'] = $data['tipo'];
	$return['fecha_creacion'] = $data['fecha_creacion'];
	$return['fecha_notificacion'] = $data['fecha_notificacion'];
	$return['estado'] = $data['estado'];

// file_put_contents("tracker.log",print_r($return,true));

	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	
}
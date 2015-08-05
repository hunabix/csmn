<?php
/*
* Controlador del modal Editar notificacion
*/

file_put_contents("post.log",print_r($_POST,true));

//echo $data['tipo-accion'];

//echo print_array($data);

//Flag last interaction
$con = db_con();
$fecha_notificacion = custom_date_format($data['fecha_notificacion'], '/', '-', array(2, 1, 0));
$query = $con->prepare('UPDATE notificaciones SET id_usuario = :id_usuario, titulo = :titulo, descripcion = :descripcion, tipo = :tipo, fecha_notificacion = :fecha_notificacion WHERE ID = :ID');
if ($query->execute(array(
	'id_usuario' => $data['id_usuario'],
	'titulo' => $data['titulo'],	
	'descripcion' => $data['descripcion'],
	'tipo' => $data['tipo'],
	'fecha_notificacion' => $fecha_notificacion,
	'ID' => $data['ID'],
))) {
	
	//Returning usuario ID
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['mensaje'] = 'Se editó exitosamente';
	$return['id_usuario'] = $data['id_usuario'];
	$return['titulo'] = $data['titulo'];
	$return['descripcion'] = $data['descripcion'];
	$return['tipo'] = $data['tipo'];
	$return['fecha_notificacion'] = $fecha_notificacion;
	$return['estado'] = $data['estado'];
	$return['ID'] = $data['ID'];

	// file_put_contents("tracker.log",print_r($return,true));

	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	
}
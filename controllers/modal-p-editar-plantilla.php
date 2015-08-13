<?php
/*
* Controlador del modal Editar datos
*/

// file_put_contents("post.log",print_r($_POST,true));

//echo $data['tipo-accion'];

//echo print_array($data);

//Flag last interaction
$con = db_con();
$query = $con->prepare('UPDATE plantillas SET nombre = :nombre, asunto = :asunto, contenido = :contenido WHERE ID = :ID');
if ($query->execute(array(
	'nombre' => $data['nombre'],
	'asunto' => $data['asunto'],	
	'contenido' => $data['contenido'],
	'ID' => $data['plantilla-id'],
))) {
	
	//Returning plantilla ID
	$return['plantilla_id'] = $data['plantilla-id'];
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['mensaje'] = 'Se editó exitosamente';
	$return['nombre'] = $data['nombre'];
	$return['asunto'] = $data['asunto'];
	$return['contenido'] = $data['contenido'];

	// file_put_contents("tracker.log",print_r($return,true));

	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	
}
<?php
/*
* Controlador del modal Editar datos
*/

// file_put_contents("post.log",print_r($_POST,true));

//echo $data['tipo-accion'];

//echo print_array($data);

//Flag last interaction
$con = db_con();
$query = $con->prepare('UPDATE operador_mn SET usuario = :usuario, clave = :clave, nombre = :nombre, tipo = :tipo, email = :email WHERE ID = :ID');
if ($query->execute(array(
	'usuario' => $data['username'],
	'clave' => $data['clave'],	
	'nombre' => $data['nombre'],
	'tipo' => $data['tipo'],
	'email' => $data['email'],
	'ID' => $data['usuario-id'],
))) {
	
	//Returning usuario ID
	$return['usuario_id'] = $data['usuario-id'];
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['mensaje'] = 'Se editó exitosamente';
	$return['username'] = $data['username'];
	$return['clave'] = $data['clave'];
	$return['nombre'] = $data['nombre'];
	$return['tipo'] = $data['tipo'];
	$return['email'] = $data['email'];

	// file_put_contents("tracker.log",print_r($return,true));

	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	
}
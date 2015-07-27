<?php
/*
* Controlador del modal Editar datos
*/

//echo $data['tipo-accion'];

//echo print_array($data);

//Flag last interaction
$con = db_con();
$query = $con->prepare('UPDATE operador_mn SET usuario = :usuario, clave = :clave, nombre = :nombre, tipo = :tipo, email = :email WHERE ID = :ID');
if ($query->execute(array(
	'usuario' => $data['username'],
	'clave' => $data['clave'],	
	'nombre' => $data['correo'],
	'tipo' => $data['tipo'],
	'email' => $data['email'],
	'ID' => $data['usuario-id'],
))) {
	
	//Returning usuario ID
	$return['usuario_id'] = $data['usuario-id'];
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['mensaje'] = 'Se editó exitosamente';
	$return['username'] = $data['username'];
	$return['correo'] = $data['correo'];
	$return['tipo'] = $data['tipo'];
	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	
}
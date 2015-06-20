<?php
/*
* Controlador del modal Editar datos
*/

//echo $data['tipo-accion'];

//echo print_array($data);

//Flag last interaction
$con = db_con();
$query = $con->prepare('UPDATE interesado_cs SET nombre = :nombre, apellidos = :apellidos, email = :email, telefono = :telefono, ciudad = :ciudad, instrumento = :instrumento WHERE ID = :ID');
if ($query->execute(array(
	'nombre' => $data['nombre'],
	'apellidos' => $data['apellidos'],	
	'email' => $data['correo'],
	'telefono' => $data['telefono'],
	//'pais' => $data['pais'],
	'ciudad' => $data['ciudad'],
	'instrumento' => $data['instrumento'],
	'ID' => $data['lead-id'],
))) {
	
	//Returning lead ID
	$return['lead_id'] = $data['lead-id'];
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['mensaje'] = 'Se editó exitosamente';
	$return['nombre'] = $data['nombre'];
	$return['apellidos'] = $data['apellidos'];
	$return['correo'] = $data['correo'];
	$return['telefono'] = $data['telefono'];
	$return['ciudad'] = $data['ciudad'];
	$return['instrumento'] = $data['instrumento'];
	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	
}
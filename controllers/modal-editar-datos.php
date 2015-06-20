<?php
/*
* Controlador del modal Editar datos
*/

//echo $data['tipo-accion'];

//echo print_array($data);

//Flag last interaction
$query = $con->prepare('UPDATE interesado_cs SET nombre = :nombre, apellidos = :apellidos, email = :email, telefono = :telefono, pais = :pais, ciudad = :ciudad, instrumento = :instrumento WHERE ID = :ID');
if ($query->execute(array(
	'nombre' => $data['nombre'],
	'apellidos' => $data['apellidos'],	
	'email' => $data['email'],
	'telefono' => $data['telefono'],
	'pais' => $data['pais'],
	'ciudad' => $data['ciudad'],
	'instrumento' => $data['instrumento'],
	'ID' => $data['lead-id'],
))) {
	
	//Returning lead ID
	$return['lead_id'] = $data['lead-id'];
	$return['tipo_accion'] = $data['tipo-accion'];
	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	
}
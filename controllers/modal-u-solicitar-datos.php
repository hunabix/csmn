<?php
/*
* Controlador del modal Solicitar datos
*/

file_put_contents("post.log",print_r($_POST,true));

//echo $data['tipo-accion'];

//echo print_array($data);

// Get data by usuario id
$con = db_con();
$query = $con->prepare('SELECT * FROM operador_mn WHERE ID = :ID');
if ($query->execute(array('ID' => $data['usuario-id']))) {
	
	$usuario_info = $query->fetch();
	file_put_contents("tracker.log",print_r($usuario_info,true));
	$query->closeCursor();
	
	//Returning usuario ID
	$return['usuario_id'] = $data['usuario-id'];
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['usuario_info'] = $usuario_info;
	
	//echo print_array($return);
	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	
}
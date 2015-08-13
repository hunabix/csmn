<?php
/*
* Controlador del modal Solicitar datos
*/

file_put_contents("post.log",print_r($_POST,true));
// die;
//echo $data['tipo-accion'];

//echo print_array($data);

// Get data by plantilla id
$con = db_con();
$query = $con->prepare('SELECT * FROM plantillas WHERE ID = :ID');
if ($query->execute(array('ID' => $data['plantilla-id']))) {
	
	$plantilla_info = $query->fetch();
	$query->closeCursor();
	
	//Returning usuario ID
	$return['plantilla_id']	= $data['plantilla-id'];
	$return['tipo_accion']	= $data['tipo-accion'];
	$return['nombre']		= $plantilla_info['nombre'];
	$return['asunto']		= $plantilla_info['asunto'];
	$return['contenido']	= $plantilla_info['contenido'];
	
	file_put_contents("tracker.log",print_r($plantilla_info,true));
	
	//echo print_array($return);
	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	
}
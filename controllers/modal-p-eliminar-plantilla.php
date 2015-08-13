<?php
/*
* Controlador del modal Eliminar
*/

//file_put_contents("post.log",print_r($_POST,true));

//echo $data['tipo-accion'];

//echo print_array($data);


// Prepare connection
$con = db_con();
$query = $con->prepare('DELETE FROM plantillas WHERE ID = :id');

if ( $query->execute(array('id' => $data['plantilla-id'])) ) {

		//Returning lead ID
		$return['plantilla'] = $data['plantilla-id'];
		$return['tipo_accion'] = $data['tipo-accion'];
		$return['mensaje'] = 'Se eliminó exitosamente';
		$return['nombre'] = $data['nombre'];
		$return['asunto'] = $data['asunto'];
		$return['contenido'] = $data['contenido'];

		//file_put_contents("tracker.log",print_r($return,true));

		echo json_encode($return, JSON_UNESCAPED_UNICODE);

}

if ($data['formulario'] == 'mag-form') {

	//Returning lead ID
	$return = TRUE;
	echo json_encode($return, JSON_UNESCAPED_UNICODE);

}

$query->closeCursor();
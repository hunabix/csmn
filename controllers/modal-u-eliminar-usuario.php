<?php
/*
* Controlador del modal Eliminar
*/

//file_put_contents("post.log",print_r($_POST,true));

//echo $data['tipo-accion'];

//echo print_array($data);


// Prepare connection
$con = db_con();
$query = $con->prepare('DELETE FROM operador_mn WHERE ID = :id');

if ( $query->execute(array('id' => $data['usuario-id'])) ) {

		//Returning lead ID
		$return['usuario_id'] = $data['usuario-id'];
		$return['tipo_accion'] = $data['tipo-accion'];
		$return['mensaje'] = 'Se eliminó exitosamente';
		$return['username'] = $data['username'];
		$return['clave'] = $data['clave'];
		$return['nombre'] = $data['nombre'];
		$return['tipo'] = $data['tipo'];
		$return['email'] = $data['email'];;

		//file_put_contents("tracker.log",print_r($return,true));

		echo json_encode($return, JSON_UNESCAPED_UNICODE);

}

if ($data['formulario'] == 'mag-form') {

	//Returning lead ID
	$return = TRUE;
	echo json_encode($return, JSON_UNESCAPED_UNICODE);

}

$query->closeCursor();
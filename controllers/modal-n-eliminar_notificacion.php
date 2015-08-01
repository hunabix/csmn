<?php
/*
* Controlador del modal Eliminar
*/

//file_put_contents("post.log",print_r($_POST,true));

//echo $data['tipo-accion'];

//echo print_array($data);


// Prepare connection
$con = db_con();
$query = $con->prepare('DELETE FROM notificaciones WHERE ID = :ID');

if ( $query->execute(array('ID' => $data['ID'])) ) {

		//Returning lead ID
		$return['tipo_accion'] = $data['tipo-accion'];
		$return['mensaje'] = 'Se eliminó exitosamente';
		$return['ID'] = $data['ID'];

		//file_put_contents("tracker.log",print_r($return,true));

		echo json_encode($return, JSON_UNESCAPED_UNICODE);

}

$query->closeCursor();
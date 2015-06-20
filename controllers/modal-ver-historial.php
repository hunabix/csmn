<?php
/*
* Controlador del modal Ver historial
*/

//echo $data['tipo-accion'];

//echo print_array($data);

// Get historial by lead id
$con = db_con();
$query = $con->prepare('SELECT * FROM interaccion_cs WHERE id_interesado = :id_interesado ORDER BY fecha DESC');
if ($query->execute(array(
		'id_interesado' => $data['lead-id']
	))) {
		
	$historial = $query->fetchAll();
	$query->closeCursor();
	
	$historial;
	
	foreach ($historial as $key => $value) {
	
		// Adding last interaction info
		$value['alerta']		= $value['alerta'];
		$value['fecha']			= fecha_en_array($value['recordatorio']);
		$value['hora']			= fecha_en_array($value['recordatorio']);
		$value['mensaje_int']	= $value['mensaje_int'];
		$value['mensaje_op']	= $value['mensaje_op'];
		$value['observaciones']	= $value['observaciones'];
		$value['tipo']			= $value['tipo'];
		
		// Saving info
		$result[$key] = $value;
		//print_array($casos);
	}
	
	
	//Returning lead ID
	$return['lead-id']		= $data['lead-id'];
	$return['tipo-accion']	= $data['tipo-accion'];
	$return['historial']	= $result;
	echo json_encode($result, JSON_UNESCAPED_UNICODE);		
		
}
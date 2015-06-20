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
	
	
	foreach ($historial as $key => $value) {
		
		$human_date = fecha_en_array($value['fecha']);
		// Adding last interaction info
		$nvalue['alerta']		= $value['alerta'];
		$nvalue['fecha']			= $human_date['dia'] . ' de ' . $human_date['mes_texto'] . ' de ' . $human_date['ano'];
		$nvalue['hora']			= $human_date['hora'];
		$nvalue['mensaje_int']	= $value['mensaje_int'];
		$nvalue['mensaje_op']	= $value['mensaje_op'];
		$nvalue['observaciones']	= $value['observaciones'];
		$nvalue['tipo']			= $value['tipo'];
		
		// Saving info
		$result[$key] = $nvalue;
		//print_array($result);
	}
	
	
	//Returning lead ID
	$return['lead-id']		= $data['lead-id'];
	$return['tipo-accion']	= $data['tipo-accion'];
	$return['historial']	= $result;
	//print_array($return);
	echo json_encode($result, JSON_UNESCAPED_UNICODE);		
		
}
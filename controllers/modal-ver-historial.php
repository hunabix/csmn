<?php
/*
* Controlador del modal Ver historial
*/

//echo $data['tipo-accion'];

//echo print_array($data);

// Get historial by lead id
$con = db_con();
$query = $con->prepare('SELECT * FROM interaccion_cs WHERE id_interesado = :id_interesado ORDER BY fecha DESC');
$query->execute(array('id_interesado' => $data['lead-id']));
$historial = $query->fetchAll();
$query->closeCursor();

//Returning lead ID
$return['lead-id'] = $data['lead-id'];
$return['tipo-accion'] = $data['tipo-accion'];
echo json_encode($historial);
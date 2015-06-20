<?php
/*
* Controlador del modal Solicitar datos
*/

//echo $data['tipo-accion'];

//echo print_array($data);

// Get data by lead id
$con = db_con();
$query = $con->prepare('SELECT * FROM interesado_cs WHERE ID = :ID');
$query->execute(array('ID' => $data['lead-id']));
$lead_info = $query->fetch();
$query->closeCursor();

//Returning lead ID
$return['lead-id'] = $data['lead-id'];
$return['tipo-accion'] = $data['tipo-accion'];
echo json_encode($lead_info, JSON_UNESCAPED_UNICODE);
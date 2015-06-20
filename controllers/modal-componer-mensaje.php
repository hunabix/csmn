<?php
/*
* Controlador del Componer mensaje / Página principal
*/
		
//Llamando una vista
//view('componer-mensaje');

$lead_info = get_lead_info_by_id($data['lead-id']);


$return['lead_id'] = $data['lead-id'];
$return['tipo_accion'] = $data['tipo-accion'];
header('Location: ' . cs_url . '/componer-mensaje');
echo json_encode($return, JSON_UNESCAPED_UNICODE);
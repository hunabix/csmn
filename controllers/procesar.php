<?php
/*
* Controlador que recibe peticiones
*/

// Carga de archivos base
require_once('../config.php');
require_once('../includes.php');
require_once('../base_controller.php');

confirm_logged_in(); //revisa si el operador ha ingresado

$data = readRawPost($_POST);

if (!isset($data['formulario']))
	die;

//Proces leads form
if ($data['formulario'] == 'leads-form') {

	load_modal($data['tipo-accion'], compact('data'));

} //Leads form

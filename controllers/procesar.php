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

// Prints post content
//echo print_array($data);

if (!isset($data['formulario']))
	die;

// Proces leads form
if ($data['accion']) {

	load_action($data['accion'], compact('data'));
	exit();
}

// Proces leads form
if ($data['formulario'] == 'leads-form') {

	load_modal($data['tipo-accion'], compact('data'));
	exit();
} //Leads form

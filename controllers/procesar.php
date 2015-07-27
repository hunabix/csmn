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

// file_put_contents("post.log",print_r($_POST,true));

// Prints post content
//echo print_array($data);

if (!isset($data['formulario']))
	die;

// Procces leads form
if ($data['formulario'] == 'leads-form' OR $data['formulario'] == 'mag-form') {

	load_modal($data['tipo-accion'], compact('data'));
	exit();
} //Leads form

// Procces leads form
if ($data['formulario'] == 'usuarios-form') {

	load_modal('u-'.$data['tipo-accion'], compact('data'));
	exit();
} //Leads form

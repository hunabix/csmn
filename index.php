<?php 
/*
* Frontend Controller
*/

// Carga de archivos base
require_once('config.php');
require_once('includes.php');
require_once('base_controller.php');

// Llama al controlador correspondiente
controller($_GET['url']);

// Impresión de parametros para testing
// var_dump($_GET);
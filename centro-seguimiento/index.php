<?php 
/*
* Frontend Controller
*/

// Carga de archivos base
require 'config.php';
require 'helpers.php';

// Llama al controlador correspondiente
controller($_GET['url']);

// Impresión de parametros para testing
// var_dump($_GET);
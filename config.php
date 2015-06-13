<?php 	
/*
* Configuración general del proyecto
*/

ini_set('display_errors', true);
//error_reporting(E_ALL);
error_reporting(E_ALL ^ E_DEPRECATED);

define('cs_url', 'http://localhost/dev.musinetwork.com', true); //Url de la instalación sin la barra final. Ej: http://localhost/dev.musinetwork.com/centro-seguimiento
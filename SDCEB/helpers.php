<?php 
/* 
* Archivo de funciones de apoyo 	 
*/

//Función para definir los controladores
function controller($name)
{
	// Si el url es raíz o vacio
	if (empty($_GET['url']))
	{
		$name = 'home';
	} 
	// Construyo la ruta del archivo controlador
	$file = 'controllers/' . $name . '.php';
	// Si el archivo existe lo mando a llamar
	if (file_exists($file)) 
	{
		require $file;
	}
	// Si el archivo NO existe envío error 404
	else 
	{
		header("HTTP/1.0 404 Not Found");
		exit("Pagina no encontrada");
	}
}

//Función para definir las vistas
function view($template, $vars = array())
{
	extract($vars);
	require 'views/' . $template . '.tpl.php';
}


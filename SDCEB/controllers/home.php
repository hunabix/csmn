<?php
/*
* Controlador del Home / Página principal
*/

// Ejemplo de paso de parámetros por variables 
$titulo = "Mini framework del Centro de seguimiento MN";
$nombre_vista = "Home";
$saludo = "Hola, bienvenidos";
		
//Llamando una vista
view('home', compact('titulo', 'nombre_vista', 'saludo'));


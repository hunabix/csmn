<?php
/*
* Controlador del Home / Página principal
*/

// Ejemplo de paso de parámetros por variables 
$titulo = "Mini framework del Centro de seguimiento MN";
$saludo = "Hola, bienvenidos";
		
//Llamando una funcion
view('home', compact('titulo', 'saludo'));


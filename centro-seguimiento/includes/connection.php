<?php
require("constants.php");
	// 1. Creo la conexion a MySQL
	$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS); 
	if (!$connection) {
		die("Fallo la conexion con la base de datos: " . mysql_error());
	}

	// 2. Seleciono la BD a usar
	$db_select = mysql_select_db(DB_NAME,$connection);
	if (!$db_select) {
		die("Database selection failed: " . mysql_error());
	}

?>
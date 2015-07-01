<?php
/*
* Controlador de Configuración
*/

confirm_logged_in(); //revisa si el operador ha ingresado

$data = readRawPost(array_values($_POST));
//print_array($data);

$data['form_procesado'] = 'no';

global $connection;

//COMIENZA A PROCESAR EL DOCUMENTO

// ------------------------------------------------------------ ------------//
// ---------  SE INICIALIZAN LAS VARIABLES  --------------------------------//
// -------------------------------------------------------------------------//
$temporada = ""; $inicio_ins = ""; $fin_ins = ""; $inicio_cur = ""; $ciclo_esc = ""; $form_procesado = ""; 
$tmpa = ""; $tmpb = ""; $tmpc = ""; $tmpd = ""; $tmpe = ""; $tmpf = ""; 
$cl1 = ""; $cl2 = ""; $cl3 = ""; $cl4 = "";

// -------------------------------------------------------------------------//
// ---------  SE COMPRUEBA SI SE ENVIÓ EL FORMULARIO -----------------------//
// -------------------------------------------------------------------------//
if (isset($data['nuevo-mensaje'])) { // el formulario ha sido enviado
	if(isset($data['inicio-ins'])){ $inicio_ins = custom_date_format($data['inicio-ins'], '/', '-', array(0, 1, 2)); }
	if(isset($data['fin-ins'])){ $fin_ins = custom_date_format($data['fin-ins'], '/', '-', array(0, 1, 2)); }
	if(isset($data['inicio-cur'])){ $inicio_cur = custom_date_format($data['inicio-cur'], '/', '-', array(0, 1, 2)); }
	if(isset($data['ciclo-esc'])){ $ciclo_esc = $data['ciclo-esc']; }
	if(isset($data['temporada'])){ $temporada = $data['temporada']; }	
	
	// ----------------------------------------------------------------------------//
	// ------  Actualiza recordatorios si el operador actualiza la temporada ------//
	// ----------------------------------------------------------------------------//
	$configuracion = obten_configuracion();
	if ($configuracion['temporada'] != $temporada ) {
		// obtengo los casos de seguimiento actuales y entro a un loop
		$casos_set = obten_casos();
		while ($caso = mysql_fetch_array($casos_set)) {
			// Obtengo los datos que decesito de cada caso
			$id_interesado = $caso["ID"];
			$rec_pers =$caso['rec_pers'];
			$interacciones = obten_utima_interaccion($id_interesado);
			$estatus = mysql_fetch_array($interacciones); 
			$tipo = utf8_encode($estatus['tipo']);
			$fecha = $estatus['fecha'];			
			// actualiza los recordatorios de los distintos casos de acuerdo a la nueva temporada
			actualiza_recordatorio($temporada, $tipo, $fecha, $id_interesado, $rec_pers);
		}
	}
	
	// ------------------------------------------------------------ ------------//
	// ---------  ALMACENO INFORMACIÓN EN BD -----------------------------------//
	// -------------------------------------------------------------------------//

	// ---------  Se guardan en BD los datos generales del caso en interesado_cs --------------//

	$consulta = "UPDATE configuracion_cs
				SET	temporada='$temporada',
				 inicio_ins='$inicio_ins',
				 fin_ins='$fin_ins',
				 inicio_cur='$inicio_cur',
				 ciclo_esc='$ciclo_esc'
				 WHERE id = 1";
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
	
	$data['form_procesado'] = $form_procesado = 'si';

} //TERMINA COMPROBACION DE ENVIO DEL FORMULARIO








// ---------  Se obtiene la última info guardada en la tabla --------------//
$data['configuracion'] = $configuracion = obten_configuracion();

// Processing dates
//echo $data['configuracion']['inicio_ins'];
//echo '<br />';
$data['configuracion']['inicio_ins'] = custom_date_format($data['configuracion']['inicio_ins'], '-', '/', array(0, 1, 2));
$data['configuracion']['fin_ins'] = custom_date_format($data['configuracion']['fin_ins'], '-', '/', array(0, 1, 2));
//echo $data['configuracion']['inicio_ins'];
$data['configuracion']['inicio_cur'] = custom_date_format($data['configuracion']['inicio_cur'], '-', '/', array(0, 1, 2));
	
	
switch ($configuracion['temporada'] ) {
	case $configuracion['temporada'] == 'Temporada A';
	$data['tmpa'] = $tmpa = 'selected';
	break;
	case $configuracion['temporada'] == 'Temporada B';
	$data['tmpb'] = $tmpb = 'selected';
	break;
	case $configuracion['temporada'] == 'Temporada C';
	$data['tmpc'] = $tmpc = 'selected';
	break;
	case $configuracion['temporada'] == 'Temporada D';
	$data['tmpd'] = $tmpd = 'selected';
	break;
	case $configuracion['temporada'] == 'Temporada E';
	$data['tmpe'] = $tmpe = 'selected';
	break;
	case $configuracion['temporada'] == 'Temporada F';
	$data['tmpf'] = $tmpf = 'selected';
	break;
}
switch ($configuracion['ciclo_esc'] ) {
	case $configuracion['ciclo_esc'] == 'ENERO - MARZO';
	$data['cl1'] = $cl1 = 'selected';
	break;
	case $configuracion['ciclo_esc'] == 'ABRIL - JUNIO';
	$data['cl2'] = $cl2 = 'selected';
	break;
	case $configuracion['ciclo_esc'] == 'JULIO - SEPTIEMBRE';
	$data['cl3'] = $cl3 = 'selected';
	break;
	case $configuracion['ciclo_esc'] == 'OCTUBRE - DICIEMBRE';
	$data['cl4'] = $cl4 = 'selected';
	break;
}

//print_array($data);

//Llamando una vista
view('configuracion', compact('data'));
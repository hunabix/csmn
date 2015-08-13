<?php
/*
* Controlador de Configuración
*/

$user = confirm_logged_in(); //revisa si el operador ha ingresado
//file_put_contents("post.log",print_r($_POST,true));
$data = readRawPost(array_values($_POST));

// print_array($data);

//$data['form_procesado'] = 'no';

global $connection;

//COMIENZA A PROCESAR EL DOCUMENTO

// ------------------------------------------------------------ ------------//
// ---------  SE INICIALIZAN LAS VARIABLES  --------------------------------//
// -------------------------------------------------------------------------//
$temporada = ""; /*$inicio_ins = ""; $cierre_ins = ""; $inicio_cur = ""; $ciclo_esc = "";*/ $form_procesado = ""; 
$tmpa = ""; $tmpb = ""; $tmpc = ""; $tmpd = ""; $tmpe = ""; $tmpf = ""; 
$cl1 = ""; $cl2 = ""; $cl3 = ""; $cl4 = "";

$inicio_ins_ene_mar = '';
$cierre_ins_ene_mar = '';
$inicio_cur_ene_mar = '';

$inicio_ins_abr_jun = '';
$cierre_ins_abr_jun = '';
$inicio_cur_abr_jun = '';

$inicio_ins_jul_sep = '';
$cierre_ins_jul_sep = '';
$inicio_cur_jul_sep = '';

$inicio_ins_oct_dic = '';
$cierre_ins_oct_dic = '';
$inicio_cur_oct_dic = '';

// -------------------------------------------------------------------------//
// ---------  SE COMPRUEBA SI SE ENVIÓ EL FORMULARIO -----------------------//
// -------------------------------------------------------------------------//
if (isset($data['formulario'])) { // el formulario ha sido enviado
	if(isset($data['ciclo-esc'])){ $ciclo_esc = $data['ciclo-esc']; }
	/*if(isset($data['temporada'])){ $temporada = $data['temporada']; }*/
	//echo 'bu!';
	
	if(isset($data['inicio-ins-ciclo1'])){ $inicio_ins_ene_mar = custom_date_format($data['inicio-ins-ciclo1'], '/', '-', array(2, 1, 0)); }
	if(isset($data['cierre_ins-ciclo1'])){ $cierre_ins_ene_mar = custom_date_format($data['cierre_ins-ciclo1'], '/', '-', array(2, 1, 0)); }
	if(isset($data['inicio-cur-ciclo1'])){ $inicio_cur_ene_mar = custom_date_format($data['inicio-cur-ciclo1'], '/', '-', array(2, 1, 0)); }
	
	if(isset($data['inicio-ins-ciclo2'])){ $inicio_ins_abr_jun = custom_date_format($data['inicio-ins-ciclo2'], '/', '-', array(2, 1, 0)); }
	if(isset($data['cierre_ins-ciclo2'])){ $cierre_ins_abr_jun = custom_date_format($data['cierre_ins-ciclo2'], '/', '-', array(2, 1, 0)); }
	if(isset($data['inicio-cur-ciclo2'])){ $inicio_cur_abr_jun = custom_date_format($data['inicio-cur-ciclo2'], '/', '-', array(2, 1, 0)); }
	
	if(isset($data['inicio-ins-ciclo3'])){ $inicio_ins_jul_sep = custom_date_format($data['inicio-ins-ciclo3'], '/', '-', array(2, 1, 0)); }
	if(isset($data['cierre_ins-ciclo3'])){ $cierre_ins_jul_sep = custom_date_format($data['cierre_ins-ciclo3'], '/', '-', array(2, 1, 0)); }
	if(isset($data['inicio-cur-ciclo3'])){ $inicio_cur_jul_sep = custom_date_format($data['inicio-cur-ciclo3'], '/', '-', array(2, 1, 0)); }
	
	if(isset($data['inicio-ins-ciclo4'])){ $inicio_ins_oct_dic = custom_date_format($data['inicio-ins-ciclo4'], '/', '-', array(2, 1, 0)); }
	if(isset($data['cierre_ins-ciclo4'])){ $cierre_ins_oct_dic = custom_date_format($data['cierre_ins-ciclo4'], '/', '-', array(2, 1, 0)); }
	if(isset($data['inicio-cur-ciclo4'])){ $inicio_cur_oct_dic = custom_date_format($data['inicio-cur-ciclo4'], '/', '-', array(2, 1, 0)); }

	// ------------------------------------------------------------ ------------//
	// ---------  ALMACENO INFORMACIÓN EN BD -----------------------------------//
	// -------------------------------------------------------------------------//

	// ---------  Se guardan en BD los datos generales del caso en interesado_cs --------------//
	$consulta = "UPDATE configuracion_cs
				SET	ciclo_esc='$ciclo_esc',
				 inicio_ins_ene_mar='$inicio_ins_ene_mar',
				 cierre_ins_ene_mar='$cierre_ins_ene_mar',
				 inicio_cur_ene_mar='$inicio_cur_ene_mar',
				 
				 inicio_ins_abr_jun='$inicio_ins_abr_jun',
				 cierre_ins_abr_jun='$cierre_ins_abr_jun',
				 inicio_cur_abr_jun='$inicio_cur_abr_jun',
				 
				 inicio_ins_jul_sep='$inicio_ins_jul_sep',
				 cierre_ins_jul_sep='$cierre_ins_jul_sep',
				 inicio_cur_jul_sep='$inicio_cur_jul_sep',
				 
				 inicio_ins_oct_dic='$inicio_ins_oct_dic',
				 cierre_ins_oct_dic='$cierre_ins_oct_dic',
				 inicio_cur_oct_dic='$inicio_cur_oct_dic'

				 WHERE id = 1";
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
	
	$data['form_procesado'] = $form_procesado = 'si';

} //TERMINA COMPROBACION DE ENVIO DEL FORMULARIO



// ---------  Se obtiene la última info guardada en la tabla --------------//
$data['configuracion'] = $configuracion = get_configuracion();

// print_array($data['configuracion']);

// Processing dates
//echo $data['configuracion']['inicio_ins'];
//echo '<br />';
$data['configuracion']['inicio_ins'] = custom_date_format($data['configuracion']['inicio_ins'], '-', '/', array(2, 1, 0));
$data['configuracion']['cierre_ins'] = custom_date_format($data['configuracion']['cierre_ins'], '-', '/', array(2, 1, 0));
//echo $data['configuracion']['inicio_ins'];
$data['configuracion']['inicio_cur'] = custom_date_format($data['configuracion']['inicio_cur'], '-', '/', array(2, 1, 0));

$data['configuracion']['inicio_ins_ene_mar'] = custom_date_format($data['configuracion']['inicio_ins_ene_mar'], '-', '/', array(2, 1, 0));
$data['configuracion']['cierre_ins_ene_mar'] = custom_date_format($data['configuracion']['cierre_ins_ene_mar'], '-', '/', array(2, 1, 0));
$data['configuracion']['inicio_cur_ene_mar'] = custom_date_format($data['configuracion']['inicio_cur_ene_mar'], '-', '/', array(2, 1, 0));

$data['configuracion']['inicio_ins_abr_jun'] = custom_date_format($data['configuracion']['inicio_ins_abr_jun'], '-', '/', array(2, 1, 0));
$data['configuracion']['cierre_ins_abr_jun'] = custom_date_format($data['configuracion']['cierre_ins_abr_jun'], '-', '/', array(2, 1, 0));
$data['configuracion']['inicio_cur_abr_jun'] = custom_date_format($data['configuracion']['inicio_cur_abr_jun'], '-', '/', array(2, 1, 0));

$data['configuracion']['inicio_ins_jul_sep'] = custom_date_format($data['configuracion']['inicio_ins_jul_sep'], '-', '/', array(2, 1, 0));
$data['configuracion']['cierre_ins_jul_sep'] = custom_date_format($data['configuracion']['cierre_ins_jul_sep'], '-', '/', array(2, 1, 0));
$data['configuracion']['inicio_cur_jul_sep'] = custom_date_format($data['configuracion']['inicio_cur_jul_sep'], '-', '/', array(2, 1, 0));

$data['configuracion']['inicio_ins_oct_dic'] = custom_date_format($data['configuracion']['inicio_ins_oct_dic'], '-', '/', array(2, 1, 0));
$data['configuracion']['cierre_ins_oct_dic'] = custom_date_format($data['configuracion']['cierre_ins_oct_dic'], '-', '/', array(2, 1, 0));
$data['configuracion']['inicio_cur_oct_dic'] = custom_date_format($data['configuracion']['inicio_cur_oct_dic'], '-', '/', array(2, 1, 0));


switch ($configuracion['ciclo_esc']) {
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

// print_array($data);

// Request all users data

$users = array();
$con = db_con();
$query = $con->prepare("SELECT * FROM operador_mn");
$query->execute();
$users = $query->fetchAll();
$query->closeCursor();

recursive_unset_array($users, 'clave');

// print_array($users);

//Get all notificacions
$notifications = filter_notifications_by_date_and_status(get_active_notifications());
 // print_array($data);

// Request all custom templates

$plantillas = get_custom_templates();


//Llamando una vista
view('plantillas', compact('data', 'user', 'users', 'notifications', 'plantillas'));
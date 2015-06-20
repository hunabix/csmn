<?php
// Aquí irán todas las funciones

// Debug mode
if (DEBUG) {
	
	ini_set('display_errors', true);
	//error_reporting(E_ALL);
	error_reporting(E_ALL ^ E_DEPRECATED);
	
} else {
	
	ini_set('display_errors', false);

}

// Echo test
function echotest() {
	echo 'test';
}

function print_array($array = array()) {
	echo '<pre style="display:block;">'; print_r($array); echo '</pre>'; // PRINT_R
}

// Database connection
function db_con() {
	$con = new connection;
	$con = $con->getDb();
	return $con;
}

// READ RAW POST
function readRawPost($vars = array()) {
	// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
	// Instead, read raw POST data from the input stream. 
	$raw_post_data = file_get_contents('php://input');
	$raw_post_array = explode('&', $raw_post_data);
	foreach ($raw_post_array as $keyval) {
		$keyval = explode ('=', $keyval);
		if (count($keyval) == 2)
			$vars[$keyval[0]] = urldecode($keyval[1]);
	}
	return $vars;
}

// Fecha en array. Procesa una fecha en formato año, mes, día. El separador es obligatorio y puede ser cualquier símbolo.
function fecha_en_array($fecha_para_array) {
	if (strlen($fecha_para_array) == 10) {
		$fecha_en_array['ano'] = substr($fecha_para_array, -10, 4);
		$fecha_en_array['mes'] = substr($fecha_para_array, -5, 2);
		$fecha_en_array['mes_texto'] = mes_en_texto($fecha_en_array['mes']);
		$fecha_en_array['mes_texto_corto'] = mes_en_texto_corto($fecha_en_array['mes']);
		$fecha_en_array['dia'] = substr($fecha_para_array, -2, 2);
		return $fecha_en_array;
	} elseif (strlen($fecha_para_array) == 19) {
		$fecha_en_array['ano'] = substr($fecha_para_array, -19, 4);
		$fecha_en_array['mes'] = substr($fecha_para_array, -14, 2);
		$fecha_en_array['mes_texto'] = mes_en_texto($fecha_en_array['mes']);
		$fecha_en_array['mes_texto_corto'] = mes_en_texto_corto($fecha_en_array['mes']);
		$fecha_en_array['dia'] = substr($fecha_para_array, -11, 2);
		return $fecha_en_array;
	}
}

// Mes en texto corto. Convierte un número en formato 00 a el mes correspondiente.
function mes_en_texto_corto($num_mes) { 
  switch ($num_mes) {
    
	case "00": 	return "- -"; break;
	case "01": 	return "ene"; break;
    case "02": 	return "feb"; break;
	case "03": 	return "mar"; break;
    case "04": 	return "abr"; break;
	case "05": 	return "may"; break;
    case "06": 	return "jun"; break;
	case "07": 	return "jul"; break;
    case "08": 	return "ago"; break;
	case "09": 	return "sep"; break;
    case "10": 	return "oct"; break;
	case "11": 	return "nov"; break;
    case "12": 	return "dic"; break;
			
    }
	
}
//Mes en texto. Convierte un número en formato 00 a el mes correspondiente.
function mes_en_texto($num_mes) { 
  switch ($num_mes) {
    
	case "00": 	return "- -"; break;
	case "01": 	return "enero"; break;
    case "02": 	return "febrero"; break;
	case "03": 	return "marzo"; break;
    case "04": 	return "abril"; break;
	case "05": 	return "mayo"; break;
    case "06": 	return "junio"; break;
	case "07": 	return "julio"; break;
    case "08": 	return "agosto"; break;
	case "09": 	return "septiembre"; break;
    case "10": 	return "octubre"; break;
	case "11": 	return "noviembre"; break;
    case "12": 	return "diciembre"; break;
			
    }
	
}

// Obtiene las sugerencia que corresponda segun la temporada
function obten_sugerencia($temporada, $estatus){
	if ($temporada == 'Temporada A' || $temporada == 'Temporada B' || $temporada == 'Temporada C') {
		switch ($estatus) {
			case "Nuevo caso de seguimiento": return "Responder al interesado"; break;
			case "Nuevo caso de seguimiento INS": return ""; break;
			case "Se respondió al interesado": return "Enviar correo de información"; break;
			case "Correo de información enviado": return "Enviar correo de seguimiento"; break;
			case "Correo de seguimiento enviado": return "Enviar correo de inicio de cursos"; break;
			case "Correo de inicio de cursos enviado": return "Llamar al interesado"; break;			
			case "Se llamó al interesado": return "Enviar recordatorio de pago"; break;
			case "Recordatorio de pago enviado": return "Eviar caso a lista general"; break;
			case "Pago de Paypal realizado": return "Revisar operación e inscribir alumno"; break;
			case "Nota personalizada del operador": return ""; break;				
		}
	} else {
		switch ($estatus) {
			case "Nuevo caso de seguimiento": return "Responder al interesado"; break;
			case "Nuevo caso de seguimiento INS": return ""; break;
			case "Se respondió al interesado": return "Enviar correo de seguimiento"; break;
			case "Correo de información enviado": return "Enviar correo de seguimiento"; break;
			case "Correo de seguimiento enviado": return "Enviar correo de inicio de cursos"; break;
			case "Correo de inicio de cursos enviado": return "Llamar al interesado"; break;			
			case "Se llamó al interesado": return "Enviar recordatorio de pago"; break;
			case "Recordatorio de pago enviado": return "Eviar caso a lista general"; break;
			case "Pago de Paypal realizado": return "Revisar operación e inscribir alumno"; break;
			case "Nota personalizada del operador": return ""; break;					
		}
	}
}

// redirecciona al URL que se le pase por parámetro
function obten_temporada() {	
	$con = db_con();
	$query = $con->prepare('SELECT * FROM configuracion_cs WHERE ID = :id');
	$query->execute(array('id' => '1'));
	$data = $query->fetch();
	//print_array($data);
	//die;
	$query->closeCursor();
	return $data['temporada'];
}

// Get last interaction
function get_last_interaction($lead_id) {
	$con = db_con();
	
	$query = $con->prepare('SELECT * FROM interaccion_cs WHERE id_interesado = :id_interesado AND ultima = :ultima');
		$query->execute(array(
					'id_interesado' => $lead_id,
					'ultima' => TRUE,
				));
	$last_interaction = $query->fetch();
	
	$query->closeCursor();
	
	return $last_interaction;
}

// Get last interaction
function update_last_interaction($last_interaction_id, $lastId) {

	$con = db_con();

	//Unflag old last interaction
	$query = $con->prepare('UPDATE interaccion_cs SET ultima = :ultima WHERE ID = :ID');
	$query->execute(array(
		'ultima' => FALSE,
		'ID' => $last_interaction_id,
	));
	
	//Flag last interaction
	$query = $con->prepare('UPDATE interaccion_cs SET ultima = :ultima WHERE ID = :ID');
	$query->execute(array(
		'ultima' => TRUE,
		'ID' => $lastId,
	));
	
	$query->closeCursor();
}

// Remove from main list
function remove_from_main_list($lead_id) {

	$con = db_con();

	//Unflag old last interaction
	$query = $con->prepare('UPDATE interesado_cs SET activo = :activo WHERE ID = :ID');
	$query->execute(array(
		'activo' => 'No',
		'ID' => $lead_id,
	));
	
	$query->closeCursor();
}



//*******************OLD FUNCTIONS BELOW*******************************

// Confirma si la consulta se realizó con éxito
function confirm_query($result_set) {
	if (!$result_set) {
		die("Error en la consulta: " . mysql_error());
	}
}


// obtiene la lista de registros de usuarios
function obten_casos() {
	global $connection;
	$consulta = " SELECT *
						FROM interesado_cs
						WHERE activo = 'Si'
						ORDER BY recordatorio ASC";
						
	$usuarios_set = mysql_query($consulta, $connection);
	confirm_query($usuarios_set);
	return $usuarios_set;
}


// obtiene la lista de registros de usuarios
function obten_caso_x_id($id_interesado) {
	global $connection;
	$consulta = " SELECT *
						FROM interesado_cs
						WHERE ID = '$id_interesado'
						ORDER BY recordatorio ASC";
						
	$usuarios_set = mysql_query($consulta, $connection);
	confirm_query($usuarios_set);
	return $usuarios_set;
}



// obtiene la lista de registros de usuarios
function obten_utima_interaccion($id_interesado) {
	global $connection;
	$consulta = " SELECT *
						FROM interaccion_cs
						WHERE id_interesado = '$id_interesado'
						ORDER BY fecha DESC";
						
	$usuarios_set = mysql_query($consulta, $connection);
	confirm_query($usuarios_set);
	return $usuarios_set;
}

// obtiene todas las interacciones de un usuario
function obten_interacciones($id_interesado) {
	global $connection;
	$consulta = " SELECT *
						FROM interaccion_cs
						WHERE id_interesado = '$id_interesado'
						ORDER BY fecha DESC";
						
	$usuarios_set = mysql_query($consulta, $connection);
	confirm_query($usuarios_set);
	return $usuarios_set;
}


// obtiene la lista de operadoresw MN
function obten_operadores() {
	global $connection;
	$consulta = " SELECT *
						FROM operador_mn
						ORDER BY ID ASC";
						
	$operadores_set = mysql_query($consulta, $connection);
	confirm_query($operadores_set);
	return $operadores_set;
}

function obten_configuracion() {
	global $connection;
	$consulta = " SELECT *
			  FROM configuracion_cs
			  ORDER BY id DESC LIMIT 1";						
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
	$configuracion = mysql_fetch_array($resultado);
	return $configuracion;
}


// suma los días que se le especifiquen en el parametro $dias a la fecha especificada en el parametro $fecha actual
// si $rp(recordatorio personalizado) es falso y actualiza el recordatorio del caso
function sumar_dias_a_recordatorio($rp, $fecha_actual, $dias, $id) { 			
	// si el recordatorio actual no es personalizado
	if (!$rp) { 				
		// obtengo fecha actual en un formato apropiado
		$fecha_actual = substr($fecha_actual, 0, 11);
		// Sumo los días 
		list($year,$mon,$day) = explode('-',$fecha_actual);
		$recordatorio = date('Y-m-d',mktime(0,0,0,$mon,$day+$dias,$year));    
		// actualizo la BD con el nuevo recordatorio
		global $connection;
		$consulta = "UPDATE interesado_cs
					 SET recordatorio='$recordatorio'
					 WHERE id = '$id'";
		$resultado = mysql_query($consulta, $connection);
		confirm_query($resultado);
	}
}

// actualiza el recordatorio del caso de acuerdo a los parametros: temporada, estatus, fecha de la ultima interacción, id del caso, si el recordatorio no ha sido establecido por el operador MN
function actualiza_recordatorio($temporada, $tipo, $fecha, $id_interesado, $rec_pers) { 
switch ($temporada) {
				case "Temporada A": 
					switch ($tipo) {
						case "Nuevo caso de seguimiento": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;
						case "Se respondió al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 3, $id_interesado); break;
						case "Correo de información enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 21, $id_interesado); break;
						case "Correo de seguimiento enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 7, $id_interesado); break;
						case "Correo de inicio de cursos enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 9, $id_interesado);	break;			
						case "Se llamó al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 7, $id_interesado); break;
						case "Recordatorio de pago enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 10, $id_interesado); break;
						case "Pago de Paypal realizado": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;
					}
				break;
				case "Temporada B": 
					switch ($tipo) {
						case "Nuevo caso de seguimiento": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;
						case "Se respondió al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 3, $id_interesado); break;
						case "Correo de información enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 14, $id_interesado); break;
						case "Correo de seguimiento enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 5, $id_interesado); break;
						case "Correo de inicio de cursos enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 7, $id_interesado);	break;			
						case "Se llamó al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 7, $id_interesado); break;
						case "Recordatorio de pago enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 10, $id_interesado); break;
						case "Pago de Paypal realizado": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;						
					}
				break;
				case "Temporada C": 
					switch ($tipo) {	
						case "Nuevo caso de seguimiento": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;
						case "Se respondió al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 3, $id_interesado); break;
						case "Correo de información enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 7, $id_interesado); break;
						case "Correo de seguimiento enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 2, $id_interesado); break;
						case "Correo de inicio de cursos enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 4, $id_interesado);	break;			
						case "Se llamó al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 7, $id_interesado); break;
						case "Recordatorio de pago enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 10, $id_interesado); break;		
						case "Pago de Paypal realizado": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;												
					}
				break;
				case "Temporada D": 
					switch ($tipo) {					
						case "Nuevo caso de seguimiento": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;
						case "Se respondió al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 3, $id_interesado); break;
						case "Correo de información enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 3, $id_interesado); break;
						case "Correo de seguimiento enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 3, $id_interesado); break;
						case "Correo de inicio de cursos enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 3, $id_interesado);	break;			
						case "Se llamó al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 5, $id_interesado); break;
						case "Recordatorio de pago enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 10, $id_interesado); break;
						case "Pago de Paypal realizado": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;						
					}
				break;
				case "Temporada E": 
					switch ($tipo) {
						case "Nuevo caso de seguimiento": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;
						case "Se respondió al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 2, $id_interesado); break;
						case "Correo de información enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 2, $id_interesado); break;
						case "Correo de seguimiento enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 2, $id_interesado); break;
						case "Correo de inicio de cursos enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 3, $id_interesado);	break;			
						case "Se llamó al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 4, $id_interesado); break;
						case "Recordatorio de pago enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 10, $id_interesado); break;
						case "Pago de Paypal realizado": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;						
					}
				break;
				case "Temporada F": 
					switch ($tipo) {
						case "Nuevo caso de seguimiento": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;
						case "Se respondió al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 2, $id_interesado); break;
						case "Correo de información enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 2, $id_interesado); break;
						case "Correo de seguimiento enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 2, $id_interesado); break;
						case "Correo de inicio de cursos enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 3, $id_interesado);	break;			
						case "Se llamó al interesado": sumar_dias_a_recordatorio($rec_pers, $fecha, 4, $id_interesado); break;
						case "Recordatorio de pago enviado": sumar_dias_a_recordatorio($rec_pers, $fecha, 10, $id_interesado); break;
						case "Pago de Paypal realizado": sumar_dias_a_recordatorio($rec_pers, $fecha, 0, $id_interesado);	break;						
					}
				break;			
			}
}

function actualiza_recordatorio_manual($recordatorio, $id_interesado) {
	global $connection;
	$consulta = "UPDATE interesado_cs
				SET recordatorio = '$recordatorio',
					rec_pers = '1'
				WHERE ID = '$id_interesado'";
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
}


function imprime_paises() {
    echo'<option value="afganistan">Afganistán</option> 
    <option value="akrotiri">Akrotiri</option> 
    <option value="albania">Albania</option> 
    <option value="alemania">Alemania</option> 
    <option value="andorra">Andorra</option> 
    <option value="angola">Angola</option> 
    <option value="anguila">Anguila</option> 
    <option value="antartida">Antártida</option> 
    <option value="antigua+y+barbuda">Antigua y Barbuda</option> 
    <option value="antillas+neerlandesas">Antillas Neerlandesas</option> 
    <option value="arabia+saudi">Arabia Saudí</option> 
    <option value="arctic+ocean">Arctic Ocean</option> 
    <option value="argelia">Argelia</option> 
    <option value="argentina">Argentina</option> 
    <option value="armenia">Armenia</option> 
    <option value="aruba">Aruba</option> 
    <option value="ashmore+andcartier+islands">Ashmore andCartier Islands</option> 
    <option value="atlantic+ocean">Atlantic Ocean</option> 
    <option value="australia">Australia</option> 
    <option value="austria">Austria</option> 
    <option value="azerbaiyan">Azerbaiyán</option> 
    <option value="bahamas">Bahamas</option> 
    <option value="bahrain">Bahráin</option> 
    <option value="bangladesh">Bangladesh</option> 
    <option value="barbados">Barbados</option> 
    <option value="belgica">Bélgica</option> 
    <option value="belice">Belice</option> 
    <option value="benin">Benín</option> 
    <option value="bermudas">Bermudas</option> 
    <option value="bielorrusia">Bielorrusia</option> 
    <option value="birmania+myanmar">Birmania Myanmar</option> 
    <option value="bolivia">Bolivia</option> 
    <option value="bosnia+y+hercegovina">Bosnia y Hercegovina</option> 
    <option value="botsuana">Botsuana</option> 
    <option value="brasil">Brasil</option> 
    <option value="brunei">Brunéi</option> 
    <option value="bulgaria">Bulgaria</option> 
    <option value="burkina+faso">Burkina Faso</option> 
    <option value="burundi">Burundi</option> 
    <option value="butan">Bután</option> 
    <option value="cabo+verde">Cabo Verde</option> 
    <option value="camboya">Camboya</option> 
    <option value="camerun">Camerún</option> 
    <option value="canada">Canadá</option> 
    <option value="chad">Chad</option> 
    <option value="chile">Chile</option> 
    <option value="china">China</option> 
    <option value="chipre">Chipre</option> 
    <option value="clipperton+island">Clipperton Island</option> 
    <option value="colombia">Colombia</option> 
    <option value="comoras">Comoras</option> 
    <option value="congo">Congo</option> 
    <option value="coral+sea+islands">Coral Sea Islands</option> 
    <option value="corea+del+norte">Corea del Norte</option> 
    <option value="corea+del+sur">Corea del Sur</option> 
    <option value="costa+de+marfil">Costa de Marfil</option> 
    <option value="costa+rica">Costa Rica</option> 
    <option value="croacia">Croacia</option> 
    <option value="cuba">Cuba</option> 
    <option value="dhekelia">Dhekelia</option> 
    <option value="dinamarca">Dinamarca</option> 
    <option value="dominica">Dominica</option> 
    <option value="ecuador">Ecuador</option> 
    <option value="egipto">Egipto</option> 
    <option value="el+salvador">El Salvador</option> 
    <option value="el+vaticano">El Vaticano</option> 
    <option value="emiratos+%C1rabes+unidos">Emiratos Árabes Unidos</option> 
    <option value="eritrea">Eritrea</option> 
    <option value="eslovaquia">Eslovaquia</option> 
    <option value="eslovenia">Eslovenia</option> 
    <option value="espana">España</option> 
    <option value="estados+unidos">Estados Unidos</option> 
    <option value="estonia">Estonia</option> 
    <option value="etiopia">Etiopía</option> 
    <option value="filipinas">Filipinas</option> 
    <option value="finlandia">Finlandia</option> 
    <option value="fiyi">Fiyi</option> 
    <option value="francia">Francia</option> 
    <option value="gabon">Gabón</option> 
    <option value="gambia">Gambia</option> 
    <option value="gaza+strip">Gaza Strip</option> 
    <option value="georgia">Georgia</option> 
    <option value="ghana">Ghana</option> 
    <option value="gibraltar">Gibraltar</option> 
    <option value="granada">Granada</option> 
    <option value="grecia">Grecia</option> 
    <option value="groenlandia">Groenlandia</option> 
    <option value="guam">Guam</option> 
    <option value="guatemala">Guatemala</option> 
    <option value="guernsey">Guernsey</option> 
    <option value="guinea">Guinea</option> 
    <option value="guinea+ecuatorial">Guinea Ecuatorial</option> 
    <option value="guinea-bissau">Guinea-Bissau</option> 
    <option value="guyana">Guyana</option> 
    <option value="haiti">Haití</option> 
    <option value="honduras">Honduras</option> 
    <option value="hong+kong">Hong Kong</option> 
    <option value="hungria">Hungría</option> 
    <option value="india">India</option> 
    <option value="indian+ocean">Indian Ocean</option> 
    <option value="indonesia">Indonesia</option> 
    <option value="iran">Irán</option> 
    <option value="iraq">Iraq</option> 
    <option value="irlanda">Irlanda</option> 
    <option value="isla+bouvet">Isla Bouvet</option> 
    <option value="isla+christmas">Isla Christmas</option> 
    <option value="isla+norfolk">Isla Norfolk</option> 
    <option value="islandia">Islandia</option> 
    <option value="islas+caiman">Islas Caimán</option> 
    <option value="islas+cocos">Islas Cocos</option> 
    <option value="islas+cook">Islas Cook</option> 
    <option value="islas+feroe">Islas Feroe</option> 
    <option value="islas+georgia+del+sur+y+sandwich+del+sur">Islas Georgia del Sur y Sandwich del Sur</option> 
    <option value="islas+heard+y+mcdonald">Islas Heard y McDonald</option> 
    <option value="islas+malvinas">Islas Malvinas</option> 
    <option value="islas+marianas+del+norte">Islas Marianas del Norte</option> 
    <option value="islasmarshall">IslasMarshall</option> 
    <option value="islas+pitcairn">Islas Pitcairn</option> 
    <option value="islas+salomon">Islas Salomón</option> 
    <option value="islas+turcas+y+caicos">Islas Turcas y Caicos</option> 
    <option value="islas+virgenes+americanas">Islas Vírgenes Americanas</option> 
    <option value="islas+virgenes+britanicas">Islas Vírgenes Británicas</option> 
    <option value="israel">Israel</option> 
    <option value="italia">Italia</option> 
    <option value="jamaica">Jamaica</option> 
    <option value="jan+mayen">Jan Mayen</option> 
    <option value="japon">Japón</option> 
    <option value="jersey">Jersey</option> 
    <option value="jordania">Jordania</option> 
    <option value="kazajistan">Kazajistán</option> 
    <option value="kenia">Kenia</option> 
    <option value="kirguizistan">Kirguizistán</option> 
    <option value="kiribati">Kiribati</option> 
    <option value="kuwait">Kuwait</option> 
    <option value="laos">Laos</option> 
    <option value="lesoto">Lesoto</option> 
    <option value="letonia">Letonia</option> 
    <option value="libano">Líbano</option> 
    <option value="liberia">Liberia</option> 
    <option value="libia">Libia</option> 
    <option value="liechtenstein">Liechtenstein</option> 
    <option value="lituania">Lituania</option> 
    <option value="luxemburgo">Luxemburgo</option> 
    <option value="macao">Macao</option> 
    <option value="macedonia">Macedonia</option> 
    <option value="madagascar">Madagascar</option> 
    <option value="malasia">Malasia</option> 
    <option value="malaui">Malaui</option> 
    <option value="maldivas">Maldivas</option> 
    <option value="mali">Malí</option> 
    <option value="malta">Malta</option> 
    <option value="man%2C+isle+of">Man, Isle of</option> 
    <option value="marruecos">Marruecos</option> 
    <option value="mauricio">Mauricio</option> 
    <option value="mauritania">Mauritania</option> 
    <option value="mayotte">Mayotte</option> 
    <option value="México" selected>México</option> 
    <option value="micronesia">Micronesia</option> 
    <option value="moldavia">Moldavia</option> 
    <option value="monaco">Mónaco</option> 
    <option value="mongolia">Mongolia</option> 
    <option value="montserrat">Montserrat</option> 
    <option value="mozambique">Mozambique</option> 
    <option value="namibia">Namibia</option> 
    <option value="nauru">Nauru</option> 
    <option value="navassa+island">Navassa Island</option> 
    <option value="nepal">Nepal</option> 
    <option value="nicaragua">Nicaragua</option> 
    <option value="niger">Níger</option> 
    <option value="nigeria">Nigeria</option> 
    <option value="niue">Niue</option> 
    <option value="noruega">Noruega</option> 
    <option value="nueva+caledonia">Nueva Caledonia</option> 
    <option value="nueva+zelanda">Nueva Zelanda</option> 
    <option value="oman">Omán</option> 
    <option value="pacific+ocean">Pacific Ocean</option> 
    <option value="paises+bajos">Países Bajos</option> 
    <option value="pakistan">Pakistán</option> 
    <option value="palaos">Palaos</option> 
    <option value="panama">Panamá</option> 
    <option value="papua-nueva+guinea">Papúa-Nueva Guinea</option> 
    <option value="paracel+islands">Paracel Islands</option> 
    <option value="paraguay">Paraguay</option> 
    <option value="peru">Perú</option> 
    <option value="polinesia+francesa">Polinesia Francesa</option> 
    <option value="polonia">Polonia</option> 
    <option value="portugal">Portugal</option> 
    <option value="puerto+rico">Puerto Rico</option> 
    <option value="qatar">Qatar</option> 
    <option value="reino+unido">Reino Unido</option> 
    <option value="republica+centroafricana">República Centroafricana</option> 
    <option value="republica+checa">República Checa</option> 
    <option value="republica+democratica+del+congo">República Democrática del Congo</option> 
    <option value="republica+dominicana">República Dominicana</option> 
    <option value="ruanda">Ruanda</option> 
    <option value="rumania">Rumania</option> 
    <option value="rusia">Rusia</option> 
    <option value="sahara+occidental">Sáhara Occidental</option> 
    <option value="samoa">Samoa</option> 
    <option value="samoa+americana">Samoa Americana</option> 
    <option value="san+cristobal+y+nieves">San Cristóbal y Nieves</option> 
    <option value="san+marino">San Marino</option> 
    <option value="san+pedro+y+miquelon">San Pedro y Miquelón</option> 
    <option value="san+vicente+y+las+granadinas">San Vicente y las Granadinas</option> 
    <option value="santa+helena">Santa Helena</option> 
    <option value="santa+lucia">Santa Lucía</option> 
    <option value="santo+tome+y+principe">Santo Tomé y Príncipe</option> 
    <option value="senegal">Senegal</option> 
    <option value="seychelles">Seychelles</option> 
    <option value="sierra+leona">Sierra Leona</option> 
    <option value="singapur">Singapur</option> 
    <option value="siria">Siria</option> 
    <option value="somalia">Somalia</option> 
    <option value="southern+ocean">Southern Ocean</option> 
    <option value="spratly+islands">Spratly Islands</option> 
    <option value="sri+lanka">Sri Lanka</option> 
    <option value="suazilandia">Suazilandia</option> 
    <option value="sudafrica">Sudáfrica</option> 
    <option value="sudan">Sudán</option> 
    <option value="suecia">Suecia</option> 
    <option value="suiza">Suiza</option> 
    <option value="surinam">Surinam</option> 
    <option value="svalbard+y+jan+mayen">Svalbard y Jan Mayen</option> 
    <option value="tailandia">Tailandia</option> 
    <option value="taiwan">Taiwán</option> 
    <option value="tanzania">Tanzania</option> 
    <option value="tayikistan">Tayikistán</option> 
    <option value="territoriobritanicodel+oceano+indico">TerritorioBritánicodel Océano Indico</option> 
    <option value="territorios+australes+franceses">Territorios Australes Franceses</option> 
    <option value="timor+oriental">Timor Oriental</option> 
    <option value="togo">Togo</option> 
    <option value="tokelau">Tokelau</option> 
    <option value="tonga">Tonga</option> 
    <option value="trinidad+y+tobago">Trinidad y Tobago</option> 
    <option value="tunez">Túnez</option> 
    <option value="turkmenistan">Turkmenistán</option> 
    <option value="turquia">Turquía</option> 
    <option value="tuvalu">Tuvalu</option> 
    <option value="ucrania">Ucrania</option> 
    <option value="uganda">Uganda</option> 
    <option value="union+europea">Unión Europea</option> 
    <option value="uruguay">Uruguay</option> 
    <option value="uzbekistan">Uzbekistán</option> 
    <option value="vanuatu">Vanuatu</option> 
    <option value="venezuela">Venezuela</option> 
    <option value="vietnam">Vietnam</option> 
    <option value="wake+island">Wake Island</option> 
    <option value="wallis+y+futuna">Wallis y Futuna</option> 
    <option value="west+bank">West Bank</option> 
    <option value="world">World</option> 
    <option value="yemen">Yemen</option> 
    <option value="yibuti">Yibuti</option> 
    <option value="zambia">Zambia</option> 
    <option value="zimbabue">Zimbabue</option>'; 
}
function imprime_paises_2() {
    echo'<option value="Afganistán">Afganistán</option> 
    <option value="Akrotiri">Akrotiri</option> 
    <option value="Albania">Albania</option> 
    <option value="Alemania">Alemania</option> 
    <option value="Andorra">Andorra</option> 
    <option value="Angola">Angola</option> 
    <option value="Anguila">Anguila</option> 
    <option value="Antártida">Antártida</option> 
    <option value="Antigua y Barbuda">Antigua y Barbuda</option> 
    <option value="Antillas Neerlandesas">Antillas Neerlandesas</option> 
    <option value="Arabia Saudí">Arabia Saudí</option> 
    <option value="Arctic Ocean">Arctic Ocean</option> 
    <option value="Argelia">Argelia</option> 
    <option value="Argentina">Argentina</option> 
    <option value="Armenia">Armenia</option> 
    <option value="Aruba">Aruba</option> 
    <option value="Ashmore and Cartier Islands">Ashmore and Cartier Islands</option> 
    <option value="Atlantic Ocean">Atlantic Ocean</option> 
    <option value="Australia">Australia</option> 
    <option value="Austria">Austria</option> 
    <option value="Azerbaiyan">Azerbaiyán</option> 
    <option value="Bahamas">Bahamas</option> 
    <option value="Bahráin">Bahráin</option> 
    <option value="Bangladesh">Bangladesh</option> 
    <option value="Barbados">Barbados</option> 
    <option value="Bélgica">Bélgica</option> 
    <option value="Belice">Belice</option> 
    <option value="Benín">Benín</option> 
    <option value="Bermudas">Bermudas</option> 
    <option value="Bielorrusia">Bielorrusia</option> 
    <option value="Birmania Myanmar">Birmania Myanmar</option> 
    <option value="Bolivia">Bolivia</option> 
    <option value="Bosnia y Hercegovina">Bosnia y Hercegovina</option> 
    <option value="Botsuana">Botsuana</option> 
    <option value="Brasil">Brasil</option> 
    <option value="Brunei">Brunéi</option> 
    <option value="Bulgaria">Bulgaria</option> 
    <option value="Burkina Faso">Burkina Faso</option> 
    <option value="Burundi">Burundi</option> 
    <option value="Bután">Bután</option> 
    <option value="Cabo Verde">Cabo Verde</option> 
    <option value="Camboya">Camboya</option> 
    <option value="Camerún">Camerún</option> 
    <option value="Canadá">Canadá</option> 
    <option value="Chad">Chad</option> 
    <option value="Chile">Chile</option> 
    <option value="China">China</option> 
    <option value="Chipre">Chipre</option> 
    <option value="Clipperton Island">Clipperton Island</option> 
    <option value="Colombia">Colombia</option> 
    <option value="Comoras">Comoras</option> 
    <option value="Congo">Congo</option> 
    <option value="Coral Sea Islands">Coral Sea Islands</option> 
    <option value="Corea del Norte">Corea del Norte</option> 
    <option value="Corea del Sur">Corea del Sur</option> 
    <option value="Costa de Marfil">Costa de Marfil</option> 
    <option value="Costa Rica">Costa Rica</option> 
    <option value="Croacia">Croacia</option> 
    <option value="Cuba">Cuba</option> 
    <option value="Dhekelia">Dhekelia</option> 
    <option value="Dinamarca">Dinamarca</option> 
    <option value="Dominica">Dominica</option> 
    <option value="Ecuador">Ecuador</option> 
    <option value="Egipto">Egipto</option> 
    <option value="El Salvador">El Salvador</option> 
    <option value="El Vaticano">El Vaticano</option> 
    <option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option> 
    <option value="Eritrea">Eritrea</option> 
    <option value="Eslovaquia">Eslovaquia</option> 
    <option value="Eslovenia">Eslovenia</option> 
    <option value="España">España</option> 
    <option value="Estados Unidos">Estados Unidos</option> 
    <option value="Estonia">Estonia</option> 
    <option value="Etiopia">Etiopía</option> 
    <option value="Eilipinas">Filipinas</option> 
    <option value="Einlandia">Finlandia</option> 
    <option value="Eiyi">Fiyi</option> 
    <option value="Francia">Francia</option> 
    <option value="Gabón">Gabón</option> 
    <option value="Gambia">Gambia</option> 
    <option value="Gaza Strip">Gaza Strip</option> 
    <option value="Georgia">Georgia</option> 
    <option value="Ghana">Ghana</option> 
    <option value="Gibraltar">Gibraltar</option> 
    <option value="Granada">Granada</option> 
    <option value="Grecia">Grecia</option> 
    <option value="Groenlandia">Groenlandia</option> 
    <option value="Guam">Guam</option> 
    <option value="Guatemala">Guatemala</option> 
    <option value="Guernsey">Guernsey</option> 
    <option value="Guinea">Guinea</option> 
    <option value="Guinea Ecuatorial">Guinea Ecuatorial</option> 
    <option value="Guinea-Bissau">Guinea-Bissau</option> 
    <option value="Guyana">Guyana</option> 
    <option value="Haiti">Haití</option> 
    <option value="Honduras">Honduras</option> 
    <option value="Hong Kong">Hong Kong</option> 
    <option value="Hungría">Hungría</option> 
    <option value="India">India</option> 
    <option value="Indian Ocean">Indian Ocean</option> 
    <option value="Indonesia">Indonesia</option> 
    <option value="Irán">Irán</option> 
    <option value="Iraq">Iraq</option> 
    <option value="Irlanda">Irlanda</option> 
    <option value="Isla Bouvet">Isla Bouvet</option> 
    <option value="Isla Christmas">Isla Christmas</option> 
    <option value="Isla Norfolk">Isla Norfolk</option> 
    <option value="Islandia">Islandia</option> 
    <option value="Islas Caimán">Islas Caimán</option> 
    <option value="Islas Cocos">Islas Cocos</option> 
    <option value="Islas Cook">Islas Cook</option> 
    <option value="Islas Feroe">Islas Feroe</option> 
    <option value="Islas Georgia del Sur y Sandwich del Sur">Islas Georgia del Sur y Sandwich del Sur</option> 
    <option value="Islas Heard y McDonald">Islas Heard y McDonald</option> 
    <option value="Islas Malvinas">Islas Malvinas</option> 
    <option value="Islas Marianas del Norte">Islas Marianas del Norte</option> 
    <option value="IslasMarshall">IslasMarshall</option> 
    <option value="Islas Pitcairn">Islas Pitcairn</option> 
    <option value="Islas Salomón">Islas Salomón</option> 
    <option value="Islas Turcas y Caicos">Islas Turcas y Caicos</option> 
    <option value="Islas Vírgenes Americanas">Islas Vírgenes Americanas</option> 
    <option value="Islas Vírgenes Británicas">Islas Vírgenes Británicas</option> 
    <option value="Israel">Israel</option> 
    <option value="Italia">Italia</option> 
    <option value="Jamaica">Jamaica</option> 
    <option value="Jan Mayen">Jan Mayen</option> 
    <option value="Japón">Japón</option> 
    <option value="Jersey">Jersey</option> 
    <option value="Jordania">Jordania</option> 
    <option value="Kazajistán">Kazajistán</option> 
    <option value="Kenia">Kenia</option> 
    <option value="Kirguizistan">Kirguizistán</option> 
    <option value="Kiribati">Kiribati</option> 
    <option value="Kuwait">Kuwait</option> 
    <option value="Laos">Laos</option> 
    <option value="Lesoto">Lesoto</option> 
    <option value="Letonia">Letonia</option> 
    <option value="Líbano">Líbano</option> 
    <option value="Liberia">Liberia</option> 
    <option value="Libia">Libia</option> 
    <option value="Liechtenstein">Liechtenstein</option> 
    <option value="Lituania">Lituania</option> 
    <option value="Luxemburgo">Luxemburgo</option> 
    <option value="Macao">Macao</option> 
    <option value="Macedonia">Macedonia</option> 
    <option value="Madagascar">Madagascar</option> 
    <option value="Malasia">Malasia</option> 
    <option value="Malaui">Malaui</option> 
    <option value="Maldivas">Maldivas</option> 
    <option value="Malí">Malí</option> 
    <option value="Malta">Malta</option> 
    <option value="Man%2C Isle of">Man, Isle of</option> 
    <option value="Marruecos">Marruecos</option> 
    <option value="Mauricio">Mauricio</option> 
    <option value="Mauritania">Mauritania</option> 
    <option value="Mayotte">Mayotte</option> 
    <option value="México">México</option> 
    <option value="Micronesia">Micronesia</option> 
    <option value="Moldavia">Moldavia</option> 
    <option value="Mónaco">Mónaco</option> 
    <option value="Mongolia">Mongolia</option> 
    <option value="Montserrat">Montserrat</option> 
    <option value="Mozambique">Mozambique</option> 
    <option value="Namibia">Namibia</option> 
    <option value="Nauru">Nauru</option> 
    <option value="Navassa Island">Navassa Island</option> 
    <option value="Nepal">Nepal</option> 
    <option value="Nicaragua">Nicaragua</option> 
    <option value="Níger">Níger</option> 
    <option value="Nigeria">Nigeria</option> 
    <option value="Niue">Niue</option> 
    <option value="Noruega">Noruega</option> 
    <option value="Nueva Caledonia">Nueva Caledonia</option> 
    <option value="Nueva Zelanda">Nueva Zelanda</option> 
    <option value="Omán">Omán</option> 
    <option value="Pacific Ocean">Pacific Ocean</option> 
    <option value="Países Bajos">Países Bajos</option> 
    <option value="Pakistán">Pakistán</option> 
    <option value="Palaos">Palaos</option> 
    <option value="Panamá">Panamá</option> 
    <option value="Papúa-Nueva Guinea">Papúa-Nueva Guinea</option> 
    <option value="Paracel Islands">Paracel Islands</option> 
    <option value="Paraguay">Paraguay</option> 
    <option value="Perú">Perú</option> 
    <option value="Polinesia Francesa">Polinesia Francesa</option> 
    <option value="Polonia">Polonia</option> 
    <option value="Portugal">Portugal</option> 
    <option value="Puerto Rico">Puerto Rico</option> 
    <option value="Qatar">Qatar</option> 
    <option value="Reino Unido">Reino Unido</option> 
    <option value="República Centroafricana">República Centroafricana</option> 
    <option value="República Checa">República Checa</option> 
    <option value="República Democrática del Congo">República Democrática del Congo</option> 
    <option value="República Dominicana">República Dominicana</option> 
    <option value="Ruanda">Ruanda</option> 
    <option value="Rumania">Rumania</option> 
    <option value="Rusia">Rusia</option> 
    <option value="Sáhara Occidental">Sáhara Occidental</option> 
    <option value="Samoa">Samoa</option> 
    <option value="Samoa Americana">Samoa Americana</option> 
    <option value="San Cristóbal y Nieves">San Cristóbal y Nieves</option> 
    <option value="san+marino">San Marino</option> 
    <option value="San Pedro y Miquelón">San Pedro y Miquelón</option> 
    <option value="San Vicente y las Granadinas">San Vicente y las Granadinas</option> 
    <option value="Santa Helena">Santa Helena</option> 
    <option value="Santa Lucía">Santa Lucía</option> 
    <option value="Santo Tomé y Príncipe">Santo Tomé y Príncipe</option> 
    <option value="Senegal">Senegal</option> 
    <option value="Seychelles">Seychelles</option> 
    <option value="Sierra Leona">Sierra Leona</option> 
    <option value="Singapur">Singapur</option> 
    <option value="Siria">Siria</option> 
    <option value="Somalia">Somalia</option> 
    <option value="Southern Ocean">Southern Ocean</option> 
    <option value="Spratly Islands">Spratly Islands</option> 
    <option value="Sri Lanka">Sri Lanka</option> 
    <option value="Suazilandia">Suazilandia</option> 
    <option value="Sudáfrica">Sudáfrica</option> 
    <option value="Sudán">Sudán</option> 
    <option value="Suecia">Suecia</option> 
    <option value="Suiza">Suiza</option> 
    <option value="Surinam">Surinam</option> 
    <option value="Svalbard y Jan Mayen">Svalbard y Jan Mayen</option> 
    <option value="Tailandia">Tailandia</option> 
    <option value="Taiwán">Taiwán</option> 
    <option value="Tanzania">Tanzania</option> 
    <option value="Tayikistán">Tayikistán</option> 
    <option value="TerritorioBritánicodel Océano Indico">TerritorioBritánicodel Océano Indico</option> 
    <option value="Territorios Australes Franceses">Territorios Australes Franceses</option> 
    <option value="Timor Oriental">Timor Oriental</option> 
    <option value="Togo">Togo</option> 
    <option value="Tokelau">Tokelau</option> 
    <option value="Tonga">Tonga</option> 
    <option value="Trinidad y Tobago">Trinidad y Tobago</option> 
    <option value="Túnez">Túnez</option> 
    <option value="Turkmenistán">Turkmenistán</option> 
    <option value="Turquía">Turquía</option> 
    <option value="Tuvalu">Tuvalu</option> 
    <option value="Ucrania">Ucrania</option> 
    <option value="Uganda">Uganda</option> 
    <option value="Unión Europea">Unión Europea</option> 
    <option value="Uruguay">Uruguay</option> 
    <option value="Uzbekistán">Uzbekistán</option> 
    <option value="Vanuatu">Vanuatu</option> 
    <option value="Venezuela">Venezuela</option> 
    <option value="Vietnam">Vietnam</option> 
    <option value="Wake Island">Wake Island</option> 
    <option value="Wallis y Futuna">Wallis y Futuna</option> 
    <option value="West Bank">West Bank</option> 
    <option value="World">World</option> 
    <option value="Yemen">Yemen</option> 
    <option value="Yibuti">Yibuti</option> 
    <option value="Zambia">Zambia</option> 
    <option value="Zimbabue">Zimbabue</option>'; 
}

// obtiene la lista de registros de usuarios que se inscribieron
function obten_casos_inactivos() {
	global $connection;
	$consulta = " SELECT *
						FROM interesado_cs
						WHERE interesado_cs.activo = 'No' 
						ORDER BY recordatorio ASC";
						
	$usuarios_set = mysql_query($consulta, $connection);
	confirm_query($usuarios_set);
	return $usuarios_set;
}

?> 
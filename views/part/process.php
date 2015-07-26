<?php 
if (isset($_POST['formulario'])) {


	/* MAGFORM pruebas de envío
	---------------------------------------------------------------------------------- */
	// $regresa['formulario'] = $_POST['formulario'];
	// $regresa['mensaje'] = '¡todo chido!';
	// $regresa['tipo_accion'] = $_POST['tipo-accion-mag'];
	// $regresa['prioridad'] = $_POST['prioridad-mag'];
	// $regresa['fecha_recordatorio'] = $_POST['fecha-recordatorio-mag'];
	// $regresa['recordatorio'] = $_POST['recordatorio-mag'];
	// $regresa['fecha_recordatorio_reserva'] = $_POST['fecha-recordatorio-reserva-mag'];
	// $regresa['ciclo_reserva'] = $_POST['ciclo-reserva-mag'];
	// $regresa['comentario_reserva'] = $_POST['comentario-reserva-mag'];

	/* CONFIGURACIÓN pruebas de envío
	---------------------------------------------------------------------------------- */
	$regresa['formulario'] = $_POST['formulario'];
	$regresa['mensaje'] = '¡todo chido!';
	$regresa['usuario_id'] = $_POST['usuario-id'];
	$regresa['tipo_accion'] = $_POST['tipo-accion'];
	$regresa['username'] = $_POST['username'];
	$regresa['nombre'] = $_POST['nombre'];
	$regresa['email'] = $_POST['email'];
	$regresa['clave'] = $_POST['clave'];
	$regresa['tipo'] = $_POST['tipo'];
	

	// Impresión de parametros para testing
	echo json_encode($regresa, JSON_UNESCAPED_UNICODE);

} else {

	echo '<h2>Llego por otro lado</h2>';
}





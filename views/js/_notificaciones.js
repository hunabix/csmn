/* --------------------------------------------- */
/* --------------[NOTIFICACIONES]--------------- */
/* --------------------------------------------- */

/* Toggle Button 
------------------------ */
$( ".Notificaciones-toggleBtn").click(function() {
    $( "#notificaciones" ).toggleClass('is-hidden');
});


/* Acciones 
------------------------ */
// Nueva notificación
$( "#notificacion-nueva").click(function() {
    // Datos del modal
    $( "#notificacion-titulo-modal").html('Crear una nueva notificación');
    var nuevaNotificaconBtn = '';
    nuevaNotificaconBtn =  nuevaNotificaconBtn + '<button  id="modal-notificacion-crear" class="Notificaciones-formCrear btn btn-primary" type="submit">'; 
        nuevaNotificaconBtn = nuevaNotificaconBtn + '<i class="fa fa-check"></i> Crear nueva notificación';
    nuevaNotificaconBtn = nuevaNotificaconBtn.concat( '</button>' );   
    $( "#notificacion-acciones-btns" ).html( nuevaNotificaconBtn );
    // Datos del formulario
    $( "#notificacion-fecha" ).val( "" );
    $( "#notificacion-titulo" ).val( "" );
    $( "#notificacion-descripcion" ).val( "" );
    $( "#notificacion-tipo-accion" ).val( "crear_notificacion" );
});
// Editar preparo modal
$( ".notice").click(function() {
    // Datos del modal
    $( "#notificacion-titulo-modal").html('Modificar notificación');
    // Datos del formulario
    var notificacionId = $(this).closest('.Notificaciones-notificacion').attr('id');
    var descripcion = $(this).attr('desc');
    var titulo = $(this).attr('titulo');
    var fecha = $(this).attr('fecha');
    var tipo = $(this).attr('tipo');
    $( "#notificacion-id" ).val( notificacionId );
    $( "#notificacion-fecha" ).val( fecha );
    $( "#notificacion-titulo" ).val( titulo );
    $( "#notificacion-descripcion" ).val( descripcion );

    // console.log(tipo);
    // if( $( "#notificacion-tipo-op2" ).val() == tipo) {
    //     console.log('Si es llamada');
    //     $( "#notificacion-tipo-op2" ).attr('selected', 'selected');
    //     $( "#notificacion-tipo-op1" ).removeAttr("selected");
    // } else {
    //     console.log('Es regular');
    //     $( "#notificacion-tipo-op1" ).attr('selected', 'selected');
    //     $( "#notificacion-tipo-op2").removeAttr("selected");
    // }



    // $( "#notificacion-tipo option" ).each(function() {
    //     if($(this).val() == tipo) {
    //         $(this).attr('selected', 'selected');
    //     }
    // });
});
// Eliminar notificacion
$( "#modal-notificacion-eliminar").click(function(e) {
    e.preventDefault();
    $( "#notificacion-tipo-accion" ).val( "eliminar_notificacion" );
    $( "#notificaciones-form" ).submit();
});
// Modificar notificacion
$( "#modal-notificacion-editar").click(function(e) {
    e.preventDefault();
    $( "#notificacion-tipo-accion" ).val( "editar_notificacion" );
    $( "#notificaciones-form" ).submit();
});
// Completar notificacion
$( "#modal-notificacion-completar").click(function(e) {
    e.preventDefault();
    $( "#notificacion-tipo-accion" ).val( "completar_notificacion" );
    $( "#notificaciones-form" ).submit();
});

/* AJAX 
------------------------------- */
$("#notificaciones-form").on("submit", function(e){
    e.preventDefault();
    $.ajax({
        data: $("#notificaciones-form").serialize(),
        //Cambiar a type: POST si necesario
        type: "POST",
        // Formato de datos que se espera en la respuesta
        dataType: "json",
        // URL a la que se enviará la solicitud Ajax
        //url: "views/part/process.php", 
        url: "controllers/procesar.php",
    })
    .done(function( data, textStatus, jqXHR ) {
        console.log( "La solicitud se ha completado correctamente." );
        console.log( data );
        
        /* RESULTADOS DE ACCIONES
        ------------------------------- */
        // Editar notificacion
        if ( data.tipo_accion == "editar_notificacion")
        {
            document.location.reload();
            // $( '#alerta-exito' ).html( data.mensaje );
            // notificacion = $('#' + data.ID);
            // notificacion.find( ".Notificaciones-notificacionTitulo" ).html( data.titulo );
            // notificacion.find( ".Notificaciones-notificacionDescripcion" ).attr( "title", "Beijing Brush Seller" );
            // notificacion.find( ".correo" ).html( data.email );
            // notificacion.find( ".tipo" ).html( data.tipo );
            $('.modal').modal('hide');
        }
        // Eliminar notificacion
        if ( data.tipo_accion == "eliminar_notificacion")
        {
            $( '#alerta-exito' ).html( data.mensaje );
            notificacion = $('#' + data.ID);
            notificacion.remove( );
            $('.modal').modal('hide');
        }
        // Completar notificacion
        if ( data.tipo_accion == "completar_notificacion")
        {
            $( '#alerta-exito' ).html( data.mensaje );
            notificacion = $('#' + data.ID);
            notificacion.remove( '' );
            $('.modal').modal('hide');
        }
        // Crear notificacion
        if ( data.tipo_accion == "crear_notificacion")
        {
            document.location.reload();
            //$( '#alerta-exito' ).html( data.mensaje );
            //var notificacion = '';           
            //notificacion =  notificacion + '<div id=" ' +  data.usuario_id + '" class="user">';              
            //    otificacion =  notificacion + 'hola';
            //notificacion = notificacion.concat( '</div>' );   
            //$( "#user-list" ).append(notificacion);
        }

        //  CIERRE DE LAS ACCIONES
        // Cierro todos los modales activos
        if ( data.tipo-accion != "solicitar-datos" ) 
        {
            $('.modal').modal('hide');
            // muestro el mensaje de éxito
            $('#alerta-exito').addClass('muestra');
            // Retiro el mensaje de éxito
            setTimeout(function () { 
                $('#alerta-exito').removeClass('muestra');
            }, 1200);  
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
         if ( console && console.log ) {
             console.log( "La solicitud a fallado: " +  textStatus);
         }
         $('#trace-block .datos').html("La solicitud a fallado: " +  textStatus);
         $('.contenido').css( "display", "block" ); 
         $('.modal').modal('hide');
    });
});
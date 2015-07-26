/* --------------------------------------------- */
/* ------------------[MAGFORM]------------------ */
/* --------------------------------------------- */

/* ACCIONES
------------------------------- */
// Enviar mensaje
$( "#mensaje-mag" ).click(function() {
    $( ".leadcheck" ).attr( "form" , "em-mag-form" );
    $( "#em-mag-form" ).submit();
});
// Agregar nota
$( "#nota-mag").click(function() {
    $( "#tipo-accion-mag" ).val( "agregar-nota" );
    $( "#es-llamada-mag" ).css( "display", "block" );
    $( "#titulo-modal-multi-mag").html('Agregar nota personalizada');
});
// Agregar recordatorio
$( "#mag-reminder-btn").click(function( e ) {
    e.preventDefault();
    $( "#tipo-accion-mag" ).val( "recordatorio" );
    $( "#mag-form" ).submit();
});
// Enviar a lista general
$( "#lista-mag").click(function() {
    $( "#tipo-accion-mag" ).val( "lista-general" );
    $( "#titulo-modal-multi-mag").html('Enviar a lista general');
    $( "#es-llamada-mag" ).css( "display", "none" );
});
// Reservar
$( "#reservar-mag").click(function() {
    $( "#tipo-accion-mag" ).val( "reservar" );
});
// Eliminar
$( "#eliminar-mag").click(function() {
    $( "#tipo-accion-mag" ).val( "eliminar" );
});

/* AJAX 
------------------------------- */
$("#mag-form").on("submit", function(e){
    e.preventDefault();
    $.ajax({
        data: $("#mag-form").serialize(),
        //Cambiar a type: POST si necesario
        type: "POST",
        // Formato de datos que se espera en la respuesta
        dataType: "json",
        // URL a la que se enviará la solicitud Ajax
        // url: "views/part/process.php", 
        url: "controllers/procesar.php",
    })
    .done(function( data, textStatus, jqXHR ) {
        console.log( "La solicitud se ha completado correctamente." );
        console.log( data );
        
        /* RESULTADOS DE ACCIONES
        ------------------------------- */
        // Agregar nota
        $( '#alerta-exito' ).html( data.mensaje );
        document.location.reload(); 
        
        //  CIERRE DE LAS ACCIONES
        // Cierro todos los modales activos
        $('.modal').modal('hide');
        // muestro el mensaje de éxito
        $('#alerta-exito').addClass('muestra');
        // Retiro el mensaje de éxito
        setTimeout(function () { 
            $('#alerta-exito').removeClass('muestra');
        }, 1200);  
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

/* --------------------------------------------- */
/* --------------[CONFIGURACION]---------------- */
/* --------------------------------------------- */

/* FECHAS
--------------------------------------------- */
// select en ciclo escolar, elijo la opción que corresponda a la configuración en BD
if(!($('#ciclo-esc-conf').length == 0)) {
    cicloEscolarConf = $( "#ciclo-esc-conf" ).attr( "seleccionado" );
    $('#ciclo-esc-conf option').each(function() {
        if($(this).val() == cicloEscolarConf) {
            $(this).attr('selected', 'selected');
        }
    });
}

/* USUARIOS
--------------------------------------------- */

/* Acciones 
------------------------ */
// Nuevo usuario
$( "#nuevo-usuario").click(function() {
    $( "#usuario-tipo-accion" ).val( "crear-usuario" );
    $( "#titulo-modal-usuario").html('Agregar nuevo usuario');
    $( "#modal-usuario-submit" ).html('Agregar nuevo usuario');
});

// Solicitar datos de prospecto
$( ".editar-usuario" ).click(function() {
    var userId = $(this).closest('.user').attr('id');
    $( "#usuario-tipo-accion" ).val( "solicitar-datos" );
    $( "#titulo-modal-usuario").html('Editar datos de usuario');
    $( "#modal-usuario-submit" ).html('Editar datos de usuario');
    $( "#usuario-id" ).val( userId );
    $( "#usuarios-form" ).submit();
});


/* AJAX 
------------------------------- */
$("#usuarios-form").on("submit", function(e){
    e.preventDefault();
    $.ajax({
        data: $("#usuarios-form").serialize(),
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
      
        // Nuevo usuario
        if ( data.tipo_accion == "crear-usuario")
        {
            $( '#alerta-exito' ).html( data.mensaje );
        }

        //  CIERRE DE LAS ACCIONES
        // Cierro todos los modales activos
        if ( data.tipo_accion != "solicitar-datos" ) 
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

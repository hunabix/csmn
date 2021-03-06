
$("#acordeon-historial").children().click(function (e) {
    if ($(e.currentTarget).siblings().children(".collapsing").length > 0 ) {
        return false;
    }
})


/* DATE PICKERS
--------------------------------------------- */

// Activo datepicker para el campo en mag-form
$('#mag-date').datepicker({
    weekStart:1,
    format: 'yyyy/mm/dd',
    color: 'green'
});
// Activo datepicker para el campo en mag-form
$('#fecha-reserva').datepicker({
    weekStart:1,
    format: 'yyyy/mm/dd',
    color: 'green'
});
// datepicker para el modal de recordatorio
$('#fecha-recordatorio').datepicker({
    weekStart:1,
    format: 'yyyy/mm/dd',
    color: 'green'

});
/* LEADS
--------------------------------------------- */
// Muestra los iconos correspondientes al cargar o recargar la página
$("input:checked + .check-icon").addClass('fa-check-square-o');
$("input:checked + .check-icon").removeClass('fa-square-o');
$("input:not(:checked) + .check-icon").addClass('fa-square-o');
$("input:not(:checked) + .check-icon").removeClass('fa-check-square-o');

// Activo script para multiple selección de checkboxs en #leads
$(function() {
    $('#leads-form').tshift();
});

// Script del boton para deseleccionar todos los checkboxs de #leads
$( "#uncheck-all" ).click(function( event ) {
    event.preventDefault();
    $('.check').prop('checked', false); // Unchecks it
    $("input:not(:checked) + .check-icon").addClass('fa-square-o');
    $("input:not(:checked) + .check-icon").removeClass('fa-check-square-o');
});


/* GENERAL
------------------------------- */
// Script que cambia el icono de los checkbox seleccionados o deseleccionados
$('input[type=checkbox]').change(function(){
    $("input:checked + .check-icon").addClass('fa-check-square-o');
    $("input:checked + .check-icon").removeClass('fa-square-o');
    $("input:not(:checked) + .check-icon").addClass('fa-square-o');
    $("input:not(:checked) + .check-icon").removeClass('fa-check-square-o');
});
// Script que cambia el icono de los radio seleccionados o deseleccionados
$('input[type=radio]').change(function(){
    $("input:checked + .radio-icon").addClass('fa-dot-circle-o');
    $("input:checked + .radio-icon").removeClass('fa-circle-o ');
    $("input:not(:checked) + .radio-icon").addClass('fa-circle-o ');
    $("input:not(:checked) + .radio-icon").removeClass('fa-dot-circle-o');
});

/* Acciones del lead
------------------------------- */
// Componer mensaje
$( ".mensaje" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    $( "#lead-id-em" ).val( leadId );
    $( "#em-form" ).submit();
});
// Agregar nota
$( ".nota" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-multi").html('Agregar nota personalizada');
});
// Registrar llamada
$( ".llamada" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-multi").html('Registrar llamada');
});
// Inscribir a Musinetwork
$( ".inscripcion" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-multi").html('Inscribir a Musinetwork');
});
// Enviar a lista general
$( ".lista" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-multi").html('Enviar a lista general');
});
// Reservar para futuros ciclos
$( ".reservar" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
});
// Agregar recordatorio
$( ".recordatorio" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
});
// Solicitar datos de prospecto
$( ".editar-prospecto" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( 'solicitar-datos' );
    $( "#leads-form" ).submit();
});
// // Actualizar datos de prospecto
// $( ".editar-prospecto" ).click(function() {

// });
// Ver historial de interacciones
$( ".historial" ).click(function() {
    var leadId = $(this).closest( '.lead' ).attr( 'id' );
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( 'ver-historial' );
    $( "#leads-form" ).submit();
});
// Eliminar prospecto
$( ".eliminar" ).click(function() {
    var leadId = $(this).closest( '.lead' ).attr( 'id' );
    var leadTipoAccion = $(this).attr( 'tipo-accion' );
    var nombreQueSeElimina = $("#nombre-prospecto" + leadId).text();
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
    $( "#nombre-a-eliminar").html( nombreQueSeElimina );
});
// Cambiar prioridad
// verde
$( ".prioridad-verde" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( "cambiar-prioridad" );
    $( "#prioridad" ).val( 'verde' );
    $( "#leads-form" ).submit();
});
// roja
$( ".prioridad-roja" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( "cambiar-prioridad" );
    $( "#prioridad" ).val( 'roja' );
    $( "#leads-form" ).submit();
});
// azul
$( ".prioridad-azul" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( "cambiar-prioridad" );
    $( "#prioridad" ).val( 'azul' );
    $( "#leads-form" ).submit();
});
/* Modales MAG-FORM
------------------------------- */
// Registrar llamada
$( ".llamada-mag" ).click(function() {
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi-mag');
    $( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-multi-mag").html('Registrar llamada');
});

/* AJAX
------------------------------- */

$( document ).ajaxStart(function() {
    $( ".loading" ).css( "display", "block" );              
});
$( document ).ajaxComplete(function() {
    $( ".loading" ).css( "display", "none" );                   
});

$("#leads-form").on("submit", function(e){

    e.preventDefault();
    $.ajax({
        data: $("#leads-form").serialize(),
        //Cambiar a type: POST si necesario
        type: "POST",
        // Formato de datos que se espera en la respuesta
        dataType: "json",
        // URL a la que se enviará la solicitud Ajax
        // url: "controllers/procesar.php",
        url: "controllers/procesar.php",
    })
    .done(function( data, textStatus, jqXHR ) {
        if ( console && console.log ) {
            console.log( "La solicitud se ha completado correctamente." );
            console.log( data );
        }

        /* Resultados de acciones
        ------------------------------- */
        // Registrar llamada
        if ( data.tipo_accion == "registrar-llamada")
        {
            $( '#alerta-exito' ).html( data.mensaje );
        }
        // Agregar nota
        if ( data.tipo_accion == "agregar-nota")
        {
            $( '#alerta-exito' ).html( data.mensaje );
        }
        // Inscribir
        if ( data.tipo_accion == "inscribir")
        {
            $( '#' + data.lead_id).remove();
            $( '#alerta-exito' ).html( data.mensaje );
        }
        // Reservar a futuros ciclos
        if ( data.tipo_accion == "reservar")
        {
            $( '#' + data.lead_id).remove();
            $( '#alerta-exito' ).html( data.mensaje );
        }
        // Enviar a lista general
        if ( data.tipo_accion == "lista-general")
        {
            $( '#' + data.lead_id).remove();
            $( '#alerta-exito' ).html( data.mensaje );
        }
        // Recordatorio
        if ( data.tipo_accion == "recordatorio")
        {
            /* Lo ideal sería acomodar al prospecto en el lugar del DOM que corresponda*/
            // prospecto = $( '#' + data.lead_id);
            // prospecto.find('date-reminder').html( 'hola' );
            // prospecto.find('text-reminder').html( 'ke ase' );

            // Solución temporal
            // document.location.reload(); 
            $( '#alerta-exito' ).html( data.mensaje );
        }
        // Solicitar datos de prospecto
        if ( data.tipo_accion == "solicitar-datos")
        {
            // Remplaza los datos con los obtenidos en el json
            $( "#nombre-prospecto" ).val( data.lead_info.nombre );
            $( "#apellidos-prospecto" ).val( data.lead_info.apellidos );
            $( "#correo-prospecto" ).val( data.lead_info.email );
            $( "#telefono-prospecto" ).val( data.lead_info.telefono );
            $( "#pais-prospecto" ).val( data.lead_info.pais );
            $( "#ciudad-prospecto" ).val( data.lead_info.ciudad );
            $( "#instrumento-prospecto" ).val( data.lead_info.instrumento );
            // Actualiza los datos para reenviar la petición de modificación
            $( "#lead-id" ).val( data.lead_id );
            $( "#tipo-accion" ).val( 'editar-datos' );
        }
        // Editar datos de prospecto
        if ( data.tipo_accion == "editar-datos")
        {
            $( "#nombre-prospecto" + data.lead_id).html( data.nombre + " " + data.apellidos );            
            $( '#alerta-exito' ).html( data.mensaje );
        }
        // Ver historial
        if ( data.tipo_accion == "ver-historial")
        {
            
            // console.log( data.historial.interaccion_0.tipo );
            // console.log( data.historial['interaccion_0'].tipo );
           

            var historial = '';
            // for ( i = 0; i < data.historial.length; i++ ) { 
            i = 0;    

            for ( interaccion in data.historial ) { 
                var inte = 'interaccion_' + i;
                i++;  
                // console.log(interaccion);            
                historial =  historial + '<div class="panel panel-default panel-historial">';
                    historial = historial +'<div class="panel-heading" role="tab" id="heading-' + i +'">';
                        historial = historial + '<a role="button" data-toggle="collapse" href="#collapse-' + i +'" aria-expanded="false" aria-controls="collapse-' + i +'" class="bar-title">';
                            historial = historial + '<h4 class="panel-title">';
                                historial = historial + '<span>' + data.historial[inte].fecha + '</span>';
                                historial = historial + data.historial[inte].tipo;
                            historial = historial + '</h4>';
                        historial = historial + '</a>';
                    historial = historial + '</div>';
                    historial = historial + '<div id="collapse-' + i +'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-1">';
                        historial = historial + '<div class="panel-body">';
                            if ( data.historial[inte].mensaje_int != '' ) 
                            {
                                historial = historial + '<h4>Mensaje del interesado</h4>';
                                historial = historial + '<p>' + data.historial[inte].mensaje_int + '</p>';
                            } 
                            if ( data.historial[inte].mensaje_op != '' ) 
                            {
                                historial = historial + '<h4>Mensaje del operador</h4>';
                                historial = historial + '<p>' + data.historial[inte].mensaje_op + '</p>';
                            } 
                            if ( data.historial[inte].observaciones != '' ) 
                            {
                                historial = historial + '<h4>Observaciones</h4>';
                                historial = historial + '<p>' + data.historial[inte].observaciones + '</p>';
                            } 
                            if ( data.historial[inte].alerta != '' ) 
                            {
                                historial = historial + '<h5>Alerta</h5>';
                                historial = historial + '<p>' + data.historial[inte].alerta + '</p>';
                            }                         
                        historial = historial + '</div>';
                    historial = historial + '</div>';           
                historial = historial.concat( '</div>' );
            }


            $( "#acordeon-historial" ).html(historial);
        }
        // Eliminar
        if ( data.tipo_accion == "eliminar")
        {
            $( '#' + data.lead_id).remove();
            $( '#alerta-exito' ).html( data.mensaje );
        }
        // Cambiar prioridad
        if ( data.tipo_accion == "cambiar-prioridad")
        {
            document.location.reload(); 
            $( '#alerta-exito' ).html( data.mensaje );
        }
        //  CIERRE DE LAS ACCIONES
        // Cierro todos los modales activos
        if ( data.tipo_accion != "ver-historial" )
        {
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








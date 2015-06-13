
/* MAG-FORM
--------------------------------------------- */

// Activo datepicker para el campo en mag-form
$('#mag-date').datepicker({
    weekStart:1,
    color: 'red'
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


/* Acciones del lead
------------------------------- */

$( ".nota" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    modal.find( "#lead-id" ).val( leadId );
    modal.find( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-regular").html('Agregar nota personalizada');
});
$( ".llamada" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    modal.find( "#lead-id" ).val( leadId );
    modal.find( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-regular").html('Registrar llamada');
});
$( ".inscripcion" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    modal.find( "#lead-id" ).val( leadId );
    modal.find( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-regular").html('Inscribir a Musinetwork');
});
$( ".lista" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    modal.find( "#lead-id" ).val( leadId );
    modal.find( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-regular").html('Enviar a lista general');
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

    $.post("part/process.php", $("#leads-form").serialize(), function (respuesta) {
        $('#trace-block .datos').html(respuesta);
        $('.contenido').css( "display", "block" ); 
        $('#modal-multi').modal('toggle');
    })
});






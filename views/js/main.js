
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
    color: 'red'
});
// Activo datepicker para el campo en mag-form
$('#fecha-reserva').datepicker({
    weekStart:1,
    color: 'red'
});
// datepicker para el modal de recordatorio
$('#fecha-recordatorio').datepicker({
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
// Agregar nota
$( ".nota" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-regular").html('Agregar nota personalizada');
});
// Registrar llamada
$( ".llamada" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-regular").html('Registrar llamada');
});
// Inscribir a Musinetwork
$( ".inscripcion" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-regular").html('Inscribir a Musinetwork');
});
// Enviar a lista general
$( ".lista" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    var modal = $('#modal-multi');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
    modal.find( "#titulo-modal-regular").html('Enviar a lista general');
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
// Actualizar datos de prospecto
$( ".editar-prospecto" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
});
// Ver historial de interacciones
$( ".historial" ).click(function() {
    var leadId = $(this).closest('.lead').attr('id');
    var leadTipoAccion = $(this).attr('tipo-accion');
    $( "#lead-id" ).val( leadId );
    $( "#tipo-accion" ).val( leadTipoAccion );
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

    $.post("views/part/process.php", $("#leads-form").serialize(), function (respuesta) {
        // Imprimo resultados de prueba
        $('#trace-block .datos').html(respuesta);
        $('.contenido').css( "display", "block" ); 
        // Cierro todo slos modales activos
        $('.modal').modal('hide');

    })
});






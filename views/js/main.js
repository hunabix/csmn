//@prepros-prepend _datepickers.js
//@prepros-prepend _magform.js
//@prepros-prepend _leadform.js
//@prepros-prepend _configuracion.js
//@prepros-prepend _plantillas.js
//@prepros-prepend _notificaciones.js

/* Tootltips
--------------------------------------------- */
// Se inicializa la función
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

/* Acordeón
--------------------------------------------- */
// Historial
$("#acordeon-historial").children().click(function (e) {
    if ($(e.currentTarget).siblings().children(".collapsing").length > 0 ) {
        return false;
    }
});

/* CHECKS Y RADIO BUTTONS
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

/* AJAX loader animation
------------------------------- */
$( document ).ajaxStart(function() {
    $( ".loading" ).css( "display", "block" );              
});
$( document ).ajaxComplete(function() {
    $( ".loading" ).css( "display", "none" );                   
});


// CKEDITOR
if(!($('#mensaje_op').length == 0)) {

    var asunto = document.getElementsByName('asunto')[0];
    asunto.value = '';

    CKEDITOR.replace( 'mensaje_op', {

        extraPlugins: 'serverpreview,autogrow',
        serverPreview_Url: 'lib/ckeditor/plugins/serverpreview/preview.php',
        autoGrow_minHeight: 200,
        autoGrow_maxHeight: 600,
        autoGrow_bottomSpace: 50,
        removePlugins: 'resize',

        // Remove the Resize plugin as it does not make sense to use it in conjunction with the AutoGrow plugin.
        removePlugins: 'resize',
        toolbar : [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Preview', '-', 'Templates' ] },
            { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ] },
            '/',
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor' ] },
            { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
            { name: 'others', items: [ '-' ] },
            { name: 'about', items: [ 'About' ] },
            ],
        templates_files : [ 'lib/ckeditor/plugins/templates/templates/cs-mail-templates.php' ],
        
    } );

    /* Cambia el contenido del editor ckEditor */
    function cambiarContenido($pid) {
        // Get the editor instance that you want to interact with.
        var editor = CKEDITOR.instances.mensaje_op;
        var plantillaID = $pid;
        console.log(plantillaID);
        var plantilla = document.getElementById( 'contenidoPlantilla'+$pid ).value;
        var nuevoAsunto = document.getElementById( 'asuntoPlantilla'+$pid ).innerHTML;
        var asunto = document.getElementsByName('asunto')[0];
        asunto.value = nuevoAsunto;

        // Set editor content (replace current content).
        // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-setData
        editor.setData(plantilla);

        //console.log(asunto); // true
        
    }
    /* Se asegura de que se carga ckEditor antes de inicializar las funciones */
    CKEDITOR.on( 'instanceReady', function( ev ) {
        // The editor is ready, so template buttons can be displayed.
        if(($('#plantillasBotones').length === 0)) {

            console.log('Solo en modal');

        }

        if($('#plantillasBotones').length > 0) {

            console.log('La variable existe');
            document.getElementById( 'plantillasBotones' ).style.display = 'block';

        }
    });
}

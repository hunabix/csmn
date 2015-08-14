/* --------------------------------------------- */
/* ----------------[PLANTILLAS]----------------- */
/* --------------------------------------------- */

/* Acciones 
------------------------ */
// Nuevo plantilla
$( "#nueva-plantilla").click(function() {
    $( "#plantilla-nombre" ).val( "" );
    $( "#plantilla-asunto" ).val( "" );
    // Get the editor instance that you want to interact with.
    var editor = CKEDITOR.instances.mensaje_modal_op;    
    editor.setData('');
    $( "#plantilla-tipo-accion" ).val( "crear-plantilla" );
    $( "#titulo-modal-plantilla").html('Agregar nueva plantilla');
    $( "#modal-plantilla-submit" ).html('Agregar nueva plantilla');
});

// Solicitar datos de prospecto
$( ".editar-plantilla" ).click(function() {
    var plantillaId = $(this).closest('.template').attr('id');
    $( "#plantilla-tipo-accion" ).val( "solicitar-datos" );
    $( "#titulo-modal-plantilla").html('Editar datos de plantilla');
    $( "#modal-plantilla-submit" ).html('Editar datos de plantilla');
    $( "#plantilla-id" ).val( plantillaId );
    $( "#plantillas-form" ).submit();
});

// Eliminar plantilla
$( ".eliminar-plantilla").click(function() {
    $( "#plantilla-tipo-accion" ).val( "eliminar-plantilla" );
    var plantillaId = $(this).closest('.template').attr('id');
    plantilla = $('#' + plantillaId);
    var nombreQueSeElimina = plantilla.find( ".templatename" ).text();
    $( "#nombre-a-eliminar").html( nombreQueSeElimina );
    $( "#plantilla-id" ).val( plantillaId );
    $( '#plantilla-nombre' ).val( 'xx' );
    $( '#plantilla-asunto' ).val( 'xx' );

});

// CKEDITOR
if(!($('#mensaje_modal_op').length == 0)) {

    CKEDITOR.replace( 'mensaje_modal_op', {

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

}

/* AJAX 
------------------------------- */
$("#plantillas-form").on("submit", function(e){

    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

    e.preventDefault();
    $.ajax({
        data: $("#plantillas-form").serialize(),

        
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
        // Solicitar-datos
        if ( data.tipo_accion == "solicitar-datos")
        {
            $( '#alerta-exito' ).html( data.mensaje );
            $( '#plantilla-nombre' ).val( data.nombre );
            $( '#plantilla-asunto' ).val( data.asunto );
            //$( '#mensaje_modal_op' ).val( data.contenido );


            // Get the editor instance that you want to interact with.
            var editor = CKEDITOR.instances.mensaje_modal_op;
                    
            
            editor.setData(data.contenido);


            // Actualiza los datos para reenviar la petición de modificación
            $( "#plantilla-tipo-accion" ).val( 'editar-plantilla' );
        }
        // Editar plantilla
        if ( data.tipo_accion == "editar-plantilla")
        {
            $( '#alerta-exito' ).html( data.mensaje );
            plantilla = $('#' + data.plantilla_id);
            plantilla.find( ".templatename" ).html( data.nombre );
            $('.modal').modal('hide');
        }
        // Eliminar plantilla
        if ( data.tipo_accion == "eliminar-plantilla")
        {
            $( '#alerta-exito' ).html( data.mensaje );
            plantilla = $('#' + data.plantilla);
            console.log( data.plantilla );
            plantilla.remove( '' );
            $('.modal').modal('hide');
        }
        // Crear plantilla
        if ( data.tipo_accion == "crear-plantilla")
        {
            $( '#alerta-exito' ).html( data.mensaje );
            var plantilla = '';
           
            plantilla =  plantilla + '<div id=" ' +  data.plantilla_id + '" class="template">';              
                plantilla =  plantilla + '<!-- plantilla -->';
                plantilla =  plantilla + '<span class="templateimg">';
                    plantilla =  plantilla + '<i class="fa fa-file-code-o userimg"></i>'; 
                plantilla =  plantilla + '</span>';
                plantilla =  plantilla + '<!-- Nombre -->';
                plantilla =  plantilla + '<span class="templatename">';
                    plantilla =  plantilla + data.nombre;
                plantilla =  plantilla + '</span>';
               
                plantilla =  plantilla + '<!-- Acciones -->';
                plantilla =  plantilla + '<aside class="actions">';
                    plantilla =  plantilla + '<!-- Editar plantilla -->';
                    plantilla =  plantilla + '<a href="#" class="action editar-plantilla" data-toggle="modal" data-target="#modal-plantilla"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar plantilla"></i></a> ';       
                    plantilla =  plantilla + '<!-- Eliminar plantilla -->';
                    plantilla =  plantilla + '<a href="#" class="action eliminar-plantilla" data-toggle="modal" data-target="#modal-plantilla-eliminar" tipo-accion="eliminar"><i class="fa fa-close" data-toggle="tooltip" data-placement="top" title="Eliminar plantilla"></i></a>';
                plantilla =  plantilla + '</aside>';
            plantilla = plantilla.concat( '</div>' );   

            $( "#template-list" ).append(plantilla);
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

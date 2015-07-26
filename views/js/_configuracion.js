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

// Eliminar usuario
$( ".eliminar-usuario").click(function() {
    $( "#usuario-tipo-accion" ).val( "eliminar-usuario" );
    var userId = $(this).closest('.user').attr('id');
    usuario = $('#' + userId);
    var nombreQueSeElimina = usuario.find( ".nombre" ).text();
    $( "#nombre-a-eliminar").html( nombreQueSeElimina );
    $( "#usuario-id" ).val( userId );
    $( '#usuario-username' ).val( 'xx' );
    $( '#usuario-nombre' ).val( 'xx' );
    $( '#usuario-email' ).val( 'xx@xx.xx' );
    $( '#usuario-clave' ).val( 'xx' );
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
        url: "views/part/process.php", 
        //url: "controllers/procesar.php",
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
            $( '#usuario-username' ).val( data.username );
            $( '#usuario-nombre' ).val( data.nombre );
            $( '#usuario-email' ).val( data.email );
            $( '#usuario-clave' ).val( data.clave );
            tipoUsuario = data.tipo;
            $('#usuario-tipo option').each(function() {
                if( $(this).val() == tipoUsuario ) {
                    $(this).attr('selected', 'selected');
                }
            });
            // Actualiza los datos para reenviar la petición de modificación
            $( "#usuario-tipo-accion" ).val( 'editar-usuario' );
        }
		// Editar usuario
        if ( data.tipo_accion == "editar-usuario")
        {
        	$( '#alerta-exito' ).html( data.mensaje );
        	usuario = $('#' + data.usuario_id);
        	usuario.find( ".usernamedata" ).html( data.username );
        	usuario.find( ".nombre" ).html( data.nombre );
        	usuario.find( ".correo" ).html( data.email );
        	usuario.find( ".tipo" ).html( data.tipo );
            $('.modal').modal('hide');
        }
        // Eliminar usuario
        if ( data.tipo_accion == "eliminar-usuario")
        {
        	$( '#alerta-exito' ).html( data.mensaje );
        	usuario = $('#' + data.usuario_id);
        	usuario.remove( '' );
            $('.modal').modal('hide');
        }
        // Crear usuario
        if ( data.tipo_accion == "crear-usuario")
        {
            $( '#alerta-exito' ).html( data.mensaje );
            var usuario = '';
           
            usuario =  usuario + '<div id=" ' +  data.usuario_id + '" class="user">';		       
            	usuario =  usuario + '<!-- Usuario -->';
                usuario =  usuario + '<span class="username">';
                  	usuario =  usuario + '<i class="fa fa-user userimg"></i>'; 
                    usuario =  usuario + data.username;
                usuario =  usuario + '</span>';
                usuario =  usuario + '<!-- Nombre -->';
                usuario =  usuario + '<span class="nombre">';
                    usuario =  usuario + data.nombre;
                usuario =  usuario + '</span>';
                usuario =  usuario + '<!-- Correo -->';
                usuario =  usuario + '<span class="correo">';
                    usuario =  usuario + data.email;
                usuario =  usuario + '</span>';
            	usuario =  usuario + '<!-- Acciones -->';
            	usuario =  usuario + '<aside class="actions">';
            	    usuario =  usuario + '<!-- Editar usuario -->';
            	    usuario =  usuario + '<a href="#" class="action editar-usuario" data-toggle="modal" data-target="#modal-usuario"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar usuario"></i></a> ';       
            	    usuario =  usuario + '<!-- Eliminar usuario -->';
            	    usuario =  usuario + '<a href="#" class="action eliminar-usuario" data-toggle="modal" data-target="#modal-usuario-eliminar" tipo-accion="eliminar"><i class="fa fa-close" data-toggle="tooltip" data-placement="top" title="Eliminar usuario"></i></a>';
            	usuario =  usuario + '</aside>';
            usuario = usuario.concat( '</div>' );	

            $( "#user-list" ).append(usuario);
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

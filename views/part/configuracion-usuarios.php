<!-- Formulario de usuarios -->
<form id="usuarios-form" name="usuarios-form" class="usuarios-form form panel-contenido" method="post" action="<?= cs_url; ?>/configuracion" >

    
	<!-- Nuevo usuario; button modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevo-usuario">
	  Launch demo modal
	</button>
	

	<!-- Prospecto -->

	<div id="" class="usuario">
        
        <!-- figure -->
        <i class="fa fa-user"></i>
        <!-- Nombre -->
        <span class="nombre">
            Nombre del operador
        </span>
	    <!-- Usuario -->
        <span class="nombre">
            Usuario
        </span>
        <!-- Correo -->
        <span class="nombre">
            correo@sominio.com
        </span>
	    <!-- Acciones -->
	    <aside class="acciones">
	        <!-- Agregar nota personalizada -->
	        <a href="#" class="action nota" data-toggle="modal" data-target="#modal-multi"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Nota"></i></a>        
	        <!-- Eliminar prospecto -->
	        <a href="#" class="action eliminar" data-toggle="modal" data-target="#modal-eliminar" tipo-accion="eliminar"><i class="fa fa-close" data-toggle="tooltip" data-placement="top" title="Borrar"></i></a>
	    </aside>
	</div>





	<!-- Nuevo usuario; modal -->
	<div class="modal fade" id="nuevo-usuario" tabindex="-1" role="dialog" aria-labelledby="nuevo-usuario-label">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="nuevo-usuario-label">Nuevo Usuario</h4>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary">Agregar nuevo usuario</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>
<!-- Formulario de usuarios -->
<form id="usuarios-form" name="usuarios-form" class="usuarios-form form panel-contenido" method="post" action="<?= cs_url; ?>/configuracion" >

    
	<!-- Nuevo usuario; button modal -->
	<button type="button" id="nuevo-usuario" class="btn btn-primary btn-fill btn-lg" data-toggle="modal" data-target="#modal-usuario">
    	<i class="fa fa-user-plus"></i> Nuevo usuario
	</button>
	

	<!-- Prospecto -->
	<section class="users">
		<!-- Encabezado -->
		<header class="titles">
		    <h4 class="lt-user">Usuario</h4>
		    <h4 class="lt-name">Nombre</h4>
		    <h4 class="lt-email">Correo</h4>
		</header>


		<div id="1" class="user">		       
		    <!-- Usuario -->
		    <span class="username">
		      	<i class="fa fa-user userimg"></i> 
		        Usuario
		    </span>
		    <!-- Nombre -->
		    <span class="nombre">
		        Nombre del operador
		    </span>
		    <!-- Correo -->
		    <span class="correo">
		        correo@sominio.com
		    </span>
			<!-- Acciones -->
			<aside class="actions">
			    <!-- Editar usuario -->
			    <a href="#" class="action editar-usuario" data-toggle="modal" data-target="#modal-usuario"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar usuario"></i></a>        
			    <!-- Eliminar usuario -->
			    <a href="#" class="action eliminar-usuario" data-toggle="modal" data-target="#modal-usuario-eliminar" tipo-accion="eliminar"><i class="fa fa-close" data-toggle="tooltip" data-placement="top" title="Eliminar usuario"></i></a>
			</aside>
		</div>
		

		<!-- FIN USUARIO PRUEBAS -->
		<div id="2" class="user">		       
		    <!-- Usuario -->
		    <span class="username">
		      	<i class="fa fa-user userimg"></i> 
		        Usuario
		    </span>
		    <!-- Nombre -->
		    <span class="nombre">
		        Nombre del operador
		    </span>
		    <!-- Correo -->
		    <span class="correo">
		        correo@sominio.com
		    </span>
			<!-- Acciones -->
			<aside class="actions">
			    <!-- Editar usuario -->
			    <a href="#" class="action nota" data-toggle="modal" data-target="#modal-usuario"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar usuario"></i></a>        
			    <!-- Eliminar usuario -->
			    <a href="#" class="action eliminar" data-toggle="modal" data-target="#modal-usuario-eliminar" tipo-accion="eliminar"><i class="fa fa-close" data-toggle="tooltip" data-placement="top" title="Eliminar usuario"></i></a>
			</aside>
		</div>

		<div id="3" class="user">		       
		    <!-- Usuario -->
		    <span class="username">
		      	<i class="fa fa-user userimg"></i> 
		        Usuario
		    </span>
		    <!-- Nombre -->
		    <span class="nombre">
		        Nombre del operador
		    </span>
		    <!-- Correo -->
		    <span class="correo">
		        correo@sominio.com
		    </span>
			<!-- Acciones -->
			<aside class="actions">
			    <!-- Editar usuario -->
			    <a href="#" class="action nota" data-toggle="modal" data-target="#modal-usuario"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar usuario"></i></a>        
			    <!-- Eliminar usuario -->
			    <a href="#" class="action eliminar" data-toggle="modal" data-target="#modal-usuario-eliminar" tipo-accion="eliminar"><i class="fa fa-close" data-toggle="tooltip" data-placement="top" title="Eliminar usuario"></i></a>
			</aside>
		</div>
		<!-- FIN USUARIO PRUEBAS -->
	</section>
	

	<!-- Usuario; modal -->
	<div class="modal fade modal-usuario" id="modal-usuario" tabindex="-1" role="dialog" aria-labelledby="modal-usuario-label">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="titulo-modal-usuario"> ... </h4>
			    </div>
			    <div class="modal-body">
			    	<!-- Usuario -->
			    	<div class="input-group usuario">
			    	    <input name="usuario" type="text" id="usuario" class="form-control" placeholder="Usuario" value="" required>
			    	    <span class="input-group-addon"><i class="fa fa-user"></i></span>
			    	</div>
			    	<!-- Nombre -->
			    	<div class="input-group nombre">
			    	    <input name="nombre" type="text" id="usuario-nombre" class="form-control" placeholder="Nombre" value="" required>
			    	    <span class="input-group-addon"><i class="fa"></i></span>
			    	</div>
			    	<!-- Correo -->
			    	<div class="input-group correo">
			    	    <input name="correo" type="email" id="usuario-correo"class="form-control" placeholder="Correo electrónico" value="" required>
			    	    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
			    	</div>
			    	<!-- Correo -->
			    	<div class="input-group clave">
			    	    <input name="clave" type="text" id="usuario-clave"class="form-control" placeholder="Contraseña" value="" required>
			    	    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
			    	</div>
			    </div>
			    <div class="modal-footer">
			     	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			        <button  type="submit" class="btn btn-primary">Agregar nuevo usuario</button>
			    </div>
		    </div>
		</div>
	</div>

	<!-- Modal | eliminar usuario-->
	<div class="modal fade" id="modal-usuario-eliminar" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <!-- Encabezado del modal  -->
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title">
	                    Eliminar usuario
	                </h4>
	            </div>
	            <!-- Cuerpo del modal  -->
	            <div class="modal-body">
	                <div class="alert alert-danger" role="alert">
	                  ¿Estas seguro de que deseas eliminar a <strong id="nombre-a-eliminar"></strong>?
	                </div>
	            </div>
	            <!-- Pié del modal  -->
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	                <button type="submit" class="btn btn-primary">Si, por favor</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Datos base a enviar -->
	<input type="hidden" name="formulario" value="usuarios-form">
	<input id="usuario-id" type="hidden" name="usuario-id" value="">
	<input id="usuario-tipo-accion" type="hidden" name="tipo-accion" value="">

</form>
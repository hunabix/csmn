<!-- Formulario de notificaciones -->
<form id="notificaciones-form" name="notificaciones-form" class="Notificaciones-form form">
	
	<!-- Notificación; modal -->
	<div class="modal fade modal-notificacion" id="modal-notificacion" tabindex="-1" role="dialog" aria-labelledby="modal-notificacion-label">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
			    
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        	<span aria-hidden="true">&times;</span>
			        </button>
			        <h4 class="modal-title" id="notificacion-titulo-modal"> ... </h4>
			    </div>

			    <div class="modal-body">
				    <!-- Tipo de notificacion -->
				    <div class="input-group Notificaciones-formTipo">
				        <select id="notificacion-tipo" name="tipo" class="form-control"  placeholder="Tipo de notificacion" seleccionado="">
				            <option id="notificacion-tipo-op1" value="recordatorio">Regular</option>
				            <option id="notificacion-tipo-op2" value="llamada">Llamada</option>
				        </select>
				        <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>
				    </div>
				    <!-- Fecha -->
			    	<div class="input-group Notificaciones-formFecha">
			    	    <input name="fecha_notificacion" type="text" id="notificacion-fecha" class="form-control" placeholder="Fecha" value="" required>
			    	    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			    	</div>
			    	<!-- Título -->
			    	<div class="input-group Notificaciones-formTitulo">
			    	    <input name="titulo" type="text" id="notificacion-titulo" class="form-control" placeholder="Título de la notificación" value="" required>
			    	    <span class="input-group-addon"><i class="fa fa-bell-o"></i></span>
			    	</div>
			    	<!-- Título -->
			    	<div class="input-group Notificaciones-formDescripcion">
			    	    <textarea name="descripcion" id="notificacion-descripcion" type="text-area" class="form-control"  placeholder="Puedes agregar una descripción aquí"></textarea>
                   		<span class="input-group-addon"><i class="fa fa-file-text"></i></span>
			    	</div>
			    </div>

			    <div class="modal-footer">
			     	<button type="button" class="btn btn-default" data-dismiss="modal">
			     	Cerrar
			     	</button>
			     	<span id="notificacion-acciones-btns" class="Notificaciones-formAcciones">
			     		<button  id="modal-notificacion-eliminar" class="Notificaciones-formEliminar btn btn-primary" type="submit"> 
							<i class="fa fa-trash"></i> Eliminar
				        </button>
				        <button  id="modal-notificacion-editar" class="Notificaciones-formModificar btn btn-primary" type="submit" > 
							<i class="fa fa-pencil-square-o"></i> Modificar
				        </button>
				        <button  id="modal-notificacion-completar" class="Notificaciones-formCompletar btn btn-primary" type="submit">
							<i class="fa fa-check-square-o"></i> Completar
				        </button>
			     	</span>			        
			    </div>
		    </div>
		</div>
	</div>

	<!-- Datos base a enviar -->
	<input type="hidden" name="formulario" value="notificacion-form">
	<input id="notificacion-id" type="hidden" name="ID" value="">
	<input id="notificacion-usuario" type="hidden" name="id_usuario" value="<?= $user['user_id']; ?>">
	<input id="notificacion-estado" type="hidden" name="estado" value="">
	<input id="notificacion-tipo-accion" type="hidden" name="tipo-accion" value="">
	

</form>


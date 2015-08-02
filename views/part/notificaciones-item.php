
<div id="<?= $notificacion['ID']; ?>" class="Notificaciones-notificacion form">
	<!-- Titulo -->
	<a class="Notificaciones-notificacionTitulo notice" data-toggle="modal" data-target="#modal-notificacion" titulo="<?= $notificacion['titulo']; ?>" desc="<?= $notificacion['descripcion']; ?>" fecha="<?= $notificacion['fecha_creacion']; ?>" tipo="<?= $notificacion['tipo']; ?>">
	    <?= $notificacion['titulo']; ?>  
	</a>
	<i class="fa fa-file-text-o Notificaciones-notificacionDescripcion" data-toggle="tooltip" data-placement="top" title="<?= $notificacion['descripcion']; ?>"></i>
	<span class="Notificaciones-notificacionFecha">
		31 jul
	</span>
</div>


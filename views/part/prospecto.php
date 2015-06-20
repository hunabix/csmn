
<!-- Prospecto -->

<div id="<?= $caso['ID']; ?>" class="lead form <?= $caso['prioridad']; ?>">

    <!-- Checkbox & Nombre -->
    <div class="lead-name" for="checkbox-<?= $caso['ID']; ?>">
        <!-- check -->
        <label class="fancy-check">
            <input name="checkbox-<?= $caso['ID']; ?>" id="checkbox-<?= $caso['ID']; ?>" value="<?= $caso['ID']; ?>" type="checkbox" class="check" form="mag-form">
            <span class="fa fa-square-o check-icon"></span>
            <!-- Nombre -->
            <span id="nombre-prospecto<?= $caso['ID']; ?>" class="name">
                <?= $caso['nombre']; ?>
            </span>
        </label>
    </div>
    <!-- Estatus actual -->
    <p class="status">
        <span class="date-status"><?= $caso['fecha_estatus']['dia']; ?> <?= $caso['fecha_estatus']['mes_texto_corto']; ?></span>
        <?= $caso['ultima_interaccion']['tipo']; ?>
    </p>
    <!-- Recordatorio y sugerencia -->
    <p class="reminder">
        <span class="date-reminder"><?= $caso['fecha_recordatorio']['dia']; ?> <?= $caso['fecha_recordatorio']['mes_texto_corto']; ?></span>
        <span class="text-reminder"><?= $caso['recordatorio_texto']; ?></span>
        
    </p>
    <!-- Acciones -->
    <aside class="actions">
        <!-- Enviar correo -->
        <a href="#" class="action mensaje" tipo-accion="componer-mensaje"><i class="fa fa-send"></i></a>
        <!-- Realizar llamada -->
        <a href="#"  class="action llamada" data-toggle="modal" data-target="#modal-multi" tipo-accion="registrar-llamada"><i class="fa fa-phone"></i></a>
        <!-- Agregar nota personalizada -->
        <a href="#" class="action nota" data-toggle="modal" data-target="#modal-multi" tipo-accion="agregar-nota"><i class="fa fa-file-text"></i></a>
        <!-- Inscripción a Musinetwork -->
        <a href="#" class="action inscripcion" data-toggle="modal" data-target="#modal-multi" tipo-accion="inscribir"><i class="fa fa-university"></i></a>
        <!-- Reservar para futuros ciclos -->
        <a href="#" class="action reservar" data-toggle="modal" data-target="#modal-reservar" tipo-accion="reservar"> <i class="fa fa-recycle"></i></a>
        <!-- Enviar a lista general -->
        <a href="#" class="action lista" data-toggle="modal" data-target="#modal-multi" tipo-accion="lista-general"><i class="fa fa-list"></i></a>
        <!-- Agregar recordatorio -->
        <a href="#" class="action recordatorio" data-toggle="modal" data-target="#modal-recordatorio" tipo-accion="recordatorio"><i class="fa fa-calendar"></i></a>
        <!-- Editar datos del prospecto -->
        <a href="#" class="action editar-prospecto" data-toggle="modal" data-target="#modal-prospecto" tipo-accion="editar-datos"><i class="fa fa-user"></i></a>
        <!-- Consultar historial -->
        <a href="#" class="action historial" data-toggle="modal" data-target="#modal-historial" tipo-accion="ver-historial"><i class="fa fa-clock-o"></i></a>
        <!-- Eliminar prospecto -->
        <a href="#" class="action eliminar" data-toggle="modal" data-target="#modal-eliminar" tipo-accion="eliminar"><i class="fa fa-close"></i></a>
        <!-- Cambiar prioridad -->
        <div class="dropdown contenedor-prioridad">
            <a class="action prioridad dropdown-toggle" type="button"  id="prioridad-dropdown<?= $caso['ID']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
                <i class="fa fa-circle"></i>            
            </a>
            <div class="dropdown-menu contenido-prioridad" aria-labelledby="prioridad-dropdown<?= $caso['ID']; ?>">
                <a href="#" class="btn-prioridad prioridad-verde"><i class="fa fa-circle" tipo-accion="cambiar-prioridad"></i> </a>
                <a href="#" class="btn-prioridad prioridad-roja"><i class="fa fa-circle" tipo-accion="cambiar-prioridad"></i> </a>
                <a href="#" class="btn-prioridad prioridad-azul"><i class="fa fa-circle" tipo-accion="cambiar-prioridad"></i> </a>
            </div>
        </div>
    </aside>
</div>


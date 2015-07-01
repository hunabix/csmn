<!-- Acciones y recordatorios en lote : mag-form = monitoring action group form-->
<form action="views/part/process.php" name="mag-form" id="mag-form" class="mag-form form" method="post">
    
    <!-- Lista de acciones : col 1 -->        
    <div class="dropdown action-list">
        <button name="action-list" id="action-list" class="btn dropdown-toggle btn-primary" type="button" data-toggle="dropdown">
            Acciones en grupo
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <!-- Enviar correo -->
            <li role="presentation"><a id="mensaje-mag" role="menuitem" tabindex="-1" href="#"><i class="fa fa-send"></i> Enviar correo</a></li>
            <!-- Registrar llamada -->
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a id="nota-mag" data-toggle="modal" data-target="#modal-multi-mag" role="menuitem" tabindex="-1" href="#"><i class="fa fa-pencil"></i> Agregar nota</a></li>
            <li role="presentation"><a id="lista-mag" data-toggle="modal" data-target="#modal-multi-mag" role="menuitem" tabindex="-1" href="#"><i class="fa fa-sort-amount-asc"></i> Lista general</a></li>
            <li role="presentation"><a id="reservar-mag" data-toggle="modal" data-target="#modal-reservar-mag" role="menuitem" tabindex="-1" href="#"><i class="fa fa-recycle"></i> Reservar</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a id="eliminar-mag" data-toggle="modal" data-target="#modal-eliminar-mag" role="menuitem" tabindex="-1" href="#"><i class="fa fa-close"></i> Eliminar</a></li>
        </ul>
    </div>    
    <!-- Selector de fecha : col 2-->
    <div class="input-group mag-date ">
       <input name="fecha-recordatorio" type="text" id="mag-date" class="form-control"  placeholder="dd/mm/aaaa" value="">
       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
    <!-- Recordatorio o sugerencia : col 3-->
    <div class="input-group mag-reminder">
        <input name="recordatorio" type="text" id="mag-reminder" class="form-control" placeholder="Recordatorio" />
        <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
    </div>
        <!-- Botón aplicar recordatorio col: 4 -->  
    <div class="mag-reminder-btn">         
        <button id="mag-reminder-btn" name="mag-reminder-btn" class="btn btn-primary btn-fill">Programar</button>
    </div>
    
    <!-- Modales para mag-form
    ================================================== --> 
    <!-- Multipropósito -->
    <?php require("modal-multi-mag.php");  ?> 
    <!-- Reservar a futuros ciclos -->
    <?php require("modal-reservar-mag.php");  ?>
    <!-- Eliminar -->
    <?php require("modal-eliminar-mag.php");  ?>
    
    <!-- Modales para casos individuales
    ================================================== -->
    <!-- Nombre del formulario -->
    <input type="hidden" name="formulario" value="mag-form">
    <!-- Tipo de acción -->
    <input id="tipo-accion" type="hidden" name="tipo-accion-mag" value="">
    <input id="prioridad" type="hidden" name="prioridad-mag" value="">
</form>
<!-- Acciones y recordatorios en lote : mag-form = monitoring action group form-->
<form action="part/process.php" name="mag-form" id="mag-form" class="mag-form form" method="post">
    
    <!-- Campo para saber si el formulario fué enviado -->
    <input type="hidden" name="form-name" value="mag-form">

    <!-- Lista de acciones : col 1 -->        
    <div class="dropdown action-list">
        <button name="action-list" id="action-list" class="btn dropdown-toggle btn-primary" type="button" data-toggle="dropdown">
            Acciones en grupo
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
        </ul>
    </div>    
    <!-- Selector de fecha : col 2-->
    <div class="input-group mag-date ">
       <input name="mag-date" type="text" id="mag-date" class="form-control"  placeholder="dd/mm/aaaa" value="">
       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
    <!-- Recordatorio o sugerencia : col 3-->
    <div class="input-group mag-reminder">
        <input name="mag-reminder" type="text" id="mag-reminder" class="form-control" placeholder="Recordatorio" />
        <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
    </div>
        <!-- Botón aplicar recordatorio col: 4 -->  
    <div class="mag-reminder-btn">         
        <button type="submit" name="mag-reminder-btn" class="btn btn-primary btn-fill">Programar</button>
    </div>
</form>
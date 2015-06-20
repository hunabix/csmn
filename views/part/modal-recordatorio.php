<!-- Modal Reservar para futuros ciclos | individual-->
<div class="modal fade modal-recordatorio" id="modal-recordatorio" tabindex="-1" role="dialog" aria-labelledby="titulo-modal-regular" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del modal  -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titulo-modal-regular">
                    Agregar recordatorio
                </h4>
            </div>
            <!-- Cuerpo del modal  -->
            <div class="modal-body">
                <!-- Selector de fecha del recordatorio -->
                <div class="input-group fecha-recordatorio">
                   <input name="fecha-recordatorio" type="text" id="fecha-recordatorio" class="form-control"  placeholder="dd/mm/aaaa" value="">
                   <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
                <!-- Recordatorio -->
                <div class="input-group texto-recordatorio">
                    <input name="recordatorio" type="text" class="form-control"  placeholder="Recordatorio" value="">
                    <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                </div>
            </div>
            <!-- Pié del modal  -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Aplicar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Reservar para futuros ciclos | individual-->
<div class="modal fade modal-reservar" id="modal-reservar-mag" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del modal  -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Reservar para futuros ciclos escolares
                </h4>
            </div>
            <!-- Cuerpo del modal  -->
            <div class="modal-body">
                <!-- Selector de fecha del recordatorio de la reserva-->
                <div class="input-group fecha-reserva">
                   <input name="fecha-recordatorio-reserva" type="text" id="fecha-reserva-mag" class="form-control"  placeholder="dd/mm/aaaa" value="" >
                   <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
                <!--Ciclo al cual reserva -->
                <div class="input-group ciclo-reserva">
                    <select name="ciclo-reserva" type="text" id="ciclo-reserva" class="form-control" placeholder="Ciclo">
                        <option value="" selected=""></option>
                        <option value="ENERO - MARZO">ENERO - MARZO</option>
                        <option value="ABRIL - JUNIO">ABRIL - JUNIO</option>
                        <option value="JULIO - SEPTIEMBRE">JULIO - SEPTIEMBRE</option>
                        <option value="OCTUBRE - DICIEMBRE">OCTUBRE - DICIEMBRE</option>
                    </select> 
                    <span class="input-group-addon"><i class="fa fa-history"></i></span>
                </div>
                <!-- ID del elemento -->
                <div class="input-group">
                   <textarea name="comentario-reserva" type="text-area" id="comentario-reservar-mag" class="form-control"  placeholder="Puedes agregar un comentario aquí"></textarea>
                   <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
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
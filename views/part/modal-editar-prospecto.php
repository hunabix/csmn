<!-- Modal Reservar para futuros ciclos | individual-->
<div class="modal fade modal-prospecto" id="modal-prospecto" tabindex="-1" role="dialog" aria-labelledby="titulo-modal-regular" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del modal  -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titulo-modal-regular">
                    Editar información de prospecto
                </h4>
            </div>
            <!-- Cuerpo del modal  -->
            <div class="modal-body">
                <!-- Nombre -->
                <div class="input-group nombre">
                    <input name="nombre" type="text" id="nombre-prospecto" class="form-control"  placeholder="Nombre" value="">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                </div>
                <!-- Apellidos -->
                <div class="input-group apellidos">
                    <input name="apellidos" type="text" id="apellidos-prospecto" class="form-control"  placeholder="Apellido(s)" value="">
                    <span class="input-group-addon"><i class="fa"></i></span>
                </div>
                <!-- Correo -->
                <div class="input-group correo">
                    <input name="correo" type="email" id="correo-prospecto"class="form-control"  placeholder="Correo electrónico" value="">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                </div>
                <!-- Teléfono -->
                <div class="input-group telefono">
                    <input name="telefono" type="text" id="telefono-prospecto"class="form-control"  placeholder="Teléfono" value="">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                </div>
                <!-- País -->
                <div class="input-group ciudad">
                    <input name="pais" type="text" id="pais-prospecto" class="form-control"  placeholder="País" value="">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                </div>
                <!-- Ciudad -->
                <div class="input-group ciudad">
                    <input name="ciudad" type="text" id="ciudad-prospecto" class="form-control"  placeholder="Ciudad" value="">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                </div>
                <!-- Instrumento -->
                <div class="input-group instrumento">
                    <input name="instrumento" type="text" id="instrumento-prospecto" class="form-control"  placeholder="Instrumento" value="">
                    <span class="input-group-addon"><i class="fa fa-music"></i></span>
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
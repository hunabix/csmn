<!-- Modal | individual-->
<div class="modal fade modal-multi" id="modal-multi" tabindex="-1" role="dialog" aria-labelledby="titulo-modal-regular" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del modal  -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titulo-modal-multi">
                    <!-- Aquí se imprime el título -->
                </h4>
            </div>
            <!-- Cuerpo del modal  -->
            <div class="modal-body">

                <label id="es-llamada" class="fancy-check es-llamada">
                    <input name="llamada" value="1" type="checkbox" class="check">
                    <span class="fa fa-square-o check-icon"></span>
                    <span class="name">Registrar llamada</span>
                </label>

                <!-- ID del elemento -->
                <div class="input-group">
                   <textarea name="comentario" id="comentario-multi" type="text-area" class="form-control"  placeholder="Puedes agregar un comentario aquí"></textarea>
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
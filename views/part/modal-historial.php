<!-- Modal Reservar para futuros ciclos | individual-->
<div class="modal fade modal-historial" id="modal-historial" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Encabezado del modal  -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Historial de interacciones
                </h4>
            </div>
            <!-- Cuerpo del modal  -->
            <div class="modal-body">

                <!-- Contenedor de los tabs del acordeón -->
                <div class="panel-group" id="acordeon-historial" role="tablist" aria-multiselectable="true">
                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                        <!-- Tab -->
                        <div class="panel panel-default panel-historial">
                            <div class="panel-heading" role="tab" id="heading<?= $i; ?>">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#collapse<?= $i; ?>" aria-expanded="false" aria-controls="collapse<?= $i; ?>">
                                        Titulo <?= $i; ?> de la interacción
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?= $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $i; ?>">
                                <div class="panel-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae atque, nobis quas recusandae, pariatur culpa eaque magnam repellat delectus cupiditate, nulla adipisci odio doloremque aliquid ratione quidem qui nisi corporis quibusdam? Voluptas asperiores consequatur aut tempore laborum, blanditiis obcaecati. Beatae sapiente eos alias praesentium in sunt dolorum ex, corporis voluptas.
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                
                  

            </div>
            <!-- Pié del modal  -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
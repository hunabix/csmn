<?php
/**
 * Plantilla [home]
 **/
require_once("part/header.php"); ?>


<!-- Muestreo de variables [PRUEBAS]
================================================== --> 
<div id="trace-block" class="contenido alert alert-warning alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <p class="datos">&nbsp;</p>
</div>
<!-- Muestreo de variables [PRUEBAS]
================================================== --> 


<!-- Titulo -->
<h2 class="section-title">Casos de seguimiento</h2>

<!-- Casos de seguimiento -->
<section class="monitoring">

    <!-- Formulario de acciones y recordatorios en lote
        mag-form = monitoring action group form-->
    <?php require_once("part/mag-form.php");  ?>

    <!-- Lista de prospectos -->
    <form id="leads-form" name="leads-form" class="leads form" action="part/process.php">
        
        <!-- Campo para saber si el formulario fué enviado -->
        <input type="hidden" name="form-name" value="leads-form">

        <!-- Encabezado -->
        <header class="titles">
            <h4 class="lt-name">
                <!-- Botón para deseleccionar todos los checkboxes -->
                <a href="" id="uncheck-all" class="uncheck-all">
                    <i class="fa fa-minus-square-o "></i>
                </a> Interesado
            </h4>
            <h4 class="lt-status">Estado actual</h4>
            <h4 class="lt-reminder">Recordatorio</h4>
            <h4 class="lt-actions">Acciones</h4>
        </header>

        <!-- Lista de prospectos -->

        <?php for ($i = 1; $i <= 20; $i++) { ?>

            <?php require("part/prospecto.php");  ?>

        <?php } ?>
        
        <!-- Modales -->
        <?php require("part/modal-multi.php");  ?>

    </form>

</section>

<div class="u-loading">
    <img src="img/loader.gif" alt="Cargando...">
</div>

<?php
require_once("part/footer.php"); ?>

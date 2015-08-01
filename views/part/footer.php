
        </section><!-- main-content -->
        
        <!-- Notificaciones
        ================================================== --> 
        <?php if (isset($user)) : ?>
            <?php require_once("notificaciones.php");  ?>
        <?php endif; ?>
	</main>
    
   

	<footer id="footer" class="footer">

        <!-- Si el usuario está logeado se muestra el botón de log out -->
        <?php if (isset($user)) : ?>    
            <div class="form">
                <a href="<?= cs_url; ?>/logout" class="btn btn-primary btn-fill sing-out-btn"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
            </div>
        <?php endif; ?>
	</footer>
    
    <!-- Llamo a jQuery directo del CDN de Google -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
    <!-- Si es el fin del mundo y Google falla, uso la versión local -->
    <script>window.jQuery || document.write('<script src="views/js/support/jquery-2.1.4.min.js">\x3C/script>')</script>
    <!-- Scripts de JS de Boostrap -->
    <script src="views/js/support/bootstrap.js" type="text/javascript"></script>
    <!-- Scripts de JS del datepicker -->
    <script src="views/js/support/bootstrap-datepicker.js"></script>
    <!-- Script para multiple selección de checkboxes con shift -->
    <script src="views/js/support//jquery.tshift.min.js"></script>
    <!-- Scripts personalizados para el proyecto -->
    <script src="views/js/app.js"></script>
   
    
    
</body>

</html>
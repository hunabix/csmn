<?php
/**
 * Plantilla [login]
 **/
require_once("part/header.php"); ?>
	
		<form id="login-form" name="login-form" class="login-form form" action="<?= cs_url; ?>/login.php" method="post">
			<!-- Nombre -->
			<div class="input-group usuario">
			    <input name="usuario" type="text" class="form-control"  placeholder="Usuario" value="" required>
			    <span class="input-group-addon"><i class="fa fa-user"></i></span>
			</div>
			<!-- Apellidos -->
			<div class="input-group clave">
			    <input name="clave" type="password" class="form-control"  placeholder="Contraseña" value="" required>
			    <span class="input-group-addon"><i class="fa"></i></span>
			</div>
			<div class="login-btn">         
			    <button type="submit" name="mag-reminder-btn" class="btn btn-primary btn-fill">Ingresar</button>
			</div>
		</form>

<?php
require_once("part/footer.php"); ?>

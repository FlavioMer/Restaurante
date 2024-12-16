<!-- Login -->
<div class="login-container">
	<div class="login-content">
	<form action="" method="post" class="form-login text-center" autocomplete="off">
	<img src=" <?php echo urlServidor; ?>public/images/stik.png" alt="" class="" width="85" height="85">
		<p class="text-uppercase pt-2 mb-0">Inicia sesión con tu cuenta</p>
        <div class="py-3">
            <input type="text" name="login_usuario" class="form-control input-login">
        </div>
        <div class="py-2">
            <input type="password" name="login_clave" class="form-control input-login">
        </div>
        <div class="text-center pt-2">
            <button type="submit" class="btn btn-login ">Entrar al sistema</button>
        </div>
	</form>
	</div>
</div>
<?php
if (isset($_POST['login_usuario']) && isset($_POST['login_clave'])) {
	require_once "./controlador/loginControlador.php";
	$login_controlador = new loginControlador();
	echo $login_controlador->iniciar_sesion_contolador();
}
?>
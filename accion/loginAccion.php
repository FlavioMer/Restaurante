<?php

$accion = true;

require_once "../config/sistema.php";

if (isset($_POST['token']) && isset($_POST['usuario'])) {

	require_once "../controlador/loginControlador.php";
	$login_controlador =  new loginControlador();
	echo $login_controlador->cerrar_sesion_controlador();

} else {

	session_start(['name' => 'sistema']);
	session_unset();
	session_destroy();
	header("Location: ".urlServidor."login/");
	exit();

}
<?php

$accion = true;
require_once "../config/sistema.php";

if (isset($_POST['usuario_nombre_nuevo']) || isset($_POST['usuario_id_actualizar']) || isset($_POST['usuario_id_eliminar'])) {

	# Instancia al controlador usuario
	require_once "../controlador/usuarioControlador.php";
	$usuario_controlador = new usuarioControlador();

	# Registrar un usuario
	if (isset($_POST['usuario_nombre_nuevo']) && isset($_POST['usuario_correo_nuevo'])) {
		echo $usuario_controlador->nuevo_usuario_controlador();
	}

	# Actualizar un usuario
	if (isset($_POST['usuario_id_actualizar'])) {
		echo $usuario_controlador->actualizar_usuario_controlador();
	}

	# Eliminar un usuario
	if (isset($_POST['usuario_id_eliminar'])) {
		echo $usuario_controlador->eliminar_usuario_controlador($_POST['usuario_id_eliminar']);
	}

} else {
	session_start(["name" => "sistema"]);
	session_unset();
	session_destroy();
	header("Location: ".urlServidor."login/");
	exit();
}
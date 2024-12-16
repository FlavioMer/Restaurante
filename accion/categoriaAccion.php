<?php

$accion = true;
require_once "../config/sistema.php";

if (isset($_POST['categoria_nombre_nuevo']) || isset($_POST['categoria_id_actualizar']) || isset($_POST['categoria_id_eliminar'])) {

	# Instancia al controlador usuario
	require_once "../controlador/categoriaControlador.php";
	$categoria_controlador = new categoriaControlador();

	# Registrar un usuario
	if (isset($_POST['categoria_nombre_nuevo'])) {
		echo $categoria_controlador->nuevo_categoria_controlador();
	}

	# Actualizar un usuario
	if (isset($_POST['categoria_id_actualizar'])) {
		echo $categoria_controlador->actualizar_categoria_controlador();
	}

	# Eliminar un usuario
	if (isset($_POST['categoria_id_eliminar'])) {
		echo $categoria_controlador->eliminar_categoria_controlador($_POST['categoria_id_eliminar']);
	}

} else {
	session_start(["name" => "sistema"]);
	session_unset();
	session_destroy();
	header("Location: ".urlServidor."login/");
	exit();
}
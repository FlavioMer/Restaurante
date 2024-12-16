<?php

$accion = true;
require_once "../config/sistema.php";

if (isset($_POST['producto_nombre_nuevo']) || isset($_POST['producto_id_actualizar']) || isset($_POST['producto_id_eliminar'])) {

	# Instancia al controlador usuario
	require_once "../controlador/productoControlador.php";
	$producto_controlador = new productoControlador();

	# Registrar un usuario
	if (isset($_POST['producto_nombre_nuevo']) && isset($_POST['producto_precio_nuevo'])) {
		echo $producto_controlador->nuevo_producto_controlador();
	}

	# Actualizar un usuario
	if (isset($_POST['producto_id_actualizar'])) {
		echo $producto_controlador->actualizar_producto_controlador();
	}

	# Eliminar un usuario
	if (isset($_POST['producto_id_eliminar'])) {
		echo $producto_controlador->eliminar_producto_controlador($_POST['producto_id_eliminar']);
	}

} else {
	session_start(["name" => "sistema"]);
	session_unset();
	session_destroy();
	header("Location: ".urlServidor."login/");
	exit();
}
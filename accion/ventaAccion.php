<?php

$accion = true;
require_once "../config/sistema.php";

if (isset($_POST['venta_nombre_nuevo']) || isset($_POST['venta_id_actualizar']) || isset($_POST['venta_id_eliminar'])) {

	# Instancia al controlador usuario
	require_once "../controlador/ventaControlador.php";
	$venta_controlador = new ventaControlador();

	# Registrar un usuario
	if (isset($_POST['venta_nombre_nuevo']) && isset($_POST['venta_precio_nuevo'])) {
		echo $venta_controlador->nuevo_venta_controlador();
	}

	# Actualizar un usuario
	if (isset($_POST['venta_id_actualizar'])) {
		echo $venta_controlador->actualizar_venta_controlador();
	}

	# Eliminar un usuario
	if (isset($_POST['venta_id_eliminar'])) {
		echo $venta_controlador->eliminar_venta_controlador($_POST['venta_id_eliminar']);
	}

} else {
	session_start(["name" => "sistema"]);
	session_unset();
	session_destroy();
	header("Location: ".urlServidor."login/");
	exit();
}
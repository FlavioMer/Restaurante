<?php

require_once "./modelo/vistaModelo.php";

class vistaControlador extends vistaModelo {

	# Función para obtener la plantilla
	public function obtener_plantilla_controlador() {
		return require_once "./vista/plantilla.php";
	}

	# Función para obtener las vistas
	public function obtener_vista_controlador() {
		if (isset($_GET["vista"])) {
			$ruta = explode("/", $_GET["vista"]);
			$respuesta = vistaModelo::obtener_vista_modelo($ruta[0]);
		}
		return $respuesta;
	}

}
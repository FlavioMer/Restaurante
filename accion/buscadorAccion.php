<?php

session_start(["name" => "sistema"]);
require_once "../config/sistema.php";

if (isset($_POST['buscar_palabra']) || isset($_POST['eliminar_busqueda'])) {

	$urls = [
		"usuario" => "usuario-buscar",
		"producto" => "producto-buscar",
		"categoria"=> "categoria-buscar"
	];

	if (isset($_POST['modulo'])) {
		$modulo = $_POST['modulo'];
		if (!isset($urls[$modulo])) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"¡Ocurrio un error!",
				"Texto"=>"No podemos procesar la búsqueda.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}
	} else {
		$alerta = [
			"Alerta"=>"simple",
			"Titulo"=>"¡Ocurrio un error!",
			"Texto"=>"No sea puede realizar la búsqueda.",
			"Icon"=>"error"
		];
		echo json_encode($alerta);
		exit();
	}

	if ($modulo == "reporte") {

	} else {
		$nombre_busqueda = "busqueda_".$modulo;
		if (isset($_POST['buscar_palabra'])) {
			if ($_POST['buscar_palabra'] == "") {
				$alerta = [
					"Alerta"=>"simple",
					"Titulo"=>"¡Ocurrio un error!",
					"Texto"=>"Escriba una palabra para empezar la búsqueda.",
					"Icon"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
			$_SESSION[$nombre_busqueda] = $_POST['buscar_palabra'];
		}

		if (isset($_POST['eliminar_busqueda'])) {
			unset($_SESSION[$nombre_busqueda]);
		}
	}

	$url = $urls[$modulo];
	$alerta = [
		"Alerta"=>"redireccionar",
		"URL"=>urlServidor.$url."/"
	];

	echo json_encode($alerta);

} else {

	session_unset();
	session_destroy();
	header("Location: ".urlServidor."login/");
	exit();

}
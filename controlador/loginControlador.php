<?php

if ($accion) {
	require_once "../modelo/loginModelo.php";
} else {
	require_once "./modelo/loginModelo.php";
}

class loginControlador extends loginModelo {

	# Función para iniciar sesión
	public function iniciar_sesion_contolador() {
		$usuario = principalModelo::limpiar_cadena($_POST['login_usuario']);
		$clave = principalModelo::limpiar_cadena($_POST['login_clave']);

		if ($usuario == "" || $clave == "") {
			echo '
				<script>
					Swal.fire({
						title: "Ocurrio un error",
						text: "No has llenado los campos que son requeridos",
						icon: "error",
						confirmButtonText: "Aceptar"
					});
				</script>
			';
			exit();
		}

		if (principalModelo::verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {
			echo '
				<script>
					Swal.fire({
						title: "ocurrio un error",
						text: "El usuario no coincide con el formato solicitado.",
						icon: "error",
						confirmButtonText: "Aceptar"
					});
				</script>
			';
			exit();
		}

		if (principalModelo::verificar_datos("[a-zA-Z0-9$@#.-]{8,20}", $clave)) {
			echo '
				<script>
					Swal.fire({
						title: "ocurrio un error",
						text: "La clave no coincide con el formato solicitado.",
						icon: "error",
						confirmButtonText: "Aceptar"
					});
				</script>
			';
			exit();
		}

		$clave = principalModelo::encriptar($clave);

		$datos = [
			"usuario"=>$usuario,
			"clave"=>$clave
		];

		$datos_login = loginModelo::iniciar_sesion_modelo($datos);

		if ($datos_login->rowCount() == 1) {
			$fila = $datos_login->fetch();
			session_start(['name' => 'sistema']);
			$_SESSION['id_sistema'] = $fila['usuario_id'];
			$_SESSION['nombre_sistema'] = $fila['usuario_nombre'];
			$_SESSION['apellido_sistema'] = $fila['usuario_apellido'];
			$_SESSION['usuario_sistema'] = $fila['usuario_usuario'];
			$_SESSION['privilegio_sistema'] = $fila['usuario_privilegio'];
			$_SESSION['token_sistema'] = md5(uniqid(mt_rand(), true));

			return header("Location: ".urlServidor."home/");

		} else {
			echo '
				<script>
					Swal.fire({
						title: "Ocurrio un error",
						text: "El usuario o la clave son incorrectos.",
						icon: "error",
						confirmButtonText: "Aceptar"
					});
				</script>
			';
		}

	}

	# Función para cerrar la sesión
	public function cerrar_sesion_controlador() {
		session_start(['name' => 'sistema']);
		$token = principalModelo::desencriptar($_POST['token']);
		$usuario = principalModelo::desencriptar($_POST['usuario']);

		if ($token == $_SESSION['token_sistema'] && $usuario == $_SESSION['usuario_sistema']) {
			session_unset();
			session_destroy();
			$alerta = [
				"Alerta"=>"redireccionar",
				"URL"=>urlServidor."login/"
			];
		} else {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"No se pudo cerrar la sesión en el sistema.",
				"Tipo"=>"error"
			];
		}
		echo json_encode($alerta);
	}

	# Función para forzar el cierre de sesión
	public function forzar_cierre_sesion() {
		session_unset();
		session_destroy();
		if (headers_sent()) {
			return "<script> window.location.href='".urlServidor."login/'; </script>";
		} else {
			return header("Location: ".urlServidor."login/");
		}
	}

}
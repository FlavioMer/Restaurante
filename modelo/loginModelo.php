<?php

require_once "principalModelo.php";

class loginModelo extends principalModelo {

	# Función para iniciar sesión
	protected static function iniciar_sesion_modelo($datos) {
		$sql = principalModelo::conectar()->prepare("SELECT * FROM usuarios WHERE usuario_usuario = :usuario AND usuario_clave = :clave AND usuario_estado = 'Activo'");
		$sql->bindParam(":usuario", $datos['usuario']);
		$sql->bindParam(":clave", $datos['clave']);
		$sql->execute();
		return $sql;
	}

}
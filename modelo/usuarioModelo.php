<?php

require_once "principalModelo.php";

class usuarioModelo extends principalModelo {

	# Función para seleccionar los datos de un usuario
	protected static function seleccionar_usuario_modelo($tipo, $id) {
		if ($tipo == "unico") {
			$sql = principalModelo::conectar()->prepare("SELECT * FROM usuarios WHERE usuario_id = :id");
			$sql->bindParam(":id", $id);
		} elseif ($tipo == "contar") {
			$sql = principalModelo::conectar()->prepare("SELECT usuario_id FROM usuarios WHERE usuario_id != '1'");
		}
		$sql->execute();
		return $sql;
	}

	# Función para registrar los datos de un usuario
	protected static function nuevo_usuario_modelo($datos) {
		$sql = principalModelo::conectar()->prepare("INSERT INTO usuarios(usuario_nombre, usuario_apellido, usuario_direccion, usuario_telefono, usuario_correo,usuario_usuario, usuario_clave, usuario_privilegio, usuario_estado) VALUE(:nombre, :apellido, :direccion, :telefono, :correo, :usuario, :clave, :privilegio, 'Activo')");
		$sql->bindParam(":nombre", $datos['nombre']);
		$sql->bindParam(":apellido", $datos['apellido']);
		$sql->bindParam(":direccion", $datos['direccion']);
		$sql->bindParam(":telefono", $datos['telefono']);
		$sql->bindParam(":correo", $datos['correo']);
		$sql->bindParam(":usuario", $datos['usuario']);
		$sql->bindParam(":clave", $datos['clave']);
		$sql->bindParam(":privilegio", $datos['privilegio']);
		$sql->execute();
		return $sql;
	}

	# Función para actualizar los datos de un usuario
	protected static function actualizar_usuario_modelo($datos) {
		$sql = principalModelo::conectar()->prepare("UPDATE usuarios SET usuario_nombre = :nombre, usuario_apellido = :apellido, usuario_direccion = :direccion, usuario_telefono = :telefono, usuario_correo = :correo, usuario_usuario = :usuario, usuario_clave = :clave, usuario_privilegio = :privilegio WHERE usuario_id = :id AND usuario_id != '1'");
		$sql->bindParam(":nombre", $datos['nombre']);
		$sql->bindParam(":apellido", $datos['apellido']);
		$sql->bindParam(":direccion", $datos['direccion']);
		$sql->bindParam(":telefono", $datos['telefono']);
		$sql->bindParam(":correo", $datos['correo']);
		$sql->bindParam(":usuario", $datos['usuario']);
		$sql->bindParam(":clave", $datos['clave']);
		$sql->bindParam(":privilegio", $datos['privilegio']);
		$sql->bindParam(":id", $datos['id']);
		$sql->execute();
		return $sql;
	}

	# Función para eliminar los datos de un usuario
	protected static function eliminar_usuario_modelo($id) {
		$sql = principalModelo::conectar()->prepare("DELETE FROM usuarios WHERE usuario_id = :id AND usuario_id != 1");
		$sql->bindParam(":id", $id);
		$sql->execute();
		return $sql;
	}

}
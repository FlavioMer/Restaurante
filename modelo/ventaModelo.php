<?php

require_once "principalModelo.php";

class ventaModelo extends principalModelo {

	# Función para seleccionar los datos de un usuario
	protected static function seleccionar_venta_modelo($tipo, $id) {
		if ($tipo == "unico") {
			$sql = principalModelo::conectar()->prepare("SELECT * FROM ventas WHERE venta_id = :id");
			$sql->bindParam(":id", $id);
		} elseif ($tipo == "contar") {
			$sql = principalModelo::conectar()->prepare("SELECT venta_id FROM ventas WHERE venta_id != '0'");
		}
		$sql->execute();
		return $sql;
	}

	# Función para registrar los datos de una venta
	protected static function nuevo_venta_modelo($datos) {
		$sql = principalModelo::conectar()->prepare("INSERT INTO ventas(venta_nombre, venta_precio, venta_descripcion, venta_stock, categoria_id) VALUE(:nombre, :precio, :descripcion, :stock, :categoria)");
		$sql->bindParam(":nombre", $datos['nombre']);
		$sql->bindParam(":precio", $datos['precio']);
		$sql->bindParam(":descripcion", $datos['descripcion']);
		$sql->bindParam(":stock", $datos['stock']);
		$sql->bindParam(":categoria", $datos['categoria']);
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
	protected static function eliminar_venta_modelo($id) {
		$sql = principalModelo::conectar()->prepare("DELETE FROM ventas WHERE venta_id = :id AND venta_id != 1");
		$sql->bindParam(":id", $id);
		$sql->execute();
		return $sql;
	}

}
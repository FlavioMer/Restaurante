<?php

require_once "principalModelo.php";

class productoModelo extends principalModelo {

	# Función para seleccionar los datos de un usuario
	protected static function seleccionar_producto_modelo($tipo, $id) {
		if ($tipo == "unico") {
			$sql = principalModelo::conectar()->prepare("SELECT * FROM productos WHERE producto_id = :id");
			$sql->bindParam(":id", $id);
		} elseif ($tipo == "contar") {
			$sql = principalModelo::conectar()->prepare("SELECT producto_id FROM productos WHERE producto_id != '0'");
		}
		$sql->execute();
		return $sql;
	}

	public function listar_productos_modelo() {
		$sql = principalModelo::conectar()->prepare("SELECT producto_id, producto_nombre FROM productos WHERE producto_id != '0'");
		$sql->execute();
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	# Función para registrar los datos de un usuario
	protected static function nuevo_producto_modelo($datos) {
		$sql = principalModelo::conectar()->prepare("INSERT INTO productos(producto_nombre, producto_precio, producto_descripcion, producto_stock, categoria_id) VALUE(:nombre, :precio, :descripcion, :stock, :categoria)");
		$sql->bindParam(":nombre", $datos['nombre']);
		$sql->bindParam(":precio", $datos['precio']);
		$sql->bindParam(":descripcion", $datos['descripcion']);
		$sql->bindParam(":stock", $datos['stock']);
		$sql->bindParam(":categoria", $datos['categoria']);
		$sql->execute();
		return $sql;
	}

	# Función para actualizar los datos de un usuario
	protected static function actualizar_producto_modelo($datos) {
		$sql = principalModelo::conectar()->prepare("UPDATE productos SET producto_nombre = :nombre, producto_precio = :precio, producto_descripcion = :descripcion, producto_stock = :stock, categoria_id = :categoria WHERE producto_id = :id ");
		$sql->bindParam(":nombre", $datos['nombre']);
		$sql->bindParam(":precio", $datos['precio']);
		$sql->bindParam(":descripcion", $datos['descripcion']);
		$sql->bindParam(":stock", $datos['stock']);
		$sql->bindParam(":categoria", $datos['categoria']);
		$sql->bindParam(":id", $datos['id']);
		$sql->execute();
		return $sql;
	}

	# Función para eliminar los datos de un usuario
	protected static function eliminar_producto_modelo($id) {
		$sql = principalModelo::conectar()->prepare("DELETE FROM productos WHERE producto_id = :id AND producto_id != 1");
		$sql->bindParam(":id", $id);
		$sql->execute();
		return $sql;
	}

}
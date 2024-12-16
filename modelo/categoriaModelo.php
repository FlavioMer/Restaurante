<?php

require_once "principalModelo.php";

class categoriaModelo extends principalModelo {

	# Función para seleccionar los datos de un usuario
	protected static function seleccionar_categoria_modelo($tipo, $id) {
		if ($tipo == "unico") {
			$sql = principalModelo::conectar()->prepare("SELECT * FROM categorias WHERE categoria_id = :id");
			$sql->bindParam(":id", $id);
		} elseif ($tipo == "contar") {
			$sql = principalModelo::conectar()->prepare("SELECT categoria_id FROM categorias WHERE categoria_id != '0'");
		}
		$sql->execute();
		return $sql;
	}

	public function listar_categorias_modelo() {
		$sql = principalModelo::conectar()->prepare("SELECT categoria_id, categoria_nombre FROM categorias WHERE categoria_id != '0'");
		$sql->execute();
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	

	# Función para registrar los datos de un usuario
	protected static function nuevo_categoria_modelo($datos) {
		$sql = principalModelo::conectar()->prepare("INSERT INTO categorias(categoria_nombre) VALUES(:nombre)");
		$sql->bindParam(":nombre", $datos['nombre']);
		$sql->execute();
		return $sql;
	}

	# Función para actualizar los datos de un usuario
	protected static function actualizar_categoria_modelo($datos) {
		$sql = principalModelo::conectar()->prepare("UPDATE categorias SET categoria_nombre = :nombre WHERE categoria_id = :id ");
		$sql->bindParam(":nombre", $datos['nombre']);
		$sql->bindParam(":id", $datos['id']);
		$sql->execute();
		return $sql;
	}

	# Función para eliminar los datos de un usuario
	protected static function eliminar_categoria_modelo($id) {
		$sql = principalModelo::conectar()->prepare("DELETE FROM categorias WHERE categoria_id = :id ");
		$sql->bindParam(":id", $id);
		$sql->execute();
		return $sql;
	}

}
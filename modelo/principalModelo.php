<?php

if ($accion) {
	require_once "../config/servidor.php";
} else {
	require_once "./config/servidor.php";
}

class principalModelo {

	protected static function conectar() {
		$conexion = new PDO(pdo, usuario, clave);
		$conexion->exec("SET CHARACTER SET utf8");
		return $conexion;
	}

	protected static function ejecutar_consulta_simple($consulta) {
		$sql = self::conectar()->prepare($consulta);
		$sql->execute();
		return $sql;
	}

	public function encriptar($cadena) {
		$salida = false;
		$lp  = hash('sha256', llave_primaria);
		$li = substr(hash('sha256', llave_inversa), 0, 16);
		$salida = openssl_encrypt($cadena, metodo, $lp, 0, $li);
		$salida = base64_encode($salida);
		return $salida;
	}

	protected static function desencriptar($cadena) {
		$lp = hash('sha256', llave_primaria);
		$li = substr(hash('sha256', llave_inversa), 0, 16);
		$salida = openssl_decrypt(base64_decode($cadena), metodo, $lp, 0, $li);
		return $salida;
	}

	protected static function verificar_datos($filtro, $cadena){
		if (preg_match("/^".$filtro."$/", $cadena)) {
			return false;
		} else {
			return true;
		}
	}

	protected static function limpiar_cadena($cadena){
		$cadena = trim($cadena);
		$cadena = stripslashes($cadena);
		$cadena = str_ireplace("<script>", "", $cadena);
		$cadena = str_ireplace("</script>", "", $cadena);
		$cadena = str_ireplace("<script src", "", $cadena);
		$cadena = str_ireplace("<script type=", "", $cadena);
		$cadena = str_ireplace("SELECT * FROM", "", $cadena);
		$cadena = str_ireplace("DELETE FROM", "", $cadena);
		$cadena = str_ireplace("INSERT INTO", "", $cadena);
		$cadena = str_ireplace("DROP TABLE", "", $cadena);
		$cadena = str_ireplace("DROP DATABASE", "", $cadena);
		$cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena = str_ireplace("SHOW TABLES", "", $cadena);
		$cadena = str_ireplace("SHOW DATABASES", "", $cadena);
		$cadena = str_ireplace("<?php", "", $cadena);
		$cadena = str_ireplace("?>", "", $cadena);
		$cadena = str_ireplace("--", "", $cadena);
		$cadena = str_ireplace(">", "", $cadena);
		$cadena = str_ireplace("<", "", $cadena);
		$cadena = str_ireplace("[", "", $cadena);
		$cadena = str_ireplace("]", "", $cadena);
		$cadena = str_ireplace("^", "", $cadena);
		$cadena = str_ireplace("==", "", $cadena);
		$cadena = str_ireplace(";", "", $cadena);
		$cadena = str_ireplace("::", "", $cadena);
		$cadena = stripslashes($cadena);
		$cadena = trim($cadena);
		return $cadena;
	}

}
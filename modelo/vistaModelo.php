<?php

class vistaModelo {

	# Función para obtener las vistas
	protected static function obtener_vista_modelo($vistas) {
		$listaBlanca = ["home", "usuario-nuevo", "usuario-listar", "usuario-buscar","usuario-editar", "usuario-pdf", "producto-nuevo", "producto-buscar", "producto-listar", "producto-editar", "producto", "categoria-nuevo", "categoria-listar", "categoria-buscar", "categoria-editar", "venta-nuevo"];
		if (in_array($vistas, $listaBlanca)) {
			if (is_file("./vista/pagina/".$vistas.".php")) {
				$pagina = "./vista/pagina/".$vistas.".php";
			} else {
				$pagina = "404";
			}
		} else if ($vistas == "index" || $vistas == "login") {
			$pagina = "login";
		} else {
			$pagina = "404";
		}
		return $pagina;
	}

}
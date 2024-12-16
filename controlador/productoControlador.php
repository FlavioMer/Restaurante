<?php

if ($accion) {
	require_once "../modelo/productoModelo.php";
} else {
	require_once "./modelo/productoModelo.php";
}

class productoControlador extends productoModelo {

	# Función para listar los usuarios de la DB
	public function listar_productos_controlador($pagina, $registros, $url, $busqueda) {
		$pagina = principalModelo::limpiar_cadena($pagina);
		$registros  = principalModelo::limpiar_cadena($registros);
		$url = principalModelo::limpiar_cadena($url);
		$busqueda = principalModelo::limpiar_cadena($busqueda);
		$url = urlServidor.$url."/";
		$tabla = "";

		$pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1 ;
		$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0 ;

		if (isset($busqueda) && $busqueda != "") {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.categoria_id WHERE ((producto_id != '0') AND (producto_nombre LIKE '%$busqueda%' OR producto_descripcion LIKE '%$busqueda%')) ORDER BY producto_nombre ASC LIMIT $inicio, $registros";
		} else {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.categoria_id WHERE producto_id != '0' AND producto_id != '0' ORDER BY producto_nombre ASC LIMIT $inicio, $registros";
		}

		$conexion = principalModelo::conectar();
		$datos = $conexion->query($consulta);
		$datos = $datos->fetchAll();
		$total = $conexion->query("SELECT FOUND_ROWS()");
		$total = (int) $total->fetchColumn();
		$npaginas = ceil($total / $registros);

		$tabla.= '
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead class="fs-8">
						<tr class="text-center">
							<th scope="col">#</th>
							<th scope="col">Nombre</th>
							<th scope="col">Precio</th>
							<th scope="col">descripcion</th>
							<th scope="col">Stock</th>
							<th scope="col">Categoria</th>
						</tr>
					</thead>
					<tbody class="text-center fs-7">
		';
		if ($total >= 1 && $pagina <= $npaginas) {
			$contador = $inicio + 1;
			foreach ($datos as $dato) {
				$tabla.= '
						<tr>
							<td>'.$contador.'</td>
							<td>'.$dato['producto_nombre'].'</td>
							<td>'.$dato['producto_precio'].'</td>
							<td>'.$dato['producto_descripcion'].'</td>
							<td>'.$dato['producto_stock'].'</td>
							<td>'.$dato['categoria_nombre'].'</td>
							<td class="d-flex justify-content-center">
								<a href="'.urlServidor.'producto-editar/'.principalModelo::encriptar($dato['producto_id']).'/" class="btn btn-sm btn-warning mx-1"><i class="fas fa-pen"></i></a>
								<form action="'.urlServidor.'accion/productoAccion.php" method="POST" class="Formulario" data-form="eliminar" autocomplete="off" >
									<input type="hidden" name="producto_id_eliminar" value="'.principalModelo::encriptar($dato['producto_id']).'">
									<button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
								</form>
							</td>
						</tr>
				';
				$contador++;
			}
		} else {
			if ($total >= 1) {
				$tabla.= '
						<tr>
							<td colspan="6">
								<a href="'.$url.'" class="btn btn-sm btn-primary">Recargar la lista de usuarios</a>
							</td>
						</tr>
				';
			} else {
				$tabla.= '
						<tr>
							<td colspan="6">
								<div class="alert alert-danger mb-0">
									No hay registros de productos en el sistema.
								</div>
							</td>
						</tr>
				';
			}
		}
		$tabla.= '
					</tbody>
				</table>
			</div>
		';
		if ($total >= 1 && $pagina <= $npaginas) {
			#$tabla.= principalModelo::paginador_tablas($pagina, $npaginas, $url, 7);
		}

		return $tabla;

	}

	# Función para seleccionar un usuario
	public function seleccionar_producto_controlador($tipo, $id) {
		$tipo = principalModelo::limpiar_cadena($tipo);
		$id = principalModelo::desencriptar($id);
		$id = principalModelo::limpiar_cadena($id);
		return productoModelo::seleccionar_producto_modelo($tipo, $id);
	}

	# función para registrar un usuario
	public function nuevo_producto_controlador() {
		# Recibiendo datos del formulario
		$categoria = principalModelo::limpiar_cadena($_POST['producto_categoria_nuevo']);
		$nombre = principalModelo::limpiar_cadena($_POST['producto_nombre_nuevo']);
		$precio = principalModelo::limpiar_cadena($_POST['producto_precio_nuevo']);
		$descripcion = principalModelo::limpiar_cadena($_POST['producto_descripcion_nuevo']);
		$stock = principalModelo::limpiar_cadena($_POST['producto_stock_nuevo']);
		

		# Comprobando campos vacios
		if ($categoria == "" || $nombre == "" || $precio == "" || $descripcion == "" || $stock == "" ) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"No has llenado todos los campos que son obligatorios.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		# Comprobando la integridad de los datos
		if ($categoria < 1 ) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"La categoria seleccionado no es valido.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (principalModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}", $nombre)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El nombre no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (principalModelo::verificar_datos("[0-9.]{1,10}", $precio)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El precio no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (principalModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ]{1,100}", $descripcion)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"La descripción no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (principalModelo::verificar_datos("[0-9]{1,10}", $stock)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El stock no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		$datos_producto = [
			"nombre"=>$nombre,
			"precio"=>$precio,
			"descripcion"=>$descripcion,
			"stock"=>$stock,
			"categoria"=>$categoria
		];

		$nuevo_producto = productoModelo::nuevo_producto_modelo($datos_producto);

		if ($nuevo_producto->rowCount() == 1) {
			$alerta = [
				"Alerta"=>"limpiar",
				"Titulo"=>"Producto registrado",
				"Texto"=>"Los datos se guardaron con exito en el sistema.",
				"Icon"=>"success"
			];
		} else {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"No se guardaron los datos en el sistema.",
				"Icon"=>"error"
			];
		}

		echo json_encode($alerta);

	}

	# Función para actualizar un usuario
	public function actualizar_producto_controlador() {
		# Revisando el ID si existe en la base de datos
		$id = principalModelo::desencriptar($_POST['producto_id_actualizar']);
		$id = principalModelo::limpiar_cadena($id);
		$checar_id =  principalModelo::ejecutar_consulta_simple("SELECT * FROM productos WHERE producto_id = '$id'");
		if ($checar_id->rowCount() <= 0) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrio un error",
				"Texto"=>"No se ha encontrado el producto en el sistema.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		} else {
			$campo = $checar_id->fetch();
		}

		# Recibiendo datos del formulario
		$categoria = principalModelo::limpiar_cadena($_POST['producto_categoria_actualizar']);
		$nombre = principalModelo::limpiar_cadena($_POST['producto_nombre_actualizar']);
		$precio = principalModelo::limpiar_cadena($_POST['producto_precio_actualizar']);
		$descripcion = principalModelo::limpiar_cadena($_POST['producto_descripcion_actualizar']);
		$stock = principalModelo::limpiar_cadena($_POST['producto_stock_actualizar']);
		

		/** Comprobar campos vacios */
		if ($categoria== "" || $nombre == "" || $precio == "" || $descripcion == "" || $stock == "" ) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrio un error",
				"Texto"=>"No has llenado todos los campos que son requeridos.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (principalModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}", $nombre)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El nombre no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (principalModelo::verificar_datos("[0-9.]{1,10}", $precio)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El precio no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (principalModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ]{1,100}", $descripcion)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"La descripción no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (principalModelo::verificar_datos("[0-9]{1,10}", $stock)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El stock no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}


		$datos_producto = [
			"nombre"=>$nombre,
			"precio"=>$precio,
			"descripcion"=>$descripcion,
			"stock"=>$stock,
			"categoria"=>$categoria
		];

		if (productoModelo::actualizar_producto_modelo($datos_producto)) {
			$alerta = [
				"Alerta"=>"recargar",
				"Titulo"=>"Producto actualizado",
				"Texto"=>"Los datos del producto han sido actualizados.",
				"Icon"=>"success"
			];
		} else {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrio un error",
				"Texto"=>"No se ha podido actualizar los datos, intente de nuevo.",
				"Icon"=>"error"
			];
		}
		echo json_encode($alerta);

	}

	# Función para eliminar un usuario
	public function eliminar_producto_controlador($id) {
		$id = principalModelo::desencriptar($_POST['producto_id_eliminar']);
		$id = principalModelo::limpiar_cadena($id);

		$eliminar_producto = productoModelo::eliminar_producto_modelo($id);

		if ($eliminar_producto->rowCount() == 1) {
			$alerta = [
				"Alerta"=>"recargar",
				"Titulo"=>"¡producto eliminado!",
				"Texto"=>"El producto fue eliminado con éxito del sistema.",
				"Icon"=>"success"
			];
		} else {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"¡Ocurrio un error!",
				"Texto"=>"No se pudo eliminar el producto, intente de nuevo.",
				"Icon"=>"error"
			];
		}
		echo json_encode($alerta);
	}

}
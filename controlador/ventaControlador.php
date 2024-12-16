<?php

if ($accion) {
	require_once "../modelo/ventaModelo.php";
} else {
	require_once "./modelo/ventaModelo.php";
}

class ventaControlador extends ventaModelo {

	# Función para listar los usuarios de la DB
	public function listar_ventas_controlador($pagina, $registros, $url, $busqueda) {
		$pagina = principalModelo::limpiar_cadena($pagina);
		$registros  = principalModelo::limpiar_cadena($registros);
		$url = principalModelo::limpiar_cadena($url);
		$busqueda = principalModelo::limpiar_cadena($busqueda);
		$url = urlServidor.$url."/";
		$tabla = "";

		$pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1 ;
		$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0 ;

		if (isset($busqueda) && $busqueda != "") {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM ventas INNER JOIN categorias ON ventas.categoria_id = categorias.categoria_id WHERE ((venta_id != '0') AND (venta_nombre LIKE '%$busqueda%' OR venta_descripcion LIKE '%$busqueda%')) ORDER BY venta_nombre ASC LIMIT $inicio, $registros";
		} else {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM ventas INNER JOIN categorias ON ventas.categoria_id = categorias.categoria_id WHERE venta_id != '0' AND venta_id != '0' ORDER BY venta_nombre ASC LIMIT $inicio, $registros";
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
							<td>'.$dato['venta_nombre'].'</td>
							<td>'.$dato['venta_precio'].'</td>
							<td>'.$dato['venta_descripcion'].'</td>
							<td>'.$dato['venta_stock'].'</td>
							<td>'.$dato['categoria_nombre'].'</td>
							<td class="d-flex justify-content-center">
								<a href="'.urlServidor.'venta-editar/'.principalModelo::encriptar($dato['venta_id']).'/" class="btn btn-sm btn-warning mx-1"><i class="fas fa-pen"></i></a>
								<form action="'.urlServidor.'accion/ventaAccion.php" method="POST" class="Formulario" data-form="eliminar" autocomplete="off" >
									<input type="hidden" name="venta_id_eliminar" value="'.principalModelo::encriptar($dato['venta_id']).'">
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
									No hay registros de ventas en el sistema.
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
	public function seleccionar_venta_controlador($tipo, $id) {
		$tipo = principalModelo::limpiar_cadena($tipo);
		$id = principalModelo::desencriptar($id);
		$id = principalModelo::limpiar_cadena($id);
		return ventaModelo::seleccionar_venta_modelo($tipo, $id);
	}

	# función para registrar un usuario
	public function nuevo_venta_controlador() {
		# Recibiendo datos del formulario
		$categoria = principalModelo::limpiar_cadena($_POST['venta_categoria_nuevo']);
		$nombre = principalModelo::limpiar_cadena($_POST['venta_nombre_nuevo']);
		$precio = principalModelo::limpiar_cadena($_POST['venta_precio_nuevo']);
		$descripcion = principalModelo::limpiar_cadena($_POST['venta_descripcion_nuevo']);
		$stock = principalModelo::limpiar_cadena($_POST['venta_stock_nuevo']);
		

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
				"Texto"=>"El categoria seleccionado no es valido.",
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
				"Texto"=>"La dirección no coincide con el formato solicitado.",
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

		$datos_venta = [
			"nombre"=>$nombre,
			"precio"=>$precio,
			"descripcion"=>$descripcion,
			"stock"=>$stock,
			"categoria"=>$categoria
		];

		$nuevo_venta = ventaModelo::nuevo_venta_modelo($datos_venta);

		if ($nuevo_venta->rowCount() == 1) {
			$alerta = [
				"Alerta"=>"limpiar",
				"Titulo"=>"venta registrado",
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
	public function actualizar_prosucto_controlador() {
		# Revisando el ID si existe en la base de datos
		$id = principalModelo::desencriptar($_POST['usuario_id_actualizar']);
		$id = principalModelo::limpiar_cadena($id);
		$checar_id =  principalModelo::ejecutar_consulta_simple("SELECT * FROM usuarios WHERE usuario_id = '$id'");
		if ($checar_id->rowCount() <= 0) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrio un error",
				"Texto"=>"No se ha encontrado el usuario en el sistema.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		} else {
			$campo = $checar_id->fetch();
		}

		# Recibiendo datos del formulario
		$categoria = principalModelo::limpiar_cadena($_POST['usuario_privilegio_actualizar']);
		$nombre = principalModelo::limpiar_cadena($_POST['usuario_nombre_actualizar']);
		$apellido = principalModelo::limpiar_cadena($_POST['usuario_apellido_actualizar']);
		$direccion = principalModelo::limpiar_cadena($_POST['usuario_direccion_actualizar']);
		$telefono = principalModelo::limpiar_cadena($_POST['usuario_telefono_actualizar']);
		$correo = principalModelo::limpiar_cadena($_POST['usuario_correo_actualizar']);
		$usuario = principalModelo::limpiar_cadena($_POST['usuario_usuario_actualizar']);

		if (isset($_POST['usuario_privilegio_actualizar'])) {
			$privilegio = principalModelo::limpiar_cadena($_POST['usuario_privilegio_actualizar']);
		} else {
			$privilegio = $campo['usuario_privilegio'];
		}

		$admin_usuario = principalModelo::limpiar_cadena($_POST['admin_usuario']);
		$admin_clave = principalModelo::limpiar_cadena($_POST['admin_clave']);

		$tipo_cuenta = principalModelo::limpiar_cadena($_POST['tipo_cuenta']);

		/** Comprobar campos vacios */
		if ($privilegio== "" || $nombre == "" || $apellido == "" || $direccion == "" || $telefono == "" || $correo == "" || $usuario == "" || $admin_usuario == "" || $admin_clave == "") {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrio un error",
				"Texto"=>"No has llenado todos los campos que son requeridos.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		# Comprobando la integridad de los datos
		if ($privilegio < 1 || $privilegio > 3) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El rol seleccionado no es valido.",
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

		if (principalModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,30}", $apellido)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El apellido no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (principalModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ]{1,100}", $direccion)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"La dirección no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}
		if (principalModelo::verificar_datos("[0-9]{10}", $telefono)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El telefono no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
			$checar_correo = principalModelo::ejecutar_consulta_simple("SELECT usuario_correo FROM usuarios WHERE usuario_correo = '$correo'");
			if ($checar_correo->rowCount() > 0) {
				$alerta = [
					"Alerta"=>"simple",
					"Titulo"=>"ocurrio un error",
					"Texto"=>"El correo ingresado ya esta registrado en el sistema.",
					"Icon"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		} else {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El correo ingresado no es valido.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (principalModelo::verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El usuario no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if ($_POST['usuario_clave_uno_actualizar'] != "" || $_POST['usuario_clave_dos_actualizar'] != "") {
			if ($_POST['usuario_clave_uno_actualizar'] != $_POST['usuario_clave_dos_actualizar']) {
				$alerta = [
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error",
					"Texto"=>"Las contraseñas nuevas no coinciden.",
					"Icon"=>"error"
				];
				echo json_encode($alerta);
				exit();
			} else {
				if (principalModelo::verificar_datos("[a-zA-Z0-9$@#.-]{8,20}", $_POST['usuario_clave_uno_actualizar']) || principalModelo::verificar_datos("[a-zA-Z0-9$@#.-]{8,20}", $_POST['usuario_clave_dos_actualizar'])) {
					$alerta = [
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrio un error",
						"Texto"=>"Las contraseñas no coincide con el formato solicitado.",
						"Icon"=>"error"
					];
					echo json_encode($alerta);
					exit();
				}
				$clave = principalModelo::encriptar($_POST['usuario_clave_uno_actualizar']);
			}
		} else {
			$clave = $campo['usuario_clave'];
		}

		if (principalModelo::verificar_datos("[a-zA-Z0-9]{4,20}", $admin_usuario)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"ocurrio un error",
				"Texto"=>"El usuario no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (principalModelo::verificar_datos("[a-zA-Z0-9$@#.-]{8,20}", $admin_clave)) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrio un error",
				"Texto"=>"La contraseña no coincide con el formato solicitado.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		$admin_clave = principalModelo::encriptar($admin_clave);

		if ($tipo_cuenta == "propia") {
			$checar_cuenta = principalModelo::ejecutar_consulta_simple("SELECT usuario_id FROM usuarios WHERE usuario_correo = '$admin_usuario' AND usuario_clave = '$admin_clave' AND usuario_id = '$id'");
		} else {
			session_start(["name" => "sistema"]);
			if ($_SESSION['privilegio_sistema'] != 1) {
				$alerta = [
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error",
					"Texto"=>"No tienes los permisos necesarios para actualizar los datos.",
					"Icon"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
			$checar_cuenta = principalModelo::ejecutar_consulta_simple("SELECT usuario_id FROM usuarios WHERE usuario_usuario = '$admin_usuario' AND usuario_clave = '$admin_clave' LIMIT 1");
		}

		if ($checar_cuenta->rowCount() <= 0) {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrio un error",
				"Texto"=>"El nombre y la contraseña no son validas, intente de nuevo.",
				"Icon"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		$datos_usuario = [
			"nombre"=>$nombre,
			"apellido"=>$apellido,
			"direccion"=>$direccion,
			"telefono"=>$telefono,
			"correo"=>$correo,
			"usuario"=>$usuario,
			"clave"=>$clave,
			"privilegio"=>$privilegio,
			"id"=>$id
		];

		if (usuarioModelo::actualizar_usuario_modelo($datos_usuario)) {
			$alerta = [
				"Alerta"=>"recargar",
				"Titulo"=>"Usuario actualizado",
				"Texto"=>"Los datos del usuario han sido actualizados.",
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
	public function eliminar_venta_controlador($id) {
		$id = principalModelo::desencriptar($_POST['venta_id_eliminar']);
		$id = principalModelo::limpiar_cadena($id);

		$eliminar_venta = ventaModelo::eliminar_venta_modelo($id);

		if ($eliminar_venta->rowCount() == 1) {
			$alerta = [
				"Alerta"=>"recargar",
				"Titulo"=>"¡venta eliminado!",
				"Texto"=>"El venta fue eliminado con éxito del sistema.",
				"Icon"=>"success"
			];
		} else {
			$alerta = [
				"Alerta"=>"simple",
				"Titulo"=>"¡Ocurrio un error!",
				"Texto"=>"No se pudo eliminar el venta, intente de nuevo.",
				"Icon"=>"error"
			];
		}
		echo json_encode($alerta);
	}

}
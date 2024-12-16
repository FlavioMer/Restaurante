<div class="container">
	<h3 class="px-3 py-4 titulos"><i class="fa-solid fa-user-gear fa-fw"></i> &nbsp; sección de usuarios</h3>
</div>
<div class="container">
	<ul class="full-box list-unstyled page-tabs">
		<li>
			<a href="<?php echo urlServidor; ?>usuario-nuevo/"><i class="fa-solid fa-plus fa-fw"></i> &nbsp; Registrar usuario</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>usuario-listar/"><i class="fa-solid fa-clipboard-list fa-fw"></i> &nbsp; Listar usuarios</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>usuario-buscar"><i class="fa-solid fa-magnifying-glass fa-fw"></i> &nbsp; Buscar usuario</a>
		</li>
	</ul>
</div>
<div class="container">
	<div class="px-3">
		<div class="card mb-4">
            <div class="card-body px-4">
            <?php
            require_once "./controlador/usuarioControlador.php";
            $usuario_controlador = new usuarioControlador();
            $usuario = $usuario_controlador->seleccionar_usuario_controlador("unico", $pagina[1]);
            if ($usuario->rowCount() == 1) {
                $campo = $usuario->fetch();
            ?>
				<form action="<?php echo urlServidor; ?>accion/usuarioAccion.php" method="POST" class="Formulario" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="usuario_id_actualizar" value="<?php echo $pagina[1]; ?>">
					<div class="container">
						<legend class="titulos mb-3"><i class="fa-regular fa-address-card"></i> &nbsp; información personal</legend>
                    <?php if ($_SESSION['privilegio_sistema'] == 1) { ?>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-3">
                                    <select name="usuario_privilegio_actualizar" class="form-select form-select-sm text-center">
                                        <option> Selecciona una opcion</option>
                                        <option value="1" <?php if ($campo['usuario_privilegio'] == "1") { echo 'selected=""'; } ?>>Administrador</option>
                                        <option value="2" <?php if ($campo['usuario_privilegio'] == "2") { echo 'selected=""'; } ?>>Vendedor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-3">
                                    <input type="text" name="usuario_nombre_actualizar" class="form-control form-control-sm text-center" value="<?php echo $campo['usuario_nombre']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-3">
                                    <input type="text" name="usuario_apellido_actualizar" class="form-control form-control-sm text-center" value="<?php echo $campo['usuario_apellido']; ?>">
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-3">
                                    <input type="text" name="usuario_nombre_actualizar" class="form-control form-control-sm text-center" value="<?php echo $campo ['usuario_nombre']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-3">
                                    <input type="text" name="usuario_apellido_actualizar" class="form-control form-control-sm text-center" value="<?php echo $campo['usuario_apellido']; ?>">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
						<div class="row">
							<div class="col-lg-8 col-md-8 col-12">
								<div class="mb-3">
                                    <input type="text" name="usuario_direccion_actualizar" class="form-control form-control-sm text-center" value=" <?php echo $campo ['usuario_direccion']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-3">
                                    <input type="text" name="usuario_telefono_actualizar" class="form-control form-control-sm text-center" value="<?php echo $campo['usuario_telefono']; ?>">
                                </div>
                            </div>
                        </div>
                        <legend class="titulos mb-3"><i class="fa-solid fa-user-lock"></i>&nbsp; datos de la cuenta </legend>
                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-12">
                                <div class="mb-3">
                                    <input type="text" name="usuario_correo_actualizar" class="form-control form-control-sm text-center" value="<?php echo $campo['usuario_correo']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-12">
                                <div class="mb-3">
                                    <input type="text" name="usuario_usuario_actualizar" class="form-control form-control-sm text-center" value="<?php echo $campo['usuario_usuario']; ?>">
                                </div>
                            </div>  
                        </div>
                        <p class="fs-7 text-center">Para actualizar la contraseña debe escribir una nueva y volver a escribir. En caso que no desee cambiarla debe dejar los campos en blanco.</p>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-3">
                                    <input type="text" name="usuario_clave_uno_actualizar" class="form-control form-control-sm text-center" placeholder="Escriba su contraseña">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-3">
                                    <input type="text" name="usuario_clave_dos_actualizar" class="form-control form-control-sm text-center" placeholder="Confirmar contraseña">
                                </div>
                            </div>
                        </div>
                        <legend class="titulos mb-2"><i class="fas fa-user-lock"></i>&nbsp;Correo y contraseña</legend>
                        <p class="fs-7 text-center">Para actualizar los datos escriba su correo y contraseña con la que inicio sesion en el sistema</p>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-4">
                                    <input type="usuario" name="admin_usuario" class="form-control form-control-sm text-center" placeholder="Escribir el usuario">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mb-4">
                                    <input type="password" name="admin_clave" class="form-control form-control-sm text-center" placeholder="Escribir la contraseña">
                                </div>
                            </div>
                        </div>
                    <?php if ($login_controlador->encriptar($_SESSION['id_sistema']) != $pagina[1]) { ?>
                        <input type="hidden" name="tipo_cuenta" value="impropia">
                    <?php } else { ?>
                        <input type="hidden" name="tipo_cuenta" value="propia">
                    <?php } ?>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa-regular fa-floppy-disk"></i>&nbsp; Actualizar</button>
                            <button class="btn btn-sm btn-secondary"><i class="fa-solid fa-reply"></i>&nbsp; Regresar</button>
                        </div>
                    </div>
                </form>
            <?php } else { ?>
                <div class="alert alert-danger text-center mb-0">
                    <p><i class="fa-solid fa-circle-info fa-5x"></i></p>
                    <h5>¡Ocurrio un error inesperado!</h5>
                    <p class="mb-0">No podemos mostrar la informacion solicitada.</p>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>

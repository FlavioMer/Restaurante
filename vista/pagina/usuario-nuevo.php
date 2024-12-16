<div class="container">
	<h3 class="px-3 py-4 titulos"><i class="fa-solid fa-user-gear fa-fw"></i> &nbsp; sección de usuarios</h3>
</div>
<div class="container">
	<ul class="full-box list-unstyled page-tabs">
		<li>
			<a href="<?php echo urlServidor; ?>usuario-nuevo/" class="active"><i class="fa-solid fa-plus fa-fw"></i> &nbsp; Registrar usuario</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>usuario-listar/"><i class="fa-solid fa-clipboard-list fa-fw"></i> &nbsp; Listar de usuarios</a>
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
				<form action="<?php echo urlServidor; ?>accion/usuarioAccion.php" method="POST" class="Formulario" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
					<div class="container">
						<legend class="titulos mb-3"><i class="fa-regular fa-address-card"></i> &nbsp; información personal</legend>
						<div class="row">
							<div class="col-lg-4 col-md-4 col-12">
								<div class="mb-3">
									<select name="usuario_privilegio_nuevo" class="form-select form-select-sm text-center">
										<option>Selección una opción</option>
										<option value="1">Administrador</option>
										<option value="2">Vendedor</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<div class="mb-3">
									<input type="text" name="usuario_nombre_nuevo" class="form-control form-control-sm text-center" placeholder="Nombre del usuario">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<div class="mb-3">
									<input type="text" name="usuario_apellido_nuevo" class="form-control form-control-sm text-center" placeholder="Apellido del usuario">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-8 col-md-8 col-12">
								<div class="mb-3">
									<input type="text" name="usuario_direccion_nuevo" class="form-control form-control-sm text-center" placeholder="Dirección del usuario">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<div class="mb-3">
									<input type="text" name="usuario_telefono_nuevo" class="form-control form-control-sm text-center" placeholder="Telefono del usuario">
								</div>
							</div>
						</div>
						<legend class="titulos mb-3"><i class="fa-solid fa-user-lock"></i> &nbsp; datos de la cuenta</legend>
						<div class="row">
							<div class="col-lg-7 col-md-7 col-12">
								<div class="mb-3">
									<input type="text" name="usuario_correo_nuevo" class="form-control form-control-sm text-center" placeholder="Correo del usuario">
								</div>
							</div>
							<div class="col-lg-5 col-md-5 col-12">
								<div class="mb-3">
									<input type="text" name="usuario_usuario_nuevo" class="form-control form-control-sm text-center" placeholder="Cuenta del usuario">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="mb-3">
									<input type="text" name="usuario_clave_uno_nuevo" class="form-control form-control-sm text-center" placeholder="Escriba su contraseña">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="mb-3">
									<input type="text" name="usuario_clave_dos_nuevo" class="form-control form-control-sm text-center" placeholder="Confirmar contraseña">
								</div>
							</div>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-sm btn-primary">Guardar</button>
							<button type="reset" class="btn btn-sm btn-secondary">Limpiar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
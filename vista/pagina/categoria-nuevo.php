<div class="container">
	<h3 class="px-3 py-4 titulos"><i class="fa-solid fa-user-gear fa-fw"></i> &nbsp; sección de categorias</h3>
</div>
<div class="container">
	<ul class="full-box list-unstyled page-tabs">
		<li>
			<a href="<?php echo urlServidor; ?>categoria-nuevo/" class="active"><i class="fa-solid fa-plus fa-fw"></i> &nbsp; Registrar categoria</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>categoria-listar/"><i class="fa-solid fa-clipboard-list fa-fw"></i> &nbsp; Listar de categoria</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>categoria-buscar"><i class="fa-solid fa-magnifying-glass fa-fw"></i> &nbsp; Buscar categoria</a>
		</li>
	</ul>
</div>
<div class="container">
	<div class="px-3">
		<div class="card mb-4">
			<div class="card-body px-4">
				<form action="<?php echo urlServidor; ?>accion/categoriaAccion.php" method="POST" class="Formulario" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
					<div class="container">
						<legend class="titulos mb-3"><i class="fa-regular fa-address-card"></i> &nbsp; información de categoria</legend>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="mb-3">
									<input type="text" name="categoria_nombre_nuevo" class="form-control form-control-sm text-center" placeholder="Nombre de la categoria">
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
<div class="container">
	<h3 class="px-3 py-4 titulos"><i class="fa-solid fa-user-gear fa-fw"></i> &nbsp; sección de productos</h3>
</div>
<div class="container">
	<ul class="full-box list-unstyled page-tabs">
		<li>
			<a href="<?php echo urlServidor; ?>producto-nuevo/" ><i class="fa-solid fa-plus fa-fw"></i> &nbsp; Registrar productos</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>producto-listar/"><i class="fa-solid fa-clipboard-list fa-fw"></i> &nbsp; Listar de productos</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>producto-buscar" class="active"><i class="fa-solid fa-magnifying-glass fa-fw"></i> &nbsp; Buscar productos</a>
		</li>
	</ul>
</div>
<div class="container">
	<div class="px-3">
		<div class="card mb-4">
			<div class="card-body px-4">
			<?php if (!isset($_SESSION['busqueda_producto']) && empty($_SESSION['busqueda_producto'])) { ?>
				<form action="<?php echo urlServidor; ?>accion/buscadorAccion.php" method="post" class="Formulario" data-form="default" autocomplete="off">
					<input type="hidden" name="modulo" value="producto">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-6 col-md-6 col-10">
								<div class="input-group mb-3">
									<input type="text" name="buscar_palabra" class="form-control form-control-sm text-center" placeholder="¿Qué producto estás buscando?">
									<button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i>&nbsp; Buscar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			<?php } else { ?>
				<form  action="<?php echo urlServidor; ?>accion/buscadorAccion.php" method="post" class="Formulario" data-form="buscar" autocomplete="off">
					<input type="hidden" name="modulo" value="producto">
					<input type="hidden" name="eliminar_busqueda" value="eliminar">
					<div class="container text-center">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-12">
								<div class="m-0">
									<p>Resultados de la búsqueda <strong><?php echo $_SESSION['busqueda_producto']; ?></strong></p>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-12">
								<div class="mb-3">
									<button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>&nbsp; Eliminar búsqueda</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			<?php 
			require_once "./controlador/productoControlador.php";
			$producto_controlador = new productoControlador();
			echo $producto_controlador->listar_productos_controlador($pagina[0], 5, $pagina[0], $_SESSION['busqueda_producto']);
			} ?>
			</div>
		</div>
	</div>
</div>
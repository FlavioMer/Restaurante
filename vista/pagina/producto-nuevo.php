<?php
require_once "./config/sistema.php";
require_once "./modelo/categoriaModelo.php"; // Incluye el modelo de categorías
?>

<div class="container">
	<h3 class="px-3 py-4 titulos"><i class="fa-solid fa-user-gear fa-fw"></i> &nbsp; sección de productos</h3>
</div>
<div class="container">
	<ul class="full-box list-unstyled page-tabs">
		<li>
			<a href="<?php echo urlServidor; ?>producto-nuevo/" class="active"><i class="fa-solid fa-plus fa-fw"></i> &nbsp; Registrar productos</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>producto-listar/"><i class="fa-solid fa-clipboard-list fa-fw"></i> &nbsp; Listar de productos</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>producto-buscar"><i class="fa-solid fa-magnifying-glass fa-fw"></i> &nbsp; Buscar productos</a>
		</li>
	</ul>
</div>
<div class="container">
	<div class="px-3">
		<div class="card mb-4">
			<div class="card-body px-4">
				<form action="<?php echo urlServidor; ?>accion/productoAccion.php" method="POST" class="Formulario" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
					<div class="container">
						<legend class="titulos mb-3"><i class="fa-regular fa-address-card"></i> &nbsp; información del producto</legend>
						<div class="row">
							<div class="col-lg-4 col-md-4 col-12">
							<?php
							$categorias_modelo = new categoriaModelo(); // Instancia del modelo de categorías
							$categorias = $categorias_modelo->listar_categorias_modelo(); // Obtener las categorías
							?>
							<div class="mb-3">
								<select name="producto_categoria_nuevo" class="form-select form-select-sm text-center">
									<option value="">Selecciona una categoría</option>
									<?php foreach ($categorias as $categoria) : ?>
										<option value="<?php echo $categoria['categoria_id']; ?>"><?php echo $categoria['categoria_nombre']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<div class="mb-3">
									<input type="text" name="producto_nombre_nuevo" class="form-control form-control-sm text-center" placeholder="Nombre del producto">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<div class="mb-3">
									<input type="text" name="producto_precio_nuevo" class="form-control form-control-sm text-center" placeholder="Precio del producto">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-8 col-md-8 col-12">
								<div class="mb-3">
									<input type="text" name="producto_descripcion_nuevo" class="form-control form-control-sm text-center" placeholder="Descripcion del producto">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<div class="mb-3">
									<input type="text" name="producto_stock_nuevo" class="form-control form-control-sm text-center" placeholder="Stock del producto">
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
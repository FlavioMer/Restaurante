<?php
require_once "./config/sistema.php";
require_once "./modelo/productoModelo.php"; // Incluye el modelo de categorías
?>

<div class="container">
	<h3 class="px-3 py-4 titulos"><i class="fa-solid fa-user-gear fa-fw"></i> &nbsp; sección de ventas</h3>
</div>
<div class="container">
	<ul class="full-box list-unstyled page-tabs">
		<li>
			<a href="<?php echo urlServidor; ?>venta-nuevo/" class="active"><i class="fa-solid fa-plus fa-fw"></i> &nbsp; Registrar venta</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>venta-listar/"><i class="fa-solid fa-clipboard-list fa-fw"></i> &nbsp; Listar de venta</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>venta-buscar"><i class="fa-solid fa-magnifying-glass fa-fw"></i> &nbsp; Buscar venta</a>
		</li>
	</ul>
</div>
<div class="container">
	<div class="px-3">
		<div class="card mb-4">
			<div class="card-body px-4">
				<form action="<?php echo urlServidor; ?>accion/ventaAccion.php" method="POST" class="Formulario" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
					<div class="container">
						<legend class="titulos mb-3"><i class="fa-regular fa-address-card"></i> &nbsp; informacion de la venta</legend>
						<div class="row">
							<div class="col-lg-4 col-md-4 col-12">
							<?php
							$producto_modelo = new productoModelo(); // Instancia del modelo de categorías
							$productos = $producto_modelo->listar_productos_modelo(); // Obtener las categorías
							?>
							<div class="mb-3">
								<select name="producto_categoria_nuevo" class="form-select form-select-sm text-center">
									<option value="">Selecciona el producto</option>
									<?php foreach ($productos as $producto) : ?>
										<option value="<?php echo $producto['producto_id']; ?>"><?php echo $producto['producto_nombre']; ?></option>
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
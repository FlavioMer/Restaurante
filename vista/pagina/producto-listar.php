<div class="container">
	<h3 class="px-3 py-4 titulos"><i class="fa-solid fa-user-gear fa-fw"></i> &nbsp; sección de productos</h3>
</div>
<div class="container">
	<ul class="full-box list-unstyled page-tabs">
		<li>
			<a href="<?php echo urlServidor; ?>producto-nuevo/"><i class="fa-solid fa-plus fa-fw"></i> &nbsp; Registrar productos</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>producto-listar/" class="active"><i class="fa-solid fa-clipboard-list fa-fw"></i> &nbsp; Listar de productos</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>producto-buscar/"><i class="fa-solid fa-magnifying-glass fa-fw"></i> &nbsp; Buscar productos</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>producto/"><i class="fa-solid fa-magnifying-glass fa-fw"></i> &nbsp; Reporte productos</a>
		</li>
	</ul>
</div>
<div class="container">
	<div class="px-3">
		<div class="card mb-4">
			<div class="card-body px-4">
			<?php
			require_once "./controlador/productoControlador.php";
			$producto_controlador = new productoControlador();
			echo $producto_controlador->listar_productos_controlador($pagina[1], 5, $pagina[0], "");
			?>
			</div>
		</div>
	</div>
</div>
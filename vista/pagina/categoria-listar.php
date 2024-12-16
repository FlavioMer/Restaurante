<div class="container">
	<h3 class="px-3 py-4 titulos"><i class="fa-solid fa-user-gear fa-fw"></i> &nbsp; sección de categorias</h3>
</div>
<div class="container">
	<ul class="full-box list-unstyled page-tabs">
		<li>
			<a href="<?php echo urlServidor; ?>categoria-nuevo/"><i class="fa-solid fa-plus fa-fw"></i> &nbsp; Registrar categoria</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>categoria-listar/" class="active"><i class="fa-solid fa-clipboard-list fa-fw"></i> &nbsp; Listar de categoria</a>
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
			<?php
			require_once "./controlador/categoriaControlador.php";
			$categoria_controlador = new categoriaControlador();
			echo $categoria_controlador->listar_categoria_controlador($pagina[0], 5, $pagina[0], "");
			?>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<h3 class="px-3 py-4 titulos"><i class="fa-solid fa-user-gear fa-fw"></i> &nbsp; sección de usuarios</h3>
</div>
<div class="container">
	<ul class="full-box list-unstyled page-tabs">
		<li>
			<a href="<?php echo urlServidor; ?>usuario-nuevo/"><i class="fa-solid fa-plus fa-fw"></i> &nbsp; Registrar usuario</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>usuario-listar/" class="active"><i class="fa-solid fa-clipboard-list fa-fw"></i> &nbsp; Listar de usuarios</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>usuario-buscar"><i class="fa-solid fa-magnifying-glass fa-fw"></i> &nbsp; Buscar usuario</a>
		</li>
		<li>
			<a href="<?php echo urlServidor; ?>usuario-pdf/"><i class="fa-solid fa-magnifying-glass fa-fw"></i> &nbsp; Reporte usuario</a>
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
			echo $usuario_controlador->listar_usuarios_controlador($pagina[0], 5, $pagina[0], "");
			?>
			</div>
		</div>
	</div>
</div>
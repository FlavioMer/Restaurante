<section class="full-box nav-lateral">
	<div class="full-box nav-lateral-bg btn-menu"></div>
	<div class="full-box nav-lateral-body">
		<div class="full-box nav-lateral-body-title text-center titulos">
			<i class="fa-regular fa-circle-xmark btn-menu"></i> La Fuente
		</div>
		<figure class="full-box nav-lateral-body-subtitle text-center ">
			<div>
				<img src="<?php echo urlServidor;?>public/images/avatar-male.png" alt="Avatar">
			</div>
			<figcaption class="titulos mt-2">
				<?php
				if ($_SESSION['privilegio_sistema'] == 1) {
					$privilegio = "Administrador";
				} else {
					$privilegio = "Vendedor";
				}
				?>
				<span>
					<?php echo $privilegio; ?> <br>
					<small class="fs-6"><?php echo $_SESSION['nombre_sistema'].' '.$_SESSION['apellido_sistema']; ?>
					</small>
				</span>
			</figcaption>
		</figure>
		<nav class="full-box">
			<ul class="full-box list-unstyled menu-principal">
				<li class="full-box">
					<a href="<?php echo urlServidor;?>home/" class="full-box">
						<div class="nav-lateral-body-icono">
							<i class="fa-brands fa-dashcube"></i>
						</div>
						<div class="nav-lateral-body-texto">
							Home
						</div>
					</a>
				</li>
				<li class="full-box nav-lateral-divider"></li>
				<li class="full-box">
					<a href="" class="full-box btn-submenu">
						<div class="nav-lateral-body-icono">
							<i class="fa-solid fa-truck-ramp-box"></i>
						</div>
						<div class="nav-lateral-body-texto">
							Administración
						</div>
						<span class="fa-solid fa-caret-down"></span>
					</a>
					<ul class="full-box menu-principal sub-menu-options">
						<li class="full-box">
							<a href="<?php echo urlServidor; ?>venta-nuevo" class="full-box">
								<div class="nav-lateral-body-icono">
									<i class="fa-solid fa-dollar-sign"></i>
								</div>
								<div class="nav-lateral-body-texto">
									Ventas
								</div>
							</a>
						</li>
					</ul>
				</li>
				<li class="full-box nav-lateral-divider"></li>
				<li class="full-box">
					<a href="" class="full-box btn-submenu">
						<div class="nav-lateral-body-icono">
							<i class="fa-solid fa-user-group"></i>
						</div>
						<div class="nav-lateral-body-texto">
							Personas
						</div>
						<span class="fa-solid fa-caret-down"></span>
					</a>
					<ul class="full-box menu-principal sub-menu-options">
						<li class="full-box">
							<a href="<?php echo urlServidor; ?>usuario-listar" class="full-box">
								<div class="nav-lateral-body-icono">
									<i class="fa-solid fa-user-gear"></i>
								</div>
								<div class="nav-lateral-body-texto">
									Usuarios
								</div>
							</a>
						</li>
					</ul>
				</li>
				<li class="full-box nav-lateral-divider"></li>
				<li class="full-box">
					<a href="" class="full-box btn-submenu">
						<div class="nav-lateral-body-icono">
							<i class="fa-solid fa-truck-ramp-box"></i>
						</div>
						<div class="nav-lateral-body-texto">
							Módulos
						</div>
						<span class="fa-solid fa-caret-down"></span>
					</a>
					<ul class="full-box menu-principal sub-menu-options">
						<li class="full-box">
							<a href="<?php echo urlServidor; ?>producto-nuevo" class="full-box">
								<div class="nav-lateral-body-icono">
									<i class="fa-solid fa-apple-whole"></i>
								</div>
								<div class="nav-lateral-body-texto">
									Productos
								</div>
							</a>
						</li>
						<li class="full-box">
							<a href="<?php echo urlServidor; ?>categoria-nuevo" class="full-box">
								<div class="nav-lateral-body-icono">
									<i class="fa-solid fa-list-ol"></i>
								</div>
								<div class="nav-lateral-body-texto">
									Categorias
								</div>
							</a>
						</li>
					</ul>
				</li>
				<li class="full-box nav-lateral-divider"></li>
			</ul>
		</nav>
	</div>
</section>
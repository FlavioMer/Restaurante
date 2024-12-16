<script>
	/* Ventana para cerrar sesión */
	let btn_cerrar_sesion = document.querySelector('.btn-cerrar-sesion');

	btn_cerrar_sesion.addEventListener('click', function(e) {
		e.preventDefault();
		Swal.fire({
			title: '¿Estás seguro?',
			text: 'Está a punto de cerrar la sesión y salir del sistema',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#14A44D',
			cancelButtonColor: '#DC4C64',
			confirmButtonText: 'Salir del sistema',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
				let url = '<?php echo urlServidor ?>accion/loginAccion.php';
				let token = '<?php echo $login_controlador->encriptar($_SESSION['token_sistema']); ?>';
				let usuario = '<?php echo $login_controlador->encriptar($_SESSION['usuario_sistema']); ?>';

				let datos = new FormData();
				datos.append("token", token);
				datos.append("usuario", usuario);

				fetch(url, {
					method: 'POST',
					body: datos
				})
				.then(respuesta => respuesta.json())
				.then(respuesta => {
					return alertas(respuesta);
				});
			}
		});
	});
</script>
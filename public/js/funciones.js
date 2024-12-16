$(document).ready( function() {

	/* Mostrar y ocultar los submenus */
	$('.btn-submenu').on('click', function(e) {
		e.preventDefault();
		var submenu = $(this).next('ul');
		var icono = $(this).children("span");
		if (submenu.hasClass('sub-menu-options-show')) {
			submenu.removeClass('sub-menu-options-show');
			icono.addClass('fa-caret-down').removeClass('fa-caret-up');
		} else {
			submenu.addClass('sub-menu-options-show');
			icono.addClass('fa-caret-up').removeClass('fa-caret-down');
		}
	});

	/* Abrir y cerrar Nav Lateral */
	$('.btn-menu').on('click', function(e) {
		e.preventDefault();
		var navLateral = $('.nav-lateral');
		var pageContent = $('.page-content');
		var navBarOption = $('.navbar-superior-options');
		if (navLateral.hasClass('nav-lateral-change') && pageContent.hasClass('page-content-change')) {
			navLateral.removeClass('nav-lateral-change');
			pageContent.removeClass('page-content-change');
			navBarOption.removeClass('navbar-superior-options-change');
		} else {
			navLateral.addClass('nav-lateral-change');
			pageContent.addClass('page-content-change');
			navBarOption.addClass('navbar-superior-options-change');
		}
	});

	/* Cerrar sesión en el sistema */
	$('.btn-salir').on('click', function(e) {
		e.preventDefault();
		Swal.fire({
			title: '¿Desea cerrar la sesión?',
			text: 'Estas seguro de salir del sistma.',
			icon:'question',
			showCancelButton: true,
			confirmButtonColor: '#3085D6',
			cancelButtonColor: '#DD3333',
			confirmButtonText: 'Si, salir',
			cancelButtonText: 'No, cancelar'
		}).then((result) => {
			if (result.value) {
				window.location = 'index.php';
			}
		});
	});
});

(function($){
	$(window).on("load",function(){
		$(".nav-lateral-body").mCustomScrollbar({
			theme: "light-thin",
			scrollbarPosition: "inside",
			autoHideScrollbar: true,
			scrollButtons: {enable: true}
		});
		$(".page-content").mCustomScrollbar({
			theme: "dark-thin",
			scrollbarPosition: "inside",
			autoHideScrollbar: true,
			scrollButtons: {enable: true}
		});
	});
})(jQuery);

const Formulario = document.querySelectorAll(".Formulario");

function enviar_formulario(e) {
	e.preventDefault();

	let datos = new FormData(this);
	let metodo = this.getAttribute("method");
	let accion = this.getAttribute("action");
	let tipo = this.getAttribute("data-form");

	let encabezados = new Headers();

	let config = {
		method: metodo,
		headers: encabezados,
		mode: 'cors',
		cache: 'no-cache',
		body: datos
	}

	let texto_alerta;

	if (tipo === "guardar") {
		texto_alerta = "Los datos quedaran guardados en el sistema.";
	} else if (tipo === "actualizar") {
		texto_alerta = "Los datos del sistema serán actualizados.";
	} else if (tipo === "eliminar") {
		texto_alerta = "Los datos serán eliminados completamente del sistema.";
	} else if (tipo === "buscar") {
		texto_alerta = "Se eliminará el término de búsqueda y tendrás que escribir uno nuevo.";
	} else {
		texto_alerta = "Quieres realizar la operación solicitada.";
	}

	Swal.fire({
		title: '¿estás seguro?',
		text: texto_alerta,
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#14A44D',
		cancelButtonColor: '#DC4C64',
		confirmButtonText: 'Aceptar',
		cancelButtonText: 'Cancelar',
	}).then((result) => {
		if(result.value){
			fetch(accion, config)
			.then(respuesta => respuesta.json())
			.then(respuesta => {
				return alertas(respuesta);
			});
		}
	});
}

Formulario.forEach(formularios => {
	formularios.addEventListener("submit", enviar_formulario);
});

function alertas(alerta) {
	if (alerta.Alerta === "simple") {
		Swal.fire({
			title: alerta.Titulo,
			text: alerta.Texto,
			icon: alerta.Icon,
			confirmButtonColor: '#16b5ea',
			confirmButtonText: 'Aceptar'
		});
	} else if (alerta.Alerta === "recargar") {
		Swal.fire({
			title: alerta.Titulo,
			text: alerta.Texto,
			icon: alerta.Icon,
			confirmButtonColor: '#16b5ea',
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if (result.value) {
				location.reload();
			}
		});
	} else if(alerta.Alerta === "limpiar") {
		Swal.fire({
			title: alerta.Titulo,
			text: alerta.Texto,
			icon: alerta.Icon,
			confirmButtonColor: '#16b5ea',
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if (result.value) {
				document.querySelector(".Formulario").reset();
			}
		});
	} else if (alerta.Alerta === "redireccionar") {
		window.location.href = alerta.URL;
	}
}
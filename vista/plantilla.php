<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "./vista/modulo/link.php"; ?>
</head>
<body>

<?php
$accion = false;
require_once "./controlador/vistaControlador.php";
$vista_controlador = new vistaControlador();
$vista = $vista_controlador->obtener_vista_controlador();

if ($vista == "login" || $vista == "404") {
	require_once "./vista/pagina/".$vista.".php";
} else {
	session_start(['name' => 'sistema']);
	require_once "./controlador/loginControlador.php";
	$login_controlador =  new loginControlador();

	if (!isset($_SESSION['token_sistema']) || !isset($_SESSION['id_sistema']) || !isset($_SESSION['nombre_sistema']) || !isset($_SESSION['apellido_sistema']) || !isset($_SESSION['usuario_sistema']) || !isset($_SESSION['privilegio_sistema'])) {
		echo $login_controlador->forzar_cierre_sesion();
		exit();
	}
	$pagina = explode("/", $_GET['vista']);

	include "./vista/modulo/navlateral.php";
?>

	<!-- Page Content -->
	<section class="full-box page-content">

		<?php
		include "./vista/modulo/navbar.php"; 
		include $vista;
		?>


	</section>

<?php
	include "./vista/modulo/salir.php";

}
	include "./vista/modulo/script.php";
?>
	
</body>
</html>
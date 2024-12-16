<?php

require_once "./config/sistema.php";
require_once "./controlador/vistaControlador.php";

$plantilla = new vistaControlador();
$plantilla->obtener_plantilla_controlador();
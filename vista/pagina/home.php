<!---P age Header-->
<div class="container">
    <h3 class="px-3 py-4 titulos"><i class= "fa-solid fa-user-gear fa-fw"></i> &nbsp; Seccion pricipal</h3>
</div>
<div class="container p-4">
    <p class="text-justify">!Bienvenido! <?php echo $_SESSION['nombre_sistema'].' '.$_SESSION['apellido_sistema'];?> !Este es el panel principal del sistema, acá podra encontrar atajos para aaceder a los distintos listados de cada modulo del sistema de forma directa.</p>
</div>
<!--Page Content-->
<div class="container">
    <div class="text-center">
    <?php
    if ($_SESSION['privilegio_sistema'] == 1) {
        require_once "./controlador/usuarioControlador.php";
        $usuario_controlador = new usuarioControlador();
        $usuarios_total = $usuario_controlador->seleccionar_usuario_controlador("contar",0);
    ?>
        <a href="<?php echo urlServidor;?>usuario-listar/" class="box-info">
            <div class="full-box box-info-icono">
                <i class="fa-solid fa-users-cog"></i>
            </div>
            <div class="box-info-titulo titulos">usuarios</div>
            <div class="full-box box-info-numero"><?php echo $usuarios_total->rowCount();?> </div>
        </a>
    <?php } ?>
    <?php 
        require_once "./controlador/categoriaControlador.php";
        $categoria_controlador = new categoriaControlador();
        $categoria_total = $categoria_controlador->seleccionar_categoria_controlador("contar",0);
        ?>
        <a href="<?php echo urlServidor; ?>categoria-listar/" class="box-info">
            <div class="full-box box-info-icono">
            <i class="fa-solid fa-list-ol"></i>
            </div>
            <div class="box-info-titulo titulos">Categorias</div>
            <div class="full-box box-info-numero"><?php echo $categoria_total->rowCount();?></div>
        </a>
        <?php 
        require_once "./controlador/productoControlador.php";
        $producto_controlador = new productoControlador();
        $producto_total = $producto_controlador->seleccionar_producto_controlador("contar",0);
        ?>
        <a href="<?php echo urlServidor; ?>producto-listar/" class="box-info">
            <div class="full-box box-info-icono">
                <i class="fa-solid fa-apple-whole"></i>
            </div>
            <div class="box-info-titulo titulos">Productos</div>
            <div class="full-box box-info-numero"><?php echo $producto_total->rowCount();?></div>
        </a>
        <?php 
        require_once "./controlador/ventaControlador.php";
        $venta_controlador = new ventaControlador();
        $venta_total = $venta_controlador->seleccionar_venta_controlador("contar",0);
        ?>
        <a href="<?php echo urlServidor; ?>venta-nuevo/" class="box-info">
            <div class="full-box box-info-icono">
            <i class="fa-solid fa-dollar-sign"></i>
            </div>
            <div class="box-info-titulo titulos">Ventas</div>
            <div class="full-box box-info-numero"><?php echo $venta_total->rowCount();?></div>
        </a>
    </div>
</div>

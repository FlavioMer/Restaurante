CREATE DATABASE IF NOT EXISTS restaurante;

USE restaurante;

CREATE TABLE usuarios (
	usuario_id int not null auto_increment primary key,
	usuario_nombre varchar(25) not null,
	usuario_apellido varchar(30) not null,
	usuario_direccion varchar(150) not null,
	usuario_telefono varchar(10) not null,
	usuario_correo varchar(50) not null,
	usuario_usuario varchar(30) not null,
	usuario_clave varchar(500) not null,
	usuario_privilegio int(2) not null,
	usuario_estado varchar(9) not null
);

INSERT INTO usuarios(usuario_id, usuario_nombre, usuario_apellido, usuario_direccion, usuario_telefono, usuario_correo, usuario_usuario, usuario_clave, usuario_privilegio, usuario_estado) VALUE(1, "Administrador", "Principal", "Conocido", "9876543210", "Administrador@gmail.com", "Administrador", "RXZMdE92TnNrL2F1a0piTDNtK1ZFdz09", 1, "Activo");


CREATE TABLE categorias (
	categoria_id int not null auto_increment primary key,
    categoria_nombre varchar(30) not null
);

CREATE TABLE productos (
	producto_id int not null auto_increment primary key,
    producto_nombre varchar(30) not null,
    producto_precio decimal(10) not null,
    producto_stock int(10) not null,
    producto_descripcion varchar(150) NOT NULL,
    categoria_id int(10) not null
);

CREATE TABLE ventas (
	venta_id int not null auto_increment primary key,
    venta_fechahora DATETIME not null,
    venta_pagado decimal(10,2) not null,
    venta_cambio decimal(10,2) not null,
    usuario_id int(10) not null
);

CREATE TABLE carrito (
	carrito_id int not null auto_increment primary key,
    carrito_cantidad int(10) not null,
    carrito_total decimal(10,2) not null,
    venta_id int(10) not null,
    producto_id int(10) not null
);


/* Indices**/

ALTER TABLE ventas
    ADD KEY usuario_id(usuario_id);

ALTER TABLE productos
    ADD KEY categoria_id(categoria_id);

ALTER TABLE carrito
    ADD KEY venta_id(venta_id),
    ADD KEY producto_id(producto_id);

/* Llaves Foraneas**/

ALTER TABLE ventas
    ADD CONSTRAINT venta FOREIGN KEY (usuario_id) REFERENCES usuarios (usuario_id);

ALTER TABLE productos
    ADD CONSTRAINT productos FOREIGN KEY (categoria_id) REFERENCES categorias (categoria_id);

ALTER TABLE carrito
    ADD CONSTRAINT carrito1 FOREIGN KEY (venta_id) REFERENCES ventas (venta_id),
ADD CONSTRAINT carrito2 FOREIGN KEY (producto_id) REFERENCES productos (producto_id);


/*SELECT productos.*, categoria.categoria_nombre AS categoria
FROM productos
INNER JOIN categorias AS categoria ON productos.categoria_id = categoria.categoria_id;

if (isset($busqueda) && $busqueda != "") {
	$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.categoria_id WHERE ((producto_id != '0') AND (producto_nombre LIKE '%$busqueda%' OR producto_descripcion LIKE '%$busqueda%')) ORDER BY producto_nombre ASC LIMIT $inicio, $registros";
	} else {
	$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.categoria_id WHERE producto_id != '0' AND producto_id != '0' ORDER BY producto_nombre ASC LIMIT $inicio, $registros";
	}
    */
    
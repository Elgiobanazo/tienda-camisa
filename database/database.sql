/* CREAR BASE DE DATOS SI NO EXISTE tienda_camisa */
CREATE DATABASE IF NOT EXISTS tienda_camisa;

USE tienda_camisa;

# Tabla de usuarios
CREATE TABLE users(
	id 			INT(255) AUTO_INCREMENT NOT NULL,
    name 		VARCHAR(20) NOT NULL,
    lastname 	VARCHAR(40) NOT NULL,
    email 		VARCHAR(255) NOT NULL,
    password	VARCHAR(255) NOT NULL,
    rol	 		VARCHAR(10) NOT NULL,
    image		VARCHAR(255),
    
    CONSTRAINT pk_users PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

# Tabla de categorias
CREATE TABLE categories(
	id		INT(255) AUTO_INCREMENT NOT NULL,
    name	VARCHAR(20) NOT NULL,
    
    CONSTRAINT pk_categories PRIMARY KEY(id)
)ENGINE=InnoDb;

# Tabla de productos
CREATE TABLE products(
	id			INT(255) AUTO_INCREMENT NOT NULL,
    category_id INT(255) NOT NULL,
    name		VARCHAR(50) NOT NULL,
    description MEDIUMTEXT NOT NULL,
    price		FLOAT(100, 2) NOT NULL,
    stock 		INT(255) NOT NULL,
    offert 		INT(10),
    date 		DATE NOT NULL,
    image 		VARCHAR(255),
    
	CONSTRAINT pk_products PRIMARY KEY(id),
    CONSTRAINT fk_product_category FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE CASCADE
)ENGINE=InnoDb;

# Tabla de pedidos
CREATE TABLE orders (
    id 			INT(255) AUTO_INCREMENT NOT NULL,
    user_id 	INT(255) NOT NULL,
    departament VARCHAR(30) NOT NULL,
    city 		VARCHAR(30) NOT NULL,
    address 	VARCHAR(100) NOT NULL,
    cost 		FLOAT(200 , 2) NOT NULL,
    status 		VARCHAR(20) NOT NULL,
    date 		DATE NOT NULL,
    hour 		TIME NOT NULL,
    CONSTRAINT pk_orders PRIMARY KEY (id),
    CONSTRAINT fk_order_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)  ENGINE=InnoDb;

# Tabla de lineas pedido
CREATE TABLE orders_lines(
	id 			INT(255) AUTO_INCREMENT NOT NULL,
    order_id 	INT(255) NOT NULL,
    product_id 	INT(255) NOT NULL,
    unids 		INT(100) NOT NULL,
    
    CONSTRAINT pk_orders_lines PRIMARY KEY(id),
    CONSTRAINT fk_line_order FOREIGN KEY(order_id) REFERENCES orders(id),
    CONSTRAINT fk_line_product FOREIGN KEY(product_id) REFERENCES products(id)
)ENGINE=InnoDb;
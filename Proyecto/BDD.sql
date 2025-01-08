
-- Tabla para material_proveedor
CREATE TABLE users (
    id VARCHAR PRIMARY KEY,
    contrasena VARCHAR(10),
    admin_privilege BINARY
);
CREATE TABLE material_proveedor (
    id INT PRIMARY KEY,
    nombre VARCHAR(255),
    descripcion TEXT
);

-- Tabla para proveedores
CREATE TABLE proveedores (
    id INT PRIMARY KEY,
    nombre VARCHAR(255),
    direccion TEXT,
    telefono VARCHAR(20)
);

-- Tabla para productos
CREATE TABLE productos (
    id INT PRIMARY KEY,
    nombre VARCHAR(255),
    descripcion TEXT,
    precio DECIMAL(10, 2)
);

-- Tabla para categorias
CREATE TABLE categorias (
    id INT PRIMARY KEY,
    nombre VARCHAR(255)
);

-- Tabla para clientes
CREATE TABLE clientes (
    id INT PRIMARY KEY,
    nombre VARCHAR(255),
    direccion TEXT,
    telefono VARCHAR(20)
);

-- Tabla para pedidos
CREATE TABLE pedidos (
    id INT PRIMARY KEY,
    fecha DATE,
    total DECIMAL(10, 2),
    cliente_id INT,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

-- Tabla para detalles_pedido
CREATE TABLE detalles_pedido (
    id INT PRIMARY KEY,
    cantidad INT,
    precio_unitario DECIMAL(10, 2),
    pedido_id INT,
    producto_id INT,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Tabla para producto_categoria (relación muchos a muchos entre productos y categorias)
CREATE TABLE producto_categoria (
    producto_id INT,
    categoria_id INT,
    PRIMARY KEY (producto_id, categoria_id),
    FOREIGN KEY (producto_id) REFERENCES productos(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Tabla para producto_proveedor (relación muchos a muchos entre productos y proveedores)
CREATE TABLE producto_proveedor (
    producto_id INT,
    proveedor_id INT,
    PRIMARY KEY (producto_id, proveedor_id),
    FOREIGN KEY (producto_id) REFERENCES productos(id),
    FOREIGN KEY (proveedor_id) REFERENCES proveedores(id)
);

INSERT INTO categorias (id, nombre) VALUES (1, 'Camisas');
INSERT INTO categorias (id, nombre) VALUES (2, 'Pantalones');
INSERT INTO categorias (id, nombre) VALUES (3, 'Chaquetas');
INSERT INTO categorias (id, nombre) VALUES (4, 'Zapatos');
INSERT INTO categorias (id, nombre) VALUES (5, 'Accesorios');
INSERT INTO categorias (id, nombre) VALUES (6, 'Ropa deportiva');
INSERT INTO categorias (id, nombre) VALUES (7, 'Ropa interior');
INSERT INTO categorias (id, nombre) VALUES (8, 'Vestidos');
INSERT INTO categorias (id, nombre) VALUES (9, 'Trajes');
INSERT INTO categorias (id, nombre) VALUES (10, 'Abrigos');


INSERT INTO productos (id, nombre, descripcion, precio) VALUES
(1, 'Camisa Básica', 'Camisa de algodón, de corte regular, cómoda y resistente. Disponible en varios colores.', 15.99),
(2, 'Pantalón Jeans', 'Pantalón de mezclilla con corte recto y ajuste clásico.', 29.99),
(3, 'Chaqueta de Cuero', 'Chaqueta de cuero genuino, estilo biker, con detalles de cremallera.', 99.99),
(4, 'Suéter de Lana', 'Suéter de lana merino, suave al tacto y de corte ajustado.', 49.99),
(5, 'Falda A-Line', 'Falda de corte A, con cintura alta y tela fluida, perfecta para cualquier ocasión.', 24.99),
(6, 'Blusa de Seda', 'Blusa de seda elegante, de manga larga y con cuello en V.', 39.99),
(7, 'Pantalón Chino', 'Pantalón chino de algodón, con corte slim fit y cierre con botones.', 34.99),
(8, 'Pijama de Algodón', 'Pijama de dos piezas, con camiseta y pantalón de algodón suave y cómodo.', 19.99),
(9, 'Vestido de Verano', 'Vestido corto sin mangas, con estampado floral y cinturón ajustable.', 29.99),
(10, 'Chaqueta de Invierno', 'Chaqueta acolchada con capucha, ideal para temperaturas bajas.', 69.99),
(11, 'Shorts Deportivos', 'Shorts de tela deportiva, ligeros y transpirables, ideales para el ejercicio.', 14.99),
(12, 'Zapatillas Deportivas', 'Zapatillas deportivas, cómodas y con suela antideslizante para todo tipo de actividad.', 59.99),
(13, 'Jersey de Cuello Alto', 'Jersey de punto grueso con cuello alto, perfecto para climas fríos.', 44.99),
(14, 'Camiseta Estampada', 'Camiseta de algodón con estampado gráfico moderno y corte regular.', 12.99),
(15, 'Abrigo de Lana', 'Abrigo largo de lana, elegante y con cierre de botones.', 89.99),
(16, 'Botas de Cuero', 'Botas de cuero de estilo casual, con suela de goma antideslizante.', 79.99),
(17, 'Leggings Deportivos', 'Leggings ajustados, de tela elástica, ideales para practicar deportes o para uso diario.', 22.99),
(18, 'Camisa de Lino', 'Camisa ligera de lino, perfecta para el verano, con botones de madera.', 27.99),
(19, 'Sudadera con Capucha', 'Sudadera de algodón, con capucha y bolsillo canguro, ideal para días fríos.', 34.99),
(20, 'Bufanda de Cashmere', 'Bufanda de lana cashmere, suave y cálida, ideal para el invierno.', 39.99);



-- Relacionar productos con categorías
INSERT INTO producto_categoria (producto_id, categoria_id) VALUES
(1, 1),  -- Camisa Básica -> Camisas
(2, 2),  -- Pantalón Jeans -> Pantalones
(3, 3),  -- Chaqueta de Cuero -> Chaquetas
(4, 3),  -- Suéter de Lana -> Chaquetas
(5, 2),  -- Falda A-Line -> Pantalones
(6, 1),  -- Blusa de Seda -> Camisas
(7, 2),  -- Pantalón Chino -> Pantalones
(8, 7),  -- Pijama de Algodón -> Ropa interior
(9, 8),  -- Vestido de Verano -> Vestidos
(10, 10), -- Chaqueta de Invierno -> Abrigos
(11, 6), -- Shorts Deportivos -> Ropa deportiva
(12, 6), -- Zapatillas Deportivas -> Ropa deportiva
(13, 3), -- Jersey de Cuello Alto -> Chaquetas
(14, 1), -- Camiseta Estampada -> Camisas
(15, 10), -- Abrigo de Lana -> Abrigos
(16, 4), -- Botas de Cuero -> Zapatos
(17, 6), -- Leggings Deportivos -> Ropa deportiva
(18, 1), -- Camisa de Lino -> Camisas
(19, 3), -- Sudadera con Capucha -> Chaquetas
(20, 5); -- Bufanda de Cashmere -> Accesorios


INSERT INTO proveedores (id, nombre, direccion, telefono) VALUES
(1, 'Textiles del Norte', 'Calle de la Industria 58, Ciudad de México', '555-123-4567'),
(2, 'Moda Global', 'Avenida 5 de Febrero 102, Guadalajara', '555-234-5678'),
(3, 'Ropa Elite', 'Calle Principal 215, Monterrey', '555-345-6789'),
(4, 'Estilos Urbanos', 'Calle de la Moda 78, Cancún', '555-456-7890'),
(5, 'Fashion Trends', 'Boulevard de las Américas 320, Bogotá', '555-567-8901');


INSERT INTO producto_proveedor (producto_id, proveedor_id) VALUES
(1, 1),  -- Camisa Básica -> Textiles del Norte
(2, 2),  -- Pantalón Jeans -> Moda Global
(3, 3),  -- Chaqueta de Cuero -> Ropa Elite
(4, 3),  -- Suéter de Lana -> Ropa Elite
(5, 2),  -- Falda A-Line -> Moda Global
(6, 4),  -- Blusa de Seda -> Estilos Urbanos
(7, 1),  -- Pantalón Chino -> Textiles del Norte
(8, 5),  -- Pijama de Algodón -> Fashion Trends
(9, 5),  -- Vestido de Verano -> Fashion Trends
(10, 1), -- Chaqueta de Invierno -> Textiles del Norte
(11, 4), -- Shorts Deportivos -> Estilos Urbanos
(12, 1), -- Zapatillas Deportivas -> Textiles del Norte
(13, 3), -- Jersey de Cuello Alto -> Ropa Elite
(14, 2), -- Camiseta Estampada -> Moda Global
(15, 5), -- Abrigo de Lana -> Fashion Trends
(16, 3), -- Botas de Cuero -> Ropa Elite
(17, 4), -- Leggings Deportivos -> Estilos Urbanos
(18, 1), -- Camisa de Lino -> Textiles del Norte
(19, 2), -- Sudadera con Capucha -> Moda Global
(20, 5); -- Bufanda de Cashmere -> Fashion Trends

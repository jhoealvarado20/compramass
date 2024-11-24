
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    contraseña VARCHAR(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS zapatillas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    foto VARCHAR(255) DEFAULT NULL
);
INSERT INTO usuarios (nombre, contraseña)
VALUES 
('admin', '123456');
INSERT INTO zapatillas (nombre, descripcion, precio, foto)
VALUES
('Nike Air Max', 'Zapatillas cómodas para correr con diseño clásico.', 120.50, 'img/nike_air_max.jpg'),
('Adidas Ultraboost', 'Zapatillas de alto rendimiento para running.', 150.00, 'img/adidas_ultraboost.jpg'),
('Puma RS-X', 'Zapatillas modernas con estilo retro.', 100.00, 'img/puma_rsx.jpg'),
('New Balance 574', 'Zapatillas clásicas con excelente soporte.', 110.00, 'img/new_balance_574.jpg'),
('Reebok Club C', 'Zapatillas de tenis con estilo vintage.', 80.00, 'img/reebok_club_c.jpg'),
('Converse Chuck Taylor', 'Zapatillas icónicas para un look casual.', 70.00, 'img/converse_chuck_taylor.jpg'),
('Vans Old Skool', 'Zapatillas de skate con diseño clásico.', 65.00, 'img/vans_old_skool.jpg'),
('Under Armour HOVR', 'Zapatillas ligeras con tecnología avanzada.', 130.00, 'img/under_armour_hovr.jpg'),
('Fila Disruptor II', 'Zapatillas robustas con diseño chunky.', 90.00, 'img/fila_disruptor_ii.jpg'),
('Asics Gel-Kayano', 'Zapatillas de running con soporte premium.', 140.00, 'img/asics_gel_kayano.jpg');

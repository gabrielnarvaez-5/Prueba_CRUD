-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-08-2024 a las 11:08:04
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestioninventarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `proveedor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `nombre`, `descripcion`, `precio`, `stock`, `proveedor_id`) VALUES
(1, 'Laptop Dell XPS 13', 'Laptop ultraligera con pantalla de 13 pulgadas y procesador Intel i7.', 1200.00, 25, 1),
(2, 'Televisor Samsung 55\" 4K', 'Smart TV de 55 pulgadas con resolución 4K UHD y HDR10.', 900.00, 15, 2),
(3, 'Impresora HP LaserJet Pro M404n', 'Impresora láser monocromática de alta eficiencia.', 250.00, 40, 3),
(4, 'Cafetera Nespresso Vertuo', 'Cafetera automática de cápsulas con tecnología Centrifusion.', 150.00, 60, 4),
(5, 'Teléfono Móvil iPhone 14 Pro', 'Teléfono inteligente con pantalla Super Retina XDR y cámara triple de 12 MP.', 1300.00, 30, 5),
(6, 'Monitor LG Ultrawide 34\"', 'Monitor ultrapanorámico de 34 pulgadas con resolución QHD.', 700.00, 20, 1),
(7, 'Refrigerador LG InstaView Door-in-Door', 'Refrigerador de dos puertas con tecnología InstaView y Door-in-Door.', 1500.00, 10, 2),
(8, 'Taladro Bosch Professional GSB 18V-55', 'Taladro percutor inalámbrico con motor sin escobillas.', 180.00, 35, 3),
(9, 'Lavadora Samsung EcoBubble 8kg', 'Lavadora de carga frontal con tecnología EcoBubble y capacidad de 8kg.', 550.00, 25, 4),
(10, 'Cámara Canon EOS R6', 'Cámara sin espejo full-frame con sensor de 20.1 MP y grabación 4K.', 2500.00, 5, 5),
(12, 'Laptop Dell I5', 'PC gamer', 900.67, 12, NULL),
(13, 'Laptop Dell I5', 'pc', 300.00, 12, NULL),
(14, 'Laptop intel', 'laptop intel', 99.00, 5, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `proveedor_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`proveedor_id`, `nombre`, `direccion`, `telefono`, `email`) VALUES
(1, 'Tecnología Global S.A.', 'Calle 21 No. 455, Ciudad Central', '3412345678', 'contacto@tecnologiaglobal.com'),
(2, 'Electro Hogar S.L.', 'Av. de la Innovación 112, Barcelona', '934567890', 'ventas@electrohogar.com'),
(3, 'Insumos Industriales Ltda.', 'Parque Industrial 45, Ciudad Industrial', '712345678', 'info@insumosindustriales.com'),
(4, 'Comercializadora Moderna', 'Paseo de las Flores 987, Madrid', '912345678', 'ventas@comercializadora.com'),
(5, 'Distribuciones del Norte S.A.', 'Carretera Nacional Km 12, Monterrey', '91238976', 'contacto@distribucionesnorte.com.ec');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`proveedor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `proveedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`proveedor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

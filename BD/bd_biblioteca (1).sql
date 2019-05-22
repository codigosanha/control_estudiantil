-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2018 a las 00:58:58
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `codigo`, `nombre`) VALUES
(1, '001', 'Categoria 01'),
(2, '002', 'categoria 02'),
(3, '003', 'categoria 03'),
(4, '004', 'categoria 04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lectores`
--

CREATE TABLE `lectores` (
  `id` int(11) NOT NULL,
  `nombres` varchar(200) DEFAULT NULL,
  `apellidos` varchar(200) DEFAULT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `tipo_lector_id` int(11) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `num_documento` varchar(45) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lectores`
--

INSERT INTO `lectores` (`id`, `nombres`, `apellidos`, `tipo_documento_id`, `tipo_lector_id`, `telefono`, `direccion`, `num_documento`, `estado`) VALUES
(1, 'Juan Luis', 'Guerra Solis', 1, 1, '988898989', NULL, '45454646', 0),
(2, 'Gean Carlos', 'Baltazar', 1, 1, '988898989', NULL, '45454649', 0),
(3, 'Yony Brondy', 'Gomez Arapa', 1, 1, '988898989', NULL, '45454648', 1),
(4, 'Hairo', 'Fuentes', 1, 1, '34531212', 'Direccion finca 001', '45454644', 0),
(5, 'Julio Armando', 'Fuentes Rojas', 2, 1, '08080808', NULL, '45455556123', 1),
(6, 'Gean Carlos', 'sss', 2, 1, '988898989', 'Calle Arica 430', '4545464444', 1),
(7, 'Juan Luis', 'Gomez Arapa', 1, 2, '34531212', 'Calle Arica 430', '45454640', 1),
(8, 'Favio', 'Gonzales', 1, 1, '34531212', NULL, '34343333', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `codigo_topografico` varchar(45) DEFAULT NULL,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `subtitulo` varchar(200) DEFAULT NULL,
  `autor` varchar(150) DEFAULT NULL,
  `año_publicacion` year(4) DEFAULT NULL,
  `editorial` varchar(150) DEFAULT NULL,
  `ediccion` varchar(20) DEFAULT NULL,
  `idioma` varchar(50) DEFAULT NULL,
  `ejemplares` varchar(45) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `prestados` int(11) NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `codigo_topografico`, `codigo_barras`, `titulo`, `subtitulo`, `autor`, `año_publicacion`, `editorial`, `ediccion`, `idioma`, `ejemplares`, `categoria_id`, `prestados`, `imagen`) VALUES
(1, '00001', '13121312', 'Curso de Redes', 'Introducion de la historia de redes de computadoras', 'Juan Perez', 2001, 'Navarrete', 'Primera', 'Español', '5', 1, 1, 'Desert2.jpg'),
(2, '00002', '123121234', 'Curso de Base de datos', 'curso basico de base de datos', 'Jorge Huaman', 2010, 'Navarrete', 'Primera', 'Español', '5', 1, 2, 'Chrysanthemum.jpg'),
(3, '00003', '5454541', 'Curso de CSS', 'curso basico de CSS', 'Juan Perez', 2010, 'Navarrete', 'Primera', 'Español', '5', 1, 0, 'Hydrangeas.jpg'),
(4, '1001', '454512121312', 'CURSO DE JAVA', 'APRENDE JAVA DESDE CERO', 'JAIME CALLATA', 2010, 'Navarrete', 'Primera', 'Español', '5', 2, 0, 'Lighthouse.jpg'),
(5, '0005', '7702026144579', 'Curso de Telecomunicaciones', 'Introducion a telecomunicaciones', 'Juan Perez Alarcon', 2010, 'Navarrete', 'Segunda', 'Español', '6', 2, 0, 'Koala.jpg'),
(6, '1011-10', '1100911112', 'Lenguaje de Programacion', 'Lenguaje de Programacion y sus inicios', 'Miguel Cervantez', 2016, 'Navarrete', 'Segunda', 'Español', '6', 3, 0, 'Penguins.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `lector_id` int(11) DEFAULT NULL,
  `libro_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha_prestamo` date DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `lector_id`, `libro_id`, `usuario_id`, `fecha_prestamo`, `fecha_devolucion`, `estado`, `hora`, `fecha_entrega`) VALUES
(6, 4, 1, 1, '2018-11-27', '2018-11-28', 1, '10:00', '2018-11-26'),
(7, 5, 5, 1, '2018-11-27', '2018-11-28', 1, '10:00', '2018-11-26'),
(8, 4, 1, 1, '2018-11-26', '2018-11-26', 1, '10:00', '2018-11-27'),
(9, 4, 1, 1, '2018-11-24', '2018-11-30', 0, '22:39', NULL),
(10, 1, 2, 1, '2018-11-22', '2018-11-25', 0, '22:43', NULL),
(11, 2, 2, 1, '2018-11-27', '2018-11-27', 0, '22:50', NULL),
(12, 5, 1, 1, '2018-11-29', '2018-11-01', 1, '13:54', '2018-11-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documentos`
--

CREATE TABLE `tipo_documentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_documentos`
--

INSERT INTO `tipo_documentos` (`id`, `nombre`) VALUES
(1, 'DNI'),
(2, 'Carnet'),
(3, 'Pasaporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_lectores`
--

CREATE TABLE `tipo_lectores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_lectores`
--

INSERT INTO `tipo_lectores` (`id`, `nombre`) VALUES
(1, 'Estudiante'),
(2, 'Docente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(200) DEFAULT NULL,
  `apellidos` varchar(200) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `email`, `dni`, `telefono`, `password`) VALUES
(1, 'juan', 'perez', 'admin@admin.com', '45454545', '988898989', '21232f297a57a5a743894a0e4a801fc3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lectores`
--
ALTER TABLE `lectores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo_lector_idx` (`tipo_lector_id`),
  ADD KEY `fk_tipo_documento_idx` (`tipo_documento_id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_libro_categoria_idx` (`categoria_id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prestamo_libro_idx` (`libro_id`),
  ADD KEY `fk_prestamo_lector_idx` (`lector_id`),
  ADD KEY `fk_prestamo_usuario_idx` (`usuario_id`);

--
-- Indices de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_lectores`
--
ALTER TABLE `tipo_lectores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lectores`
--
ALTER TABLE `lectores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_lectores`
--
ALTER TABLE `tipo_lectores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lectores`
--
ALTER TABLE `lectores`
  ADD CONSTRAINT `fk_tipo_documento` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documentos` (`id`),
  ADD CONSTRAINT `fk_tipo_lector` FOREIGN KEY (`tipo_lector_id`) REFERENCES `tipo_lectores` (`id`);

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `fk_libro_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `fk_prestamo_lector` FOREIGN KEY (`lector_id`) REFERENCES `lectores` (`id`),
  ADD CONSTRAINT `fk_prestamo_libro` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id`),
  ADD CONSTRAINT `fk_prestamo_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

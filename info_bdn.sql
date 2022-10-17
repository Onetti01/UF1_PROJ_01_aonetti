-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2022 a las 00:43:55
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `info_bdn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `usuario` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`usuario`, `password`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(20) NOT NULL,
  `edad` int(99) NOT NULL,
  `fotografia` varchar(100) NOT NULL,
  `curso` int(10) DEFAULT NULL,
  `dni` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`email`, `password`, `nombre`, `apellidos`, `edad`, `fotografia`, `curso`, `dni`) VALUES
('adria@gmail.com', '7815696ecbf1c96e6894b779456d330e', 'Adria', 'Gutierrez Lolo', 23, 'img_alumnos/adria@gmail.com.jpg', NULL, '31347853A'),
('albertonetti@gmail.com', '7815696ecbf1c96e6894b779456d330e', 'Albert', 'Onetti Cifuentes', 21, 'img_alumnos/albertonetti@gmail.com.jpg', NULL, '467816321'),
('marc@gmail.com', '7815696ecbf1c96e6894b779456d330e', 'Marc', 'Garcia Martinez', 20, 'img_alumnos/marc@gmail.com.jpg', NULL, '56456712E'),
('maria@gmail.com', '7815696ecbf1c96e6894b779456d330e', 'Maria', 'Perez Gomez', 25, 'img_alumnos/maria@gmail.com.jpg', NULL, '47651348G'),
('oscar@gmail.com', '7815696ecbf1c96e6894b779456d330e', 'Oscar', 'Gutierrez Bernabeu', 21, 'img_alumnos/oscar@gmail.com.jpg', NULL, '76536131A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `codigo` int(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `hora_total` int(4) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `DNI_profesor` varchar(9) NOT NULL,
  `actiu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`codigo`, `nombre`, `descripcion`, `hora_total`, `fecha_inicio`, `fecha_final`, `DNI_profesor`, `actiu`) VALUES
(1, 'DAW', 'Desarollo de aplicaciones web', 563, '2022-10-24', '2023-03-17', '56781534A', 1),
(2, 'ASIX', 'Administración de redes', 454, '2022-10-19', '2023-03-10', '21345676J', 1),
(3, 'DAM', 'Desarollo de multiplataforma', 785, '2023-01-13', '2023-06-24', '67361371H', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `email_alumno` varchar(50) NOT NULL,
  `codigo_curso` int(10) NOT NULL,
  `nota` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`email_alumno`, `codigo_curso`, `nota`) VALUES
('adria@gmail.com', 1, 8),
('albertonetti@gmail.com', 1, 5),
('albertonetti@gmail.com', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `DNI` varchar(9) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(20) NOT NULL,
  `titulo` varchar(20) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `actiu` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`DNI`, `password`, `nombre`, `apellidos`, `titulo`, `foto`, `actiu`) VALUES
('21345676J', '7815696ecbf1c96e6894b779456d330e', 'Martin', 'Rubio Gutierrez', 'Redes ', 'img/213456767J.jpg', 1),
('56781534A', '7815696ecbf1c96e6894b779456d330e', 'Marta', 'Mingueza Martinez', 'Programador', 'img/578134818A.png', 1),
('67361371H', '7815696ecbf1c96e6894b779456d330e', 'Pol', 'Garcia Lopez', 'Programador', 'img/67361371H.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`email`),
  ADD KEY `curso` (`curso`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `DNI_profesor` (`DNI_profesor`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`email_alumno`,`codigo_curso`),
  ADD KEY `codigo_curso` (`codigo_curso`),
  ADD KEY `email_alumno` (`email_alumno`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`DNI`),
  ADD KEY `DNI` (`DNI`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`DNI_profesor`) REFERENCES `profesores` (`DNI`) ON DELETE CASCADE;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`email_alumno`) REFERENCES `alumnos` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`codigo_curso`) REFERENCES `cursos` (`codigo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

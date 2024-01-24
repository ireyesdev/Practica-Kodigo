-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2024 a las 21:17:56
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_kodigo_fsj19`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `nombre`, `correo`, `password`, `id_rol`) VALUES
(1, 'Kenia Paiz', 'keniapaiz@gmail.com', 'kenia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bootcamps`
--

CREATE TABLE `bootcamps` (
  `id` int(11) NOT NULL,
  `bootcamp` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bootcamps`
--

INSERT INTO `bootcamps` (`id`, `bootcamp`) VALUES
(1, 'Full Stack Junior 17'),
(2, 'Full Stack Junior 18'),
(3, 'Full Stack Junior 19'),
(4, 'Java Developer 5'),
(5, 'Web Developer 6'),
(6, 'Web Developer 7'),
(7, 'prueba23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coaches`
--

CREATE TABLE `coaches` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `coaches`
--

INSERT INTO `coaches` (`id`, `nombre`, `direccion`, `titulo`, `correo`, `password`, `id_materia`, `id_estado`, `id_rol`) VALUES
(1, 'Kenia Paiz', 'San Ignacio', 'Programación', 'keniapaiz@gmail.com', 'Kodigo2024', 1, 1, 2),
(2, 'Dennis Mendoza', 'San Salvador', 'Titulo', 'dennism@gmail.com', 'Kodigo2024', 1, 1, 2),
(3, 'Maria Andree', 'Guatemala', 'Titulo', 'mariaan@gmail.com', 'Kodigo2024', 2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_bootcamp_coach`
--

CREATE TABLE `detalle_bootcamp_coach` (
  `id_coach` int(11) NOT NULL,
  `id_bootcamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_bootcamp_coach`
--

INSERT INTO `detalle_bootcamp_coach` (`id_coach`, `id_bootcamp`) VALUES
(1, 3),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_estudiante_materia`
--

CREATE TABLE `detalle_estudiante_materia` (
  `id_estudiante` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_estudiante_materia`
--

INSERT INTO `detalle_estudiante_materia` (`id_estudiante`, `id_materia`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(5, 1),
(5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `estado`) VALUES
(1, 'Activo'),
(2, 'Asincrono'),
(3, 'Reubicacion'),
(4, 'Desercion'),
(5, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` int(10) NOT NULL,
  `carnet` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `id_bootcamp` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `nombre`, `direccion`, `telefono`, `carnet`, `correo`, `password`, `id_bootcamp`, `id_estado`, `id_rol`) VALUES
(1, 'Diego Alexander Vasquez', 'Tejutla, Chalate', 7890745, 'KD0002023', 'diego@gmail.com', 'Kodigo2023', 3, 1, 3),
(2, 'Jose Luis Villalta', 'San Ignacio, Chalatenango', 70894567, 'KJ004', 'luis@hotmail.com', 'Kodigo2023', 4, 3, 3),
(3, 'Claudia Vasquez Hernandez', 'Citala, Chalatenango', 78542123, 'pr2023', 'clauvasquez@yahoo.com', 'Kodigo2023', 4, 4, 3),
(4, 'prueba2', 'prueba2dire', 76546373, 'prueba2023', 'prueba@hotmail.com', 'Kodigo2023', 3, 4, 3),
(5, 'Ismar Reyes', 'Usulután', 88888888, 'KD007', 'ismarreyes@gmial.com', 'Kodigo2023', 3, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `materia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `materia`) VALUES
(1, 'Programacion'),
(2, 'Socioemocionales'),
(3, 'Ingles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'administrador'),
(2, 'coach'),
(3, 'estudiante');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_rol` (`id_rol`);

--
-- Indices de la tabla `bootcamps`
--
ALTER TABLE `bootcamps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_materia` (`id_materia`),
  ADD KEY `fk_id_estado` (`id_estado`),
  ADD KEY `fk_id_rol` (`id_rol`);

--
-- Indices de la tabla `detalle_bootcamp_coach`
--
ALTER TABLE `detalle_bootcamp_coach`
  ADD KEY `fk_id_coach` (`id_coach`),
  ADD KEY `fk_id_bootcamp` (`id_bootcamp`);

--
-- Indices de la tabla `detalle_estudiante_materia`
--
ALTER TABLE `detalle_estudiante_materia`
  ADD KEY `fk_id_estudiante` (`id_estudiante`),
  ADD KEY `fk_id_materia` (`id_materia`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_bootcamp` (`id_bootcamp`),
  ADD KEY `fk_id_estado` (`id_estado`),
  ADD KEY `fk_id_rol` (`id_rol`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bootcamps`
--
ALTER TABLE `bootcamps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `coaches`
--
ALTER TABLE `coaches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

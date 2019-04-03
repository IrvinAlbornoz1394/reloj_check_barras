-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2019 a las 01:42:51
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_conalep_credenciales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(100) DEFAULT NULL,
  `id_institucion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre_departamento`, `id_institucion`) VALUES
(1, 'Informatica', 1),
(4, 'Finanzas', 1),
(5, 'Promoción yVinculación', 1),
(6, 'Servicios Escolares', 1),
(7, 'Formación Tecnica', 1),
(8, 'Orientación Educativa', 1),
(9, 'Enfermería', 1),
(10, 'Dirección', 1),
(11, 'General', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `nombre_horario` varchar(50) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `id_plantel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horario`, `nombre_horario`, `id_institucion`, `id_plantel`) VALUES
(1, '09:00 - 17:00', 1, 1),
(2, 'Prefecto Mañana', 1, 1),
(3, 'Prefecto Tarde', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_x_usuario`
--

CREATE TABLE `horario_x_usuario` (
  `id_horario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `horario_x_usuario`
--

INSERT INTO `horario_x_usuario` (`id_horario`, `id_usuario`) VALUES
(1, 21),
(1, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

CREATE TABLE `horas` (
  `id_hora` int(11) NOT NULL,
  `h_entrada` time NOT NULL,
  `h_salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horas`
--

INSERT INTO `horas` (`id_hora`, `h_entrada`, `h_salida`) VALUES
(1, '09:00:00', '17:00:00'),
(2, '08:00:00', '16:00:00'),
(3, '13:00:00', '20:00:00'),
(4, '13:00:00', '20:30:00'),
(5, '09:00:00', '13:00:00'),
(6, '16:00:00', '20:00:00'),
(7, '07:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_x_horario`
--

CREATE TABLE `horas_x_horario` (
  `id_hxh` int(11) NOT NULL,
  `id_hora` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horas_x_horario`
--

INSERT INTO `horas_x_horario` (`id_hxh`, `id_hora`, `id_horario`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insidencias`
--

CREATE TABLE `insidencias` (
  `id_insidencia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `dia_semana` varchar(20) DEFAULT NULL,
  `h_checkout` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `insidencias`
--

INSERT INTO `insidencias` (`id_insidencia`, `id_usuario`, `id_horario`, `fecha`, `dia_semana`, `h_checkout`) VALUES
(1, 39, 1, '2019-03-22', 'Viernes', '15:53:53'),
(2, 39, 1, '2019-03-22', 'Viernes', '15:58:50'),
(3, 34, 1, '2019-03-22', 'Viernes', '15:58:59'),
(6, 21, 1, '2019-03-22', 'Viernes', '16:00:09'),
(12, 39, 1, '2019-03-25', 'Lunes', '16:46:04'),
(14, 39, 1, '2019-03-25', 'Lunes', '16:56:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id_institucion` int(11) NOT NULL,
  `nombre_institucion` varchar(400) NOT NULL,
  `director` varchar(500) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `file_logo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id_institucion`, `nombre_institucion`, `director`, `logo`, `file_logo`) VALUES
(1, 'CONALEP YUCATÁN', 'Manuel Campos Ancona', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planteles`
--

CREATE TABLE `planteles` (
  `id_plantel` int(11) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `nombre_p` varchar(200) DEFAULT NULL,
  `clave_p` varchar(10) DEFAULT NULL,
  `director_p` varchar(300) DEFAULT NULL,
  `direccion_p` varchar(500) DEFAULT NULL,
  `colonia_p` varchar(200) DEFAULT NULL,
  `municipio_p` varchar(200) DEFAULT NULL,
  `estado_p` varchar(200) DEFAULT NULL,
  `cod_post_p` varchar(10) DEFAULT NULL,
  `telefonos_p` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `planteles`
--

INSERT INTO `planteles` (`id_plantel`, `id_institucion`, `nombre_p`, `clave_p`, `director_p`, `direccion_p`, `colonia_p`, `municipio_p`, `estado_p`, `cod_post_p`, `telefonos_p`) VALUES
(1, 1, 'Mérida III', '324', 'C.P. Arturo Sabido Gongora', 'Calle x No. xx', 'Chuburna', 'Mérida', 'Yucatán', '97270', '9256431');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_contrato`
--

CREATE TABLE `tipo_contrato` (
  `id_tipo_contrato` int(11) NOT NULL,
  `nombre_contrato` varchar(100) NOT NULL,
  `id_institucion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_contrato`
--

INSERT INTO `tipo_contrato` (`id_tipo_contrato`, `nombre_contrato`, `id_institucion`) VALUES
(1, 'Honorarios', 1),
(2, 'Basificados', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

CREATE TABLE `tipo_usuarios` (
  `id_tipo_usuario` int(11) NOT NULL,
  `nombre_tipo_usuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`id_tipo_usuario`, `nombre_tipo_usuario`) VALUES
(1, 'Administrativo'),
(2, 'Docente'),
(3, 'Alumno'),
(4, 'Servicio Social'),
(5, 'Practicas Profesionales'),
(6, 'Directivos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `id_plantel` int(11) NOT NULL,
  `nombres` varchar(200) DEFAULT NULL,
  `apellido_pat` varchar(100) DEFAULT NULL,
  `apellido_mat` varchar(100) DEFAULT NULL,
  `puesto` varchar(200) DEFAULT NULL,
  `img_foto` varchar(100) DEFAULT NULL,
  `file_foto` varchar(100) DEFAULT NULL,
  `admin` int(11) NOT NULL,
  `clave_sesion` varchar(50) DEFAULT NULL,
  `pass_sesion` varchar(50) DEFAULT NULL,
  `id_tipo_contrato` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `codigo_barras` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_tipo_usuario`, `id_plantel`, `nombres`, `apellido_pat`, `apellido_mat`, `puesto`, `img_foto`, `file_foto`, `admin`, `clave_sesion`, `pass_sesion`, `id_tipo_contrato`, `id_departamento`, `codigo_barras`) VALUES
(12, 1, 1, 'IRVIN', 'ALBORNOZ', 'VAZQUEZ', 'ENC. DEPARTAMENTO DE INFORMATICA', '46239235_294110288101202_8847838414528053248_n.jpg', '5c8fdbb185195.jpg', 1, 'irvin', 'cb06868bab236ab6a16bf1d86a788e29', 1, 1, '105c8fdbb1'),
(21, 1, 1, 'RAMON ALBERTO', 'RAMAYO', 'CERVANTES', 'JEFE DE PROYECTO SERVICIOS ADMINISTRATIVOS ', 'RAMON.jpg', '5c92c500a4aed.jpg', 0, NULL, NULL, 1, 4, '105c92bbc8'),
(22, 1, 1, 'RAFEL ALBERTO', 'BRITO', 'NOVELO', 'JEFE DE PROYECTO SERVICIOS ESCOLARES ', 'rafael.jpg', '5c93bedf428d8.jpg', 0, NULL, NULL, 1, 6, '105c93bedf'),
(23, 1, 1, 'JORGE', 'VILLAREAL', 'CONDE', 'JEFE DE PROYECTO PROMOCION Y VINCULACIòN ', 'villareal.jpg', '5c93bf21d877e.jpg', 0, NULL, NULL, 1, 5, '105c93bf21'),
(24, 1, 1, 'DANIEL ALEJANDRO', 'NOVELO', 'FRAGOSO', 'JEFE DE PROYECTO FORMACION TECNICA ', 'IMG_20190227_123605 (1).jpg', '5c93c04058bde.jpg', 0, NULL, NULL, 1, 7, '105c93c040'),
(25, 1, 1, 'BLANCA A.', 'RODRIGUEZ', 'GONZALEZ', 'AUXILIAR DE SERVICIOS GENERALES ', 'blanca.jpg', '5c93c0b7ee82b.jpg', 0, NULL, NULL, 1, 4, '105c93c0b7'),
(26, 1, 1, 'DANIELA ALEJANDRA', 'BAAS', 'DURAN', 'AUXILIAR DE SERVICIOS ESCOLARES', 'Daniela.jpg', '5c93c1caad7c4.jpg', 0, NULL, NULL, 1, 6, '105c93c1ca'),
(28, 1, 1, 'MAYRA NAYBE', 'REINHARD', 'GRAHAM', 'AUXILIAR DE SERVICIOS ESCOLARES', 'mayra.jpg', '5c93c2a3d372c.jpg', 0, NULL, NULL, 1, 6, '105c93c2a3'),
(29, 1, 1, 'VICTOR DANIEL', 'AKE', 'PECH', 'AUXILIAR DE PROM. Y VINC.', 'victor.jpg', '5c93d5b2e5dd8.jpg', 0, NULL, NULL, 1, 5, '105c93c56e'),
(31, 1, 1, 'GABRIELA', 'BARROSO', 'VALLEJOS', 'ENC. DEL DEPTO. DE ORIENTACóN EDUCATIVA', 'gabi.jpg', '5c93c62f77e26.jpg', 0, NULL, NULL, 1, 8, '105c93c62f'),
(32, 1, 1, 'ROBERTO ENRIQUE', 'CHAN', 'MAS', 'AUXILIAR DE FORMACIóN TECNICA', 'IMG_20190227_134211 (1).jpg', '5c93c8f41ff9f.jpg', 0, NULL, NULL, 1, 7, '105c93c8f4'),
(33, 1, 1, 'BLANCA LETICIA', 'MAY', 'BRITO', 'COORDINADORA DE ENFERMERíA', 'Foto de GAGO???? (3).jpg', '5c93ca8f1534a.jpg', 0, NULL, NULL, 1, 9, '105c93ca8f'),
(34, 1, 1, 'CRISTINA', 'GóMEZ ', 'CHI', 'ASISTENTE DE DIRECCIóN', 'Foto de GAGO???? (1).jpg', '5c93d0ef207a6.jpg', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', 1, 10, '105c93cfc6'),
(35, 1, 1, 'MARIA DE LOS ANGELES', 'HERNANDEZ', 'CHENA', 'PREFECTO', 'MARY.jpg', '5c951f66baf83.jpg', 0, NULL, NULL, 1, 6, '105c93d1ef'),
(36, 1, 1, 'JESUS MELCHOR', 'QUIÑONES', 'GONGORA', 'AUXILIAR DE ENFERMERIA', 'chucho.jpg', '5c93d27d7656c.jpg', 0, NULL, NULL, 1, 9, '105c93d27d'),
(37, 1, 1, 'ELIZABETH', 'YEH', 'CEBALLOS', 'TITULAR DE PRGANO DE CONTROL INTERNO ', 'IMG_20190326_120750.jpg', '5c9a7cf908c6a.jpg', 0, NULL, NULL, 1, 11, '105c93d394'),
(38, 1, 1, 'ELDA', 'MARIN', 'CRUZ', 'COORDINADOR ', 'IMG_20190326_120736.jpg', '5c9a7d0d64483.jpg', 0, NULL, NULL, 1, 11, '105c93d3a9'),
(39, 1, 1, 'IRVIN', 'ALBORNOZ', 'VAZQUEZ', 'ENC. DE INFORMÁTICA', 'IMG_20190328_084359 (1).jpg', '5c9e40308a652.jpg', 0, NULL, NULL, 1, 1, '105c93d44b'),
(40, 1, 1, 'GIOVANA', 'MALDONADO', 'NAVARRO', 'PREFECTO', 'IMG_20190321_131019.jpg', '5c93e23a5ba45.jpg', 0, NULL, NULL, 1, 6, '105c93e23a'),
(41, 6, 1, 'DAVID', 'AGUILAR ', 'OTERO', 'SUBDIRECTOR DEL PLANTEL', 'david.jpg', '5c9bb3b751b76.jpg', 0, NULL, NULL, 1, 10, '105c9bb3b7'),
(42, 6, 1, 'ARTURO', 'SABIDO', 'GONGORA', 'DIRECTOR DEL PLANTEL', 'arturo.jpg', '5c9bb3d91f8e5.jpg', 0, NULL, NULL, 1, 10, '105c9bb3d9');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`),
  ADD KEY `id_institucion` (`id_institucion`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `fk_id_institucion_idx` (`id_institucion`),
  ADD KEY `fk_id_plantel_idx` (`id_plantel`);

--
-- Indices de la tabla `horario_x_usuario`
--
ALTER TABLE `horario_x_usuario`
  ADD KEY `id_horario` (`id_horario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `horas`
--
ALTER TABLE `horas`
  ADD PRIMARY KEY (`id_hora`);

--
-- Indices de la tabla `horas_x_horario`
--
ALTER TABLE `horas_x_horario`
  ADD PRIMARY KEY (`id_hxh`),
  ADD KEY `id_hora` (`id_hora`),
  ADD KEY `id_horario` (`id_horario`);

--
-- Indices de la tabla `insidencias`
--
ALTER TABLE `insidencias`
  ADD PRIMARY KEY (`id_insidencia`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_horario` (`id_horario`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id_institucion`);

--
-- Indices de la tabla `planteles`
--
ALTER TABLE `planteles`
  ADD PRIMARY KEY (`id_plantel`),
  ADD KEY `id_institucion` (`id_institucion`);

--
-- Indices de la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  ADD PRIMARY KEY (`id_tipo_contrato`),
  ADD KEY `id_institucion` (`id_institucion`);

--
-- Indices de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `uniq_id_usuario` (`id_usuario`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`),
  ADD KEY `id_plantel` (`id_plantel`),
  ADD KEY `usuarios_ibfk_3_idx` (`id_tipo_contrato`),
  ADD KEY `usuarios_ibfk_4_idx` (`id_departamento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horas`
--
ALTER TABLE `horas`
  MODIFY `id_hora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `horas_x_horario`
--
ALTER TABLE `horas_x_horario`
  MODIFY `id_hxh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `insidencias`
--
ALTER TABLE `insidencias`
  MODIFY `id_insidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `planteles`
--
ALTER TABLE `planteles`
  MODIFY `id_plantel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  MODIFY `id_tipo_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_ibfk_1` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`);

--
-- Filtros para la tabla `horario_x_usuario`
--
ALTER TABLE `horario_x_usuario`
  ADD CONSTRAINT `horario_x_usuario_ibfk_1` FOREIGN KEY (`id_horario`) REFERENCES `horarios` (`id_horario`),
  ADD CONSTRAINT `horario_x_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `horas_x_horario`
--
ALTER TABLE `horas_x_horario`
  ADD CONSTRAINT `horas_x_horario_ibfk_1` FOREIGN KEY (`id_hora`) REFERENCES `horas` (`id_hora`),
  ADD CONSTRAINT `horas_x_horario_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horarios` (`id_horario`);

--
-- Filtros para la tabla `insidencias`
--
ALTER TABLE `insidencias`
  ADD CONSTRAINT `insidencias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `insidencias_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horarios` (`id_horario`);

--
-- Filtros para la tabla `planteles`
--
ALTER TABLE `planteles`
  ADD CONSTRAINT `planteles_ibfk_1` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`);

--
-- Filtros para la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  ADD CONSTRAINT `tipo_contrato_ibfk_1` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuarios` (`id_tipo_usuario`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_plantel`) REFERENCES `planteles` (`id_plantel`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`id_tipo_contrato`) REFERENCES `tipo_contrato` (`id_tipo_contrato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

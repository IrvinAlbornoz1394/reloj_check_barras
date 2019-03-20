-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-03-2019 a las 04:53:13
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

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
(5, 'Promoción yVinculación', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horario`, `id_usuario`) VALUES
(1, 1);

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
(1, '09:00:00', '16:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_x_horario`
--

CREATE TABLE `horas_x_horario` (
  `id_hora` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horas_x_horario`
--

INSERT INTO `horas_x_horario` (`id_hora`, `id_horario`) VALUES
(1, 1);

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
  `h_entrada` time NOT NULL,
  `h_salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `insidencias`
--

INSERT INTO `insidencias` (`id_insidencia`, `id_usuario`, `id_horario`, `fecha`, `dia_semana`, `h_entrada`, `h_salida`) VALUES
(1, 1, 1, '2019-03-18', 'Lunes', '00:00:00', '16:14:05');

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
(5, 'Practicas Profesionales');

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
  `codigo_barras` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_tipo_usuario`, `id_plantel`, `nombres`, `apellido_pat`, `apellido_mat`, `puesto`, `img_foto`, `file_foto`, `admin`, `clave_sesion`, `pass_sesion`, `id_tipo_contrato`, `id_departamento`, `codigo_barras`) VALUES
(1, 2, 1, 'Irvin Michael', 'Albornoz', 'Vazquez', 'Enc. Jefatura de Informatica', 'foto.jpg', 'foto.jpg', 0, '1394', 'CB06868BAB236AB6A16BF1D86A788E29', 1, 1, '123456789'),
(2, 3, 1, 'IRVIN MICHAEL', 'ALBORNOZ', 'VAZQUEZ', '', NULL, NULL, 0, '', '', 1, 4, '105c8ee7d152978'),
(3, 3, 1, 'IRVIN MICHAEL', 'ALBORNOZ', 'VAZQUEZ', '', NULL, NULL, 0, '', '', 1, 4, '105c8ee83648096'),
(4, 3, 1, 'IRVIN MICHAEL', 'ALBORNOZ', 'VAZQUEZ', 'JEFE', NULL, NULL, 0, '', '', 1, 4, '105c8ee862959e1'),
(5, 3, 1, 'IRVIN MICHAEL', 'ALBORNOZ', 'VAZQUEZ', 'JEFE', NULL, NULL, 0, 'irvin', 'cb06868bab236ab6a16bf1d86a788e29', 1, 4, '105c8ee8752399a'),
(6, 3, 1, 'IRVIN MICHAEL', 'ALBORNOZ', 'VAZQUEZ', 'JEFE', NULL, NULL, 0, 'irvin', 'cb06868bab236ab6a16bf1d86a788e29', 1, 4, '105c8ee922d795a'),
(7, 3, 1, 'IRVIN MICHAEL', 'ALBORNOZ', 'VAZQUEZ', 'JEFE', NULL, NULL, 0, 'irvin', 'cb06868bab236ab6a16bf1d86a788e29', 1, 4, '105c8ee93188a65'),
(8, 3, 1, 'IRVIN MICHAEL', 'ALBORNOZ', 'VAZQUEZ', 'JEFE', NULL, NULL, 0, 'irvin', 'cb06868bab236ab6a16bf1d86a788e29', 1, 4, '105c8ee934c3865'),
(9, 3, 1, 'IRVIN MICHAEL', 'ALBORNOZ', 'VAZQUEZ', 'JEFE', NULL, NULL, 0, 'irvin', 'cb06868bab236ab6a16bf1d86a788e29', 1, 4, '105c8ee94abd607'),
(10, 5, 1, 'IRVIN MICHAEL', 'ALBORNOZ', 'VAZQUEZ', 'JEFE', NULL, NULL, 1, 'Irvin', 'cb06868bab236ab6a16bf1d86a788e29', 1, 4, '105c8fd61fdb87e'),
(11, 2, 1, 'IRVIN', 'ALBORNOZ', 'VAZQUEZ', 'JEFE', '46239235_294110288101202_8847838414528053248_n.jpg', '5c8fdb908c471.jpg', 0, NULL, NULL, 1, 4, '105c8fdb908c460'),
(12, 2, 1, 'IRVIN', 'ALBORNOZ', 'VAZQUEZ', 'JEFE', '46239235_294110288101202_8847838414528053248_n.jpg', '5c8fdbb185195.jpg', 0, NULL, NULL, 1, 4, '105c8fdbb185184'),
(13, 3, 1, 'IRVIN', 'ALBORNOZ', 'VAZQUEZ', 'JEFE', '46239235_294110288101202_8847838414528053248_n.jpg', '5c8fdbbc51929.jpg', 1, 'Irvin', '87d0392586977274925a2d0759aa38aa', 1, 1, '105c8fdbbc518f8');

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
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `horas`
--
ALTER TABLE `horas`
  MODIFY `id_hora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `insidencias`
--
ALTER TABLE `insidencias`
  MODIFY `id_insidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_ibfk_1` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

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

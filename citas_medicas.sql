-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2016 a las 14:53:00
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citas_medicas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `turno` enum('Mañana','Tarde') NOT NULL,
  `status` enum('Pendiente de Pago','Pagada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `id_medico`, `id_paciente`, `fecha`, `turno`, `status`) VALUES
(3, 1, 2, '2016-08-19', 'Mañana', 'Pendiente de Pago'),
(4, 1, 1, '2016-08-22', 'Mañana', 'Pagada'),
(5, 3, 3, '2016-08-17', 'Tarde', 'Pagada'),
(6, 4, 4, '2016-08-17', 'Tarde', 'Pagada'),
(7, 2, 4, '2016-08-19', 'Mañana', 'Pagada'),
(8, 5, 3, '2016-08-22', 'Tarde', 'Pendiente de Pago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `sintomas` text NOT NULL,
  `diagnostico` text NOT NULL,
  `tratamiento` text NOT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id`, `id_cita`, `sintomas`, `diagnostico`, `tratamiento`, `observaciones`) VALUES
(1, 6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, nemo!', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, nemo!', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, nemo!', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, nemo!'),
(2, 7, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur tempore iure alias perspiciatis laborum, laudantium ipsum rem maiores aspernatur vero, quisquam officiis. Earum laboriosam eveniet itaque tenetur, deleniti? Cupiditate, tempora.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur tempore iure alias perspiciatis laborum, laudantium ipsum rem maiores aspernatur vero, quisquam officiis. Earum laboriosam eveniet itaque tenetur, deleniti? Cupiditate, tempora.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur tempore iure alias perspiciatis laborum, laudantium ipsum rem maiores aspernatur vero, quisquam officiis. Earum laboriosam eveniet itaque tenetur, deleniti? Cupiditate, tempora.', ''),
(3, 5, 'Esto es un ejemplo para probar el sistema', 'Esto es un ejemplo para probar el sistema', 'Esto es un ejemplo para probar el sistema', 'Esto es un ejemplo para probar el sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id`, `descripcion`) VALUES
(1, 'Cardiología'),
(2, 'Medicina Interna'),
(3, 'Ginecología'),
(4, 'Traumatología'),
(5, 'Odontología'),
(6, 'Oncología'),
(7, 'Dermatología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `ingreso` date NOT NULL,
  `consultorio` varchar(50) NOT NULL,
  `precio_consulta` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id`, `id_persona`, `id_especialidad`, `ingreso`, `consultorio`, `precio_consulta`) VALUES
(1, 3, 3, '2009-03-20', '1-A', 18000),
(2, 4, 1, '2008-02-18', '11-Z', 33000),
(3, 7, 2, '2016-03-22', '3B', 12000),
(4, 8, 7, '2002-04-07', '2G', 25000),
(5, 11, 4, '2016-08-09', 'TJD100PRE', 22000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `nacimiento` date NOT NULL,
  `adn` enum('AB+','AB-','A+','A-','B+','B-','O+','O-') NOT NULL,
  `peso` float NOT NULL,
  `altura` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `id_persona`, `nacimiento`, `adn`, `peso`, `altura`) VALUES
(1, 5, '1995-07-12', 'B-', 45, 1.6),
(2, 6, '1991-04-29', 'AB+', 80, 1.53),
(3, 9, '1988-05-09', 'AB+', 0, 0),
(4, 10, '1989-09-12', 'A-', 45, 1.73);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `id_cita`, `fecha`, `monto`) VALUES
(1, 4, '2016-08-18', 25000),
(2, 5, '2016-08-16', 12000),
(3, 6, '2016-08-17', 20000),
(4, 7, '2016-08-17', 25000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_empresa`
--

CREATE TABLE `perfil_empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `rif` varchar(50) NOT NULL,
  `d_fiscal` text NOT NULL,
  `sucursal` text NOT NULL,
  `tlf_uno` varchar(100) NOT NULL,
  `tlf_dos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `logotipo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `sexo` enum('Femenino','Masculino') NOT NULL,
  `email` varchar(80) NOT NULL,
  `tlf` varchar(50) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `documento`, `sexo`, `email`, `tlf`, `foto`) VALUES
(1, 'Kevin Abel Brito', '21349732', 'Masculino', 'kevinabelbrito@hotmail.com', '04143946360', '77413a9cef520b7de633f5caff3d6fc5.png'),
(2, 'Victor Serrano', '22722738', 'Masculino', 'victordserrano@gmail.com', '04147983748', 'no-avatar.jpg'),
(3, 'Humberto Caballero Gascon', '10737987', 'Masculino', 'humberto@prueba.net', '02128892348', 'no-avatar.jpg'),
(4, 'Cell', '11882394', 'Masculino', 'cecll@dbz.com', '04123288237', 'c1f534db04cdf81e62164ca25794b2dd.jpg'),
(5, 'Rima Abo Seid', '22883928', 'Femenino', 'rimaboseid@gmail.com', '04129983928', 'no-avatar.jpg'),
(6, 'Mary Marin', '18773223', 'Femenino', 'maria@ejemplo.com', '04167782374', 'no-avatar.jpg'),
(7, 'Guillermina Quilarte', '15828824', 'Femenino', 'guille@mail.com', '04162893832', 'no-avatar.jpg'),
(8, 'Francisco Gonzales', '72888326', 'Masculino', 'francisco@ejemplo.com', '02128287664', 'no-avatar.jpg'),
(9, 'Jose Loreto', '84558902', 'Masculino', 'jose@ejemplo.com', '04145772873', 'no-avatar.jpg'),
(10, 'Debora Nacimento', '86778125', 'Femenino', 'debora@ejemplo.com', '04126687384', 'no-avatar.jpg'),
(11, 'Vegeta', '9883872', 'Masculino', 'vegeta@mail.com', '02122894823', '6cd25c6581b3d20a20f32aebf01f6bfb.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tipo` enum('Administrador','Editor') CHARACTER SET latin1 NOT NULL,
  `password` varchar(30) CHARACTER SET latin1 NOT NULL,
  `preg` text CHARACTER SET latin1 NOT NULL,
  `resp` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_persona`, `username`, `tipo`, `password`, `preg`, `resp`) VALUES
(1, 1, 'kevinabelbrito', 'Editor', 'abcd1234', '¿Cuál es su número de calzado?', '45'),
(2, 2, 'victorserrano', 'Administrador', 'abcd1234', '¿Una Fecha a recordar?', 'Mi cumple');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medico` (`id_medico`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_cita` (`id_cita`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_persona` (`id_persona`),
  ADD KEY `id_especialidad` (`id_especialidad`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_cita` (`id_cita`) USING BTREE;

--
-- Indices de la tabla `perfil_empresa`
--
ALTER TABLE `perfil_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_persona` (`id_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `perfil_empresa`
--
ALTER TABLE `perfil_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `medicos_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicos_ibfk_2` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 20:20:17
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anotaciones`
--

CREATE TABLE `anotaciones` (
  `id` int(11) NOT NULL,
  `anotacion` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anotaciones`
--

INSERT INTO `anotaciones` (`id`, `anotacion`, `fecha`) VALUES
(8, 'Verificación: asociar con Google el acceso.', '2024-11-08 14:09:39'),
(11, 'Agregar personalización de perfiles.', '2024-11-10 03:49:52'),
(12, 'Agregar sistema de notificación.', '2024-11-10 04:12:38'),
(20, 'Unificar estilos de todas las páginas, y pie de página.', '2024-11-10 05:20:48'),
(21, 'Establecer Roles, quien elimina a los bibliotecarios.', '2024-11-10 05:26:20'),
(22, 'Revisar áreas no encontradas en relación de tablas materiales.', '2024-11-10 06:13:16'),
(23, 'Sistema de Gestión de Reglas, codificar.', '2024-11-12 02:51:35'),
(24, 'Revisar ortografía en el menú de bibliotecario.', '2024-11-12 22:18:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `codigo_dewey` varchar(3) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `codigo_dewey`, `nombre`) VALUES
(1, '000', 'Obras Generales'),
(2, '100', 'Filosofía y Psicología'),
(3, '200', 'Religión'),
(4, '300', 'Ciencias Sociales'),
(5, '400', 'Lenguas'),
(6, '500', 'Ciencias Naturales y Matemáticas'),
(7, '600', 'Tecnología y Ciencias Aplicadas'),
(8, '700', 'Artes y Recreación'),
(9, '800', 'Literatura'),
(10, '900', 'Historia y Geografía'),
(82, '681', 'Instrumentos de precisión y otros dispositivos'),
(83, '526', 'Dibujo de mapas'),
(84, '004', 'Ciencias de la Computación y Tecnología de la Información.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bibliotecarios`
--

CREATE TABLE `bibliotecarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `bibliotecarios`
--

INSERT INTO `bibliotecarios` (`id`, `nombre`, `email`, `usuario`, `password`) VALUES
(0, 'Eduardo', 'edu.ar@hotmail.com', 'Edu', '$2y$10$gv1PnAkjUmKliZhkaQ1Fr.s9KskC8wwGnDdC8jxqhLSNXcK25YSWq'),
(0, 'Facu', 'Facuarias@gmail.com', 'Farias', '$2y$10$V2yHOQc07pk9iBlIhIpAie/5c6j3gVMKXpY1TNNxsHikeIHYnN73K'),
(0, 'Gerardo Sopopich', 'gerosopi_32@gmail.com', 'Geropi', '$2y$10$RO0LS0k9ZdgscFwiMf1oKOhvxTKDNQ79HdN1teDLR2yOXDup5bOnG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `anio_publicacion` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `disponibilidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id`, `titulo`, `autor`, `anio_publicacion`, `area_id`, `categoria`, `codigo`, `disponibilidad`) VALUES
(15, 'Harry potter y la piedra Filosofal', ' J. K. Rowling Escritora británica', 2007, NULL, '3', 'afgh126', 6),
(16, 'Introducción a la Programación', 'John Smith', 2019, NULL, '84', 'TEC001', 3),
(17, 'Filosofía Moderna', 'María García', 2018, NULL, '2', 'FIL002', 8),
(18, 'Jachal bodegas del re encuentro', 'Pablo Joshelo', 2009, NULL, '1', 'ssaa342', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `descripcion`, `imagen`, `fecha`) VALUES
(6, 'Nuevas adquisiciones 📚', '¡Llegaron nuevos títulos a nuestra colección! Visita la sección de novedades y descubre los últimos libros en literatura, ciencia y más.', 'img/9788411482448-leer-libros-disenar-portadas.jpg', '2024-11-08 10:31:37'),
(7, 'Clases de apoyo escolar ✏️', 'Apoya tu estudio con nuestras clases gratuitas de refuerzo en matemáticas y literatura. Inscripciones abiertas en el mostrador de información.', 'img/WhatsApp-Image-2024-02-02-at-10.00.45.jpeg', '2024-11-08 10:43:19'),
(8, 'Club de lectura juvenil 📖', 'Únete al club de lectura juvenil y comparte tu pasión por los libros. Nos reunimos el último viernes de cada mes a las 5:00 p.m.', 'img/JuveWeb.png', '2024-11-08 10:45:51'),
(9, 'Taller de escritura creativa ✍️', 'Desarrolla tu talento y estilo en nuestro taller de escritura. ¡No necesitas experiencia previa! Próxima sesión el 10 de noviembre.', 'img/taller-escritura-creativa_web.jpg', '2024-11-08 11:03:28'),
(10, 'Ampliación de horario ⏰', 'Desde ahora, abrimos los sábados de 8 a 12 Hs para que tengas más tiempo de disfrutar de la biblioteca.', 'img/unnamed.jpg', '2024-11-08 11:19:18'),
(11, 'Exposición de arte 🎨', 'Visita la exposición de arte local en el Museo Provincial de Bellas Artes Franklin Rawson. Obras de artistas de la comunidad, disponibles todo el mes de noviembre.', 'img/20220313_192935.jpg', '2024-11-08 11:24:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `socio_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `estado` enum('pendiente','devuelto','atrasado') NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `anio` tinyint(1) DEFAULT NULL CHECK (`anio` in (1,2,3,4)),
  `division` tinyint(1) DEFAULT NULL CHECK (`division` in (1,2,3))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id`, `nombre`, `apellido`, `telefono`, `direccion`, `email`, `anio`, `division`) VALUES
(35, 'Juan', 'Pérez', '123456789', 'Calle Falsa 123', 'juan.perez@email.com', 1, 1),
(36, 'Ana', 'Gómez', '987654321', 'Av. Siempre Viva 456', 'ana.gomez@email.com', 2, 1),
(37, 'Luis', 'Martínez', '555888222', 'Calle del Sol 789', 'luis.martinez@email.com', 3, 2),
(38, 'María', 'Sánchez', '666777555', 'Calle de los Álamos 101', 'maria.sanchez@email.com', 4, 2),
(39, 'Carlos', 'López', '444555666', 'Callejón de la Luna 202', 'carlos.lopez@email.com', 1, 3),
(40, 'Lucía', 'Rodríguez', '333444555', 'Calle del Río 303', 'lucia.rodriguez@email.com', 2, 3),
(41, 'David', 'Hernández', '222333444', 'Calle de la Paz 404', 'david.hernandez@email.com', 3, 1),
(42, 'Laura', 'Fernández', '111222333', 'Calle de la Primavera 505', 'laura.fernandez@email.com', 4, 1),
(43, 'José', 'Martínez', '777888999', 'Av. Libertador 606', 'jose.martinez@email.com', 1, 2),
(44, 'Isabel', 'Díaz', '888999111', 'Calle del Bosque 707', 'isabel.diaz@email.com', 2, 2),
(45, 'Pedro', 'García', '999111222', 'Calle de la Estrella 808', 'pedro.garcia@email.com', 3, 3),
(46, 'Raquel', 'González', '666333444', 'Av. de los Olivos 909', 'raquel.gonzalez@email.com', 4, 3),
(47, 'Andrés', 'Torres', '555444333', 'Calle de los Cedros 1010', 'andres.torres@email.com', 1, 1),
(48, 'Elena', 'Jiménez', '444333222', 'Calle del Encinar 1111', 'elena.jimenez@email.com', 2, 1),
(49, 'Miguel', 'Ruiz', '333222111', 'Calle de los Pinos 1212', 'miguel.ruiz@email.com', 3, 2),
(50, 'Sofia', 'Morales', '222111000', 'Calle de la Montaña 1313', 'sofia.morales@email.com', 4, 2),
(51, 'Felipe', 'Vázquez', '111000999', 'Calle de la Nieve 1414', 'felipe.vazquez@email.com', 1, 3),
(52, 'Marta', 'Ramírez', '000999888', 'Av. de la Luna 1515', 'marta.ramirez@email.com', 2, 3),
(53, 'Rafael', 'Navarro', '333555777', 'Calle del Árbol 1616', 'rafael.navarro@email.com', 3, 1),
(54, 'Carmen', 'Moreno', '444666888', 'Calle de la Loma 1717', 'carmen.moreno@email.com', 4, 1),
(55, 'Óscar', 'Muñoz', '555777999', 'Callejón del Viento 1818', 'oscar.munoz@email.com', 1, 2),
(56, 'Patricia', 'Serrano', '666888000', 'Av. de los Olivos 1919', 'patricia.serrano@email.com', 2, 2),
(57, 'Daniel', 'Cruz', '777999111', 'Calle de la Cumbre 2020', 'daniel.cruz@email.com', 3, 3),
(58, 'Verónica', 'Gutiérrez', '888111222', 'Calle de los Jazmines 2121', 'veronica.gutierrez@email.com', 4, 3),
(59, 'Antonio', 'Santiago', '999222333', 'Calle de los Laureles 2222', 'antonio.santiago@email.com', 1, 1),
(60, 'Cristina', 'Morales', '111333444', 'Av. de las Palmas 2323', 'cristina.morales@email.com', 2, 1),
(61, 'Eduardo', 'Jiménez', '333444555', 'Calle de las Rosas 2424', 'eduardo.jimenez@email.com', 3, 2),
(62, 'Julia', 'Guerra', '444555666', 'Calle del Olmo 2525', 'julia.guerra@email.com', 4, 2),
(63, 'Antonio', 'Blanco', '555666777', 'Calle de los Lirios 2626', 'antonio.blanco@email.com', 1, 3),
(64, 'Elena', 'Martín', '666777888', 'Calle de la Laguna 2727', 'elena.martin@email.com', 2, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anotaciones`
--
ALTER TABLE `anotaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_dewey` (`codigo_dewey`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `bibliotecarios`
--
ALTER TABLE `bibliotecarios`
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `fk_categoria` (`categoria`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socio_id` (`socio_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anotaciones`
--
ALTER TABLE `anotaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD CONSTRAINT `materiales_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `materiales` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

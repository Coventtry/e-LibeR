-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2025 a las 20:47:54
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
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anotaciones`
--

CREATE TABLE `anotaciones` (
  `id` int(11) NOT NULL,
  `anotacion` varchar(255) NOT NULL,
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
(23, 'Sistema de Gestión de Reglas, codificar.', '2024-11-12 02:51:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `codigo_dewey` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `Abreviado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `codigo_dewey`, `nombre`, `Abreviado`) VALUES
(1, '010', 'Ciencias Naturales / Tecnología / Medioambiente', 'CIENAT'),
(2, '100', 'Lengua y Literatura / Prácticas del Lenguaje', 'LENG'),
(3, '200', 'Matemática', 'MAT'),
(4, '300', 'Ciencias Sociales / Historia / Geografía', 'CISO'),
(5, '400', 'Educación Sexual Integral (ESI)', 'ESI'),
(6, '500', 'Educación Inicial / Nivel Primario', 'EDINIP'),
(7, '600', 'Educación Física / Juego y Movimiento', 'EDUFIS'),
(8, '700', 'Filosofía / Formación Ética y Ciudadana', 'FILOS'),
(9, '800', 'Psicología / Neurociencias / Educación Emocional', 'PSICO'),
(10, '900', 'Pedagogía Crítica / Gestión Escolar / Evaluación', 'PEDA'),
(82, '681', 'Proyectos Institucionales / Currículo / Planificación', 'PROY'),
(83, '526', 'Inclusión / Diversidad / Interculturalidad', 'INCLU'),
(84, '004', 'Ciencias de la Computación y Tecnología de la Información', NULL),
(86, '1000', 'Didáctico / Formación Docente', 'DIDAC'),
(87, '250', 'Arte y Literatura Argentina', 'ARTELIT'),
(89, '1100', 'Lengua Extranjera / Enseñanza del Inglés', 'LENEXT'),
(90, '1200', 'Educación Artística / Convivencia Escolar', 'EDUART'),
(91, '1300', 'Literatura Infantil / Juvenil', 'LITINF'),
(92, '50', 'TIC / Informática Educativa / Recursos Digitales', 'TIC'),
(93, '60', 'Investigación Educativa / Tesis / Ensayos', 'INVEST'),
(94, '70', 'Educación Ambiental / Sostenibilidad', 'AMBIENT'),
(95, '210', 'Educación en Pandemia / Nuevos Escenarios', 'PANDEM'),
(96, '220', 'Teoría Educativa / Sociología / Política de la Educación', 'TEO'),
(97, '230', 'Antologías / Compilaciones Literarias', 'ANTO'),
(98, '240', 'Teatro / Expresión Corporal / Narración Oral', 'TEATRO'),
(99, '260', 'Lectura y Escritura / Talleres / Producción Textual', 'LECTESCR'),
(100, '270', 'Revistas Educativas / Publicaciones Especiales', 'REVIST'),
(101, '280', 'Manual Escolar / Recursos Didácticos Generales', 'MANUAL'),
(102, '310', 'Mapas / Atlas / Cartografía Escolar', 'MAPA'),
(103, '320', 'Educación Rural / Contextos Desfavorecidos', 'RURAL'),
(104, '330', 'Historia Argentina / Historia Universal / Procesos Políticos', 'HISTAR'),
(107, '4456', 'pepinologia', 'pepi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bibliotecarios`
--

CREATE TABLE `bibliotecarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Clave_unica` varchar(50) DEFAULT NULL,
  `picture` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bibliotecarios`
--

INSERT INTO `bibliotecarios` (`id`, `nombre`, `email`, `telefono`, `usuario`, `password`, `Clave_unica`, `picture`) VALUES
(1, 'Juan Endrizzi', 'usuarui_deprueba@gmail.com', NULL, 'admin', '$2y$10$qj/UsqoFcCtD3sdm/5EH5.zjIge78cwP/QeN5O7VRyiBMNfd4zjee', '$2y$10$H6K6lmQrgPkodeVfeEkgz.Ls4chz00aIvuxrcKeJfsR', ''),
(6, 'Jero', 'jeronimo123@gmail.com', '2452122422', 'Jero', '$2y$10$3AuGS/3QYe380hYXzEDoMuMmM28ngU9pxxnEkPSrpmjZHI2.m.i0S', '$2y$10$qqpA9h5dksmnF0AjNvDCVOwpLJTIFoIJ8SiGBZHRR4g', ''),
(8, 'Rodrigo A. Garcia S.', 'rodrigogarciafaud@gmail.com', NULL, 'Rodrigo G.', '$2y$10$O11Fg0vJXE1dZskiIi9wE.qXO4CHXwRjZdkW5iezQYA/QgCXiMaNS', '$2y$10$fPIUgzQtPWI9mKBEdxxcF.2cA9bHCyaS8rtijCd4dWc', '167584762.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_socios`
--

CREATE TABLE `historial_socios` (
  `id` int(11) NOT NULL,
  `id_socio` int(11) NOT NULL,
  `accion` enum('ALTA','BAJA') NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `autor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `anio_publicacion` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `disponibilidad` int(11) DEFAULT NULL,
  `editorial` varchar(255) DEFAULT NULL,
  `clasificacion_fisica` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id`, `titulo`, `autor`, `anio_publicacion`, `area_id`, `categoria`, `codigo`, `disponibilidad`, `editorial`, `clasificacion_fisica`) VALUES
(165, 'Transilvania express Guía de vampiros y de Monstruos', 'De Santis Pablo', 2014, 91, 'LIBRO', '1300-002', 9, 'Colihue', 'INFJU -A-1-2'),
(167, 'EL Superzorro', 'Roald Dahl', 2014, 91, 'LIBRO', '1300-004', 5, 'Alfaguara', 'INFJU -A-1-2'),
(168, 'El héroe y otros cuentos', 'Ricardo Mariño', 2009, 91, 'LIBRO', '1300-005', 5, 'Alfaguara', 'INFJU -A-1-2'),
(169, 'La Nariz', 'Gogol Nikolai', 2014, 91, 'LIBRO', '1300-006', 5, 'Colihue', 'INFJU -A-1-2'),
(170, 'El Reino del Revés (2 ejemplares)', 'Walsh María Elena', 2004, 91, 'LIBRO', '1300-007', 5, 'Alfaguara', 'INFJU -A-1-2'),
(172, 'Los viejitos de la casa', 'Iris Rivera', 2013, 91, 'LIBRO', '1300-009', 5, 'Edebe', 'INFJU -A-1-2'),
(173, 'La princesa y el guisante', 'Andersen Hans Chistian', 2012, 91, 'LIBRO', '1300-010', 5, 'Anaya', 'INFJU -A-1-2'),
(174, 'Una trenza tan larga', 'Bornemann Elsa', 2013, 91, 'LIBRO', '1300-011', 5, 'Alfaguara', 'INFJU -A-1-2'),
(176, 'Todas las lunas son mías de lunático, duendes y hombres lobo', 'Coton Laura B., Actis Beatriz', 2014, 91, 'LIBRO', '1300-013', 5, 'Homo sapiens', 'INFJU -A-1-2'),
(177, 'Las Flores de Hielo', 'Jordi Sierra Fabra', 2014, 91, 'LIBRO', '1300-014', 5, 'Alberto Luongo', 'INFJU -A-1-2'),
(178, 'La casa bajo el teclado', 'Wolf Ema', 2013, 91, 'LIBRO', '1300-015', 5, 'Norma', 'INFJU -A-1-2'),
(179, 'Barba negra y los boñuelos', 'Wolf Ema', 2014, 91, 'LIBRO', '1300-016', 5, 'Colihue', 'INFJU -A-1-2'),
(180, 'Confidencias de un superhéroe', 'Sandoval Alfonso Jaime', 2014, 91, 'LIBRO', '1300-017', 5, 'Macmillan', 'INFJU -A-1-2'),
(183, 'LA Hormiga que Canta', 'Deventach Laura, Lima Juan', 2013, 91, 'LIBRO', '1300-020', 5, 'Del eclipse', 'INFJU -A-1-2'),
(184, 'Hola y Chau, Papá (Obras de teatro)', 'FALCONI María Inés', 2013, 91, 'LIBRO', '1300-021', 5, 'Quipu', 'INFJU -A-1-2'),
(185, 'Una Ballena de patas Cortas', 'Batista Ethel Gabriela, Mastrugiullo María Eva', 2013, 91, 'LIBRO', '1300-022', 5, 'Del Eclipse', 'INFJU -A-1-2'),
(186, 'Versos que no muerden (o si)', 'Ferro Beatriz, Torres Elena', 2014, 91, 'LIBRO', '1300-023', 5, 'Estrada', 'INFJU -A-1-2'),
(187, 'Niña Bonita', 'Machado Ana María, faria Rosana', 2013, 91, 'LIBRO', '1300-024', 5, 'Ekare', 'INFJU -A-1-2'),
(188, 'Unas vacaciones compartidas', 'Tabare', 2013, 91, 'LIBRO', '1300-025', 5, 'Colihue', 'INFJU -A-1-2'),
(189, 'Flor, ataulfo y el Dragón', 'Wolf, Ema, torres Elena', 2012, 91, 'LIBRO', '1300-026', 5, 'AIQUE', 'INFJU -A-1-2'),
(190, 'En el Desván', 'Oram Hiawyn, Satoshi Kitamura', 2013, 91, 'LIBRO', '1300-027', 5, 'Fondo de cultura económica', 'INFJU -A-1-2'),
(191, 'EL Flautista de Hamelin', 'Delgado Josep', 2013, 91, 'LIBRO', '1300-028', 5, 'Edebe', 'INFJU -A-1-2'),
(192, 'Malvado conejito', 'Willis Jeanne, Ross Tony', 2009, 91, 'LIBRO', '1300-029', 5, 'Océano, travesía', 'INFJU -A-1-2'),
(193, 'Palabras Manzana', 'LUJAN Jorge, MARIN Manuel', 2013, 91, 'LIBRO', '1300-030', 5, 'Aique, Anaya', 'INFJU -A-1-2'),
(194, 'Tuk es tuk', 'Legnazzi Claudia, Istvan Schritter', 2013, 91, 'LIBRO', '1300-031', 5, 'Del eclipse', 'INFJU -A-1-2'),
(195, '¿Quién Puso el nombre a la luna?', 'Goldberg MIRTA, Singer IRENE', 2013, 91, 'LIBRO', '1300-032', 5, 'Cántaro', 'LITINF-A-1-2'),
(196, 'Nos Miramos', 'Ratti, María Paula', 2013, 91, 'LIBRO', '1300-033', 5, 'a-z', 'INFJU -A-1-2'),
(197, 'Lo que hay antes de que haya algo (un de terror)', 'Liniers', 2014, 91, 'LIBRO', '1300-034', 5, 'Pequeño editor', 'INFJU -A-1-2'),
(198, 'Mitos y leyendas de la argentina (historias de nuestro pueblo)', 'Riveros IRIS, Mascota Diego', 2014, 91, 'LIBRO', '1300-035', 5, 'ESTRADA', 'INFJU -A-1-2'),
(199, 'Trabalenguero', 'Ricon VALENTIN, RICON Gilda, Cuca Serratos', 2013, 91, 'LIBRO', '1300-036', 5, 'V y R', 'INFJU -A-1-2'),
(200, 'La leyenda del salmón y el Martín pescador', 'Mariño Ricardo, Prada MARTA', 2013, 91, 'LIBRO', '1300-037', 5, 'Sudamericana', 'INFJU -A-1-2'),
(201, 'El gato que amaba la mancha naranja', 'Mesquita ELSA, Pereira ANA', 2013, 91, 'LIBRO', '1300-038', 5, 'V y R', 'INFJU -A-1-2'),
(203, 'La leyenda del bicho colorado', 'Roldan Gustavo', 2013, 91, 'LIBRO', '1300-040', 5, 'Alfaguara', 'INFJU -A-1-2'),
(204, 'Tengo una gata', 'Ratti María Paula', 2013, 91, 'LIBRO', '1300-041', 5, 'A-Z', 'INFJU -A-1-2'),
(205, 'La gata y la luna', 'Mo María Rosa', 2013, 91, 'LIBRO', '1300-042', 5, 'Cronopio Azul', 'INFJU -A-1-2'),
(206, 'El titiritero de la paloma', 'Tignanelli Horacio', 2013, 91, 'LIBRO', '1300-043', 5, 'Colihue', 'INFJU -A-1-2'),
(208, 'Chiquilin de BACHIN', 'Ferrer Horacio, lozupone María Delia', 2013, 91, 'LIBRO', '1300-045', 5, 'Además', 'INFJU -A-1-2'),
(209, 'Gusti, en el misterio del ojo de Amaru', 'Rapun Graciela, Melatoni Enrique', 2014, 91, 'LIBRO', '1300-046', 5, 'Riderchail Ediciones', 'INFJU -A-1-2'),
(211, 'Animal enamorado (2 ejemplares)', 'Mo MARIA Rosa, Pérez SILVINA', 2013, 91, 'LIBRO', '1300-048', 5, 'Del Cronopio azul', 'INFJU -A-1-2'),
(212, 'La leyenda de la ballena', 'Wolf EMA, Prada MARTA, ROJAS Oscar', 2013, 91, 'LIBRO', '1300-049', 5, 'Sudamericana', 'INFJU -A-1-2'),
(213, 'La familia delasoga', 'Montes Graciela', 2013, 91, 'LIBRO', '1300-050', 5, 'Colihue', 'INFJU -A-1-2'),
(214, 'La línea', 'Domenec Beatriz, Ayac Barnes', 2014, 91, 'LIBRO', '1300-051', 5, 'Del Eclipse', 'INFJU -A-1-2'),
(215, 'Sígueme (una historia de amor raro)', 'Campaneri José, Olmos Roger', 2013, 91, 'LIBRO', '1300-052', 5, 'Magnolia ediciones', 'INFJU -A-1-2'),
(216, 'EL Tambor de seda y otros cuentos esenciales', 'Anónimo, Larsen JACOBO compilador', 2014, 91, 'LIBRO', '1300-053', 5, 'Troquel', 'INFJU -A-1-2'),
(218, 'Cuentos para seguir creciendo (para alumnos que terminan el nivel inicial)', 'varios', 2008, 91, 'LIBRO', '1300-055', 5, 'Ministerio de educación (presidencia de la nación)', 'INFJU -A-1-2'),
(219, 'Li M in, una niña de chimel (9 ejemplares)', 'Menchu Rigoberta, Liano DANTE', 2014, 91, 'LIBRO', '1300-056', 5, 'a-z ediciones', 'INFJU -A-1-2'),
(221, 'La pandilla del ángel', 'Cabal Graciela, Lujan Rodrigo', 2014, 91, 'LIBRO', '1300-058', 5, 'Norma', 'INFJU -A-1-2'),
(222, 'Historia de fantasmas, bichos y aventureros (7 ejemplares)', 'Actis Beatriz', 2014, 91, 'LIBRO', '1300-059', 5, 'Homo Sapiens', 'INFJU -A-1-2'),
(223, 'Tantos animalitos muertos (8 Ejemplares)', 'Ulf Nilson, Maja Bentzer y Peña Sergio traducción', 2014, 91, 'LIBRO', '1300-060', 5, 'Macmillan', 'INFJU -A-1-2'),
(224, 'Una luna junto a la laguna', 'Basch Adela, Pez Alberto', 2016, 91, 'LIBRO', '1300-061', 5, 'S/M', 'INFJU -A-1-2'),
(225, 'Robinson Crusoe', 'anónimo', 1987, 91, 'LIBRO', '1300-062', 5, 'Sigmar Ediciones', 'INFJU -A-1-2'),
(226, 'Tres cuentos de POE En B/N (5 ejemplares)', 'Besse Xavier', 2014, 91, 'LIBRO', '1300-063', 5, 'Edelvives', 'INFJU -A-1-2'),
(227, 'La batalla de la Luna Rosada', 'Bernal Pinilla Luis Darío', 2014, 91, 'LIBRO', '1300-064', 5, 'Fondo de cultura Económica', 'INFJU -A-1-2'),
(228, 'Peter Pan', 'Barrie Matthew James', 2013, 91, 'LIBRO', '1300-065', 5, 'Edebe', 'INFJU -A-1-2'),
(229, 'El sueño interminable una investigación de John chatterton', 'Yvan Pommaux', 2013, 91, 'LIBRO', '1300-066', 5, 'Ekare', 'INFJU -A-1-2'),
(230, 'Las lavanderas locas', 'Yeoman John, Blake Quentin', 2009, 91, 'LIBRO', '1300-067', 5, 'Océano', 'INFJU -A-1-2'),
(231, 'El nacimiento del DRAGON', 'Fei Wang y Sellier Marie, Louis Catherine', 2014, 91, 'LIBRO', '1300-068', 5, 'Iamique – Kalandraka', 'INFJU -A-1-2'),
(232, 'Cuentos callejeros', 'Schapiro Natalia, Pironio Mónica', 2014, 91, 'LIBRO', '1300-069', 5, 'Edebe', 'INFJU -A-1-2'),
(233, 'Dimitri en la tormenta', 'Perla Suez, Cuello Jorge', 2014, 91, 'LIBRO', '1300-070', 5, 'Sudamericana', 'INFJU -A-1-2'),
(234, 'La composición', 'Skarmeta Antonio, lozupone María Delia', 2014, 91, 'LIBRO', '1300-071', 5, 'Sudamericana', 'INFJU -A-1-2'),
(235, 'Apestoso Hombre Queso y otros cuentos maravillosamente estúpidos', 'Sciezka Jon, Smith Lane', 2013, 91, 'LIBRO', '1300-072', 5, 'Continente', 'INFJU -A-1-2'),
(236, 'Erase una vez Don Quijote', 'Miguel de Cervantes Agustin Sánchez adaptación, Nivio lopez Vigil', 2013, 91, 'LIBRO', '1300-073', 5, 'Vicens Vives', 'INFJU -A-1-2'),
(237, 'Lobos', 'Gravett Emily', 2013, 91, 'LIBRO', '1300-074', 5, 'Macmillan', 'INFJU -A-1-2'),
(238, 'Ali Baba y los cuarenta ladrones (2 ejemplares)', 'Luc Lefort adaptaciones, Emre Orhun ilustraciones', 2013, 91, 'LIBRO', '1300-075', 5, 'La aldaba de bronce', 'INFJU -A-1-2'),
(239, 'El horrible sueño de Harriet (otros cuentos de terror)', 'Horowitz Anthony, Peláez ilustraciones, María Vinos traducción', 2013, 91, 'LIBRO', '1300-076', 5, 'Fondo de cultura económica', 'INFJU -A-1-2'),
(240, 'Llaves', 'Iris Rivera, Sánchez Javier ilustraciones', 2013, 91, 'LIBRO', '1300-077', 5, 'Edebe', 'INFJU -A-1-2'),
(241, 'Los cuervos de Pearblossom', 'Huxley Aldous, Sanabria José', 2011, 91, 'LIBRO', '1300-078', 5, 'S/m', 'INFJU -A-1-2'),
(242, 'Ludopolis, la cuidad de los juguetes', 'No Laura', 2013, 91, 'LIBRO', '1300-079', 5, 'Estrada', 'INFJU -A-1-2'),
(243, 'El Secreto Coco, canela y anís', 'María Lopez Soria, Roldan Gustavo', NULL, 91, 'LIBRO', '1300-080', 5, 'Everest', 'INFJU -A-1-2'),
(244, 'Flotante', 'Wiesner David', 2006, 91, 'LIBRO', '1300-081', 5, 'Océano', 'INFJU -A-1-2'),
(245, 'Historia de la resurrección del papagayo', 'Galeano Eduardo, Santos Antonio imágenes', 2013, 91, 'LIBRO', '1300-082', 5, 'Magnolia', 'INFJU -A-1-2'),
(246, 'Cuantos de Gulubu', 'Walsh María Elena', 2013, 91, 'LIBRO', '1300-083', 5, 'Alfaguara', 'INFJU -A-1-2'),
(247, 'EL Árbol de lilas', 'Andruetto María teresa, Menéndez Liliana', 2013, 91, 'LIBRO', '1300-084', 5, 'Comunicarte', 'INFJU -A-1-2'),
(248, 'Tucán aprende una palabra', 'Averbach Margara, Bilotti Viviana', 2013, 91, 'LIBRO', '1300-085', 5, 'Naranjo Ediciones', 'INFJU -A-1-2'),
(249, 'El hombre que aprendió a ladrar y otros cuantos', 'Benedetti Mario, Cees van der Hust', 2012, 91, 'LIBRO', '1300-086', 5, 'Aique', 'INFJU -A-1-2'),
(250, 'Los mejores días', 'Janisch Heinz, Bansch Helga', 2013, 91, 'LIBRO', '1300-087', 5, 'Edelvives', 'INFJU -A-1-2'),
(251, 'Pinocho', 'Collodi Carlos, Aguilar sanchez Agustin adaptado', 2013, 91, 'LIBRO', '1300-088', 5, 'Vicen Vives', 'INFJU -A-1-2'),
(252, 'Caperucita Roja II', 'Esteban Valentino', 2013, 91, 'LIBRO', '1300-089', 5, 'Colihue', 'INFJU -A-1-2'),
(253, 'El país de JUAN', 'Andruetto María teresa, Hernández Gabriel Ilustraciones', 2013, 91, 'LIBRO', '1300-090', 5, 'Aique', 'INFJU -A-1-2'),
(254, 'Rolf y Rosi', 'Swindells Robert', 2013, 91, 'LIBRO', '1300-091', 5, 'Fondo de cultura económica', 'INFJU -A-1-2'),
(255, 'Chamario (Libro de rimas para niños)', 'Polo Eduardo, Ballester Arnal', 2013, 91, 'LIBRO', '1300-092', 5, 'Ekare ediciones', 'INFJU -A-1-2'),
(256, 'EL Secreto del oso hormiguero', 'Oses Beatriz, Diez Miguel Ángel', 2014, 91, 'LIBRO', '1300-093', 5, 'Iamique – kalandraka', 'INFJU -A-1-2'),
(257, 'Sin los ojos', 'Valentino Esteban', 2014, 91, 'LIBRO', '1300-094', 5, 'S/M', 'INFJU -A-1-2'),
(258, 'LA niña del día y la noche (15 ejemplares)', 'Girona Ramón, Inaraja Christian', 2013, 91, 'LIBRO', '1300-095', 5, 'Magnolia - libro zorro rojo', 'INFJU -A-1-2'),
(259, '20.000 leguas de viaje submarino', 'Verne Julio, Bowen Carl adaptaciones', 2014, 91, 'LIBRO', '1300-096', 5, 'Cypress', 'INFJU -A-1-2'),
(260, 'Historia entre tumbas, angélica y sus hermanos t 3', 'Saracino Luciano, Mazali Gustavo', 2014, 91, 'LIBRO', '1300-097', 5, 'Riderchail ediciones', 'INFJU -A-1-2'),
(261, 'Historia entre tumbas La chica en el jardín t 4', 'Saracino Luciano, Mazali Gustavo', 2014, 91, 'LIBRO', '1300-098', 5, 'Riderchail ediciones', 'INFJU -A-1-2'),
(262, 'Cuando San Pedro viajo en tren (24 ejemplares)', 'Bodoc Liliana, Docampo Velaría', 2012, 91, 'LIBRO', '1300-099', 5, 'S/M', 'INFJU -A-1-2'),
(263, 'La Duenda', 'Rosero José Evelio Linares Jairo', 2013, 91, 'LIBRO', '1300-100', 5, 'Panamericana editorial', 'INFJU -A-1-2'),
(264, 'Un tren cargado de misterios', 'Paz Fernández Agustin', 2012, 91, 'LIBRO', '1300-101', 5, 'Aique', 'INFJU -A-1-2'),
(265, 'Cuento con Ogro y princesa', 'Mariño Ricardo, Cantón Laura', 2013, 91, 'LIBRO', '1300-102', 5, 'Colihue', 'INFJU -A-1-2'),
(267, 'Finn', 'Herman Leten Mats, Bartholin Hanne', 2013, 91, 'LIBRO', '1300-104', 5, 'Magnolia Ediciones', 'INFJU -A-1-2'),
(268, '¡Oh, los Colores!', 'Lujan Jorge, Piet Grobler', NULL, 91, 'LIBRO', '1300-105', 5, 'Comunicarte', 'INFJU -A-1-2'),
(269, 'Discurso del Oso', 'Cortázar Julio, Urberuaga Emilio', 2013, 91, 'LIBRO', '1300-106', 5, 'Alfaguara', 'INFJU -A-1-2'),
(270, 'Mis primeras aventuras Con Mama', 'Capdevilla Roser, le ray Anne-Laure', 2006, 91, 'LIBRO', '1300-107', 5, 'Jardín Feurnier', 'INFJU -A-1-2'),
(271, 'EL hombre sin cabeza y otros cuentos', 'Mariño Ricardo', 2014, 91, 'LIBRO', '1300-108', 5, 'Atlantida Editorial', 'INFJU -A-1-2'),
(272, 'Canción y pico', 'Deventach Laura, Rojas Saúl Oscar', 2007, 91, 'LIBRO', '1300-109', 5, 'Sudamericana', 'INFJU -A-1-2'),
(273, 'Historia a Fernández', 'Wolf Ema, Sanzol Jorge', 1999, 91, 'LIBRO', '1300-110', 5, 'Sudamericana', 'INFJU -A-1-2'),
(274, 'Gusa Gusi', 'Febres Sonia', 2007, 91, 'LIBRO', '1300-111', 5, 'Lumen', 'INFJU -A-1-2'),
(275, 'A Benito le gustan los barcos un cuanto para conocer a Benito Quinquela Martin', 'Sirkis, Silvia, Hadida Tomi', 2013, 91, 'LIBRO', '1300-112', 5, 'Arte a Babor', 'INFJU -A-1-2'),
(276, 'El maravilloso libro de los cuentos de hadas', 'Azarmendia Ángel, Irene Singer', 2013, 91, 'LIBRO', '1300-113', 5, 'Atlantida', 'INFJU -A-1-2'),
(277, 'Dudu, un buen demonio', 'Alcántara Ricardo, Aranega Merce', 1994, 91, 'LIBRO', '1300-114', 5, 'Edebe', 'INFJU -A-1-2'),
(278, 'Gran libro de los retratos de los Animales', 'Junakovic Svjetlan', 2013, 91, 'LIBRO', '1300-115', 5, 'Magnolia', 'INFJU -A-1-2'),
(279, 'Sherlock time', 'Breccia Alberto, Oesterheld Germán Hector', 2014, 91, 'LIBRO', '1300-116', 5, 'Colihue', 'INFJU -A-1-2'),
(280, 'El maravilloso libro de cuentos hechizos y encantamiento', 'Boeto ALDO, de la Cruz Paula', 2013, 91, 'LIBRO', '1300-117', 5, 'Atlantida', 'INFJU -A-1-2'),
(281, 'La princesa y el pirata', 'Cerda Gómez Alfredo - teo puebla', 2014, 91, 'LIBRO', '1300-118', 5, 'Fondo de cultura económica', 'INFJU -A-1-2'),
(282, 'Blanca nieves y otros cuantos maravillosos', 'Anónimo, Hayes Sarah compilador', 2013, 91, 'LIBRO', '1300-119', 5, 'Vicen Vives', 'INFJU -A-1-2'),
(283, 'Los misterios del Señor Burdick', 'Allsburg van Chris Smith Odette traducción', 2014, 91, 'LIBRO', '1300-120', 5, 'Fondo de cultura económica', 'INFJU -A-1-2'),
(284, 'Ali Baba y los 40 ladrones (cuentos clásicos)', 'Lopez Daniel Jorge adaptación', 2005, 91, 'LIBRO', '1300-121', 5, 'Del mar', 'INFJU -A-1-2'),
(285, 'Los cuentos de jardincito (selección de los mejores cuentos)', 'Cuentos para soñar', NULL, 91, 'LIBRO', '1300-122', 5, 'S/M', 'INFJU -A-1-2'),
(286, 'El Rey LEON', 'The Walt Disney Co', 2006, 91, 'LIBRO', '1300-123', 5, 'Sigmar editorial', 'INFJU -A-1-2'),
(288, 'Historia de un amor exagerado', 'Montes Graciela', 2009, 91, 'LIBRO', '1300-125', 5, 'Colihue', 'INFJU -A-1-2'),
(289, 'Acordes cotidianos', 'Benedetti Mario', 2013, 91, 'LIBRO', '1300-126', 5, 'V y R', 'INFJU -A-1-2'),
(290, 'Cenicienta ¿no es una mugrienta?', 'Ortiz Armelio, Pastor Osvaldo', 2014, 91, 'LIBRO', '1300-127', 5, 'Grupo unión', 'INFJU -A-1-2'),
(291, 'Poc ¡! Poc ¡Poc!', 'Roldan Gustavo', 2007, 91, 'LIBRO', '1300-128', 5, 'Del Eclipse', 'INFJU -A-1-2'),
(292, 'Owoko (pepi da la vuelta al mundo)', 'Pereyra Mariana, Gutman Paula', 2004, 91, 'LIBRO', '1300-129', 5, 'Sonia Esplugas', 'INFJU -A-1-2'),
(293, 'Historias Mágicas de Oriente', 'Yusefi Reza Mohammad, Rahmandoust Mostafa', 2014, 91, 'LIBRO', '1300-130', 5, 'Libros del Zorro rojo', 'INFJU -A-1-2'),
(294, 'La Cabeza en la bolsa', 'Pourchet Marjorie, Segovia Francisco', 2014, 91, 'LIBRO', '1300-131', 5, 'Fondo de cultura económica', 'INFJU -A-1-2'),
(295, 'Rutinero', 'Madrigal Níger, Wernicke, María', 2014, 91, 'LIBRO', '1300-132', 5, 'Fondo de cultura económica', 'INFJU -A-1-2'),
(296, 'El Brujo el horrible y los libros rojos de los hechizos', 'Bernasconi Pablo', 2014, 91, 'LIBRO', '1300-133', 5, 'Sudamericana', 'INFJU -A-1-2'),
(297, 'Por que vivimos en la afuera de la cuidad', 'Stamm Peter, Bauer Jutta', 2014, 91, 'LIBRO', '1300-134', 5, 'Tanden Ediciones', 'INFJU -A-1-2'),
(298, 'A Vincent le gustan los colores (un cuento para conocer a Vicent van Gogh)', 'Sirkis Silvia, Hadida Tomi, Davenport Walter', 2013, 91, 'LIBRO', '1300-135', 5, 'Arte a Babor', 'INFJU -A-1-2'),
(299, 'La Balada del Balisco', 'Pez Alberto, Cubillas Roberto', 2008, 91, 'LIBRO', '1300-136', 5, 'Del eclipse', 'INFJU -A-1-2'),
(300, 'El país de las Brujas', 'Banegas Cristina, Nigro MIGUEL', 2014, 91, 'LIBRO', '1300-137', 5, 'Alfaguara', 'INFJU -A-1-2'),
(301, 'El valiente y la bella (cuentos de amor y aventura)', 'Shua Ana María, Stok Ana Luisa', 2004, 91, 'LIBRO', '1300-138', 5, 'Alfaguara', 'INFJU -A-1-2'),
(302, 'Del tamaño justo y Raúl de la herrumbre azul', 'Machado Ana María, Merlino Mario, Labato Arcadio', 1997, 91, 'LIBRO', '1300-139', 5, 'Alfaguara', 'INFJU -A-1-2'),
(303, 'Cuentos espantos y aparecidos', NULL, 2005, 91, 'LIBRO', '1300-140', 5, 'Aique', 'INFJU -A-1-2'),
(304, 'Cuentos con chicos', 'Yunque Álvaro', 2003, 91, 'LIBRO', '1300-141', 5, 'Santillana', 'INFJU -A-1-2'),
(306, 'Secretos en un dedal', 'Devetch Laura, Leibiker Laura', 2010, 91, 'LIBRO', '1300-143', 5, 'S / M', 'INFJU -A-1-2'),
(307, 'Cuentos de Piratas, Corsarios y Bandidos', NULL, 2005, 91, 'LIBRO', '1300-144', 5, 'Aique', 'INFJU -A-1-2'),
(308, 'Un Ratón Comilón', 'Genechten van Guido, Rodrigué Mercedes', 2008, 91, 'LIBRO', '1300-145', 5, 'La Brujita de papel', 'INFJU -A-1-2'),
(309, 'MATEO Y su gato rojo', 'Rocha Silvina, Prieto Lucia Mancilla', 2013, 91, 'LIBRO', '1300-146', 5, 'Naranjo Ediciones', 'INFJU -A-1-2'),
(310, 'Los animales no deben Actuar como la gente', 'Barret Judi, Barret ROM', 2013, 91, 'LIBRO', '1300-147', 5, 'De la flor', 'INFJU -A-1-2'),
(311, 'Perro de Cristal', 'Baum Frank L. versión en castellano Livan Paco', 2014, 91, 'LIBRO', '1300-148', 5, 'Magnolia Ediciones', 'INFJU -A-1-2'),
(312, 'Soy el robot', 'Fernández Bernardo, Betteo Patricio', 2014, 91, 'LIBRO', '1300-149', 5, 'Magnolia Ediciones', 'INFJU -A-1-2'),
(313, 'Cuentos Infantiles', NULL, NULL, 91, 'LIBRO', '1300-150', 5, 'S/M', 'INFJU -A-1-2'),
(314, 'El Sombrero', 'Jan Brett', 1999, 91, 'LIBRO', '1300-151', 5, 'Norma', 'INFJU -A-1-2'),
(315, 'Federico dice no', 'Montes Graciela', 2007, 91, 'LIBRO', '1300-152', 5, 'Canela', 'INFJU -A-1-2'),
(316, 'Que historia con la baca 3', 'Erbiti Alejandra, Ambrosio Alejandra', 2009, 91, 'LIBRO', '1300-153', 5, 'Puerto palos', 'INFJU -A-1-2'),
(317, 'Cuentos por teléfono', 'Rodari Gianni', 2000, 91, 'LIBRO', '1300-154', 5, 'Juventud editorial', 'INFJU -A-1-2'),
(318, 'Aventuras de DON Quijote', 'Cervantes Saavedra Miguel, Adaptado Gudiño Cristina', 2014, 91, 'LIBRO', '1300-155', 5, 'Ministerio de educación de la nación', 'INFJU -A-1-2'),
(319, 'Historias de los Señores Moc Y Poc', 'Pescetti Luis Maria', 2005, 91, 'LIBRO', '1300-156', 5, 'Alfaguara', 'INFJU -A-1-2'),
(320, 'Pobre Mariposa', 'Devetach Laura', NULL, 91, 'LIBRO', '1300-157', 5, 'Cronopio Azul Ediciones', 'INFJU -A-1-2'),
(321, 'Frin', 'Pescetti Luis Maria', 2005, 91, 'LIBRO', '1300-158', 5, 'Alfaguara', 'INFJU -A-1-2'),
(322, 'Mis Grandes Cuentos Clásicos', 'Toons Arghoost', 2009, 91, 'LIBRO', '1300-159', 5, 'Beeme Editorial', 'INFJU -A-1-2'),
(323, 'Leyendas', 'Brizuela Ivana Bettina, Maggio Maria Eugenia', 2007, 91, 'LIBRO', '1300-160', 5, 'El viñatero impresora', 'INFJU -A-1-2'),
(324, 'Mi pequeña enciclopedia Larousse (delfines y ballenas)', 'Larousse', 2005, 91, 'LIBRO', '1300-161', 5, 'Larousse', 'INFJU -A-1-2'),
(325, 'Mi grandes cuentos clásicos (serie roja)', 'Toons Arghoost', 2009, 91, 'LIBRO', '1300-162', 5, 'Beeme editorial', 'INFJU -A-1-2'),
(326, 'La vaca Ventilador y (otros poemas para volar)', 'Repun Graciela, Melatoni Enrique', 2008, 91, 'LIBRO', '1300-163', 5, 'Atlantida', 'INFJU -A-1-2'),
(328, 'Aventura Matemática', 'Díaz Adriana (coordinador), Rosseti Alenadro, Tasca Fabiana', NULL, 3, 'LIBROS', '200-002', 5, 'Aique', 'MAT-A-2-1'),
(329, 'Estudiar Matemática 4', 'Briotman Claudia, Kuperman Cintia', 2006, 3, 'LIBROS', '200-003', 5, 'Santillana', 'MAT-A-2-1'),
(330, 'Matemática 4', 'Agrasar Mónica, Chara Silvia', 2004, 3, 'LIBROS', '200-004', 5, 'Longseller', 'MAT-A-2-1'),
(331, 'Estudiar Matemática 2', 'Briotman Claudia', 2009, 3, 'LIBROS', '200-005', 5, 'Santillana', 'MAT-A-2-1'),
(333, 'Los libros 4 Matemática', 'Chemello Graciela, Agrasar Mónica', 2005, 3, 'LIBROS', '200-007', 5, 'Longseller', 'MAT-A-2-1'),
(334, 'Aventura Matemática 5', 'Díaz Adriana (coordinadora), Rosseti Alejandro', NULL, 3, 'LIBROS', '200-008', 5, 'Aique', 'MAT-A-2-1'),
(335, 'Matemática 4 (aprender a estudiar) ciencia en foco', 'Barallobres Gustavo, Chara Silvia colaboradora', 2006, 3, 'LIBROS', '200-009', 5, 'Aique', 'MAT-A-2-1'),
(336, 'Estudiar Matemática en 2', 'Briotman Claudia, Kuperman Mónica', 2009, 3, 'LIBROS', '200-010', 5, 'Santillana', 'MAT-A-2-1'),
(338, 'Matemática 6 (para armar)', 'Chelle María teresita', 2022, 3, 'LIBROS', '200-012', 5, 'Puerto de palos', 'MAT-A-2-1'),
(339, 'Matemática en quinto', 'Briotman Claudia, Escobar Mónica', 2010, 3, 'LIBROS', '200-013', 5, 'Santillana', 'MAT-A-2-1'),
(340, 'Hacer matemática 5', 'Saiz Irma, Parra Cecilia', 2015, 3, 'LIBROS', '200-014', 5, 'Estrada', 'MAT-A-2-1'),
(341, 'Dinámica matemática 5', 'Carrasco Dora, Cedrón Mara, Di MARCO Daniela V', 2008, 3, 'LIBROS', '200-015', 5, 'Puerto de palos', 'MAT-A-2-1'),
(343, 'Pensar con Matemático (problemas y conceptos de la matemática de todos los días)', 'Berge Analia, Dickentein Alicia, Graña Matías', 1999, 3, 'LIBROS', '200-017', 5, 'Estrada', 'MAT-A-2-1'),
(344, 'Matemática 7 (carpeta de actividades)', 'Trama Eduardo, Laurito Liliana, Aragón Mariana', 2003, 3, 'LIBROS', '200-018', 5, 'Estrada (entender)', 'MAT-A-2-1'),
(345, 'Matemática 5 (ciencia en foco) proyecto aprender estudiar', 'Barallobres Gustavo, Clara Silvia', 2006, 3, 'LIBROS', '200-019', 5, 'Aique', 'MAT-A-2-1'),
(346, 'Matemática para armar de 5', 'Cheille María Teresita, Varettoni Marcos', 2022, 3, 'LIBROS', '200-020', 5, 'Puerto de palos', 'MAT-A-2-1'),
(347, 'Matemática 6 (dinámica)', 'Berio Adriana, Cuzzani Karina, Graciani Alicia', 2006, 3, 'LIBROS', '200-021', 5, 'Puerto de palos', 'MAT-A-2-1'),
(348, 'Matemática 6', 'Kapaln Darío, Chara Silvia', 2007, 3, 'LIBROS', '200-022', 5, 'Aique', 'MAT-A-2-1'),
(350, 'Los libros 6 matemática', 'Agrasar Mónica, Altman Silvia', 2004, 3, 'LIBROS', '200-024', 5, 'Longseller', 'MAT-A-2-1'),
(351, 'Matemática 4 egb (serie sol)', 'Etchegoyen Susana Noemí, Fagale Enrique David', 1997, 3, 'LIBROS', '200-025', 5, 'Kapelusz', 'MAT-A-2-1'),
(352, 'Matemática 1 egb', 'Etchegoyen Susana Noemí, Alonso María Rosario', NULL, 3, 'LIBROS', '200-026', 5, 'Kapelusz', 'MAT-A-2-1'),
(353, 'Estudiar matemática en 5', 'Briotman Claudia, Kuperman Cinthia', 2006, 3, 'LIBROS', '200-027', 5, 'Santillana', 'MAT-A-2-1'),
(363, 'Matemática de egb 3 al polimodal', 'Berte Annie', 1999, 3, 'LIBROS', '200-037', 5, 'A-z', 'MAT-A-2-1'),
(365, 'Matemática 5 (proyecto de programación entorno digital)', 'Carrasco Dora, Jousse Gabriela', 2022, 3, 'LIBROS', '200-039', 5, 'Aique', 'MAT-A-2-1'),
(366, 'Matemática 6 (proyecto de programación entorno digital)', 'Carrasco Dora', 2022, 3, 'LIBROS', '200-040', 5, 'Aique', 'MAT-A-2-1'),
(368, 'Matematica 3 es confluencia', 'Abdala Carlos, Chorny Fernando', 2015, 3, 'LIBROS', '200-042', 5, 'Estrada', 'MAT-A-2-1'),
(372, 'Hacer matematica 2', 'Parra Irma, Saiz Irma', NULL, 3, 'LIBROS', '200-046', 5, 'Estrada', 'MAT-A-2-1'),
(373, 'Matematica para armar 3', 'Chelle María Teresita, Varettoni Marcos, Zacaniño Liliana', 2022, 3, 'LIBROS', '200-047', 5, 'Puerto de palos', 'MAT-A-2-1'),
(374, 'Matematica para armar 2', 'Chelle María teresita, Varettoni Marcos', 2022, 3, 'LIBROS', '200-048', 5, 'Puerto de palos', 'MAT-A-2-1'),
(375, 'Estrada a DUO 4 Matematica', 'Quaranta María Emilia, Varettoni Marcos', 2022, 3, 'LIBROS', '200-049', 5, 'Estrada', 'MAT-A-2-1'),
(376, 'Matematica para armar 4', 'Chelle, María Teresita, Pontini Mariela', 2022, 3, 'LIBROS', '200-050', 5, 'Puerto de palos', 'MAT-A-2-1'),
(377, 'Hacer matematica juntos 2', 'Parra Cecilia, Saiz Irma', 2022, 3, 'LIBROS', '200-051', 5, 'Estrada', 'MAT-A-2-1'),
(378, 'Estrada a Dúo 6 matematica', 'Quaranta María Emilia, Varettoni Marcos', 2022, 3, 'LIBROS', '200-052', 5, 'Estrada', 'MAT-A-2-1'),
(379, 'Activa XXI en órbita matematica 5', 'Chiapetta Cecilia', 2022, 3, 'LIBROS', '200-053', 5, 'Puerto de palos', 'MAT-A-2-1'),
(381, 'Matematica 1', 'Etchegoyen Susana, Guardia Guic Laura', 2022, 3, 'LIBROS', '200-055', 5, 'A-Z', 'MAT-A-2-1'),
(383, 'Matematica 4 egb', 'Ounton Verónica, Pustilnik Isabel', 2004, 3, 'LIBROS', '200-057', 5, 'Santillana', 'MAT-A-2-1'),
(385, 'Matematica 8 Estadística y Probabilidad', 'Aristegui Rosana A., Graciani Alicia', 2005, 3, 'LIBROS', '200-059', 5, 'Puerto de palos', 'MAT-A-2-1'),
(386, 'Matematica 7 egb', 'Andrés Marina, La Montagna Magdalena', 2004, 3, 'LIBROS', '200-060', 5, 'Santillana', 'MAT-A-2-1'),
(387, 'Pitágoras 8 matemáticas', 'Salpeter Claudio', 2005, 3, 'LIBROS', '200-061', 5, 'S/M', 'MAT-A-2-1'),
(388, 'Matematica 7 E.G.B. y primaria', 'Rodríguez Margarita, Martínez Miguel', 1998, 3, 'LIBROS', '200-062', 5, 'McGraw-Hill', 'MAT-A-2-1'),
(389, 'Así aprendemos Matematica 4', 'Múgica Elsa Bergada, Musante Maria del pilar', NULL, 3, 'LIBROS', '200-063', 5, 'Edicial', 'MAT-A-2-1'),
(391, 'El libro de la matematica 7', 'Felissia Ana Maria', 2011, 3, 'LIBROS', '200-065', 5, 'Estrada', 'MAT-A-2-1'),
(393, 'Matematica 4 logonautas', 'Amerio Maria Victoria', 2008, 3, 'LIBROS', '200-067', 5, 'Puerto e palos', 'MAT-A-2-1'),
(394, 'Explorar en matematica 5', 'Escobar Mónica, Briotman Claudia, Itzcovich Horacio', 2014, 3, 'LIBROS', '200-068', 5, 'Santillana', 'MAT-A-2-1'),
(395, 'Matematica 8 (todos protagonistas)', 'Ferrero Ana Maria, Piñeiro Gustavo', 2005, 3, 'LIBROS', '200-069', 5, 'Santillana', 'MAT-A-2-1'),
(397, 'Matematica 5 egb', 'Andrés Marina, La Montagna Magdalena', 2004, 3, 'LIBROS', '200-071', 5, 'Santillana', 'MAT-A-2-1'),
(398, 'Hacer matematica 6', 'Saiz Irma, Parra Cecilia', 2015, 3, 'LIBROS', '200-072', 5, 'Estrada', 'MAT-A-2-1'),
(400, 'Matematica 8', 'Itzcovich Horacio, Novembre Andrea', 2006, 3, 'LIBROS', '200-074', 5, 'Tinta fresca', 'MAT-A-2-1'),
(401, 'Matematica II', 'Berman Andrea, Dacuti Daniel', 2007, 3, 'LIBROS', '200-075', 5, 'Santillana', 'MAT-A-2-1'),
(402, 'Hacer Matematica 4', 'Saiz Irma, Parra Cecilia', 2015, 3, 'LIBROS', '200-076', 5, 'Estrada', 'MAT-A-2-1'),
(403, 'Matemáticas Resolución de problemas', 'Ministerio de Educacion ciencia y tecnología', 2007, 3, 'LIBROS', '200-077', 5, 'Ministerio de educación ciencia y tecnología', 'MAT-A-2-1'),
(405, 'Matematica 7 anexo teórico', 'M. Agrasar, A. Crippa, G. Chamello', 2011, 3, 'LIBROS', '200-079', 5, 'Longseller', 'MAT-A-2-1'),
(406, 'Matematica I', 'Andrés Marina, Piñero Gustavo, Serpa Bruno', 2007, 3, 'LIBROS', '200-080', 5, 'Santillana', 'MAT-A-2-1'),
(407, 'Carpeta de actividades matematica 6', NULL, NULL, 3, 'LIBROS', '200-081', 5, 'Aique', 'MAT-A-2-1'),
(408, 'Matematica 5', NULL, 2005, 3, 'LIBROS', '200-082', 5, 'e.d.b.', 'MAT-A-2-1'),
(409, 'Matematica III', 'Pastran Daiana', 2015, 3, 'LIBROS', '200-083', 5, NULL, 'MAT-A-2-1'),
(410, 'Matematica 3 grafos', 'Andino, Analia, Ruarte Sebastián', 2015, 3, 'LIBROS', '200-084', 5, 'Trabajo de escuela', 'MAT-A-2-1'),
(415, 'Didactica de matemáticas Aportes y reflexiones', 'Parra Cecila, Saiz Irma', 2010, 3, 'LIBROS', '200-089', 5, 'Paidos', 'MAT-A-2-1'),
(416, 'Matematica divertida y curiosa', 'Tahan Malba, Caballero Marcelo', 2008, 3, 'LIBROS', '200-090', 5, 'Pluma y papel', 'MAT-A-2-1'),
(419, '100 Manía los números de 0 al 100', 'Johnson Sally, Carrillo SARA Inés Gómez', 2009, 3, 'LIBROS', '200-093', 5, 'Kel', 'MAT-A-2-1'),
(420, '456 manía los números los números 1 al 30', 'Johnson Sally, Carrillo Gómez Sara Inés', 2010, 3, 'LIBROS', '200-094', 5, 'Kel', 'MAT-A-2-1'),
(423, 'La pasantía una alternativa de acompañamiento a profesores de Matematica', 'Grande Carlos', 2012, 3, 'LIBROS', '200-097', 5, 'Ministerio de educación de la Nación', 'MAT-A-2-1'),
(425, 'Matematica menta y limón', 'Etchegoyen Susana, Alonso Maria Rosario', 1998, 3, 'LIBROS', '200-099', 5, 'Kapelusz', 'MAT-A-2-1'),
(426, 'Aprender en tercero 3 matematica ciencias sociales, ciencias naturales', 'Benchimol Karina, Heredia Gabriela (Et. al.)', 2009, 3, 'LIBROS', '200-100', 5, 'Tinta fresca', 'MAT-A-2-1'),
(428, 'Matematica dinámica Temas y problemas egb', 'Berté Annie', 1999, 3, 'LIBROS', '200-102', 5, 'A-Z', 'MAT-A-2-1'),
(430, 'Enseñar y aprender Matematica Propuestas para el Segundo ciclo', 'Ponce Hector', 2004, 3, 'LIBROS', '200-104', 5, 'Novedades educativas', 'MAT-A-2-1'),
(431, 'Mate Max La Matematica en toda partes', 'Dickenstein Alicia', 2000, 3, 'LIBROS', '200-105', 5, 'Novedades educativas', 'MAT-A-2-1'),
(433, 'Apuntes de análisis matemático', 'Prof. Iturrioz Luisa', 1973, 3, 'LIBROS', '200-107', 5, 'Othaz Editor', 'MAT-A-2-1'),
(435, 'Sound Foundations The Teacher Development Series Living Phonology', 'Adrian Underhill', 1994, 89, 'LIBROS', '1100-001', 5, 'Macmillan Heinemann English Language Teaching / MacMillan Heinemann', 'LENEXT B-1-4'),
(436, 'A Students grammar Of the English Language', 'Greembaum Sídney, Randolph Quirk', 1998, 89, 'LIBROS', '1100-002', 5, 'Longman', 'LENEXT B-1-4'),
(437, 'Second Language Teaching y Learning', 'Nunan David', NULL, 89, 'LIBROS', '1100-003', 5, 'Heinle y HEIMLF', 'LENEXT B-1-4'),
(438, 'How to Teach English An introduction to the practice of English Language teaching', 'Harmer Jeremy', 1998, 89, 'LIBROS', '1100-004', 5, 'Longman', 'LENEXT B-1-4'),
(439, 'The Learner-Centred Curriculum', 'Nunan David', 2000, 89, 'LIBROS', '1100-005', 5, 'Cambridge University Press', 'LENEXT B-1-4'),
(551, 'Didácticas de las artes plásticas en el nivel inicial', 'Palopoli María del Carmen, Palopoli Cristina Laura', 2009, 90, 'LIBROS', '1200-002', 5, 'Bonum', 'EDUART B-2-1'),
(555, 'Para Aprender los secretos de los genios de la pintura. Arte escuela.', NULL, NULL, 90, 'LIBROS', '1200-006', 5, 'Guadal editorial', 'EDUART B-2-1'),
(556, 'La música de los inicios', 'Alvares Clarisa, Baraybar Alejandra', 2011, 90, 'LIBROS', '1200-007', 5, 'Ministerio educación de Nación', 'EDUART B-2-1'),
(557, 'Teatro por la identidad', 'Valencia Anabela', 2005, 90, 'LIBROS', '1200-008', 5, 'Teatro x identidad', 'EDUART B-2-1'),
(561, 'Arte, educción y diversidad cultural', 'Chalmers F. Graeme', 2003, 90, 'LIBROS', '1200-012', 5, 'Paidos', 'EDUART B-2-1'),
(562, 'Arte en la Escuela Una propuesta de trabajo para promover una mejor convivencia en la Escuela', 'Susana Flores, Gabriela Tarantino, Sandra Jiménez', 2001, 90, 'LIBROS', '1200-013', 5, 'Unidad de recursos Didácticos Subsecretaria de educación Básica', 'EDUART B-2-1'),
(570, 'Renovación del acuerdo Normativo sobre convivencia escolar', 'Ministerio de Educacion', 2005, 90, 'LIBROS', '1200-021', 5, 'Ministerio de Educacion', 'EDUART B-2-1'),
(572, 'Escuelas que Curan la construcción de climas emocionales saludables', 'Koplow Lesley', 2005, 90, 'LIBROS', '1200-023', 5, 'Troquel', 'EDUART B-2-1'),
(574, 'Curso de formación para profesores de Ciencias', 'Almenteros Banasco Josefa, Gil Pérez Daniel (revisación científica); Sentí Campuzano Natalia R., Daniel Gil Pérez (revisión científica); Carrillo ANA Teresa, Pérez GIL Daniel (revisación científica); Pérez Gil Daniel, Más Furio Carlos, Ali Carrascoso Jaim', 1996, 1, 'libros', '010-001', 5, 'Ministerio de educación y cultura de España. (pro-ciencia) / conicet', 'CIENAT A- 3-2'),
(575, 'Ciencia en segundos (Experimentar 10 minutos o menos)', 'Potter Jean', 2004, 1, 'libros', '010-002', 5, 'Albatros', 'CIENAT A- 3-2'),
(577, 'Como si fuera una película (hacer que les guste biología)', 'Westergaad, Gastón', 2011, 1, 'libros', '010-004', 5, 'Ministerio de Educacion de la Nación', 'CIENAT A- 3-2'),
(578, 'Ciencias Naturales Cuaderno de trabajo', 'Espinoza Ana, Kotin Alejandra', NULL, 1, 'libros', '010-005', 5, 'Proyecto de educación Gral. básica para escuelas rurales', 'CIENAT A- 3-2'),
(579, 'El desafío de enseñar Ciencias naturales', 'Fumagalli Laura, Aldade Sara, Lacreu Laura', 1993, 1, 'libros', '010-006', 5, 'Troquel editorial', 'CIENAT A- 3-2'),
(580, 'Ciencias Naturales nivel inicial y primer ciclo', 'Mancuso Maria Ángel', 2008, 1, 'libros', '010-007', 5, 'Lugar', 'CIENAT A- 3-2'),
(581, 'Ciencias Naturales', 'Adragna Elena', 2011, 1, 'libros', '010-008', 5, 'Estrada', 'CIENAT A- 3-2'),
(582, 'Organizador de estudio. ideas en juego Ciencias naturales 4', 'Trosi Rosario', 2010, 1, 'libros', '010-009', 5, 'Aique', 'CIENAT A- 3-2'),
(583, 'Ciencias ; ciencias sociales / ciencias naturales , tecnología un mundo en movimiento', 'Podetti Mariana, Sagol Cecilia, Fernández Silvia', 1996, 1, 'libros', '010-010', 5, 'Santillana', 'CIENAT A- 3-2'),
(586, 'Enseñar a leer textos de ciencias', 'Espinoza Ana, Casamayor Adriana, Pitton Egle', 2009, 1, 'libros', '010-013', 5, 'Paidos', 'CIENAT A- 3-2'),
(588, 'Didáctica de las Ciencias Naturales', 'Tricarico Hugo Roberto; Weissmann Hilda (Compiladora); Weissmann Hilda (coordinadora)', 2005, 1, 'libros', '010-015', 5, 'Bonum; Paidos', 'CIENAT A- 3-2'),
(589, 'Una introducción a la naturaleza de la ciencia : la epistemología en la enseñanza de la ciencias naturales', 'Aduriz – Bravo Agustin', 2005, 1, 'libros', '010-016', 5, 'Fondo de cultura Economica', 'CIENAT A- 3-2'),
(590, 'Experimentado con proteínas', 'Gamero Silvia, Medeiros Liliana', NULL, 1, 'libros', '010-017', 5, 'Lumen Editorial', 'CIENAT A- 3-2'),
(593, 'El milagro del nacimiento', 'Bryan Jenny, DR. Carlos Illya Levin (supervisación médica), Tálamo Edith', NULL, 1, 'libros', '010-020', 5, 'Sigmar', 'CIENAT A- 3-2'),
(594, 'Curso de formación para profesores de Ciencias (el mundo vegetal). unidad 3', 'Sentí Campuzano Natalia R., Daniel Gil Pérez (Revisión científica)', 1996, 1, 'libros', '010-021', 5, 'Ministerio de Educación y cultura de España. (Pro-ciencia) Conicet', 'CIENAT A- 3-2'),
(595, 'Curso de Formación Para profesores de Ciencias (De la célula a los Organismos )unidad 3.2', 'Torouncha Zilberstein José, Martin Viaña Cuervo Virginia, Gil Perez Daniel', 1996, 1, 'libros', '010-022', 5, 'Ministerio de Educación y Cultura de España / Pro ciencia. Conicet', 'CIENAT A- 3-2'),
(596, 'Curso de Formación Para profesores de Ciencias (Necesidad de ordenar la diversidad) unidad 3.3', 'González Bretro Renato, Martin – Viaña Cuervo, Gil Pérez Daniel (Revisación Científica)', 1996, 1, 'libros', '010-023', 5, 'Ministerio y Educacion de cultura de España Pro-ciencia Conicet', 'CIENAT A- 3-2'),
(597, 'Curso de formación de profesores de ciencias (la biosfera :el ecosistema mayor ) unidad 2.3', 'Aranguren Jesús, Briseño Francisco, Gil Pérez Daniel (Revisación técnica)', 1996, 1, 'libros', '010-024', 5, 'Ministerio y Educacion y Cultura de España Pro- ciencia Conicet', 'CIENAT A- 3-2'),
(598, 'Curso de formación para Profesores de ciencias (Diversidad y unidad de los seres vivos)', 'Martin – Viaña Cuervo Virginia, Gil Pérez Daniel (Revisación científica)', 1996, 1, 'libros', '010-025', 5, 'Ministerio de educación y cultura de España Pro-ciencia Conicet', 'CIENAT A- 3-2'),
(599, '¿Plantas sin Tierra?', 'Lacolla Liliana', 1996, 1, 'libros', '010-026', 5, 'Lumen', 'CIENAT A- 3-2'),
(600, 'Los Alimentos', 'Weissmann Hilda, Casavola Horacio', 1985, 1, 'libros', '010-027', 5, 'Colihue', 'CIENAT A- 3-2'),
(601, 'Atlas del cuerpo humano', 'Mark Crocker', 1992, 1, 'libros', '010-028', 5, 'Sigmar Editorial', 'CIENAT A- 3-2'),
(602, 'Biología Anatomía y fisiología humanas genética .evolución', 'Aduriz Agustin', 2006, 1, 'libros', '010-029', 5, 'Santillana', 'CIENAT A- 3-2'),
(603, 'Biología 2', 'Zarur Pedro', NULL, 1, 'libros', '010-030', 5, 'Plus ultra', 'CIENAT A- 3-2'),
(604, 'Biología activa', 'Bombora Norma, Carreras Norma, Cittadino Emilio', 2001, 1, 'libros', '010-031', 5, 'Puerto palos', 'CIENAT A- 3-2'),
(605, 'Biología vol. 1. La célula unidad de los seres vivos', 'Suarez Hilda, Espinosa Ana Maria (coordinadora)', 2002, 1, 'libros', '010-032', 5, 'Longseller', 'CIENAT A- 3-2'),
(606, 'Biología vol. 4. La vida continuidad y cambio', 'Frid Débora, Muzzanti Silvina, Espinosa Ana', 2008, 1, 'libros', '010-033', 5, 'Longseller', 'CIENAT A- 3-2'),
(607, 'Biología polimodal', 'Amestoy Elena Marcela', 2002, 1, 'libros', '010-034', 5, 'Stella', 'CIENAT A- 3-2'),
(608, 'Biología: la teoría de la evolución en la escuela', 'Gutiérrez Antonio', 2009, 1, 'libros', '010-035', 5, 'Biblos', 'CIENAT A- 3-2'),
(609, 'Ciencias Biológicas', 'Rosnati Gladys Claire', 1980, 1, 'libros', '010-036', 5, 'Sainte', 'CIENAT A- 3-2'),
(610, 'Revista educación en Biología', 'Asociación de docentes ciencias biológicas', 2002, 1, 'libros', '010-037', 5, 'Adbia', 'CIENAT A- 3-2'),
(611, 'Biología II', 'Saullo Silvia, Manjon Julio', 1988, 1, 'libros', '010-038', 5, 'Cesarini hnos.', 'CIENAT A- 3-2'),
(612, 'Biología las relaciones de los seres vivos entre si y su ambiente', 'Barderi Maria Gabriela, Carminati Alejandra, Fernández Carlos', 2003, 1, 'libros', '010-039', 5, 'Santillana hoy', 'CIENAT A- 3-2'),
(613, 'El origen de las especies', 'DARWIN CHARLES, Acero Rodríguez Margarita', 2000, 1, 'libros', '010-040', 5, 'Longseller', 'CIENAT A- 3-2'),
(614, 'Las casas de los animales', 'Taylor Barbara', 1998, 1, 'libros', '010-041', 5, 'Puerto de palos', 'CIENAT A- 3-2'),
(615, 'Anfibios', 'Balboa Carlos Fernández', 1997, 1, 'libros', '010-042', 5, 'Albatros', 'CIENAT A- 3-2'),
(616, 'Águilas', 'Balboa Fernández Carlos', 1996, 1, 'libros', '010-043', 5, 'Albatros', 'CIENAT A- 3-2'),
(617, 'Monos', 'Bertonatti Claudio', 1994, 1, 'libros', '010-044', 5, 'Albatros', 'CIENAT A- 3-2'),
(618, 'Murciélagos', 'Bertonatti Claudio', 1996, 1, 'libros', '010-045', 5, 'Albatros', 'CIENAT A- 3-2'),
(619, 'Yaguar', 'Balboa Carlos Fernández', 1997, 1, 'libros', '010-046', 5, 'Albatros', 'CIENAT A- 3-2'),
(620, 'Aventuras con la ciencia Animales prehistóricos', 'Palma Miguel', 1997, 1, 'libros', '010-047', 5, 'Albatros', 'CIENAT A- 3-2'),
(623, 'La vida el universo', 'Aljannati David', 2000, 1, 'libros', '010-050', 5, 'Colihue ediciones', 'CIENAT A- 3-2'),
(624, '¿Cuántos huesos tenemos?', 'Langley Andrew, Acuña de Delia M.G.', 1997, 1, 'libros', '010-051', 5, 'Sigmar editorial', 'CIENAT A- 3-2'),
(625, 'Tecnología nivel inicial ( cuadernillo de aprestamiento )', 'Bonardi Cristina, Drudi Susana', 2009, 1, 'libros', '010-052', 5, 'Sima Editora', 'CIENAT A- 3-2'),
(626, 'Iniciación Tecnología Nivel inicial 1 y 2 ciclo Egb', 'Ullirich Heinz, Klante Dieter', 2004, 1, 'libros', '010-053', 5, 'Colihue', 'CIENAT A- 3-2'),
(627, 'Tecnología 1 e.g.b.1', 'Bonardi Cristina, Drudi Susana, Córdoba Miguel Patricia', 2009, 1, 'libros', '010-054', 5, 'Copiar', 'CIENAT A- 3-2'),
(628, 'Tecnología 4 e.g,b 2', 'Bonardi Cristina, Drudi Susana, Miguel patricia', 2007, 1, 'libros', '010-055', 5, 'Copiar Editorial', 'CIENAT A- 3-2'),
(629, 'Tecnología 5 e.g,b. 2', 'Bonardi Cristina, Drudi Susana, Miguel Patricia', 2009, 1, 'libros', '010-056', 5, 'Copiar Editorial', 'CIENAT A- 3-2'),
(630, 'Tecnología 6 egb 2', 'Bonardi Cristina, Drudi Susana, Miguel Patricia', 2009, 1, 'libros', '010-057', 5, 'Sima Editorial', 'CIENAT A- 3-2'),
(631, 'Tecnología 1', 'Yammal Chibli', 2009, 1, 'libros', '010-058', 5, 'Chibli Yammal Ediciones', 'CIENAT A- 3-2'),
(633, 'Tecnología 3', 'Chibli Yammal', 2008, 1, 'libros', '010-060', 5, 'Chibli Yammal', 'CIENAT A- 3-2'),
(634, 'Atlas básico de tecnología', 'Borras Luis', 2008, 1, 'libros', '010-061', 5, 'Parramón Editorial', 'CIENAT A- 3-2'),
(637, 'Informática infantil 1 Diccionario', 'Tiznado Marco Antonio', 1999, 1, 'libros', '010-064', 5, 'Mc Grawhil', 'CIENAT A- 3-2'),
(638, 'Conocer los Materiales ideas y actividades para, el estudio de la fisica , Química y tecnología en la Educacion Secundaria', 'Molina Llorens Juan A.', 1996, 1, 'libros', '010-065', 5, 'De la Torre', 'CIENAT A- 3-2'),
(639, 'Introducción a la tecnología', 'Serafini Gabriel', 1998, 1, 'libros', '010-066', 5, 'Plus ultra', 'CIENAT A- 3-2'),
(641, 'La magia de la Comunicación Del telégrafo al teléfono', 'Clocchiatti Ángel', 1995, 1, 'libros', '010-068', 5, 'LUMEN', 'CIENAT A- 3-2'),
(643, 'Laser', 'Bilmes Gabriel M.', 1997, 1, 'libros', '010-070', 5, 'Ediciones Colihue', 'CIENAT A- 3-2'),
(649, 'Curso de formación para profesores de ciencias (la atmosfera y el aire ) unidad 2', 'Parisi Assenza Graciela, Lacreu Hector, Rela Agustín, Pérez Gil Daniel (revisación científica)', 1997, 1, 'libros', '010-076', 5, 'Ministerio Educacion y cultura de España Pro ciencia Conicet', 'CIENAT A- 3-2'),
(650, 'Curso de formación para Profesores de ciencias (Los materiales en la vida cotidiana: sus propiedades y usos.) Unidad 4.2', 'Gomero Silvia, Pérez gil Daniel (Revisación científica)', 1997, 1, 'libros', '010-077', 5, 'Ministerio de Educación y Cultura DE España Pro ciencia Conicet', 'CIENAT A- 3-2'),
(651, 'Curso de formación para Profesores de ciencias (Fuentes de energía: problemas asociados a su obtención y uso´) unidad 1.5', 'Gil Pérez Daniel, Mas Furio Carlos, Carrascosa Alis JAIME', 1996, 1, 'libros', '010-078', 5, 'Ministerio de Educacion y cultura de España Pro- ciencia Conicet', 'CIENAT A- 3-2'),
(652, 'La litosfera, Rocas y minerales, suelos). Unidad 5.4', 'Parisi Assenza Graciela, Lacrea Hector, Rela Agustín, Pérez gil Daniel (Revisación científica)', 1997, 1, 'libros', '010-079', 5, 'Ministerio de Educacion y cultura de España Pro-ciencia conciet', 'CIENAT A- 3-2'),
(653, 'Un Charco Contaminado', 'Tabare, por Sanyu (adaptado)', 2013, 1, 'libros', '010-080', 5, 'Colihue', 'CIENAT A- 3-2'),
(654, 'La tierra una increíble maquina de reciclar', 'Bennett Paul, Colella Marta Elida', 1995, 1, 'libros', '010-081', 5, 'Sigmar Editorial', 'CIENAT A- 3-2'),
(668, '¡Queremos respirar aire puro!', 'Camacho Sandra', 1995, 1, 'libros', '010-095', 5, 'Lumen editorial', 'CIENAT A- 3-2'),
(669, '¿Por qué sopla el viento?', 'Langley Andrew, Acuña de Delia M. G.', 1997, 1, 'libros', '010-096', 5, 'Sigmar editorial', 'CIENAT A- 3-2'),
(670, 'Bosques en extinción', 'Leggett Jeremy, Talamo Edith', NULL, 1, 'libros', '010-097', 5, 'Sigmar editorial', 'CIENAT A- 3-2'),
(671, 'El asesino invisible', 'Beltrán Faustino', 1997, 1, 'libros', '010-098', 5, 'Lumen editorial', 'CIENAT A- 3-2'),
(674, 'Nada se tira todo se recicla ( sobre la basura y su futuro)', 'Medeiros Liliana, Gamero Silvia', NULL, 1, 'libros', '010-101', 5, 'Lumen', 'CIENAT A- 3-2'),
(675, 'Las Maravillas del agua', 'Barnes Bonita Barnes, Smithson Colin, traducido Roja Martha B, Larese', 1993, 1, 'libros', '010-102', 5, 'Lumen', 'CIENAT A- 3-2'),
(676, 'Tiempo y clima', 'Parker Steve, Kuo Kang Chen, traducción Coletta Elida', 1995, 1, 'libros', '010-103', 5, 'Sigmar editorial', 'CIENAT A- 3-2'),
(677, 'El Aire Contaminado', 'Leggett Jeremy, Tálamo Edith (traducción)', 1994, 1, 'libros', '010-104', 5, 'Sigmar editorial', 'CIENAT A- 3-2'),
(678, 'Las Maravillas del aire', 'Barnes Bonita Searle, Traducido Roja Laresse Martha B', NULL, 1, 'libros', '010-105', 5, 'Lumen editorial', 'CIENAT A- 3-2'),
(679, 'Movimiento', 'Walpole Brenda, Kuo Kang chen, Castro Lorda Graciela Jauregui', 1988, 1, 'libros', '010-106', 5, 'Sigmar', 'CIENAT A- 3-2'),
(680, 'Sonido', 'Cash Terry, Kuo Kang chen, Castro Lorda Graciela Jauregui', 1991, 1, 'libros', '010-107', 5, 'Sigmar', 'CIENAT A- 3-2'),
(681, 'Fisica para niños y jóvenes', 'Vancleave Janice', 2000, 1, 'libros', '010-108', 5, 'Limusa editorial', 'CIENAT A- 3-2'),
(684, 'Cuentopos de Gulubú', 'María Elena Walsh', 2013, 2, 'libros', '100-001', 5, 'Alfaguara Infantil', 'LENG C- 1-3'),
(685, 'Cuentos para jugar', 'Gianni Rodari, Carmen Santos', 2009, 2, 'libros', '100-002', 5, 'Alfaguara', 'LENG C- 1-3'),
(686, 'Versos en la esquina', 'Nataniel Costard (Recopilador)', 2005, 2, 'libros', '100-003', 5, 'Atlántida', 'LENG C- 1-3'),
(687, 'Mini-antología de cuentos tradicionales', 'Elsa Bornemann', 2013, 2, 'libros', '100-004', 5, 'Alfaguara', 'LENG C- 1-3'),
(688, 'Cuantos con brujas', 'Beatriz Graciela Cabal', 2009, 2, 'libros', '100-005', 5, 'Alfaguara', 'LENG C- 1-3'),
(689, 'Cuentos de miedo, de amor y de risa', 'Graciela Cabal, Pablo Fernández', 2014, 2, 'libros', '100-006', 5, 'Norma', 'LENG C- 1-3'),
(690, 'El niño envuelto', 'Elsa Bornemann', 2005, 2, 'libros', '100-007', 5, 'Alfaguara', 'LENG C- 1-3'),
(691, 'Perlas de Bruja', 'Mo María Rosa, Silvia Lateri', 2014, 2, 'libros', '100-008', 5, 'Serie Barco de Vapor (S/M)', 'LENG C- 1-3'),
(692, 'Caperucita Roja (tal como se lo contaron a Jorge)', 'Luis María Pescetti', 2013, 2, 'libros', '100-009', 5, 'Alfaguara', 'LENG C- 1-3'),
(693, 'En frasco chico - Antología de microrrelatos', 'Ana María Shua (et al.), compiladora Silvia Delucchi', 2013, 2, 'libros', '100-010', 5, 'Colihue', 'LENG C- 1-3'),
(694, 'Lengua Palabra de amigo: cambios y desafíos', 'Noemí Pendzik, Graciela Komerovsky', 1998, 2, 'libros', '100-011', 5, 'Troquel', 'LENG C- 1-3'),
(695, 'El sentido de la lectura', 'Ángela Pradelli', 2013, 2, 'libros', '100-012', 5, 'Paidós', 'LENG C- 1-3'),
(696, 'La literatura en la educación inicial EGB', 'Luisa María Miretti', 1998, 2, 'libros', '100-013', 5, 'Homo Sapiens', 'LENG C- 1-3'),
(697, 'Contar cuentos: desde la práctica hacia la teoría', 'Ana Padovani', 2013, 2, 'libros', '100-014', 5, 'Paidós', 'LENG C- 1-3'),
(698, 'Todos pueden aprender Lengua 2', 'Elena Duro (Responsable Unicef)', 2007, 2, 'libros', '100-015', 5, 'Unicef', 'LENG C- 1-3'),
(699, 'Prácticas 4 del lenguaje', 'Mariana Marchegiani, Laura Destefanis, Natalia Osiadacz', 2022, 2, 'libros', '100-016', 5, 'Longseller', 'LENG C- 1-3'),
(700, 'Prácticas 5 del lenguaje', 'Mariana Marchegiani, Laura Destefanis, Natalia Osiadacz', 2022, 2, 'libros', '100-017', 5, 'Longseller', 'LENG C- 1-3'),
(701, 'Prácticas 6 del lenguaje', 'Mariana Marchegiani, Laura Destefanis, Natalia Osiadacz', 2022, 2, 'libros', '100-018', 5, 'Longseller', 'LENG C- 1-3'),
(702, 'A la plaza 3 - Prácticas del lenguaje', 'Paulo Moreno', 2022, 2, 'libros', '100-019', 5, 'Longseller', 'LENG C- 1-3'),
(703, 'Activa XXI en órbita - Práctica del lenguaje 5', 'Julieta Pinasco, Cecilia Serpa', 2022, 2, 'libros', '100-020', 5, 'Puerto de Palos', 'LENG C- 1-3'),
(705, 'Evaluaciones: 29 preguntas y respuestas', 'Rebeca Anijovich, Graciela Cappelletti', 2023, 86, 'LIBROS', '1000-002', 5, 'El Ateneo', 'DIDAC B-3-6'),
(706, 'Guía urgente para enseñar en las aulas virtuales', 'Marta Libedinsky', 2023, 86, 'LIBROS', '1000-003', 5, 'Tilde', 'DIDAC B-3-6'),
(707, 'Pedagogía del cuidado', 'Mercedes Álvarez, Paula Boilini, Noelia Enriz', 2023, 86, 'LIBROS', '1000-004', 5, 'La Crujía', 'DIDAC B-3-6'),
(708, 'Tecnologías en el aula: análisis y propuesta pedagógica', 'Mónica Pini (et al.)', 2023, 86, 'LIBROS', '1000-005', 5, 'Aique', 'DIDAC B-3-6'),
(710, '50 iniciativas: Nuevos escenarios educativos', 'Ruth Harf, Delia Azzerboni, Sandra Sanchez', 2023, 86, 'LIBROS', '1000-007', 5, 'Centro de Publicaciones Educativas y Material Didáctico', 'DIDAC B-3-6'),
(712, 'Pliegues de la formación. Sentidos y herramientas para la formación docente', 'Marta Souto', 2023, 86, 'LIBROS', '1000-009', 5, 'Homo Sapiens', 'DIDAC B-3-6'),
(714, 'Recorridos de la memoria. Propuestas para la formación docente', 'Ministerio de Educación', 2023, 86, 'LIBROS', '1000-011', 5, 'Ministerio de Educación', 'DIDAC B-3-6'),
(716, 'Cómo construir proyectos en la EGB', 'Cecilia Bixio', NULL, 86, 'LIBROS', '1000-013', 5, 'Homo Sapiens', 'DIDAC B-3-6'),
(717, 'El análisis de la institución educativa. Hilos para tejer proyectos', 'Graciela Frigerio, Margarita Poggi', 2003, 86, 'LIBROS', '1000-014', 5, 'Santillana', 'DIDAC B-3-6'),
(720, 'Educación Sexual Integral: para charlar en familia', 'Programa Nacional de Educación Sexual Integral', 2011, 5, 'LIBROS', '400-002', 5, 'Ministerio de Educación de la Nación', 'ESI C-3-3'),
(721, 'Referentes Escolares de ESI - Educación Primaria', 'Ministerio de Educación', 2021, 5, 'LIBROS', '400-003', 5, 'Ministerio de Educación de la Nación', 'ESI C-3-3'),
(722, 'Referentes Escolares de ESI - Educación Secundaria', 'Ministerio de Educación', 2022, 5, 'LIBROS', '400-004', 5, 'Ministerio de Educación de la Nación', 'ESI C-3-3'),
(723, 'Educación Sexual desde la primera infancia (Información, salud y prevención)', 'Ravinovich Josefina', 2009, 5, 'LIBROS', '400-005', 5, 'Centro de Publicaciones Educativas y Material Didáctico', 'ESI C-3-3'),
(726, 'Malvinas y el mar', 'Ministerio de Educacion de la Nación', 2022, 4, 'libros', '300-001', 5, 'Ministerio Educacion de la Nación', 'CISO C- 4-2'),
(727, 'Malvinas en la escuela , memoria , Soberanía y Democracia', 'Ministerio de educación de la nación', 2022, 4, 'libros', '300-002', 5, 'Ministerio de educación de la nación', 'CISO C- 4-2'),
(729, 'Derechos de niñas , niños y adolecentes', 'Ministerio de Educacion de la nación', 2023, 4, 'libros', '300-004', 5, 'Ministerio de Educacion de la nación', 'CISO C- 4-2'),
(731, 'Recorridos de la memoria', 'Ministerio de educación', 2023, 4, 'libros', '300-006', 5, 'Ministerio de Educacion', 'CISO C- 4-2'),
(740, 'Proyecto de investigación \"Escuela Y Marginación Doble violencia\"', 'Vallejos Adriana , Busticchi Mirtha , Bovero Maria Laura', 1998, 4, 'libros', '300-015', 5, 'Acción educativa', 'CISO C- 4-2'),
(743, 'El curriculum oculto en la escuela \"la pobreza condiciona peor no determina\"', 'Angelini González Silvia , Landaburu Elena Rio , Rosales Silvia', 2005, 4, 'libros', '300-018', 5, 'Lumen', 'CISO C- 4-2'),
(745, 'Derechos humanaos y ciudadanía', 'Schujman Gustavo, Clerico Laura, Carnovale Vera.', 2008, 4, 'libros', '300-020', 5, 'AIQUE', 'CISO C- 4-2'),
(748, 'La niñez de Frida Kahlo', 'CARMEN Leñero', 2007, 4, 'libros', '300-023', 5, 'Callis', 'CISO C- 4-2'),
(750, 'Leyendas cuyanas ( historias de la provincia de san Juan)', 'A. da Col. , E B. Cilento', 2004, 4, 'libros', '300-025', 5, 'Levis editor', 'CISO C- 4-2'),
(751, 'Mitos y Cuentos Tradicionales', 'Anónimo. adoptado Mosquera Beatriz', 2014, 4, 'libros', '300-026', 5, 'la nación Ministerio de educación', 'CISO C- 4-2');
INSERT INTO `materiales` (`id`, `titulo`, `autor`, `anio_publicacion`, `area_id`, `categoria`, `codigo`, `disponibilidad`, `editorial`, `clasificacion_fisica`) VALUES
(752, 'Los Guaraníes la otra historia de los pueblos originarios', 'Palermo Miguel Ángel, Boixados Roxana Edith', 2014, 4, 'libros', '300-027', 5, 'A-Z', 'CISO C- 4-2'),
(753, 'Lo que cuentan los tehuelches', 'PALERMO Miguel Ángel', 2014, 4, 'libros', '300-028', 5, 'Sudamericana', 'CISO C- 4-2'),
(754, 'Mitos y leyendas de la argentina (historias de nuestro pueblo).', 'Riveros IRIS, Mascota Diego.', 2014, 4, 'libros', '300-029', 5, 'ESTRADA', 'CISO C- 4-2'),
(755, 'Cuentos de china y Tíbet', 'Hume Carswell Lotta koon-chiu, Lodoño Torres Patricia', 2014, 4, 'libros', '300-030', 5, 'Norma', 'CISO C- 4-2'),
(756, 'El guardián del último fuego y otras leyendas argentinas', 'Bajo Cristina , Pez Alberto', 2014, 4, 'libros', '300-031', 5, 'La brujita de papel.', 'CISO C- 4-2'),
(757, 'El libro de lectura del bicentenario', 'Plan Nacional de Lectura. Ministerio de Educacion presidencia de la nación', 2010, 4, 'libros', '300-032', 5, 'Ministerio de Educacion presidencia de la nación', 'CISO C- 4-2'),
(758, 'Lo que cuentan los incas', 'Marcuse Aida E.', 2005, 4, 'libros', '300-033', 5, 'Sudamericana', 'CISO C- 4-2'),
(760, 'Mitos clásicos I', 'Prof. Cochetti Stella Maris', NULL, 4, 'libros', '300-035', 5, 'Cantaro', 'CISO C- 4-2'),
(764, 'Árboles Nativos de la provincia de san Juan', 'Márquez Justo , Ripol Yanina , Dalmasso Antonio , Jordán Marcelo', 2014, 4, 'libros', '300-039', 5, 'Secretaria Ambiente y desarrollo sustentable', 'CISO C- 4-2'),
(766, 'Sociedades ayer y hoy ( ciencias sociales 7 año / 1 año )', 'García Margarita , Gatell Cristina , Montserrat Llorens', 2002, 4, 'libros', '300-041', 5, 'Vicen vives', 'CISO C- 4-2'),
(767, 'Observo y aprendo 7', 'Insua Haydee , Lara Nydia , Fanelli Jorge', 1991, 4, 'libros', '300-042', 5, 'La OBRA Ediciones', 'CISO C- 4-2'),
(768, 'Ciencias Sociales 4 Nación', 'Conceiro Pablo Alberto', 2014, 4, 'libros', '300-043', 5, 'Mandioca', 'CISO C- 4-2'),
(769, 'Ciencias Sociales 4 guía para saber mas', 'García Carolina', 2012, 4, 'libros', '300-044', 5, 'Puerto palos', 'CISO C- 4-2'),
(770, 'Ciencias Sociales 5 Bonaerense', 'Celotto Amanda', 2015, 4, 'libros', '300-045', 5, 'Santillana', 'CISO C- 4-2'),
(771, 'Ciencias Sociales 6 conocer', 'Celotto Amanda', 2015, 4, 'libros', '300-046', 5, 'Santillana', 'CISO C- 4-2'),
(772, 'Ciencias Sociales 5', 'Lesser Ricardo', 2011, 4, 'libros', '300-047', 5, 'Aique', 'CISO C- 4-2'),
(773, 'Ciencias Sociales 5 guía saber mas', 'Chiodi Aldana', 2012, 4, 'libros', '300-048', 5, 'Puerto de palos', 'CISO C- 4-2'),
(774, 'Ciencias Sociales 6 Bonaerense', 'Blanco Jorge', 2012, 4, 'libros', '300-049', 5, 'Aique', 'CISO C- 4-2'),
(775, 'Ciencias Sociales 6', 'Grinchupun Boris Matías', 2014, 4, 'libros', '300-050', 5, 'Mandioca', 'CISO C- 4-2'),
(776, 'Geografía de América saberes claves', 'García Patricia', 2011, 4, 'libros', '300-051', 5, 'Santillana', 'CISO C- 4-2'),
(777, 'Geografía de la Argentina saberes claves', 'Arzeno Mariana, Ataide Soraya , Ippolito Mónica', 2010, 4, 'libros', '300-052', 5, 'Santillana', 'CISO C- 4-2'),
(778, 'Ciencias Sociales 6 Nación', 'García Patricia', 2002, 4, 'libros', '300-053', 5, 'Santillana', 'CISO C- 4-2'),
(780, 'Ciencias Sociales 7', 'Acha Patricia , Barraza Natalia Alfonsina , Ippolito Mónica', 2002, 4, 'libros', '300-055', 5, 'Santillana hoy', 'CISO C- 4-2'),
(781, 'Geografía Sociedades y ambientes', 'Ancha Patricia, Abdo Maria Andrea.', 2003, 4, 'libros', '300-056', 5, 'Santillana', 'CISO C- 4-2'),
(782, 'Quebrada de humahuaca , mas 10.000 años de historia', 'Albeck Maria Esther, González Ana Maria', 2001, 4, 'libros', '300-057', 5, 'Programa Nacional de escuelas Prioritarias del ministerio de educación', 'CISO C- 4-2'),
(783, 'Vivir en la Quebrada de Humahuaca', 'Albeck Maria Ester , Cuestas Claudia Elsa', 2001, 4, 'libros', '300-058', 5, 'Programa Nacional de escuelas Prioritarias del Ministerio de educación', 'CISO C- 4-2'),
(784, 'Ciencias Sociales 4 san Juan', 'Massun Maria Beatriz', 2011, 4, 'libros', '300-059', 5, 'E.d.b.', 'CISO C- 4-2'),
(787, 'Ciencias Sociales 4', 'Lopez Lucia Inés', 2015, 4, 'libros', '300-062', 5, 'Santillana', 'CISO C- 4-2'),
(788, 'Ciencias Sociales 4 Bonaerense', 'Carbajal Benjamín, Jitric Patricia', 2014, 4, 'libros', '300-063', 5, 'Santillana', 'CISO C- 4-2'),
(789, 'Ciencias Sociales 6 e.g.b.', 'Scaltritti Mabel , Tobio Omar', 1997, 4, 'libros', '300-064', 5, 'Kapelusz', 'CISO C- 4-2'),
(790, 'Organizador de Estudio Ciencias sociales 5', 'Calamita Bruna', 2011, 4, 'libros', '300-065', 5, 'Aique', 'CISO C- 4-2'),
(791, 'Ciencias sociales 5 ( ciencia en foco )', 'Blanco Jorge', 2006, 4, 'libros', '300-066', 5, 'Aique', 'CISO C- 4-2'),
(792, 'Ciencias Sociales y formación ética y ciudadana 7', 'Bachmann Lía', 2002, 4, 'libros', '300-067', 5, 'Longseller', 'CISO C- 4-2'),
(795, 'Aprender en tercero 3 matematica ciencias sociales, ciencias naturales.', 'Benchimol Karina, Heredia Gabriela. (Et. al).', 2009, 4, 'libros', '300-070', 5, 'Tinta fresca', 'CISO C- 4-2'),
(796, 'Geografía Argentina', 'Albornos Facundo , Arzeno Mariana , Cattáneo Juan', 2001, 4, 'libros', '300-071', 5, 'Puerto palos', 'CISO C- 4-2'),
(797, 'Áreas Paralelas (Ciencias Sociales, lengua). 6', 'Longoni Ana , Monasterio Maria del Carmen', 2002, 4, 'libros', '300-072', 5, 'Santillana', 'CISO C- 4-2'),
(798, 'Ciencias Sociales 4 ( san Juan)', 'Molina Norma , Bartol Claudia', 2005, 4, 'libros', '300-073', 5, 'Santillana', 'CISO C- 4-2'),
(799, 'Mirar con lupa 1', 'Alderoqui Helena, Arzeno Maria Elena, Fusca Carmen.', 2009, 4, 'libros', '300-074', 5, 'Estrada', 'CISO C- 4-2'),
(805, 'Atahualpa Yupanqui ( para jóvenes principiantes )', 'Polimeni Carlos , Paz Daniel', 2000, 4, 'libros', '300-080', 5, 'Longseller', 'CISO C- 4-2'),
(806, 'Los jinetes del chaco', 'Palermo Miguel', 1998, 4, 'libros', '300-081', 5, 'Libros del Quirquincho.', 'CISO C- 4-2'),
(807, 'Las aventuras Alfonsina Storni', 'Grau Silvia', 1999, 4, 'libros', '300-082', 5, 'Errepar', 'CISO C- 4-2'),
(808, 'Proyecto fundación de Caucete 15 de noviembre 1851', 'Honorable convención Constituyente.', 2007, 4, 'libros', '300-083', 5, '[No especificado]', 'CISO C- 4-2'),
(809, 'La Conquista de América', 'Boixados Roxana Edith Palermo Miguel Ángel', 1997, 4, 'libros', '300-084', 5, 'Libros del quirquincho', 'CISO C- 4-2'),
(810, 'Los Diaguitas', 'Boixados Roxana Edith, Palermo Miguel Ángel', 2000, 4, 'libros', '300-085', 5, 'Libros del Quirquincho', 'CISO C- 4-2'),
(811, 'Historia Argentina 6: La Democracia constitucional y su crisis.', 'Cantón Darío , Moreno José Luis y Ciria Alberto', 2005, 4, 'libros', '300-086', 5, 'Piados', 'CISO C- 4-2'),
(812, 'Descentralización y municipalización el debate del espacio público en la escuela', 'Vázquez Silvia Andrea , Mango Marcelo', 2003, 4, 'libros', '300-087', 5, 'Ctera', 'CISO C- 4-2'),
(813, 'San Martín Para jóvenes principiantas', 'Arrascaeta Eliana, Luna Maria.', 1999, 4, 'libros', '300-088', 5, 'Errepar', 'CISO C- 4-2'),
(814, 'Jose de SAN MARTIN caballero del principio a fin', 'Basch Adela', 2009, 4, 'libros', '300-089', 5, 'Alfaguara', 'CISO C- 4-2'),
(815, 'La Formación Ética y Ciudadana en la educación Básica', 'Dallera Osvaldo , Fernández Esther , Gallo Martha Frassineti , (et al )', 2000, 4, 'libros', '300-090', 5, 'Novedades educativas', 'CISO C- 4-2'),
(816, 'Comprendamos Historia', 'Bois Caillet Maria Elena', 2006, 4, 'libros', '300-091', 5, 'Comunicarte', 'CISO C- 4-2'),
(817, 'La Constitución Nacional para chicos ( con amor y con humor )', 'Ignacio Hernaiz , Burundarena Maitena', 1995, 4, 'libros', '300-092', 5, 'Troquel', 'CISO C- 4-2'),
(819, 'Historia el mundo Contemporáneo del siglo XVIII, XIX Y XX.', 'Barral Maria Elena, Blasco Maria Elida.', 2000, 4, 'libros', '300-094', 5, 'Estrada.', 'CISO C- 4-2'),
(820, 'Historia el mundo contemporáneo Atlas Histórico.', 'Barral Maria Elena, Blasco Maria Elida.', 2000, 4, 'libros', '300-095', 5, 'Estrada', 'CISO C- 4-2'),
(821, 'Geografía el mundo Contemporáneo.', 'Echevarría Maria Julia, Capuz Silvia Maria', 2004, 4, 'libros', '300-096', 5, 'A-Z Editorial', 'CISO C- 4-2'),
(822, 'Historia Argentina La organización Nacional', 'Torres Gorostegui Haydée.', 2000, 4, 'libros', '300-097', 5, 'Paidos', 'CISO C- 4-2'),
(823, 'Moreno Para jóvenes principiantes', 'Tello Nerio , Scenna Miguel Angel', 2000, 4, 'libros', '300-098', 5, 'Longseller', 'CISO C- 4-2'),
(824, 'Historia Argentina Argentina Indígena víspera de la conquista.', 'González Alberto Rex, Pérez Jose', 2000, 4, 'libros', '300-099', 5, 'Paidos', 'CISO C- 4-2'),
(825, 'La Gran Inmigración vida cotidiana', 'Wolf Ema, Patriarca Cristina.', 2000, 4, 'libros', '300-100', 5, 'Sudamericana', 'CISO C- 4-2'),
(826, 'Educacion , Memoria , y derechos humanos orientación pedagógica y recomendaciones para su enseñanza', 'Ministerio de educación de la Nación', 2010, 4, 'libros', '300-101', 5, 'Proyecto multinacional memoria y derechos humanos en el Mercosur', 'CISO C- 4-2'),
(827, 'Historia Argentina 5: la República conservadora.', 'Conde Cortes Roberto , Gallo Ezequiel', 2005, 4, 'libros', '300-102', 5, 'Paidos', 'CISO C- 4-2'),
(828, 'Nueva historia Argentina ( LA Sociedad Colonial )', 'Tander Enrique', 2000, 4, 'libros', '300-103', 5, 'Sudamericana Editorial', 'CISO C- 4-2'),
(829, 'Nueva Historia Argentina (Revolución , República , Confederación )', 'Goldman Noemí', 2000, 4, 'libros', '300-104', 5, 'Sudamericana editorial', 'CISO C- 4-2'),
(830, 'Nueva Historia Argentina (Liberalismo , Estado y orden Burgués ) (1852 -1880)', 'Bonaudo Marta', 1999, 4, 'libros', '300-105', 5, 'Sudamericana editorial', 'CISO C- 4-2'),
(831, 'Nueva Historia Argentina ( El progreso , la modernización y sus límites ) ( 1880 – 1916)', 'Lobato Mirta Zaida', 2000, 4, 'libros', '300-106', 5, 'Sudamericana editorial', 'CISO C- 4-2'),
(832, 'Nueva Historia Argentina ( Dictadura y Democracia ) ( 1976-2001)', 'Suriano Juan', 2007, 4, 'libros', '300-107', 5, 'Sudamericana Editorial', 'CISO C- 4-2'),
(833, 'Historia Argentina de la Revolución de independencia a la confederación Rosista.', 'Donghi Halperin Tulio', 2007, 4, 'libros', '300-108', 5, 'Paidos', 'CISO C- 4-2'),
(834, 'Marco polo. Para jóvenes precipitantes', 'Broussalis Martin', 1999, 4, 'libros', '300-109', 5, 'Longseller', 'CISO C- 4-2'),
(835, 'Ley de migraciones', 'Inadi', 2014, 4, 'libros', '300-110', 5, 'Inadi', 'CISO C- 4-2'),
(836, 'Argentina de la conquista a la independencia vol. 2', 'Assadourian Carlos S. , Beato Guillermo , Chiamonte José C.', 2005, 4, 'libros', '300-111', 5, 'Paidos', 'CISO C- 4-2'),
(837, 'La gente y sus lugares ( Andes patogénicos )', 'Rebortti Carlos', 1997, 4, 'libros', '300-112', 5, 'Libros quirquincho', 'CISO C- 4-2'),
(838, 'La gente y sus lugares ( Misiones )', 'Reboratti Carlos', 1997, 4, 'libros', '300-113', 5, 'Libros Quirquincho', 'CISO C- 4-2'),
(839, 'La historieta Argentina San MARTIN', 'Pigna Felipe, D, Aranno Estaban, Leiva Julio.', 2007, 4, 'libros', '300-114', 5, 'Planeta.', 'CISO C- 4-2'),
(841, 'Nueva Historia de San Juan', 'Rodríguez Nora Inés, Garcia Ana Maria , Bartol de Ferrá Margarita', 1997, 4, 'libros', '300-116', 5, 'Editorial Fundación Universidad nacional de San Juan', 'CISO C- 4-2'),
(843, 'Formación Ética y Ciudadana 7', 'Ceballos Marta Susana , Almará Maria Norberto', 2009, 4, 'libros', '300-118', 5, 'Yammal contenidos', 'CISO C- 4-2'),
(844, 'Cuento con vos Un libro de cuentos sobre tus Derechos.', 'Ministerio de cultura y Educacion de la nación República Argentina', 1999, 4, 'libros', '300-119', 5, 'Ministerio de educación', 'CISO C- 4-2'),
(847, 'SOL y Montaña Turismo en San Juan', 'Turismo de la provincia de san Juan Vignoli Carlos Alberto', 2007, 4, 'libros', '300-122', 5, 'Sol y montaña', 'CISO C- 4-2'),
(848, 'América Creación del Barroco', 'Chávez Fermín', NULL, 4, 'libros', '300-123', 5, 'Docencia editorial', 'CISO C- 4-2'),
(850, 'La gente y sus lugares Ciudades Pequeñas', 'Reboratti Carlos E.', NULL, 4, 'libros', '300-125', 5, 'Libros del Quirquincho', 'CISO C- 4-2'),
(852, 'Inmigrantes españoles en Argentina Adaptación e Identidad. documentos ( 1915-1931)', 'Rodino Hugo José', 1999, 4, 'libros', '300-127', 5, 'Biblioteca Nacional Ediciones y pagina 12.', 'CISO C- 4-2'),
(854, 'Cuentos de guerra (para pensar la paz).', 'Vincenzo di Diego', 2002, 4, 'libros', '300-129', 5, 'Estrada', 'CISO C- 4-2'),
(855, 'Villa \" Colon\" de Caucete', 'Guerrero Cesar H.', 1969, 4, 'libros', '300-130', 5, 'Editorial sanjuanina', 'CISO C- 4-2'),
(858, 'Colon agarra viaje a toda costa', 'Basch Adela', 2009, 4, 'libros', '300-133', 5, 'Alfaguara', 'CISO C- 4-2'),
(859, 'Mitos y leyendas de Egipto', 'Shua Ana Maria , Arias Leo', NULL, 4, 'libros', '300-134', 5, 'El gato de hojalata', 'CISO C- 4-2'),
(860, 'Leyendas Argentinas', 'Repún Graciela', 2008, 4, 'libros', '300-135', 5, 'Norma editorial', 'CISO C- 4-2'),
(861, 'Fedor Dostoievski Y Obra', 'Fedor Dostoievski y obra', NULL, 4, 'libros', '300-136', 5, 'Norma', 'CISO C- 4-2'),
(862, 'Diseño Curricular de Educación Inicial - Jardín Maternal 1er Ciclo (Parte 1 y 2)', 'Ministerio de Educación', NULL, 6, 'LIBROS', '500-001', 5, 'Gobierno de San Juan', 'EDINIP D-4-1'),
(863, 'Diseño Curricular de Educación Inicial', 'Ministerio de Educación', NULL, 6, 'LIBROS', '500-002', 5, 'Gobierno de San Juan', 'EDINIP D-4-1'),
(864, 'La lengua oral en la Educación Inicial', 'Miretti María Luisa', 2003, 6, 'LIBROS', '500-003', 5, 'Homo Sapiens Ediciones', 'EDINIP D-4-1'),
(865, 'La cuestión de la infancia: Entre la escuela, la calle y el shopping', 'Sandra Carli', 2006, 6, 'LIBROS', '500-004', 5, 'Paidós', 'EDINIP D-4-1'),
(867, 'Entre los pañales y las letras. Acercamientos a la Educación Inicial', 'María Teresa Cuberes González', 2008, 6, 'LIBROS', '500-006', 5, 'Aique', 'EDINIP D-4-1'),
(868, 'La sala multiedad en la Educación Inicial: una propuesta de lecturas múltiples', 'Ministerio de Educación', 2007, 6, 'LIBROS', '500-007', 5, 'Ministerio de Educación de la Nación', 'EDINIP D-4-1'),
(869, 'Títeres y resiliencia en el Nivel Inicial: un desafío para afrontar la adversidad', 'Santa Elena Cruz, Livia García Labandal', 2008, 6, 'LIBROS', '500-008', 5, 'Homo Sapiens Ediciones', 'EDINIP D-4-1'),
(870, 'La planificación didáctica en el Jardín de Infantes', 'Laura Pitluk', 2012, 6, 'LIBROS', '500-009', 5, 'Homo Sapiens Ediciones', 'EDINIP D-4-1'),
(871, 'Las prácticas actuales en la Educación Inicial', 'Laura Pitluk', 2013, 6, 'LIBROS', '500-010', 5, 'Homo Sapiens Ediciones', 'EDINIP D-4-1'),
(880, 'Maestros del siglo XXI. El oficio de educar .homenaje a Paulo Freire.', 'Bixio Cecilia', 2010, 8, 'LIBROS', '700-009', 5, 'Homo sapiens', 'FILOS D-4-3'),
(888, 'Un tiempo para pensar Introducción al quehacer filosófica', 'Onetto Fernando', 1999, 8, 'LIBROS', '700-017', 5, 'Bonum Editorial', 'FILOS D-4-3'),
(890, 'Ética y Cine', 'Fariña Michel Juan Jorge.', 2000, 8, 'LIBROS', '700-019', 5, 'Eudeba', 'FILOS D-4-3'),
(897, 'Derechos Humanos', 'Ministerio de Educacion de la Nación', 2023, 8, 'LIBROS', '700-026', 5, 'Ministerio de Educacion de la nación', 'FILOS D-4-3'),
(904, 'Las Abuelas nos cuentan una nueva colección por el derecho a la identidad', 'Ministerio de Educacion de la Nación', 2022, 8, 'LIBROS', '700-033', 5, 'Ministerio de Educacion de la Nación', 'FILOS D-4-3'),
(906, 'Filosofía formación ética y ciudadana', 'Capanna Pablo, Bugallo Alicia', 2002, 8, 'LIBROS', '700-001', 5, 'Puerto de palos', 'FILOS D-4-3'),
(907, 'Introducción a la filosofía moral.', 'Racheles James', 2007, 8, 'LIBROS', '700-002', 5, 'Fondo de cultura economica.', 'FILOS D-4-3'),
(908, 'Filosofía (I) Para principiantes', 'Osborne Richard, Edner Raph', 1996, 8, 'LIBROS', '700-003', 5, 'Errepar', 'FILOS D-4-3'),
(909, 'Filosofía (II) Para principiantes', 'Osborne Richard, Edney Raph', 1996, 8, 'LIBROS', '700-004', 5, 'Era naciente', 'FILOS D-4-3'),
(910, 'Platón para jóvenes principiantes', 'Cavalier Robert, Lurio Eric', 2000, 8, 'LIBROS', '700-005', 5, 'Era naciente', 'FILOS D-4-3'),
(915, 'Fragmentos de un discurso matemáticos', 'Amster, Pablo', 2008, 8, 'LIBROS', '700-010', 5, 'Fondo de cultura economica', 'FILOS D-4-3'),
(918, 'Pequeño panteón Portátil', 'Badiou Alain', 2009, 8, 'LIBROS', '700-013', 5, 'Fondo de cultura economica', 'FILOS D-4-3'),
(919, 'El modo de existencia de los objetos técnicos', 'Simondon Gilbert', 2007, 8, 'LIBROS', '700-014', 5, 'Prometeo libros.', 'FILOS D-4-3'),
(920, 'Tan locos como sabios vivir como filósofos', 'Droit Roger- Pol, Tonnac Jean – Philippe de', 2004, 8, 'LIBROS', '700-015', 5, 'Fondo de cultura economica', 'FILOS D-4-3'),
(921, 'Las narices de los filósofos una historia de la filosofía a través de 50 pensadores esenciales', 'Goñi Carlos', 2008, 8, 'LIBROS', '700-016', 5, 'Ariel editorial', 'FILOS D-4-3'),
(925, 'Filosofía, formación ética y ciudadana', 'Capanna Pablo, Bugallo Alicia', 2002, 8, 'LIBROS', '700-020', 5, 'Puerto de palos', 'FILOS D-4-3'),
(927, 'Nociones de Lógica', 'Castro Jorge, Espejo Rosa A., Flores Oscar', NULL, 8, 'LIBROS', '700-022', 5, 'Universidad Nacional de San Juan', 'FILOS D-4-3'),
(928, 'Derechos humanos y ciudadanía', 'Schujman Gustavo, Clerico Laura, Carnovale Vera.', 2008, 8, 'LIBROS', '700-023', 5, 'AIQUE', 'FILOS D-4-3'),
(930, 'Derechos de niñas, niños y adolecentes', 'Ministerio de Educacion de la nación', 2023, 8, 'LIBROS', '700-025', 5, 'Ministerio de Educacion de la nación', 'FILOS D-4-3'),
(934, 'Genero', 'Ministerio de la educación de la Nación', 2023, 8, 'LIBROS', '700-029', 5, 'Ministerio de educación de la nación', 'FILOS D-4-3'),
(941, 'La iniciación deportiva y el deporte escolar', 'Sánchez Blázquez Domingo', 1999, 7, 'libros', '600-002', 5, 'Inde Publicaciones', 'EDUFIS C- 1-2'),
(944, 'Deporte y Ciencia: teoría de la actividad física', 'López Rodríguez Juan', 1998, 7, 'libros', '600-005', 5, 'Inde Publicaciones', 'EDUFIS C- 1-2'),
(945, 'Juguemos en el jardín. El juego y la actividad física en la educación inicial', 'Incarbone Oscar', 2013, 7, 'libros', '600-006', 5, 'Stadium', 'EDUFIS C- 1-2'),
(949, 'La Educación Física en el Nivel Inicial', 'Naveiras Daniel, Franchina Alicia', 1988, 7, 'libros', '600-010', 5, 'La Obra Ediciones', 'EDUFIS C- 1-2'),
(950, 'Juegos de Estimulación Para bebes de 0 a 24 meses', 'Fernández Ferrari María José', 2008, 9, 'libros', '800-001', 5, 'Albatros', 'PSICO D- 2-1'),
(951, 'El gran libro juegos para la mente.', 'Moscovich Iván', 2008, 9, 'libros', '800-002', 5, 'Troquel', 'PSICO D- 2-1'),
(953, 'Seis estudios de psicología', 'Piaget Jean', 1998, 9, 'libros', '800-004', 5, 'Ariel', 'PSICO D- 2-1'),
(954, 'Vigotski su proyección en el pensamiento actual.', 'Dubrovsky Silvia (compiladora)', 2000, 9, 'libros', '800-005', 5, 'Novedades educativas', 'PSICO D- 2-1'),
(959, 'Curso de PSICOLOGIA', 'Ruiz DANIEL', 1984, 9, 'libros', '800-010', 5, 'Estrada Editorial', 'PSICO D- 2-1'),
(964, 'Acerca de los niños', 'Winnicott Donald', 2006, 9, 'libros', '800-015', 57, 'Paidos', 'PSICO-D-2-1'),
(969, 'La biblia del lenguaje corporal. Guía práctica para interpretar los gestos y las expresiones de las personas', 'James Judi', 2010, 9, 'libros', '800-020', 5, 'Paidos', 'PSICO D- 2-1'),
(975, 'Cerebro Ultimas Noticias', 'Golombex Diego A.', 1998, 9, 'libros', '800-026', 5, 'Colihue ediciones', 'PSICO D- 2-1'),
(979, 'Mente y Cerebro para principiantes', 'Gellaty Angus, Zárate Oscar', 2000, 9, 'libros', '800-030', 5, 'Era Naciente', 'PSICO D- 2-1'),
(987, 'Conduciendo la escuela: manual de gestión directiva y evaluación institucional', 'Delia Azzerboni, Ruth Harf', 2003, 10, 'LIBROS', '900-002', 5, 'Centro de Publicaciones Educativas y Material Didáctico', 'PEDA E-2-2'),
(989, 'Gestión estratégica para instituciones educativas: guía para planificar estrategias de gerenciamiento institucional', 'Juan Manuel Manes', 2004, 10, 'LIBROS', '900-004', 5, 'Granica', 'PEDA E-2-2'),
(990, 'Curriculum y Evaluación Escolar', 'Ángel Díaz Barriga', 1994, 10, 'LIBROS', '900-005', 5, 'Aique', 'PEDA E-2-2'),
(991, 'La evaluación como aprendizaje. Cuando la flecha impacta en la diana', 'Miguel Ángel Santos Guerra', 2023, 10, 'LIBROS', '900-006', 5, 'Logos Adicciones', 'PEDA E-2-2'),
(993, 'Representaciones, discursos y prácticas acerca de Evaluación Educativa. Tomo 2: metaevaluación y autoevaluación institucional', 'Marta Susana Ceballos', 2007, 10, 'LIBROS', '900-008', 5, 'Yammal Contenidos', 'PEDA E-2-2'),
(994, 'La construcción del éxito y del fracaso escolar. Hacia un análisis del éxito, fracaso y desigualdades como realidades construidas por el sistema escolar', 'Philippe Perrenoud', NULL, 10, 'LIBROS', '900-009', 5, 'Morata Ediciones', 'PEDA E-2-2'),
(996, 'Pensar las instituciones. Sobre teorías y prácticas en educación', 'Alicia Corbalán de Mezzano, Marta Souto, Ida Butelman (comps)', 2010, 10, 'LIBROS', '900-011', 5, 'Paidós', 'PEDA E-2-2'),
(997, 'La escuela como territorio de intervención política', 'Hugo Zemelman, Isabel Rauber', 2004, 10, 'LIBROS', '900-012', 5, 'CTERA', 'PEDA E-2-2'),
(998, 'La vida en las escuelas: esperanzas y desencantos de la convivencia escolar', 'Carina V. Kaplan', 2023, 10, 'LIBROS', '900-013', 5, 'Homo Sapiens Ediciones', 'PEDA E-2-2'),
(1001, 'Una escuela en y para la diversidad. El entramado de la diversidad', 'Alicia Devalle de Rendo, Viviana Vega', 2006, 83, 'LIBROS', '526-003', 5, 'Aique', 'INCLU F-3-1'),
(1003, 'Leer y escribir entre dos culturas. El caso de las comunidades kollas del nordeste argentino', 'Ana María Borzone de Manrique, Cecilia Rosemberg', 2000, 83, 'LIBROS', '526-005', 5, 'Aique', 'INCLU F-3-1'),
(1007, 'Eugenio el burro terco (Fábulas de mi país)', 'Luciana Acuña', 2012, 87, 'LIBROS', '250-001', 5, 'Arte Gráfico Editorial Argentino', 'ARTELIT F-5-2'),
(1008, 'La Vaca tenaz (Fábulas de mi país)', 'Luciana Acuña', 2012, 87, 'LIBROS', '250-002', 5, 'Arte Gráfico Editorial Argentino', 'ARTELIT F-5-2'),
(1009, 'La Orca Gigante (Fábulas de mi país)', 'Luciana Acuña', 2012, 87, 'LIBROS', '250-003', 5, 'Arte Gráfico Editorial Argentino', 'ARTELIT F-5-2'),
(1010, 'Los pavos engreídos (Fábulas de mi país)', 'Luciana Acuña', 2012, 87, 'LIBROS', '250-004', 5, 'Arte Gráfico Editorial Argentino', 'ARTELIT F-5-2'),
(1011, 'La gallina de los huevos de oro', 'Luciana Acuña', 2012, 87, 'LIBROS', '250-005', 5, 'Arte Gráfico Editorial Argentino', 'ARTELIT F-5-2'),
(1012, 'La oveja olvidadiza', 'Luciana Acuña', 2012, 87, 'LIBROS', '250-006', 5, 'Arte Gráfico Editorial Argentino', 'ARTELIT F-5-2'),
(1013, 'Cuentos para una noche de insomnio', 'Jorge A. Estrada', 2014, 87, 'LIBROS', '250-007', 5, 'V y R', 'ARTELIT F-5-2'),
(1014, 'Secretos de familia', 'Graciela Beatriz Cabal', 1999, 87, 'LIBROS', '250-008', 5, 'Sudamericana', 'ARTELIT F-5-2'),
(1015, 'Tengo un monstruo en el bolsillo', 'Graciela Montes', 2009, 87, 'LIBROS', '250-009', 5, 'Sudamericana', 'ARTELIT F-5-2'),
(1016, 'La Reina Mab. El hada de las pesadillas', 'Cristian Turdera, Ruth Kaufman', 2014, 87, 'LIBROS', '250-010', 5, 'Pequeño Editor', 'ARTELIT F-5-2'),
(1017, 'Obras completas: poesía completa y prosa selecta', 'Alejandra Pizarnik', 1981, 87, 'LIBROS', '250-011', 5, 'Corregidor', 'ARTELIT F-5-2'),
(1018, 'Antología de la literatura fantástica argentina. Vol. 1', 'Haydée Flesca (comp)', 1996, 87, 'LIBROS', '250-012', 5, 'Kapelusz', 'ARTELIT F-5-2'),
(1019, 'Antología de narrativa argentina', 'Carlos Bernatek, Gabriela Cedro, Luciano Griffiths, García Bonatti', 2006, 87, 'LIBROS', '250-013', 5, 'Siglo XXI', 'ARTELIT F-5-2'),
(1020, 'Cuentos en secreto. Antología de autores argentinos contemporáneos', 'Leopoldo Brizuela (comp)', 2003, 87, 'LIBROS', '250-014', 5, 'Alfaguara', 'ARTELIT F-5-2'),
(1021, 'Cuentos escogidos', 'Marco Denevi', 1988, 87, 'LIBROS', '250-015', 5, 'Corregidor', 'ARTELIT F-5-2'),
(1022, 'Borges Cuentos (edición y resumen)', 'Jorge Luis Borges, Edición: María Adela Renard', NULL, 87, 'LIBROS', '250-016', 5, 'Kapelusz', 'ARTELIT F-5-2'),
(1023, 'Bestiario', 'Julio Cortázar', 2000, 87, 'LIBROS', '250-017', 5, 'Alfaguara', 'ARTELIT F-5-2'),
(1028, 'Enseñar Matemática hoy Miradas, sentidos y desafíos.', 'Sadovsky Patricia', 2005, 82, 'LIBROS', '681-005', 5, 'Libros del zorzal', 'PROY E-4-4'),
(1031, 'Matemática es la escuela saberes y conocimientos de niños y docentes', 'Briotman Claudia', 2013, 82, 'LIBROS', '681-008', 5, 'Paidos', 'PROY E-4-4'),
(1032, 'Enseñar matemática en el nivel inicial.', 'Aberkane Francois Cerquetti, Berdonneau Catherine', 1997, 82, 'LIBROS', '681-009', 5, 'Edicial', 'PROY E-4-4'),
(1033, 'Didactica de la matemática cuestiones, teórica y práctica en el aula', 'Orton Anthony', 1998, 82, 'LIBROS', '681-010', 5, 'Morata Ediciones', 'PROY E-4-4'),
(1034, 'Iniciación al estudio didáctico de la geometría.', 'Itzcovich Horacio', 2005, 82, 'LIBROS', '681-011', 5, 'Libros del zorzal', 'PROY E-4-4'),
(1036, 'Razones para enseñar geometría en la educación básica.', 'Bressan Ana María, Bogisic Beatriz, Crego Karina', 2010, 82, 'LIBROS', '681-013', 5, 'Novedades educativas', 'PROY E-4-4'),
(1037, 'Matemática 4 (Proyecto de programación entorno digital)', 'Carrasco Dora', 2022, 82, 'LIBROS', '681-014', 5, 'Aique', 'PROY E-4-4'),
(1038, 'Matemática 5( proyecto de programación entorno digital)', 'Carrasco Dora, Jousse Gabriela', 2022, 82, 'LIBROS', '681-015', 5, 'Aique', 'PROY E-4-4'),
(1039, 'Matemática 6 ( proyecto de programación entorno digital)', 'Carrasco Dora', 2022, 82, 'LIBROS', '681-016', 5, 'Aique', 'PROY E-4-4'),
(1040, 'Matemática ¿estás ahí?', 'Paenza Adrian', 2008, 82, 'LIBROS', '681-017', 5, 'XXI ediciones', 'PROY E-4-4'),
(1045, 'Piedra libre para la matematica', 'Villella José', 2008, 82, 'LIBROS', '681-022', 5, 'Aique', 'PROY E-4-4'),
(1046, 'Rozones para enseñar geometría en la Educacion básica ( mirar, construir y decir )', 'Bressan Ana María, Bogisic Beatriz, Crego Karina', 2002, 82, 'LIBROS', '681-023', 5, 'Novedades Educativas', 'PROY E-4-4'),
(1047, 'Enseñar aritmética a los más chicos (de la exploración al dominio).', 'Parra Cecilia, Saiz Irma', 2007, 82, 'LIBROS', '681-024', 5, 'Homo sapiens ediciones', 'PROY E-4-4'),
(1049, 'La matematica y su didáctica, En el primero y el segundo de los siglos de la educación Gral. básica', 'Dallura Lucia', 2008, 82, 'LIBROS', '681-026', 5, 'Aique', 'PROY E-4-4'),
(1053, 'Clases de hoy en escuelas de ayer', 'Cuda Mariela', 2023, 82, 'LIBROS', '681-030', 5, 'Bonum', 'PROY E-4-4'),
(1059, '¿Inclusión o accesibilidad educativa para todos?', 'Boggiano Norberto', 2023, 82, 'LIBROS', '681-036', 5, 'Homo sapiens Ediciones', 'PROY E-4-4'),
(1060, 'Derechos de la infancia y educación inclusiva en América latina', 'Dávila Pauli, Naya Luis M. (compiladores)', 2023, 82, 'LIBROS', '681-037', 5, 'Granica', 'PROY E-4-4'),
(1068, 'Pedagogías del nivel inicial Mirar el mundo desde el jardín.', 'Brailovsky Daniel', 2023, 82, 'LIBROS', '681-045', 5, 'Centro de publicaciónes Educativas y material didáctico', 'PROY E-4-4'),
(1069, 'Forma e practica reflexiva.', 'Anijovich Rebeca, Cappelletti Graciela', 2023, 82, 'LIBROS', '681-046', 5, 'Aique', 'PROY E-4-4'),
(1074, 'Relaciones escolares y diferencias culturales: la educación en perspectiva Intercultural.', 'Villa Alicia l, Martínez Elena M.( comps)', 2023, 82, 'LIBROS', '681-051', 5, 'Centro de publicaciones Educativas y Material didáctico', 'PROY E-4-4'),
(1078, 'La Evaluación como aprendizaje cuando la flecha impacta en la diana.', 'Guerra Miguel Ángel santos', 2023, 82, 'LIBROS', '681-055', 5, 'Logos adicciones', 'PROY E-4-4'),
(1079, 'La enseñanza en enseñanza infantil. 0 a 3 años.', 'Violante Rosa', 2023, 82, 'LIBROS', '681-056', 5, 'Praxis grupo editor', 'PROY E-4-4'),
(1084, 'Yendo de la tiza al mouse. Manual de informática educativa para docentes no informáticos', 'Vera Rexach, Juan Carlos Asinsten', 1999, 92, 'libros', '50-001', 5, 'Novedades Educativas', 'TIC F- 2-3'),
(1085, 'Uso pedagógico de las tecnologías de la información y la comunicación – Eje 2', 'Ministerio de Educación, Ciencia y Tecnología', 2007, 92, 'libros', '50-002', 5, 'Ministerio de Educación de la Nación', 'TIC F- 2-3'),
(1086, 'Informática infantil 1 – Diccionario', 'Marco Antonio Tiznado', 1999, 92, 'libros', '50-003', 5, 'McGraw-Hill', 'TIC F- 2-3'),
(1096, 'Educar desde el corazón una educación que desarrolla la intuición', 'Puebla Eugenia', 1993, 82, 'LIBROS', '681-067', 5, 'Errepar', 'PROY E-4-4'),
(1097, '¿Dónde está la escuela? Ensayos sobre la gestión institucional en tiempos de turbulencia', 'Duschatzky Silvia, Birgin Alejandra compiladores', 2005, 82, 'LIBROS', '681-068', 5, 'Flasco manantial', 'PROY E-4-4'),
(1099, 'Docentes de la infancia: antropología del trabajo en la escuela.', 'Batallan Graciela', 2007, 82, 'LIBROS', '681-070', 5, 'Paidos', 'PROY E-4-4'),
(1101, 'Curriculum : crisis , mito y perspectiva', 'Alba Alicia', 1998, 82, 'LIBROS', '681-072', 5, 'Niño y Davila editores', 'PROY E-4-4'),
(1105, 'Los procesos de gestión en el acompañamiento a los Docentes noveles.', 'Salinas Susana', 2009, 82, 'LIBROS', '681-076', 5, 'Ministerio de educación', 'PROY E-4-4'),
(1107, 'Educar en la acción para aprender a emprender ( organización y gestión de proyectos socio – productivos y cooperativos )', 'Ferreyra Horacio Ademar, Gallo Griselda Maria, Zecchini Ariel', 2007, 82, 'LIBROS', '681-078', 5, 'Centro de publicaciones educativas Material didáctico', 'PROY E-4-4'),
(1109, 'Estudio del curriculum: casos y métodos.', 'Goodson. Ivor. F, Pons Horacio traducción', 2003, 82, 'LIBROS', '681-080', 5, 'Amorrortu', 'PROY E-4-4'),
(1115, 'Enseñar y aprender matematica propuesta para el Segundo ciclo.', 'Ponce Hector', 2004, 82, 'LIBROS', '681-086', 5, 'Novedades educativas', 'PROY E-4-4'),
(1116, 'Cognación y Curriculum una Visión nueva.', 'Eisner Elliot W', 2007, 82, 'LIBROS', '681-087', 5, 'Amorrotu editores', 'PROY E-4-4'),
(1119, 'Tendencias Sociales y Políticas Contemporáneas ( perspectivas y debates )', 'Fernández Marta, Barbosa Susana', 1996, 82, 'LIBROS', '681-090', 5, 'Fundación universidad a Distancia “Hernandarias”', 'PROY E-4-4'),
(1120, 'Investigación Cualitativa y retos e interrogantes II (técnicas y análisis de datos).', 'Serrano Pérez Gloria', 2007, 82, 'LIBROS', '681-091', 5, 'La Muralla', 'PROY E-4-4'),
(1121, 'Métodos cualitativos y cuantitativos en investigación evaluativa', 'Cook T.D. , Reichardt Ch .S. Solana Guillermo traducción', NULL, 82, 'LIBROS', '681-092', 5, 'Morata Ediciones', 'PROY E-4-4'),
(1124, 'Entre la tecnociencia y el deseo la construcción de una epistemología ampliada', 'Díaz Esther', 2010, 82, 'LIBROS', '681-095', 5, 'Biblos editorial', 'PROY E-4-4'),
(1127, 'Arqueología de los sentimientos en la escuela', 'Santo Guerra Miguel Ángel', 2007, 82, 'LIBROS', '681-098', 5, 'Bonum', 'PROY E-4-4'),
(1131, 'La Ciencia posible propuestas de enseñanza –aprendizaje de las ciencias naturales para segundo ciclo', 'Dicovskiy Gloria, Pinchuk Diana Sargorodschi Ana (coord.)', 2000, 82, 'LIBROS', '681-102', 5, 'Novedades educativas', 'PROY E-4-4'),
(1136, 'Planificando clases interesantes itinerarios para combinar recursos didácticos', 'Spiegel Alejandro', 2006, 82, 'LIBROS', '681-107', 5, 'Centro de publicaciones educativos y material didáctico', 'PROY E-4-4'),
(1137, 'Representaciones, discursos y practicas acerca de Evaluación educativa metaevaluacion y autoevaluación institucional tomo 2', 'Ceballos Marta Susana', 2007, 82, 'LIBROS', '681-108', 5, 'Yammal contenidos', 'PROY E-4-4'),
(1140, 'El ABC de la tarea docente : curriculum y enseñanza', 'Gvirtz Silvia, Palamidesi Marianao', 2008, 82, 'LIBROS', '681-111', 5, 'Aique', 'PROY E-4-4'),
(1147, 'Formación docente y psicopedagogía estrategias y propuestas para la intervención Educativa.', 'Muller Marina', 2008, 82, 'LIBROS', '681-118', 5, 'Bonum', 'PROY E-4-4'),
(1149, 'Una propuesta didáctica para ciencias Sociales del primer ciclo de la E.g, b. La escuela que concurro', 'Svarzman José, González Beatriz, Tallarico Graciela', 1996, 82, 'LIBROS', '681-120', 5, 'Novedades Educativas ediciones', 'PROY E-4-4'),
(1151, 'Apuntes y aportes para la gestión curricular.', 'Poggi Margarita, Ferndez Salinas Dino, Melgar Sara', 1988, 82, 'LIBROS', '681-122', 5, 'Kapelusz', 'PROY E-4-4'),
(1155, 'Como elaborarlos, seleccionarlos y usarlos', 'Aran Parcerisa Artur', 1997, 82, 'LIBROS', '681-126', 5, 'GRAO', 'PROY E-4-4'),
(1162, 'La aventura de enseñar Ciencias Naturales', 'Furman Melina, Podestá Maria Eugenia', 2009, 82, 'LIBROS', '681-133', 5, 'Aique', 'PROY E-4-4'),
(1163, 'El diagnostico en el aula conceptos, procedimientos, actitudes', 'Lucchetti Elena, Berlanda Omar', 1999, 82, 'LIBROS', '681-134', 5, 'Magisterio del rio de la plata', 'PROY E-4-4'),
(1165, 'Pensar, descubrir y aprender Propuesta didáctica y actividades para las ciencias Sociales.', 'Camilloni Alicia, Levinas Marcelo Leonardo', 2007, 82, 'LIBROS', '681-136', 5, 'Aique', 'PROY E-4-4'),
(1171, 'Estructuración psíquica y subjetivación del niño de escolaridad primaria el trabajo de la lactancia', 'Urribari Rodolfo', 2008, 82, 'LIBROS', '681-142', 5, 'Centro de publicaciones educativas y material didáctico', 'PROY E-4-4'),
(1173, 'Tesis, tesinas, monografías e informes Nuevas normas y técnicas de investigación y redacción', 'Bota Mirta, Warley Jorge', 2007, 82, 'LIBROS', '681-144', 5, 'Biblos editorial', 'PROY E-4-4'),
(1177, 'Didactica de la lengua ¿cómo enseñar? ¿Cómo aprender?', 'Lucchetti Elena', 2008, 82, 'LIBROS', '681-148', 5, 'Bonum', 'PROY E-4-4'),
(1182, 'Entre líneas teorías y enfoques en la enseñanza de la escritura, la gramática y la literatura', 'Alvarado Maite (coordinadora), Bombini Gustavo, Cortez Marina', 2006, 82, 'LIBROS', '681-153', 5, 'Flasco Manantial', 'PROY E-4-4'),
(1187, 'Educacion matemática y ciudadanía', 'Goñi Jesús Maria, Callejo Maria Luz (Coord.)', 2010, 82, 'LIBROS', '681-158', 5, 'Grao', 'PROY E-4-4'),
(1197, 'El estudio de las figuras y los cuerpos geométricos Actividades para los primeros años de la escolaridad', 'Briotman Claudia, Itzcovich Horacio', 2007, 82, 'LIBROS', '681-168', 5, 'Centro de publicaciones educativos y material didáctico', 'PROY E-4-4'),
(1198, 'Didactica de la lengua ¿cómo aprender? ¿Cómo enseñar?', 'Luchetti Elena', 2006, 82, 'LIBROS', '681-169', 5, 'Bonum', 'PROY E-4-4'),
(1201, 'Los CBC y la enseñanza de la lengua', 'Alvarado Maite, Braslavsky Berta, Ize Josefina', 1998, 82, 'LIBROS', '681-172', 5, 'A-Z editorial', 'PROY E-4-4'),
(1205, 'Didactica de las Ciencias Naturales ¿Cómo aprender? ¿Cómo enseñar?', 'Tricarico hugo Roberto', 2005, 82, 'LIBROS', '681-176', 5, 'Bonum', 'PROY E-4-4'),
(1213, 'Didactica de la Geografía problemas sociales y conocimiento del medio', 'González Souto Xose Manuel', 1999, 82, 'LIBROS', '681-184', 5, 'Del Serbal Ediciones', 'PROY E-4-4'),
(1215, 'Programa Nacional de Mediación Escolar actividades para el aula', 'García Costoya Maria', 2005, 82, 'LIBROS', '681-186', 5, 'Ministerio de educación, Ciencia y tecnología de la nación', 'PROY E-4-4'),
(1217, 'Como redactar un tema didáctica de la escritura', 'Scrafini Maria teresa', 1993, 82, 'LIBROS', '681-188', 5, 'Paidos', 'PROY E-4-4'),
(1218, 'Como se aprende, como se enseña, la lengua escrita', 'Ortiz Dora, Rabino Alicia', 2003, 82, 'LIBROS', '681-189', 5, 'Lugar editorial', 'PROY E-4-4'),
(1219, 'Sociedad, cultura y educación', 'Giroux Henry, Mclaren Peter', 1998, 82, 'LIBROS', '681-190', 5, 'Miño y Dávila editores', 'PROY E-4-4'),
(1220, 'Taller de lectura De la oralidad a la escritura', 'Actis Beatriz', 2003, 82, 'LIBROS', '681-191', 5, 'Homo Sapiens ediciones', 'PROY E-4-4'),
(1221, 'Recorridos didácticos en la educación inicial.', 'Malajovich Ana', 2000, 82, 'LIBROS', '681-192', 5, 'Paidos', 'PROY E-4-4'),
(1225, 'La construcción de taller de escritura en la escuela, la biblioteca, el club.', 'Lardone Lilia, Andruetto Maria Teresa', 2005, 82, 'LIBROS', '681-196', 5, 'Homo Sapiens', 'PROY E-4-4'),
(1230, 'Todos pueden aprender lengua y anatematicé', 'UNICEF', 2007, 82, 'LIBROS', '681-201', 5, 'UNICEF', 'PROY E-4-4'),
(1234, 'Puedo escribir un YO cuento, taller de práctica de compresión y producción lingüística', 'Pérez Elena del Carmen', 2005, 82, 'LIBROS', '681-205', 5, 'Comunicarte', 'PROY E-4-4'),
(1237, 'Con ton y con son la lengua materna en la educación inicial', 'Stapich Elena', 2001, 82, 'LIBROS', '681-208', 5, 'Aique', 'PROY E-4-4'),
(1240, 'Narrativas de Experiencias pedagógicas', 'Pereyra Alexia, Monasterio Ana Maria, Páez Daniela', 2008, 82, 'LIBROS', '681-211', 5, 'C.A.I.E.', 'PROY E-4-4'),
(1241, 'Textos, tejidos y tramas en el taller de lectura y escritura., el piolín y los nudos', 'Stapich Elena (coord.) Hermida Carola, Segretin Claudia', 2008, 82, 'LIBROS', '681-212', 5, 'Novedades educaivas', 'PROY E-4-4'),
(1242, 'La mirada del lince ( Diego Hurtado de Mendoza )', 'Ministerio de educación Ciencia y tecnología', NULL, 82, 'LIBROS', '681-213', 5, 'Ministerio de Educacion Ciencia y tecnología', 'PROY E-4-4'),
(1244, 'Propuesta para el aula tecnología', 'Ministerio de educación', NULL, 82, 'LIBROS', '681-215', 5, 'Ministerio de educación', 'PROY E-4-4'),
(1245, 'Rumbo a la lectura', 'Cirianni Gerardo, Peregrina Luz Maria', NULL, 82, 'LIBROS', '681-216', 5, 'Colihue', 'PROY E-4-4'),
(1246, 'Lecturas, familias y escuelas Hacia una comunidad de lectores y escritores', 'Actis Beatriz', 2008, 82, 'LIBROS', '681-217', 5, 'Homo Sapiens', 'PROY E-4-4'),
(1247, 'Ricon gaucho en la escuela La Argentina rural contada por los chicos', 'Ministerio de educación ciencia y tecnología de nación', 2006, 82, 'LIBROS', '681-218', 5, 'Ministerio de Educacion ciencia y tecnología de nación', 'PROY E-4-4'),
(1248, 'Leer por leer 2', 'Ministerio de educación Ciencia y tecnología de la nación', 2004, 82, 'LIBROS', '681-219', 5, 'Ministerio de Educacion Ciencia y tecnología de la nación', 'PROY E-4-4'),
(1249, 'Leer por leer lecturas para estudiantes 3', 'Ministerio de educación Ciencia y tecnología de la Nación', 2004, 82, 'LIBROS', '681-220', 5, 'Ministerio de educación Ciencia y tecnología de la nación', 'PROY E-4-4'),
(1250, 'Leer por leer 4 (lecturas para estudiantes).', 'Ministerio educación Ciencia y tecnología', 2004, 82, 'LIBROS', '681-221', 5, 'Ministerio Educacion Ciencia y tecnología de la Nación', 'PROY E-4-4'),
(1251, 'Leer por leer 5 (lectura para estudiantes).', 'Ministerio educación Ciencia y tecnología de la Nación', 2004, 82, 'LIBROS', '681-222', 5, 'Ministerio educación Ciencia y tecnología de la Nación', 'PROY E-4-4'),
(1255, 'La emergencia de los pueblos originarios en san Juan y su incidencia en el sistema educativo.', 'Lic. Lucero Silvia, Magister Lic. Casas José', 2010, 82, 'LIBROS', '681-226', 5, 'Instituto de formación docente Jáchal, san Juan', 'PROY E-4-4'),
(1258, 'Educacion para la salud', 'Cuniglio Francisco, Barderi Maria Gabriela, Fernández Eduardo', 2000, 82, 'LIBROS', '681-229', 5, 'Santillana', 'PROY E-4-4'),
(1260, 'El desafío del trabajo en Red para resinificar las practicas de enseñanza', 'Mónica Vives, Monasterio Anamaria, Femenia Gladys', 2006, 82, 'LIBROS', '681-231', 5, 'IFDC Esc. Normal sup gral. Manuel Belgrano', 'PROY E-4-4'),
(1261, 'El Cuaderno del cartógrafo ( guía para saber mas) 4', 'Forchi Miguel Ángel', 2012, 82, 'LIBROS', '681-232', 5, 'Puerto palos', 'PROY E-4-4'),
(1262, 'Ciencias Sociales 4 ( proyecto de aprendizaje)', NULL, NULL, 82, 'LIBROS', '681-233', 5, 'A-Z', 'PROY E-4-4'),
(1263, 'Aprendo en tercero 3 matematica ciencias sociales, ciencias naturales.', 'Benchimol Karina, Heredia Gabriela. (Et. al)', 2009, 82, 'LIBROS', '681-234', 5, 'Tinta fresca', 'PROY E-4-4'),
(1264, 'La Lengua oral en la educción inicial', 'Miretti Maria Luisa', 2003, 82, 'LIBROS', '681-235', 5, 'Homo Sapiens ediciones', 'PROY E-4-4'),
(1265, 'La cuestión de la infancia Entre la escuela la calle y le shopping', 'Carli Sandra (compiladora)', 2006, 82, 'LIBROS', '681-236', 5, 'Paidos', 'PROY E-4-4'),
(1266, 'Las Ciencias Sociales en el jardín de infantes (unidas didácticas y proyectos )', 'Goris Beatriz', 2009, 82, 'LIBROS', '681-237', 5, 'Homo Sapiens', 'PROY E-4-4'),
(1267, 'Leer y escribir a los 5', 'Manrique Ana Maria', 2007, 82, 'LIBROS', '681-238', 5, 'Aique', 'PROY E-4-4'),
(1268, 'Entre los pañales y la letras Acercamientos a la educción inicial', 'Cuberes Gonzales Maria Teresa', 2008, 82, 'LIBROS', '681-239', 5, 'Aique', 'PROY E-4-4'),
(1269, '¿De qué están hechas las cosas? Juguemos con la materia y los materiales', 'Mason Adrienne, Davila', NULL, 82, 'LIBROS', '681-240', 5, 'Albatros', 'PROY E-4-4'),
(1270, 'La sala multiedad en la educación inicial una propuestas de lecturas multiples', 'Ministerio de educación Ciencia y tecnología de la Nación', 2007, 82, 'LIBROS', '681-241', 5, 'Ministerio de Educacion Ciencia y tecnología de la nación', 'PROY E-4-4'),
(1271, 'Ciencias Sociales líneas de acción didáctica y perspectivas epistemológicas.', 'Insaurralde Mónica Borsotti Carlos, Ramos Mariano', 2009, 82, 'LIBROS', '681-242', 5, 'Centro de publicaciones Educativas y material didáctico', 'PROY E-4-4'),
(1272, 'Educación sexual desde la primera infancia.( información, salud y prevención)', 'Ravinovich Josefina', 2009, 82, 'LIBROS', '681-243', 5, 'Centro publicaciones Educativas y material didáctico', 'PROY E-4-4'),
(1273, 'La Planificación didáctica en el jardín de infantes Las unidades didácticas los proyectos y las secuencias didáctica el juego trabajo', 'Pitluk Laura', 2012, 82, 'LIBROS', '681-244', 5, 'Homo Sapiens ediciones', 'PROY E-4-4'),
(1274, 'Las Prácticas actuales en la Educacion Inicial. Sentidos y sinsentidos .posibles líneas de acción la autoridad, las sanciones y los limites.', 'Pitluk Laura', 2013, 82, 'LIBROS', '681-245', 5, 'Homo Sapiens ediciones', 'PROY E-4-4'),
(1275, 'Ciencias Naturales una aproximación al conocimiento del entorno natural', 'Itkin Silvia Nora (comp.)', 1999, 82, 'LIBROS', '681-246', 5, 'Novedades educativas', 'PROY E-4-4'),
(1276, 'Desarmar para armar Propuesta innovadoras para la educación infantil.', 'Violante Rosa', 2002, 82, 'LIBROS', '681-247', 5, 'Novedades educativas', 'PROY E-4-4'),
(1277, 'Didácticas de las Ciencias Naturales en el nivel inicial', 'Golcalves Susana, Segura Andrea y Mosquera Marcela', 2010, 82, 'LIBROS', '681-248', 5, 'Bonum', 'PROY E-4-4'),
(1278, 'La Educacion Física en el nivel Inicial.', 'Naveiras Daniel, Prof. Franchina Alicia', 1988, 82, 'LIBROS', '681-249', 5, 'La obra ediciones', 'PROY E-4-4'),
(1279, 'La Alfabetización inicial en escuelas de contexto rural', 'Belli Rosana, Molina Sandra, Monasterio Anamaria', 2009, 82, 'LIBROS', '681-250', 5, 'EL Viñatero taller grafico', 'PROY E-4-4'),
(1280, 'Educacion Inicial cuidando el cuerpo la salud de nuestros alumnos. Proyecto acercarte a la música', 'Cralé Soledad', 2002, 82, 'LIBROS', '681-251', 5, 'Publicación de ediciones la obra', 'PROY E-4-4'),
(1281, 'Ciencias y tecnologías para niños investigadores', NULL, 2002, 82, 'LIBROS', '681-252', 5, 'Novedades educativas', 'PROY E-4-4'),
(1282, 'Educacion vial Actividades para alumnos y alumnas', 'Agencia Nacional de Seguridad Vial. Ministerio de educación de la nación', NULL, 82, 'LIBROS', '681-253', 5, 'Ministerio de educación de la nación', 'PROY E-4-4'),
(1283, 'Didáctica de la matematica en el nivel inicial', 'Cabanne Nora Edith, Ribaya Maria Teresa', 2009, 82, 'LIBROS', '681-254', 5, 'Bonum', 'PROY E-4-4'),
(1284, 'De todas las distancias de mi tierra', 'Eusebio de Jesús Dojorti', 2006, 82, 'LIBROS', '681-255', 5, 'Dirección de educación Superior red federal de formación docente. Continua. secretaria de educación', 'PROY E-4-4'),
(1285, 'Matematica para los más chicos (Discusiones y proyecto para la enseñanza del espacio, geometría y el numero)', 'Castro Adriana, Penas Fernanda', 2009, 82, 'LIBROS', '681-256', 5, 'Centro de publicaciones Educativas y material didáctico', 'PROY E-4-4'),
(1286, 'Títeres y resiliencia en el nivel inicial un desafío para afrontar la adversidad', 'Cruz Santa Elena, Labandal Livia García', 2008, 82, 'LIBROS', '681-257', 5, 'Homo sapiens ediciones', 'PROY E-4-4'),
(1287, 'Títeres en la Escuela Expresión, juego y comunicación', 'Rogozinski Viviana', 2001, 82, 'LIBROS', '681-258', 5, 'Novedades educativas', 'PROY E-4-4'),
(1288, 'Nivel inicial juego – trabajo en red. Ideas y propuestas renovadas para aplicar en la sala', 'Volodarski Graciela', 2006, 82, 'LIBROS', '681-259', 5, 'La Crujia', 'PROY E-4-4'),
(1289, 'La educación después del estado. Nación', 'Garcés Luis, Mare Alejandra', 2017, 82, 'LIBROS', '681-260', 5, 'Colihue', 'PROY E-4-4'),
(1290, 'Como enseñar a pensar teoría y aplicación', 'Raths Louis, Wassermann Selma', 1993, 82, 'LIBROS', '681-261', 5, 'Paidos', 'PROY E-4-4'),
(1291, 'LEY 1420 ( TOMO 1 ) 1883-1884 ( debate parlamentario )', 'Weinberg Gregorio', NULL, 82, 'LIBROS', '681-262', 5, 'Centro editor de América latina', 'PROY E-4-4'),
(1292, 'Ley 1420 (tomo 2) 1883- 1884(debate parlamentario).', 'Weinberg Gregorio', NULL, 82, 'LIBROS', '681-263', 5, 'Centro editor de América latina', 'PROY E-4-4'),
(1294, '“ La opción de educar y la responsabilidad pedagógica”', 'Meirieu Philippe Conferencia', 2013, 82, 'LIBROS', '681-265', 5, 'Ministerio de educación', 'PROY E-4-4'),
(1296, 'Investigación Científicas en la escuela', 'Bazo Raúl Horacio , Santiago Alberto', NULL, 93, 'libros', '60-001', 5, 'Plus ultra', 'INVEST G-3-1'),
(1297, 'Sobre tesis y tesistas lecciones de enseñanza-aprendizaje', 'Mendicoa Gloria', 2003, 93, 'libros', '60-002', 5, 'Espacio editorial', 'INVEST G-3-1'),
(1298, 'Representaciones , discursos y practicas acerca de Evaluación educativa metaevaluacion y autoevaluación institucional tomo 2', 'Ceballos Marta Susana', 2007, 93, 'libros', '60-003', 5, 'Yammal contenidos', 'INVEST G-3-1'),
(1299, 'Proyecto de investigación “ Escuela Y Marginación Doble violencia', 'Vallejos Adriana , Busticchi Mirtha , Bovero Maria Laura', 1998, 93, 'libros', '60-004', 5, 'Acción educativa', 'INVEST G-3-1'),
(1300, 'Metodologías cualitativas en ciencias sociales modelos y procedimientos de análisis', 'Kornblit Ana lía', 2007, 93, 'libros', '60-005', 5, 'BIBLOS editorial', 'INVEST G-3-1'),
(1301, 'El pensamiento crítico en la escuela', 'Castellano Hugo Martin', 2007, 93, 'libros', '60-006', 5, 'Prometeo libros', 'INVEST G-3-1'),
(1302, 'Pensando las instituciones sobre teorías y prácticas en educación', 'Corbalán Alicia de Mezzano , Souto Marta , Butelman Ida (compiladora)', 2010, 93, 'libros', '60-007', 5, 'Paidos', 'INVEST G-3-1'),
(1303, 'El curriculum oculto en la escuela “ la pobreza condiciona peor no determina”', 'Angelini González Silvia , Landaburu Elena Rio , Rosales Silvia', 2005, 93, 'libros', '60-008', 5, 'Lumen', 'INVEST G-3-1'),
(1304, 'La educación y la gestión de los conflictos mediar: ¿Cómo y para qué?', 'Aguilar Marcela', 2011, 93, 'libros', '60-009', 5, 'Concepto', 'INVEST G-3-1'),
(1305, 'Teorías e instituciones contemporáneas de educación.', 'Carreño Miryam (editora) Orzaes Carmen', NULL, 93, 'libros', '60-010', 5, 'Colmenar Síntesis educativas', 'INVEST G-3-1'),
(1306, 'Instituciones educativas dinámicas institucionales en situaciones criticas', 'Fernández Lidia', 1994, 93, 'libros', '60-011', 5, 'Paidos', 'INVEST G-3-1'),
(1308, '¿Ocaso de la escuela?', 'Follari Roberto', 1996, 93, 'libros', '60-013', 5, 'Magisterio del rio de la plata.', 'INVEST G-3-1'),
(1309, 'El análisis de institución educativa hilos para tejer proyectos', 'Frigerio Graciela , Poggi Margarita', 2003, 93, 'libros', '60-014', 5, 'Santillana', 'INVEST G-3-1'),
(1312, 'La tragedia Educativa', 'Etcheverry Guillermo Jaim', 2002, 93, 'libros', '60-017', 5, 'Fondo cultura económica', 'INVEST G-3-1'),
(1313, 'Una escuela en y para la diversidad el entramado de la diversidad', 'Devalle de Rendo Alicia , Vega Viviana', 2006, 93, 'libros', '60-018', 5, 'Aique', 'INVEST G-3-1'),
(1314, 'El diagnostico en el aula conceptos , procedimientos , actitudes', 'Lucchetti Elena, Berlanda Omar', 1999, 93, 'libros', '60-019', 5, 'Magisterio del rio de la plata.', 'INVEST G-3-1'),
(1315, 'El proceso de investigación', 'Sabino Carlos', 2011, 93, 'libros', '60-020', 5, 'Lumen Editorial', 'INVEST G-3-1'),
(1316, 'Las inteligencias múltiples en el aula', 'Armstrong Thomas', 1999, 93, 'libros', '60-021', 5, 'Manantial', 'INVEST G-3-1'),
(1317, 'Aprender en tiempos revueltos la nueva ciencia del aprendizaje', 'Pozo Juan Ignacio', 2018, 93, 'libros', '60-022', 5, 'Alianza Editorial', 'INVEST G-3-1'),
(1319, 'La querella de los métodos en la enseñanza de la lectura', 'Braslavsky Berta', 1962, 93, 'libros', '60-024', 5, 'Kapelusz', 'INVEST G-3-1'),
(1320, 'Métodos de enseñanza didáctica general para maestros y profesores', 'Davini Maria Cristina', 2018, 93, 'libros', '60-025', 5, 'Santillana', 'INVEST G-3-1'),
(1321, 'Diez nuevas competencias para enseñar invitación al viaje', 'Perrenoud Philippe', 2010, 93, 'libros', '60-026', 5, 'Grao', 'INVEST G-3-1'),
(1322, 'Tesis , tesinas , monografías e informes Nuevas normas y técnicas de investigación y redacción', 'Bota Mirta , Warley Jorge', 2007, 93, 'libros', '60-027', 5, 'Biblos editorial', 'INVEST G-3-1'),
(1323, 'Escuela y pobreza Entre el desasosiego y la obstinación', 'Redondo Patricia', 2004, 93, 'libros', '60-028', 5, 'Paidos', 'INVEST G-3-1'),
(1327, 'La Posciencia el conocimiento científico en las postrimerías de la modernidad', 'Luque Susana de , Giordano Mónica , Díaz Esther (editora)', 2007, 93, 'libros', '60-032', 5, 'Biblos', 'INVEST G-3-1'),
(1328, 'Adquision de la lectoescritura. Revisión crítica de métodos y teorías', 'Daviña Lila R.', 1999, 93, 'libros', '60-033', 5, 'Homo Sapiens ediciones', 'INVEST G-3-1'),
(1329, '¿Cómo compreder el mundo? Propuesta para el aula.', 'Ministerio de educción de la Nación', 2013, 82, 'LIBROS', '681-267', 5, 'Ministerio de educción de la nación', 'PROY E-4-4'),
(1334, 'Yendo de la tiza al mouse Manual de informática educativa para docentes no informáticos', 'Rexach Vera, Asinsten Juan Carlos', 1999, 82, 'LIBROS', '681-272', 5, 'Novedades educativas', 'PROY E-4-4'),
(1335, 'Nuevo Análisis de la Sociedad del aprendizaje.', 'Husen Torten', 1998, 82, 'LIBROS', '681-273', 5, 'Paidos', 'PROY E-4-4'),
(1336, 'La Formación en la práctica Docente', 'Davini Maria Cristina', 2015, 82, 'LIBROS', '681-274', 5, 'Paidos', 'PROY E-4-4'),
(1339, 'Educacion para el cambio social.', 'Freire Paulo, ILlich Iván, Furter Pierre', NULL, 82, 'LIBROS', '681-277', 5, 'Tierra nueva', 'PROY E-4-4');
INSERT INTO `materiales` (`id`, `titulo`, `autor`, `anio_publicacion`, `area_id`, `categoria`, `codigo`, `disponibilidad`, `editorial`, `clasificacion_fisica`) VALUES
(1342, 'Educacion física, movimiento y curriculum.', 'Arnold J. Peter, Solana Guillermo traducio', 1997, 82, 'LIBROS', '681-280', 5, 'Morata, Ediciones', 'PROY E-4-4'),
(1343, 'La Iniciación deportiva y el deporte escolar.', 'Sánchez Blázquez Domingo', 1999, 82, 'LIBROS', '681-281', 5, 'Inde', 'PROY E-4-4'),
(1348, 'La estructura del discurso pedagógico (Clases, códigos y control )', 'Bernstein Basil', 1994, 82, 'LIBROS', '681-286', 5, 'Morata ediciones', 'PROY E-4-4'),
(1349, 'El curriculum una reflexión sobre la práctica.', 'Sacristan Gimeno J', 1991, 82, 'LIBROS', '681-287', 5, 'Morata ediciones', 'PROY E-4-4'),
(1351, 'Enseñar voleibol para jugar en equipo', 'Bonnefoy Georges, Lahuppe Henri, Ne Robert', 2000, 82, 'LIBROS', '681-289', 5, 'Inde publicaciones', 'PROY E-4-4'),
(1353, 'Deporte y Ciencia teoría de la actividad Fisica', 'López Rodríguez Juan', 1998, 82, 'LIBROS', '681-291', 5, 'Inde publicaciones', 'PROY E-4-4'),
(1354, 'Juguemos en el jardín El juego y la actividad Fisica en la educación inicial', 'Incarbone Oscar', 2013, 82, 'LIBROS', '681-292', 5, 'Stadium', 'PROY E-4-4'),
(1355, 'La Educacion fisica en la Educacion Básica', 'Vázquez Benilde', NULL, 82, 'LIBROS', '681-293', 5, 'Gymnos editorial', 'PROY E-4-4'),
(1356, 'Evaluar en Educacion Fisica', 'Sánchez Blazquez Domingo', 1999, 82, 'LIBROS', '681-294', 5, 'Inde publicaciones', 'PROY E-4-4'),
(1357, 'Programas de unidades didácticas según ambientes de aprendizaje', 'Ángel Blández Julia', 2000, 82, 'LIBROS', '681-295', 5, 'Inde publicaciones', 'PROY E-4-4'),
(1358, 'Prevención del consumo problemático de Drogas un enfoque educativo', 'Touzé Graciela', 2010, 82, 'LIBROS', '681-296', 5, 'Troquel editorial', 'PROY E-4-4'),
(1359, 'Programa de educación tecnología guía didáctica', 'Colectivo “ inventar en la Escuela”', 1990, 82, 'LIBROS', '681-297', 5, 'Ediciones de la torre', 'PROY E-4-4'),
(1361, 'Tecnologías audiovisuales y educción Una visión de la practica', 'Ruiz Campuzano Antonio', 1992, 82, 'LIBROS', '681-299', 5, 'Akal', 'PROY E-4-4'),
(1366, 'Trabajos elementales sobre la Escuela primaria.', 'Querrien Anne, Varela julia traducción', NULL, 82, 'LIBROS', '681-304', 5, 'La Piqueta', 'PROY E-4-4'),
(1369, 'Resolución de problemas matemáticas', 'Ministerio de Educacion Ciencia y tecnología', NULL, 82, 'LIBROS', '681-307', 5, 'Ministerio de educación y tecnología', 'PROY E-4-4'),
(1371, 'Proyectos y Metodologías de la investigación.', 'Lorenzo Maria Rosa, Zangaro Marcela', 2004, 82, 'LIBROS', '681-309', 5, 'Aula taller Ediciones', 'PROY E-4-4'),
(1373, 'Identidad Cultural y tecnología juicio ético a la modernización', 'Azcuy Eduardo', 1994, 82, 'LIBROS', '681-311', 5, 'Docencia Editorial', 'PROY E-4-4'),
(1374, 'DISEÑOS CURRICULARES Diseño Curricular educación Primaria tomo 1 de 2', 'Ministerio de Educacion Gobierno de San Juan', 2016, 82, 'LIBROS', '681-312', 5, 'Gobierno de San Juan', 'PROY E-4-4'),
(1375, 'Diseño Curricular Educacion Primaria tomo 2 DE 2', 'Ministerio de Educacion Gobierno de San Juan', 2016, 82, 'LIBROS', '681-313', 5, 'Gobierno de San Juan', 'PROY E-4-4'),
(1376, 'Diseño Jurisdiccional educación Primaria Dirección de educación inicial, primaria educación privada.', 'Ministerio de Educacion Secretaria de Educación. Gobierno de San Juan', 2015, 82, 'LIBROS', '681-314', 5, 'Gobierno de San Juan', 'PROY E-4-4'),
(1377, 'Diseño Curricular de educación inicial jardín maternal 1 ciclo', 'Misterio de educación', NULL, 82, 'LIBROS', '681-315', 5, 'Gobierno de San Juan', 'PROY E-4-4'),
(1378, 'Diseño Curricular de educación Inicial jardín maternal parte 2', 'Misterio de Educacion', NULL, 82, 'LIBROS', '681-316', 5, 'Gobierno de San Juan', 'PROY E-4-4'),
(1379, 'Diseño Curricular de Educacion inicial.', 'Misterio de Educación', NULL, 82, 'LIBROS', '681-317', 5, 'Gobierno de San Juan', 'PROY E-4-4'),
(1380, 'La zona de construcción del conocimiento : trabajando por un cambio cognitivo en educación', 'Newman Denis, Griffin Peg, Cole Michael', 1991, 82, 'LIBROS', '681-318', 5, 'Morata Ediciones', 'PROY E-4-4'),
(1384, 'Miradas sobre el mundo de la Matematica. Una curiosa selección de textos', 'Ministerio de Educacion, Ciencia y tecnología', 2007, 82, 'LIBROS', '681-322', 5, 'Editorial Universitaria de Buenos Aires. Sociedad de Economía Mixta', 'PROY E-4-4'),
(1385, 'Recomendaciones metodológicas para la enseñanza ( ciencias Naturales )', 'Ministerio de Educación', 2008, 82, 'LIBROS', '681-323', 5, 'Ministerio de Educación', 'PROY E-4-4'),
(1389, 'Normativas leyes nacionales y resoluciones del consejo Federal de Educacion', 'Ministerio de educación de la Nación', NULL, 82, 'LIBROS', '681-327', 5, 'Ministerio de Educacion de la nación', 'PROY E-4-4'),
(1391, 'Nouvelle Introduction a la didactique du francais langue etragere.', 'Boyer Henri, Rivera Butzbach Michele, Pendanx Michele', 1999, 82, 'LIBROS', '681-329', 5, 'Cle International', 'PROY E-4-4'),
(1392, 'Ideas Cientificas en la infancia y la adolescencia', 'Driver Rosalind, Guesne Edith, Tiberghien Andrée', 1999, 82, 'LIBROS', '681-330', 5, 'Morata Ediciones', 'PROY E-4-4'),
(1397, 'Educacion Tecnológica Espacio en el aula.', 'Fraga Rodríguez Abel', 1999, 82, 'LIBROS', '681-335', 5, 'Aique', 'PROY E-4-4'),
(1404, 'Entre líneas teorías y enfoques en la enseñanza de la escritura , la gramática y la literatura', 'Alvarado Maite (coordinadora), Bombini Gustavo, Cortez Marina.', 2006, 93, 'libros', '60-034', 5, 'Flacso Manantial', 'INVEST G-3-1'),
(1405, 'Entre líneas teorías y enfoques en la enseñanza de la escritura. la gramática y la Literatura', 'Alvarado Maite (coordinadora)', 2009, 93, 'libros', '60-035', 5, 'Flacso Manantial', 'INVEST G-3-1'),
(1406, 'Pensar la didáctica', 'Díaz, Barriga Ángel.', 2009, 93, 'libros', '60-036', 5, 'Amorrotu editores', 'INVEST G-3-1'),
(1411, '¿Primeras letras o primeras Lecturas? una introducción a la alfabetización tempana', 'Braslavsky Berta.', 2007, 93, 'libros', '60-041', 5, 'Fondo de cultura economica', 'INVEST G-3-1'),
(1413, 'El carácter algebraico de la aritmética de las ideas de los niños a las actividades en el aula', 'Schlieman Analucia D. , Carraher David W, Brizuela Barbara M', 2011, 93, 'libros', '60-043', 5, 'Paidos', 'INVEST G-3-1'),
(1418, 'La Matematica escolar las practicas de enseñanza en el aula', 'Itzcovich Horacio (Coord.) Moreno Ressia Beatriz, Novembre Andrea.', 2009, 93, 'libros', '60-048', 5, 'Aique', 'INVEST G-3-1'),
(1427, 'El grito manso', 'Friere Paulo', 2009, 93, 'libros', '60-047', 5, 'XXI siglo veintiuno', 'INVEST G-3-1'),
(1435, 'Una base segura : Aplicaciones clínica de una teoría del apego', 'Bowlby John', 2009, 93, 'libros', '60-055', 5, 'Paidos', 'INVEST G-3-1'),
(1436, 'La pasantía una alternativa de acompañamiento a profesores de Matematica.', 'Grande Carlos.', 2012, 93, 'libros', '60-056', 5, 'Ministerio de educación de la Nación', 'INVEST G-3-1'),
(1438, 'Didactica de las Ciencias naturales enseñar a enseñar Ciencias Naturales', 'Liguori Liliana, Noste Maria Irene.', 2005, 93, 'libros', '60-058', 5, 'Homo sapiens editorial', 'INVEST G-3-1'),
(1439, 'Mejorar la escuela acerca de la gestión y la enseñanza.', 'Silvia Gvirtz , Podestá Maria Eugenia (compiladoras )', 2004, 93, 'libros', '60-059', 5, 'Granica', 'INVEST G-3-1'),
(1440, 'Estrategias de investigación cualitativa', 'Gialdino Irene Vasilachis (coord.)', 2007, 93, 'libros', '60-060', 5, 'Gedisa Editorial', 'INVEST G-3-1'),
(1441, 'La formación docente en alfabetización inicial ( 2009- 2010)', 'Ministerio de Educacion de la Nación', 2010, 93, 'libros', '60-061', 5, 'Ministerio de Educacion de la Nación', 'INVEST G-3-1'),
(1442, 'Por la vuelta estrategias para acompañar las trayectorias escolares', 'Ministerio de educación de la nación', 2010, 93, 'libros', '60-062', 5, 'Ministerio de educación de la nación', 'INVEST G-3-1'),
(1443, 'La formación docente en alfabetización inicial como objeto de investigación', 'Zamero Marta', 2010, 93, 'libros', '60-063', 5, 'Ministerio de Educacion Ciencia y tecnología de la nación', 'INVEST G-3-1'),
(1444, 'Las certezas perdidas padres y maestras ante los desafíos del presente', 'Vasen Juan', 2008, 93, 'libros', '60-064', 5, 'Paidos', 'INVEST G-3-1'),
(1445, 'Método y antimetodo Proceso y diseño de la investigación interdisciplinaria ciencias humanas', 'Calello Hugo , Nauraos Susana', 1999, 93, 'libros', '60-065', 5, 'Colihue', 'INVEST G-3-1'),
(1446, 'Como se aprende , como se enseña , la lengua escrita', 'Ortiz Dora , Rabino Alicia', 2003, 93, 'libros', '60-066', 5, 'Lugar editorial', 'INVEST G-3-1'),
(1447, 'Sociedad , cultura y educación', 'Giroux Henry , Mclaren Peter', 1998, 93, 'libros', '60-067', 5, 'Miño y Dávila editores', 'INVEST G-3-1'),
(1448, 'El juego en el aprendizaje de la escritura. Fundamentación de las estrategias lúdicas', 'Motta Iris M. , Risueño Alicia', 2008, 93, 'libros', '60-068', 5, 'Bonum', 'INVEST G-3-1'),
(1449, 'Oralidad y escritura tecnología de la palabra.', 'Ong j .Walter', 2000, 93, 'libros', '60-069', 5, 'Fondo de cultura economica', 'INVEST G-3-1'),
(1450, 'La Escritura puede una larga experiencia en la enseñanza de la lengua escrita.', 'Braslavsky Berta.', 2008, 93, 'libros', '60-070', 5, 'Aique', 'INVEST G-3-1'),
(1451, 'Imaginación y escritura, la enseñanza de la escritura en la escuela.', 'Frugoni Sergio', 2006, 93, 'libros', '60-071', 5, 'Libros del zorzal.', 'INVEST G-3-1'),
(1452, 'Leer y escribir entre dos culturas el caso de las comunidades kollas del nordeste argentino', 'Borzone de Manrique Ana Maria, Rosemberg Cecilia.', 2000, 93, 'libros', '60-072', 5, 'Aique', 'INVEST G-3-1'),
(1453, 'Acción, pensamiento y lenguaje.', 'Bruner Jerone', 1998, 93, 'libros', '60-073', 5, 'Alianza Editorial', 'INVEST G-3-1'),
(1454, 'Narrativas de experiencias Pedagógicas II', 'Ferreyra Irene , Pucheta Analia , Mirrales Marta , Posse Nancy , otros', NULL, 93, 'libros', '60-074', 5, 'Ministerio de educación', 'INVEST G-3-1'),
(1455, 'Educacion lingüista Integral (lectura, escritura, oralidad).', 'Di tulio Ángela, Avalos Magdalena.', 2003, 93, 'libros', '60-075', 5, 'Comunic .arte', 'INVEST G-3-1'),
(1456, 'Leer y Escribir ficción en la Escuela. Recorridos para escritores en formación', 'Marzo di. Laura C.', 2013, 93, 'libros', '60-076', 5, 'Paidos', 'INVEST G-3-1'),
(1457, 'Iniciación a la lectoescritura teoría y practica', 'Manrique Ana m. Borzone , Gramigna Susana', 1987, 93, 'libros', '60-077', 5, 'El ateneo', 'INVEST G-3-1'),
(1458, 'La Pragmática lingüística el estudio del uso del lenguaje', 'Reyes Graciela', 1994, 93, 'libros', '60-078', 5, 'Montesinos', 'INVEST G-3-1'),
(1459, 'La escritura literaria cómo y qué leer para escribir', 'Suarez Patricia', 2002, 93, 'libros', '60-079', 5, 'Homo Sapiens', 'INVEST G-3-1'),
(1460, 'Estudio del lenguaje y enseñanza de la lengua.', 'Nora Mugica', 2006, 93, 'libros', '60-080', 5, 'Homo sapiens', 'INVEST G-3-1'),
(1461, 'Practicas de lectura y escritura entre la escuela media y los estudios superiores', 'Ministerio de educación ciencia y tecnología', 2007, 93, 'libros', '60-081', 5, 'Ministerio de educación ciencia y tecnología', 'INVEST G-3-1'),
(1462, 'La Gran Ocasión la escuela como sociedad de lectura', 'Ministerio de educación de ciencia y tecnología', NULL, 93, 'libros', '60-082', 5, 'Ministerio de educación de ciencia y tecnología', 'INVEST G-3-1'),
(1463, 'Lecturas , familias y escuelas Hacia una comunidad de lectores y escritores', 'Actis Beatriz', 2008, 93, 'libros', '60-083', 5, 'Homo Sapiens', 'INVEST G-3-1'),
(1464, 'Nuevos acercamientos a los jóvenes y la lectura', 'Petit Michele traducción Segovia Rafael , Sanchez Rafael , Sanchez Diana', 1999, 93, 'libros', '60-084', 5, 'Fondo de cultura economica', 'INVEST G-3-1'),
(1465, 'Educacion de la persona', 'Bohn Winfried', 1982, 93, 'libros', '60-085', 5, 'Ediciones universidad del salvador', 'INVEST G-3-1'),
(1466, 'La Educacion de la Persona', 'Wienfried Bohn', 1982, 93, 'libros', '60-086', 5, 'Proyecto cinae ediciones Universidad del salvador', 'INVEST G- 3-1'),
(1467, '\"La opción de educar y la responsabilidad pedagógica\"', 'Meirieu Philippe Conferencia', 2013, 93, 'libros', '60-087', 5, 'Ministerio de educación', 'INVEST G- 3-1'),
(1469, '¿Cómo compreder el mundo? Propuesta para el aula', 'Ministerio de educción de la Nación', 2013, 93, 'libros', '60-089', 5, 'Ministerio de educción de la nación', 'INVEST G- 3-1'),
(1470, 'Lineamientos Curriculares para la Educacion sexual integral. Ley 26.150. ley nacional', 'Ministerio de Educacion', NULL, 93, 'libros', '60-090', 5, 'Ministerio de Educacion', 'INVEST G- 3-1'),
(1471, 'Maltrato infantil Orientaciones para actuar desde la escuela', 'Programa Nacional por derechos de la niñez y la adolescencia', 2010, 93, 'libros', '60-091', 5, 'Ministerio de educación de la nación', 'INVEST G- 3-1'),
(1472, 'Inversión social en la infancia y adolescencia guía de orientaciones para la participación en el presupuesto publico', 'Cufino Ennio', 2008, 93, 'libros', '60-092', 5, 'Fondo de la naciones Unidas para la infancia', 'INVEST G- 3-1'),
(1474, 'Nuevo Análisis de la Sociedad del aprendizaje', 'Husen Torten', 1998, 93, 'libros', '60-094', 5, 'Paidos', 'INVEST G- 3-1'),
(1475, 'Las Organizaciones de los docentes en las políticas y problemas de la educación', 'Núñez Iván P.', 1990, 93, 'libros', '60-095', 5, 'Unesco / Reduc', 'INVEST G- 3-1'),
(1476, 'Educacion para el cambio social', 'Freire Paulo, ILlich Iván, Furter Pierre', NULL, 93, 'libros', '60-096', 5, 'Tierra nueva', 'INVEST G- 3-1'),
(1477, 'Cómo y cuándo enseñar Gramática', 'Martin Alicia Jiménez, Merino Alicia Romero', 2008, 93, 'libros', '60-097', 5, 'Editorial fundación Universitaria N S.j.', 'INVEST G- 3-1'),
(1478, 'Educacion física, movimiento y curriculum', 'Arnold J. Peter Solana Guillermo traducion', 1997, 93, 'libros', '60-098', 5, 'Morata, Ediciones', 'INVEST G- 3-1'),
(1479, 'La Construcción de la justicia educativa Criterios de redistribución y reconocimiento para la educación argentina', 'Veleda Cecilia, Rivas Axel y Mezzadra Florencia', 2011, 93, 'libros', '60-099', 5, 'Unicef', 'INVEST G- 3-1'),
(1480, 'La Educacion de las potencialidades humanas', 'Montessori Maria', 1998, 93, 'libros', '60-100', 5, 'Errepar', 'INVEST G- 3-1'),
(1481, 'Educacion y cultura Visual', 'Hernández Fernando', 2000, 93, 'libros', '60-101', 5, 'Octaedro', 'INVEST G- 3-1'),
(1484, 'La estructura del discurso pedagógico (Clases, códigos y control)', 'Bernstein Basil', 1994, 93, 'libros', '60-104', 5, 'Morata ediciones', 'INVEST G- 3-1'),
(1485, 'El curriculum una reflexión sobre la práctica', 'Sacristan Gimeno J.', 1991, 93, 'libros', '60-105', 5, 'Morata ediciones', 'INVEST G- 3-1'),
(1486, 'Las Juntas de Clasificación características y funcionamiento', 'Doberti Juan, Rigal Juan', 2014, 93, 'libros', '60-106', 5, 'Área de Investigación y Evaluación de Programas', 'INVEST G- 3-1'),
(1487, 'Tareas significativas en la Educacion fisica escolar', 'Florence Jacques', 2000, 93, 'libros', '60-107', 5, 'Inde publicaciones', 'INVEST G- 3-1'),
(1490, 'Iniciación tecnológica (nivel inicial 1 y 2 ciclo.)', 'Ullrich Heinz, Klante Dieter', 1997, 93, 'libros', '60-110', 5, 'Colihue', 'INVEST G- 3-1'),
(1492, 'Como tener ideas maravillosas y otros ensayos sobre cómo enseñar y aprender', 'Duckworth Eleanor, traducción Barberán Sánchez Genis', 1994, 93, 'libros', '60-112', 5, 'Aprendizaje Visor', 'INVEST G- 3-1'),
(1493, 'La pedagogía por objetivos : Obsesión por la eficiencia', 'Sacristán J. Gimeno', 1994, 93, 'libros', '60-113', 5, 'Morata ediciones', 'INVEST G- 3-1'),
(1494, 'Propuestas para el debate educativo en1984', 'Braslavsky Cecilia, Riquelme Graciela G.', 1984, 93, 'libros', '60-114', 5, 'Centro editor de América latina', 'INVEST G- 3-1'),
(1495, 'Posmodernismo (para principiantes)', 'Appignanesi Richard, Garratt Chis', 1999, 93, 'libros', '60-115', 5, 'Era naciente', 'INVEST G- 3-1'),
(1497, 'Trabajos elementales sobre la Escuela primaria', 'Querrien Anne, Varela julia traducción', NULL, 93, 'libros', '60-117', 5, 'La Piqueta', 'INVEST G- 3-1'),
(1498, 'Realidad mental y mundos posibles los actos de la imaginación que dan sentido a la experiencia', 'Brunner Jerome', 1999, 93, 'libros', '60-118', 5, 'Gedisa editorial', 'INVEST G- 3-1'),
(1501, 'Proyectos y Metodologías de la investigación', 'Lorenzo Maria Rosa, Zangaro Marcela', 2004, 93, 'libros', '60-121', 5, 'Aula taller Ediciones', 'INVEST G- 3-1'),
(1502, 'La Supervisión hoy rol y normativa para directivos y aspirantes en la prov. Bs. As.', 'Settembrino Zulema', NULL, 93, 'libros', '60-122', 5, 'Vocación docente', 'INVEST G- 3-1'),
(1504, 'La Cultura Aveniente Secularismo y libertad vacía', 'Boasso Fernando', 1988, 93, 'libros', '60-124', 5, 'Docencia editorial', 'INVEST G- 3-1'),
(1505, 'La zona de construcción del conocimiento: trabajando por un cambio cognitivo en educación', 'Newman Denis, Griffin Peg, Cole Michael', 1991, 93, 'libros', '60-125', 5, 'Morata Ediciones', 'INVEST G- 3-1'),
(1506, 'Apropiarnos de los conocimientos que se construyen en nuestra practica', 'Vásquez Maria Jose, Medina Abal Maria Dolores', NULL, 93, 'libros', '60-126', 5, 'Más libros, más libres editorial de CTERA', 'INVEST G- 3-1'),
(1508, 'La Escuela y los medios Educacion para la comunicación', 'Castillo Laura, Lopez Daniel, Piera Virginia', 1998, 93, 'libros', '60-128', 5, 'Edicial', 'INVEST G- 3-1'),
(1510, 'Recomendaciones metodológicas para la enseñanza (ciencias Naturales)', 'Ministerio de Educación', 2008, 93, 'libros', '60-130', 5, 'Ministerio de Educación', 'INVEST G- 3-1'),
(1512, 'Didáctica y metodología de la Educacion tecnológica', 'Secchi Famigliettti Maria', 2000, 93, 'libros', '60-132', 5, 'Homosapiens Editorial', 'INVEST G- 3-1'),
(1515, 'Conducción educación y calidad de la enseñanza media', 'Braslavsky Cecilia, Tiramonti Guillermina', 1990, 93, 'libros', '60-135', 5, 'Miño, Davila Editor', 'INVEST G- 3-1'),
(1517, 'Conocer los Materiales ideas y actividades para, el estudio de la fisica, Química y tecnología en la Educacion Secundaria', 'Molina Llorens Juan A.', 1996, 93, 'libros', '60-137', 5, 'De la Torre', 'INVEST G- 3-1'),
(1518, 'Estrategias para comprender Y producir ensayos Análisis y escritura de un género Discursivo', 'Malteucci Norma', 2013, 93, 'libros', '60-138', 5, 'Centro de publicaciones Educativas y material Didáctico', 'INVEST G- 3-1'),
(1520, 'Educacion Artista', 'Ministerio educación de nación', NULL, 93, 'libros', '60-140', 5, 'Ministerio de Educacion', 'INVEST G- 3-1'),
(1521, 'Ética y ciencia La responsabilidad del martillo', 'Heler Mario', 1996, 93, 'libros', '60-141', 5, 'Biblos Editorial', 'INVEST G- 3-1'),
(1522, 'Saber y relación pedagógica Un enfoque clínico', 'Laville Blanchard Claudine', 1996, 93, 'libros', '60-142', 5, 'Novedades educativas', 'INVEST G- 3-1'),
(1523, 'Educacion Tecnológica Espacio en el aula', 'Fraga Rodríguez Abel', 1999, 93, 'libros', '60-143', 5, 'Aique', 'INVEST G- 3-1'),
(1524, 'Cuento con vos Un libro de cuentos sobre tus Derechos', 'Ministerio de cultura y Educacion de la nación República Argentina', 1999, 93, 'libros', '60-144', 5, 'Ministerio de educación', 'INVEST G- 3-1'),
(1526, 'Entre el pasado y el futuro: los jóvenes y la trasmisión de la experiencia', 'Ministerio de Educacion, Ciencia y tecnología de la Nación', 2007, 93, 'libros', '60-146', 5, 'EUDEBA', 'INVEST G- 3-1'),
(1528, 'Poder y educación popular', 'Tamarit José', 1992, 93, 'libros', '60-148', 5, 'Libros del Quirchincho', 'INVEST G- 3-1'),
(1529, 'Inmigrantes españoles en Argentina Adaptación e Identidad. documentos (1915-1931)', 'Rodino Hugo José', 1999, 93, 'libros', '60-149', 5, 'Biblioteca Nacional Ediciones y pagina 12', 'INVEST G- 3-1'),
(1533, 'La literatura para niños y jóvenes (Guía de exploración de sus grandes temas)', 'Soriano Marc, Montes Graciela. Adaptación y traducción', 1995, 93, 'libros', '60-153', 5, 'Colihue', 'INVEST G- 3-1'),
(1534, 'Alfabetización inicial la educación en los primeros años', 'Azzerboni Delia, Manrique Borzone Ana María', 2008, 93, 'libros', '60-154', 5, 'Ediciones novedades educativas', 'INVEST G- 3-1'),
(1535, 'El juego Teatral (aportes para a la trasformación Educativa)', 'Vega Roberto', 2009, 93, 'libros', '60-155', 5, 'Ciccus Ediciones', 'INVEST G- 3-1'),
(1536, 'Ecociencia (actividades sencillas y divertidas que inspiran compresión y respeto por medio ambiente)', 'Leviene Shar, Grafton Allison, Chul Terry', 2004, 94, 'libros', '70-001', 5, 'Albatros Editorial', 'AMBIENT G-2-2'),
(1537, 'Reciclado (una solución al problema de la basura)', 'Cantoni Norma', 2010, 94, 'libros', '70-002', 5, 'Albatros', 'AMBIENT G-2-2'),
(1538, 'La tierra una increíble maquina de reciclar.', 'Bennett Paul, Colella Marta Elida', 1995, 94, 'libros', '70-003', 5, 'Sigmar Editorial', 'AMBIENT G-2-2'),
(1539, 'Misión rescate planeta tierra. (en asociación con la organización de las Naciones unidas)', 'Alboukrek Aarón, Zertuche Laura Mayela', 2013, 94, 'libros', '70-004', 5, 'Larousse', 'AMBIENT G-2-2'),
(1540, 'Toda Ecología es política (Las luchas por el ambiente en busca de alternativas de mundos)', 'Merlinsky Gabriela', 2023, 94, 'libros', '70-005', 5, 'XXI siglo veintiuno. ediciones', 'AMBIENT G-2-2'),
(1541, 'Ambiente', 'Ministerio de Educación de la Nación', 2023, 94, 'libros', '70-006', 5, 'Ministerio de la Educación de la Nación', 'AMBIENT G-2-2'),
(1542, 'Problemas y desafíos de la educación ambiental', 'Canciani María Laura, Telias Aldana, Sessano Pablo', 2023, 94, 'libros', '70-007', 5, 'Centro de publicaciones educativas y material didáctico', 'AMBIENT G-2-2'),
(1543, 'Educacion Ambiental Integral (Documento Marco)', 'Ministerio de Educación Argentina ESI', NULL, 94, 'libros', '70-008', 5, 'Ministerio de Educación Argentina', 'AMBIENT G-2-2'),
(1544, 'Guía de la producción más limpia para la industria metalmecánica', 'Ing. Tarsi Luis', 2011, 94, 'libros', '70-009', 5, 'Secretaria de Ambiente y Desarrollo Sustentable', 'AMBIENT G-2-2'),
(1545, 'Guía de producción más limpia para la foresto industria', 'Ing. Agr. Russo Liliana', 2011, 94, 'libros', '70-010', 5, 'Secretaria de Ambiente y Desarrollo Sustentable', 'AMBIENT G-2-2'),
(1548, 'Manual de educación ambiental tomo 1 (para docentes de nivel primario)', 'Secretaria Ambiente y Desarrollo Sustentable', 2015, 94, 'libros', '70-013', 5, 'Secretaria Ambiente y Desarrollo Sustentable', 'AMBIENT G-2-2'),
(1549, 'Manual de educación ambiental tomo 2 (para docentes de nivel primario)', 'Secretaria Ambiente y Desarrollo Sustentable', 2015, 94, 'libros', '70-014', 5, 'Secretaria Ambiente y Desarrollo Sustentable', 'AMBIENT G-2-2'),
(1550, 'Riesgos Naturales Procesos de la tierra como riesgo desastres y catástrofes', 'Keller Edward, Blodgett Robert', 2004, 94, 'libros', '70-015', 5, 'Pearson', 'AMBIENT G-2-2'),
(1552, 'Biología: la teoría de la evolución en la escuela.', 'Gutiérrez Antonio', 2009, 94, 'libros', '70-017', 5, 'Biblos', 'AMBIENT G-2-2'),
(1554, 'La Contaminación en los mares', 'Tahiel Inge, Gentile Georgina', 1994, 94, 'libros', '70-019', 5, 'Lumen editorial', 'AMBIENT G-2-2'),
(1555, 'Nosotros y la Naturaleza un esperado reencuentro', 'Camusso Dolly Noemí', 1996, 94, 'libros', '70-020', 5, 'Errepar', 'AMBIENT G-2-2'),
(1556, 'Taller educación Ambiental', 'Otero Alberto, Bruno Claudia', 1999, 94, 'libros', '70-021', 5, 'Novedades Educativas', 'AMBIENT G-2-2'),
(1557, 'Manual de educación ambiental tomo 2', 'Secretaria de Estado Ambiente y Desarrollo Sustentable', 2015, 94, 'libros', '70-022', 5, 'Ministerio de Educación', 'AMBIENT G-2-2'),
(1558, 'Nada se tira todo se recicla (sobre la basura y su futuro)', 'Medeiros Liliana, Gamero Silvia', NULL, 94, 'libros', '70-023', 5, 'Lumen', 'AMBIENT G-2-2'),
(1559, 'Invasión de la Basura', 'Leggett Jeremy, Tálamo Edith', 1994, 94, 'libros', '70-024', 5, 'SIGMAR editorial', 'AMBIENT G-2-2'),
(1561, 'Aventuras con la ciencia Ecología nuestro planeta en peligro', 'Cantoni Norma', 1997, 94, 'libros', '70-026', 5, 'Albatros', 'AMBIENT G-2-2'),
(1562, 'El derroche de la Energía', 'Leggett Jeremy, Tálamo Edith', 1994, 94, 'libros', '70-027', 5, 'Sigmar editorial', 'AMBIENT G-2-2'),
(1563, 'Educación en pandemia (Guía de supervivencia para docentes y familias)', 'Maggio Mariana', 2023, 95, 'libros', '210-001', 5, 'Paidos', 'PANDEM G-4-3'),
(1567, 'Malvinas en la escuela, memoria, Soberanía y Democracia 2 ejemplares', 'Ministerio de educación de la nación', 2022, 93, 'libros', '60-156', 5, 'Ministerio de educación de la nación', 'INVEST G- 3-1'),
(1568, 'Enseñar matemática nivel y primario', 'Briotman Claudia, Charlot Bernal, Garrido Rosa María', 2008, 93, 'libros', '60-157', 5, '12 (entes)', 'INVEST G- 3-1'),
(1569, 'Los Proyectos de Arte Enfoque metodológico en la enseñanza de la artes plásticas en el sistema escolar', 'Negro de Nun\' Berta', 2008, 93, 'libros', '60-158', 5, 'Magisterio del rio de la plata', 'INVEST G- 3-1'),
(1570, 'Infancia y educación artística', 'Hargreaves David', 1997, 93, 'libros', '60-159', 5, 'Morata Ediciones', 'INVEST G- 3-1'),
(1572, 'Conflictos 3.0 Malentendidos en las redes', 'Dir. de Educacion para los derechos humanos Adamoli María celeste', NULL, 93, 'libros', '60-161', 5, 'Ministerio de Educción, Argentina', 'INVEST G- 3-1'),
(1573, 'El uso pedagógico de los archivos. Reflexión y propuestas para abordar la historia', 'Ministerio de educación de la nación', 2021, 93, 'libros', '60-162', 5, 'Ministerio de educación de la nación dirección derechos humanos', 'INVEST G- 3-1'),
(1574, 'Referentes Escolares de Esi Educacion primaria', 'Ministerio de educción De la Nación', 2021, 93, 'libros', '60-163', 5, 'Ministerio de educación de la nación', 'INVEST G- 3-1'),
(1575, 'Referentes Escolares de Esi educación secundaria p 1', 'Ministerio de educación de la Nación', 2022, 93, 'libros', '60-164', 5, 'Ministerio de Educacion de la Nación para los derechos humanos', 'INVEST G- 3-1'),
(1576, 'Mas democracia más derechos', 'Ministerio de educación de la nación', 2023, 93, 'libros', '60-165', 5, 'ministerio de Educacion de la nación', 'INVEST G- 3-1'),
(1577, 'Educacion Sexual integral Para chalar en familia', 'Programa nacional de Educación sexual', 2011, 93, 'libros', '60-166', 5, 'Ministerio Educacion integral. Nación', 'INVEST G- 3-1'),
(1579, 'Enseñar Matemática hoy Miradas, sentidos y desafíos', 'Sadovsky Patricia', 2005, 93, 'libros', '60-168', 5, 'Libros del zorzal', 'INVEST G- 3-1'),
(1580, '¿Cómo enseñar matemática en el jardín?', 'González Adriana, Weinstien Edith', 2006, 93, 'libros', '60-169', 5, 'Colihue', 'INVEST G- 3-1'),
(1581, 'Didáctica de la Matemática ¿Cómo aprender? ¿Cómo enseñar?', 'Cabane Nora', 2008, 93, 'libros', '60-170', 5, 'Bonum', 'INVEST G- 3-1'),
(1582, 'Sugerencias para la clase de matemática', 'Villela José A', 2008, 93, 'libros', '60-171', 5, 'Aique', 'INVEST G- 3-1'),
(1584, 'Enseñar matemática en el nivel inicial', 'Aberkane Francois Cerquetti, Berdonneau Catherine', 1997, 93, 'libros', '60-173', 5, 'Edicial', 'INVEST G- 3-1'),
(1586, 'Iniciación al estudio didáctico de la geometría', 'Itzcovich Horacio', 2005, 93, 'libros', '60-175', 5, 'Libros del zorzal', 'INVEST G- 3-1'),
(1587, 'Iniciación al estudio de la Teoría de las situaciones Didácticas', 'Brousseau, Guy', 2007, 93, 'libros', '60-176', 5, 'Libros del Zorzal', 'INVEST G- 3-1'),
(1588, 'Razones para enseñar geometría en la educación básica', 'Bressan Ana María, Bogisic Beatriz, Crego Karina', 2010, 93, 'libros', '60-177', 5, 'Novedades educativas', 'INVEST G- 3-1'),
(1589, 'Rozones para enseñar geometría en la Educacion básica (mirar, construir y decir)', 'Bressan Ana María, Bogisic Beatriz, Crego Karina', 2002, 93, 'libros', '60-178', 5, 'Novedades Educativas', 'INVEST G- 3-1'),
(1591, 'Estimación en calculo y medida', 'Castro Encamación, Castro Enrique, Rico Luis', 2000, 93, 'libros', '60-180', 5, 'Síntesis ediciones', 'INVEST G- 3-1'),
(1592, 'Azar y probabilidad', 'Godino Juan Luis, Bernabéu Batanero Ma, C', NULL, 93, 'libros', '60-181', 5, 'Síntesis editorial', 'INVEST G- 3-1'),
(1593, 'Proporcionalidad directa La forma y el número', 'Mora Fiol Luisa, Aymeni Fortuny Josep Ma', 2000, 93, 'libros', '60-182', 5, 'Síntesis Editorial', 'INVEST G- 3-1'),
(1594, 'El problema de la medida Didactica de las magnitudes', 'Chamorro Carmen, Belmonte Juan M', 2000, 93, 'libros', '60-183', 5, 'Síntesis editorial', 'INVEST G- 3-1'),
(1596, 'Enseñar aritmética a los más chicos (de la exploración al dominio)', 'Parra Cecilia, Saiz Irma', 2007, 93, 'libros', '60-185', 5, 'Homo sapiens ediciones', 'INVEST G- 3-1'),
(1597, 'Enseñar matematica en los primeros ciclos', 'Aberkane - Cerquetti- Franoise', 1992, 93, 'libros', '60-186', 5, 'Edicial', 'INVEST G- 3-1'),
(1599, 'Pensando como matemáticos', 'Rowan Thomas, Bourne Barbara', 1999, 93, 'libros', '60-188', 5, 'Manantial', 'INVEST G- 3-1'),
(1600, 'Superficie y volumen ¿algo Más que el trabajo con formulas?', 'Romero olmo María Angeles, Carretero Moreno María Francisca', NULL, 93, 'libros', '60-189', 5, 'Síntesis editorial', 'INVEST G- 3-1'),
(1601, 'La vida secreta de los números (como piensan y trabajan los matemáticos)', 'Szpiro George, Bermejo francisco traducción', 2009, 93, 'libros', '60-190', 5, 'Almuzara', 'INVEST G- 3-1'),
(1604, 'Enseñar distinto', 'Furman Melina', 2023, 93, 'libros', '60-193', 5, 'XXI siglo veintiuno ediciones', 'INVEST G- 3-1'),
(1606, 'Educacion sexual integral', 'Ministerio de Educacion de la nación', 2023, 93, 'libros', '60-195', 5, 'Ministerio de Educacion de la nación', 'INVEST G- 3-1'),
(1607, 'Volver a pensar la clase Las formas básicas de enseñar', 'Sanjurjo Liliana', 2023, 93, 'libros', '60-196', 5, 'Homo Sapiens ediciones', 'INVEST G- 3-1'),
(1608, 'La autoridad como practica Encuentros y experiencias en educación', 'Greco María Beatriz', 2023, 93, 'libros', '60-197', 5, 'homo Sapiens', 'INVEST G- 3-1'),
(1609, 'Gestionar es hacer que las cosas sucedan', 'Blejmar Bernando', 2023, 93, 'libros', '60-198', 5, 'Centro de publicaciones educativas', 'INVEST G- 3-1'),
(1610, 'Educación en pandemia Guía de supervivencia para docentes y familias', 'Maggio Mariana', 2023, 93, 'libros', '60-199', 5, 'Paidos', 'INVEST G- 3-1'),
(1611, 'Pliegues de la formación Sentidos y herramientas para la formación docente', 'Souto Marta', 2023, 93, 'libros', '60-200', 5, 'Homo sapiens Ediciones', 'INVEST G- 3-1'),
(1614, 'Toda Ecología es política Las luchas por el ambiente en busca de alternativas de mundos', 'Merlinsky Gabriela', 2023, 93, 'libros', '60-203', 5, 'XXI siglo veintiuno. ediciones', 'INVEST G- 3-1'),
(1617, 'Recorridos de la memoria Propuestas de acciones instituciones y comunitarias para la formación docente', 'Ministerio de educación', 2023, 93, 'libros', '60-206', 5, 'Ministerio de Educacion', 'INVEST G- 3-1'),
(1618, 'El sentido de la escuela Secundaria nuevas practica y nuevos caminos', 'Anijovich Rebeca, Cappelletti Graciela', 2023, 93, 'libros', '60-207', 5, 'Paidos', 'INVEST G- 3-1'),
(1620, 'Juvenopedia Mapeo de las juventudes iberoamericanas', 'Feixa Carles, Oliart Patricia', 2023, 93, 'libros', '60-209', 5, 'Océano', 'INVEST G- 3-1'),
(1621, 'Estrategias de escritura en la formación', 'Brailovsky Daniel, Menchon Ángela', 2023, 93, 'libros', '60-210', 5, 'Centro de publicaciones educativas y didácticas', 'INVEST G- 3-1'),
(1623, 'Pedagogías del nivel inicial Mirar el mundo desde el jardín', 'Brailovsky Daniel', 2023, 93, 'libros', '60-212', 5, 'Centro de publicaciones Educativas y material didáctico', 'INVEST G- 3-1'),
(1624, 'Forma e practica reflexiva', 'Anijovich Rebeca, Cappelletti Graciela', 2023, 93, 'libros', '60-213', 5, 'Aique', 'INVEST G- 3-1'),
(1625, 'Las Señoritas historias de las maestras estadounidense que Sarmiento trajo a la Argentina en siglo XIX', 'Ramos Laura', 2023, 93, 'libros', '60-214', 5, 'Sudamericana', 'INVEST G- 3-1'),
(1626, 'Guía urgente para enseñar en la aulas virtuales', 'Libedinsky Marta', 2023, 93, 'libros', '60-215', 5, 'Tilde', 'INVEST G- 3-1'),
(1627, 'Pedagogía del cuidado La construcción de la cultura el cuidado en la escuela actual', 'Álvarez Mercedes, Boilini Paula, Enriz Noelia', 2023, 93, 'libros', '60-216', 5, 'La crujía', 'INVEST G- 3-1'),
(1629, 'Evaluaciones 29 preguntas y respuestas', 'Anijovich Rebeca, Cappelletti Graciela', 2023, 93, 'libros', '60-218', 5, 'El ateneo', 'INVEST G- 3-1'),
(1631, 'Relaciones escolares y diferencias culturales: la educación en perspectiva Intercultural', 'Villa Alicia l, Martínez Elena M.(comps)', 2023, 93, 'libros', '60-220', 5, 'Centro de publicaciones Educativas y Material didáctico', 'INVEST G- 3-1'),
(1632, 'Tecnologías en el aula Análisis Y propuesta pedagógica', 'Pini Mónica, (et.al)', 2023, 93, 'libros', '60-221', 5, 'Aique', 'INVEST G- 3-1'),
(1633, '50 iniciativas Nuevos Escenarios educativos. Otra gestión para otra enseñanza', 'Harf Ruth, Azzerboni Delia, Sanchez Sandra', 2023, 93, 'libros', '60-222', 5, 'Centro de publicaciones educativas y material didáctico', 'INVEST G- 3-1'),
(1634, 'La vida en las escuelas Esperanzas y desencantos de la convencía escolar', 'Kaplan Carina V', 2023, 93, 'libros', '60-223', 5, 'Homo Sapiens ediciones', 'INVEST G- 3-1'),
(1635, 'La Evaluación como aprendizaje cuando la flecha impacta en la diana', 'Guerra Miguel Ángel santos', 2023, 93, 'libros', '60-224', 5, 'Logos adicciones', 'INVEST G- 3-1'),
(1637, 'La enseñanza en enseñanza infantil. 0 a 3 años', 'Violante Rosa', 2023, 93, 'libros', '60-226', 5, 'Praxis grupo editor', 'INVEST G- 3-1'),
(1639, 'La evolución Institucional tejidos tramas', 'Spakowsky Elisa', 2023, 93, 'libros', '60-228', 5, 'Homo sapiens ediciones', 'INVEST G- 3-1'),
(1640, 'Aulas inclusivas teorías en acto', 'Borsani María José', 2023, 93, 'libros', '60-229', 5, 'Homo Sapiens ediciones', 'INVEST G- 3-1'),
(1641, 'Problemas y desafíos de la educción ambiental', 'Canciani María Laura, Telias Aldana, Sessano Pablo', 2023, 93, 'libros', '60-230', 5, 'Centro de publicaciones educativas y material didáctico', 'INVEST G- 3-1'),
(1642, 'Tenemos algo para decir instituto de formación docente contra la violencia de generó', 'Ministerio de educación Argentina esi', 2023, 93, 'libros', '60-231', 5, 'Ministerio de educación Argentina', 'INVEST G- 3-1'),
(1643, 'Educacion Ambiental Integral Documento Marco', 'Ministerio de Educacion Argentina', NULL, 93, 'libros', '60-232', 5, '¿?', 'INVEST G- 3-1'),
(1644, 'Evaluar para conocer, examinar para excluir', 'Méndez Álvarez Juan Manuel', 2005, 93, 'libros', '60-233', 5, 'Morata ediciones', 'INVEST G- 3-1'),
(1645, 'Conduciendo la escuela manual de gestión directiva y evaluación institucional', 'Azzerboni Delia, Harf Ruth', 2003, 93, 'libros', '60-234', 5, 'Centro de publicación educativas y material didáctico', 'INVEST G- 3-1'),
(1647, 'Imaginación y crisis en la Educacion latinoamericana', 'Puiggros Adriana', 1994, 93, 'libros', '60-236', 5, 'Aique', 'INVEST G- 3-1'),
(1648, 'Investigación y desarrollo del curriculum', 'Stenhuse Lawrence', 1991, 93, 'libros', '60-237', 5, 'Morata ediciones', 'INVEST G- 3-1'),
(1652, 'Docentes de la infancia: antropología del trabajo en la escuela', 'Batallan Graciela', 2007, 93, 'libros', '60-241', 5, 'Paidos', 'INVEST G- 3-1'),
(1653, 'El curriculum mas allá de la teoría de la reproducción', 'Kemmis Stephem, la colaboración Fitzclarence Lindsay', 1993, 93, 'libros', '60-242', 5, 'Morata Ediciones', 'INVEST G- 3-1'),
(1654, 'Curriculum: crisis, mito y perspectiva', 'Alba Alicia', 1998, 93, 'libros', '60-243', 5, 'Niño y Davila editores', 'INVEST G- 3-1'),
(1655, 'Gestión estratégicas para instituciones educativas guía para planificar estrategias de gerenciamiento institucional', 'Manes Juan Manuel', 2004, 93, 'libros', '60-244', 5, 'Granica', 'INVEST G- 3-1'),
(1656, 'La Construcción del éxito y del fracaso escolar Hacia un análisis de le éxito, fracasó y las desigualdades como realidades construidas por el sistema escolar', 'Perrenoud Philippe Manzano Pablo. traductor', NULL, 93, 'libros', '60-245', 5, 'Morata Ediciones', 'INVEST G- 3-1'),
(1657, 'Desencanto y utopía la educación en el laberinto de los nuevos tiempos', 'GENTLI Pablo', 2007, 93, 'libros', '60-246', 5, 'Homo Sapiens', 'INVEST G- 3-1'),
(1658, 'Los procesos de gestión en el acompañamiento a los Docentes noveles', 'Salinas Susana', 2009, 93, 'libros', '60-247', 5, 'Ministerio de educación', 'INVEST G- 3-1'),
(1659, 'Innovación y gestión', 'Ministerio de cultura y educación de la nación', NULL, 93, 'libros', '60-248', 5, 'Ministerio de cultura y educación de la nación', 'INVEST G- 3-1'),
(1660, 'Educar en la acción para aprender a emprender (organización y gestión de proyectos socio – productivos y cooperativos)', 'Ferreyra Horacio Ademar, Gallo Griselda Maria, Zecchini Ariel Alfredo', 2007, 93, 'libros', '60-249', 5, 'Centro de publicaciones educativas y material didáctico', 'INVEST G- 3-1'),
(1661, 'Materiales para la construcción de cursos de filosofía ¿Que es filosofía?', 'Berttolini Marisa, Langon Mauricio, Quintela Mabel', 1997, 93, 'libros', '60-250', 5, 'Uruguay editor', 'INVEST G- 3-1'),
(1662, 'Como elaborar Proyectos Instituciones de lectura. experiencias, reflexiones propuestas', 'Actis Beatriz', 2005, 93, 'libros', '60-251', 5, 'Homo Sapiens Ediciones', 'INVEST G- 3-1'),
(1663, 'Como elaborar proyectos institucionales de lectura', 'Actis Beatriz', 2005, 93, 'libros', '60-252', 5, 'Homo sapiens', 'INVEST G- 3-1'),
(1664, 'Vigotski su proyección en el pensamiento actual', 'Dubrovsky Silvia (compiladora)', 2000, 93, 'libros', '60-253', 5, 'Novedades educativas', 'INVEST G- 3-1'),
(1666, 'Estudio del curriculum: casos y métodos', 'Goodson. Ivor. F Pons Horacio traducción', 2003, 93, 'libros', '60-255', 5, 'Amorrortu', 'INVEST G- 3-1'),
(1667, 'Miradas interdisciplinarias sobre la violencias en la escuelas', 'Ministerio de educación, ciencia y tecnología de la nación', 2006, 93, 'libros', '60-256', 5, 'Ministerio de educación, ciencia y tecnología de la nación', 'INVEST G- 3-1'),
(1668, 'La educación estética del niño pequeño', 'Negro de Berta Num', 1995, 93, 'libros', '60-257', 5, 'Magisterio del rio de la plata', 'INVEST G- 3-1'),
(1669, 'La escuela con proyecto propio', 'Moschen Juan Carlos', 1997, 93, 'libros', '60-258', 5, 'Ateneo', 'INVEST G- 3-1'),
(1670, 'Interdisciplinariedad en educación', 'Egg – Ezequiel Ander', 1996, 93, 'libros', '60-259', 5, 'Magisterio del rio de la plata', 'INVEST G- 3-1'),
(1671, 'Pedagogía de la personalidad', 'Barylko Jaime', 2002, 93, 'libros', '60-260', 5, 'Santillana', 'INVEST G- 3-1'),
(1672, 'El aprendizaje dialogo y cooperativo', 'Sena Molina Cristina, Mateo Domingo pilar Maria del', 2005, 93, 'libros', '60-261', 5, 'Magisterio del rio de la plata', 'INVEST G- 3-1'),
(1673, 'Pensar el trabajo decente en la escuelas Herramientas para la reflexión y el debate en las aulas', 'Barba Estela, Berra Claudia, Puente Isabel', 2011, 93, 'libros', '60-262', 5, 'Ministerio de educación; Organización internacional del trabajo', 'INVEST G- 3-1'),
(1674, 'El curriculum oculto', 'Torres Jurjo', 1994, 93, 'libros', '60-263', 5, 'Morata ediciones', 'INVEST G- 3-1'),
(1675, 'Respuestas a la crisis educativas', 'Braslavsky Cecilia, Filmus Daniel (compiladores)', 1994, 93, 'libros', '60-264', 5, 'Cántaro y Flacso -clacso', 'INVEST G- 3-1'),
(1676, 'La escuela como territorio intervención política', 'Zemelman hugo, Rauber Isabel', 2004, 93, 'libros', '60-265', 5, 'C.t.e.r.a.', 'INVEST G- 3-1'),
(1677, 'Tendencias Sociales y Políticas Contemporáneas (perspectivas y debates)', 'Fernández Marta, Barbosa Susana', 1996, 93, 'libros', '60-266', 5, 'Fundación universidad a Distancia \"Hernandarias\"', 'INVEST G- 3-1'),
(1678, 'Acompañar los primeros pasos en la docencia explorar una nueva practica de formación', 'Alen Beatriz, Allegroni Andrés', 2009, 93, 'libros', '60-267', 5, 'Ministerio de Educacion', 'INVEST G- 3-1'),
(1679, 'La escuela como maquina de educar tres escritos sobre un proyecto de la modernidad', 'Pineau Pablo, Dussel Inés, Caruso Marcelo', 2010, 93, 'libros', '60-268', 5, 'Paidos', 'INVEST G- 3-1'),
(1680, 'La inteligencia escolarizada', 'Kaplan Carina V', 2007, 93, 'libros', '60-269', 5, 'Miño Davila', 'INVEST G- 3-1'),
(1682, 'Formación docente innovación educativa', 'Ezcurra Ana Maria De Lella Cayetano', 1992, 93, 'libros', '60-271', 5, 'Aique', 'INVEST G- 3-1'),
(1684, 'Como construir proyectos en la e.g,b', 'Bixio Cecilia', NULL, 93, 'libros', '60-273', 5, 'Homo sapiens', 'INVEST G- 3-1'),
(1685, 'La Ciencia posible propuestas de enseñanza -aprendizaje de las ciencias naturales para segundo ciclo', 'Dicovskiy Gloria, Pinchuk Diana Sargorodschi Ana (coord.)', 2000, 93, 'libros', '60-274', 5, 'Novedades educativas', 'INVEST G- 3-1'),
(1686, 'La escuela argentina de fin de siglo entre la informática y la merienda forzada', 'Narodowski Mariano', 1996, 93, 'libros', '60-275', 5, 'Novedades Educativas', 'INVEST G- 3-1'),
(1688, 'Evaluar es comprender', 'SANTOS Guerra Miguel Ángel', 2005, 93, 'libros', '60-277', 5, 'Magisterio de rio de la plata', 'INVEST G- 3-1'),
(1689, 'La Escuela como frontera Reflexiones sobre la experiencias escolar de jóvenes de sectores populares', 'Duschatzky Silvia', 2005, 93, 'libros', '60-278', 5, 'Paidos', 'INVEST G- 3-1'),
(1691, 'El ABC de la tarea docente: curriculum y enseñanza', 'Gvirtz Silvia, Palamidesi Marianao', 2008, 93, 'libros', '60-280', 5, 'Aique', 'INVEST G- 3-1'),
(1692, 'La organización escolar practicas y fundamentos', 'Antúnez Serafín, Gairin Joaquín', 2006, 93, 'libros', '60-281', 5, 'Grao', 'INVEST G- 3-1'),
(1694, 'Educacion Vulnerabilidad experiencias y prácticas de aula en contextos desfavorables', 'Bolton Patricio', 2006, 93, 'libros', '60-283', 5, 'La crujía ediciones', 'INVEST G- 3-1'),
(1695, 'Formación docente y psicopedagogía estrategias y propuestas para la intervención Educativa', 'Muller Marina', 2008, 93, 'libros', '60-284', 5, 'Bonum', 'INVEST G- 3-1'),
(1696, 'Apuntes y aportes para la gestión curricular', 'Poggi Margarita, Ferndez Salinas Dino, Melgar Sara', 1988, 93, 'libros', '60-285', 5, 'Kapelusz', 'INVEST G- 3-1'),
(1697, 'Niños y maestros por el camino de la alfabetización', 'Borzone Ana Maria, Rosemberg Cecilia Renata', 2011, 93, 'libros', '60-286', 5, 'Novedades educativas', 'INVEST G- 3-1'),
(1698, 'Escuelas y profesores ¿Hacia una reconversión de los Centros y la función docente?', 'Escudero Juan Manuel, González Maria Teresa', 1999, 93, 'libros', '60-287', 5, 'Ediciones pedagógicas', 'INVEST G- 3-1'),
(1699, 'Materiales Curriculares Como elaborarlos, seleccionarlos y usarlos', 'Aran Parcerisa Artur', 1997, 93, 'libros', '60-288', 5, 'GRAO', 'INVEST G- 3-1'),
(1700, 'Didactica de las matemáticas para primaria', 'Chamorro Maria del Carmen (Coord.)', 2003, 93, 'libros', '60-289', 5, 'PEARSON Educacion', 'INVEST G- 3-1'),
(1701, 'Didactica de las ciencias del lenguaje aportes y reflexiones', 'Alisedo Graciela, Melgar Sara, Chioci Cristina', 1997, 93, 'libros', '60-290', 5, 'Paidos', 'INVEST G- 3-1'),
(1703, 'Cien años de soledad', 'Gabriel García Márquez', 1967, 87, NULL, '250-001', 30, 'Editorial Sudamericana', 'ARTELIT-B-(E)5-5'),
(1704, 'Cuentos claros', 'Antonio Di Benedetto', 1969, 87, NULL, '250-002', 70, 'Galerna', 'ARTELIT-B-(M)6-3'),
(1705, 'Cuentos claros', 'Antonio Di Benedetto', 1969, 87, NULL, '250-003', 70, 'Galerna', 'ARTELIT-C-(E)15-3'),
(1706, 'El matadero', 'Esteban Echeverría', 1871, 87, NULL, '250-004', 10, 'Una crítica a la sociedad argentina de la época. ', 'ARTELIT-B-(E)8-1'),
(1708, 'Pepinillo y sus desventuras intrigantes', 'Roque Saez Pela', 1245, 107, NULL, '4456-001', 4, 'pepiza', 'pepi-E-(M)13-3'),
(1710, 'lenguas muertas y mixtas', 'J. K. Rowlin', 1999, 87, NULL, '250-001', 5, 'pepiza', 'ARTELIT-F-(E)8-4'),
(1711, '2rt', 'qwadd', 1241, 6, NULL, '500-001', 134, 'pepiza', 'EDINIP-D-(E)6-3'),
(1712, 'Nuevas sas2', '442', 1345, 1, NULL, '010-001', 3, 'Perusia', 'CIENAT-E-(E)11-4'),
(1713, '34r', '13', 1234, 87, NULL, '250-001', 134, 'Perusia', 'ARTELIT-C-(E)10-3'),
(1714, 'Nuevas sas', 'sas', 1313, 94, NULL, '70-001', 4, 'pepiza', 'AMBIENT-A-(M)13-2'),
(1715, 'Pepo', 'J. K. Rowlin', 1234, 87, NULL, '250-001', 4, 'pepiza', 'ARTELIT-B-(E)2-3'),
(1716, '344', 'J. K. Rowlin', 1234, 87, NULL, '250-001', 134, 'Perusia', 'ARTELIT-E-(E)7-4'),
(1717, 'Nuevas sas', 'J. K. Rowlin', 1232, 86, NULL, '1000-001', 134, 'Paidos', 'DIDAC-B-(E)11-3'),
(1718, '1234', '1234', 1234, 97, NULL, '230-001', 34, '123', 'ANTO-B-(E)6-2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `descripcion`, `imagen`, `fecha`) VALUES
(6, 'Nuevas adquisiciones', '¡Llegaron nuevos títulos a nuestra colección! Visita la sección de novedades y descubre los últimos libros en literatura, ciencia y más.', 'img/9788411482448-leer-libros-disenar-portadas.jpg', '2024-11-08 10:31:37'),
(7, 'Clases de apoyo escolar', 'Apoya tu estudio con nuestras clases gratuitas de refuerzo en matemáticas y literatura. Inscripciones abiertas en el mostrador de información. y etc', 'img/WhatsApp-Image-2024-02-02-at-10.00.45.jpeg', '2024-11-08 10:43:19'),
(8, 'Club de lectura juvenil', 'Únete al club de lectura juvenil y comparte tu pasión por los libros. Nos reunimos el último viernes de cada mes a las 5:00 p.m.', 'img/JuveWeb.png', '2024-11-08 10:45:51'),
(9, 'Taller de escritura creativa', 'Desarrolla tu talento y estilo en nuestro taller de escritura. ¡No necesitas experiencia previa! Próxima sesión el 10 de noviembre.', 'img/taller-escritura-creativa_web.jpg', '2024-11-08 11:03:28'),
(10, 'Ampliación de horario', 'Desde ahora, abrimos los sábados de 8 a 12 Hs para que tengas más tiempo de disfrutar de la biblioteca.', 'img/unnamed.jpg', '2024-11-08 11:19:18'),
(11, 'Exposición de arte', 'Visita la exposición de arte local en el Museo Provincial de Bellas Artes Franklin Rawson. Obras de artistas de la comunidad, disponibles todo el mes de noviembre.', 'img/20220313_192935.jpg', '2024-11-08 11:24:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `prestamo_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `fecha_devolucion` varchar(255) NOT NULL,
  `fecha_envio` varchar(255) DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `estado` varchar(255) NOT NULL DEFAULT 'pendiente',
  `cantidad` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `socio_id`, `material_id`, `fecha_prestamo`, `fecha_devolucion`, `estado`, `cantidad`) VALUES
(1, 35, 18, '2025-05-16', '2025-05-24', 'devuelto', 1),
(2, 36, 16, '2025-05-16', '2025-05-17', 'devuelto', 1),
(3, 71, 21, '2025-05-20', '2025-05-22', 'devuelto', 1),
(4, 52, 28, '2025-05-22', '2025-05-30', 'devuelto', 1),
(5, 35, 32, '2025-05-23', '2025-05-25', 'devuelto', 1),
(6, 35, 32, '2025-05-23', '2025-05-25', 'devuelto', 1),
(7, 43, 28, '2025-05-23', '2025-05-23', 'devuelto', 1),
(8, 35, 15, '2025-05-23', '2025-05-24', 'devuelto', 1),
(9, 36, 15, '2025-05-23', '2025-05-23', 'devuelto', 1),
(10, 37, 21, '2025-05-23', '2025-05-27', 'devuelto', 1),
(11, 35, 15, '2025-05-23', '2025-05-23', 'devuelto', 1),
(12, 40, 21, '2025-05-23', '2025-05-26', 'devuelto', 2),
(13, 40, 21, '2025-05-23', '2025-05-26', 'devuelto', 2),
(14, 36, 17, '2025-05-23', '2025-05-26', 'devuelto', 1),
(15, 55, 16, '2025-05-23', '2025-05-26', 'devuelto', 1),
(16, 56, 21, '2025-05-23', '2025-05-26', 'devuelto', 3),
(17, 39, 23, '2025-05-23', '2025-05-25', 'devuelto', 3),
(18, 35, 15, '2025-05-23', '2025-05-25', 'devuelto', 2),
(19, 35, 73, '2025-06-05', '2025-06-07', 'devuelto', 1),
(20, 40, 75, '2025-06-05', '2025-06-06', 'pendiente', 1),
(21, 43, 267, '2025-06-22', '2025-07-08', 'devuelto', 2),
(22, 37, 165, '2025-06-22', '2025-06-25', 'devuelto', 1),
(23, 38, 167, '2025-06-22', '2025-06-25', 'devuelto', 2),
(24, 71, 169, '2025-06-22', '2025-06-24', 'devuelto', 2),
(25, 76, 165, '2025-06-22', '2025-06-22', 'devuelto', 1),
(26, 71, 169, '2025-06-23', '2025-06-25', 'devuelto', 2),
(27, 77, 169, '2025-06-23', '2025-06-25', 'devuelto', 2),
(28, 78, 165, '2025-08-07', '2025-08-08', 'devuelto', 1),
(29, 89, 165, '2025-08-15', '2025-08-16', 'devuelto', 5),
(30, 41, 165, '2025-08-19', '2025-08-26', 'devuelto', 4),
(31, 41, 165, '2025-08-19', '2025-08-26', 'devuelto', 4),
(32, 41, 165, '2025-08-19', '2025-08-26', 'devuelto', 3),
(33, 41, 165, '2025-08-20', '2025-08-22', 'devuelto', 2),
(34, 41, 165, '2025-08-20', '2025-08-28', 'devuelto', 2),
(35, 41, 165, '2025-08-20', '2025-08-28', 'devuelto', 1),
(36, 41, 165, '2025-08-20', '2025-08-28', 'activo', 2),
(37, 38, 165, '2025-08-20', '2025-08-27', 'devuelto', 1),
(38, 38, 165, '2025-08-20', '2025-08-26', 'devuelto', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_detalle`
--

CREATE TABLE `prestamos_detalle` (
  `id` int(11) NOT NULL,
  `prestamo_id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL,
  `cantidad_prestada` int(11) NOT NULL,
  `cantidad_devuelta` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `anio` tinyint(4) DEFAULT NULL,
  `division` tinyint(4) DEFAULT NULL,
  `activo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id`, `nombre`, `apellido`, `telefono`, `direccion`, `email`, `anio`, `division`, `activo`) VALUES
(35, 'Juan', 'Pérez', '123456789', 'Calle Falsa 123', 'juan.perez@email.com', 1, 1, 1),
(36, 'Ana', 'Gómez', '987654321', 'Av. Siempre Viva 456', 'ana.gomez@email.com', 2, 1, 1),
(37, 'Luis', 'Martínez', '555888222', 'Calle del Sol 789', 'luis.martinez@email.com', 3, 2, 1),
(38, 'María', 'Sánchez', '666777555', 'Calle de los Álamos 101', 'maria.sanchez@email.com', 4, 2, 1),
(39, 'Carlos', 'López', '444555666', 'Callejón de la Luna 202', 'carlos.lopez@email.com', 1, 3, 1),
(40, 'Lucía', 'Rodríguez', '333444555', 'Calle del Río 303', 'lucia.rodriguez@email.com', 2, 3, 1),
(41, 'David', 'Hernández', '222333444', 'Calle de la Paz 404', 'david.hernandez@email.com', 3, 1, 1),
(42, 'Laura', 'Fernández', '111222333', 'Calle de la Primavera 505', 'laura.fernandez@email.com', 4, 1, 1),
(43, 'José', 'Martínez', '777888999', 'Av. Libertador 606', 'jose.martinez@email.com', 1, 2, 1),
(44, 'Isabel', 'Díaz', '888999111', 'Calle del Bosque 707', 'isabel.diaz@email.com', 2, 2, 1),
(45, 'Pedro', 'García', '999111222', 'Calle de la Estrella 808', 'pedro.garcia@email.com', 3, 3, 1),
(46, 'Raquel', 'González', '666333444', 'Av. de los Olivos 909', 'raquel.gonzalez@email.com', 4, 3, 1),
(47, 'Andrés', 'Torres', '555444333', 'Calle de los Cedros 1010', 'andres.torres@email.com', 1, 1, 1),
(48, 'Elena', 'Jiménez', '444333222', 'Calle del Encinar 1111', 'elena.jimenez@email.com', 2, 1, 1),
(49, 'Miguel', 'Ruiz', '333222111', 'Calle de los Pinos 1212', 'miguel.ruiz@email.com', 3, 2, 1),
(50, 'Sofia', 'Morales', '222111000', 'Calle de la Montaña 1313', 'sofia.morales@email.com', 4, 2, 1),
(51, 'Felipe', 'Vázquez', '111000999', 'Calle de la Nieve 1414', 'felipe.vazquez@email.com', 1, 3, 1),
(52, 'Marta', 'Ramírez', '000999888', 'Av. de la Luna 1515', 'marta.ramirez@email.com', 2, 3, 1),
(53, 'Rafael', 'Navarro', '333555777', 'Calle del Árbol 1616', 'rafael.navarro@email.com', 3, 1, 1),
(54, 'Carmen', 'Moreno', '444666888', 'Calle de la Loma 1717', 'carmen.moreno@email.com', 4, 1, 1),
(55, 'Óscar', 'Muñoz', '555777999', 'Callejón del Viento 1818', 'oscar.munoz@email.com', 1, 2, 1),
(56, 'Patricia', 'Serrano', '666888000', 'Av. de los Olivos 1919', 'patricia.serrano@email.com', 2, 2, 1),
(57, 'Daniel', 'Cruz', '777999111', 'Calle de la Cumbre 2020', 'daniel.cruz@email.com', 3, 3, 1),
(58, 'Verónica', 'Gutiérrez', '888111222', 'Calle de los Jazmines 2121', 'veronica.gutierrez@email.com', 4, 3, 1),
(59, 'Antonio', 'Santiago', '999222333', 'Calle de los Laureles 2222', 'antonio.santiago@email.com', 1, 1, 1),
(60, 'Cristina', 'Morales', '111333444', 'Av. de las Palmas 2323', 'cristina.morales@email.com', 2, 1, 1),
(61, 'Eduardo', 'Jiménez', '333444555', 'Calle de las Rosas 2424', 'eduardo.jimenez@email.com', 3, 2, 1),
(62, 'Julia', 'Guerra', '444555666', 'Calle del Olmo 2525', 'julia.guerra@email.com', 4, 2, 1),
(63, 'Antonio', 'Blanco', '555666777', 'Calle de los Lirios 2626', 'antonio.blanco@email.com', 1, 3, 1),
(64, 'Elena', 'Martín', '666777888', 'Calle de la Laguna 2727', 'elena.martin@email.com', 2, 3, 1),
(66, 'Ana', 'Gómez', '987654321', 'Av. Siempre Viva 456', 'ana.gomez@email.com', 2, 1, 1),
(67, 'Luis', 'Martínez', '555888222', 'Calle del Sol 789', 'luis.martinez@email.com', 3, 2, 1),
(68, 'María', 'Sánchez', '666777555', 'Calle de los Álamos 101', 'maria.sanchez@email.com', 4, 2, 1),
(69, 'Carlos', 'López', '444555666', 'Callejón de la Luna 202', 'carlos.lopez@email.com', 1, 3, 1),
(71, 'Esteban', 'Endrizzi', '02645856790', 'Villa Eusebio zapata M/c lote 12  Villa el bolsillo', 'este_endri2@gmail.com', 6, 4, 1),
(73, 'Paula ', 'coso', '2645878987', '1234', 'lapaula@gmail.com', 1, 6, 1),
(76, 'Macarena Alejandra', 'Sevilla', '2646285998', 'keteimporta22norte', 'maca_12@gmail.com', 3, 1, 1),
(77, 'Brenda Lumila', 'Sevilla', '2644729737', 'fray mamerto squiu 105 villa dolores', 'otaku_22@gmail.com', 6, 2, 1),
(78, 'Maria', 'Algañaraz', '2645987890', 'Caucete, San Juan, Argentina', 'mariadeo0312@hotmail.com', 6, 3, 1),
(79, 'Mercedes', 'Gutierrez', '02645547680', 'fray mamerto squiu 105 villa dolores', 'merce_guti@gmail.com', 3, 6, 1),
(80, 'Nicolas', 'Jofre', '02645853113', 'Villa Eusebio zapata M/c lote 12  Villa el bolsillo', 'nicojofre2@gmail.com', 1, 5, 1),
(81, 'Nicolas', 'Jofre', '02645853113', 'Villa Eusebio zapata M/c lote 12  Villa el bolsillo', 'nicojofre2@gmail.com', 1, 5, 1),
(82, 'Nicolas', 'Jofre', '02645853113', 'Villa Eusebio zapata M/c lote 12  Villa el bolsillo', 'nicojofre2@gmail.com', 1, 5, 1),
(83, 'Nicolas', 'Jofre', '02645853113', 'Villa Eusebio zapata M/c lote 12  Villa el bolsillo', 'nicojofre2@gmail.com', 1, 5, 1),
(84, 'Nicolas', 'Jofre', '02645853113', 'Villa Eusebio zapata M/c lote 12  Villa el bolsillo', 'nicojofre2@gmail.com', 1, 5, 1),
(85, 'Nicolas', 'Jofre', '02645853113', 'Villa Eusebio zapata M/c lote 12  Villa el bolsillo', 'nicojofre2@gmail.com', 1, 5, 1),
(86, 'Nicolas', 'Jofre', '02645853113', 'Villa Eusebio zapata M/c lote 12  Villa el bolsillo', 'nicojofre2@gmail.com', 1, 5, 1),
(87, 'Nicolas', 'Jofre', '02645853113', 'Villa Eusebio zapata M/c lote 12  Villa el bolsillo', 'nicojofre2@gmail.com', 1, 5, 1),
(88, 'Nicolas', 'Jofre', '02645853113', 'Villa Eusebio zapata M/c lote 12  Villa el bolsillo', 'nicojofre2@gmail.com', 1, 5, 1),
(89, 'Aylen', 'Suarez', '02646856790', 'Villa Eusebio zapata M/c lote 12  Villa el bolsillo', 'suarez212@gmail.com', 6, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones_fisicas`
--

CREATE TABLE `ubicaciones_fisicas` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `pasillo` varchar(255) NOT NULL,
  `estante` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `codigo_ubicacion` varchar(255) NOT NULL,
  `fecha_asignacion` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicaciones_fisicas`
--

INSERT INTO `ubicaciones_fisicas` (`id`, `material_id`, `pasillo`, `estante`, `nivel`, `codigo_ubicacion`, `fecha_asignacion`) VALUES
(2, 195, 'A', 1, 2, 'LITINF-A-1-2', '2025-06-21'),
(3, 964, 'D', 2, 1, 'PSICO-D-2-1', '2025-08-19');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `historial_socios`
--
ALTER TABLE `historial_socios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_socio` (`id_socio`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestamo_id` (`prestamo_id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prestamos_detalle`
--
ALTER TABLE `prestamos_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libro_id` (`libro_id`),
  ADD KEY `prestamo_id` (`prestamo_id`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicaciones_fisicas`
--
ALTER TABLE `ubicaciones_fisicas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `material_id` (`material_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anotaciones`
--
ALTER TABLE `anotaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de la tabla `bibliotecarios`
--
ALTER TABLE `bibliotecarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `historial_socios`
--
ALTER TABLE `historial_socios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1719;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `prestamos_detalle`
--
ALTER TABLE `prestamos_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `ubicaciones_fisicas`
--
ALTER TABLE `ubicaciones_fisicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial_socios`
--
ALTER TABLE `historial_socios`
  ADD CONSTRAINT `historial_socios_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `socios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`prestamo_id`) REFERENCES `prestamos` (`id`);

--
-- Filtros para la tabla `prestamos_detalle`
--
ALTER TABLE `prestamos_detalle`
  ADD CONSTRAINT `prestamos_detalle_ibfk_1` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id`),
  ADD CONSTRAINT `prestamos_detalle_ibfk_2` FOREIGN KEY (`prestamo_id`) REFERENCES `prestamos` (`id`);

--
-- Filtros para la tabla `ubicaciones_fisicas`
--
ALTER TABLE `ubicaciones_fisicas`
  ADD CONSTRAINT `ubicaciones_fisicas_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `materiales` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

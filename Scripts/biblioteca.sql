
create database biblioteca;
use biblioteca;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bibliotecarios`
--

CREATE TABLE IF NOT EXISTS `bibliotecarios` (
  `identificacion` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY (`identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Almacena la información de los bibliotecarios';

--
-- Volcado de datos para la tabla `bibliotecarios`
--

INSERT INTO `bibliotecarios` (`identificacion`, `nombre`) VALUES
(2526, 'Jimena Villegas'),
(2527, 'Pablo Torres'),
(2528, 'Pilar Duarte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lectores`
--

CREATE TABLE IF NOT EXISTS `lectores` (
  `carnet` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `edad` smallint(2) unsigned zerofill NOT NULL,
  PRIMARY KEY (`carnet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Almacena la información de los lectores';

--
-- Volcado de datos para la tabla `lectores`
--

INSERT INTO `lectores` (`carnet`, `nombre`, `apellidos`, `direccion`, `edad`) VALUES
(2111, 'Alberto', 'Barrantes M.', 'Alajuela Centro', 20),
(2112, 'Hilda', 'Valverde T.', 'Heredia, San Rafael', 20),
(2113, 'Julia', 'Morera M.', 'Alajuela, El Carmen', 19),
(2114, 'Mainor', 'Corrales J.', 'Alajuela, El Roble', 18),
(2115, 'Emilio', 'Abarca F.', 'Heredia, Los Lagos', 25),
(2116, 'Rosario', 'Loría B.', 'Alajuela, La Ceiba', 25),
(2117, 'Guillermo', 'Ramírez S.', 'Alajuela, Canoas', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE IF NOT EXISTS `libros` (
  `numero_referencia` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(45) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `tema` text NOT NULL,
  `autor` varchar(45) NOT NULL,
  PRIMARY KEY (`numero_referencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Almacena la información de los libros' AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`numero_referencia`, `isbn`, `titulo`, `tema`, `autor`) VALUES
(1, '978-8484502623', 'El ocho', 'Nueva York, 1972. Catherine Velis, aficionada a las matemáticas y al ajedrez, trabaja en una auditoría como experta en informática. La firma la destina a Argelia, pero, antes de partir, una vidente le lee las líneas de la mano y le advierte de que un grave peligro se cierne sobre ella. Poco después, un marchante de antigüedades hace a Cat una misteriosa oferta: un cliente suyo está intentando reunir las piezas de un antiguo juego de ajedrez que presuntamente se encuentra en Argelia. Si Cat le consigue esas piezas, obtendrá a cambio una generosa recompensa. Sur de Francia, 1790. Mireille de Rémy y su prima Valentine son dos novicias de la abadía de Montglane. Francia arde en las llamas de la revolución que, entre otros proyectos, pretende aniquilar a la Iglesia y hacerse con sus tesoros. Enterradas desde hace mil años bajo el suelo de la abadía se encuentran las piezas de un ajedrez legendario, que perteneció a Carlomagno. Quien consiga reunir dichas piezas adquirirá un poder ilimitado. Y para mantenerlas fuera del alcance de quienes pudieran abusar de él, Mireille y Valentine deberán repartirlas por todos los confines del mundo.', 'Katherine Neville'),
(2, '9789871997008', 'Bajo La Misma Estrella', 'Emotiva, irónica y afilada. Una novela teñida de humor y de tragedia que habla de nuestra capacidad para soñar incluso en las circunstancias más difíciles.', 'Jonh Green'),
(3, '9788426416216', 'Ladrona De Libros', 'Érase una vez un pueblo donde las noches eran largas y la muerte contaba su propia historia.', 'Markus  Zusak '),
(4, '9789500746601', 'El Juego De Ripper', 'Tal como predijo la astróloga más reputada de San Francisco, una oleada de crímenes comienza a sacudir la ciudad. En la investigación sobre los asesinatos, el inspector Bob Martín recibirá la ayuda inesperada de un grupo de internautas especializados en juegos de rol, Ripper.', 'Isabelle Allende'),
(5, '9788498384376', 'Harry Potter Y La Piedra Filosofal', 'Harry Potter se ha quedado huérfano y vive en casa de sus abominables tíos y el insoportable primo Dudley. Harry se siente muy triste y solo, hasta que un buen día recibe una carta que cambiará su vida para siempre. En ella le comunican que ha sido aceptado como alumno en el Colegio Hogwarts de Magia. A partir de ese momento, la suerte de Harry da un vuelco espectacular. En esa escuela tan especial aprenderá encantamientos, trucos fabulosos y tácticas de defensa contra las malas artes. Se convertirá en el campeón escolar de quidditch, especie de fútbol aéreo que se juega montado sobre escobas, y hará un puñado de buenos amigos...', 'J. K. Rowling');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE IF NOT EXISTS `prestamos` (
  `num_prestamos` int(11) NOT NULL AUTO_INCREMENT,
  `numero_referencia_libro` int(11) NOT NULL,
  `identificacion_bibliotecario` int(11) NOT NULL,
  `carnet_lector` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`num_prestamos`,`numero_referencia_libro`),
  KEY `num_referencia_libro_prestamos_idx` (`numero_referencia_libro`),
  KEY `carnet_lector_prestamo_idx` (`carnet_lector`),
  KEY `identificacion_bibliotecario_prestamo_idx` (`identificacion_bibliotecario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Almacena la información de los prestamos' AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`num_prestamos`, `numero_referencia_libro`, `identificacion_bibliotecario`, `carnet_lector`, `fecha`) VALUES
(1, 1, 2527, 2113, '2014-08-01'),
(2, 2, 2527, 2111, '2014-08-01'),
(3, 3, 2526, 2111, '2014-08-04'),
(4, 1, 2527, 2115, '2014-08-05'),
(5, 2, 2528, 2112, '2014-08-04'),
(6, 4, 2527, 2113, '2014-08-05');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `carnet_lector_prestamo` FOREIGN KEY (`carnet_lector`) REFERENCES `lectores` (`carnet`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `identificacion_bibliotecario_prestamo` FOREIGN KEY (`identificacion_bibliotecario`) REFERENCES `bibliotecarios` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `numero_referencia_libros_prestamos` FOREIGN KEY (`numero_referencia_libro`) REFERENCES `libros` (`numero_referencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

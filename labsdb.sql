-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2020 a las 06:00:48
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `labsdb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_registro_encuestados` (IN `id` INT, IN `voto1` INT, IN `voto2` INT, IN `voto3` INT, IN `voto4` INT)  BEGIN

set @s = concat("update registro_encuestados set voto1='",voto1,"', voto2='",voto2,"', voto3='",voto3,"', voto4='",voto4,"' where id='",id,"'");
    prepare stmt from @s;
execute stmt;
deallocate prepare stmt;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_votos` (IN `param_votos1` VARCHAR(255), IN `param_votos2` VARCHAR(255))  begin set@s=concat("update votos set votos1=", param_votos1 , ", votos2=", param_votos2);

prepare stmt from @s;
execute stmt;
deallocate prepare stmt;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_votos_provincia` (IN `id` INT, IN `voto` INT)  BEGIN
set @s=concat("update provincias set voto='",voto,"' where id='",id,"'");
prepare stmt from @s;
execute stmt;
deallocate prepare stmt;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_crear_preguntas` (IN `pregunta` VARCHAR(250), IN `opcion1` VARCHAR(200), IN `opcion2` VARCHAR(200), IN `opcion3` VARCHAR(200), IN `opcion4` VARCHAR(200))  BEGIN
set @s = concat("insert into preguntas (pregunta, opcion1, opcion2, opcion3, opcion4) values('",pregunta,"', '",opcion1,"', '",opcion2,"', '",opcion3,"', '",opcion4,"')");

prepare stmt from @s;
execute stmt;
deallocate prepare stmt;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_pregunta` (IN `param` INT)  BEGIN
set @s = concat("delete from preguntas where id ='",param,"'");
prepare stmt from @s;
execute stmt;
deallocate prepare stmt;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_noticias` ()  begin
	select id, titulo, texto, categoria, fecha, imagen FROM noticias;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_noticias_filtro` (IN `param_campo` VARCHAR(255), IN `param_valor` VARCHAR(255))  BEGIN
	set @s = concat("select id, titulo, texto, categoria, fecha, imagen 
                    from noticias where ", param_campo ," like concat('%", param_valor ,"%')");
                    prepare stmt from @s;
                    execute stmt;
                    deallocate prepare stmt;
                    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_noticias_pagina` (IN `param1` VARCHAR(50), IN `param2` VARCHAR(50))  begin
set @s = concat("select * from noticias limit ", param1 , " , " , param2);
prepare stmt from @s;
execute stmt;
deallocate prepare stmt;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_opciones_encuesta` ()  BEGIN
SELECT e.id, e.opcion1, e.opcion2, e.opcion3, e.opcion4, re.voto1, re.voto2, re.voto3, re.voto4 from encuestados as e inner join registro_encuestados as re on e.id = re.id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_pregunta` (IN `id` INT)  BEGIN
    set @s = concat("select * from preguntas where id='",id,"'");
    prepare stmt from @s;
execute stmt;
deallocate prepare stmt;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_preguntas` ()  begin
set @s = concat("select * from preguntas");
prepare stmt from @s;
execute stmt;
deallocate prepare stmt;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_provincias` ()  begin
select * from provincias;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_votos` ()  begin
select votos1, votos2 from votos;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificar_pregunta` (IN `id` INT, IN `pregunta` VARCHAR(255), IN `opcion1` VARCHAR(255), IN `opcion2` VARCHAR(255), IN `opcion3` VARCHAR(255), IN `opcion4` VARCHAR(255))  BEGIN
    set @s = concat("update preguntas set pregunta='",pregunta,"', opcion1='",opcion1,"', opcion2='",opcion2,"', opcion3='",opcion3,"', opcion4='",opcion4,"' where id='",id,"'");
    prepare stmt from @s;
execute stmt;
deallocate prepare stmt;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_opciones_encuestados` ()  begin
select * from encuestados;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_validar_usuario` (IN `param_user` VARCHAR(225), IN `param_pass` VARCHAR(225))  begin
set @s = concat("select count(*) from usuarios \r\n                where usuario = '" , param_user , "' and clave = '" , param_pass, "'");
                
                prepare stmt from @s;
                execute stmt;
                deallocate prepare stmt;
                end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestados`
--

CREATE TABLE `encuestados` (
  `id` int(11) NOT NULL,
  `pregunta` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `opcion1` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `opcion2` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `opcion3` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `opcion4` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `encuestados`
--

INSERT INTO `encuestados` (`id`, `pregunta`, `opcion1`, `opcion2`, `opcion3`, `opcion4`) VALUES
(1, 'Sexo', 'Masculino', 'Femenino', 'No repsonder', ''),
(2, 'Rango de Edad', '15 a 30', '31 a 45', '46 a 60', 'Jubilado'),
(3, 'Rango Salarial', '500 a 750', '800 a 1,000', '1,100 a 2,500', 'mayor a 2,500');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `texto` text COLLATE utf8_unicode_ci NOT NULL,
  `categoria` enum('promociones','ofertas','costas') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'promociones',
  `fecha` date NOT NULL,
  `imagen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `texto`, `categoria`, `fecha`, `imagen`) VALUES
(1, 'Nueva promocion en Ciudad Cristal', '145 viviendas\r\nde lujo en urbanizacion ajardinada situadas en un entorno privilegiado', 'promociones', '2019-02-04', NULL),
(2, 'Ultimas viviendas junto al rio', 'Apartamentos de 1\r\ny 2 dormitorios, con fantasticas vistas. Excelentes condiciones de financiacion.', 'ofertas', '2019-02-05', NULL),
(3, 'Apartamentos en el Puerto de San Martin', 'En la\r\nPlaya del Sol, en primera linea de playa. Pisos reformados y completamente\r\namueblados.', 'costas', '2019-02-06', 'apartamento8.jpg'),
(4, 'Casa reformada en el barrio de la Palmera', 'Dos\r\nplantas y atico, 5 habitaciones, patio interior, amplio garaje. Situada en una calle\r\ntranquila y a un paso del centro historico.', 'promociones', '2019-02-07', NULL),
(5, 'Promocion en Costa Mar', 'Con vistas al campo de\r\ngolf, magnificas calidades, entorno ajardinado con piscina y servicio de\r\nvigilancia.', 'costas', '2019-02-09', 'apartamento9.jpg'),
(6, 'Ultimas viviendas junto al rio', 'Apartamentos de 1\r\ny 2 dormitorios, con fantasticas vistas. Excelentes condiciones de financiacion.', 'ofertas', '2019-02-05', NULL),
(7, 'Apartamentos en el Puerto de San Martin', 'En la\r\nPlaya del Sol, en primera linea de playa. Pisos reformados y completamente\r\namueblados.', 'costas', '2019-02-06', 'apartamento8.jpg'),
(8, 'Casa reformada en el barrio de la Palmera', 'Dos\r\nplantas y atico, 5 habitaciones, patio interior, amplio garaje. Situada en una calle\r\ntranquila y a un paso del centro historico.', 'promociones', '2019-02-07', NULL),
(9, 'Promocion en Costa Mar', 'Con vistas al campo de\r\ngolf, magnificas calidades, entorno ajardinado con piscina y servicio de\r\nvigilancia.', 'costas', '2019-02-09', 'apartamento9.jpg'),
(10, 'Nueva promocion en Ciudad Cristal', '145 viviendas\r\nde lujo en urbanizacion ajardinada situadas en un entorno privilegiado', 'promociones', '2019-02-04', NULL),
(11, 'Ultimas viviendas junto al rio', 'Apartamentos de 1\r\ny 2 dormitorios, con fantasticas vistas. Excelentes condiciones de financiacion.', 'ofertas', '2019-02-05', NULL),
(12, 'Apartamentos en el Puerto de San Martin', 'En la\r\nPlaya del Sol, en primera linea de playa. Pisos reformados y completamente\r\namueblados.', 'costas', '2019-02-06', 'apartamento8.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `opcion1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `opcion2` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `opcion3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opcion4` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `pregunta`, `opcion1`, `opcion2`, `opcion3`, `opcion4`) VALUES
(15, 'Â¿Como Estas?', 'Bien', 'Mal', 'Mas o menos', 'estresado'),
(43, 'Â¿Cual es tu rango de edad?', '10 a 20 aÃ±os', '21 a 35 aÃ±os', '36 a 45 aÃ±os', 'mayor de 46 aÃ±os');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(11) NOT NULL,
  `provincia` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `voto` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `provincia`, `voto`) VALUES
(1, 'Bocas del Toro', 0),
(2, 'Coclé', 0),
(3, 'Colon', 2),
(4, 'Chiriquí', 0),
(5, 'Darién', 0),
(6, 'Herrera', 0),
(7, 'Los Santos', 0),
(8, 'Panamá', 0),
(9, 'Veraguas', 1),
(10, 'Panamá Oeste', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `encprg` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `encrpt1` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `encrpt2` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `encrpt3` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `encrpt4` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `input` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `requerido` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `encval1` int(11) NOT NULL DEFAULT 0,
  `encval2` int(11) NOT NULL DEFAULT 0,
  `encval3` int(11) NOT NULL DEFAULT 0,
  `encval4` int(11) NOT NULL DEFAULT 0,
  `enctot` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `encprg`, `encrpt1`, `encrpt2`, `encrpt3`, `encrpt4`, `input`, `requerido`, `encval1`, `encval2`, `encval3`, `encval4`, `enctot`) VALUES
(1, 'Ingresar su sexo', 'Hombre', 'Mujer', 'Prefiero no responder', 'No definido', 'checkbox', 'required', 0, 0, 0, 0, 0),
(2, 'Ingresar tu rango de Edad', 'de 13 a 18', 'de 18 a 28', 'de 28 a 50', 'Tercera Edad', 'radio', 'required', 0, 0, 0, 0, 0),
(3, 'Ingresa tu rango salarial mensual', 'menor de 400', 'de 400 a 800', 'de 800 a 1500', 'de 1500 en adelante', 'radio', 'required', 0, 0, 0, 0, 0),
(4, 'Ingresa tu provincia', '\'Bocas del Toro\',\'Coclé\',\'Colón\'', '\'Chiriquí\',\'Darién\',\'Herrera\'', '\'Los Santos\',\'Panamá\',\'Veraguas\'', '\'Chorrera\'', 'radio', 'required', 0, 0, 0, 0, 0),
(5, 'Cual es la pelicual mas taquillera de la historia', 'Batman el Caballero de la Noche', 'Avenger End Game', 'Titanic', 'Godzilla', 'radio', NULL, 0, 0, 0, 0, 0),
(6, '¿Quién dirigió la trilogía original de la saga Star Wars?', 'Guillermo del Toro', 'Mell Gibson', 'Geoge Lucas', 'Steven Spielberg', 'radio', NULL, 0, 0, 0, 0, 0),
(7, '¿Qué actor interpretó al mago Gandalf en la trilogía de El Señor de los anillos?', 'Ian Mckellen', 'Leonardo Dicaprio', 'Silverter Stalong', 'Tom Cruise', 'radio', NULL, 0, 0, 0, 0, 0),
(8, '¿Quién dirigió la película Origen en el 2010?', 'Quentin Tarantino', 'Martin Scorsese', 'Tim Burton', 'Christopher Nolan', 'radio', NULL, 0, 0, 0, 0, 0),
(9, '¿Cuántas películas conforman la saga cinematográfica Harry Potter?', '3', '8', '5', '6', 'radio', NULL, 0, 0, 0, 0, 0),
(10, '¿Qué actor interpretó a Aquiles en la película Troya del 2004?', 'Robert Downey Jr', 'Dwayne Johnson', 'Brad Pitt', 'Will Smith', 'radio', NULL, 0, 0, 0, 0, 0),
(11, '¿En qué película podemos encontrar a un payaso asesino llamado Pennywise?', 'En la película de terror Eso (It).', 'Chucky', 'Dragon Ball', 'Malefica', 'radio', NULL, 0, 0, 0, 0, 0),
(12, '¿En qué película podemos encontrar al león Mufasa y a su hijo Simba?', 'Aladín', 'Como Perros y Gatos', 'El Rey León', 'Teletuvis', 'radio', NULL, 0, 0, 0, 0, 0),
(13, '¿Qué actor da vida a Superman en El hombre de acero, conocida en inglés como Man of Steel?', 'Henry Cavil', 'Jhonny Deep', 'Tom Hanks', 'Robert De Niro', 'radio', NULL, 0, 0, 0, 0, 0),
(14, '¿Que personaje viene del plante sayayin?', 'Picolo', 'Dende', 'Vegueta', 'Usnavi', 'radio', NULL, 0, 0, 0, 0, 0),
(15, '¿Quién dirigió y protagonizó la película Corazón Valiente?', 'Harrison Ford', 'Mel Gibson', 'Steven Spielberg', 'Guillermo del Toro', NULL, NULL, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_encuestados`
--

CREATE TABLE `registro_encuestados` (
  `id` int(11) NOT NULL,
  `voto1` int(11) DEFAULT 0,
  `voto2` int(11) DEFAULT 0,
  `voto3` int(11) DEFAULT 0,
  `voto4` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `registro_encuestados`
--

INSERT INTO `registro_encuestados` (`id`, `voto1`, `voto2`, `voto3`, `voto4`) VALUES
(1, 0, 2, 1, 7),
(2, 1, 1, 1, 0),
(3, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `usuario` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `clave` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`) VALUES
(1, 'testuser', 'teXB5LK3JWG6g');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos`
--

CREATE TABLE `votos` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `votos1` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `votos2` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `votos`
--

INSERT INTO `votos` (`id`, `votos1`, `votos2`) VALUES
(1, 51, 19);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuestados`
--
ALTER TABLE `encuestados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_encuestados`
--
ALTER TABLE `registro_encuestados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuestados`
--
ALTER TABLE `encuestados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `votos`
--
ALTER TABLE `votos`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `encuestados`
--
ALTER TABLE `encuestados`
  ADD CONSTRAINT `encuestados_ibfk_1` FOREIGN KEY (`id`) REFERENCES `registro_encuestados` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2021 a las 20:55:25
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `juniorphp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modificados_indicadores`
--

CREATE TABLE `modificados_indicadores` (
  `Id` int(11) NOT NULL,
  `codigo` varchar(400) NOT NULL,
  `medida` varchar(400) NOT NULL,
  `fecha` date NOT NULL,
  `valor` int(11) NOT NULL,
  `Original_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modificados_indicadores`
--

INSERT INTO `modificados_indicadores` (`Id`, `codigo`, `medida`, `fecha`, `valor`, `Original_Id`) VALUES
(10, 'uf', 'pesos', '2021-12-16', 12345, 35),
(11, 'uf', 'pesos', '2021-12-16', 54678, 36),
(22, 'uf', 'pesos', '2021-12-16', 87654, 47),
(23, 'uf', 'pesos', '2021-12-16', 34567, 48),
(25, 'uf', 'pesos', '2021-12-18', 11111, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `originales_indicadores`
--

CREATE TABLE `originales_indicadores` (
  `Id` int(11) NOT NULL,
  `codigo` varchar(400) NOT NULL,
  `medida` varchar(400) NOT NULL,
  `fecha` date NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `originales_indicadores`
--

INSERT INTO `originales_indicadores` (`Id`, `codigo`, `medida`, `fecha`, `valor`) VALUES
(35, 'uf', 'pesos', '2021-12-15', 30912),
(36, 'uf', 'pesos', '2021-12-13', 30902),
(47, 'uf', 'pesos', '2021-12-14', 30907),
(48, 'uf', 'pesos', '2021-12-09', 30882),
(50, 'uf', 'pesos', '2021-12-10', 30887);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `modificados_indicadores`
--
ALTER TABLE `modificados_indicadores`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_modificados_indicadores_Original_Id` (`Original_Id`);

--
-- Indices de la tabla `originales_indicadores`
--
ALTER TABLE `originales_indicadores`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modificados_indicadores`
--
ALTER TABLE `modificados_indicadores`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `originales_indicadores`
--
ALTER TABLE `originales_indicadores`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `modificados_indicadores`
--
ALTER TABLE `modificados_indicadores`
  ADD CONSTRAINT `fk_modificados_indicadores_Original_Id` FOREIGN KEY (`Original_Id`) REFERENCES `originales_indicadores` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

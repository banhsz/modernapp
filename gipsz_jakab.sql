-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Nov 02. 10:15
-- Kiszolgáló verziója: 10.1.34-MariaDB
-- PHP verzió: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `gipsz_jakab`
--
CREATE DATABASE IF NOT EXISTS `gipsz_jakab` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `gipsz_jakab`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `blog_cim` varchar(1024) COLLATE utf8_hungarian_ci NOT NULL,
  `blog_tartalom` text COLLATE utf8_hungarian_ci NOT NULL,
  `blog_datum` date NOT NULL,
  `blog_lathatosag` tinyint(1) NOT NULL,
  `blog_szin` varchar(7) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '#900000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_cim`, `blog_tartalom`, `blog_datum`, `blog_lathatosag`, `blog_szin`) VALUES
(1, 'Iskolai oktatás ', 'Ide kerül valamilyen oktatási anyag... Ide kerül valamilyen oktatási anyag... Ide kerül valamilyen oktatási anyag... Ide kerül valamilyen oktatási anyag... ', '2020-10-01', 1, '#900000'),
(6, '345', '2354456', '2020-11-02', 1, '#900000'),
(8, '2222', '2354456', '2020-11-02', 1, '#900000'),
(9, '1049', '1049', '2020-11-02', 1, '#900000');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

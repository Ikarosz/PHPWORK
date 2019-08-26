-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2019. Feb 13. 07:52
-- Kiszolgáló verziója: 10.1.36-MariaDB
-- PHP verzió: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `ugyelet`
--
CREATE DATABASE IF NOT EXISTS `ugyelet` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `ugyelet`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `beosztas`
--

DROP TABLE IF EXISTS `beosztas`;
CREATE TABLE IF NOT EXISTS `beosztas` (
  `OID` int(11) DEFAULT NULL,
  `razon` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `rendeles_tipusa` varchar(250) DEFAULT NULL,
  `bazon` int(11) NOT NULL AUTO_INCREMENT,
  `oraszam` int(20) DEFAULT NULL,
  PRIMARY KEY (`bazon`),
  UNIQUE KEY `bazon` (`bazon`),
  KEY `razon` (`razon`),
  KEY `OID` (`OID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- TÁBLA KAPCSOLATAI `beosztas`:
--   `razon`
--       `rendelok` -> `razon`
--   `OID`
--       `orvosok` -> `OID`
--

--
-- A tábla adatainak kiíratása `beosztas`
--

INSERT INTO `beosztas` (`OID`, `razon`, `datum`, `rendeles_tipusa`, `bazon`, `oraszam`) VALUES
(1, 1, '2017-05-10', 'hazi', 1, 4),
(2, 3, '2017-04-12', 'szak', 2, 6),
(1, 2, '2017-06-16', 'hazi', 3, 4),
(1, 2, '2017-05-10', 'szak', 4, 4),
(1, 1, '2019-02-13', 'szak', 5, 4);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `nyilvantartas`
--

DROP TABLE IF EXISTS `nyilvantartas`;
CREATE TABLE IF NOT EXISTS `nyilvantartas` (
  `RAZON` int(11) NOT NULL AUTO_INCREMENT,
  `hetfo` varchar(100) DEFAULT NULL,
  `kedd` varchar(100) DEFAULT NULL,
  `szerda` varchar(100) DEFAULT NULL,
  `csutortok` varchar(100) DEFAULT NULL,
  `pentek` varchar(100) DEFAULT NULL,
  `szombat` varchar(100) DEFAULT NULL,
  `vasarnap` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`RAZON`),
  UNIQUE KEY `RAZON` (`RAZON`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- TÁBLA KAPCSOLATAI `nyilvantartas`:
--   `RAZON`
--       `rendelok` -> `razon`
--

--
-- A tábla adatainak kiíratása `nyilvantartas`
--

INSERT INTO `nyilvantartas` (`RAZON`, `hetfo`, `kedd`, `szerda`, `csutortok`, `pentek`, `szombat`, `vasarnap`) VALUES
(1, 'nincs', 'nincs', '10:00-14:00', '14:00-16:00', '8:00-10:00', 'nincs', 'nincs'),
(2, 'nincs', '10:00-14:00', 'nincs', '14:00-16:00', 'nincs', '8:00-10:00', 'nincs');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orvosok`
--

DROP TABLE IF EXISTS `orvosok`;
CREATE TABLE IF NOT EXISTS `orvosok` (
  `OID` int(11) NOT NULL AUTO_INCREMENT,
  `nev` varchar(250) DEFAULT NULL,
  `szakterulet` varchar(250) DEFAULT NULL,
  `mukodesi_azonosito` varchar(20) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `ugyeleti_oraszam` int(11) DEFAULT NULL,
  PRIMARY KEY (`OID`),
  UNIQUE KEY `OID` (`OID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- TÁBLA KAPCSOLATAI `orvosok`:
--

--
-- A tábla adatainak kiíratása `orvosok`
--

INSERT INTO `orvosok` (`OID`, `nev`, `szakterulet`, `mukodesi_azonosito`, `email`, `tel`, `ugyeleti_oraszam`) VALUES
(1, 'Kis Béla', 'háziorvos', '124FR47', 'r@b.hu', 61234567, 40),
(2, 'Nagy Rozália', 'gasztroenterológus', '194FR47', 're@b.hu', 617894612, 20),
(3, 'Hajós Alfréd', 'sebész', '824FR47', 'uiu@gmail.hu', 2147483647, 40),
(4, 'Kis Manyi', 'sebész', '124oR47', 'rplk@b.hu', 61234767, 40),
(5, 'Örvös Béla', 'háziorvos', '122TT47', 'jkljk@b.hu', 6145767, 60);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendelok`
--

DROP TABLE IF EXISTS `rendelok`;
CREATE TABLE IF NOT EXISTS `rendelok` (
  `razon` int(11) NOT NULL AUTO_INCREMENT,
  `telpules` varchar(250) DEFAULT NULL,
  `megye` varchar(250) DEFAULT NULL,
  `pontos cim` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`razon`),
  UNIQUE KEY `razon` (`razon`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- TÁBLA KAPCSOLATAI `rendelok`:
--

--
-- A tábla adatainak kiíratása `rendelok`
--

INSERT INTO `rendelok` (`razon`, `telpules`, `megye`, `pontos cim`) VALUES
(1, 'Homok', 'Győr-Moson-Sopron', 'Kisenyed utca 13'),
(2, 'Kecskemét', 'Bács-Kiskun', 'Hárs köz 6.'),
(3, 'Dedbrecen', 'Hajdú-Bihar', 'Fő utca 3.'),
(4, 'Homok', 'Győr-Moson-Sopron', 'Kerepesi utca 2.');

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `beosztas`
--
ALTER TABLE `beosztas`
  ADD CONSTRAINT `beosztas_ibfk_1` FOREIGN KEY (`razon`) REFERENCES `rendelok` (`razon`),
  ADD CONSTRAINT `beosztas_ibfk_2` FOREIGN KEY (`OID`) REFERENCES `orvosok` (`OID`);

--
-- Megkötések a táblához `nyilvantartas`
--
ALTER TABLE `nyilvantartas`
  ADD CONSTRAINT `nyilvantartas_ibfk_1` FOREIGN KEY (`RAZON`) REFERENCES `rendelok` (`razon`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

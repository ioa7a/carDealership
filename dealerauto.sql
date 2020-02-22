-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Gazdă: localhost:8090
-- Timp de generare: ian. 05, 2020 la 06:22 PM
-- Versiune server: 10.4.10-MariaDB
-- Versiune PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `dealerauto`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `caracteristici_masina`
--

CREATE TABLE `caracteristici_masina` (
  `idCaracteristici` int(11) NOT NULL,
  `Culoare` varchar(20) NOT NULL DEFAULT 'Alb',
  `Inaltime` float NOT NULL,
  `Latime` float NOT NULL,
  `Lungime` float NOT NULL,
  `NumarLocuri` int(11) DEFAULT NULL,
  `CapacitatePortbagaj` float DEFAULT NULL,
  `VolumIncarcare` float DEFAULT NULL,
  `Kilometraj` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `caracteristici_masina`
--

INSERT INTO `caracteristici_masina` (`idCaracteristici`, `Culoare`, `Inaltime`, `Latime`, `Lungime`, `NumarLocuri`, `CapacitatePortbagaj`, `VolumIncarcare`, `Kilometraj`) VALUES
(1, 'Alb perlat', 1685, 1855, 4600, 5, 580, 0.733, 550),
(2, 'Albastru cyan', 1685, 1855, 4600, 5, 580, 0.733, 550),
(3, 'Gri', 1673, 1839, 4486, 5, 453.6, 0.615, 4.5),
(4, 'Rosu Magnetic', 1452, 3995, 1743, 5, 500, 0.43, 5),
(5, 'Bronz', 1815, 1855, 3085, 5, 520, 0.5, 4.5),
(6, 'Albastru Cyan', 1504, 1844, 4693, 5, 400, 0.541, 3.9),
(7, 'Rosu Lithium', 1455, 1778, 4625, 5, NULL, NULL, 4.2),
(8, 'Albastru Bleumarin', 1510, 1809, 4702, 5, 400, 0.54, 4.1),
(9, 'Negru', 1880, 1848, 4753, 5, 630, 0.85, 4.5),
(10, 'Alb perlat', 1615, 1740, 4220, 5, NULL, NULL, 3.8),
(11, 'Rosu metalic', 1750, 1835, 4690, 5, NULL, NULL, 4.3),
(12, 'Bronz', 1745, 1785, 4685, 8, NULL, NULL, 4.6),
(13, 'Argintiu', 1615, 1733, 4089, 5, 237, 0.32, 4.6),
(14, 'Rosu', 1689, 1969, 4500, 5, 428, 0.58, 4.5),
(15, 'Gri', 1742, 1999, 4585, 5, 700, 0.948, NULL),
(16, 'Alb', 1504, 1844, 4693, 5, 400, 0.541, 4.4),
(17, 'Gri metalizat', 1815, 1855, 5330, 5, NULL, NULL, 4.2),
(18, 'Alb perlat', 1510, 1871, 4702, 5, 400, 0.54, 3.6),
(19, 'Bej', 1645, 1855, 4485, 5, NULL, NULL, 8.6),
(20, 'Negru lucios', 1815, 1855, 5330, 5, NULL, NULL, 5),
(21, 'Rosu', 1597, 1756, 4154, 5, 303, 0.41, 4.1),
(22, 'Galben', 1513, 1789, 4644, 5, 325, 0.44, 6.6),
(23, 'Verde', 1689, 1969, 4500, 5, 428, 0.58, 5.2),
(24, 'Roz', 1849, 1848, 4753, 7, 627, 0.85, 4.9),
(25, 'Rosu', 1440, 1825, 4880, 5, 350, 0.475, 10),
(26, 'Albastru Cyan', 1600, 1750, 4300, 5, NULL, NULL, 5.9),
(27, 'Magenta', 1605, 1765, 4212, 5, 302, 0.41, 4.4),
(28, 'Alb perlat', 1615, 1733, 4089, 5, 237, 0.32, 4.6),
(29, 'Alb mat', 1742, 1999, 4585, 5, 700, 0.948, NULL),
(30, 'Albastru bleumarin', 1690, 1855, 4600, 5, 428, 0.58, 7.2),
(31, 'Negru', 1645, 1855, 4485, 5, NULL, NULL, 8.6),
(32, 'Rosu', 1428, 1847, 4762, 5, 340, 0.46, 6.8),
(33, 'Roz', 1689, 1969, 4500, 5, 428, 0.58, 4.5),
(34, 'Magenta', 1615, 1740, 4220, 5, NULL, NULL, 3.8),
(35, 'Rosu neon', 1495, 1695, 4065, 5, 185, 0.25, 5.3),
(36, 'Gri', 1815, 1855, 5330, 5, NULL, NULL, 4.9),
(37, 'Gri Inchis', 1615, 1740, 4220, 5, NULL, NULL, 3.8),
(38, 'Alb', 1880, 1848, 4753, 5, 630, 0.85, 4.5),
(39, 'Negru Albastrui', 1719, 4556, 1855, 5, NULL, NULL, 8.3),
(40, 'Alb', 1473, 1854, 4933, 5, 384, 0.52, 6.7),
(41, 'Rosu neon', 1842, 1877, 4173, 4, 267, 0.362, 8.8),
(42, 'Albastru Deschis', 1510, 1809, 4702, 5, 400, 0.54, 4.1),
(43, 'Gri deschis', 1615, 1740, 4220, 5, NULL, NULL, 3.8),
(44, 'Magenta', 1535, 1765, 4275, 5, 259, 0.35, 7.7),
(45, 'Argintiu', 1480, 1840, 4805, 5, 385, 0.522, 8.9),
(46, 'Gri', 1750, 1835, 4690, 5, NULL, NULL, 4.3),
(47, 'Verde', 1930, 1920, 5306, 6, 730, 0.989, 6.6),
(48, 'Negru', 1455, 1778, 4625, 5, NULL, NULL, 4.2),
(49, 'Rosu', 1815, 1855, 5330, 5, NULL, NULL, 4.9),
(50, 'Albastru mat', 1550, 1815, 4300, 5, 299, 0.405, 4.2);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `categorie_optionale`
--

CREATE TABLE `categorie_optionale` (
  `idCategorie` int(11) NOT NULL,
  `Nume` varchar(50) DEFAULT NULL,
  `Descriere` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `categorie_optionale`
--

INSERT INTO `categorie_optionale` (`idCategorie`, `Nume`, `Descriere`) VALUES
(1, 'Interior', 'Optionale ce tin de interiorul automobilului'),
(2, 'Exterior', 'Optionale ce tin de exteriorul automobilului'),
(3, 'Siguranta', 'Optionale pentru imbunatatirea sigurantei soferului');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `masina`
--

CREATE TABLE `masina` (
  `idMasina` int(11) NOT NULL,
  `idModel` int(11) NOT NULL,
  `idCaracteristici` int(11) NOT NULL,
  `Combustibil` varchar(30) DEFAULT 'Benzina',
  `Putere` float DEFAULT NULL,
  `AnFabricatie` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `masina`
--

INSERT INTO `masina` (`idMasina`, `idModel`, `idCaracteristici`, `Combustibil`, `Putere`, `AnFabricatie`) VALUES
(1, 1, 2, 'Motorina', 300, 1994),
(2, 1, 1, 'Motorina', 300, 1994),
(3, 2, 3, 'Motorina', 150, 2007),
(4, 6, 4, 'Motorina', 150, 2006),
(5, 7, 5, 'Motorina', 300, 2000),
(6, 8, 6, 'Motorina', 160, 2004),
(7, 17, 7, 'Benzina', 152, 1992),
(8, 28, 8, 'Motorina', 100, 2000),
(9, 29, 9, 'Motorina', 100, 2011),
(10, 34, 10, 'Benzina', 150, 2017),
(12, 38, 12, 'Benzina', 150, 2015),
(13, 20, 13, 'Motorina', 140, 2008),
(14, 25, 14, 'Motorina', 110, 2000),
(15, 10, 15, 'Benzina', 150, 2001),
(16, 8, 16, 'Motorina', 160, 2004),
(17, 7, 17, 'Motorina', 300, 2000),
(18, 28, 18, 'Motorina', 100, 2000),
(19, 5, 19, 'Motorina', 130, 2001),
(20, 7, 20, 'Motorina', 300, 2000),
(21, 23, 21, 'Motorina', 110, 2002),
(22, 24, 22, 'Motorina', 110, 2017),
(23, 25, 23, 'Motorina', 110, 2000),
(24, 26, 24, 'Motorina', 110, 1997),
(25, 50, 25, 'Benzina', 200, 2014),
(26, 40, 26, 'Benzina', 150, 2019),
(27, 30, 27, 'Benzina', 100, 2017),
(28, 20, 28, 'Motorina', 140, 2008),
(29, 10, 29, 'Benzina', 150, 2001),
(30, 1, 30, 'Motorina', 300, 1994),
(31, 5, 31, 'Motorina', 130, 2001),
(33, 25, 33, 'Motorina', 110, 2000),
(35, 45, 35, 'Motorina', 100, 2000),
(36, 49, 36, 'Motorina', 150, 1995),
(37, 39, 37, 'Benzina', 150, 2016),
(38, 29, 38, 'Motorina', 100, 2011),
(39, 19, 39, 'Benzina', 152, 2016),
(40, 9, 40, 'Motorina', 200, 1997),
(41, 18, 41, 'Benzina', 270, 2006),
(42, 28, 42, 'Motorina', 100, 2000),
(43, 38, 43, 'Benzina', 150, 2015),
(44, 48, 44, 'Motorina', 100, 2015),
(45, 47, 45, 'Motorina', 150, 2006),
(46, 37, 46, 'Benzina', 150, 2012),
(47, 27, 47, 'Benzina', 110, 1996),
(48, 17, 48, 'Benzina', 152, 1992),
(49, 7, 49, 'Motorina', 300, 2000),
(50, 16, 50, 'Benzina', 163, 2013);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `model`
--

CREATE TABLE `model` (
  `idModel` int(11) NOT NULL,
  `Nume` varchar(50) NOT NULL,
  `Marca` varchar(50) NOT NULL,
  `Tara_Origine` varchar(40) DEFAULT 'Japonia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `model`
--

INSERT INTO `model` (`idModel`, `Nume`, `Marca`, `Tara_Origine`) VALUES
(1, 'SUV Toyota RAV4', 'Toyota', 'Japonia'),
(2, 'Volkswagen Tiguan', 'Volkswagen', 'Germania'),
(3, 'Toyota Corolla', 'Toyota', 'Japonia'),
(4, 'Honda Civic', 'Honda', 'Japonia'),
(5, 'Kia Sportage', 'Kia', 'Coreea de Sud'),
(6, 'Nissan Qashqai', 'Nissan', 'Japonia'),
(7, 'Toyota Hilux', 'Toyota', 'Japonia'),
(8, 'Ford Focus', 'Ford', 'S.U.A'),
(9, 'Chevrolet Malibu', 'Chevrolet', 'S.U.A'),
(10, 'Ford Escape', 'Ford', 'S.U.A'),
(11, 'Audi A3', 'Audi', 'Germania'),
(12, 'Mercedes GLC', 'Mercedes', 'Germania'),
(13, 'Toyota Tacoma', 'Toyota', 'Japonia'),
(14, 'Hyundai Creta', 'Hyundai', 'Coreea de Sud'),
(16, 'Peugeot 2008', 'Peugeot', 'Franta'),
(17, 'Subaru Impreza', 'Subaru', 'Japonia'),
(18, 'Jeep Wrangler', 'Jeep', 'S.U.A'),
(19, 'Roewe RX5', 'Roewe', 'China'),
(20, 'Dacia Sandero', 'Dacia', 'Romania'),
(21, 'Mazda CX-9', 'Mazda', 'Japonia'),
(22, 'Mitsubishi Outlander', 'Mitsubishi', 'Japonia'),
(23, 'Citroen C3', 'Citroen', 'Franta'),
(24, 'Citroen C4', 'Citroen', 'Franta'),
(25, 'Citroen C5', 'Citroen', 'Franta'),
(26, 'Citroen Berlingo', 'Citroen', 'Franta'),
(27, 'Citroen Spacetourrer', 'Citroen', 'Franta'),
(28, 'Opel Astra', 'Opel', 'Germania'),
(29, 'Opel Combo', 'Opel', 'Germania'),
(30, 'Opel Crossland X', 'Opel', 'Germania'),
(31, 'Opel Grandland X', 'Opel', 'Germania'),
(32, 'Opel Movano', 'Opel', 'Germania'),
(33, 'Opel Vivaro', 'Opel', 'Germania'),
(34, 'Baojun 510', 'Baojun', 'China'),
(36, 'Baojun 560', 'Baojun', 'China'),
(37, 'Baojun 610', 'Baojun', 'China'),
(38, 'Baojun 730', 'Baojun', 'China'),
(39, 'Baojun RS-5', 'Baojun', 'China'),
(40, 'Baojun RS-3', 'Baojun', 'China'),
(41, 'Baojun RM-5', 'Baojun', 'China'),
(42, 'Baojun RC-6', 'Baojun', 'China'),
(43, 'Mazda CX-5', 'Mazda', 'Japonia'),
(44, 'Mazda 3', 'Mazda', 'Japonia'),
(45, 'Mazda 2', 'Mazda', 'Japonia'),
(46, 'Mazda 5', 'Mazda', 'Japonia'),
(47, 'Mazda 6', 'Mazda', 'Japonia'),
(48, 'Mazda CX-3', 'Mazda', 'Japonia'),
(49, 'Audi A4', 'Audi', 'Germania'),
(50, 'Chevrolet Onix', 'Chevrolet', 'S.U.A'),
(51, 'Jeep Compass', 'Jeep', 'S.U.A'),
(52, 'Baojun 530', 'Baojun', 'China');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `optionale`
--

CREATE TABLE `optionale` (
  `idOptional` int(11) NOT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  `Nume` varchar(50) NOT NULL,
  `Descriere` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `optionale`
--

INSERT INTO `optionale` (`idOptional`, `idCategorie`, `Nume`, `Descriere`) VALUES
(1, 1, 'Carcasa cheie', '-'),
(3, 1, 'Suport tableta', 'Suport ajustabil pentru tableta, fixat de scaun'),
(5, 2, 'Carlig remorcare', 'Carlig pentru remorcare, detasabil sau fix'),
(6, 2, 'Jante lucioase', 'Jante aliaj 17 inchi, argintiu lucios, 5 spite'),
(7, 1, 'Covor portbagaj', 'Covoras de protectie pentru portbagaj'),
(8, 2, 'Priza V1', 'Priza electrica cu 13 pini'),
(9, 2, 'Priza V2', 'Priza electrica cu 7 pini'),
(10, 3, 'Kit senzori parcare', 'Kit cu doi senzori de parcare disponibili in diferite culori'),
(12, 1, 'Incarcator wireless', 'Pentru telefoane mobile compatibile cu incarcare wireless QI'),
(13, 2, 'Ornament prag', 'Ornamente iluminate pentru pragul masinii'),
(14, 2, 'Aparatoare noroi', 'Aparatori de noroi durabile'),
(15, 1, 'Ecran protectie solara', 'Ecran pentru protectie solara UVS100, pentru protejarea interiorului masinii de soare'),
(16, 1, 'Acoperitoare scaun V1', 'Acoperitoare protective pentru scaunele masinii, maro deschis'),
(17, 1, 'Acoperitoare scaun V2', 'Acoperitoare protective pentru scaunele masinii, negru'),
(18, 1, 'Acoperitoare scaun V3', 'Acoperitoare protective pentru scaunele masinii, maro inchis'),
(19, 1, 'Acoperitoare scaun V4', 'Acoperitoare protective pentru scaunele masinii, bej'),
(20, 1, 'Acoperitoare scaun V1', 'Acoperitoare protective pentru scaunele masinii, gri'),
(21, 2, 'Acoperitoare vehicul V1', 'Acoperitoare protectiva vehicul, negru'),
(22, 2, 'Acoperitoare vehicul V2', 'Acoperitoare protectiva vehicul, gri'),
(23, 2, 'Acoperitoare vehicul V3', 'Acoperitoare protectiva vehicul, maro inchis'),
(24, 2, 'Acoperitoare vehicul V4', 'Acoperitoare protectiva vehicul, maro deschis'),
(25, 2, 'Acoperitoare vehicul V1', 'Acoperitoare protectiva vehicul, bleumarin'),
(26, 1, 'Filtru V1', 'Filtru hidraulic pentru cutia de viteze'),
(27, 1, 'Filtru V2', 'Filtru aer'),
(28, 1, 'Filtru V3', 'Filtru polen'),
(29, 1, 'Filtru V4', 'Filru ulei'),
(30, 1, 'Filtru V5', 'Filtru combustibil'),
(31, 1, 'Scrumiera', '-');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `optionale_masina`
--

CREATE TABLE `optionale_masina` (
  `idOptMasina` int(11) DEFAULT NULL,
  `idMasina` int(11) NOT NULL,
  `idOptional` int(11) DEFAULT NULL,
  `Observatii` varchar(200) DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `optionale_masina`
--

INSERT INTO `optionale_masina` (`idOptMasina`, `idMasina`, `idOptional`, `Observatii`) VALUES
(1, 2, 1, 'None'),
(2, 2, 8, 'None'),
(3, 2, 1, 'None'),
(4, 1, 25, 'None'),
(5, 1, 13, 'None'),
(8, 20, 5, 'None'),
(9, 15, 7, 'None'),
(10, 10, 9, 'None'),
(12, 25, 13, 'None'),
(13, 30, 15, 'None'),
(15, 35, 17, 'None'),
(19, 40, 19, 'None'),
(20, 45, 21, 'None'),
(24, 50, 23, 'None'),
(25, 49, 25, 'None'),
(30, 48, 27, 'None'),
(35, 48, 29, 'None'),
(40, 7, 10, 'None'),
(45, 9, 12, 'None'),
(47, 13, 17, 'None'),
(48, 15, 16, 'None'),
(49, 15, 10, 'None'),
(50, 8, 7, 'None');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `caracteristici_masina`
--
ALTER TABLE `caracteristici_masina`
  ADD PRIMARY KEY (`idCaracteristici`);

--
-- Indexuri pentru tabele `categorie_optionale`
--
ALTER TABLE `categorie_optionale`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Indexuri pentru tabele `masina`
--
ALTER TABLE `masina`
  ADD PRIMARY KEY (`idMasina`),
  ADD KEY `modelFK` (`idModel`),
  ADD KEY `caracteristiciFK` (`idCaracteristici`) USING BTREE;

--
-- Indexuri pentru tabele `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`idModel`),
  ADD UNIQUE KEY `modelUnic` (`Nume`);

--
-- Indexuri pentru tabele `optionale`
--
ALTER TABLE `optionale`
  ADD PRIMARY KEY (`idOptional`),
  ADD KEY `optionale_ibfk_1` (`idCategorie`);

--
-- Indexuri pentru tabele `optionale_masina`
--
ALTER TABLE `optionale_masina`
  ADD KEY `optionale_masina_ibfk_1` (`idOptional`),
  ADD KEY `optionale_masina_ibfk_2` (`idMasina`);

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `masina`
--
ALTER TABLE `masina`
  ADD CONSTRAINT `caracteristiciFK` FOREIGN KEY (`idCaracteristici`) REFERENCES `caracteristici_masina` (`idCaracteristici`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `modelFK` FOREIGN KEY (`idModel`) REFERENCES `model` (`idModel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `optionale`
--
ALTER TABLE `optionale`
  ADD CONSTRAINT `optionale_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie_optionale` (`idCategorie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `optionale_masina`
--
ALTER TABLE `optionale_masina`
  ADD CONSTRAINT `optionale_masina_ibfk_1` FOREIGN KEY (`idOptional`) REFERENCES `optionale` (`idOptional`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `optionale_masina_ibfk_2` FOREIGN KEY (`idMasina`) REFERENCES `masina` (`idMasina`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Pon 23. zář 2019, 23:26
-- Verze serveru: 5.7.21
-- Verze PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `kingspanpujcovna`
--
CREATE DATABASE IF NOT EXISTS `kingspanpujcovna` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `kingspanpujcovna`;

-- --------------------------------------------------------

--
-- Struktura tabulky `cenanastavenazakaznikovi`
--

DROP TABLE IF EXISTS `cenanastavenazakaznikovi`;
CREATE TABLE IF NOT EXISTS `cenanastavenazakaznikovi` (
  `typproduktu_idtypproduktu` int(11) NOT NULL,
  `zakaznici_idzakaznici` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  PRIMARY KEY (`typproduktu_idtypproduktu`,`zakaznici_idzakaznici`),
  KEY `fk_typproduktu_has_zakaznici_zakaznici1_idx` (`zakaznici_idzakaznici`),
  KEY `fk_typproduktu_has_zakaznici_typproduktu1_idx` (`typproduktu_idtypproduktu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `cenanastavenazakaznikovi`
--

INSERT INTO `cenanastavenazakaznikovi` (`typproduktu_idtypproduktu`, `zakaznici_idzakaznici`, `cena`) VALUES
(1, 1, 300),
(2, 1, 1000),
(3, 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `objednavky`
--

DROP TABLE IF EXISTS `objednavky`;
CREATE TABLE IF NOT EXISTS `objednavky` (
  `idbjednavky` int(11) NOT NULL AUTO_INCREMENT,
  `produkty_idprodukty` int(11) NOT NULL,
  `zakaznici_idzakaznici` int(11) NOT NULL,
  `od` date NOT NULL,
  `do` date NOT NULL,
  `Jmeno` varchar(100) NOT NULL,
  `Prijmeni` varchar(100) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Telefon` varchar(20) NOT NULL,
  `AdresaDoruceni` varchar(200) NOT NULL,
  `MestoDoruceni` varchar(200) NOT NULL,
  `zpusobdoruceni_idzpusobdoruceni` int(11) NOT NULL,
  `cenazaden` int(11) NOT NULL,
  PRIMARY KEY (`idbjednavky`),
  KEY `fk_objednavky_produkty1_idx` (`produkty_idprodukty`),
  KEY `fk_objednavky_zakaznici1_idx` (`zakaznici_idzakaznici`),
  KEY `fk_objednavky_zpusobdoruceni1_idx` (`zpusobdoruceni_idzpusobdoruceni`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `objednavky`
--

INSERT INTO `objednavky` (`idbjednavky`, `produkty_idprodukty`, `zakaznici_idzakaznici`, `od`, `do`, `Jmeno`, `Prijmeni`, `Email`, `Telefon`, `AdresaDoruceni`, `MestoDoruceni`, `zpusobdoruceni_idzpusobdoruceni`, `cenazaden`) VALUES
(3, 3, 1, '2019-09-29', '2019-10-03', 'Matěj', 'Pospíšil', 'MatejPospisil@email.cz', '7456456', 'dsadsadas', 'Mestoo', 1, 1000),
(4, 4, 1, '2019-09-25', '2019-09-27', 'Matěj', 'Pospíšil', 'MatejPospisill@email.cz', '777675157', 'Sluneční 382', 'Srch', 2, 1000),
(5, 3, 1, '2019-09-25', '2019-09-28', 'Matěj', 'Pospíšil', 'MatejPospisill@email.cz', '777675157', 'Sluneční 382', 'Srch', 2, 1000),
(6, 4, 1, '2019-10-16', '2019-10-18', 'Matěj', 'Pospíšil', 'MatejPospisill@email.cz', '777675157', 'Sluneční 382', 'Srch', 2, 0),
(7, 4, 1, '2019-10-28', '2019-10-28', 'Matěj', 'Pospíšil', 'huby', 'dp', 'jebu', 'te', 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `prava`
--

DROP TABLE IF EXISTS `prava`;
CREATE TABLE IF NOT EXISTS `prava` (
  `idprava` int(11) NOT NULL AUTO_INCREMENT,
  `nazevprava` varchar(45) NOT NULL,
  PRIMARY KEY (`idprava`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `prava`
--

INSERT INTO `prava` (`idprava`, `nazevprava`) VALUES
(1, 'Admin'),
(2, 'Obchodník'),
(3, 'Zákazník');

-- --------------------------------------------------------

--
-- Struktura tabulky `produkty`
--

DROP TABLE IF EXISTS `produkty`;
CREATE TABLE IF NOT EXISTS `produkty` (
  `idprodukty` int(11) NOT NULL AUTO_INCREMENT,
  `typproduktu_idtypproduktu` int(11) NOT NULL,
  `typpanelu_idtyppanelu` int(11) NOT NULL,
  `typtloustky_idtyptloustky` int(11) NOT NULL,
  PRIMARY KEY (`idprodukty`),
  KEY `fk_produkty_typproduktu_idx` (`typproduktu_idtypproduktu`),
  KEY `fk_produkty_typpanelu1_idx` (`typpanelu_idtyppanelu`),
  KEY `fk_produkty_typtloustky1_idx` (`typtloustky_idtyptloustky`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `produkty`
--

INSERT INTO `produkty` (`idprodukty`, `typproduktu_idtypproduktu`, `typpanelu_idtyppanelu`, `typtloustky_idtyptloustky`) VALUES
(3, 2, 8, 9),
(4, 3, 8, 9);

-- --------------------------------------------------------

--
-- Struktura tabulky `typpanelu`
--

DROP TABLE IF EXISTS `typpanelu`;
CREATE TABLE IF NOT EXISTS `typpanelu` (
  `idtyppanelu` int(11) NOT NULL AUTO_INCREMENT,
  `typpanelu` varchar(45) NOT NULL,
  PRIMARY KEY (`idtyppanelu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `typpanelu`
--

INSERT INTO `typpanelu` (`idtyppanelu`, `typpanelu`) VALUES
(1, 'FR-80'),
(2, 'FR-100'),
(3, 'FR-120'),
(4, 'FR-150'),
(5, 'FH-100'),
(6, 'FH-120'),
(7, 'FH-150'),
(8, 'Střešní panely');

-- --------------------------------------------------------

--
-- Struktura tabulky `typproduktu`
--

DROP TABLE IF EXISTS `typproduktu`;
CREATE TABLE IF NOT EXISTS `typproduktu` (
  `idtypproduktu` int(11) NOT NULL AUTO_INCREMENT,
  `typproduktu` varchar(45) NOT NULL,
  PRIMARY KEY (`idtypproduktu`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `typproduktu`
--

INSERT INTO `typproduktu` (`idtypproduktu`, `typproduktu`) VALUES
(1, 'Žehlička'),
(2, 'Rota boy'),
(3, 'Svěrka');

-- --------------------------------------------------------

--
-- Struktura tabulky `typtloustky`
--

DROP TABLE IF EXISTS `typtloustky`;
CREATE TABLE IF NOT EXISTS `typtloustky` (
  `idtyptloustky` int(11) NOT NULL AUTO_INCREMENT,
  `tloustka` varchar(3) NOT NULL,
  PRIMARY KEY (`idtyptloustky`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `typtloustky`
--

INSERT INTO `typtloustky` (`idtyptloustky`, `tloustka`) VALUES
(1, '60'),
(2, '80'),
(3, '100'),
(4, '120'),
(5, '140'),
(6, '160'),
(7, '180'),
(8, '200'),
(9, 'NaN');

-- --------------------------------------------------------

--
-- Struktura tabulky `zakaznici`
--

DROP TABLE IF EXISTS `zakaznici`;
CREATE TABLE IF NOT EXISTS `zakaznici` (
  `idzakaznici` int(11) NOT NULL AUTO_INCREMENT,
  `nazevFirmy` varchar(100) NOT NULL,
  `ICO` varchar(8) NOT NULL,
  `DIC` varchar(12) NOT NULL,
  `Adresa` varchar(200) NOT NULL,
  `Mesto` varchar(100) NOT NULL,
  `ZIP` char(5) NOT NULL,
  `Jmeno` varchar(100) NOT NULL,
  `Prijmeni` varchar(100) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Telefon` varchar(20) NOT NULL,
  `prava_idprava` int(11) NOT NULL,
  `heslo` varchar(42) DEFAULT NULL,
  PRIMARY KEY (`idzakaznici`),
  KEY `fk_zakaznici_prava1_idx` (`prava_idprava`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `zakaznici`
--

INSERT INTO `zakaznici` (`idzakaznici`, `nazevFirmy`, `ICO`, `DIC`, `Adresa`, `Mesto`, `ZIP`, `Jmeno`, `Prijmeni`, `Email`, `Telefon`, `prava_idprava`, `heslo`) VALUES
(1, 'Fuzan s.r.o', '53351235', 'CZ1010101010', 'Sluneční 382', 'Srch', '53352', 'Matěj', 'Pospíšil', 'MatejPospisill@email.cz', '777675157', 1, 'fuzan');

-- --------------------------------------------------------

--
-- Struktura tabulky `zpusobdoruceni`
--

DROP TABLE IF EXISTS `zpusobdoruceni`;
CREATE TABLE IF NOT EXISTS `zpusobdoruceni` (
  `idzpusobdoruceni` int(11) NOT NULL AUTO_INCREMENT,
  `zpusobdoruceni` varchar(45) NOT NULL,
  PRIMARY KEY (`idzpusobdoruceni`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `zpusobdoruceni`
--

INSERT INTO `zpusobdoruceni` (`idzpusobdoruceni`, `zpusobdoruceni`) VALUES
(1, 'Česká pošta'),
(2, 'Osobní předání');

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `cenanastavenazakaznikovi`
--
ALTER TABLE `cenanastavenazakaznikovi`
  ADD CONSTRAINT `fk_typproduktu_has_zakaznici_typproduktu1` FOREIGN KEY (`typproduktu_idtypproduktu`) REFERENCES `typproduktu` (`idtypproduktu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_typproduktu_has_zakaznici_zakaznici1` FOREIGN KEY (`zakaznici_idzakaznici`) REFERENCES `zakaznici` (`idzakaznici`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `objednavky`
--
ALTER TABLE `objednavky`
  ADD CONSTRAINT `fk_objednavky_produkty1` FOREIGN KEY (`produkty_idprodukty`) REFERENCES `produkty` (`idprodukty`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_objednavky_zakaznici1` FOREIGN KEY (`zakaznici_idzakaznici`) REFERENCES `zakaznici` (`idzakaznici`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_objednavky_zpusobdoruceni1` FOREIGN KEY (`zpusobdoruceni_idzpusobdoruceni`) REFERENCES `zpusobdoruceni` (`idzpusobdoruceni`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `fk_produkty_typpanelu1` FOREIGN KEY (`typpanelu_idtyppanelu`) REFERENCES `typpanelu` (`idtyppanelu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produkty_typproduktu` FOREIGN KEY (`typproduktu_idtypproduktu`) REFERENCES `typproduktu` (`idtypproduktu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produkty_typtloustky1` FOREIGN KEY (`typtloustky_idtyptloustky`) REFERENCES `typtloustky` (`idtyptloustky`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `zakaznici`
--
ALTER TABLE `zakaznici`
  ADD CONSTRAINT `fk_zakaznici_prava1` FOREIGN KEY (`prava_idprava`) REFERENCES `prava` (`idprava`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
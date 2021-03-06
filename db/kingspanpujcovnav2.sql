-- MySQL Script generated by MySQL Workbench
-- Sat Sep 14 16:15:34 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema kingspanpujcovna
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema kingspanpujcovna
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `kingspanpujcovna` DEFAULT CHARACTER SET utf8 ;
USE `kingspanpujcovna` ;

-- -----------------------------------------------------
-- Table `kingspanpujcovna`.`typproduktu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kingspanpujcovna`.`typproduktu` (
  `idtypproduktu` INT(11) NOT NULL AUTO_INCREMENT,
  `typproduktu` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtypproduktu`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kingspanpujcovna`.`prava`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kingspanpujcovna`.`prava` (
  `idprava` INT(11) NOT NULL AUTO_INCREMENT,
  `nazevprava` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idprava`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kingspanpujcovna`.`zakaznici`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kingspanpujcovna`.`zakaznici` (
  `idzakaznici` INT(11) NOT NULL AUTO_INCREMENT,
  `nazevFirmy` VARCHAR(100) NOT NULL,
  `ICO` VARCHAR(8) NOT NULL,
  `DIC` VARCHAR(12) NOT NULL,
  `Adresa` VARCHAR(200) NOT NULL,
  `Mesto` VARCHAR(100) NOT NULL,
  `ZIP` CHAR(5) NOT NULL,
  `Jmeno` VARCHAR(100) NOT NULL,
  `Prijmeni` VARCHAR(100) NOT NULL,
  `Email` VARCHAR(200) NOT NULL,
  `Telefon` VARCHAR(20) NOT NULL,
  `prava_idprava` INT(11) NOT NULL,
  `heslo` VARCHAR(42) NULL DEFAULT NULL,
  PRIMARY KEY (`idzakaznici`),
  INDEX `fk_zakaznici_prava1_idx` (`prava_idprava` ASC),
  CONSTRAINT `fk_zakaznici_prava1`
    FOREIGN KEY (`prava_idprava`)
    REFERENCES `kingspanpujcovna`.`prava` (`idprava`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kingspanpujcovna`.`cenanastavenazakaznikovi`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kingspanpujcovna`.`cenanastavenazakaznikovi` (
  `typproduktu_idtypproduktu` INT(11) NOT NULL,
  `zakaznici_idzakaznici` INT(11) NOT NULL,
  `cena` INT(11) NOT NULL,
  PRIMARY KEY (`typproduktu_idtypproduktu`, `zakaznici_idzakaznici`),
  INDEX `fk_typproduktu_has_zakaznici_zakaznici1_idx` (`zakaznici_idzakaznici` ASC),
  INDEX `fk_typproduktu_has_zakaznici_typproduktu1_idx` (`typproduktu_idtypproduktu` ASC),
  CONSTRAINT `fk_typproduktu_has_zakaznici_typproduktu1`
    FOREIGN KEY (`typproduktu_idtypproduktu`)
    REFERENCES `kingspanpujcovna`.`typproduktu` (`idtypproduktu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_typproduktu_has_zakaznici_zakaznici1`
    FOREIGN KEY (`zakaznici_idzakaznici`)
    REFERENCES `kingspanpujcovna`.`zakaznici` (`idzakaznici`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kingspanpujcovna`.`typpanelu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kingspanpujcovna`.`typpanelu` (
  `idtyppanelu` INT(11) NOT NULL AUTO_INCREMENT,
  `typpanelu` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtyppanelu`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kingspanpujcovna`.`typtloustky`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kingspanpujcovna`.`typtloustky` (
  `idtyptloustky` INT(11) NOT NULL AUTO_INCREMENT,
  `tloustka` VARCHAR(3) NOT NULL,
  PRIMARY KEY (`idtyptloustky`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kingspanpujcovna`.`produkty`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kingspanpujcovna`.`produkty` (
  `idprodukty` INT(11) NOT NULL AUTO_INCREMENT,
  `typproduktu_idtypproduktu` INT(11) NOT NULL,
  `typpanelu_idtyppanelu` INT(11) NOT NULL,
  `typtloustky_idtyptloustky` INT(11) NOT NULL,
  `rezervaceod` DATE NOT NULL,
  `rezervacedo` DATE NOT NULL,
  `stav` TINYINT(4) NOT NULL,
  `umisteni` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idprodukty`),
  INDEX `fk_produkty_typproduktu_idx` (`typproduktu_idtypproduktu` ASC),
  INDEX `fk_produkty_typpanelu1_idx` (`typpanelu_idtyppanelu` ASC),
  INDEX `fk_produkty_typtloustky1_idx` (`typtloustky_idtyptloustky` ASC),
  CONSTRAINT `fk_produkty_typpanelu1`
    FOREIGN KEY (`typpanelu_idtyppanelu`)
    REFERENCES `kingspanpujcovna`.`typpanelu` (`idtyppanelu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produkty_typproduktu`
    FOREIGN KEY (`typproduktu_idtypproduktu`)
    REFERENCES `kingspanpujcovna`.`typproduktu` (`idtypproduktu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produkty_typtloustky1`
    FOREIGN KEY (`typtloustky_idtyptloustky`)
    REFERENCES `kingspanpujcovna`.`typtloustky` (`idtyptloustky`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kingspanpujcovna`.`zpusobdoruceni`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kingspanpujcovna`.`zpusobdoruceni` (
  `idzpusobdoruceni` INT NOT NULL AUTO_INCREMENT,
  `zpusobdoruceni` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idzpusobdoruceni`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kingspanpujcovna`.`objednavky`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kingspanpujcovna`.`objednavky` (
  `produkty_idprodukty` INT(11) NOT NULL,
  `zakaznici_idzakaznici` INT(11) NOT NULL,
  `od` DATE NOT NULL,
  `do` DATE NOT NULL,
  `Jmeno` VARCHAR(100) NOT NULL,
  `Prijmeni` VARCHAR(100) NOT NULL,
  `Email` VARCHAR(200) NOT NULL,
  `Telefon` VARCHAR(20) NOT NULL,
  `zpusobdoruceni_idzpusobdoruceni` INT NOT NULL,
  PRIMARY KEY (`produkty_idprodukty`, `zakaznici_idzakaznici`),
  INDEX `fk_objednavky_produkty1_idx` (`produkty_idprodukty` ASC),
  INDEX `fk_objednavky_zakaznici1_idx` (`zakaznici_idzakaznici` ASC),
  INDEX `fk_objednavky_zpusobdoruceni1_idx` (`zpusobdoruceni_idzpusobdoruceni` ASC),
  CONSTRAINT `fk_objednavky_produkty1`
    FOREIGN KEY (`produkty_idprodukty`)
    REFERENCES `kingspanpujcovna`.`produkty` (`idprodukty`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_objednavky_zakaznici1`
    FOREIGN KEY (`zakaznici_idzakaznici`)
    REFERENCES `kingspanpujcovna`.`zakaznici` (`idzakaznici`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_objednavky_zpusobdoruceni1`
    FOREIGN KEY (`zpusobdoruceni_idzpusobdoruceni`)
    REFERENCES `kingspanpujcovna`.`zpusobdoruceni` (`idzpusobdoruceni`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

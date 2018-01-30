-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema RapidsCemetery
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `RapidsCemetery` ;

-- -----------------------------------------------------
-- Schema RapidsCemetery
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `RapidsCemetery` DEFAULT CHARACTER SET utf8 ;
USE `RapidsCemetery` ;

-- -----------------------------------------------------
-- Table `RapidsCemetery`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`User` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`User` (
  `idAccount` INT NOT NULL,
  `firstName` VARCHAR(80) NULL,
  `lastName` VARCHAR(80) NULL,
  `email` VARCHAR(80) NULL,
  `password` VARCHAR(80) NULL,
  PRIMARY KEY (`idAccount`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`WiderLocation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`WiderLocation` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`WiderLocation` (
  `idLocation` INT NOT NULL,
  `name` VARCHAR(100) NULL,
  `description` BLOB NULL,
  `url` VARCHAR(2083) NULL,
  `longitude` DECIMAL(9,6) NULL,
  `latitude` DECIMAL(9,6) NULL,
  `address` VARCHAR(100) NULL,
  `city` VARCHAR(100) NULL,
  `state` VARCHAR(2) NULL,
  `zipcode` INT NULL,
  PRIMARY KEY (`idLocation`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`Event` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Event` (
  `idEvent` INT NOT NULL,
  `name` VARCHAR(100) NULL,
  `description` BLOB NULL,
  `startTime` DATETIME NULL,
  `endTime` DATETIME NULL,
  PRIMARY KEY (`idEvent`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`FAQ`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`FAQ` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`FAQ` (
  `idFAQ` INT NOT NULL,
  `question` VARCHAR(150) NULL,
  `answer` BLOB NULL,
  PRIMARY KEY (`idFAQ`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`HistoricFilter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`HistoricFilter` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`HistoricFilter` (
  `idHistoricFilter` INT NOT NULL,
  `historicFilterName` VARCHAR(100) NULL,
  `dateStart` DATE NULL,
  `dateEnd` DATE NULL,
  `description` BLOB NULL,
  `imageLocation` VARCHAR(50) NULL,
  `imageDescription` VARCHAR(150) NULL,
  PRIMARY KEY (`idHistoricFilter`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`TypeFilter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`TypeFilter` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`TypeFilter` (
  `idTypeFilter` INT NOT NULL,
  `type` VARCHAR(45) NULL,
  PRIMARY KEY (`idTypeFilter`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`GraveDetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`GraveDetail` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`GraveDetail` (
  `idGraveDetail` INT NOT NULL DEFAULT -1,
  `firstName` VARCHAR(75) NULL,
  `middleName` VARCHAR(75) NULL,
  `lastName` VARCHAR(75) NULL,
  `birth` DATE NULL,
  `death` DATE NULL,
  `description` BLOB NULL,
  `idHistoricFilter` INT NOT NULL,
  PRIMARY KEY (`idGraveDetail`, `idHistoricFilter`),
  INDEX `fk_GraveDetail_HistoricFilter1_idx` (`idHistoricFilter` ASC),
  CONSTRAINT `fk_GraveDetail_HistoricFilter1`
    FOREIGN KEY (`idHistoricFilter`)
    REFERENCES `RapidsCemetery`.`HistoricFilter` (`idHistoricFilter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`NaturalHistoryDetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`NaturalHistoryDetail` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`NaturalHistoryDetail` (
  `idNaturalHistoryDetail` INT NOT NULL DEFAULT -1,
  `commonName` VARCHAR(100) NULL,
  `scientificName` VARCHAR(150) NULL,
  `description` BLOB NULL,
  PRIMARY KEY (`idNaturalHistoryDetail`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`MiscDetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`MiscDetail` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`MiscDetail` (
  `idMiscDetail` INT NOT NULL DEFAULT -1,
  `name` VARCHAR(75) NULL,
  `description` BLOB NULL,
  `isHazard` ENUM('Yes', 'No') NOT NULL,
  PRIMARY KEY (`idMiscDetail`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`PlotDetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`PlotDetail` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`PlotDetail` (
  `idPlotDetail` INT NOT NULL,
  `name` VARCHAR(100) NULL,
  `description` BLOB NULL,
  PRIMARY KEY (`idPlotDetail`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`TrackableObject`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`TrackableObject` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`TrackableObject` (
  `idTrackableObject` INT NOT NULL,
  `longitude` DECIMAL(9,6) NULL,
  `latitude` DECIMAL(9,6) NULL,
  `qrCode` VARCHAR(45) NULL,
  `hint` VARCHAR(100) NULL,
  `imageDescription` VARCHAR(100) NULL,
  `imageLocation` VARCHAR(5000) NULL,
  `idTypeFilter` INT NOT NULL,
  `idGraveDetail` INT NOT NULL DEFAULT -1,
  `idNaturalHistoryDetail` INT NOT NULL DEFAULT -1,
  `idMiscDetail` INT NOT NULL DEFAULT -1,
  `idPlotDetail` INT NOT NULL,
  PRIMARY KEY (`idTrackableObject`, `idTypeFilter`, `idGraveDetail`, `idNaturalHistoryDetail`, `idMiscDetail`, `idPlotDetail`),
  INDEX `fk_TrackableObject_TypeFilter1_idx` (`idTypeFilter` ASC),
  INDEX `fk_TrackableObject_GraveDetail1_idx` (`idGraveDetail` ASC),
  INDEX `fk_TrackableObject_VegetationDetail1_idx` (`idNaturalHistoryDetail` ASC),
  INDEX `fk_TrackableObject_MiscDetail1_idx` (`idMiscDetail` ASC),
  INDEX `fk_TrackableObject_PlotDetail1_idx` (`idPlotDetail` ASC),
  CONSTRAINT `fk_TrackableObject_TypeFilter1`
    FOREIGN KEY (`idTypeFilter`)
    REFERENCES `RapidsCemetery`.`TypeFilter` (`idTypeFilter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_GraveDetail1`
    FOREIGN KEY (`idGraveDetail`)
    REFERENCES `RapidsCemetery`.`GraveDetail` (`idGraveDetail`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_VegetationDetail1`
    FOREIGN KEY (`idNaturalHistoryDetail`)
    REFERENCES `RapidsCemetery`.`NaturalHistoryDetail` (`idNaturalHistoryDetail`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_MiscDetail1`
    FOREIGN KEY (`idMiscDetail`)
    REFERENCES `RapidsCemetery`.`MiscDetail` (`idMiscDetail`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_PlotDetail1`
    FOREIGN KEY (`idPlotDetail`)
    REFERENCES `RapidsCemetery`.`PlotDetail` (`idPlotDetail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Contact`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`Contact` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Contact` (
  `idContact` INT NOT NULL,
  `name` VARCHAR(80) NULL,
  `email` VARCHAR(80) NULL,
  `description` VARCHAR(80) NULL,
  `phone` VARCHAR(80) NULL,
  PRIMARY KEY (`idContact`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

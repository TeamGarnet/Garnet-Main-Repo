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
  `idUser` INT NOT NULL,
  `firstName` VARCHAR(80) NULL,
  `lastName` VARCHAR(80) NULL,
  `email` VARCHAR(80) NULL,
  `password` VARCHAR(80) NULL,
  PRIMARY KEY (`idUser`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`WiderAreaMap`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`WiderAreaMap` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`WiderAreaMap` (
  `idWiderAreaMap` INT NOT NULL,
  `name` VARCHAR(100) NULL,
  `description` BLOB NULL,
  `url` VARCHAR(2083) NULL,
  `longitude` DECIMAL(9,6) NULL,
  `latitude` DECIMAL(9,6) NULL,
  `address` VARCHAR(100) NULL,
  `city` VARCHAR(100) NULL,
  `state` VARCHAR(2) NULL,
  `zipcode` INT NULL,
  PRIMARY KEY (`idWiderAreaMap`))
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
  `idWiderAreaMap` INT NULL,
  PRIMARY KEY (`idEvent`),
  INDEX `fk_Event_WiderAreaMap1_idx` (`idWiderAreaMap` ASC),
  CONSTRAINT `fk_Event_WiderAreaMap1`
    FOREIGN KEY (`idWiderAreaMap`)
    REFERENCES `RapidsCemetery`.`WiderAreaMap` (`idWiderAreaMap`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`FAQ`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`FAQ` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`FAQ` (
  `idFAQ` INT NOT NULL,
  `question` VARCHAR(300) NULL,
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
  PRIMARY KEY (`idHistoricFilter`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`TypeFilter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`TypeFilter` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`TypeFilter` (
  `idTypeFilter` INT NOT NULL,
  `type` VARCHAR(45) NULL,
  `pinDesign` VARCHAR(500) NULL,
  PRIMARY KEY (`idTypeFilter`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Grave`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`Grave` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Grave` (
  `idGrave` INT NOT NULL,
  `firstName` VARCHAR(75) NULL,
  `middleName` VARCHAR(75) NULL,
  `lastName` VARCHAR(75) NULL,
  `birth` DATE NULL,
  `death` DATE NULL,
  `description` BLOB NULL,
  `idHistoricFilter` INT NULL,
  PRIMARY KEY (`idGrave`),
  INDEX `fk_GraveDetail_HistoricFilter1_idx` (`idHistoricFilter` ASC),
  CONSTRAINT `fk_GraveDetail_HistoricFilter1`
    FOREIGN KEY (`idHistoricFilter`)
    REFERENCES `RapidsCemetery`.`HistoricFilter` (`idHistoricFilter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`NaturalHistory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`NaturalHistory` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`NaturalHistory` (
  `idNaturalHistory` INT NOT NULL,
  `commonName` VARCHAR(100) NULL,
  `scientificName` VARCHAR(150) NULL,
  `description` BLOB NULL,
  PRIMARY KEY (`idNaturalHistory`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`MiscObject`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`MiscObject` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`MiscObject` (
  `idMisc` INT NOT NULL,
  `name` VARCHAR(75) NULL,
  `description` BLOB NULL,
  `isHazard` ENUM('Yes', 'No') NOT NULL,
  PRIMARY KEY (`idMisc`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Group`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`Group` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Group` (
  `idGroup` INT NOT NULL,
  `name` VARCHAR(100) NULL,
  `description` BLOB NULL,
  PRIMARY KEY (`idGroup`))
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
  `idGrave` INT NULL,
  `idNaturalHistory` INT NULL,
  `idMisc` INT NULL,
  `idGroup` INT NULL,
  PRIMARY KEY (`idTrackableObject`, `idTypeFilter`),
  INDEX `fk_TrackableObject_TypeFilter1_idx` (`idTypeFilter` ASC),
  INDEX `fk_TrackableObject_GraveDetail1_idx` (`idGrave` ASC),
  INDEX `fk_TrackableObject_VegetationDetail1_idx` (`idNaturalHistory` ASC),
  INDEX `fk_TrackableObject_MiscDetail1_idx` (`idMisc` ASC),
  INDEX `fk_TrackableObject_PlotDetail1_idx` (`idGroup` ASC),
  CONSTRAINT `fk_TrackableObject_TypeFilter1`
    FOREIGN KEY (`idTypeFilter`)
    REFERENCES `RapidsCemetery`.`TypeFilter` (`idTypeFilter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_GraveDetail1`
    FOREIGN KEY (`idGrave`)
    REFERENCES `RapidsCemetery`.`Grave` (`idGrave`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_VegetationDetail1`
    FOREIGN KEY (`idNaturalHistory`)
    REFERENCES `RapidsCemetery`.`NaturalHistory` (`idNaturalHistory`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_MiscDetail1`
    FOREIGN KEY (`idMisc`)
    REFERENCES `RapidsCemetery`.`MiscObject` (`idMisc`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_PlotDetail1`
    FOREIGN KEY (`idGroup`)
    REFERENCES `RapidsCemetery`.`Group` (`idGroup`)
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
  `description` BLOB NULL,
  `phone` VARCHAR(80) NULL,
  `title` VARCHAR(80) NULL,
  PRIMARY KEY (`idContact`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

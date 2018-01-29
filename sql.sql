-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema RapidsCemetery
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema RapidsCemetery
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `RapidsCemetery` DEFAULT CHARACTER SET utf8 ;
USE `RapidsCemetery` ;

-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Image` (
  `id` INT NOT NULL,
  `imageURL` VARCHAR(150) NULL,
  `imageDescription` VARCHAR(9000) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`War`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`War` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `dateStarted` DATE NULL DEFAULT NULL,
  `dateEnded` DATE NULL DEFAULT NULL,
  `description` VARCHAR(9000) NULL DEFAULT NULL,
  `imageID` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_War_Image1_idx` (`imageID` ASC),
  CONSTRAINT `fk_War_Image1`
    FOREIGN KEY (`imageID`)
    REFERENCES `RapidsCemetery`.`Image` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Map`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Map` (
  `id` INT NOT NULL,
  `latitude` DECIMAL(9,6) NULL,
  `longitude` DECIMAL(9,6) NULL,
  `type` ENUM('Grave','NaturalHistory','HazardousArea'),  
PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Grave`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Grave` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `birthDate` DATE NULL DEFAULT NULL,
  `deathDate` DATE NULL DEFAULT NULL,
  `description` VARCHAR(9000) NULL DEFAULT NULL,
  `warID` INT NULL DEFAULT NULL,
  `pointValue` INT NULL DEFAULT NULL,
  `hint` VARCHAR(45) NULL DEFAULT NULL,
  `mapID` INT NOT NULL,
  `imageID` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_grave_war_idx` (`warID` ASC),
  INDEX `fk_Grave_Map1_idx` (`mapID` ASC),
  INDEX `fk_Grave_Image1_idx` (`imageID` ASC),
  CONSTRAINT `fk_grave_war`
    FOREIGN KEY (`warID`)
    REFERENCES `RapidsCemetery`.`War` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Grave_Map1`
    FOREIGN KEY (`mapID`)
    REFERENCES `RapidsCemetery`.`Map` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Grave_Image1`
    FOREIGN KEY (`imageID`)
    REFERENCES `RapidsCemetery`.`Image` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`NaturalHistory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`NaturalHistory` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(9000) NULL DEFAULT NULL,
  `pointValue` INT NULL DEFAULT NULL,
  `hint` VARCHAR(45) NULL DEFAULT NULL,
  `imageID` INT NOT NULL,
  `mapID` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_NaturalHistory_Image1_idx` (`imageID` ASC),
  INDEX `fk_NaturalHistory_Map1_idx` (`mapID` ASC),
  CONSTRAINT `fk_NaturalHistory_Image1`
    FOREIGN KEY (`imageID`)
    REFERENCES `RapidsCemetery`.`Image` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_NaturalHistory_Map1`
    FOREIGN KEY (`mapID`)
    REFERENCES `RapidsCemetery`.`Map` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Contact`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Contact` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Event` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(9000) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`HazardousArea`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`HazardousArea` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mapID` INT NOT NULL,
  `description` VARCHAR(9000) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_HazardousArea_Map1_idx` (`mapID` ASC),
  CONSTRAINT `fk_HazardousArea_Map1`
    FOREIGN KEY (`mapID`)
    REFERENCES `RapidsCemetery`.`Map` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Permission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Permission` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(9000) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`User` (
  `id` INT NOT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(45) NULL DEFAULT NULL,
  `permissionID` INT NOT NULL,
  PRIMARY KEY (`id`, `permissionID`),
  INDEX `fk_user_permissions1_idx` (`permissionID` ASC),
  CONSTRAINT `fk_user_permissions1`
    FOREIGN KEY (`permissionID`)
    REFERENCES `RapidsCemetery`.`Permission` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema garnet
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema garnet
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `garnet` DEFAULT CHARACTER SET utf8 ;
USE `garnet` ;

-- -----------------------------------------------------
-- Table `garnet`.`war`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garnet`.`war` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `dateStarted` DATE NULL DEFAULT NULL,
  `dateEnded` DATE NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `image` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garnet`.`grave`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garnet`.`grave` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `birthDate` DATE NULL DEFAULT NULL,
  `deathDate` DATE NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `image` VARCHAR(45) NULL DEFAULT NULL,
  `coordsFirst` DECIMAL(9,6) NULL DEFAULT NULL,
  `coordsSecond` DECIMAL(9,6) NULL DEFAULT NULL,
  `war_id` INT NULL DEFAULT NULL,
  `pointValue` INT NULL DEFAULT NULL,
  `hint` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_grave_war_idx` (`war_id` ASC),
  CONSTRAINT `fk_grave_war`
    FOREIGN KEY (`war_id`)
    REFERENCES `garnet`.`war` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garnet`.`vegetation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garnet`.`vegetation` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `image` VARCHAR(45) NULL DEFAULT NULL,
  `coordsFirst` DECIMAL(9,6) NULL DEFAULT NULL,
  `coordsSecond` DECIMAL(9,6) NULL,
  `pointValue` INT NULL DEFAULT NULL,
  `hint` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garnet`.`contacts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garnet`.`contacts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garnet`.`events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garnet`.`events` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garnet`.`hazardousArea`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garnet`.`hazardousArea` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `coordsFirst` DECIMAL(9,6) NULL,
  `coordsSecond` DECIMAL(9,6) NULL,
  `image` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garnet`.`permissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garnet`.`permissions` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garnet`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garnet`.`user` (
  `id` INT NOT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(45) NULL DEFAULT NULL,
  `permissions_id` INT NOT NULL,
  PRIMARY KEY (`id`, `permissions_id`),
  INDEX `fk_user_permissions1_idx` (`permissions_id` ASC),
  CONSTRAINT `fk_user_permissions1`
    FOREIGN KEY (`permissions_id`)
    REFERENCES `garnet`.`permissions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
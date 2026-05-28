-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema banco
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema banco
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `banco` ;
USE `banco` ;

-- -----------------------------------------------------
-- Table `banco`.`leitores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco`.`leitores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(90) NULL,
  `senha` VARCHAR(45) NULL,
  `cpf` VARCHAR(11) NULL,
  `telefone` VARCHAR(11) NULL,
  `nascimento` DATE NULL,
  `tipo` ENUM('admin', 'usuario') DEFAULT 'usuario',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco`.`editoras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco`.`editoras` (
  `id` INT NOT NULL,
  `nome` VARCHAR(90) NULL,
  `pais` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco`.`livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco`.`livros` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(90) NULL,
  `data_publicacao` DATE NULL,
  `genero` VARCHAR(45) NULL,
  `foto` VARCHAR(90) NULL,
  `editora` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_livros_editoras1_idx` (`editora` ASC) VISIBLE,
  CONSTRAINT `fk_livros_editoras1`
    FOREIGN KEY (`editora`)
    REFERENCES `banco`.`editoras` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco`.`emprestimos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco`.`emprestimos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `leitor` INT NOT NULL,
  `livros` INT NOT NULL,
  `data_inicio` DATETIME NULL,
  `data_fim` DATETIME NULL,
  INDEX `fk_leitores_has_livros_livros1_idx` (`livros` ASC) VISIBLE,
  INDEX `fk_leitores_has_livros_leitores_idx` (`leitor` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_leitores_has_livros_leitores`
    FOREIGN KEY (`leitor`)
    REFERENCES `banco`.`leitores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_leitores_has_livros_livros1`
    FOREIGN KEY (`livros`)
    REFERENCES `banco`.`livros` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- MySQL Script generated by MySQL Workbench
-- sex 24 jun 2022 09:31:11
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_sistemadeclasse
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_sistemadeclasse
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_sistemadeclasse` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci ;
USE `db_sistemadeclasse` ;

-- -----------------------------------------------------
-- Table `db_sistemadeclasse`.`tbl_professor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_sistemadeclasse`.`tbl_professor` (
  `id` INT(10) ZEROFILL NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `senha` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `email` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_sistemadeclasse`.`tbl_escola`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_sistemadeclasse`.`tbl_escola` (
  `id` INT ZEROFILL NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `email` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `fk_tbl_professor_id` INT(10) ZEROFILL NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_escola_contem_professores` USING BTREE (`fk_tbl_professor_id`) VISIBLE,
  CONSTRAINT `fk_tbl_professor_id`
    FOREIGN KEY (`fk_tbl_professor_id`)
    REFERENCES `db_sistemadeclasse`.`tbl_professor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_sistemadeclasse`.`tbl_disciplina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_sistemadeclasse`.`tbl_disciplina` (
  `id` INT ZEROFILL NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_sistemadeclasse`.`tbl_classe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_sistemadeclasse`.`tbl_classe` (
  `id` INT ZEROFILL NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `periodo` SET('Manha', 'Tarde', 'Noite') NOT NULL,
  `fk_tbl_professor_id1` INT ZEROFILL NOT NULL,
  `fk_tbl_escola_id` INT ZEROFILL NOT NULL,
  `fk_tbl_disciplina_id` INT ZEROFILL NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_classe_tem_disciplina` (`fk_tbl_disciplina_id` ASC) VISIBLE,
  INDEX `fk_tbl_classe_pertence_escola` (`fk_tbl_escola_id` ASC) VISIBLE,
  INDEX `fk_tbl_classe_tem_professor` (`fk_tbl_professor_id1` ASC) VISIBLE,
  CONSTRAINT `fk_tbl_professor_id1`
    FOREIGN KEY (`fk_tbl_professor_id1`)
    REFERENCES `db_sistemadeclasse`.`tbl_professor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_disciplina_id`
    FOREIGN KEY (`fk_tbl_disciplina_id`)
    REFERENCES `db_sistemadeclasse`.`tbl_disciplina` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_escola_id2`
    FOREIGN KEY (`fk_tbl_escola_id`)
    REFERENCES `db_sistemadeclasse`.`tbl_escola` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_sistemadeclasse`.`tbl_nota`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_sistemadeclasse`.`tbl_nota` (
  `id` INT ZEROFILL NOT NULL AUTO_INCREMENT,
  `qtde_atividade` SMALLINT(20) ZEROFILL NOT NULL,
  `nome_atividade` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `nota` FLOAT ZEROFILL NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_sistemadeclasse`.`tbl_frequencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_sistemadeclasse`.`tbl_frequencia` (
  `id` INT ZEROFILL NOT NULL AUTO_INCREMENT,
  `presenca` INT ZEROFILL NOT NULL,
  `falta` INT ZEROFILL NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_sistemadeclasse`.`tbl_aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_sistemadeclasse`.`tbl_aluno` (
  `id` INT ZEROFILL NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `senha` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `RA` TINYINT(11) ZEROFILL NOT NULL,
  `fk_nota_id` INT ZEROFILL NOT NULL,
  `fk_frequencia_id` INT ZEROFILL NOT NULL,
  `fk_tbl_professor_id3` INT ZEROFILL NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Aluno_tem_Nota` (`fk_nota_id` ASC) VISIBLE,
  INDEX `fk_Aluno_tem_Frequencia` (`fk_frequencia_id` ASC) VISIBLE,
  INDEX `fk_Aluno_tem_Professor` (`fk_tbl_professor_id3` ASC) VISIBLE,
  CONSTRAINT `fk_nota_id`
    FOREIGN KEY (`fk_nota_id`)
    REFERENCES `db_sistemadeclasse`.`tbl_nota` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_frequencia_id`
    FOREIGN KEY (`fk_frequencia_id`)
    REFERENCES `db_sistemadeclasse`.`tbl_frequencia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_professor_id3`
    FOREIGN KEY (`fk_tbl_professor_id3`)
    REFERENCES `db_sistemadeclasse`.`tbl_professor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_sistemadeclasse`.`tbl_classe_aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_sistemadeclasse`.`tbl_classe_aluno` (
  `qtdade_aulas` INT ZEROFILL NOT NULL,
  `qtdade_alunos` INT ZEROFILL NOT NULL,
  `fk_tbl_classe_id` INT ZEROFILL NOT NULL,
  `fk_aluno_id` INT ZEROFILL NOT NULL,
  INDEX `fk_Aluno_pertence_Classe_id` (`fk_aluno_id` ASC) VISIBLE,
  INDEX `fk_Classe_tem_Aluno_id` (`fk_tbl_classe_id` ASC) INVISIBLE,
  CONSTRAINT `fk_tbl_classe_id`
    FOREIGN KEY (`fk_tbl_classe_id`)
    REFERENCES `db_sistemadeclasse`.`tbl_classe` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_aluno_id`
    FOREIGN KEY (`fk_aluno_id`)
    REFERENCES `db_sistemadeclasse`.`tbl_aluno` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
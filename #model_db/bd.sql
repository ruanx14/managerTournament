CREATE SCHEMA IF NOT EXISTS `aq3dfights` DEFAULT CHARACTER SET utf8 ;
USE `aq3dfights` ;

-- -----------------------------------------------------
-- Table `aq3dfights`.`Round`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aq3dfights`.`Round` (
  `idRound` INT NOT NULL AUTO_INCREMENT,
  `round` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  `datee` VARCHAR(45) NULL,
  PRIMARY KEY (`idRound`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aq3dfights`.`Fight`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aq3dfights`.`Fight` (
  `idFight` INT NOT NULL AUTO_INCREMENT,
  `round` VARCHAR(45) NULL,
  `namePlayerOne` VARCHAR(45) NULL,
  `hasOponent` VARCHAR(45) NULL,
  `namePlayerTwo` VARCHAR(45) NULL,
  `winner` VARCHAR(45) NULL,
  `datee` VARCHAR(45) NULL,
  `alreadyFight` VARCHAR(45) NULL,
  PRIMARY KEY (`idFight`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aq3dfights`.`Fighter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aq3dfights`.`Fighter` (
  `idFighter` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `datee` VARCHAR(45) NULL,
  `round` VARCHAR(45) NULL,
  PRIMARY KEY (`idFighter`))
ENGINE = InnoDB;

select * from fighter;
select * from round;
select * from fight;
select count(*) from fight order by idFight desc;
delete from round where idRound=2;
desc fighter;
use aq3dfights;
select count(*) from fighter;
select * from fight where datee='2020-09-14' and alreadyFight='not';
select * from round;

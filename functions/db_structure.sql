-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------


-- -----------------------------------------------------
-- Table `designation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designation` (
  `iddesignation` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(45) NULL,
  `customer_create` INT NULL,
  `approval` INT NULL,
  `transaction` INT NULL,
  `finaancial_report` INT NULL,
  `configuration` INT NULL,
  PRIMARY KEY (`iddesignation`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `idusers` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(50) NULL,
  `middlename` VARCHAR(50) NULL,
  `lastname` VARCHAR(50) NULL,
  `phone` VARCHAR(45) NULL,
  `email` VARCHAR(60) NULL,
  `status` VARCHAR(45) NULL,
  `passkey` VARCHAR(800) NULL,
  `designation_iddesignation` INT NOT NULL,
  PRIMARY KEY (`idusers`),
  INDEX `fk_users_designation_idx` (`designation_iddesignation` ASC),
  CONSTRAINT `fk_users_designation`
    FOREIGN KEY (`designation_iddesignation`)
    REFERENCES `designation` (`iddesignation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agents`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `agents` (
  `idagents` INT NOT NULL AUTO_INCREMENT,
  `fullname` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `bank` VARCHAR(45) NULL,
  `bank_account` VARCHAR(45) NULL,
  `users_idusers` INT NOT NULL,
  PRIMARY KEY (`idagents`)
  )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banks` (
  `idbanks` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`idbanks`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `branches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `branches` (
  `idbranches` INT NOT NULL AUTO_INCREMENT,
  `location` TEXT NULL,
  `primary_contact_fullname` VARCHAR(45) NULL,
  `primary_contact_email` VARCHAR(45) NULL,
  `primary_contact_phone` VARCHAR(45) NULL,
  `banks_idbanks` INT NOT NULL,
  PRIMARY KEY (`idbranches`),
  INDEX `fk_branches_banks1_idx` (`banks_idbanks` ASC),
  CONSTRAINT `fk_branches_banks1`
    FOREIGN KEY (`banks_idbanks`)
    REFERENCES `banks` (`idbanks`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `customers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `customers` (
  `idcustomers` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NULL,
  `middlename` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `address` VARCHAR(45) NULL,
  `bvn` VARCHAR(45) NULL,
  `account_number` VARCHAR(11) NULL,
  `guarantor_name` VARCHAR(45) NULL,
  `guarantor_phone` VARCHAR(45) NULL,
  `guarantor_email` VARCHAR(45) NULL,
  `guarantor_address` VARCHAR(45) NULL,
  `branches_idbranches` INT NOT NULL,
  PRIMARY KEY (`idcustomers`),
  INDEX `fk_customers_branches1_idx` (`branches_idbranches` ASC),
  CONSTRAINT `fk_customers_branches1`
    FOREIGN KEY (`branches_idbranches`)
    REFERENCES `branches` (`idbranches`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `loan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `loan` (
  `idloan` INT NOT NULL AUTO_INCREMENT,
  `amount` DECIMAL(19,2) NULL,
  `interest_rate` DECIMAL(9,2) NULL,
  `tenure` INT NULL,
  `disbursement_date` DATE NULL,
  `repayment_date` DATE NULL,
  `interest_paid` DECIMAL(19,2) NULL,
  `interest_amount` DECIMAL(19,2) NULL,
  `amount_paid` DECIMAL(19,2) NULL,
  `fee_paid` DECIMAL(19,2) NULL,
  `customers_idcustomers` INT NOT NULL,
  `branches_idbranches` INT NOT NULL,
  PRIMARY KEY (`idloan`),
  INDEX `fk_loan_customers1_idx` (`customers_idcustomers` ASC),
  INDEX `fk_loan_branches1_idx` (`branches_idbranches` ASC),
  CONSTRAINT `fk_loan_customers1`
    FOREIGN KEY (`customers_idcustomers`)
    REFERENCES `customers` (`idcustomers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_loan_branches1`
    FOREIGN KEY (`branches_idbranches`)
    REFERENCES `branches` (`idbranches`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reschedule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reschedule` (
  `idreschedule` INT NOT NULL AUTO_INCREMENT,
  `repayment_date` DATE NULL,
  `new_date` DATE NULL,
  `fee_paid` DECIMAL(19,2) NULL,
  `is_paid` INT NULL,
  `loan_idloan` INT NOT NULL,
  PRIMARY KEY (`idreschedule`),
  INDEX `fk_reschedule_loan1_idx` (`loan_idloan` ASC),
  CONSTRAINT `fk_reschedule_loan1`
    FOREIGN KEY (`loan_idloan`)
    REFERENCES `loan` (`idloan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fixed_deposit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fixed_deposit` (
  `idfixed_deposit` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(80) NULL,
  `email` VARCHAR(45) NULL,
  `phone_no` VARCHAR(45) NULL,
  `bank` VARCHAR(45) NULL,
  `bank_account` VARCHAR(45) NULL,
  PRIMARY KEY (`idfixed_deposit`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `investment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `investment` (
  `idinvestment` INT NOT NULL AUTO_INCREMENT,
  `tenure` INT NULL,
  `amount` DECIMAL(19,2) NULL,
  `interest_amount` VARCHAR(45) NULL,
  `interetare_rate` DECIMAL NULL,
  `interest_paid` DECIMAL(19,2) NULL,
  `repayment_date` DATE NULL,
  `upfront` INT NULL,
  `principal_paid` DECIMAL(19,2) NULL,
  `fixed_deposit_idfixed_deposit` INT NOT NULL,
  PRIMARY KEY (`idinvestment`),
  INDEX `fk_investment_fixed_deposit1_idx` (`fixed_deposit_idfixed_deposit` ASC),
  CONSTRAINT `fk_investment_fixed_deposit1`
    FOREIGN KEY (`fixed_deposit_idfixed_deposit`)
    REFERENCES `fixed_deposit` (`idfixed_deposit`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transactions` (
  `idtransactions` INT NOT NULL AUTO_INCREMENT,
  `amount` DECIMAL(19,2) NULL,
  `transaction_type` VARCHAR(5) NULL,
  `transaction_date` DATE NULL,
  `approved_by` INT NULL,
  `submitted_by` INT NULL,
  `loan_idloan` INT NOT NULL,
  `branches_idbranches` INT NOT NULL,
  `investment_idinvestment` INT NOT NULL,
  PRIMARY KEY (`idtransactions`),
  INDEX `fk_transactions_loan1_idx` (`loan_idloan` ASC),
  INDEX `fk_transactions_branches1_idx` (`branches_idbranches` ASC),
  INDEX `fk_transactions_investment1_idx` (`investment_idinvestment` ASC),
  CONSTRAINT `fk_transactions_loan1`
    FOREIGN KEY (`loan_idloan`)
    REFERENCES `loan` (`idloan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transactions_branches1`
    FOREIGN KEY (`branches_idbranches`)
    REFERENCES `branches` (`idbranches`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transactions_investment1`
    FOREIGN KEY (`investment_idinvestment`)
    REFERENCES `investment` (`idinvestment`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `images` (
  `idimages` INT NOT NULL AUTO_INCREMENT,
  `image_name` LONGTEXT NULL,
  `customers_idcustomers` INT NOT NULL,
  PRIMARY KEY (`idimages`),
  INDEX `fk_images_customers1_idx` (`customers_idcustomers` ASC),
  CONSTRAINT `fk_images_customers1`
    FOREIGN KEY (`customers_idcustomers`)
    REFERENCES `customers` (`idcustomers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `commisions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `commisions` (
  `idcommisions` INT NOT NULL AUTO_INCREMENT,
  `amount` DECIMAL(19,2) NULL,
  `is_paid` INT NULL,
  `value` DECIMAL NULL,
  `agents_idagents` INT NOT NULL,
  `loan_idloan` INT NOT NULL,
  PRIMARY KEY (`idcommisions`),
  INDEX `fk_commisions_agents1_idx` (`agents_idagents` ASC),
  INDEX `fk_commisions_loan1_idx` (`loan_idloan` ASC),
  CONSTRAINT `fk_commisions_agents1`
    FOREIGN KEY (`agents_idagents`)
    REFERENCES `agents` (`idagents`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commisions_loan1`
    FOREIGN KEY (`loan_idloan`)
    REFERENCES `loan` (`idloan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `customer_request`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `customer_request` (
  `idcustomer_request` INT NOT NULL AUTO_INCREMENT,
  `description` LONGTEXT NULL,
  `is_approved` INT NULL,
  `customers_idcustomers` INT NOT NULL,
  PRIMARY KEY (`idcustomer_request`),
  INDEX `fk_customer_request_customers1_idx` (`customers_idcustomers` ASC),
  CONSTRAINT `fk_customer_request_customers1`
    FOREIGN KEY (`customers_idcustomers`)
    REFERENCES `customers` (`idcustomers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `activity_report`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `activity_report` (
  `idactivity_report` INT NOT NULL AUTO_INCREMENT,
  `date` DATE NULL,
  `description` TEXT NULL,
  `approval_by` INT NULL,
  `submitted_by` INT NULL,
  PRIMARY KEY (`idactivity_report`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

ALTER TABLE `branches`  ADD `branch_name` VARCHAR(50) NOT NULL  AFTER `idbranches`;
ALTER TABLE `banks` ADD `description` TEXT NOT NULL AFTER `name`;
ALTER TABLE `branches` ADD `main_branch` INT NOT NULL AFTER `location`;
ALTER TABLE `customers` ADD `isapproved` INT NOT NULL AFTER `guarantor_address`;
ALTER TABLE `loan` ADD `isapproved` INT NOT NULL AFTER `fee_paid`;
ALTER TABLE `investment` ADD `isapproved` INT NOT NULL AFTER `principal_paid`;

-- 

CREATE TABLE `loan_system`.`account` ( `id` INT NOT NULL AUTO_INCREMENT , `account_balance` DECIMAL(19,2) NOT NULL , 
`last_deposit` DECIMAL(19,2) NOT NULL , `last_withdrawal` DECIMAL(19,2) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB

CREATE TABLE `loan_system`.`account_transaction` ( `id` INT NOT NULL AUTO_INCREMENT , `amount` DECIMAL(19,2) NOT NULL , 
`account_balance` DECIMAL(19,2) NOT NULL , `transaction_type` VARCHAR(5) NOT NULL , 
`transaction_date` DATE NOT NULL , `transaction_id` VARCHAR(30) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- 

ALTER TABLE `account` ADD `account_name` VARCHAR(60) NOT NULL DEFAULT 'INSTITUTION_ACCOUNT' AFTER `id`;
ALTER TABLE `investment` CHANGE `interest_amount` `interest_amount` DECIMAL(19,2) NULL DEFAULT NULL, 
CHANGE `interetare_rate` `interest_rate` DECIMAL NULL DEFAULT NULL;
ALTER TABLE `investment` ADD `disbursement_date` DATE NOT NULL AFTER `interest_paid`;

ALTER TABLE `transactions` CHANGE `transaction_type` `transaction_type` VARCHAR(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `designation`  ADD `admin_expense` INT NOT NULL  AFTER `finaancial_report`;
ALTER TABLE `branches` ADD `primary_contact2` VARCHAR(60) NOT NULL AFTER `primary_contact_phone`, 
ADD `primary_contact_email2` VARCHAR(60) NOT NULL AFTER `primary_contact2`, 
ADD `primary_contact_phone2` VARCHAR(14) NOT NULL AFTER `primary_contact_email2`;

ALTER TABLE `agents`
  DROP `commision_value`,
  DROP `commission_type`;

CREATE TABLE `loan_system`.`agent_commission` ( `id` INT NOT NULL AUTO_INCREMENT , `commision_percentage` DECIMAL NOT NULL , 
`commission_value` DECIMAL(19,2) NOT NULL , `upfront` INT NOT NULL , `ispaid` INT NOT NULL , `loanid` INT NOT NULL , 
`investmentid` INT NOT NULL , `agentid` INT NOT NULL , `investorid` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `customers` CHANGE `guarantor_name` `agent_name` VARCHAR(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, 
CHANGE `guarantor_phone` `agent_bank` VARCHAR(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, 
CHANGE `guarantor_email` `agent_account_no` VARCHAR(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, 
CHANGE `guarantor_address` `agent_phone` VARCHAR(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `loan` ADD `upfront` INT NOT NULL AFTER `fee_paid`;

ALTER TABLE `fixed_deposit` ADD `agent_name` VARCHAR(80) NOT NULL AFTER `bank_account`, 
ADD `agent_bank` VARCHAR(80) NOT NULL AFTER `agent_name`, 
ADD `agent_account_no` VARCHAR(80) NOT NULL AFTER `agent_bank`, 
ADD `agent_phone` VARCHAR(80) NOT NULL AFTER `agent_account_no`;

ALTER TABLE `reschedule` ADD `idinvestment` INT NOT NULL AFTER `loan_idloan`;

CREATE TABLE `expense` ( `id` INT NOT NULL AUTO_INCREMENT , 
`userid` INT NOT NULL , `description` TEXT NOT NULL , `amount` INT NOT NULL , 
`transaction_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
`status` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `expense` ADD `expense_type` VARCHAR(30) NOT NULL AFTER `userid`;
ALTER TABLE `transactions` ADD `expense_id` INT NOT NULL AFTER `investment_idinvestment`;

SET GLOBAL FOREIGN_KEY_CHECKS=0;

ALTER TABLE `investment` ADD `total_repayment` DECIMAL(19,2) AS (investement.amount + investment.interest_amount) STORED AFTER `interest_amount`;

CREATE TABLE `edit_cache` ( `id` INT NOT NULL AUTO_INCREMENT , `old_principal` DECIMAL(19,2) NOT NULL , 
`new_principal` DECIMAL(19,2) NOT NULL , `new_interest` DECIMAL(19,2) NOT NULL , `person_name` VARCHAR(100) NOT NULL , 
`loan_id` INT NOT NULL , `investment_id` INT NOT NULL , `altered_by` INT NOT NULL , `approved_by` INT NOT NULL , 
`edited_on` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `status` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 

ALTER TABLE `edit_cache` ADD `old_interest` DECIMAL(19,2) NOT NULL AFTER `new_principal`; 
-- MySQL Script generated by MySQL Workbench
-- 11/01/15 05:59:07
-- Model: New Model    Version: 1.0
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mailbox
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mailbox` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mailbox` ;

-- -----------------------------------------------------
-- Table `mailbox`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mailbox`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(120) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `about` VARCHAR(500) NULL,
  `gender` ENUM('MALE','FEMALE') NULL,
  `avatar` VARCHAR(255) NOT NULL DEFAULT 'noimage.jpg',
  `authority` ENUM('DEV', 'ADMIN') NOT NULL DEFAULT 'ADMIN',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mailbox`.`labels`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mailbox`.`labels` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(45) NOT NULL,
  `description` VARCHAR(300) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mailbox`.`inbox`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mailbox`.`inbox` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `label_id` INT NOT NULL,
  `subject` VARCHAR(300) NOT NULL,
  `agenda_number` VARCHAR(100) NOT NULL,
  `mail_number` VARCHAR(100) NOT NULL,
  `mail_date` DATE NOT NULL,
  `received_date` DATE NULL,
  `from` VARCHAR(300) NULL,
  `to` VARCHAR(300) NULL,
  `authorizing_signature` TEXT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`, `label_id`),
  INDEX `fk_inbox_labels1_idx` (`label_id` ASC),
  CONSTRAINT `fk_inbox_labels1`
    FOREIGN KEY (`label_id`)
    REFERENCES `mailbox`.`labels` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mailbox`.`outbox`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mailbox`.`outbox` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `label_id` INT NOT NULL,
  `subject` VARCHAR(300) NOT NULL,
  `agenda_number` VARCHAR(100) NOT NULL,
  `mail_number` VARCHAR(100) NOT NULL,
  `mail_date` DATE NOT NULL,
  `from` VARCHAR(300) NOT NULL,
  `to` VARCHAR(300) NOT NULL,
  `description` TEXT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`, `user_id`, `label_id`),
  INDEX `fk_outbox_labels_idx` (`label_id` ASC),
  INDEX `fk_outbox_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_outbox_labels`
    FOREIGN KEY (`label_id`)
    REFERENCES `mailbox`.`labels` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_outbox_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mailbox`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mailbox`.`settings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mailbox`.`settings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `key` VARCHAR(45) NOT NULL,
  `value` TEXT NOT NULL,
  `user_id` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`, `user_id`),
  INDEX `fk_settings_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_settings_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mailbox`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mailbox`.`inbox_attachment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mailbox`.`inbox_attachment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `inbox_id` INT NOT NULL,
  `resource` VARCHAR(300) NOT NULL,
  `type` ENUM('ORIGINAL','SIGNATURE') NOT NULL DEFAULT 'ORIGINAL',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`, `inbox_id`),
  INDEX `fk_attachment_inbox1_idx` (`inbox_id` ASC),
  CONSTRAINT `fk_attachment_inbox1`
    FOREIGN KEY (`inbox_id`)
    REFERENCES `mailbox`.`inbox` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mailbox`.`outbox_attachment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mailbox`.`outbox_attachment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `outbox_id` INT NOT NULL,
  `resource` VARCHAR(300) NOT NULL,
  `type` ENUM('ORIGINAL','SIGNATURE') NOT NULL DEFAULT 'ORIGINAL',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`, `outbox_id`),
  INDEX `fk_outbox_attachment_outbox1_idx` (`outbox_id` ASC),
  CONSTRAINT `fk_outbox_attachment_outbox1`
    FOREIGN KEY (`outbox_id`)
    REFERENCES `mailbox`.`outbox` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mailbox`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `mailbox`;
INSERT INTO `mailbox`.`users` (`id`, `username`, `password`, `email`, `name`, `about`, `gender`, `avatar`, `authority`, `created_at`, `updated_at`) VALUES (NULL, 'superuser', '5e8edd851d2fdfbd7415232c67367cc3', 'dev@sketchproject.com', 'Angga Ari Wijaya', 'Default developer user', 'MALE', 'dev.jpg', 'DEV', NULL, NULL);
INSERT INTO `mailbox`.`users` (`id`, `username`, `password`, `email`, `name`, `about`, `gender`, `avatar`, `authority`, `created_at`, `updated_at`) VALUES (NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@kemendesa.go.id', 'Mailbox Admin', 'Default admin user', 'MALE', 'adm.jpg', 'ADMIN', NULL, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mailbox`.`labels`
-- -----------------------------------------------------
START TRANSACTION;
USE `mailbox`;
INSERT INTO `mailbox`.`labels` (`id`, `label`, `description`, `created_at`, `updated_at`) VALUES (NULL, 'IMPORTANT', 'Important mail to archive and make an index', NULL, NULL);
INSERT INTO `mailbox`.`labels` (`id`, `label`, `description`, `created_at`, `updated_at`) VALUES (NULL, 'GENERAL', 'General mail data to archive', NULL, NULL);
INSERT INTO `mailbox`.`labels` (`id`, `label`, `description`, `created_at`, `updated_at`) VALUES (NULL, 'SOON', 'Kind of mail which handled as soon as posible', NULL, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mailbox`.`settings`
-- -----------------------------------------------------
START TRANSACTION;
USE `mailbox`;
INSERT INTO `mailbox`.`settings` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'website', 'Kemendesa MailBox', 1, NULL, NULL);
INSERT INTO `mailbox`.`settings` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'keyword', 'kemendesa, mail, inbox, outbox', 1, NULL, NULL);
INSERT INTO `mailbox`.`settings` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'description', 'MailBox is a web app which provide mail service solution to archive in-out mails in Kemendesa', 1, NULL, NULL);
INSERT INTO `mailbox`.`settings` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'email', 'mailbox@kemendesa.go.id', 1, NULL, NULL);
INSERT INTO `mailbox`.`settings` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'address', 'Kalibata, South Jakarta - Indonesia', 1, NULL, NULL);
INSERT INTO `mailbox`.`settings` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'contact', '085655479868', 1, NULL, NULL);
INSERT INTO `mailbox`.`settings` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'facebook', 'https://www.facebook.com/pages/kemendesa', 1, NULL, NULL);
INSERT INTO `mailbox`.`settings` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'twitter', 'https://www.twitter.com/kemendesa', 1, NULL, NULL);
INSERT INTO `mailbox`.`settings` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'google', 'https://plus.google.com/+Kemendesa', 1, NULL, NULL);
INSERT INTO `mailbox`.`settings` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'favicon', 'favicon.png', 1, NULL, NULL);

COMMIT;


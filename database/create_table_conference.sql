CREATE TABLE `labmgr`.`conference` (
  `conference_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `description` TEXT NULL,
  `last_update_timestamp` TIMESTAMP NULL,
  `create_timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`conference_id`));

CREATE TABLE `labmgr`.`server` (
  `server_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `description` TEXT NULL,
  `create_timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` TIMESTAMP NULL,
  PRIMARY KEY (`server_id`));

CREATE TABLE `labmgr`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(45) NULL,
  `first_name` VARCHAR(255) NULL,
  `last_name` VARCHAR(255) NULL,
  `create_timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` TIMESTAMP NULL,
  PRIMARY KEY (`user_id`));

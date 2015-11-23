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

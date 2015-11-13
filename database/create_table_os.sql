CREATE TABLE `labmgr`.`os` (
  `os_id` INT(11) NOT NULL,
  `name` VARCHAR(100) NULL,
  `description` TEXT NULL,
  `create_timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` TIMESTAMP NULL,
  PRIMARY KEY (`os_id`));

ALTER TABLE `labmgr`.`os` 
CHANGE COLUMN `os_id` `os_id` INT(11) NOT NULL AUTO_INCREMENT ;


ALTER TABLE `labmgr`.`machine` 
CHANGE COLUMN `operating_system` `os_id` INT(11) NULL DEFAULT NULL ;

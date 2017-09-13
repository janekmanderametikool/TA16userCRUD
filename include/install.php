<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 17.05.2017
 * Time: 9:46
 */

$create_users_table = "CREATE TABLE `veebiprogrammeerimine_janek`.`kjass_users`(
  `ID` SERIAL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `group_rights` VARCHAR(2) NULL DEFAULT '0',
  `last_login` DATETIME NOT NULL,
  `added` DATETIME NOT NULL,
  `added_by` INT NOT NULL,
  `edited` DATETIME ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_by` INT NOT NULL,
  `status` INT(1) NOT NULL
) ENGINE = InnoDB;";

$create_categories_table = "CREATE TABLE `veebiprogrammeerimine_janek`.`kjass_categories`(
  `ID` SERIAL,
  `name` VARCHAR(100) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `parent` INT NOT NULL,
  `added` DATETIME NOT NULL,
  `edited` DATETIME ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` INT NOT NULL,
  `edited_by` INT NOT NULL,
  `status` INT NOT NULL
) ENGINE = InnoDB;";
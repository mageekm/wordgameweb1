
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- knownWords
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `knownWords`;

CREATE TABLE `knownWords`
(
	`wid` INTEGER(10) NOT NULL,
	`pid` INTEGER(10) NOT NULL,
	PRIMARY KEY (`wid`,`pid`),
	UNIQUE INDEX `wid_UNIQUE` (`wid`(10)),
	UNIQUE INDEX `pid_UNIQUE` (`pid`(10))
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- player
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `player`;

CREATE TABLE `player`
(
	`pid` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`password` VARCHAR(255) NOT NULL,
	`email` VARCHAR(45) NOT NULL,
	`firstName` VARCHAR(20),
	`lastName` VARCHAR(20),
	`age` INTEGER(10),
	`education` TINYINT(45),
	`sex` TINYINT,
	`paidTier` INTEGER NOT NULL,
	`highScore` INTEGER(10),
	PRIMARY KEY (`pid`),
	UNIQUE INDEX `pid_UNIQUE` (`pid`(10))
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- word
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `word`;

CREATE TABLE `word`
(
	`definition` VARCHAR(255) NOT NULL,
	`wid` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`word` VARCHAR(45) NOT NULL,
	`pronunciationURL` VARCHAR(255),
	`type` VARCHAR(10),
	`difficulty` INTEGER(10) NOT NULL,
	PRIMARY KEY (`wid`),
	UNIQUE INDEX `word_UNIQUE` (`word`(45)),
	UNIQUE INDEX `wid_UNIQUE` (`wid`(10))
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;


# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(128) NOT NULL,
    `password` VARCHAR(128) NOT NULL,
    `display` VARCHAR(128) NOT NULL,
    `role_id` INTEGER,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `users_fi_06a84f` (`role_id`),
    CONSTRAINT `users_fk_06a84f`
        FOREIGN KEY (`role_id`)
        REFERENCES `roles` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- roles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `display` VARCHAR(128) DEFAULT 'false' NOT NULL,
    `canModerate` TINYINT(1) DEFAULT 0 NOT NULL,
    `canWrite` TINYINT(1) DEFAULT 0 NOT NULL,
    `canAdministrate` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- articles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `createdAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `publisher_id` INTEGER,
    `title` VARCHAR(512) NOT NULL,
    `content` TEXT(32700) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `articles_fi_9f4a61` (`publisher_id`),
    CONSTRAINT `articles_fk_9f4a61`
        FOREIGN KEY (`publisher_id`)
        REFERENCES `users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- comments
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `createdAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `publisher_id` INTEGER NOT NULL,
    `article_id` INTEGER NOT NULL,
    `content` TEXT(32700) NOT NULL,
    PRIMARY KEY (`id`,`publisher_id`,`article_id`),
    INDEX `comments_fi_9f4a61` (`publisher_id`),
    INDEX `comments_fi_0ff210` (`article_id`),
    CONSTRAINT `comments_fk_9f4a61`
        FOREIGN KEY (`publisher_id`)
        REFERENCES `users` (`id`),
    CONSTRAINT `comments_fk_0ff210`
        FOREIGN KEY (`article_id`)
        REFERENCES `articles` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

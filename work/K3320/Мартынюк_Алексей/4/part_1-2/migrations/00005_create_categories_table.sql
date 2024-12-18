USE `lab4`;

CREATE TABLE IF NOT EXISTS `categories` (
    `id`              INT             PRIMARY KEY AUTO_INCREMENT,
    `name`            VARCHAR(100)    NOT NULL,
    `description`     TEXT,
    `created_at`      TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`      TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE INDEX `idx_categories_name` (`name`)
);

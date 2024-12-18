USE `lab4`;

CREATE TABLE IF NOT EXISTS `users` (
    `id`            INT             PRIMARY KEY AUTO_INCREMENT,
    `email`         VARCHAR(100)    NOT NULL,
    `password_hash` VARCHAR(255)    NOT NULL,
    `first_name`    VARCHAR(50)     NOT NULL,
    `last_name`     VARCHAR(50)     NOT NULL,
    `created_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    UNIQUE INDEX `idx_users_email` (`email`)
);

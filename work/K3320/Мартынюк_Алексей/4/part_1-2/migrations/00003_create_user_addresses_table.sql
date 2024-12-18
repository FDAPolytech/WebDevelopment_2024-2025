USE `lab4`;

CREATE TABLE IF NOT EXISTS `user_addresses` (
    `id`            INT             PRIMARY KEY AUTO_INCREMENT,
    `user_id`       INT             NOT NULL,
    `address`       VARCHAR(255)    NOT NULL,
    `postcode`      VARCHAR(6)      NOT NULL,
    `created_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT `fk_paddresses_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);
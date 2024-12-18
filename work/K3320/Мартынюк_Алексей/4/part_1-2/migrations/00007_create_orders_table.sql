USE `lab4`;

CREATE TABLE IF NOT EXISTS `orders` (
    `id`            INT                                                     PRIMARY KEY AUTO_INCREMENT,
    `user_id`       INT                                                     NOT NULL,
    `address_id`    INT                                                     NOT NULL,
    `status`        ENUM ('progress', 'completed', 'canceled')              NOT NULL DEFAULT 'progress',
    `comment`       TEXT,
    `created_at`    TIMESTAMP                                               NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    TIMESTAMP                                               NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_orders_address_id` FOREIGN KEY (`address_id`) REFERENCES `user_addresses` (`id`) ON DELETE CASCADE
);


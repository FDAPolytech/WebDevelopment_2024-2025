USE `lab4`;

CREATE TABLE IF NOT EXISTS `products` (
    `id`            INT             PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(100)    NOT NULL,
    `price`         INT             NOT NULL,
    `stock`         INT             NOT NULL DEFAULT 0,
    `image_url`     VARCHAR(255),   
    `created_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE FULLTEXT INDEX `product_name_ft_index` ON `products` (`name`);


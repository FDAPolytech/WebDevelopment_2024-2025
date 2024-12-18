USE `lab4`;

CREATE TABLE IF NOT EXISTS `order_items` (
    `id`                INT             PRIMARY KEY AUTO_INCREMENT,
    `order_id`          INT             NOT NULL,
    `product_id`        INT             NOT NULL,
    `amount`            INT             NOT NULL,
    `price_per_unit`    INT             NOT NULL,
    `created_at`        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT `fk_oitems_order_id`   FOREIGN KEY (`order_id`)   REFERENCES `orders`   (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_oitems_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT
);

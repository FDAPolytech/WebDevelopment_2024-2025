USE `lab4`;

CREATE TABLE IF NOT EXISTS `product_category` (
    `product_id`    INT NOT NULL,
    `category_id`   INT NOT NULL,

    PRIMARY KEY (`product_id`, `category_id`),

    CONSTRAINT `fk_pcategories_product_id`  FOREIGN KEY (`product_id`)  REFERENCES `products`   (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_pcategories_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
);

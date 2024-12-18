USE `lab4`;

CREATE TABLE orders (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    surname VARCHAR(50),
    name VARCHAR(50),
    patronymic VARCHAR(50),
    address VARCHAR(255),
    phone VARCHAR(30),
    email VARCHAR(100),
    products TEXT,
    comment TEXT
);

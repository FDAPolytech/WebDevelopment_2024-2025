USE `lab4`;

CREATE TABLE users (
    login VARCHAR(50) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    password_method ENUM('plain', 'inverted') NOT NULL
);

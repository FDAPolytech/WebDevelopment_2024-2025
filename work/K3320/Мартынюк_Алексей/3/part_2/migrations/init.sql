SET GLOBAL character_set_server = utf8mb4;

CREATE DATABASE IF NOT EXISTS `lab3` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `lab3`;

CREATE TABLE feedback (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    feedback TEXT NOT NULL,
    feedback_type ENUM('complaint', 'suggestion') NOT NULL,
    services TEXT
);

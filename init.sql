-- create user 'ban_keiji'@'localhost' identified by 'keijiban';
-- grant all privileges on keijiban.* to 'ban_keiji'@'localhost';
CREATE DATABASE IF NOT EXISTS keijiban DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE keijiban;

CREATE TABLE kakikomi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    message TEXT
);

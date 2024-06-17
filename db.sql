DROP DATABASE IF EXISTS sol;
CREATE DATABASE IF NOT EXISTS sol;
USE sol;

DROP TABLE IF EXISTS feedback;
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    datecreated datetime not null default CURRENT_TIMESTAMP(),
    updated_at datetime not null default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    UNIQUE KEY (email)
);
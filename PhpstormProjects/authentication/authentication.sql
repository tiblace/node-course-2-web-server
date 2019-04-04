DROP DATABASE IF EXISTS authentication;

CREATE DATABASE authentication;
USE authentication;
CREATE TABLE users(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR (50),
last_name VARCHAR (50),
email VARCHAR (512),
password CHAR(64),
salt CHAR(10)
);
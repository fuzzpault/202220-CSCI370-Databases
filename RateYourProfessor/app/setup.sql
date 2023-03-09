-- MySQL setup file
-- Password: lvbSJnO3KO4J

DROP DATABASE IF EXISTS rateyourprofessor;
CREATE DATABASE rateyourprofessor;
USE rateyourprofessor;

CREATE TABLE student (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(100) UNIQUE,
	password VARCHAR(50)
);


-- Other table definitions here

-- Starter data
INSERT INTO student (email, password) VALUES
	("user1@uindy.edu", "password"),
	("user2@uindy.edu", "password");



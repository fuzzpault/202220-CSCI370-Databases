-- MySQL setup file
-- Password: fdr8KihLaB6U

DROP DATABASE IF EXISTS ticketmaster;
CREATE DATABASE ticketmaster;
USE ticketmaster;

CREATE TABLE movies (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(100),
	rating VARCHAR(5)
);

-- Other table definitions here

-- Starter data
INSERT INTO movies VALUES
	(1, "Office Space", "G")
;
INSERT INTO movies (title, rating) VALUES
	("Office Space2", "G");
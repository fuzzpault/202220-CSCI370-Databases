-- MySQL setup file
-- Password: bblQ8b6dI4DB

DROP DATABASE IF EXISTS ticketmaster;
CREATE DATABASE ticketmaster;
USE ticketmaster;

CREATE TABLE movies (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(100),
	rating VARCHAR(5),
	views INTEGER,
	director VARCHAR(100)
);

-- Other table definitions here

-- Starter data
INSERT INTO movies (title, rating, views, director) VALUES
	("Office Space2", "G", 78000000, "Bob");

INSERT INTO movies (title, rating, views, director) VALUES
("Office Space", "G", 123000000, "John Snow"),
("Avatar", "R", 45, "James Cameron"),
("The Bee Movie", "G", 5, "Michael Bay")
;

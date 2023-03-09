-- MySQL setup file
-- Password: UuxmeDVHK7b7

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

CREATE TABLE venue (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(100),
	city VARCHAR(100)
);

CREATE TABLE showing (
	movieId INTEGER,
	venueId INTEGER,
	FOREIGN KEY (movieId) REFERENCES movies(id),
	FOREIGN KEY (venueId) REFERENCES venue(id)
);

CREATE TABLE visit(
	url VARCHAR(50) PRIMARY KEY,
	viewCount INTEGER DEFAULT 0
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

INSERT INTO venue (name,city) VALUES
("AMC", "Cincinnati"),
("AMC", "Indianapolis"),
("Regal", "Indianapolis")
;


INSERT INTO visit (url) VALUES
("/index.php"),
("/analyze.php"),
("/newMovie.php"),
("/delMovie.php")
;

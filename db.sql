CREATE TABLE Band(
	id INT AUTO_INCREMENT PRIMARY KEY,
	band_name VARCHAR(255) NOT NULL,
	genre VARCHAR(30) NOT NULL,
	logo VARCHAR(255) NOT NULL,
	created DATETIME
);

CREATE TABLE Musician (
	username VARCHAR(15) PRIMARY KEY,
	band_id INT,
	password VARCHAR(15) NOT NULL,
	first_name VARCHAR(30) NOT NULL,
	last_name VARCHAR(30) NOT NULL,
	dob DATETIME NOT NULL,
	portrait VARCHAR(255),
	email VARCHAR(255) NOT NULL,
	contact_number INT,
	post_code INT,
	joined DATETIME NOT NULL,
	FOREIGN KEY band_key (band_id) REFERENCES Band(id)
);

CREATE TABLE Instrument (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id VARCHAR(15) NOT NULL,
	type VARCHAR(25) NOT NULL,
	make VARCHAR(25) NOT NULL,
	model VARCHAR(255) NOT NULL,
	year int NOT NULL,
	portrait VARCHAR(255),
	FOREIGN KEY user_key (user_id) REFERENCES Musician(username)
);
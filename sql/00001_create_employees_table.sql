CREATE TABLE employees (
	identificationNumber VARCHAR(100) UNIQUE,
	name VARCHAR(100) NOT NULL UNIQUE,
	address VARCHAR(255) NOT NULL,
	occupation ENUM('unemployed', 'programmer', 'designer', 'architect', 'artist') NOT NULL,
	place VARCHAR(32) NOT NULL,
	dateOfBirth DATE NOT NULL,
	PRIMARY KEY (identificationNumber)
)
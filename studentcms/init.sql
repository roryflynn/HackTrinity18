CREATE TABLE users(
	id int NOT NULL AUTO_INCREMENT,
	username varchar(255) NOT NULL,
	email varchar(255),
	password varchar(255),
	resetcode int,
	PRIMARY KEY (id)
);

INSERT INTO users (id,username,email,password,resetcode) VALUES (1,'admin','hacktrinity2018@gmail.com',NULL,NULL),(2,'test','test@test.com','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',NULL);
-- test:test

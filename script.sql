/*
Created		4. 09. 2018
Modified		4. 09. 2018
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


Create table topics (
	id Int NOT NULL AUTO_INCREMENT,
	name Varchar(50) NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table questions (
	id Int NOT NULL AUTO_INCREMENT,
	topic_id Int NOT NULL,
	user_id Int NOT NULL,
	title Varchar(1000) NOT NULL,
	content Varchar(3000) NOT NULL,
	timestamp Timestamp NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table answers (
	id Int NOT NULL AUTO_INCREMENT,
	question_id Int NOT NULL,
	user_id Int NOT NULL,
	content Varchar(2000) NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table users (
	id Int NOT NULL AUTO_INCREMENT,
	username Varchar(200) NOT NULL,
	pass Varchar(40) NOT NULL,
	email Varchar(200) NOT NULL,
	name Varchar(100),
	last_name Varchar(200),
	location Varchar(200),
 Primary Key (id)) ENGINE = MyISAM;

Create table follows (
	id Int NOT NULL AUTO_INCREMENT,
	question_id Int NOT NULL,
	user_id Int NOT NULL,
	follows Tinyint NOT NULL DEFAULT 0,
	viewed Tinyint NOT NULL DEFAULT 0,
 Primary Key (id)) ENGINE = MyISAM;

Create table votes (
	user_id Int NOT NULL,
	answer_id Int NOT NULL,
	vote Tinyint NOT NULL DEFAULT 0) ENGINE = MyISAM;


Alter table questions add Foreign Key (topic_id) references topics (id) on delete  restrict on update  restrict;
Alter table answers add Foreign Key (question_id) references questions (id) on delete  restrict on update  restrict;
Alter table follows add Foreign Key (question_id) references questions (id) on delete  restrict on update  restrict;
Alter table votes add Foreign Key (answer_id) references answers (id) on delete  restrict on update  restrict;
Alter table questions add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table answers add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table follows add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table votes add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;



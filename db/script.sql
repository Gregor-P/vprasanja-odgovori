/*
Created		8.9.2018
Modified		8.9.2018
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


Create table questions (
	id Int NOT NULL AUTO_INCREMENT,
	answer_id Int NOT NULL,
	user_id Int NOT NULL,
	topic_id Int NOT NULL,
	question Varchar(1000) NOT NULL,
	content Varchar(5000) NOT NULL,
	timestamp Timestamp NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table answers (
	id Int NOT NULL AUTO_INCREMENT,
	user_id Int NOT NULL,
	answer Varchar(5000) NOT NULL,
	timestamp Timestamp NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table ratings (
	id Int NOT NULL AUTO_INCREMENT,
	user_id Int NOT NULL,
	answer_id Int NOT NULL,
	rating Tinyint NOT NULL DEFAULT 0,
 Primary Key (id)) ENGINE = MyISAM;

Create table users (
	id Int NOT NULL AUTO_INCREMENT,
	username Varchar(255) NOT NULL,
	pass Varchar(40) NOT NULL,
	email Varchar(255) NOT NULL,
	name Varchar(100),
	last_name Varchar(255),
	admin Tinyint DEFAULT 0,
 Primary Key (id)) ENGINE = MyISAM;

Create table topics (
	id Int NOT NULL AUTO_INCREMENT,
	name Varchar(255) NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table views (
	id Int NOT NULL AUTO_INCREMENT,
	question_id Int NOT NULL,
	user_id Int NOT NULL,
	subscribed Tinyint DEFAULT 0,
 Primary Key (id)) ENGINE = MyISAM;


Alter table views add Foreign Key (question_id) references questions (id) on delete  restrict on update  restrict;
Alter table questions add Foreign Key (answer_id) references answers (id) on delete  restrict on update  restrict;
Alter table ratings add Foreign Key (answer_id) references answers (id) on delete  restrict on update  restrict;
Alter table questions add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table answers add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table ratings add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table views add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table questions add Foreign Key (topic_id) references topics (id) on delete  restrict on update  restrict;



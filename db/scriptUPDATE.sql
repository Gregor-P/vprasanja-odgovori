/*
Created		22/09/2018
Modified		22/09/2018
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


Create table users (
	id Int NOT NULL AUTO_INCREMENT,
	email Varchar(255) NOT NULL,
	username Varchar(255) NOT NULL,
	first_name Varchar(255),
	last_name Varchar(255),
	pass Varchar(40) NOT NULL,
	admin Tinyint NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table posts (
	id Int NOT NULL AUTO_INCREMENT,
	user_id Int NOT NULL,
	topic_id Int NOT NULL,
	title Varchar(1024) NOT NULL,
	content Varchar(2048) NOT NULL,
	parent_id Int,
	timestamp Timestamp NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table users_posts (
	id Int NOT NULL AUTO_INCREMENT,
	user_id Int NOT NULL,
	post_id Int NOT NULL,
	subscribed Tinyint NOT NULL DEFAULT 0,
	rating Tinyint NOT NULL DEFAULT 0,
	timestamp Timestamp NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table topics (
	id Int NOT NULL AUTO_INCREMENT,
	name Varchar(255) NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;


Alter table posts add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table users_posts add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table users_posts add Foreign Key (post_id) references posts (id) on delete  restrict on update  restrict;
Alter table posts add Foreign Key (topic_id) references topics (id) on delete  restrict on update  restrict;



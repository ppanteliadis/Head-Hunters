/*******************************************************************
 * @file   tables.sql                                              *
 * @author Aggelos Koropoulis <koropulis@csd.uoc.gr>, 2751         *
 * @author Ioannis-Pavlos Panteliadis <panteliad@csd.uoc.gr>, 2794 *
 *                                                                 *
 * @brief  File containing all the tables for our database.        *
 *******************************************************************/

DROP DATABASE IF EXISTS projectDB;
CREATE DATABASE projectDB;
USE projectDB;


CREATE TABLE person (
	first_name		VARCHAR(30) NOT NULL,
	last_name 		VARCHAR(30) NOT NULL,
	address 		VARCHAR(80) NOT NULL,
	phone 			VARCHAR(20) NOT NULL,
	mail 			VARCHAR(60) NULL,
	prof 			VARCHAR(40) NOT NULL DEFAULT 'unemployed',
	account 		INT UNSIGNED NOT NULL,
	studies 		SET('highschool degree', 'MSc', 'PhD', 'MD', 'EdD', 'JD') NOT NULL,
	skillz 			SET('administering programs', 'advising people', 'analyzing data', 'assembling apparatus', 'auditing financial reports', 'budgeting expenses', 'calculating numerical data', 'finding information', 'handling complaints', 'handling detail work', 'imagining new solutions', 'interpreting languages', 'speaking to the public', 'writing letters/papers/proposals', 'listening to others', 'deciding uses of money', 'determining a problem', 'setting work/committee goals', 'maintaining emotional control under stress') NOT NULL,
	languages 		SET('english', 'greek', 'german', 'japanese', 'spanish', 'italian', 'french', 'wookie', 'klingon', 'other') NOT NULL,
	pid 			INT UNSIGNED NOT NULL AUTO_INCREMENT,
	hired			INT DEFAULT 0,
	account_type	ENUM('admin', 'user') DEFAULT 'user',
	username		VARCHAR(30) NOT NULL,
	password		VARCHAR(30) NOT NULL,
	availabity		DATE NOT NULL,
	PRIMARY KEY(pid)
);

CREATE TABLE credit_card (
	balance 			INT UNSIGNED DEFAULT 0,
	pid 				INT UNSIGNED NOT NULL,
	account 			INT UNSIGNED NOT NULL,
	credit_card_number 	VARCHAR(20) NOT NULL,
	cvc 				INT(3) UNSIGNED NOT NULL,
	expiration_date 	DATE NOT NULL,
	PRIMARY KEY(credit_card_number, cvc)
);


CREATE TABLE open_position(
	field 				VARCHAR(80),
	skillz 				SET('administering programs', 'advising people', 'analyzing data', 'assembling apparatus', 'auditing financial reports', 'budgeting expenses', 'calculating numerical data', 'finding information', 'handling complaints', 'handling detail work', 'imagining new solutions', 'interpreting languages', 'speaking to the public', 'writing letters/papers/proposals', 'listening to others', 'deciding uses of money', 'determining a problem', 'setting work/committee goals', 'maintaining emotional control under stress') NOT NULL, 	/* entity */
	studies 			SET('highschool degree', 'MSc', 'PhD', 'MD', 'EdD', 'JD') NOT NULL,
	pref_languages 		SET('english', 'greek', 'german', 'japanese', 'spanish', 'italian', 'french', 'wookie', 'klingon', 'other') NOT NULL,
	city 				ENUM('Athens', 'Thessaloniki', 'Patras', 'Heraklion', 'Larissa', 'Volos', 'Rhodοs', 'Ioannina', 'Chania', 'Agrinio') NOT NULL, 		/* entity */
	salary_per_year 	INT  UNSIGNED NOT NULL,
	workhours_per_week 	TINYINT UNSIGNED NOT NULL,		/* TINYINT -127 to 127 */
	cid					INT NOT NULL, 					/* the company that wants to fill the current position */
	posid				INT UNSIGNED AUTO_INCREMENT NOT NULL,
	PRIMARY KEY (posid)
);

CREATE TABLE filled_position(
	field 				VARCHAR(80),
	skillz 				SET('administering programs', 'advising people', 'analyzing data', 'assembling apparatus', 'auditing financial reports', 'budgeting expenses', 'calculating numerical data', 'finding information', 'handling complaints', 'handling detail work', 'imagining new solutions', 'interpreting languages', 'speaking to the public', 'writing letters/papers/proposals', 'listening to others', 'deciding uses of money', 'determining a problem', 'setting work/committee goals', 'maintaining emotional control under stress') NOT NULL, 	/* entity */
	studies 			SET('highschool degree', 'MSc', 'PhD', 'MD', 'EdD', 'JD') NOT NULL,
	pref_languages 		SET('english', 'greek', 'german', 'japanese', 'spanish', 'italian', 'french', 'wookie', 'klingon', 'other') NOT NULL,
	city 				ENUM('Athens', 'Thessaloniki', 'Patras', 'Heraklion', 'Larissa', 'Volos', 'Rhodοs', 'Ioannina', 'Chania', 'Agrinio') NOT NULL, 		/* entity */
	salary_per_year 	INT  UNSIGNED NOT NULL,
	workhours_per_week 	TINYINT UNSIGNED NOT NULL,		/* TINYINT -127 to 127 */
	cid					INT NOT NULL, /* the company that did the hiring */
	pid 				INT UNSIGNED NOT NULL, /* the lucker who got the job */
	PRIMARY KEY (field)
);



CREATE TABLE company(
	company_name 		VARCHAR(50) NOT NULL,
	address 			VARCHAR(80) NOT NULL,
	phone 				VARCHAR(20) NOT NULL,
	mail 				VARCHAR(60) NULL,
	account 			INT UNSIGNED NOT NULL,
	jobs 				TINYINT UNSIGNED DEFAULT 0,		/* used for discount */
	discount 			FLOAT(2,1) NOT NULL DEFAULT 0.0,
	cid 				INT UNSIGNED NOT NULL AUTO_INCREMENT,
	username			VARCHAR(30) NOT NULL,
	password			VARCHAR(30) NOT NULL,
	PRIMARY KEY(cid)	
);

/*
CREATE TABLE requesities(
	not sure if required
)
*/

CREATE TABLE head_hunters(
	name 				VARCHAR(50) NOT NULL DEFAULT "HeadHunters",
	address 			VARCHAR(80) NOT NULL,
	phone 				VARCHAR(20) NOT NULL,
	account 			INT UNSIGNED NOT NULL,
	PRIMARY KEY(name)
);

ALTER TABLE person AUTO_INCREMENT=100;
ALTER TABLE company AUTO_INCREMENT=2000;


/* initializing head hunters */
INSERT INTO head_hunters(name, address, phone, account)
				VALUES("head hunters", "Basilika boutwn 060", "2814005199", "0000");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(9999999999, 0, 0000, "123456789", 123, "2020/12/31");

/* adding people */
INSERT INTO person(first_name, last_name, username, password, address, phone, mail, prof, account, account_type, hired)
				VALUES ("Ioannis-Pavlos", "Panteliadis", "pavlos", "12345678", "Stergiogianni 24", "6944593333", "panteliad@csd.uoc.gr", "Jedi Master", 123786789, 'admin', '1');

INSERT INTO person(first_name, last_name, username, password, address, phone, mail, prof, account, account_type, hired)
				VALUES ("Aggelos", "Koropoulis", "koropoulis", "123", "Katexaki 21", "6985777223", "koropulis@csd.uoc.gr", "Sith Lord", 0123456789, 'admin', '1');

INSERT INTO person(first_name, last_name, username, password, address, phone, mail, prof, account, account_type, hired)
		VALUES ("Plexousakis", "Dimitrios", "plex", "589589532", "Palaiokappa 64", "6974395014", "dp@ics.forth.gr", "Professor", 123786789, 'admin', '1');

INSERT INTO person(first_name, last_name, username, password, address, phone, mail, prof, account, account_type, availabity)
				VALUES("Panos", "Peristerakis", "+bro", "88", "Idomenous ", "6947498862", "perister@csd.uoc.gr", "soublatzis", 888888888, 'user', "2016/04/21");

INSERT INTO person(first_name, last_name, username, password, address, phone, mail, prof, account, account_type)
				VALUES ("Kostis", "Kleftogiwrgos", "kleftog", "password", "EOK 52", "6983444323", "kleftog@csd.uoc.gr", "developer", 12378649, 'user');

INSERT INTO person(first_name, last_name, username, password, address, phone, mail, prof, account, account_type)
			VALUES ("Elena", "Basileiou", "elena", "43490349", "Ag aikaterinhs 5", "6957364220", "bas@med.uoc.gr", "Senator", 5844843345, 'user');


/* adding companies */

INSERT INTO company(company_name, address, phone, mail, account, jobs, username, password)
			VALUES ("Galactic Empire", "Death Star 1", "666666666", "darkside@aol.com", "6666666", 2,"lrdvdr", "drksdftw");

INSERT INTO company(company_name, address, phone, mail, account, jobs, username, password)
			VALUES ("Rebel Scum", "Hoth", "1111111", "lightside@gmail.com", "674945498321", 3, "rbs", "aldareen");

INSERT INTO company(company_name, address, phone, mail, account, jobs, username, password)
			VALUES ("First Order", "Star Killer Base", "66566321", "order1st@aol.com", 66677567, 1, "phase", "tr8r");

INSERT INTO company(company_name, address, phone, mail, account, jobs, username, password)
			VALUES ("The Hutts", "Tatooine 2", "323232332", "hohoho@hotmail.com", 32323232, 0, "jabba", "rankorn");

INSERT INTO company(company_name, address, phone, mail, account, jobs, username, password)
			VALUES ("The Force", "Dagoba System", "00000", "gmail.com@yoda", 878789, 0, "password", "username");

INSERT INTO company(company_name, address, phone, mail, account, jobs, username, password)
			VALUES ("Peristerakis Pita makers", "theodosiou diakonou 11", "666666666", "darkside@aol.com", 88888, 2,"soublaki", "123");

/* adding languages, skillz and studies */
UPDATE person SET languages='greek', studies='highschool degree', skillz='maintaining emotional control under stress' WHERE last_name = "Peristerakis";

UPDATE person SET languages='greek,english,wookie', studies='highschool degree', skillz='advising people,analyzing data' WHERE last_name = "Panteliadis";

UPDATE person SET languages='greek,english,german,japanese,wookie', studies='highschool degree', skillz='advising people,analyzing data,finding information' WHERE last_name = "Koropoulis";

UPDATE person SET languages='greek,english,wookie', studies='highschool degree,MSc', skillz='advising people' WHERE last_name = "Kleftogiwrgos";

UPDATE person SET languages='greek,english', studies='highschool degree,MSc,PhD,MD,EdD,JD', skillz='advising people,analyzing data,finding information' WHERE username = "plex";

UPDATE person SET languages='greek,english,wookie', studies='highschool degree', skillz='finding information' WHERE last_name = "Basileiou";



/* adding more people */
INSERT INTO person(first_name, last_name, username, password, address, phone, mail, prof, account, account_type, availabity)
				VALUES("Mitsos","Mitsou", "mits", "0", "trololo 0 ", "6947001000", "mitsos@gmail.com", "soublatzis", 000000, 'user', "2016/03/01");
INSERT INTO person(first_name, last_name, username, password, address, phone, mail, prof, account, account_type, availabity)
				VALUES("Giannhs","Giannou", "john", "1", "trololo 1 ", "6947001001", "giannis@gmail.com", "soublatzis", 1111111, 'user', "2016/04/01");
INSERT INTO person(first_name, last_name, username, password, address, phone, mail, prof, account, account_type, availabity)
				VALUES("Takis","Takaros", "tak", "2", "trololo 2 ", "6947001002", "takis@gmail.com", "soublatzis", 222222, 'user', "2016/04/02");	
UPDATE person SET languages="english", studies='highschool degree', skillz='advising people' WHERE last_name = "Mitsou";
UPDATE person SET languages="greek,english", studies='highschool degree', skillz='analyzing data' WHERE last_name = "Giannou";
UPDATE person SET languages="greek,english", studies='highschool degree', skillz='analyzing data' WHERE last_name = "Takaros";

		
/* some open positions */
INSERT INTO open_position (field, skillz, studies, pref_languages, city, salary_per_year, workhours_per_week, cid)
				VALUES ("bounty hunter", 'advising people,analyzing data,finding information', 'highschool degree', 'greek,english,german,japanese,wookie', 'Athens', 200000, 40, 2003);
INSERT INTO open_position (field, skillz, studies, pref_languages, city, salary_per_year, workhours_per_week, cid)
				VALUES ("bounty hunter", 'analyzing data,finding information', 'MSc', 'greek,english,wookie', 'Chania', 150000, 40, 2003);
INSERT INTO open_position (field, skillz, studies, pref_languages, city, salary_per_year, workhours_per_week, cid)
				VALUES ("stormtrooper", 'handling complaints,handling detail work,imagining new solutions', 'highschool degree', 'greek', 'Athens', 30000, 40, 2000);
INSERT INTO open_position (field, skillz, studies, pref_languages, city, salary_per_year, workhours_per_week, cid)
				VALUES ("stormtrooper", 'advising people,analyzing data,finding information', 'MSc', 'greek,english,german,wookie', 'Athens', 150000, 40, 2000);
INSERT INTO open_position (field, skillz, studies, pref_languages, city, salary_per_year, workhours_per_week, cid)
				VALUES ("rebel", 'analyzing data,finding information', 'PhD', 'english,wookie', 'Larissa', 30000, 25, 2001);
				
/* some filled positions */
INSERT INTO filled_position (field, skillz, studies, pref_languages, city, salary_per_year, workhours_per_week, cid, pid)
				VALUES ("Sith Lord", 'advising people,analyzing data,finding information', 'highschool degree', 'greek,english,wookie', 'Athens', '500000', '40', 2000, 102 );
INSERT INTO filled_position (field, skillz, studies, pref_languages, city, salary_per_year, workhours_per_week, cid, pid)
				VALUES ("Jedi Master", 'advising people,finding information', 'highschool degree', 'greek,english,wookie', 'Larissa', '500000', '40', 2004, 101 );
INSERT INTO filled_position (field, skillz, studies, pref_languages, city, salary_per_year, workhours_per_week, cid, pid)
				VALUES ("Professor", 'advising people,analyzing data,finding information', 'PhD', 'greek,english', 'Thessaloniki', '300000', '40', 2000, 103 );
				
/* adding credit cards */
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(3999999, 100, 123786789, "54984948558", 234, "2020/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(2999999, 101, 23456789, "5498493294", 345, "2020/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(9999990, 102, 33333888, "5354378471", 456, "2020/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(100, 103, 123786789, "888888888", 888, "2016/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(10000, 104, 12378649, "2133323133", 567, "2020/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(100000, 105, 5844843345, "43243212", 678, "2020/12/31");

INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(19999000, 2000, 6666666, "3223233223", 666, "2020/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(99999900, 2001, 674945498321, "12345678", 345, "2020/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(9999990, 2002, 123786789, "99999999", 456, "2020/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(100, 2003, 66677567, "323232", 888, "2016/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(10000, 2004, 32323232, "44567", 567, "2020/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(100000, 2005, 88888, "67674211", 678, "2020/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(500, 2006, 333563, "8909090909", 678, "2020/12/31");

INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(200, 106, 000000, "900000000000", 888, "2016/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(200, 107, 1111111, "111111111111", 567, "2020/12/31");
INSERT INTO credit_card(balance, pid, account, credit_card_number, cvc, expiration_date)
				VALUES(200, 108, 222222, "22222222222", 678, "2020/12/31");				

				
				


DROP Database WienerLinienEventTool;
Create Database WienerLinienEventTool;
USE WienerLinienEventTool;
ALTER DATABASE WienerLinienEventTool
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

create table Organizer (
  pk_id integer primary key auto_increment,
  first_name varchar(20),
  last_name varchar(20),
  username varchar(20) unique,
  password_ varchar(20)
);

create table events_ (
  pk_id integer primary key auto_increment,
  description varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci,
  plz varchar(10),
  ort varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci,
  strasse varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  title varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci,
  opening_text varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci,
  second_text varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci,
  date_begin DATE,
  time_begin time,
  time_end time,
  fk_creator integer,
  agenda MEDIUMBLOB,
  constraint fk_creator_c foreign key (fk_creator) references Organizer(pk_id)
);

create table Participants (
  pk_id integer primary key auto_increment,
  first_name varchar(20),
  last_name varchar(20),
  fk_event integer,
  token varchar(200),
  answer varchar(200),
  teilnahme integer(3),
  constraint fk_event_c foreign key (fk_event) references events_(pk_id)
);


insert into Organizer(pk_id, first_name, last_name, username, password_)
values (1,'Admin','Admin', 'root', 'root');
insert into Organizer(pk_id, first_name, last_name, username, password_)
values (2,'Christian','Bauer', 'bauer007', 'Passwort');
insert into Organizer(pk_id, first_name, last_name, username, password_)
values (3,'Hans','Peter', 'xXPeterXx', 'pw');
insert into Organizer(pk_id, first_name, last_name, username, password_)
values (4,'Gerhard','Schaf', 'Gerhard1', 'SchafSchaf');

insert into events_(pk_id, description, plz, ort, strasse, title, opening_text, second_text, date_begin, time_begin, time_end, agenda,fk_creator)
values(1,'Wir moechten Sie hiermit zur Geburtstagsfeier vom Sebastian einladen','1140','Wien','Linzerstrasse','Geburtstagsfeier vom Sebi Kaese','Bitte sagen Sie entweder zu oder ab, damit wir das Fest vollkommen durchplanen koennen','XYZ',"2017-12-12","05:03:22","07:08:25",01010101,1);

insert into events_(pk_id, description, plz, ort, strasse, title, opening_text, second_text, date_begin, time_begin, time_end, agenda,fk_creator)
values(2,'Wir moechten uns am kommenden Samstag zum Grillen bei der U-Bahn Station Wien Mitte treffen','1030','Wien','Landstrasse','Grillen am Samstag','Bitte sagen Sie entweder zu oder ab, damit wir das Fest vollkommen durchplanen koennen','XYZ',"2017-05-12","20:15:00","22:00:00",01010101,2);

insert into events_(pk_id, description, plz, ort, strasse, title, opening_text, second_text, date_begin, time_begin, time_end, agenda,fk_creator)
values(3,'Teambuilding-Event','1010','Wien','Stephansplatz','Ein spannendes Event zur Stärkung der Gruppendynamik','Bitte sagen Sie entweder zu oder ab, damit wir das Fest vollkommen durchplanen koennen','XYZ',"2017-02-14","15:30:00","17:00:00",01010101,3);

insert into Participants(pk_id, first_name, last_name, fk_event, token, answer, teilnahme)
values(1,'Sebastian','Kaese',1,'fihwbkwoaqztglme','',0);
insert into Participants(pk_id, first_name, last_name, fk_event, token, answer, teilnahme)
values(2,'Lukas','Hammer',2,'diqzrvdlthmqarst','Termin',2);
insert into Participants(pk_id, first_name, last_name, fk_event, token, answer, teilnahme)
values(3,'Rudolf','Stuhl',1,'uqbdogesrtahqbfk','',1);
insert into Participants(pk_id, first_name, last_name, fk_event, token, answer, teilnahme)
values(4,'Marcel','Vogel',1,'pwufbmqfakfplmho','Keine Zeit',2);
insert into Participants(pk_id, first_name, last_name, fk_event, token, answer, teilnahme)
values(5,'Hans','Stier',3,'fsdtueghlamqirbg','',1);
drop database if exists TS2021;

#Creating the database.

create database TS2021;

#Using the database.

use TS2021;

#Creating the entities or tables of the database.

create table Cinema (
Cinema_ID int (8) not null auto_increment,
Cinema_Name varchar (20) not null,
Cinema_Address nvarchar (50) not null,
Cinema_Telephone varchar (20) not null,
Cinema_Email varchar (30) not null,
primary key (Cinema_ID));

create table Theatre(
Theatre_ID int (8) not null auto_increment,
Theatre_Name varchar (20) not null,
Cinema_ID int (8) not null,
primary key (Theatre_ID),
foreign key (Cinema_ID) references Cinema (Cinema_ID));

create table Movie (
Movie_ID int (8) not null auto_increment,
Movie_Title varchar (50) not null,
Movie_Genre varchar (20) not null,
About_Movie text,
Movie_Cover varchar (100),
primary key (Movie_ID));

create table Movie_Time(
Movie_Time_ID int (8) not null auto_increment,
Movie_ID int (8),
Movie_Time varchar(8) not null,
ShowingDate_Start datetime not null,
ShowingDate_End datetime not null,
Theatre_ID int (8) not null,
primary key (Movie_Time_ID),
foreign key (Movie_ID) references Movie (Movie_ID),
foreign key (Theatre_ID) references Theatre (Theatre_ID));

create table User (
User_ID int (8) not null auto_increment, 
User_Name varchar (20) not null,
User_Password varchar (200) not null,
First_Name varchar(20) not null, 
Last_Name varchar (20) not null, 
Gender enum ("Female", "Male", "Other") not null, 
Date_of_Birth date not null,
Nationality varchar (20) not null,
Address nvarchar (50),
Email_Address nvarchar (50), 
Contact_Number varchar (20) not null,
primary key (User_ID));

create table Ticket(
Ticket_ID int (8) not null auto_increment,
Ticket_Price double not null,
Movie_Time_ID int (8) not null,
User_ID int (8),
primary key (Ticket_ID),
foreign key (User_ID) references User (User_ID),
foreign key (Movie_Time_ID) references Movie_Time (Movie_Time_ID));

drop database if exists TS2021_admin;

#Creating the database.

create database TS2021_admin;

#Using the database.

use TS2021_admin;

create table Administrator (
Administrator_ID int (8) not null auto_increment, 
Name varchar(20) not null,
Password varchar (200) not null,
Date_of_Birth date not null,
Address nvarchar (50) not null,
Email_Address nvarchar (50) not null, 
Contact_Number varchar (20) not null,
primary key(Administrator_ID));

INSERT INTO `Administrator` (`Name`, `Password`, `Date_of_Birth`, `Address`, `Email_Address`, `Contact_Number`) VALUES('Goodie Dawson', 'ea1dd674bea1289b48a411316ed9b954', '1999-03-12', 'Goodie Rd.', 'goodie.dawson@ashesi.edu.gh', '+233 54 011 9901');
INSERT INTO `Administrator` (`Name`, `Password`, `Date_of_Birth`, `Address`, `Email_Address`, `Contact_Number`) VALUES('William Kyei', '1e5cc4627fa7767e9792d031ea96c541', '2001-07-02', 'William Rd.', 'william.kyei@ashesi.edu.gh', '+233 55 079 2166');
INSERT INTO `Administrator` (`Name`, `Password`, `Date_of_Birth`, `Address`, `Email_Address`, `Contact_Number`) VALUES('Pamela Anang', '0aee5f0cdd92b8dfbb27ce4c541d951e', '1999-09-10', 'Pams Rd.', 'pamela.anang@ashesi.edu.gh', '+233 54 114 5848');
INSERT INTO `Administrator` (`Name`, `Password`, `Date_of_Birth`, `Address`, `Email_Address`, `Contact_Number`) VALUES('Yvonne Dewortor', 'ba766d8a677f402adb3a3a73932a880c', '1999-05-04', 'Yvonne Rd.', 'yvonne.dewortor@ashesi.edu.gh', '+233 23 691 7692');
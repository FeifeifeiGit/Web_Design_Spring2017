/*
Created: 4/5/2017
Modified: 4/5/2017
Model: MySQL 5.6
Database: MySQL 5.6
*/


-- Create tables section -------------------------------------------------

-- Table Request

CREATE TABLE `Request`
(
  `Sender_Id` Int NOT NULL,
  `Receiver_Id` Int NOT NULL,
  `Status` Varchar(20) NOT NULL
)
;

ALTER TABLE `Request` ADD  PRIMARY KEY (`Sender_Id`,`Receiver_Id`)
;

-- Table Post

CREATE TABLE `Post`
(
  `Post_Id` Int NOT NULL,
  `Post_Time` Time NOT NULL,
  `Content` Varchar(200) NOT NULL,
  `Photo_Path` Varchar(200),
  `User_Id` Int NOT NULL
)
;

CREATE INDEX `IX_Relationship9` ON `Post` (`User_Id`)
;

ALTER TABLE `Post` ADD  PRIMARY KEY (`Post_Id`)
;

-- Table Comments

CREATE TABLE `Comments`
(
  `Comment_Id` Int NOT NULL,
  `Comment_Time` Time NOT NULL,
  `Content` Varchar(200) NOT NULL,
  `Post_Id` Int NOT NULL,
  `User_Id` Int NOT NULL
)
;

CREATE INDEX `IX_Relationship2` ON `Comments` (`Post_Id`)
;

CREATE INDEX `IX_Relationship10` ON `Comments` (`User_Id`)
;

ALTER TABLE `Comments` ADD  PRIMARY KEY (`Comment_Id`)
;

-- Table Users

CREATE TABLE `Users`
(
  `User_Id` Int NOT NULL,
  `FirstName` Varchar(20) NOT NULL,
  `LastName` Varchar(20) NOT NULL,
  `DisplayName` Varchar(20) NOT NULL,
  `Gender` Varchar(20) NOT NULL,
  `Email` Varchar(20) NOT NULL,
  `Password` Varchar(40) NOT NULL,
  `Birthday` Date NOT NULL,
  `ProfilePhoto` Varchar(200),
  `Description` Varchar(200),
  `SchoolOrWork` Varchar(20)
)
;

ALTER TABLE `Users` ADD  PRIMARY KEY (`User_Id`)
;

ALTER TABLE `Users` ADD UNIQUE `User_Id` (`User_Id`)
;

-- Table FriendsList

CREATE TABLE `FriendsList`
(
  `User_Id` Int NOT NULL,
  `Friend_Id` Int NOT NULL,
  `Status` Char(10)
)
;

ALTER TABLE `FriendsList` ADD  PRIMARY KEY (`User_Id`,`Friend_Id`)
;

-- Create relationships section ------------------------------------------------- 

ALTER TABLE `Comments` ADD CONSTRAINT `Relationship10` FOREIGN KEY (`User_Id`) REFERENCES `Users` (`User_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE `Post` ADD CONSTRAINT `User Posts` FOREIGN KEY (`User_Id`) REFERENCES `Users` (`User_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE `FriendsList` ADD CONSTRAINT `Friend` FOREIGN KEY (`Friend_Id`) REFERENCES `Users` (`User_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE `FriendsList` ADD CONSTRAINT `User` FOREIGN KEY (`User_Id`) REFERENCES `Users` (`User_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE `Request` ADD CONSTRAINT `Receiver` FOREIGN KEY (`Receiver_Id`) REFERENCES `Users` (`User_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE `Request` ADD CONSTRAINT `Sender` FOREIGN KEY (`Sender_Id`) REFERENCES `Users` (`User_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE `Comments` ADD CONSTRAINT `Comments of post` FOREIGN KEY (`Post_Id`) REFERENCES `Post` (`Post_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
;


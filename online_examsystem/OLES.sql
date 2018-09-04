drop database exam_db;
create database exam_db;

use exam_db;

create table User(
userID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
fullname varchar(50),
username varchar(20),
password varchar(300),
email varchar(20));

create table Admin(
adminID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
userID int,
FOREIGN KEY (userID) REFERENCES User(userID)
);

create table Student(
studentID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
userID int,
FOREIGN KEY (userID) REFERENCES User(userID)
);

create table Questions(
questionID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
question varchar(100),
option1 varchar(60),
option2 varchar(60),
option3 varchar(60),
option4 varchar(60),
correctAnswer varchar(60)
);
create table Course(
courseID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
courseName varchar(50) NOT NULL,
courseCode varchar(50),
adminID int,
FOREIGN KEY (adminID) REFERENCES Admin(adminID)
);

create table exam(
examID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title varchar(100),
adminID int,
courseID int,
FOREIGN KEY (courseID) REFERENCES Course(courseID),
FOREIGN KEY (adminID) REFERENCES Admin(adminID)
);

create table ExamQuestions(
examID int,
questionID int,
FOREIGN KEY (examID) REFERENCES exam(examID),
FOREIGN KEY (questionID) REFERENCES Questions(questionID)
);

create table StudentAnswer(
examID int,
questionID int,
studentID int,
selectedAnswer varchar(60),
scoreStatus boolean,
FOREIGN KEY (examID) REFERENCES exam(examID),
FOREIGN KEY (questionID) REFERENCES Questions(questionID),
FOREIGN KEY (studentID) REFERENCES Student(studentID)
);

create table StudentExam(
examID int,
studentID int,
score int,
FOREIGN KEY (examID) REFERENCES exam(examID),
FOREIGN KEY (studentID) REFERENCES Student(studentID)
);

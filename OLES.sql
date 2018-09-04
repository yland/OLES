drop database oles;

create database oles;

use oles;

create table User(
userID int NOT NULL PRIMARY KEY,
fullname varchar(50) NOT NULL,
username varchar(20) NOT NULL,
password varchar(20) NOT NULL,
email varchar(20));

create table Admin(
adminID int NOT NULL PRIMARY KEY,
userID int,
FOREIGN KEY (`userID`) REFERENCES `User`(`userID`)
);

create table Student(
studentID int NOT NULL PRIMARY KEY,
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
courseID int NOT NULL PRIMARY KEY,
courseName varchar(50) NOT NULL,
courseCode varchar(50),
adminID int,
FOREIGN KEY (adminID) REFERENCES Admin(adminID)
);

create table exam(
examID INT NOT NULL PRIMARY KEY,
adminID int,
courseID int,
title varchar(100) NOT NULL,
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


/*Add teachers*/
INSERT INTO User VALUES ('1', 'John Doe', 'userdoe', 'pass', 'johndoe@gmail.com');
INSERT INTO Admin VALUES ('1', '1');

INSERT INTO User VALUES ('2', 'Jane Benett', 'userjane', 'bennetpass', 'jane.benet@yahoo.com');
INSERT INTO Admin VALUES ('2', '2');

/*Add students*/
INSERT INTO User VALUES ('3', 'Hope Marshall', 'userhope', 'passhope', 'hope@gmail.com');
INSERT INTO Student VALUES ('3', '3');

INSERT INTO User VALUES ('4', 'Nick Jones', 'usernick', 'jonepass', 'jonnick@yahoo.com');
INSERT INTO Student VALUES ('4', '4');

INSERT INTO User VALUES ('5', 'Tom Crook', 'usertom', 'tompass', 'crook@yahoo.com');
INSERT INTO Student VALUES ('5','5');

/*Add Questions*/
INSERT INTO Questions (question, option1, option2, option3, option4, correctAnswer) VALUES ('How many days are found in a year', '365', '200', '165', '300', '365');
INSERT INTO Questions (question, option1, option2, option3, option4, correctAnswer) VALUES ('Who is the president of Cameroon', 'Paul Buma', 'Ayamba M', 'Paul Biya', 'Jacob Duma', 'Paul Biya');
INSERT INTO Questions (question, option1, option2, option3, option4, correctAnswer) VALUES ('Who talked about scaffolding in psychology?', 'Watson', 'Piaget', 'Thorndike', 'Vygotsky', 'Vygotsky');
INSERT INTO Questions (question, option1, option2, option3, option4, correctAnswer) VALUES ('Who talked about classical conditioning in psychology?', 'Pavlov', 'Piaget', 'Thorndike', 'Rogers', 'Pavlov');

/*Add courses*/
INSERT INTO Course (courseID, courseName, courseCode) VALUES ('1', 'My first course', 'UB101');
INSERT INTO Course (courseID, courseName) VALUES ('2', 'Psychology');

/*Add exam*/
INSERT INTO exam (examID, adminID, courseID, title) VALUES ('1', '2', '1', 'Genral knowledge 1');
INSERT INTO exam (examID, adminID, courseID, title) VALUES ('2', '2', '1', 'General Knowledge 2');
INSERT INTO exam (examID, adminID, courseID, title) VALUES ('3', '1', '2', 'Intro to Psychology');


/*Add exam to question link*/
INSERT INTO ExamQuestions (examID, questionID) VALUES ('2', '1');
INSERT INTO ExamQuestions (examID, questionID) VALUES ('2', '2');

/*Add Student to answer link*/
INSERT INTO StudentAnswer (examID, questionID, studentID, selectedAnswer, scoreStatus) VALUES ('1', '1', '3', '365', true);
INSERT INTO StudentAnswer (examID, questionID, studentID, selectedAnswer, scoreStatus) VALUES ('1', '2', '3', 'Paul Biya', true);
INSERT INTO StudentAnswer (examID, questionID, studentID, selectedAnswer, scoreStatus) VALUES ('3', '3', '3', 'Piaget', false);

INSERT INTO StudentAnswer (examID, questionID, studentID, selectedAnswer, scoreStatus) VALUES ('1', '1', '4', '300', false);
INSERT INTO StudentAnswer (examID, questionID, studentID, selectedAnswer, scoreStatus) VALUES ('1', '2', '4', 'Paul Buma', false);


/*Add Student to exam link*/
INSERT INTO StudentExam (examID, studentID, score) VALUES ('1', '3', '2');
INSERT INTO StudentExam (examID, studentID, score) VALUES ('3', '3', '0');
INSERT INTO StudentExam (examID, studentID, score) VALUES ('1', '4', '0');

SELECT adminID FROM Admin WHERE userID='17';

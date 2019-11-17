CREATE DATABASE `college`;

USE `college`;

CREATE TABLE `student`(
    `student_id` INTEGER NOT NULL PRIMARY KEY,
    `name` VARCHAR(10) NOT NULL,
    `year` TINYINT NOT NULL DEFAULT 1,
    `dept_no` INT NOT NULL,
    `major` VARCHAR(20)
);

CREATE TABLE `department`(
    `dept_no` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `dept_name` VARCHAR(20) NOT NULL UNIQUE,
    `office` VARCHAR(20) NOT NULL,
    `office_tel` VARCHAR(13)
);

ALTER TABLE `student` CHANGE `major` `major` VARCHAR(30);
ALTER TABLE `student` ADD `gender` VARCHAR(10);

ALTER TABLE `student` DROP `gender`;

ALTER TABLE `student` CHANGE `major` `major` VARCHAR(35);
ALTER TABLE `student` CHANGE `name` `name` VARCHAR(15);


INSERT INTO `student` VALUES (20070002, "Jane Smith", 3, 4, "Business Administration"),
(20060001, 'Ashley Jackson', 4, 4, "Business Administration"),
(20030001, "Liam Johnson", 4, 2, "Electrical Engineering"),
(20040003, "Jacob Lee", 3, 2, "Electrical Engineering"),
(20060002, "Noah Kim", 3, 1, "Computer Science"),
(20100002, "Ava Lim", 3, 4, "Business Administration"),
(20110001, "Emma Watson", 2, 1, "Computer Science"),
(20080003, "Lisa Maria", 4, 3, "Law"),
(20040002, "Jacob William", 4, 5, "Law"),
(20070001, "Emily Rose", 4, 4, "Business Administration"),
(20100001, "Ethan Hunt", 3, 4, "Business Administration"),
(20110002, "Jason Mraz", 2, 1, "Electrical Engineering"),
(20030002, "John Smith", 5, 1, "Computer Science"),
(20070003, "Sophia Park", 4, 3, "Law"),
(20070007, "James Michael", 2, 4, "Business Administration"),
(20100003, "James Bond", 3, 1, "Computer Science"),
(20070005, "Olivia Madison", 2, 5, "English Language and Literature");

ALTER TABLE `department` CHANGE `dept_name` `dept_name` VARCHAR(40) NOT NULL UNIQUE;
ALTER TABLE `department` CHANGE `office` `office` VARCHAR(30) NOT NULL;

INSERT INTO `department`(`dept_name`, `office`, `office_tel`) VALUES ("Computer Science", "Science Building 101", "02-3290-0123"),
("Electrical Engineering", "Engineering Building 401", "02-3290-2345"),
("Law", "Law Building 201", "02-3290-7896"),
("Business Administration", "Business Building 104", "02-3290-1112"),
("English Language and Literature", "Language Building 303", "02-3290-4412");


UPDATE `department` SET `dept_name` = "Electrical and Electronics Engineering" WHERE `dept_name` = "Electrical Engineering";
INSERT INTO `department` (`dept_name`, `office`, `office_tel`) VALUES ("Special Education", "Education Building 403", "02-3290-2347");
UPDATE `student` SET `dept_no` = 6 WHERE name = "Emma Watson";
DELETE FROM `student` WHERE name = "Jason Mraz";
DELETE FROM `student` WHERE name = "John Smith";

/*-------*/

SELECT * FROM `student` WHERE `major` = "Computer Science";
SELECT `student_id`, `year`, `major` FROM `student`;
SELECT * FROM `student` WHERE `year` = 3;
SELECT * FROM `student` WHERE `year` = 1 OR `year` = 2;
SELECT * FROM `student` WHERE `dept_no` = (SELECT `dept_no` FROM `department` WHERE `dept_name` = "Business Administration");


SELECT * FROM `student` WHERE `student_id` LIKE "%2007%";
SELECT * FROM `student` ORDER BY `student_id`;
SELECT `major` FROM `student` GROUP BY `major` HAVING AVG(year) > 3;
SELECT * FROM `student` WHERE `major` = "Business Administration" AND `student_id` LIKE "%2007%" LIMIT 2;

/* ex 6*/
USE `IMDB`;

SELECT `role` FROM `roles`
JOIN `movies` ON `roles`.`movie_id` = `movies`.`id`
WHERE `movies`.`name` = "Pi";

SELECT `first_name`, `last_name`, `roles`.`role` FROM `actors`
JOIN `roles` ON `actors`.`id` = `roles`.`actor_id`
JOIN `movies` ON `roles`.`movie_id` = `movies`.`id`
WHERE `movies`.`name` = "Pi";

SELECT `first_name`, `last_name` FROM `actors`
JOIN `roles` ON `actors`.`id` = `roles`.`actor_id`
JOIN `movies` ON `roles`.`movie_id` = `movies`.`id`
WHERE `movies`.`name` = "Kill Bill: Vol. 1" 
AND `actors`.`id` IN (SELECT `actors`.`id` FROM `actors`
    JOIN `roles` ON `actors`.`id` = `roles`.`actor_id`
    JOIN `movies` ON `roles`.`movie_id` = `movies`.`id`
    WHERE `movies`.`name` = "Kill Bill: Vol. 2");

SELECT `first_name`, `last_name`, COUNT(`roles`.`actor_id`) AS "count" FROM `actors`
JOIN `roles` ON `actors`.`id` = `roles`.`actor_id`
GROUP BY `actors`.`id` ORDER BY COUNT(`roles`.`actor_id`) DESC LIMIT 7;

SELECT `movies_genres`.`genre`, COUNT(`movies`.`id`) AS "count" FROM `movies_genres`
JOIN `movies` ON `movies_genres`.`movie_id` = `movies`.`id`
GROUP BY `movies_genres`.`genre` ORDER BY COUNT(`movies`.`id`) DESC LIMIT 3;

SELECT `first_name`, `last_name`, COUNT(`movies`.`id`) AS "count" FROM `movies`
JOIN `movies_genres` ON `movies`.`id` = `movies_genres`.`movie_id`
JOIN `movies_directors` ON `movies`.`id` = `movies_directors`.`movie_id`
JOIN `directors` ON `movies_directors`.`director_id` = `directors`.`id`
WHERE `movies_genres`.`genre` = 'Thriller'
GROUP BY `directors`.`id` ORDER BY COUNT(`movies`.`id`) DESC;

/* ex 7*/

USE `simposons`

SELECT `grade` FROM `grades`
JOIN `courses` ON `grades`.`course_id` = `courses`.`id`
WHERE `courses`.`name` = "Computer Science 143";

SELECT `students`.`name`, `grade` FROM `students`
JOIN `grades` ON `students`.`id` = `grades`.`student_id`
JOIN `courses` ON `grades`.`course_id` = `courses`.`id`
WHERE `courses`.name =  "Computer Science 143" AND `grades`.`grade` <= "B-";

SELECT `students`.`name`, `courses`.`name`, `grade` FROM `students`
JOIN `grades` ON `students`.`id` = `grades`.`student_id`
JOIN `courses` ON `grades`.`course_id` = `courses`.`id`
WHERE
    `grades`.`grade` <= "B-";

SELECT `courses`.`name`, COUNT(`students`.`id`) AS "count"
FROM `students`
JOIN `grades` ON `students`.`id` = `grades`.`student_id`
JOIN `courses` ON `grades`.`course_id` = `courses`.`id`
GROUP BY `courses`.`id`
HAVING COUNT(`students`.`id`) >= 2;
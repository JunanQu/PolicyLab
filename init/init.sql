/* User Accounts */



CREATE TABLE `worlds` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE
);

CREATE TABLE `user_question_order` (
	`user_id`	INTEGER NOT NULL,
	`question_id_sequence` TEXT NOT NULL
);

CREATE TABLE `user_question_world_answer` (
	`user_id`	INTEGER NOT NULL,
	`world_id`	INTEGER NOT NULL,
	`question_id`	INTEGER NOT NULL,
	`answer`	INTEGER NOT NULL
);

INSERT INTO `worlds` (id) VALUES (1);
INSERT INTO `worlds` (id) VALUES (2);
INSERT INTO `worlds` (id) VALUES (3);
------------------------------------------------
INSERT INTO `questions` (question_id, question_name, question_content) VALUES (1, "Q1", "THIS IS QUESTION ONE");
INSERT INTO `questions` (question_id, question_name, question_content) VALUES (2, "Q2", "THIS IS QUESTION TWO");
INSERT INTO `questions` (question_id, question_name, question_content) VALUES (3, "Q3", "THIS IS QUESTION THREE");
INSERT INTO `questions` (question_id, question_name, question_content) VALUES (4, "Q4", "THIS IS QUESTION FOUR");
INSERT INTO `questions` (question_id, question_name, question_content) VALUES (5, "Q5", "THIS IS QUESTION FIVE");
------------------------------------------------

INSERT INTO  `users` (id, name, turk_id, user_ip) VALUES ( 1, "A","A","::1");
INSERT INTO  `users` (id, name, turk_id, user_ip) VALUES ( 2, "B","B","::2");
INSERT INTO  `users` (id, name, turk_id, user_ip) VALUES ( 3, "C","C","::3");
INSERT INTO  `users` (id, name, turk_id, user_ip) VALUES ( 4, "D","D","::4");
------------------------------------------------
INSERT INTO `user_question_order` (user_id, question_id_sequence) VALUES (1,"1,2,3,4,5");
------------------------------------------------
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (1, 1, 1, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (1, 1, 2, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (1, 1, 3, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (1, 1, 4, 1);

------------------------------------------------
INSERT INTO `user_question_order` (user_id, question_id_sequence) VALUES (2,"5,4,3,2,1");
------------------------------------------------
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (2, 2, 5, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (2, 2, 4, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (2, 2, 3, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (2, 2, 2, 1);
------------------------------------------------
INSERT INTO `user_question_order` (user_id, question_id_sequence) VALUES (3,"1,3,2,4,5");
------------------------------------------------
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (3, 2, 1, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (3, 2, 3, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (3, 2, 2, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (3, 2, 4, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (3, 2, 5, 1);
------------------------------------------------
INSERT INTO `user_question_order` (user_id, question_id_sequence) VALUES (4,"1,3,2,4,5,6,7");
------------------------------------------------
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (4, 3, 1, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (4, 3, 3, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (4, 3, 2, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (4, 3, 4, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (4, 3, 5, 1);
------------------------------------------------
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (5, 3, 4, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (5, 3, 5, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (5, 3, 3, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (5, 3, 2, 1);

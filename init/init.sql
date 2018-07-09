/* User Accounts */
CREATE TABLE `users` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  `name` TEXT NOT NULL,
	`turk_id`	TEXT NOT NULL UNIQUE,
	`user_ip`	TEXT,
  `session`	TEXT UNIQUE
);

CREATE TABLE `questions` (
	`question_id`	INTEGER NOT NULL UNIQUE,
	`question_name`	TEXT NOT NULL,
	`question_content`	TEXT NOT NULL,
	PRIMARY KEY(`question_id`)
);

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
------------------------------------------------
INSERT INTO  `users` (id, name, turk_id, user_ip, session) VALUES ( 1, "A","A","::1","jkl123ljoifn");
INSERT INTO  `users` (id, name, turk_id, user_ip, session) VALUES ( 2, "B","B","::2","ad;jksliejql");
INSERT INTO  `users` (id, name, turk_id, user_ip, session) VALUES ( 3, "C","C","::3","dajldlkasdj");
INSERT INTO  `users` (id, name, turk_id, user_ip, session) VALUES ( 4, "D","D","::4","dkjaldlasji");
------------------------------------------------
INSERT INTO `user_question_order` (user_id, question_id_sequence) VALUES (1,"1,2,3,4,5");
------------------------------------------------
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (1, 1, 1, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (1, 1, 2, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (1, 1, 3, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (1, 1, 4, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (1, 1, 4, 1);
------------------------------------------------
INSERT INTO `user_question_order` (user_id, question_id_sequence) VALUES (2,"5,4,3,2,1");
------------------------------------------------
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (2, 2, 5, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (2, 2, 4, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (2, 2, 3, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (2, 2, 2, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (2, 2, 2, 1);
------------------------------------------------
INSERT INTO `user_question_order` (user_id, question_id_sequence) VALUES (3,"1,3,2,4,5");
------------------------------------------------
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (3, 2, 1, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (3, 2, 3, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (3, 2, 2, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (3, 2, 4, 1);
INSERT INTO `user_question_world_answer` (user_id, world_id, question_id, answer) VALUES (3, 2, 5, 1);

/* User Accounts */
CREATE TABLE `users` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  `name` TEXT NOT NULL,
	`turk_id`	TEXT NOT NULL UNIQUE,
	`user_ip`	TEXT NOT NULL UNIQUE
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

CREATE TABLE `question_order` (
	`question_id`	INTEGER,
	`world_id`	INTEGER,
	PRIMARY KEY(`question_id`,`world_id`)
);

CREATE TABLE `user_question_world_answer` (
	`user_id`	INTEGER NOT NULL,
	`world_id`	INTEGER NOT NULL,
	`question_id`	INTEGER NOT NULL,
	`answer`	INTEGER NOT NULL
);
------------------------------------------------

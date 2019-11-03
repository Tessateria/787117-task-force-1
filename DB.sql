USE catalog;

CREATE TABLE categories (
  id SMALLINT AUTO_INCREMENT PRIMARY KEY,
  category VARCHAR(255) NOT NULL
);

CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  text TEXT,
  id_worker INT UNSIGNED NOT NULL,
  id_author INT UNSIGNED NOT NULL,
  id_task INT UNSIGNED NOT NULL,
  date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE task_respond(
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_task INT UNSIGNED NOT NULL,
  id_worker INT UNSIGNED NOT NULL,
  text TEXT,
  price INT UNSIGNED,
  date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_categories_rel(
  id_user INT UNSIGNED NOT NULL,
  id_category INT UNSIGNED NOT NULL,
  PRIMARY KEY (id_user, id_category)
);

CREATE TABLE notification(
  id_notification SMALLINT AUTO_INCREMENT PRIMARY KEY,
  notification VARCHAR(255) NOT NULL,
  text_message TEXT NOT NULL
);

CREATE TABLE user_notification_rel(
  id_user INT UNSIGNED NOT NULL,
  id_notification INT UNSIGNED NOT NULL,
  PRIMARY KEY (id_user, id_notification)
);

CREATE TABLE user(
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(255) NOT NULL,
 email CHAR(100) NOT NULL UNIQUE,
 id_city INT UNSIGNED,
 pass CHAR(64)  NOT NULL,
 address VARCHAR(255),
 geo_lat FLOAT,
 geo_lng FLOAT,
 telephone CHAR(11),
 scype VARCHAR(255),
 messanger VARCHAR(255),
 age TIMESTAMP,
 about TEXT,
 avatar_photo VARCHAR(255),
 role ENUM('author', 'worker'),
 file TEXT
);

CREATE TABLE user_rating(
  id_user INT NOT NULL PRIMARY KEY,
  rating TINYINT UNSIGNED,
  view_counter INT UNSIGNED,
  task_add_counter INT UNSIGNED,
  task_done_counter INT UNSIGNED,
  comment_in_counter INT UNSIGNED,
  comment_out_counter INT UNSIGNED,
  last_time_visit TIMESTAMP
);

CREATE TABLE task(
 id INT AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(255) NOT NULL,
 information TEXT,
 id_category INT UNSIGNED NOT NULL ,
 file TEXT,
 id_city INT UNSIGNED,
 geo_lat FLOAT,
 geo_lng FLOAT,
 value INT UNSIGNED,
 date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 date_finish TIMESTAMP NULL DEFAULT NULL,
 id_author INT UNSIGNED NOT NULL ,
 id_worker INT UNSIGNED,
 id_status INT UNSIGNED NOT NULL ,
 done ENUM('yes', 'problem'),
 rating TINYINT UNSIGNED ,
 finish_comment TEXT
);

CREATE TABLE task_status(
 id INT AUTO_INCREMENT PRIMARY KEY,
 status VARCHAR(255) NOT NULL
);



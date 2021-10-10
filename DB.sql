CREATE TABLE criterion (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, name varchar(45));

CREATE TABLE student (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, first_name varchar(45), last_name varchar(45), major varchar(45),
email_address TINYTEXT NOT NULL, student_password TEXT NOT NULL, lldt DATETIME, live BOOL NOT NULL);

CREATE TABLE professor (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, first_name varchar(45), last_name varchar(45),
email_address TINYTEXT NOT NULL, password TEXT NOT NULL, lldt DATETIME, live BOOL NOT NULL);

CREATE TABLE contact (dayTime TIMESTAMP, student_id INT unsigned, FOREIGN KEY (student_id) REFERENCES student(id), professor_id INT unsigned, FOREIGN KEY (professor_id) REFERENCES professor(id),
nameUser TINYTEXT, emailUser TINYTEXT, subjectText TINYTEXT, messageText LONGTEXT);

CREATE TABLE administrator (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, first_name varchar(45), last_name varchar(45),
email_address TINYTEXT NOT NULL, admin_password TEXT NOT NULL);

CREATE TABLE student_group (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, team_name varchar(45), 
prof_course_id INT UNSIGNED NOT NULL, FOREIGN KEY (prof_course_id) REFERENCES professor_course(id));

CREATE TABLE group_assign (group_id INT UNSIGNED NOT NULL, FOREIGN KEY (group_id) REFERENCES student_group(id),
student_id INT UNSIGNED NOT NULL, FOREIGN KEY (student_id) REFERENCES student(id));

CREATE TABLE course (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, course_name varchar(45), course_number varchar(45));

CREATE TABLE professor_course (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, professor_id INT UNSIGNED NOT NULL, 
FOREIGN KEY (professor_id) REFERENCES professor(id),  course_id INT UNSIGNED NOT NULL, 
FOREIGN KEY (course_id) REFERENCES course(id), term_id INT UNSIGNED NOT NULL, FOREIGN KEY (term_id) REFERENCES term(id));


CREATE TABLE term (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, name varchar(45), start_date DATE, end_date DATE);

CREATE TABLE student_course (student_id INT UNSIGNED NOT NULL, FOREIGN KEY (student_id) REFERENCES student(id), 
prof_course_id INT UNSIGNED NOT NULL, FOREIGN KEY (prof_course_id) REFERENCES professor_course(id));

CREATE TABLE schedule_peer_eval (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
start_date DATE, end_date DATE, group_id INT UNSIGNED NOT NULL,  FOREIGN KEY (group_id) REFERENCES student_group(id));

CREATE TABLE student_criterion_score (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, criterion_id INT UNSIGNED NOT NULL, FOREIGN KEY (criterion_id) REFERENCES criterion(id),
score TINYINT, student_id INT unsigned, FOREIGN KEY (student_id) REFERENCES student(id), student_receiving_id INT unsigned, FOREIGN KEY (student_receiving_id) REFERENCES student(id), 
peerEval_id INT unsigned, FOREIGN KEY (peerEval_id) REFERENCES schedule_peer_eval(id));

CREATE TABLE additional_comments (student_id INT unsigned, FOREIGN KEY (student_id) REFERENCES student(id), peerEval_id INT unsigned, FOREIGN KEY (peerEval_id) REFERENCES schedule_peer_eval(id), 
student_receiving_id INT unsigned, FOREIGN KEY (student_receiving_id) REFERENCES student(id),
additional_comments TEXT);
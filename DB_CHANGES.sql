CREATE TABLE `subjects` (
  `subject_id` INTEGER NOT NULL AUTO_INCREMENT,
  `subject_name` VARCHAR(100) NOT NULL,
  `subject_status` VARCHAR(10) NOT NULL DEFAULT 'Active',
  `last_updated_by` INTEGER NOT NULL,
  `last_updated_on` DATE,
  PRIMARY KEY (`subject_id`)
)
ENGINE = InnoDB;
ALTER TABLE `subjects` ADD `subject_code` VARCHAR(100) NULL DEFAULT NULL AFTER `subject_name`; 

CREATE TABLE `exam_details` (
  `exam_id` INTEGER NOT NULL AUTO_INCREMENT,
  `exam_title` VARCHAR(150) NOT NULL,
  `exam_code` VARCHAR(100) NOT NULL,
  `exam_date` DATE,
  `exam_start_time` VARCHAR(50),
  `exam_end_time` VARCHAR(50),
  `exam_duration` INTEGER,
  `last_updated_on` DATETIME,
  `last_updated_by` INTEGER,
  PRIMARY KEY (`exam_id`)
)
ENGINE = InnoDB;


CREATE TABLE `question_paper_details` (
  `qpd_id` INTEGER NOT NULL AUTO_INCREMENT,
  `subject_id` INTEGER NOT NULL,
  `sub_subject_id` INTEGER,
  `exam_id` INTEGER NOT NULL,
  `no_of_questions` INTEGER NOT NULL DEFAULT 0,
  `exam_duration` INTEGER NOT NULL,
  `created_by` INTEGER,
  `created_on` DATETIME,
  `last_updated_by` INTEGER,
  `last_updated_on` DATETIME,
  PRIMARY KEY (`qpd_id`)
)
ENGINE = InnoDB;


CREATE TABLE `questions_list` (
  `question_id` INTEGER NOT NULL AUTO_INCREMENT,
  `qpd_id` INTEGER NOT NULL,
  `question_text` TINYTEXT,
  `no_of_choices` INTEGER NOT NULL DEFAULT 4,
  `last_updated_on` DATETIME,
  PRIMARY KEY (`question_id`)
)
ENGINE = InnoDB;

CREATE TABLE `choices_list` (
  `choice_id` INTEGER NOT NULL AUTO_INCREMENT,
  `choice_desc` VARCHAR(250),
  `question_id` INTEGER,
  `last_updated_on` DATETIME,
  PRIMARY KEY (`choice_id`)
)
ENGINE = InnoDB;

CREATE TABLE `answer_table` (
  `answer_id` INTEGER NOT NULL AUTO_INCREMENT,
  `choice_id` INTEGER NOT NULL,
  `question_id` INTEGER NOT NULL,
  `last_updated_on` DATETIME,
  PRIMARY KEY (`answer_id`)
)
ENGINE = InnoDB;



INSERT INTO `perm_master` (`perm_id`, `perm_code`, `perm_desc`, `perm_order`, `perm_label`, `perm_parent`, `perm_class`, `perm_url`, `perm_status`, `perm_attr`, `perm_icon`, `last_updated_id`, `last_updated_date`)
 VALUES (NULL, 'SUBJECTS_LIST', 'Subjects list', '4', '4', '2', NULL, 'subjects-list', 'Active', NULL, NULL, NULL, current_timestamp()); 
 
INSERT INTO `role_perm` (`role_perm_id`, `role_id`, `perm_id`, `status`, `last_updated_id`, `last_updated_date`, `access_perm`) 
VALUES (NULL, '1', '5', 'Active', '1', current_timestamp(), '1'); 
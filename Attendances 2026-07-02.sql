-- ==========================================
-- PSA Explorer Attendance Backup
-- Generated: 2026-07-02 11:17:06
-- ==========================================

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `attendances`;

CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `attendance_date` date NOT NULL,
  `time_in` timestamp NULL DEFAULT NULL,
  `time_out` timestamp NULL DEFAULT NULL,
  `total_hours` decimal(5,2) NOT NULL DEFAULT 0.00,
  `overtime_hours` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status` enum('Pending','Present','Absent','Late','Half Day - VL','Half Day - SL','Vacation Leave','Sick Leave','Regular Holiday','Special Non-Working Holiday') NOT NULL DEFAULT 'Pending',
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attendances_employee_id_attendance_date_unique` (`employee_id`,`attendance_date`),
  CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (1,1,'2026-06-01 00:00:00','2026-06-01 09:00:00','2026-06-01 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (2,2,'2026-06-01 00:00:00','2026-06-01 09:00:00','2026-06-01 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (3,3,'2026-06-01 00:00:00','2026-06-01 09:00:00','2026-06-01 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (4,4,'2026-06-01 00:00:00','2026-06-01 09:00:00','2026-06-01 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (5,5,'2026-06-01 00:00:00','2026-06-01 09:00:00','2026-06-02 00:00:00',15.00,7.00,'Regular Holiday','','2026-06-10 10:08:55','2026-06-10 10:09:28');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (6,6,'2026-06-01 00:00:00','2026-06-01 09:00:00','2026-06-01 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (7,1,'2026-06-02 00:00:00','2026-06-02 09:00:00','2026-06-02 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (8,2,'2026-06-02 00:00:00','2026-06-02 09:00:00','2026-06-02 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (9,3,'2026-06-02 00:00:00','2026-06-02 09:00:00','2026-06-02 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (10,4,'2026-06-02 00:00:00','2026-06-02 09:00:00','2026-06-02 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (11,5,'2026-06-02 00:00:00','2026-06-02 09:00:00','2026-06-02 23:00:00',14.00,6.00,'Present','','2026-06-10 10:08:55','2026-06-10 10:09:35');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (12,6,'2026-06-02 00:00:00','2026-06-02 09:00:00','2026-06-02 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (13,1,'2026-06-03 00:00:00','2026-06-03 09:00:00','2026-06-03 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (14,2,'2026-06-03 00:00:00','2026-06-03 09:00:00','2026-06-03 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (15,3,'2026-06-03 00:00:00','2026-06-03 09:00:00','2026-06-03 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (16,4,'2026-06-03 00:00:00','2026-06-03 09:00:00','2026-06-03 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (17,5,'2026-06-03 00:00:00','2026-06-03 09:00:00','2026-06-03 22:30:00',13.50,5.50,'Special Non-Working Holiday','','2026-06-10 10:08:55','2026-06-10 10:09:47');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (18,6,'2026-06-03 00:00:00','2026-06-03 09:00:00','2026-06-03 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (19,1,'2026-06-04 00:00:00','2026-06-04 09:00:00','2026-06-04 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (20,2,'2026-06-04 00:00:00','2026-06-04 09:00:00','2026-06-04 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (21,3,'2026-06-04 00:00:00','2026-06-04 09:00:00','2026-06-04 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (22,4,'2026-06-04 00:00:00','2026-06-04 09:00:00','2026-06-04 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (23,5,'2026-06-04 00:00:00','2026-06-04 09:00:00','2026-06-04 17:00:00',8.00,0.00,'Vacation Leave','','2026-06-10 10:08:55','2026-06-10 10:10:52');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (24,6,'2026-06-04 00:00:00','2026-06-04 09:00:00','2026-06-04 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (25,1,'2026-06-05 00:00:00','2026-06-05 09:00:00','2026-06-05 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (26,2,'2026-06-05 00:00:00','2026-06-05 09:00:00','2026-06-05 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (27,3,'2026-06-05 00:00:00','2026-06-05 09:00:00','2026-06-05 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (28,4,'2026-06-05 00:00:00','2026-06-05 09:00:00','2026-06-05 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (29,5,'2026-06-05 00:00:00','2026-06-05 09:00:00','2026-06-05 17:00:00',8.00,0.00,'Sick Leave','','2026-06-10 10:08:55','2026-06-10 10:10:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (30,6,'2026-06-05 00:00:00','2026-06-05 09:00:00','2026-06-05 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (31,1,'2026-06-08 00:00:00','2026-06-08 09:00:00','2026-06-08 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (32,2,'2026-06-08 00:00:00','2026-06-08 09:00:00','2026-06-08 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (33,3,'2026-06-08 00:00:00','2026-06-08 09:00:00','2026-06-08 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (34,4,'2026-06-08 00:00:00','2026-06-08 09:00:00','2026-06-08 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (35,5,'2026-06-08 00:00:00','2026-06-08 09:00:00','2026-06-08 17:00:00',8.00,0.00,'Vacation Leave','','2026-06-10 10:08:55','2026-06-10 10:11:01');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (36,6,'2026-06-08 00:00:00','2026-06-08 09:00:00','2026-06-08 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (37,1,'2026-06-09 00:00:00','2026-06-09 09:00:00','2026-06-09 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (38,2,'2026-06-09 00:00:00','2026-06-09 09:00:00','2026-06-09 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (39,3,'2026-06-09 00:00:00','2026-06-09 09:00:00','2026-06-09 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (40,4,'2026-06-09 00:00:00','2026-06-09 09:00:00','2026-06-09 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (41,5,'2026-06-09 00:00:00','2026-06-09 09:00:00','2026-06-09 17:00:00',8.00,0.00,'Half Day - VL','','2026-06-10 10:08:55','2026-06-10 10:21:32');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (42,6,'2026-06-09 00:00:00','2026-06-09 09:00:00','2026-06-09 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (49,1,'2026-06-11 00:00:00','2026-06-11 09:00:00','2026-06-11 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (50,2,'2026-06-11 00:00:00','2026-06-11 09:00:00','2026-06-11 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (51,3,'2026-06-11 00:00:00','2026-06-11 09:00:00','2026-06-11 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (52,4,'2026-06-11 00:00:00','2026-06-11 09:00:00','2026-06-11 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (53,5,'2026-06-11 00:00:00','2026-06-11 09:00:00','2026-06-11 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (54,6,'2026-06-11 00:00:00','2026-06-11 09:00:00','2026-06-11 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (55,1,'2026-06-12 00:00:00','2026-06-12 09:00:00','2026-06-12 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (56,2,'2026-06-12 00:00:00','2026-06-12 09:00:00','2026-06-12 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (57,3,'2026-06-12 00:00:00','2026-06-12 09:00:00','2026-06-12 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (58,4,'2026-06-12 00:00:00','2026-06-12 09:00:00','2026-06-12 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (59,5,'2026-06-12 00:00:00','2026-06-12 09:00:00','2026-06-12 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (60,6,'2026-06-12 00:00:00','2026-06-12 09:00:00','2026-06-12 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (61,1,'2026-06-15 00:00:00','2026-06-15 09:00:00','2026-06-15 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (62,2,'2026-06-15 00:00:00','2026-06-15 09:00:00','2026-06-15 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (63,3,'2026-06-15 00:00:00','2026-06-15 09:00:00','2026-06-15 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (64,4,'2026-06-15 00:00:00','2026-06-15 09:00:00','2026-06-15 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (65,5,'2026-06-15 00:00:00','2026-06-15 09:00:00','2026-06-15 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (66,6,'2026-06-15 00:00:00','2026-06-15 09:00:00','2026-06-15 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (67,1,'2026-06-16 00:00:00','2026-06-16 09:00:00','2026-06-16 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (68,2,'2026-06-16 00:00:00','2026-06-16 09:00:00','2026-06-16 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (69,3,'2026-06-16 00:00:00','2026-06-16 09:00:00','2026-06-16 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (70,4,'2026-06-16 00:00:00','2026-06-16 09:00:00','2026-06-16 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (71,5,'2026-06-16 00:00:00','2026-06-16 09:00:00','2026-06-16 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (72,6,'2026-06-16 00:00:00','2026-06-16 09:00:00','2026-06-16 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (73,1,'2026-06-17 00:00:00','2026-06-17 09:00:00','2026-06-17 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (74,2,'2026-06-17 00:00:00','2026-06-17 09:00:00','2026-06-17 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (75,3,'2026-06-17 00:00:00','2026-06-17 09:00:00','2026-06-17 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (76,4,'2026-06-17 00:00:00','2026-06-17 09:00:00','2026-06-17 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (77,5,'2026-06-17 00:00:00','2026-06-17 09:00:00','2026-06-17 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (78,6,'2026-06-17 00:00:00','2026-06-17 09:00:00','2026-06-17 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (79,1,'2026-06-18 00:00:00','2026-06-18 09:00:00','2026-06-18 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (80,2,'2026-06-18 00:00:00','2026-06-18 09:00:00','2026-06-18 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (81,3,'2026-06-18 00:00:00','2026-06-18 09:00:00','2026-06-18 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (82,4,'2026-06-18 00:00:00','2026-06-18 09:00:00','2026-06-18 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (83,5,'2026-06-18 00:00:00','2026-06-18 09:00:00','2026-06-18 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (84,6,'2026-06-18 00:00:00','2026-06-18 09:00:00','2026-06-18 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (85,1,'2026-06-19 00:00:00','2026-06-19 09:00:00','2026-06-19 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (86,2,'2026-06-19 00:00:00','2026-06-19 09:00:00','2026-06-19 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (87,3,'2026-06-19 00:00:00','2026-06-19 09:00:00','2026-06-19 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (88,4,'2026-06-19 00:00:00','2026-06-19 09:00:00','2026-06-19 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (89,5,'2026-06-19 00:00:00','2026-06-19 09:00:00','2026-06-19 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (90,6,'2026-06-19 00:00:00','2026-06-19 09:00:00','2026-06-19 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (91,1,'2026-06-22 00:00:00','2026-06-22 09:00:00','2026-06-22 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (92,2,'2026-06-22 00:00:00','2026-06-22 09:00:00','2026-06-22 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (93,3,'2026-06-22 00:00:00','2026-06-22 09:00:00','2026-06-22 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (94,4,'2026-06-22 00:00:00','2026-06-22 09:00:00','2026-06-22 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (95,5,'2026-06-22 00:00:00','2026-06-22 09:00:00','2026-06-22 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (96,6,'2026-06-22 00:00:00','2026-06-22 09:00:00','2026-06-22 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (97,1,'2026-06-23 00:00:00','2026-06-23 09:00:00','2026-06-23 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (98,2,'2026-06-23 00:00:00','2026-06-23 09:00:00','2026-06-23 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (99,3,'2026-06-23 00:00:00','2026-06-23 09:00:00','2026-06-23 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (100,4,'2026-06-23 00:00:00','2026-06-23 09:00:00','2026-06-23 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (101,5,'2026-06-23 00:00:00','2026-06-23 09:00:00','2026-06-23 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (102,6,'2026-06-23 00:00:00','2026-06-23 09:00:00','2026-06-23 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (103,1,'2026-06-24 00:00:00','2026-06-24 09:00:00','2026-06-24 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (104,2,'2026-06-24 00:00:00','2026-06-24 09:00:00','2026-06-24 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (105,3,'2026-06-24 00:00:00','2026-06-24 09:00:00','2026-06-24 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (106,4,'2026-06-24 00:00:00','2026-06-24 09:00:00','2026-06-24 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (107,5,'2026-06-24 00:00:00','2026-06-24 09:00:00','2026-06-24 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (108,6,'2026-06-24 00:00:00','2026-06-24 09:00:00','2026-06-24 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (109,1,'2026-06-25 00:00:00','2026-06-25 09:00:00','2026-06-25 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (110,2,'2026-06-25 00:00:00','2026-06-25 09:00:00','2026-06-25 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (111,3,'2026-06-25 00:00:00','2026-06-25 09:00:00','2026-06-25 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (112,4,'2026-06-25 00:00:00','2026-06-25 09:00:00','2026-06-25 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (113,5,'2026-06-25 00:00:00','2026-06-25 09:00:00','2026-06-25 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (114,6,'2026-06-25 00:00:00','2026-06-25 09:00:00','2026-06-25 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (115,1,'2026-06-26 00:00:00','2026-06-26 09:00:00','2026-06-26 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (116,2,'2026-06-26 00:00:00','2026-06-26 09:00:00','2026-06-26 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (117,3,'2026-06-26 00:00:00','2026-06-26 09:00:00','2026-06-26 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (118,4,'2026-06-26 00:00:00','2026-06-26 09:00:00','2026-06-26 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (119,5,'2026-06-26 00:00:00','2026-06-26 09:00:00','2026-06-26 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (120,6,'2026-06-26 00:00:00','2026-06-26 09:00:00','2026-06-26 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (121,1,'2026-06-29 00:00:00','2026-06-29 09:00:00','2026-06-29 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (122,2,'2026-06-29 00:00:00','2026-06-29 09:00:00','2026-06-29 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (123,3,'2026-06-29 00:00:00','2026-06-29 09:00:00','2026-06-29 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (124,4,'2026-06-29 00:00:00','2026-06-29 09:00:00','2026-06-29 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (125,5,'2026-06-29 00:00:00','2026-06-29 09:00:00','2026-06-29 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (126,6,'2026-06-29 00:00:00','2026-06-29 09:00:00','2026-06-29 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (127,1,'2026-06-30 00:00:00','2026-06-30 09:00:00','2026-06-30 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (128,2,'2026-06-30 00:00:00','2026-06-30 09:00:00','2026-06-30 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (129,3,'2026-06-30 00:00:00','2026-06-30 09:00:00','2026-06-30 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (130,4,'2026-06-30 00:00:00','2026-06-30 09:00:00','2026-06-30 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (131,5,'2026-06-30 00:00:00','2026-06-30 09:00:00','2026-06-30 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (132,6,'2026-06-30 00:00:00','2026-06-30 09:00:00','2026-06-30 17:00:00',8.00,0.00,'Present',NULL,'2026-06-10 10:08:55','2026-06-10 10:08:55');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (133,1,'2026-06-10 00:00:00','2026-06-10 11:37:16','2026-06-10 11:37:44',0.01,0.00,'Present',NULL,'2026-06-10 11:37:07','2026-06-10 11:37:44');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (134,2,'2026-06-10 00:00:00','2026-06-10 11:37:21','2026-06-10 11:37:25',0.00,0.00,'Present',NULL,'2026-06-10 11:37:07','2026-06-10 11:37:25');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (135,3,'2026-06-10 00:00:00',NULL,NULL,0.00,0.00,'Pending',NULL,'2026-06-10 11:37:07','2026-06-10 11:37:07');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (136,4,'2026-06-10 00:00:00',NULL,NULL,0.00,0.00,'Pending',NULL,'2026-06-10 11:37:07','2026-06-10 11:37:07');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (137,5,'2026-06-10 00:00:00',NULL,NULL,0.00,0.00,'Pending',NULL,'2026-06-10 11:37:07','2026-06-10 11:37:07');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (138,6,'2026-06-10 00:00:00',NULL,NULL,0.00,0.00,'Pending',NULL,'2026-06-10 11:37:07','2026-06-10 11:37:07');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (139,1,'2026-07-01 00:00:00',NULL,NULL,0.00,0.00,'Sick Leave','LBM','2026-07-01 09:50:28','2026-07-01 14:10:22');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (140,2,'2026-07-01 00:00:00','2026-07-01 08:42:00','2026-07-01 19:07:00',10.42,2.42,'Present','','2026-07-01 09:50:28','2026-07-02 10:48:42');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (141,3,'2026-07-01 00:00:00','2026-07-01 08:38:00','2026-07-01 17:04:00',8.43,0.00,'Present','','2026-07-01 09:50:28','2026-07-02 10:48:36');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (142,4,'2026-07-01 00:00:00','2026-07-01 08:43:00','2026-07-01 18:50:00',10.12,2.12,'Present','','2026-07-01 09:50:28','2026-07-02 10:48:31');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (143,5,'2026-07-01 00:00:00','2026-07-01 08:38:00','2026-07-01 17:11:00',8.55,0.00,'Present','','2026-07-01 09:50:28','2026-07-02 10:48:26');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (144,6,'2026-07-01 00:00:00','2026-07-01 08:38:00','2026-07-01 17:03:00',8.42,0.00,'Present','','2026-07-01 09:50:28','2026-07-02 10:48:21');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (145,9,'2026-07-01 00:00:00','2026-07-01 08:35:00','2026-07-01 17:06:00',8.52,0.00,'Present','',NULL,'2026-07-02 10:48:09');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (146,10,'-0001-11-30 00:00:00',NULL,NULL,0.00,0.00,'Pending',NULL,'2026-07-01 14:00:51','2026-07-01 14:00:51');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (147,10,'2026-07-01 00:00:00','2026-07-01 08:45:00','2026-07-01 17:06:00',8.35,0.00,'Present','',NULL,'2026-07-02 10:48:15');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (148,5,'2026-07-02 00:00:00','2026-07-02 08:30:00',NULL,0.00,0.00,'Present',NULL,'2026-07-02 08:30:00','2026-07-02 08:30:00');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (149,3,'2026-07-02 00:00:00','2026-07-02 08:33:47',NULL,0.00,0.00,'Present',NULL,'2026-07-02 08:33:47','2026-07-02 08:33:47');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (150,10,'2026-07-02 00:00:00','2026-07-02 08:44:19',NULL,0.00,0.00,'Present',NULL,'2026-07-02 08:44:19','2026-07-02 08:44:19');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (151,6,'2026-07-02 00:00:00','2026-07-02 08:51:11',NULL,0.00,0.00,'Present',NULL,'2026-07-02 08:51:11','2026-07-02 08:51:11');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (152,1,'2026-07-02 00:00:00','2026-07-02 08:06:00',NULL,0.00,0.00,'Present','','2026-07-02 08:51:50','2026-07-02 10:47:48');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (153,2,'2026-07-02 00:00:00','2026-07-02 08:53:03',NULL,0.00,0.00,'Present',NULL,'2026-07-02 08:51:50','2026-07-02 08:53:03');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (154,4,'2026-07-02 00:00:00','2026-07-02 08:53:13',NULL,0.00,0.00,'Present',NULL,'2026-07-02 08:51:50','2026-07-02 08:53:13');

INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (155,9,'2026-07-02 00:00:00','2026-07-02 08:16:00',NULL,0.00,0.00,'Present','','2026-07-02 08:51:50','2026-07-02 10:48:02');


SET FOREIGN_KEY_CHECKS=1;

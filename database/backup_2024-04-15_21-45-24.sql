DROP TABLE IF EXISTS blotter;

CREATE TABLE `blotter` (
  `blotter_Id` int(11) NOT NULL AUTO_INCREMENT,
  `added_by` int(11) NOT NULL,
  `c_firstname` varchar(50) DEFAULT NULL,
  `c_middlename` varchar(50) DEFAULT NULL,
  `c_lastname` varchar(50) DEFAULT NULL,
  `c_suffix` varchar(10) DEFAULT NULL,
  `c_contact` varchar(15) DEFAULT NULL,
  `c_address` varchar(255) DEFAULT NULL,
  `incidentDate` date DEFAULT NULL,
  `incidentTime` time DEFAULT NULL,
  `incidentNature` varchar(100) DEFAULT NULL,
  `incidentAddress` varchar(255) DEFAULT NULL,
  `acc_firstname` varchar(50) DEFAULT NULL,
  `acc_middlename` varchar(50) DEFAULT NULL,
  `acc_lastname` varchar(50) DEFAULT NULL,
  `acc_suffix` varchar(10) DEFAULT NULL,
  `acc_address` varchar(255) DEFAULT NULL,
  `witnesses` text DEFAULT NULL,
  `incidentDescription` text DEFAULT NULL,
  `actionTaken` text DEFAULT NULL,
  `attachments` varchar(255) DEFAULT NULL,
  `blotter_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Open, 1=Closed, 2=Under Investigation',
  `is_read` int(11) NOT NULL DEFAULT 0 COMMENT '0=False, 1=True',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`blotter_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




DROP TABLE IF EXISTS complaint;

CREATE TABLE `complaint` (
  `complaint_ID` int(11) NOT NULL AUTO_INCREMENT,
  `added_by` int(11) NOT NULL,
  `complaint_nature` varchar(255) NOT NULL,
  `incident_location` varchar(255) NOT NULL,
  `date_happened` date NOT NULL,
  `time_happened` varchar(50) NOT NULL,
  `witness` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `attachments` varchar(255) NOT NULL,
  `preferred_solution` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Verified, 2=Rejected, 3=Solved',
  `date_confirmed` datetime NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0 COMMENT '0=False, 1=True',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`complaint_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS log_history;

CREATE TABLE `log_history` (
  `log_Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_Id` int(11) NOT NULL,
  `login_datetime` datetime NOT NULL,
  `logout_datetime` datetime NOT NULL,
  `logout_remarks` int(11) NOT NULL DEFAULT 0 COMMENT '0=Logged out successfully, 1=Unable to logout last login',
  PRIMARY KEY (`log_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO log_history VALUES("131","66","2024-02-28 20:39:21","2024-02-28 20:42:29","0");
INSERT INTO log_history VALUES("132","66","2024-03-11 22:35:34","2024-03-11 23:20:38","0");
INSERT INTO log_history VALUES("133","66","2024-03-11 23:20:45","2024-03-11 23:54:24","0");
INSERT INTO log_history VALUES("134","66","2024-03-11 23:54:34","2024-03-12 00:04:37","0");
INSERT INTO log_history VALUES("135","66","2024-03-12 01:27:01","2024-03-12 01:37:02","1");
INSERT INTO log_history VALUES("136","66","2024-03-12 01:28:08","0000-00-00 00:00:00","1");
INSERT INTO log_history VALUES("137","66","2024-03-12 01:34:03","2024-03-12 01:34:21","0");
INSERT INTO log_history VALUES("138","66","2024-03-12 01:50:54","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("139","66","2024-03-12 01:54:29","2024-03-12 01:54:49","0");
INSERT INTO log_history VALUES("140","66","2024-03-12 01:59:44","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("141","66","2024-03-12 02:01:05","2024-03-12 02:01:14","0");
INSERT INTO log_history VALUES("142","66","2024-03-12 02:03:17","2024-03-12 02:03:34","0");
INSERT INTO log_history VALUES("143","66","2024-03-12 02:03:39","2024-03-12 02:13:58","0");
INSERT INTO log_history VALUES("144","66","2024-03-12 02:04:04","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("145","90","2024-03-12 03:32:04","2024-03-12 03:58:22","0");
INSERT INTO log_history VALUES("146","90","2024-03-12 03:51:05","0000-00-00 00:00:00","1");
INSERT INTO log_history VALUES("147","90","2024-03-12 03:58:42","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("148","90","2024-03-12 17:09:54","2024-03-12 17:11:32","0");
INSERT INTO log_history VALUES("149","66","2024-03-12 17:12:58","2024-03-12 17:28:56","0");
INSERT INTO log_history VALUES("150","66","2024-03-12 17:32:37","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("151","66","2024-03-12 17:54:58","2024-03-12 19:17:56","0");
INSERT INTO log_history VALUES("152","66","2024-03-12 19:27:22","2024-03-12 19:41:46","0");
INSERT INTO log_history VALUES("153","66","2024-03-12 19:42:37","2024-03-12 20:54:56","0");
INSERT INTO log_history VALUES("154","96","2024-03-14 20:26:59","2024-03-14 20:27:15","0");
INSERT INTO log_history VALUES("155","96","2024-03-14 20:27:29","2024-03-14 20:29:39","0");
INSERT INTO log_history VALUES("156","66","2024-03-14 20:30:01","2024-03-14 20:31:50","0");
INSERT INTO log_history VALUES("157","66","2024-03-14 20:33:01","2024-03-14 20:42:19","0");
INSERT INTO log_history VALUES("158","66","2024-03-14 20:46:05","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("159","66","2024-03-21 21:34:58","2024-03-21 21:47:54","0");
INSERT INTO log_history VALUES("160","90","2024-03-21 21:48:29","2024-03-21 21:49:57","0");
INSERT INTO log_history VALUES("161","66","2024-03-21 21:54:06","2024-03-21 22:00:20","0");
INSERT INTO log_history VALUES("162","90","2024-03-21 22:00:25","2024-03-21 22:06:43","0");
INSERT INTO log_history VALUES("163","66","2024-03-21 22:06:48","2024-03-21 22:27:44","0");
INSERT INTO log_history VALUES("164","90","2024-03-21 22:27:50","2024-03-21 22:27:59","0");
INSERT INTO log_history VALUES("165","66","2024-03-21 22:28:05","2024-03-21 22:39:58","0");
INSERT INTO log_history VALUES("166","90","2024-03-21 22:40:05","2024-03-21 22:40:13","0");
INSERT INTO log_history VALUES("167","66","2024-03-21 22:40:17","2024-03-21 22:46:12","0");
INSERT INTO log_history VALUES("168","66","2024-03-21 22:59:06","2024-03-21 22:59:10","0");
INSERT INTO log_history VALUES("169","90","2024-03-21 22:59:44","2024-03-21 22:59:48","0");
INSERT INTO log_history VALUES("170","66","2024-03-21 23:04:17","2024-03-21 23:04:22","0");
INSERT INTO log_history VALUES("171","101","2024-03-21 23:50:16","2024-03-21 23:50:23","0");
INSERT INTO log_history VALUES("172","101","2024-03-21 23:52:08","0000-00-00 00:00:00","1");
INSERT INTO log_history VALUES("173","101","2024-03-21 23:53:36","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("174","66","2024-04-13 09:41:43","2024-04-13 09:42:46","0");
INSERT INTO log_history VALUES("175","102","2024-04-13 09:44:35","0000-00-00 00:00:00","1");
INSERT INTO log_history VALUES("176","66","2024-04-13 09:49:43","2024-04-13 09:53:03","0");
INSERT INTO log_history VALUES("177","103","2024-04-13 09:55:23","2024-04-13 09:56:13","0");
INSERT INTO log_history VALUES("178","103","2024-04-13 09:56:33","2024-04-13 09:56:37","0");
INSERT INTO log_history VALUES("179","66","2024-04-13 09:56:57","2024-04-13 10:08:31","0");
INSERT INTO log_history VALUES("180","66","2024-04-13 10:09:38","2024-04-13 10:22:03","0");
INSERT INTO log_history VALUES("181","66","2024-04-13 20:55:47","2024-04-13 21:55:00","0");
INSERT INTO log_history VALUES("182","66","2024-04-13 22:13:55","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("183","66","2024-04-14 11:39:08","2024-04-14 12:41:54","0");
INSERT INTO log_history VALUES("184","66","2024-04-14 15:14:22","2024-04-14 15:16:35","0");
INSERT INTO log_history VALUES("185","102","2024-04-14 15:16:57","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("186","102","2024-04-14 15:17:36","2024-04-14 15:19:29","0");
INSERT INTO log_history VALUES("187","66","2024-04-14 15:19:46","2024-04-14 16:16:21","0");
INSERT INTO log_history VALUES("188","102","2024-04-14 16:17:13","2024-04-14 16:17:55","0");
INSERT INTO log_history VALUES("189","66","2024-04-14 16:18:06","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("190","66","2024-04-14 18:33:17","2024-04-14 18:37:27","0");
INSERT INTO log_history VALUES("191","102","2024-04-14 18:37:48","2024-04-14 18:41:27","0");
INSERT INTO log_history VALUES("192","66","2024-04-14 18:41:38","2024-04-14 18:44:10","0");
INSERT INTO log_history VALUES("193","66","2024-04-14 18:44:26","2024-04-14 18:44:32","0");
INSERT INTO log_history VALUES("194","66","2024-04-14 18:44:26","2024-04-14 18:44:32","0");
INSERT INTO log_history VALUES("195","102","2024-04-14 18:44:51","2024-04-14 18:46:03","0");
INSERT INTO log_history VALUES("196","66","2024-04-14 18:46:14","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("197","106","2024-04-14 21:22:34","0000-00-00 00:00:00","1");
INSERT INTO log_history VALUES("198","102","2024-04-14 21:23:18","2024-04-14 21:23:39","0");
INSERT INTO log_history VALUES("199","103","2024-04-14 21:24:28","2024-04-14 22:24:24","0");
INSERT INTO log_history VALUES("200","106","2024-04-14 22:25:01","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("201","103","2024-04-14 22:25:10","2024-04-14 22:26:11","0");
INSERT INTO log_history VALUES("202","103","2024-04-14 22:27:01","2024-04-14 22:29:32","0");
INSERT INTO log_history VALUES("203","106","2024-04-14 22:29:47","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("204","106","2024-04-14 22:30:06","2024-04-14 22:30:21","0");
INSERT INTO log_history VALUES("205","106","2024-04-14 22:30:30","2024-04-14 22:30:54","0");
INSERT INTO log_history VALUES("206","103","2024-04-14 22:31:03","2024-04-14 22:33:37","0");
INSERT INTO log_history VALUES("207","106","2024-04-14 22:33:49","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("208","106","2024-04-15 18:01:36","2024-04-15 18:02:21","0");
INSERT INTO log_history VALUES("209","106","2024-04-15 18:02:34","2024-04-15 18:02:37","0");
INSERT INTO log_history VALUES("210","106","2024-04-15 18:02:55","2024-04-15 18:02:58","0");
INSERT INTO log_history VALUES("211","106","2024-04-15 18:03:06","2024-04-15 18:03:24","0");
INSERT INTO log_history VALUES("212","66","2024-04-15 18:03:35","2024-04-15 18:03:57","0");
INSERT INTO log_history VALUES("213","106","2024-04-15 18:04:08","2024-04-15 19:40:01","0");
INSERT INTO log_history VALUES("214","66","2024-04-15 19:40:10","2024-04-15 20:19:09","0");
INSERT INTO log_history VALUES("215","106","2024-04-15 20:19:34","2024-04-15 20:22:14","0");
INSERT INTO log_history VALUES("216","106","2024-04-15 20:22:22","2024-04-15 20:22:25","0");
INSERT INTO log_history VALUES("217","66","2024-04-15 20:22:34","2024-04-15 20:24:33","0");
INSERT INTO log_history VALUES("218","66","2024-04-15 21:30:20","2024-04-15 21:32:42","0");
INSERT INTO log_history VALUES("219","66","2024-04-15 21:33:29","2024-04-15 21:34:25","0");
INSERT INTO log_history VALUES("220","66","2024-04-15 21:33:29","2024-04-15 21:34:25","0");
INSERT INTO log_history VALUES("221","106","2024-04-15 21:34:41","2024-04-15 21:39:01","0");
INSERT INTO log_history VALUES("222","66","2024-04-15 21:39:08","0000-00-00 00:00:00","0");
INSERT INTO log_history VALUES("223","66","2024-04-15 21:39:08","0000-00-00 00:00:00","0");



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `user_Id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `suffix` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT 'User',
  `verification_code` int(11) DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Verified',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users VALUES("66","AdminKoss","AdminKos","AdminKoss","AdminKos","1979-02-28","45","Male","admin@gmail.com","9297966745","AdminKo","4.jpg","0192023a7bbd73250516f069df18b500","Admin","","1","2022-11-25 00:00:00");
INSERT INTO users VALUES("106","Kent","Certiza","Cortiguerra","","2001-11-11","22","Male","","9297966746","81 Labak","user.png","0192023a7bbd73250516f069df18b500","User","","1","2024-04-14 19:28:17");




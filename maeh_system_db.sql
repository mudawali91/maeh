-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `logins`;
CREATE TABLE `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'FK from users',
  `login_type_id` int(11) NOT NULL DEFAULT '1' COMMENT '1: Web Portal, 2: Google Account ',
  `user_name` varchar(300) NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `login_now` int(11) NOT NULL DEFAULT '0' COMMENT '0: No, 1: Yes',
  `first_login` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember` int(11) NOT NULL COMMENT '0: No, 1: Yes',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1: Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `logins` (`id`, `user_id`, `login_type_id`, `user_name`, `user_password`, `login_now`, `first_login`, `last_login`, `remember`, `created`, `updated`, `active`) VALUES
(1,	1,	1,	'superadmin',	'NEdiUWJ4azJXNmk2TVNTODhEakhydz09',	0,	'2020-08-20 16:13:39',	'2020-08-20 16:13:39',	0,	'2020-03-03 15:54:19',	'2020-08-20 16:13:40',	1),
(2,	1,	2,	'mudastar@gmail.com',	'NEdiUWJ4azJXNmk2TVNTODhEakhydz09',	0,	NULL,	NULL,	0,	'2020-03-03 15:55:30',	'2020-03-03 15:55:30',	1),
(3,	2,	1,	'admin',	'NEdiUWJ4azJXNmk2TVNTODhEakhydz09',	1,	'2020-08-20 16:06:21',	'2020-10-10 10:23:08',	0,	'2020-03-03 15:54:19',	'2020-10-10 10:23:08',	1);

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL DEFAULT '0' COMMENT 'FK from registrations',
  `name` varchar(300) NOT NULL,
  `icno` varchar(100) NOT NULL,
  `contactno_mobile` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `contactno_home` varchar(100) NOT NULL,
  `home_address` text NOT NULL,
  `home_postcode` varchar(100) NOT NULL,
  `home_city` varchar(200) NOT NULL,
  `home_state` varchar(300) NOT NULL,
  `job_position` varchar(200) NOT NULL,
  `contactno_office` varchar(100) NOT NULL,
  `office_address` text NOT NULL,
  `office_postcode` varchar(100) NOT NULL,
  `office_city` varchar(200) NOT NULL,
  `office_state` varchar(300) NOT NULL,
  `member_status` int(11) DEFAULT NULL COMMENT '1: Active, 2: Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1:Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `members` (`id`, `registration_id`, `name`, `icno`, `contactno_mobile`, `email`, `dob`, `contactno_home`, `home_address`, `home_postcode`, `home_city`, `home_state`, `job_position`, `contactno_office`, `office_address`, `office_postcode`, `office_city`, `office_state`, `member_status`, `created`, `updated`, `active`) VALUES
(1,	1,	'MUDA WALI',	'910207-08-6789',	'+60175617709',	'mudastar@gmail.com',	'07/02/1991',	'',	'NO 130 RTBK PERLOP 3 LASAH',	'31100',	'SUNGAI SIPUT (U)',	'PERAK',	'PROGRAMMER',	'+6034665775',	'B-6-01, BLOCK B, 6TH FLOOR, BANGUNAN OASIS,\r\nJALAN PJU 1A/7A, ARA DAMANSARA,',	'47300',	'PETALING JAYA',	'SELANGOR',	1,	'2020-06-08 00:33:21',	'2020-06-08 00:37:13',	1),
(2,	2,	'MUDA WALI',	'222222-22-2222',	'',	'mudastar@gmail.com',	'07/02/1991',	'',	'NO 130 RTBK PERLOP 3 LASAH',	'31100',	'SUNGAI SIPUT (U)',	'PERAK',	'PROGRAMMER',	'+6034665775',	'B-6-01, BLOCK B, 6TH FLOOR, BANGUNAN OASIS,\r\nJALAN PJU 1A/7A, ARA DAMANSARA,',	'47300',	'PETALING JAYA',	'SELANGOR',	1,	'2020-06-08 00:38:10',	'2020-06-08 00:39:18',	1),
(3,	3,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	NULL,	'2020-06-08 14:36:40',	'2020-06-08 14:36:40',	0),
(4,	4,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	NULL,	'2020-06-08 14:40:01',	'2020-06-08 14:40:01',	0),
(5,	5,	'MUDA WALI',	'111111-11-1111',	'+60175617709',	'mudastar@gmail.com',	'',	'',	'NO 130 RTBK PERLOP 3 LASAH',	'31100',	'SUNGAI SIPUT (U)',	'PERAK',	'34545',	'+603453453453',	'B-6-01, BLOCK B, 6TH FLOOR, BANGUNAN OASIS,\r\nJALAN PJU 1A/7A, ARA DAMANSARA,',	'47301',	'BANGI',	'SELANGOR',	1,	'2020-06-08 14:59:49',	'2020-06-08 15:01:09',	1),
(6,	6,	'MUDA WALI',	'333333-33-3333',	'',	'mudastar@gmail.com',	'',	'',	'NO 130 RTBK PERLOP 3 LASAH',	'31100',	'SUNGAI SIPUT (U)',	'PERAK',	'34545',	'+603453453453',	'B-6-01, BLOCK B, 6TH FLOOR, BANGUNAN OASIS,\r\nJALAN PJU 1A/7A, ARA DAMANSARA,',	'47301',	'BANGI',	'SELANGOR',	NULL,	'2020-06-08 15:01:27',	'2020-06-08 15:01:29',	0),
(7,	7,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	NULL,	'2020-06-08 15:05:01',	'2020-06-08 15:05:01',	0),
(8,	8,	'MUDA WALI ABDULLAH',	'',	'+607175617709',	'mudastar_91@yahoo.com',	'',	'',	'B-6-01, BLOCK B, 6TH FLOOR, BANGUNAN OASIS,\r\nJALAN PJU 1A/7A, ARA DAMANSARA,',	'47301',	'BANGI',	'SELANGOR',	'',	'',	'',	'',	'',	'',	1,	'2020-06-13 14:09:17',	'2020-06-13 14:09:35',	1),
(9,	9,	'',	'234234-23-4324',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	NULL,	'2020-06-13 14:17:07',	'2020-06-13 14:17:09',	0),
(10,	10,	'MUDA',	'123123-12-3123',	'+604443232332',	'testclonne@lla.com',	'02/06/2020',	'+6012312312',	'NO 130 RTBK PERLOP 3 LASAH',	'31100',	'SUNGAI SIPUT (U)',	'PERAK',	'DSFSDF',	'+60234234',	'SDFSDF',	'234234',	'234234',	'MALACCA',	1,	'2020-06-13 16:04:58',	'2020-06-13 16:06:03',	1),
(11,	11,	'MUDA WALI ABDULLAH',	'123213-23-213',	'+60175617709',	'mudastar_91@yahoo.com',	'07/04/2020',	'+60324234234',	'B-6-01, BLOCK B, 6TH FLOOR, BANGUNAN OASIS,\r\nJALAN PJU 1A/7A, ARA DAMANSARA,',	'47301',	'PETALING JAYA',	'SELANGOR',	'SDFSDF',	'+60324234',	'DSFSSDFSDF',	'SDFSDF',	'SDFSDF',	'NEGERI SEMBILAN',	1,	'2020-06-13 16:07:40',	'2020-06-13 16:07:52',	1),
(12,	12,	'KKSAD',	'233243-24-3243',	'+600175617709',	'mudastar@gmail.com',	'',	'+60234234324',	'B-6-01, BLOCK B, 6TH FLOOR, BANGUNAN OASIS,\r\nJALAN PJU 1A/7A, ARA DAMANSARA,',	'47301',	'PETALING JAYA',	'SELANGOR',	'234234',	'+60234234',	'234234',	'324234',	'234234',	'PAHANG',	1,	'2020-07-18 23:02:53',	'2020-07-18 23:03:41',	1),
(13,	13,	'MASMDASD',	'213123-12-3123',	'+600175617709',	'mudastar@gmail.com',	'20/08/2020',	'+602312312312',	'B-6-01, BLOCK B, 6TH FLOOR, BANGUNAN OASIS,\r\nJALAN PJU 1A/7A, ARA DAMANSARA,',	'47301',	'PETALING JAYA',	'SELANGOR',	'123123',	'+60123123123',	'WDASDASD',	'123123',	'123123',	'MALACCA',	1,	'2020-08-20 15:15:31',	'2020-08-20 15:16:20',	1),
(14,	14,	'MUDA WALI ABDULLAH',	'123123-12-3445',	'+607175617709',	'mudastar_91@yahoo.com',	'',	'',	'B-6-01, BLOCK B, 6TH FLOOR, BANGUNAN OASIS,\r\nJALAN PJU 1A/7A, ARA DAMANSARA,',	'47301',	'BANGI',	'SELANGOR',	'SDFSDF',	'+6023423432',	'SDFSDFSDF',	'23423',	'23234',	'MALACCA',	1,	'2020-08-22 22:50:03',	'2020-08-22 22:50:42',	1),
(15,	15,	'FSDFSDF',	'234234-23-4324',	'+60234234',	'23dsfs@dfg.ds',	'18/08/2020',	'+6023432432',	'SDFSDF',	'',	'',	'',	'',	'',	'',	'',	'',	'',	NULL,	'2020-08-22 23:16:06',	'2020-08-22 23:16:06',	0);

DROP TABLE IF EXISTS `member_organizations`;
CREATE TABLE `member_organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT 'FK from members',
  `organization_name` varchar(300) NOT NULL,
  `organization_post` varchar(300) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1:Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `member_organizations` (`id`, `member_id`, `organization_name`, `organization_post`, `created`, `updated`, `active`) VALUES
(1,	1,	'PKP',	'AA',	'2020-06-08 00:37:13',	'2020-06-08 00:37:13',	1),
(2,	1,	'PKPB',	'BB',	'2020-06-08 00:37:13',	'2020-06-08 00:37:13',	1),
(3,	1,	'PKPD',	'CC',	'2020-06-08 00:37:13',	'2020-06-08 00:37:13',	1),
(4,	1,	'PKPP',	'DD',	'2020-06-08 00:37:13',	'2020-06-08 00:37:13',	1),
(5,	5,	'dfgdf',	'434',	'2020-06-08 15:01:09',	'2020-06-08 15:01:09',	1),
(6,	10,	'sdfsdfsd',	'sdds',	'2020-06-13 16:06:03',	'2020-06-13 16:06:03',	1),
(7,	10,	'fdsf',	'sds',	'2020-06-13 16:06:03',	'2020-06-13 16:06:03',	1),
(8,	12,	'324',	'33',	'2020-07-18 23:03:41',	'2020-07-18 23:03:41',	1),
(9,	12,	'23423',	'23',	'2020-07-18 23:03:41',	'2020-07-18 23:03:41',	1),
(10,	13,	'sdsdas',	'121212',	'2020-08-20 15:16:21',	'2020-08-20 15:16:21',	1),
(11,	14,	'werwer',	'ffsdf',	'2020-08-22 22:50:42',	'2020-08-22 22:50:42',	1);

DROP TABLE IF EXISTS `member_qualifications`;
CREATE TABLE `member_qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT 'FK from members',
  `qualification_category_id` int(11) NOT NULL DEFAULT '0' COMMENT 'FK from qualification_categories',
  `qualification_title` varchar(300) NOT NULL,
  `qualification_year` year(4) DEFAULT NULL,
  `qualification_institution` varchar(300) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1:Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `member_qualifications` (`id`, `member_id`, `qualification_category_id`, `qualification_title`, `qualification_year`, `qualification_institution`, `created`, `updated`, `active`) VALUES
(1,	1,	3,	'5A5B',	'2008',	'SMKASS',	'2020-06-08 00:37:13',	'2020-06-08 00:37:13',	1),
(2,	1,	4,	'DIPLOMA IN CS',	'2012',	'UITM PERAK',	'2020-06-08 00:37:13',	'2020-06-08 00:37:13',	1),
(3,	1,	5,	'bacheor in it',	'2014',	'UITM SHAH ALAM',	'2020-06-08 00:37:13',	'2020-06-08 00:37:13',	1),
(4,	1,	5,	'bachelor in data science',	'2016',	'UM ',	'2020-06-08 00:37:13',	'2020-06-08 00:37:13',	1),
(5,	5,	4,	'dfgdf',	'2020',	'dfgdfg',	'2020-06-08 15:01:09',	'2020-06-08 15:01:09',	1),
(6,	10,	4,	'232',	'2019',	'sdfsd',	'2020-06-13 16:06:03',	'2020-06-13 16:06:03',	1),
(7,	10,	3,	'sdsdf',	'2004',	'sdfsd',	'2020-06-13 16:06:03',	'2020-06-13 16:06:03',	1),
(8,	12,	5,	'334',	'2020',	'324234',	'2020-07-18 23:03:41',	'2020-07-18 23:03:41',	1),
(9,	13,	3,	'2123',	'2020',	'23123',	'2020-08-20 15:16:20',	'2020-08-20 15:16:20',	1),
(10,	14,	4,	'32324',	'1993',	'werwer',	'2020-08-22 22:50:42',	'2020-08-22 22:50:42',	1),
(11,	14,	5,	'23423',	'1999',	'rwer',	'2020-08-22 22:50:42',	'2020-08-22 22:50:42',	1);

DROP TABLE IF EXISTS `qualification_categories`;
CREATE TABLE `qualification_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1:Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `qualification_categories` (`id`, `name`, `created`, `updated`, `active`) VALUES
(1,	'UPSR',	'2020-04-04 21:51:51',	'2020-04-04 21:51:51',	1),
(2,	'PMR',	'2020-04-04 21:51:51',	'2020-04-04 21:51:51',	1),
(3,	'SPM',	'2020-04-04 21:51:51',	'2020-04-04 21:51:51',	1),
(4,	'DIPLOMA',	'2020-04-04 21:51:51',	'2020-04-04 21:51:51',	1),
(5,	'DEGREE',	'2020-04-04 21:51:51',	'2020-04-04 21:51:51',	1),
(6,	'MASTER',	'2020-04-04 21:51:51',	'2020-04-04 21:51:51',	1),
(7,	'PHD',	'2020-04-04 21:51:51',	'2020-04-04 21:51:51',	1);

DROP TABLE IF EXISTS `registrations`;
CREATE TABLE `registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT 'FK from members',
  `registration_agreement` int(11) DEFAULT NULL COMMENT '1: Yes',
  `registration_payment` int(11) DEFAULT NULL COMMENT '1: Yes',
  `payment_receipt` text NOT NULL COMMENT 'Attachment File',
  `payment_status` int(11) DEFAULT NULL COMMENT '1: Paid, 2:Unpaid',
  `registration_status` int(11) DEFAULT NULL COMMENT '1: Pending, 2: Approved, 3: Rejected, 4: Cancelled',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1:Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `registrations` (`id`, `member_id`, `registration_agreement`, `registration_payment`, `payment_receipt`, `payment_status`, `registration_status`, `created`, `updated`, `active`) VALUES
(1,	1,	1,	1,	'20200608003710_Admin_Icon2.png',	NULL,	NULL,	'2020-06-08 00:33:21',	'2020-06-08 00:37:13',	1),
(2,	2,	1,	1,	'20200608003914_as.jpg',	NULL,	NULL,	'2020-06-08 00:38:10',	'2020-06-08 00:39:18',	1),
(3,	3,	NULL,	NULL,	'',	NULL,	NULL,	'2020-06-08 14:36:40',	'2020-06-08 14:36:40',	0),
(4,	4,	NULL,	NULL,	'',	NULL,	NULL,	'2020-06-08 14:40:00',	'2020-06-08 14:40:01',	0),
(5,	5,	1,	1,	'20200608150107_sony-dvd-player-ultra-slim_right.jpg',	NULL,	NULL,	'2020-06-08 14:59:49',	'2020-06-08 15:01:09',	1),
(6,	6,	1,	1,	'20200608150120_sony-dvd-player-ultra-slim_right.jpg',	NULL,	NULL,	'2020-06-08 15:01:27',	'2020-06-08 15:01:29',	0),
(7,	7,	NULL,	NULL,	'',	NULL,	NULL,	'2020-06-08 15:05:01',	'2020-06-08 15:05:01',	0),
(8,	8,	NULL,	NULL,	'20200613140933_chipmore-25%.jpeg',	NULL,	1,	'2020-06-13 14:09:17',	'2020-06-13 14:09:35',	1),
(9,	9,	NULL,	NULL,	'',	NULL,	1,	'2020-06-13 14:17:07',	'2020-06-13 14:17:09',	0),
(10,	10,	1,	1,	'20200613160559_kisspng-check-mark-computer-icons-clip-art-green-tick-mark-5aab1c5116d0a0_2098334515211633450935.jpg',	NULL,	1,	'2020-06-13 16:04:58',	'2020-06-13 16:06:03',	1),
(11,	11,	NULL,	NULL,	'',	NULL,	1,	'2020-06-13 16:07:40',	'2020-06-13 16:07:52',	1),
(12,	12,	NULL,	NULL,	'20200718230336_personal_details.png',	NULL,	1,	'2020-07-18 23:02:53',	'2020-07-18 23:03:41',	1),
(13,	13,	1,	1,	'20200820151614_success.png',	NULL,	1,	'2020-08-20 15:15:31',	'2020-08-20 15:16:20',	1),
(14,	14,	1,	1,	'',	NULL,	1,	'2020-08-22 22:50:02',	'2020-08-22 22:50:42',	1),
(15,	15,	NULL,	NULL,	'',	NULL,	NULL,	'2020-08-22 23:16:06',	'2020-08-22 23:16:06',	0);

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1:Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `states` (`id`, `name`, `created`, `updated`, `active`) VALUES
(1,	'JOHOR',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(2,	'KEDAH',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(3,	'KELANTAN',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(4,	'MALACCA',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(5,	'NEGERI SEMBILAN',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(6,	'PAHANG',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(7,	'PENANG',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(8,	'PERAK',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(9,	'PERLIS',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(10,	'SABAH',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(11,	'SARAWAK',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(12,	'SELANGOR',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(13,	'TERENGGANU',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(14,	'W.P. KUALA LUMPUR',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(15,	'W.P. PUTRAJAYA',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(16,	'W.P. LABUAN',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1);

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  `bootstrap_class` varchar(100) NOT NULL,
  `color_code` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1: Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `status` (`id`, `status`, `bootstrap_class`, `color_code`, `created`, `updated`, `active`) VALUES
(1,	'Pending',	'warning',	'#ffa91c',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(2,	'Approved',	'success',	'#32c861',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(3,	'Rejected',	'danger',	'#f8515d',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1),
(4,	'Cancelled',	'primary',	'#4489e4',	'2020-04-04 08:00:00',	'2020-04-04 08:00:00',	1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL DEFAULT '0' COMMENT '1: Superadmin, 2: Admin',
  `full_name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `mobile_no` varchar(300) NOT NULL,
  `home_no` varchar(300) NOT NULL,
  `office_no` varchar(300) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT ' 1: Active User, 2: Inactive User',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1: Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `user_type_id`, `full_name`, `email`, `mobile_no`, `home_no`, `office_no`, `status`, `created`, `updated`, `active`) VALUES
(1,	1,	'Super Admin',	'mudastar@gmail.com',	'0123456789',	'',	'',	1,	'2020-03-03 15:52:54',	'2020-03-03 15:52:54',	1),
(2,	2,	'Admin',	'mudastar@gmail.com',	'0123456789',	'',	'',	2,	'2020-03-03 15:52:54',	'2020-03-03 15:52:54',	1);

-- 2020-10-10 02:40:40

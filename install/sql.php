<?php
mysql_query("DROP TABLE IF EXISTS lbs_admin",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_biz",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_biz_banners",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_biz_contacts",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_biz_keywords",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_biz_location",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_biz_main_categories",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_biz_social_links",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_biz_sub_categories",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_newsletters",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_rtgitems",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_rtgusers",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_search",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_user",$conn);
mysql_query("DROP TABLE IF EXISTS lbs_user_login_data",$conn);

//Create all tables
$sql = "CREATE TABLE `lbs_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_joined` datetime NOT NULL,
  `last_accessed_time` datetime NOT NULL,
  PRIMARY KEY (`admin_id`)
)";
$res1=mysql_query($sql,$conn);


$sql = "CREATE TABLE  `lbs_biz` (
  `biz_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `main_category` int(11) NOT NULL,
  `sub_category` int(11) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `content_approved` tinyint(1) NOT NULL DEFAULT '0',
  `package` char(1) NOT NULL,
  `date_submit` datetime DEFAULT NULL,
  `date_expire` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`biz_id`)
)";
$res2=mysql_query($sql,$conn);


$sql = "CREATE TABLE  `lbs_biz_banners` (
  `banner_id` int(10) NOT NULL AUTO_INCREMENT,
  `type` enum('top','bottom','featured','vertical') NOT NULL,
  `caption` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `biz_id` int(11) NOT NULL,
  PRIMARY KEY (`banner_id`)
)";
$res3=mysql_query($sql,$conn);

$sql = "CREATE TABLE  `lbs_biz_contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `biz_id` int(11) NOT NULL,
  PRIMARY KEY (`contact_id`)
)";
$res4=mysql_query($sql,$conn);

$sql = "CREATE TABLE  `lbs_biz_keywords` (
  `keyword_id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` text NOT NULL,
  `biz_id` int(11) NOT NULL,
  PRIMARY KEY (`keyword_id`)
)";
$res5=mysql_query($sql,$conn);

$sql = "CREATE TABLE `lbs_biz_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zip_code` varchar(5) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `biz_id` int(11) NOT NULL,
  PRIMARY KEY (`location_id`)
)";
$res6=mysql_query($sql,$conn);

$sql = "CREATE TABLE  `lbs_biz_main_categories` (
  `main_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`main_category_id`)
)";
$res7=mysql_query($sql,$conn);

$sql = "CREATE TABLE  `lbs_biz_social_links` (
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `video_channel` varchar(255) DEFAULT NULL,
  `biz_id` int(11) NOT NULL
)";
$res8=mysql_query($sql,$conn);

$sql = "CREATE TABLE  `lbs_biz_sub_categories` (
  `sub_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `main_category_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_category_id`)
)";
$res9 = mysql_query($sql,$conn);

$sql = "CREATE TABLE `lbs_newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dateTime` datetime NOT NULL,
  `received` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)";
$res10 = mysql_query($sql,$conn);

$sql = "CREATE TABLE  `lbs_rtgitems` (
  `biz_id` int(11) NOT NULL,
  `item` varchar(200) NOT NULL DEFAULT '',
  `totalrate` int(10) NOT NULL DEFAULT '0',
  `nrrates` int(9) NOT NULL DEFAULT '1',
  PRIMARY KEY (`item`)
)";
$res11 = mysql_query($sql,$conn);

$sql = "CREATE TABLE  `lbs_rtgusers` (
  `day` int(2) DEFAULT NULL,
  `rater` varchar(15) DEFAULT NULL,
  `item` varchar(200) NOT NULL DEFAULT ''
)";
$res12 = mysql_query($sql,$conn);

$sql = "CREATE TABLE  `lbs_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `whats` varchar(255) NOT NULL,
  `wheres` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  PRIMARY KEY (`id`)
)";
$res13 = mysql_query($sql,$conn);

$sql = "CREATE TABLE `lbs_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_activated` enum('0','1') NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zip_code` varchar(5) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `joined_date` date NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`user_id`)
)";
$res14 = mysql_query($sql,$conn);

$sql = "CREATE TABLE `lbs_user_login_data` (
  `user_id` int(11) NOT NULL,
  `last_logged_in_time` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `browser` varchar(50) NOT NULL,
  `platform` varchar(30) NOT NULL
)";
$res15 = mysql_query($sql,$conn);

//Insert data for necessary tables
$sql = "INSERT INTO `lbs_biz_main_categories` (`main_category_id`, `name`, `description`) VALUES
(1, 'Arts and Humanities', ''),
(2, 'Business and Economy', ''),
(3, 'Computers and Internet', ''),
(4, 'Employment', ''),
(5, 'Health', ''),
(6, 'Contractors', ''),
(7, 'News and Media', ''),
(8, 'Property', ''),
(9, 'Recreations and Sports', ''),
(10, 'Shopping and Services', ''),
(11, 'Society and Culture', '')";

$res20 = mysql_query($sql,$conn);

$sql = "INSERT INTO `lbs_biz_sub_categories` (`sub_category_id`, `name`, `description`, `main_category_id`) VALUES
(46, 'Builders', '', 6),
(47, 'Decking', '', 6),
(48, 'Conversions', '', 6),
(49, 'Electricians', '', 6),
(50, 'Media', '', 7),
(51, 'Analysis and Opinion', '', 7),
(52, 'Breaking News', '', 7),
(53, 'Science', '', 7),
(54, 'Weather', '', 7),
(55, 'Auction', '', 8),
(56, 'Estate Agents', '', 8),
(57, 'Home Inspection', '', 8),
(58, 'News & Media', '', 8),
(59, 'For Sale By Owner', '', 8),
(60, 'American Football', '', 9),
(61, 'Animal Sport', '', 9),
(62, 'Archery', '', 9),
(63, 'Badminton', '', 9),
(64, 'Boxing', '', 9),
(65, 'Adult', '', 10),
(66, 'Animals', '', 10),
(67, 'Apparel', '', 10),
(68, 'Arts and Crafts', '', 10),
(69, 'Children', '', 10),
(70, 'Activism', '', 11),
(71, 'Advice', '', 11),
(72, 'Crime', '', 11),
(73, 'Death', '', 11),
(74, 'Disable', '', 11),
(9, 'Auctions', '', 2),
(8, 'Architecture', '', 2),
(7, 'Apparel', '', 2),
(6, 'Agriculture', '', 2),
(5, 'Books', '', 1),
(4, 'Body Art', '', 1),
(3, 'Artists', '', 1),
(2, 'Architecture', '', 1),
(28, 'IT Service', '', 3),
(25, 'Computer Art', '', 3),
(26, 'Games', '', 3),
(27, 'Dektop Publishing', '', 3),
(1, 'Animation', '', 1),
(29, 'Hosting', '', 3),
(30, 'Apple Mac', '', 3),
(31, 'Agencies', '', 4),
(32, 'Career Planning', '', 4),
(33, 'Counseling and Management', '', 4),
(34, 'Job Search', '', 4),
(35, 'Career advice', '', 4),
(36, 'Job Search', '', 4),
(37, 'Outsourcing', '', 4),
(38, 'Self-Employment', '', 4),
(39, 'Aging', '', 5),
(40, 'Beauty', '', 5),
(41, 'Child Health', '', 5),
(42, 'Dental Health', '', 5),
(43, 'Fitness', '', 5),
(44, 'Bathrooms', '', 6),
(45, 'Bricklaying', '', 6),
(10, 'Crafts', '', 1),
(11, 'Cultural and Groups', '', 1),
(12, 'Design Arts', '', 1),
(13, 'Directories', '', 1),
(14, 'Genres', '', 1),
(15, 'Automotive', '', 2),
(16, 'Aviation', '', 2),
(17, 'Books', '', 2),
(18, 'Business Opportunties', '', 2),
(19, 'Cleaning', '', 2),
(20, 'Communications', '', 2),
(21, 'Employment', '', 3),
(22, 'Graphics', '', 3),
(23, 'Hardware', '', 3),
(24, 'Internet', '', 3),
(75, 'Economics', '', 11),
(76, 'Education', '', 11),
(77, 'Ethnicity', '', 11),
(78, 'Folklore', '', 11),
(79, 'Future', '', 11),
(80, 'Genealogy', '', 11),
(81, 'Recruitment and Staffing', '', 4),
(82, 'Resumes and Portfolios', '', 4),
(83, 'Alternative Medical Systems', '', 5),
(84, 'Disabilities', '', 5),
(85, 'Health Education', '', 5),
(86, 'Environmental Health ', '', 5),
(87, 'First Aid', '', 5),
(88, 'Carpentry and Joinery ', '', 6),
(89, 'Conservatories', '', 6),
(90, 'Driveways and Patios', '', 6),
(91, 'Extensions', '', 6),
(92, 'Alternative', '', 7),
(93, 'Chats and Forums', '', 7),
(94, 'Colleges and Universities', '', 7),
(95, 'Current Events', '', 7),
(96, 'Extended Coverage', '', 7),
(97, 'Commercial Estate Agents', '', 8),
(98, 'Home and Garden', '', 8),
(99, 'Home Construction', '', 8),
(100, 'Letting Agents', '', 8),
(101, 'Mortgages', '', 8),
(102, 'Baseball', '', 9),
(103, 'Basketball', '', 9),
(104, 'Cheerleading', '', 9),
(105, 'Canoeing', '', 9),
(106, 'Coaching', '', 9),
(107, 'Antiques and Collectibles', '', 10),
(108, 'Architecture', '', 10),
(109, 'Auctions', '', 10),
(110, 'Automotive', '', 10),
(111, 'Communication', '', 10)";

$res21 = mysql_query($sql,$conn);
?>
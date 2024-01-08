-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2024 at 04:47 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobhunter`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_studies`
--

CREATE TABLE `advance_studies` (
  `reason_adv_studies` enum('For Promotion','For Professional Development','Others') NOT NULL,
  `id` int(11) NOT NULL,
  `studies_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_studies`
--

INSERT INTO `advance_studies` (`reason_adv_studies`, `id`, `studies_id`) VALUES
('For Promotion', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ched`
--

CREATE TABLE `ched` (
  `perm_address` varchar(255) NOT NULL,
  `contact_num` varchar(11) NOT NULL,
  `mobile_num` varchar(11) NOT NULL,
  `civil_stat` enum('single','married','separated','single parent','widow or widower') NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `birthday` date NOT NULL,
  `region_origin` enum('Region 1','Region 2','Region 3','Region 4','Region 5','Region 6','Region 7','Region 8','Region 9','Region 10','Region 11','Region 12','NCR','CAR','ARMM','CARAGA') NOT NULL,
  `province` varchar(255) NOT NULL,
  `residence` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ched`
--

INSERT INTO `ched` (`perm_address`, `contact_num`, `mobile_num`, `civil_stat`, `sex`, `birthday`, `region_origin`, `province`, `residence`, `id`) VALUES
('dlaksdl12332', '12312412312', '123123123', 'single parent', 'Male', '2024-01-10', 'Region 10', '12342543', '123124', 1);

-- --------------------------------------------------------

--
-- Table structure for table `educ_attainment`
--

CREATE TABLE `educ_attainment` (
  `degree_specs` varchar(255) NOT NULL,
  `college_uni` varchar(255) NOT NULL,
  `year_graduate` year(4) NOT NULL,
  `honors_recieved` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `ched_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employed`
--

CREATE TABLE `employed` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `user_employed` int(11) NOT NULL,
  `user_unemployed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employed`
--

INSERT INTO `employed` (`id`, `year`, `user_employed`, `user_unemployed`) VALUES
(7, 2021, 1, 0),
(13, 2022, 0, 0),
(14, 2023, 1, 1),
(15, 2024, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employment_data`
--

CREATE TABLE `employment_data` (
  `now_employed` enum('Yes','No','Never Employed') NOT NULL,
  `employment_status` enum('Regular','Temporary','Casual','Contractual','Self-employed') NOT NULL,
  `skills_if_self` varchar(255) NOT NULL,
  `occupation_now` varchar(255) NOT NULL,
  `major_business_line` enum('Agriculture, Hunting and Forestry','Fishing','Mining and Quarrying','Manufacturing','Electricity, Gas, and Water Supply','Construction','Wholesale and Retail Trade, repair of motor vehicles and personal and household goods','Hotels and Restaurants','Transport Storage and Communication','Financial Intermediation','Real Estate, Renting and Business Activities','Public Administration and Defense; Compulsory Social Security','Education','Health and Social Work','Other Community, Social and Personal Service Activities','Private Households with Employed Persons','Extra-territorial Organizations and Bodies') NOT NULL,
  `workplace` enum('Local','Abroad') NOT NULL,
  `is_firstjob` enum('Yes','No') NOT NULL,
  `is_aftercollege` enum('Yes','No') NOT NULL,
  `reasons_accept_job` enum('Salaries & benefits','Career Challenge','Related to special skills','Proximity to Residence') NOT NULL,
  `reasons_change_job` enum('Salaries & benefits','Career Challenge','Related to special skills','Proximity to Residence') NOT NULL,
  `length_firstjob` enum('Less than a month','1 to 6 months','7 to 11 months','1 year to less than 2 years','2 years to less than 3 years','3 years to less than 4 years') NOT NULL,
  `how_firstjob` enum('Response to an advertisement','As walk-in applicant','Recommended by someone','Information from friends Office (PESO)','Arranged by school''s job placement officer','Family Business','Job Fair or Public Employment Service') NOT NULL,
  `until_firstjob` enum('Less than a month','1 to 6 months','7 to 11 months','1 year to less than 2 years','2 years to less than 3 years','3 years to less than 4 years') NOT NULL,
  `initial_gorss_monthly_firstjob` enum('Below P5,000.00','P5,000.00 to less than P10,000.00','P10,000.00 to less than P15,000.00','P15,000 to less than P20,000.00','P20,000.00 to less than P25,000.00','P25,000.00 and above') NOT NULL,
  `is_relevantfirst` enum('Yes','No') NOT NULL,
  `useful_onfirstjob` enum('Communication Skills','Human Relation Skills','Entrepreneurial Skills','Information Technology skills','Problem-solving skills','Critical thinking skills') NOT NULL,
  `id` int(11) NOT NULL,
  `employment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employment_data`
--

INSERT INTO `employment_data` (`now_employed`, `employment_status`, `skills_if_self`, `occupation_now`, `major_business_line`, `workplace`, `is_firstjob`, `is_aftercollege`, `reasons_accept_job`, `reasons_change_job`, `length_firstjob`, `how_firstjob`, `until_firstjob`, `initial_gorss_monthly_firstjob`, `is_relevantfirst`, `useful_onfirstjob`, `id`, `employment_id`) VALUES
('Yes', 'Regular', 'fdasf', 'fadfs', 'Mining and Quarrying', 'Local', 'No', 'No', 'Career Challenge', 'Salaries & benefits', '7 to 11 months', 'Recommended by someone', 'Less than a month', 'P5,000.00 to less than P10,000.00', 'Yes', 'Human Relation Skills', 4, 1),
('Yes', 'Temporary', 'asdasd', 'asdasd', 'Public Administration and Defense; Compulsory Social Security', 'Local', 'Yes', 'Yes', 'Related to special skills', 'Salaries & benefits', '1 to 6 months', 'Information from friends Office (PESO)', '2 years to less than 3 years', 'P10,000.00 to less than P15,000.00', 'Yes', 'Entrepreneurial Skills', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsfeed`
--

CREATE TABLE `newsfeed` (
  `news_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `status_nf` varchar(20) DEFAULT NULL,
  `image_nf` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsfeed`
--

INSERT INTO `newsfeed` (`news_id`, `user_id`, `message`, `status_nf`, `image_nf`) VALUES
(35, 1, 'asdas', 'approved', ''),
(47, 2, 'awda', 'approved', ''),
(48, 2, 'asdasd', 'approved', ''),
(49, 2, 'THIS IS TEST', 'approved', 'MainLogo.png'),
(50, 2, 'This is test', 'pending', 'MainLogo.png'),
(51, 1, 'open', 'approved', 'image 57 (1).png'),
(52, 2, 'open', 'approved', 'Warsaw_Pact_Logo.svg.png'),
(53, 1, 'hello', 'pending', '406034742_1399621654287631_5206589174376331189_n.jpg'),
(54, 2, '', 'approved', '406034742_1399621654287631_5206589174376331189_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `prof_exam_passed`
--

CREATE TABLE `prof_exam_passed` (
  `name` varchar(255) NOT NULL,
  `date_taken` date NOT NULL,
  `rating` varchar(12) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `ched_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `StudentNo` varchar(20) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Sex` varchar(10) DEFAULT NULL,
  `DateBirth` date DEFAULT NULL,
  `ContactNo` varchar(15) DEFAULT NULL,
  `YearGraduate` int(11) DEFAULT NULL,
  `CurrentAddress` varchar(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `StudentNo`, `First_Name`, `Last_Name`, `Sex`, `DateBirth`, `ContactNo`, `YearGraduate`, `CurrentAddress`, `Password`, `status`, `image`) VALUES
(1, '1', 'Clark', 'Florendo', 'Male', '2022-03-11', '0912346678', 2023, 'Tacloban City', 'admin123', 'Employed', 'San_Juanico_Bridge_sunset_lighted_(Tacloban,_Leyte;_09-08-2022).jpg'),
(2, '0144521', 'Maica', 'Urtola', 'female', '1331-12-12', '0914141514', 2023, 'Tacloban City', 'student123', 'Unemployed', NULL),
(3, '15152', 'Michelle', 'Abrahan', 'male', '0013-03-12', '', 2021, '2025', '', 'Employed', NULL),
(8, '5', 'hanz', 'tumulak', 'male', '2024-01-03', '091290128', 2024, 'leyte', 'hanz', NULL, NULL),
(9, '10', 'Clark', 'Florendo', 'male', '2024-01-10', '0923103123809', 2022, 'asdasdlczl;ck', 'alskdasd,ds[', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_studies`
--
ALTER TABLE `advance_studies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ched_id_study` (`studies_id`);

--
-- Indexes for table `ched`
--
ALTER TABLE `ched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educ_attainment`
--
ALTER TABLE `educ_attainment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ched_id` (`ched_id`);

--
-- Indexes for table `employed`
--
ALTER TABLE `employed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_data`
--
ALTER TABLE `employment_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ched_id_employ` (`employment_id`);

--
-- Indexes for table `newsfeed`
--
ALTER TABLE `newsfeed`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `prof_exam_passed`
--
ALTER TABLE `prof_exam_passed`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `ched_id_exam` (`ched_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance_studies`
--
ALTER TABLE `advance_studies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ched`
--
ALTER TABLE `ched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `educ_attainment`
--
ALTER TABLE `educ_attainment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employed`
--
ALTER TABLE `employed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employment_data`
--
ALTER TABLE `employment_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `newsfeed`
--
ALTER TABLE `newsfeed`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `prof_exam_passed`
--
ALTER TABLE `prof_exam_passed`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance_studies`
--
ALTER TABLE `advance_studies`
  ADD CONSTRAINT `ched_id_study` FOREIGN KEY (`studies_id`) REFERENCES `ched` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `educ_attainment`
--
ALTER TABLE `educ_attainment`
  ADD CONSTRAINT `ched_id` FOREIGN KEY (`ched_id`) REFERENCES `ched` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employment_data`
--
ALTER TABLE `employment_data`
  ADD CONSTRAINT `ched_id_employ` FOREIGN KEY (`employment_id`) REFERENCES `ched` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `newsfeed`
--
ALTER TABLE `newsfeed`
  ADD CONSTRAINT `newsfeed_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `prof_exam_passed`
--
ALTER TABLE `prof_exam_passed`
  ADD CONSTRAINT `ched_id_exam` FOREIGN KEY (`ched_id`) REFERENCES `ched` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2022 年 7 月 20 日 16:38
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `rootask`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(1) NOT NULL DEFAULT 'U'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `role`) VALUES
(7, 'admin1', '$2y$10$qXB6JhISkeqWoT1EVANEUeu0FekI7wic0sfp9pJIPGxi5XbmdiLjy', 'A'),
(8, 'user1', '$2y$10$cwYLIGYiGeMkgUhuXS5YIexDfiIp1bJfdl6Xgj7jEa5COP3TGc1tC', 'U'),
(9, 'user2', '$2y$10$4yeO5ztU2BaeIuJe.7/HnOtA3/1mEOxR0RvEDwalTZVflV2yC6zYq', 'U'),
(10, 'user3', '$2y$10$0b4BKQC3CUhmuWXwbaOtZ.rKDcc8ZqEjcpN5erSpdZn2E5c4fNoTW', 'U');

-- --------------------------------------------------------

--
-- テーブルの構造 `comments_minutes`
--

CREATE TABLE `comments_minutes` (
  `comment_id` int(15) NOT NULL,
  `user_id` int(15) NOT NULL,
  `minutes_id` int(15) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `comments_project`
--

CREATE TABLE `comments_project` (
  `comment_id` int(15) NOT NULL,
  `user_id` int(15) NOT NULL,
  `project_id` int(15) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `comments_project`
--

INSERT INTO `comments_project` (`comment_id`, `user_id`, `project_id`, `time`, `comment`) VALUES
(9, 5, 71, '2022-07-20 13:50:32', 'comment test'),
(10, 8, 71, '2022-07-20 13:55:21', '社内MTG用のインビをお送りしましたので、皆様参加よろしくお願いします。');

-- --------------------------------------------------------

--
-- テーブルの構造 `manager`
--

CREATE TABLE `manager` (
  `project_man_id` int(15) NOT NULL,
  `manager_id` int(15) NOT NULL,
  `project_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `manager`
--

INSERT INTO `manager` (`project_man_id`, `manager_id`, `project_id`) VALUES
(56, 5, 70),
(57, 5, 71),
(58, 5, 72);

-- --------------------------------------------------------

--
-- テーブルの構造 `member`
--

CREATE TABLE `member` (
  `project_mem_id` int(15) NOT NULL,
  `project_man_id` int(15) NOT NULL,
  `project_id` int(15) NOT NULL,
  `member_id_1` int(15) DEFAULT NULL,
  `member_id_2` int(15) DEFAULT NULL,
  `member_id_3` int(15) DEFAULT NULL,
  `member_id_4` int(15) DEFAULT NULL,
  `member_id_5` int(15) DEFAULT NULL,
  `member_id_6` int(15) DEFAULT NULL,
  `member_id_7` int(15) DEFAULT NULL,
  `member_id_8` int(15) DEFAULT NULL,
  `member_id_9` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `member`
--

INSERT INTO `member` (`project_mem_id`, `project_man_id`, `project_id`, `member_id_1`, `member_id_2`, `member_id_3`, `member_id_4`, `member_id_5`, `member_id_6`, `member_id_7`, `member_id_8`, `member_id_9`) VALUES
(18, 56, 70, 6, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 57, 71, 7, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 58, 72, 6, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `minutes`
--

CREATE TABLE `minutes` (
  `project_id` int(15) NOT NULL,
  `minutes_id` int(15) NOT NULL,
  `task_id` int(15) DEFAULT NULL,
  `mtg_date` date NOT NULL,
  `title` varchar(50) NOT NULL,
  `minutes` varchar(50) NOT NULL,
  `participant_manager_id` int(15) DEFAULT NULL,
  `participant_member_id_1` int(15) DEFAULT NULL,
  `participant_member_id_2` int(15) DEFAULT NULL,
  `participant_member_id_3` int(15) DEFAULT NULL,
  `participant_member_id_4` int(15) DEFAULT NULL,
  `participant_member_id_5` int(15) DEFAULT NULL,
  `participant_member_id_6` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `minutes`
--

INSERT INTO `minutes` (`project_id`, `minutes_id`, `task_id`, `mtg_date`, `title`, `minutes`, `participant_manager_id`, `participant_member_id_1`, `participant_member_id_2`, `participant_member_id_3`, `participant_member_id_4`, `participant_member_id_5`, `participant_member_id_6`) VALUES
(70, 28, NULL, '2022-07-29', 'For next summer Event', 'test', 5, 6, 7, 8, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `projects`
--

CREATE TABLE `projects` (
  `project_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `manager_id` int(15) NOT NULL,
  `project_start` date NOT NULL,
  `project_end` date NOT NULL,
  `note` varchar(1000) NOT NULL,
  `project_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `projects`
--

INSERT INTO `projects` (`project_id`, `user_id`, `project_name`, `manager_id`, `project_start`, `project_end`, `note`, `project_status`) VALUES
(70, 8, 'Training for new employees', 5, '2022-08-01', '2022-08-31', 'Need to boost staff for the next event.\r\nThe goal is to hire 30 people.\r\nTrain them on product knowledge and customer service.\r\nTraining will include a section on learning about the client\'s company and background.', 'ongoing'),
(71, 5, '新製品ローンチイベント', 5, '2022-08-01', '2022-09-27', '実施日：9/20\r\n会場：未定', 'planning'),
(72, 5, 'TEST', 5, '2022-07-01', '2022-07-21', 'test', 'done');

-- --------------------------------------------------------

--
-- テーブルの構造 `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(15) NOT NULL,
  `project_id` int(15) NOT NULL,
  `user_id` int(15) NOT NULL,
  `task_name` varchar(50) NOT NULL,
  `assign_id` int(30) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deadline` date DEFAULT NULL,
  `task_status` varchar(15) NOT NULL DEFAULT 'ongoing',
  `note` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tasks`
--

INSERT INTO `tasks` (`task_id`, `project_id`, `user_id`, `task_name`, `assign_id`, `date_posted`, `deadline`, `task_status`, `note`) VALUES
(92, 70, 5, 'Create a document', 8, '2022-07-20 04:12:39', '2022-08-17', 'planning', 'Please update previous training materials.'),
(93, 70, 5, 'Create a list of participants', 6, '2022-07-20 03:08:47', '2022-08-10', 'ongoing', 'Please make sure to mention whether they have any experience.'),
(94, 70, 8, 'Previous document', 6, '2022-07-20 04:05:21', '2022-07-06', 'done', 'Please send me the previous document data.'),
(95, 70, 5, 'プロジェクトメンバーアサイン', 5, '2022-07-20 14:50:18', '2022-08-05', 'planning', 'プランニング、エクセキューション、各メンバーアサイン'),
(96, 71, 5, '候補会場リスト作成', 6, '2022-07-20 13:49:22', '2022-08-10', 'postpone', '最低５箇所、予算の裏取りもお願いします。'),
(97, 71, 5, '概算見積もり作成', 7, '2022-07-20 13:49:09', '2022-08-15', 'pending', 'ざっくりでいいので項目と単価の洗い出しをお願いします。\r\n会場費は山田さんにお願いしているので、連携してください。'),
(98, 71, 5, '【施工】MTG＆ブリーフ資料作成', 8, '2022-07-20 13:48:55', '2022-08-05', 'planning', '施工会社とのMTGを設定し、\r\nイベントの概要を説明するための簡単なブリーフ資料の用意をお願いします。'),
(99, 71, 5, '社内MTG日程調整', 8, '2022-07-20 13:54:18', '2022-07-21', 'done', '社内オンラインMTGを行います。\r\nメンバーのスケジュール調整をお願いします。\r\nインビーテーションメールでURLを共有してください。'),
(102, 72, 8, 'Your project has been completed.', 5, '2022-07-20 14:21:50', '2022-07-20', 'ongoing', 'Your project now has been completed. If your final checks show no problems, please change the status of the project to Approved.');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'profile.jpg',
  `division` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `account_id`, `first_name`, `last_name`, `email`, `avatar`, `division`, `position`) VALUES
(5, 7, 'Taro', 'Yamamoto', 'taro@gamail.com', 'business_man1_1_smile.png', 'Sales', 'manager'),
(6, 8, 'Hanako', 'Yamada', 'hanako@gmail.com', 'girl-glasses.png', 'sales', 'member'),
(7, 9, 'Kento', 'Yamazaki', 'kento@gmail.com', 'youngman_27.png', 'analysis', 'analyst'),
(8, 10, 'Suzu', 'Hirose', 'suzu@gmail.com', 'book_idol_poster_woman.png', 'Sales', ' Internship');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- テーブルのインデックス `comments_minutes`
--
ALTER TABLE `comments_minutes`
  ADD PRIMARY KEY (`comment_id`);

--
-- テーブルのインデックス `comments_project`
--
ALTER TABLE `comments_project`
  ADD PRIMARY KEY (`comment_id`);

--
-- テーブルのインデックス `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`project_man_id`);

--
-- テーブルのインデックス `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`project_mem_id`);

--
-- テーブルのインデックス `minutes`
--
ALTER TABLE `minutes`
  ADD PRIMARY KEY (`minutes_id`);

--
-- テーブルのインデックス `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `userIdFK` (`user_id`);

--
-- テーブルのインデックス `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `comments_minutes`
--
ALTER TABLE `comments_minutes`
  MODIFY `comment_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- テーブルの AUTO_INCREMENT `comments_project`
--
ALTER TABLE `comments_project`
  MODIFY `comment_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `manager`
--
ALTER TABLE `manager`
  MODIFY `project_man_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- テーブルの AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `project_mem_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- テーブルの AUTO_INCREMENT `minutes`
--
ALTER TABLE `minutes`
  MODIFY `minutes_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- テーブルの AUTO_INCREMENT `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- テーブルの AUTO_INCREMENT `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `userIdFK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

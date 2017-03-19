-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 19 2017 г., 23:05
-- Версия сервера: 5.6.26-log
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `language`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `lesson_id` int(11) NOT NULL DEFAULT '0',
  `session` varchar(255) NOT NULL DEFAULT '',
  `item` int(11) NOT NULL DEFAULT '0',
  `answer` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `date_ask` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_answer` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `lesson_id`, `session`, `item`, `answer`, `status`, `date_ask`, `date_answer`) VALUES
(1, 1, 1, '1f9cba4f3d6ffdf520386b135680114c', 7, 'M', 1, '2017-03-10 21:51:56', '0000-00-00 00:00:00'),
(2, 1, 1, '1f9cba4f3d6ffdf520386b135680114c', 6, '', 0, '2017-03-10 21:52:13', '0000-00-00 00:00:00'),
(3, 1, 1, 'bc91b77e0bb18323f463ca3fb8cae7eb', 4, '', 1, '2017-03-11 16:50:19', '0000-00-00 00:00:00'),
(4, 0, 0, '', 0, '7', 2, '0000-00-00 00:00:00', '2017-03-11 17:09:40'),
(5, 0, 0, '', 0, '5', 2, '0000-00-00 00:00:00', '2017-03-11 17:09:42'),
(6, 0, 0, '', 0, '3', 2, '0000-00-00 00:00:00', '2017-03-11 17:09:51'),
(7, 0, 0, '', 0, '4', 2, '0000-00-00 00:00:00', '2017-03-11 17:11:01'),
(8, 1, 1, 'bc91b77e0bb18323f463ca3fb8cae7eb', 1, '', 1, '2017-03-11 17:11:11', '0000-00-00 00:00:00'),
(9, 0, 0, '', 0, '6', 2, '0000-00-00 00:00:00', '2017-03-11 17:12:01'),
(10, 0, 0, '', 0, '1', 2, '0000-00-00 00:00:00', '2017-03-11 17:12:08'),
(11, 0, 0, '', 0, '4', 2, '0000-00-00 00:00:00', '2017-03-11 17:13:24'),
(12, 0, 0, '', 0, '2', 2, '0000-00-00 00:00:00', '2017-03-11 17:13:24'),
(13, 1, 1, '5a6714bb097437c96350c6314ad721ed', 1, '', 1, '2017-03-18 22:37:56', '0000-00-00 00:00:00'),
(14, 0, 0, '', 0, '4', 2, '0000-00-00 00:00:00', '2017-03-18 22:37:59'),
(15, 0, 0, '', 0, '7', 2, '0000-00-00 00:00:00', '2017-03-18 22:38:17'),
(16, 0, 0, '', 0, '7', 2, '0000-00-00 00:00:00', '2017-03-18 22:50:39'),
(17, 0, 0, '', 0, '7', 2, '0000-00-00 00:00:00', '2017-03-18 22:51:02'),
(18, 0, 1, '', 0, '7', 2, '0000-00-00 00:00:00', '2017-03-18 22:52:12'),
(19, 0, 1, '', 0, '8', 2, '0000-00-00 00:00:00', '2017-03-18 22:52:15'),
(20, 1, 1, '5a6714bb097437c96350c6314ad721ed', 1, '', 1, '2017-03-18 22:52:22', '0000-00-00 00:00:00'),
(21, 1, 1, '5a6714bb097437c96350c6314ad721ed', 6, '', 1, '2017-03-18 22:52:27', '0000-00-00 00:00:00'),
(22, 0, 1, '', 0, '6', 2, '0000-00-00 00:00:00', '2017-03-19 20:27:35'),
(23, 0, 1, '', 0, '8', 2, '0000-00-00 00:00:00', '2017-03-19 20:27:50'),
(24, 0, 1, '', 0, '9', 2, '0000-00-00 00:00:00', '2017-03-19 20:27:53');

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `order` tinyint(3) NOT NULL DEFAULT '0',
  `attempts` int(11) NOT NULL DEFAULT '0',
  `errors` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id`, `level`, `type`, `order`, `attempts`, `errors`, `status`, `date`) VALUES
(1, 1, 1, 1, 10, 5, 1, '0000-00-00 00:00:00'),
(2, 1, 1, 2, 0, 0, 1, '0000-00-00 00:00:00'),
(3, 1, 1, 3, 0, 0, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `lessons_results`
--

CREATE TABLE `lessons_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `lesson_id` int(11) NOT NULL DEFAULT '0',
  `session` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lessons_results`
--

INSERT INTO `lessons_results` (`id`, `user_id`, `lesson_id`, `session`, `status`, `date`) VALUES
(1, 1, 1, '', 0, '2017-03-19 20:31:24'),
(2, 1, 1, '', 0, '2017-03-19 20:31:38'),
(3, 1, 1, '', 0, '2017-03-19 20:34:34'),
(4, 1, 1, '', 0, '2017-03-19 20:34:40'),
(5, 1, 1, 'a9ed82c5d4b58e44489077dec25964e5', 0, '2017-03-19 20:35:04'),
(6, 1, 1, 'a9ed82c5d4b58e44489077dec25964e5', 0, '2017-03-19 20:35:05'),
(7, 1, 1, 'a9ed82c5d4b58e44489077dec25964e5', 0, '2017-03-19 21:02:41'),
(8, 1, 1, '95e9321ce788ad92bcc181118b1d9508', 0, '2017-03-19 21:04:37');

-- --------------------------------------------------------

--
-- Структура таблицы `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `order` tinyint(5) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `levels`
--

INSERT INTO `levels` (`id`, `order`, `status`, `date`) VALUES
(1, 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `element` text NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `use` tinyint(2) NOT NULL DEFAULT '1',
  `status` tinyint(2) DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `lesson_id`, `element`, `type`, `use`, `status`, `date`) VALUES
(1, 1, 'T', 1, 1, 1, '0000-00-00 00:00:00'),
(2, 1, 'H', 1, 1, 1, '0000-00-00 00:00:00'),
(3, 1, 'J', 1, 0, 1, '0000-00-00 00:00:00'),
(4, 1, 'P', 1, 1, 1, '0000-00-00 00:00:00'),
(5, 1, 'A', 1, 0, 1, '0000-00-00 00:00:00'),
(6, 1, 'V', 1, 1, 1, '0000-00-00 00:00:00'),
(7, 1, 'M', 1, 1, 1, '0000-00-00 00:00:00'),
(8, 1, 'Q', 1, 1, 1, '0000-00-00 00:00:00'),
(9, 1, 'S', 1, 0, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `lesson_id` int(11) NOT NULL DEFAULT '0',
  `uuid` varchar(255) NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `lesson_id`, `uuid`, `date`, `status`) VALUES
(1, 1, 1, '0098f1d6b31c4cf17eaaf351c8467574', '2017-03-07 21:16:34', 1),
(2, 0, 1, 'c06b995972c9f537dee325451fbba255', '2017-03-10 19:33:40', 1),
(3, 1, 1, 'd1fb5959d7dc1e3c461b8fa4003ef7fe', '2017-03-10 19:34:06', 1),
(4, 1, 1, '1f9cba4f3d6ffdf520386b135680114c', '2017-03-10 21:10:29', 1),
(5, 0, 1, '2b78bc0884ec4b65eec5a4c9c0c73c11', '2017-03-11 16:49:58', 1),
(6, 1, 1, 'bc91b77e0bb18323f463ca3fb8cae7eb', '2017-03-11 16:50:11', 1),
(7, 1, 1, '694d2eb0ff0a1d3fe53f8605843bed73', '2017-03-12 19:36:17', 1),
(8, 0, 1, '4dfc3a424270c8889dc0654ac17be49a', '2017-03-18 22:14:44', 1),
(9, 1, 1, '5a6714bb097437c96350c6314ad721ed', '2017-03-18 22:15:02', 1),
(10, 0, 1, 'cb4b48f3a71c1f23ebd1bdd0c7039b2a', '2017-03-19 18:49:57', 1),
(11, 1, 1, 'a9ed82c5d4b58e44489077dec25964e5', '2017-03-19 18:50:32', 1),
(12, 1, 1, '95e9321ce788ad92bcc181118b1d9508', '2017-03-19 21:04:37', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL DEFAULT '',
  `lastname` varchar(250) NOT NULL DEFAULT '',
  `fathersname` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(250) NOT NULL DEFAULT '',
  `country` int(11) DEFAULT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `birthday` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `bad_auth` tinyint(2) NOT NULL DEFAULT '0',
  `bad_auth_time` int(11) DEFAULT NULL,
  `bad_withdraw_answer` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(250) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `fathersname`, `password`, `country`, `email`, `birthday`, `status`, `bad_auth`, `bad_auth_time`, `bad_withdraw_answer`, `last_login`, `last_modified`, `last_ip`, `date`) VALUES
(1, 'Slawik', 'Sivinyuk', '', 'dd8275800e16216360194ae9ab4a0eb2:1MHyW0kH7zbhfiqM', NULL, '279229931@qip.ru', '0000-00-00 00:00:00', 1, 0, NULL, 0, '2017-03-19 18:50:08', '0000-00-00 00:00:00', '127.0.0.1', '2017-03-05 20:34:10');

-- --------------------------------------------------------

--
-- Структура таблицы `x_session`
--

CREATE TABLE `x_session` (
  `id` int(11) NOT NULL,
  `session_id` varchar(45) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL DEFAULT '0',
  `device_id` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `guest` tinyint(4) NOT NULL DEFAULT '1',
  `guest_key` varchar(50) NOT NULL DEFAULT '',
  `usertype` varchar(50) NOT NULL DEFAULT '',
  `status` int(2) DEFAULT '1',
  `remember` tinyint(4) NOT NULL DEFAULT '0',
  `gid` int(10) NOT NULL DEFAULT '1',
  `ip` varchar(20) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `x_session`
--

INSERT INTO `x_session` (`id`, `session_id`, `time`, `userid`, `device_id`, `username`, `guest`, `guest_key`, `usertype`, `status`, `remember`, `gid`, `ip`, `user_agent`) VALUES
(20, '988853d36fc029c55ff50a81c9b3ae55', 1489957486, 1, '', '279229931@qip.ru', 0, '', 'user', 1, 0, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lessons_results`
--
ALTER TABLE `lessons_results`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Индексы таблицы `x_session`
--
ALTER TABLE `x_session`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session` (`session_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `lessons_results`
--
ALTER TABLE `lessons_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `x_session`
--
ALTER TABLE `x_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

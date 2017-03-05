-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 05 2017 г., 23:10
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
(1, 'Slawik', 'Sivinyuk', '', 'dd8275800e16216360194ae9ab4a0eb2:1MHyW0kH7zbhfiqM', NULL, '279229931@qip.ru', '0000-00-00 00:00:00', 1, 0, NULL, 0, '2017-03-05 20:38:10', '0000-00-00 00:00:00', '127.0.0.1', '2017-03-05 20:34:10');

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
(9, '0158288d27bd311cb1a518ea39d41be6', 1488748175, 1, '', '279229931@qip.ru', 0, '', 'user', 1, 0, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0'),
(10, 'ed7df140ecdeee5187d9a684c062f6a8', 1488737211, 0, '', '', 1, '', '', 1, 0, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0'),
(11, '9c4aa25adf46a0577bb85d99f1c3db68', 1488744619, 0, '', '', 1, '', '', 1, 0, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36');

--
-- Индексы сохранённых таблиц
--

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
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `x_session`
--
ALTER TABLE `x_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

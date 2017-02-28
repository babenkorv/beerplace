-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 28 2017 г., 19:02
-- Версия сервера: 5.6.31
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `beerpalce`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bar`
--

CREATE TABLE IF NOT EXISTS `bar` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` text,
  `coord` varchar(60) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `new_name` varchar(40) NOT NULL,
  `new_description` text NOT NULL,
  `new_beers` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bar`
--

INSERT INTO `bar` (`id`, `name`, `description`, `coord`, `is_active`, `new_name`, `new_description`, `new_beers`) VALUES
(41, '''dasdas''', '1', '49.99333957060293,36.2276315689087', 0, '', '', ''),
(42, 'dads', '123', '49.990828881224694,36.23153686523438', 1, '', '', ''),
(43, 'sfas', 'asdasdasdas', '49.9915462344223,36.24114990234376', 1, '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `bar_has_beer`
--

CREATE TABLE IF NOT EXISTS `bar_has_beer` (
  `id` int(11) NOT NULL,
  `id_bar` int(11) NOT NULL,
  `id_beer` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bar_has_beer`
--

INSERT INTO `bar_has_beer` (`id`, `id_bar`, `id_beer`) VALUES
(3, 42, 39),
(4, 42, 40),
(8, 43, 42);

-- --------------------------------------------------------

--
-- Структура таблицы `beer`
--

CREATE TABLE IF NOT EXISTS `beer` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `beer`
--

INSERT INTO `beer` (`id`, `name`) VALUES
(37, 'b1'),
(38, 'dasd'),
(39, '37'),
(40, 'qwe'),
(41, 'c'),
(42, 'dsad');

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL,
  `email_user` varchar(60) NOT NULL,
  `id_bar` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `email_user`, `id_bar`, `is_active`, `comment`) VALUES
(1, 'manwithjeans@gmail.com', 43, 1, 'asfsfas');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `is_active`, `password`) VALUES
(8, 'manwithjeans@gmail.com', 1, '$2y$10$ylZXdM89U1cr0N6.F7UTPeF0S6TodmwjtWSP2ElWrT/kRF/1QanCe'),
(15, 'q@q.q', 1, '$2y$10$H.OL/.XnlEHayt6tHIEoa.2nEJzeDOT5nnDxE3SIqrQsf3Ev.QoQ2'),
(16, 'valera@asdasd.aaa', 0, '$2y$10$oY85ewivhiLjObNuc6OI7OFZDFyqOzW.qmYRqwsttOl/1lPXvh0WC');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bar`
--
ALTER TABLE `bar`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bar_has_beer`
--
ALTER TABLE `bar_has_beer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `beer`
--
ALTER TABLE `beer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bar`
--
ALTER TABLE `bar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT для таблицы `bar_has_beer`
--
ALTER TABLE `bar_has_beer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `beer`
--
ALTER TABLE `beer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

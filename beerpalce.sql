-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 25 2017 г., 14:17
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
  `new_name` varchar(60) NOT NULL,
  `new_description` text NOT NULL,
  `new_beers` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bar`
--

INSERT INTO `bar` (`id`, `name`, `description`, `coord`, `is_active`, `new_name`, `new_description`, `new_beers`) VALUES
(29, 'first_bar', 'first bar description', '49.991187559161034,36.23359680175782', 0, 'test', 'test description', 'a:1:{i:0;s:2:"12";}');

-- --------------------------------------------------------

--
-- Структура таблицы `bar_has_beer`
--

CREATE TABLE IF NOT EXISTS `bar_has_beer` (
  `id` int(11) NOT NULL,
  `id_bar` int(11) NOT NULL,
  `id_beer` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bar_has_beer`
--

INSERT INTO `bar_has_beer` (`id`, `id_bar`, `id_beer`) VALUES
(28, 29, 12),
(29, 29, 13);

-- --------------------------------------------------------

--
-- Структура таблицы `beer`
--

CREATE TABLE IF NOT EXISTS `beer` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `beer`
--

INSERT INTO `beer` (`id`, `name`) VALUES
(12, 'beer1'),
(13, 'beer3');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `email_user`, `id_bar`, `is_active`, `comment`) VALUES
(2, 'manwithjeans@gmail.com', 29, 1, 'nice bar');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `is_active`, `password`) VALUES
(8, 'manwithjeans@gmail.com', 1, '$2y$10$ylZXdM89U1cr0N6.F7UTPeF0S6TodmwjtWSP2ElWrT/kRF/1QanCe');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `bar_has_beer`
--
ALTER TABLE `bar_has_beer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `beer`
--
ALTER TABLE `beer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

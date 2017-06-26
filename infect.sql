-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 26 2017 г., 21:54
-- Версия сервера: 5.1.54-community
-- Версия PHP: 7.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `infect`
--
CREATE DATABASE IF NOT EXISTS `infect` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `infect`;

-- --------------------------------------------------------

--
-- Структура таблицы `federal_districts`
--

CREATE TABLE IF NOT EXISTS `federal_districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `federal_districts`
--

INSERT INTO `federal_districts` (`id`, `title`) VALUES
(1, 'Центральный федеральный округ'),
(2, 'Северо-Западный федеральный округ'),
(3, 'Южный федеральный округ'),
(4, 'Северо-Кавказский федеральный округ'),
(5, 'Приволжский федеральный округ'),
(6, 'Уральский федеральный округ'),
(7, 'Сибирский федеральный округ'),
(8, 'Дальневосточный федеральный округ');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_subjects`
--

CREATE TABLE IF NOT EXISTS `rf_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `federal_district_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- Дамп данных таблицы `rf_subjects`
--

INSERT INTO `rf_subjects` (`id`, `title`, `federal_district_id`) VALUES
(1, 'Белгородская область', 1),
(2, 'Брянская область', 1),
(3, 'Владимирская область', 1),
(4, 'Воронежская область', 1),
(5, 'Ивановская область', 1),
(6, 'Калужская область', 1),
(7, 'Костромская область', 1),
(8, 'Курская область', 1),
(9, 'Липецкая область', 1),
(10, 'Московская область', 1),
(11, 'Орловская область', 1),
(12, 'Рязанская область', 1),
(13, 'Смоленская область', 1),
(14, 'Тамбовская область', 1),
(15, 'Тверская область', 1),
(16, 'Тульская область', 1),
(17, 'Ярославская область', 1),
(18, 'Город федерального значения Москва', 1),
(19, 'Республика Карелия', 2),
(20, 'Республика Коми', 2),
(21, 'Архангельская область', 2),
(22, 'Вологодская область', 2),
(23, 'Калининградская область', 2),
(24, 'Ленинградская область', 2),
(25, 'Мурманская область', 2),
(26, 'Новгородская область', 2),
(27, 'Псковская область', 2),
(28, 'Город федерального значения Санкт-Петербург', 2),
(29, 'Ненецкий автономный округ', 2),
(30, 'Республика Адыгея', 3),
(31, 'Республика Калмыкия', 3),
(32, 'Республика Крым', 3),
(33, 'Краснодарский край', 3),
(34, 'Астраханская область', 3),
(35, 'Волгоградская область', 3),
(36, 'Ростовская область', 3),
(37, 'город федерального значения Севастополь', 3),
(38, 'Республика Дагестан', 4),
(39, 'Республика Ингушетия', 4),
(40, 'Кабардино-Балкарская Республика', 4),
(41, 'Карачаево-Черкесская Республика', 4),
(42, 'Республика Северная Осетия', 4),
(43, 'Чеченская Республика', 4),
(44, 'Ставропольский край', 4),
(45, 'Республика Башкортостан', 5),
(46, 'Республика Марий Эл', 5),
(47, 'Республика Мордовия', 5),
(48, 'Республика Татарстан', 5),
(49, 'Удмуртская Республика', 5),
(50, 'Чувашская Республика', 5),
(51, 'Пермский край', 5),
(52, 'Кировская область', 5),
(53, 'Нижегородская область', 5),
(54, 'Оренбургская область', 5),
(55, 'Пензенская область', 5),
(56, 'Самарская область', 5),
(57, 'Саратовская область', 5),
(58, 'Ульяновская область', 5),
(59, 'Курганская область', 6),
(60, 'Свердловская область', 6),
(61, 'Тюменская область', 6),
(62, 'Челябинская область', 6),
(63, 'Ханты-Мансийский автономный округ — Югра', 6),
(64, 'Ямало-Ненецкий автономный округ', 6),
(65, 'Республика Алтай', 7),
(66, 'Республика Бурятия', 7),
(67, 'Республика Тыва', 7),
(68, 'Республика Хакасия', 7),
(69, 'Алтайский край', 7),
(70, 'Забайкальский край', 7),
(71, 'Красноярский край', 7),
(72, 'Иркутская область', 7),
(73, 'Кемеровская область', 7),
(74, 'Новосибирская область', 7),
(75, 'Омская область', 7),
(76, 'Томская область', 7),
(77, 'Республика Саха (Якутия)', 8),
(78, 'Камчатский край', 8),
(79, 'Приморский край', 8),
(80, 'Хабаровский край', 8),
(81, 'Амурская область', 8),
(82, 'Магаданская область', 8),
(83, 'Сахалинская область', 8),
(84, 'Еврейская автономная область', 8),
(85, 'Чукотский автономный округ', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.');

-- --------------------------------------------------------

--
-- Структура таблицы `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`) VALUES
(1, 'mikrit@mail.ru', 'mikrit', '0cba79277a975b13a12b856618825ef8b524a07dcbcf4d16fa44e5e55784b54b', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user_tokens`
--

CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  KEY `expires` (`expires`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `roles_users`
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

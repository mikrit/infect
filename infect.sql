-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 10 2018 г., 10:28
-- Версия сервера: 5.1.54-community
-- Версия PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `infect`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ambulathelps`
--

DROP TABLE IF EXISTS `ambulathelps`;
CREATE TABLE IF NOT EXISTS `ambulathelps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `bold` int(1) NOT NULL,
  `subtitle` int(1) NOT NULL DEFAULT '0',
  `formula` text,
  `use` text,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `dataambulathelps`
--

DROP TABLE IF EXISTS `dataambulathelps`;
CREATE TABLE IF NOT EXISTS `dataambulathelps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elem_id` int(11) NOT NULL,
  `value` double DEFAULT '0',
  `year` int(4) NOT NULL,
  `district_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `datagepatids`
--

DROP TABLE IF EXISTS `datagepatids`;
CREATE TABLE IF NOT EXISTS `datagepatids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elem_id` int(11) NOT NULL,
  `value` double DEFAULT '0',
  `year` int(4) NOT NULL,
  `district_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `datainfects`
--

DROP TABLE IF EXISTS `datainfects`;
CREATE TABLE IF NOT EXISTS `datainfects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elem_id` int(11) NOT NULL,
  `value` double DEFAULT '0',
  `year` int(4) NOT NULL,
  `district_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `datainfos`
--

DROP TABLE IF EXISTS `datainfos`;
CREATE TABLE IF NOT EXISTS `datainfos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elem_id` int(11) NOT NULL,
  `value` double DEFAULT '0',
  `year` int(4) NOT NULL,
  `district_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `datakdcs`
--

DROP TABLE IF EXISTS `datakdcs`;
CREATE TABLE IF NOT EXISTS `datakdcs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elem_id` int(11) NOT NULL,
  `value` double DEFAULT '0',
  `year` int(4) NOT NULL,
  `district_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `dataspids`
--

DROP TABLE IF EXISTS `dataspids`;
CREATE TABLE IF NOT EXISTS `dataspids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elem_id` int(11) NOT NULL,
  `value` double DEFAULT '0',
  `year` int(4) NOT NULL,
  `district_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `datastachelps`
--

DROP TABLE IF EXISTS `datastachelps`;
CREATE TABLE IF NOT EXISTS `datastachelps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elem_id` int(11) NOT NULL,
  `value` double DEFAULT '0',
  `year` int(4) NOT NULL,
  `district_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `districts`
--

INSERT INTO `districts` (`id`, `title`) VALUES
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
-- Структура таблицы `gepatids`
--

DROP TABLE IF EXISTS `gepatids`;
CREATE TABLE IF NOT EXISTS `gepatids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `bold` int(1) NOT NULL,
  `subtitle` int(1) NOT NULL DEFAULT '0',
  `formula` text,
  `use` text,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `infects`
--

DROP TABLE IF EXISTS `infects`;
CREATE TABLE IF NOT EXISTS `infects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `bold` int(1) NOT NULL,
  `subtitle` int(1) NOT NULL DEFAULT '0',
  `formula` text,
  `use` text,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `infos`
--

DROP TABLE IF EXISTS `infos`;
CREATE TABLE IF NOT EXISTS `infos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `bold` int(1) NOT NULL,
  `subtitle` int(1) NOT NULL DEFAULT '0',
  `formula` text,
  `use` text,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Дамп данных таблицы `infos`
--

INSERT INTO `infos` (`id`, `title`, `bold`, `subtitle`, `formula`, `use`, `yesno`) VALUES
(1, 'Обслуживаемое население:', 1, 1, 'id2+id3', '7', 0),
(2, 'взрослые', 0, 0, '', '1;8', 0),
(3, 'дети (0-17)', 0, 0, '', '1;9', 0),
(4, 'Количество случаев инфекционных заболеваний по данным отчетной формы №2', 1, 1, 'id5+id6', '7', 0),
(5, 'у взрослых (с 18 лет)', 0, 0, '', '4;8', 0),
(6, 'у детей (0-17)', 0, 0, '', '4;9', 0),
(7, 'Инфекционная заболеваемость на 100 тыс. населения', 0, 1, '(id4*100000)/id1', '', 0),
(8, 'среди взрослых', 0, 1, '(id5*100000)/id2', '', 0),
(9, 'среди детей', 0, 1, '(id6*100000)/id3', '', 0),
(10, 'Количество инфекционных стационаров', 0, 0, '', '', 0),
(11, 'Количество инфекционных отделений', 0, 1, 'id12+id13+id14', '', 0),
(12, 'смешанного назначения (для взрослых и детей)', 0, 0, '', '11', 0),
(13, 'специализированных для взрослых', 0, 0, '', '11', 0),
(14, 'специализированных для детей', 0, 0, '', '11', 0),
(15, 'Количество кабинетов инфекционных заболеваний (КИЗ)', 0, 1, 'id16+id17+id18', '', 0),
(16, 'смешанного назначения (для взрослых и детей)', 0, 0, '', '15', 0),
(17, 'специализированных для взрослых (по ф. 30)', 0, 0, '', '15', 0),
(18, 'специализированных для детей (по ф. 30)', 0, 0, '', '15', 0),
(19, 'Количество лабораторий в составе ЛПУ:', 0, 1, 'id20+id21+id21', '', 0),
(20, 'ПЦР-лаборатории', 0, 0, '', '19', 0),
(21, ' иммунологические (отделений по ф. 30, п.8)', 0, 0, '', '19', 0),
(22, 'микробиологические (бактериологические) (отделений по ф. 30, ф 8)', 0, 0, '', '19', 0),
(23, 'Врачи-инфекционисты', 1, 1, '', '', 0),
(24, 'Количество врачей инфекционистов в субъекте, включая сотрудников кафедр ', 0, 0, '', '', 0),
(25, 'Имеют категорию из них: ', 0, 1, 'id26+id27+id28', '', 0),
(26, 'высшая категория', 0, 0, '', '25', 0),
(27, 'первая категория', 0, 0, '', '25', 0),
(28, 'вторая категория', 0, 0, '', '25', 0),
(29, 'Средний возраст врачей-инфекционистов', 0, 0, '', '', 0),
(30, 'Количество врачей-инфекционистов до 50 лет в %', 0, 0, '', '', 0),
(31, 'Сведения об инфекционных отделениях (стационарах)', 1, 1, '', '', 0),
(32, 'Количество врачей-инфекционистов, работающих в отделениях (физических лиц)', 0, 0, '', '35', 0),
(33, 'Количество штатных должностей врачей-инфекционистов в отделениях', 0, 0, '', '', 0),
(34, 'Количество фактически занятых штатных должностей ', 0, 0, '', '35', 0),
(35, 'Коэффициент совместительства', 0, 1, 'id34/id32', '', 0),
(36, 'Количество клинических (госпитальных) эпидемиологов ', 0, 0, '', '', 0),
(37, 'Количество штатных должностей клинических (госпитальных) эпидемиологов ', 0, 0, '', '', 0),
(38, 'Сведения о кабинетах инфекционных заболеваний (КИЗ)', 1, 1, '', '', 0),
(39, 'Количество врачей-инфекционистов, работающих в КИЗ (физических лиц)', 0, 0, '', '42', 0),
(40, 'Количество штатных должностей врачей-инфекционистов в КИЗ', 0, 0, '', '', 0),
(41, 'Количество фактически занятых штатных должностей ', 0, 0, '', '42', 0),
(42, 'Коэффициент совместительства', 0, 1, 'id41/id39', '', 0),
(43, 'Средний и младший медицинский персонал', 1, 1, '', '', 0),
(44, 'Сведения об инфекционных отделениях (стационарах)', 1, 1, '', '', 0),
(45, 'Количество среднего персонала, работающего в отделениях (физических лиц)', 0, 0, '', '48', 0),
(46, 'Количество штатных должностей среднего персонала в отделениях', 0, 0, '', '', 0),
(47, 'Количество фактически занятых штатных должностей ', 0, 0, '', '48', 0),
(48, 'Коэффициент совместительства', 0, 1, 'id47/id45', '', 0),
(49, 'Количество младшего персонала, работающего в отделениях (физических лиц)', 0, 0, '', '52', 0),
(50, 'Количество штатных должностей младшего персонала в отделениях', 0, 0, '', '', 0),
(51, 'Количество фактически занятых штатных должностей ', 0, 0, '', '52', 0),
(52, 'Коэффициент совместительства', 0, 1, 'id51/id49', '', 0),
(53, 'Сведения о кабинетах инфекционных заболеваний (КИЗ)', 1, 1, '', '', 0),
(54, 'Количество среднего персонала, работающего в КИЗ (физических лиц)', 0, 0, '', '57', 0),
(55, 'Количество штатных должностей среднего персонала в КИЗ', 0, 0, '', '', 0),
(56, 'Количество фактически занятых штатных должностей ', 0, 0, '', '57', 0),
(57, 'Коэффициент совместительства', 0, 1, 'id56/id54', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `kdcs`
--

DROP TABLE IF EXISTS `kdcs`;
CREATE TABLE IF NOT EXISTS `kdcs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `bold` int(1) NOT NULL,
  `subtitle` int(1) NOT NULL DEFAULT '0',
  `formula` text,
  `use` text,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

DROP TABLE IF EXISTS `roles`;
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

DROP TABLE IF EXISTS `roles_users`;
CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles_users`
--

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `spids`
--

DROP TABLE IF EXISTS `spids`;
CREATE TABLE IF NOT EXISTS `spids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `bold` int(1) NOT NULL,
  `subtitle` int(1) NOT NULL DEFAULT '0',
  `formula` text,
  `use` text,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `stachelps`
--

DROP TABLE IF EXISTS `stachelps`;
CREATE TABLE IF NOT EXISTS `stachelps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `bold` int(1) NOT NULL,
  `subtitle` int(1) NOT NULL DEFAULT '0',
  `formula` text,
  `use` text,
  `yesno` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Дамп данных таблицы `stachelps`
--

INSERT INTO `stachelps` (`id`, `title`, `bold`, `subtitle`, `formula`, `use`, `yesno`) VALUES
(1, 'Число коек на конец отчетного периода', 1, 1, 'id2+id4+id6', '37;59', 0),
(2, 'специализированные (инфекционные)  взрослые ', 0, 0, '', '1;38', 0),
(3, 'из них дневной стационар', 0, 0, '', '', 0),
(4, 'специализированные (инфекционные) детские', 0, 0, '', '1;39', 0),
(5, 'из них дневной стационар', 0, 0, '', '', 0),
(6, 'смешанного назначения (инфекционные)', 0, 0, '', '1;40', 0),
(7, 'из них дневной стационар', 0, 0, '', '', 0),
(8, 'Среднегодовое число коек', 1, 1, 'id9+id10+id11', '30;33', 0),
(9, ' инфекционные койки смешанного назначения', 0, 0, '', '8;31', 0),
(10, 'инфекционных для взрослых', 0, 0, '', '8;31', 0),
(11, ' инфекционные детские койки ', 0, 0, '', '8;32', 0),
(12, 'Поступило больных', 1, 1, 'id13+id14', '27;33;34;41', 0),
(13, 'взрослых', 0, 0, '', '12;28;35;42', 0),
(14, 'детей', 0, 0, '', '12;29;36;43', 0),
(15, 'Выписано больных', 1, 1, 'id16+id17', '27;33;41;44', 0),
(16, 'взрослых', 0, 0, '', '15;28;42;45', 0),
(17, 'детей', 0, 0, '', '15;29;43;46', 0),
(18, 'Умерло всего больных, госпитализированных в инфекционное отделение (стационар)', 1, 1, 'id19+id20', '27;33;41;41', 0),
(19, 'всего взрослых', 0, 0, '', '18;28;42;42', 0),
(20, 'всего детей', 0, 0, '', '18;29;43;43', 0),
(21, 'Умерло больных от инфекционной патологии (в инфекц отделениях, стационарах)', 1, 1, 'id22+id23', '44;44', 0),
(22, 'от инфекционной патологии взрослых', 0, 0, '', '21;45;45', 0),
(23, 'от инфекционной патологии детей', 0, 0, '', '21;46;46', 0),
(24, 'Число койко/дней, проведенных больными в отделении (стационаре)', 1, 1, 'id25+id26', '27;30', 0),
(25, 'взрослыми', 0, 0, '', '24;28;31', 0),
(26, 'детьми', 0, 0, '', '24;29;32', 0),
(27, 'Средняя длительность пребывания больного на койке (средний койко/день)', 1, 1, 'id24/((id12+id15+id18)/2)', '', 0),
(28, 'взрослых', 0, 1, 'id25/((id13+id16+id19)/2)', '', 0),
(29, 'детей', 0, 1, 'id26/((id14+id17+id20)/2)', '', 0),
(30, 'Среднегодовая занятость больничной койки', 1, 1, 'id24/id8', '', 0),
(31, 'койки для взрослых (или смешанного назначения)', 0, 1, 'id25/(id9+id10)', '', 0),
(32, 'специализированной детской', 0, 1, 'id26/id11', '', 0),
(33, 'Оборот койки', 1, 1, '(id12+id15+id18)/2/id8', '', 0),
(34, 'Уровень госпитализации инфекционных больных ', 1, 1, 'id12*1000/info_1', '', 0),
(35, 'взрослых на 1000 чел.', 0, 1, 'id13*1000/info_2', '', 0),
(36, 'детей на 1000 чел.', 0, 1, 'id14*1000/info_3', '', 0),
(37, 'Обеспеченность койками на 10 тыс.', 1, 1, 'id1*10000/info_1', '', 0),
(38, 'взрослых', 0, 1, 'id2*10000/info_2', '', 0),
(39, 'детских', 0, 1, 'id4*10000/info_3', '', 0),
(40, 'смешанных', 0, 1, 'id6*10000/info_1', '', 0),
(41, 'Летальность общая (%)', 1, 1, '(100*id18)/(id18+id15+id12)', '', 0),
(42, 'взрослых', 0, 1, '(100*id19)/(id19+id16+id13)', '', 0),
(43, 'детских', 0, 1, '(100*id20)/(id20+id17+id14)', '', 0),
(44, 'Летальность от инфекционной патологии (%)', 1, 1, '(100*id21)/(id21+id15)', '', 0),
(45, 'взрослых', 0, 1, '(100*id22)/(id22+id16)', '', 0),
(46, 'детей', 0, 1, '(100*id23)/(id23+id17)', '', 0),
(47, 'Материально-техническое состояние инфекционных отделений (стационаров)', 1, 0, '', '', 0),
(48, 'количество мельцеровских боксов в отделениях (стационаре)*', 0, 0, '', '', 0),
(49, 'количество коек в мельцеровских боксах', 0, 0, '', '59', 0),
(50, 'количество полубоксов в отделениях (стационаре)**', 0, 0, '', '', 0),
(51, 'количество коек в полубоксах ', 0, 0, '', '', 0),
(52, 'количество боксированных палат***', 0, 0, '', '', 0),
(53, 'количество коек в боксированных палатах', 0, 0, '', '', 0),
(54, 'количество палат для инфекционных больных', 0, 0, '', '', 0),
(55, 'количество коек в палатах для инфекционных больных', 0, 0, '', '', 0),
(56, 'количество палат (отделений) интенсивной терапии для инфекционных больных', 0, 0, '', '', 0),
(57, 'количество коек в палатах (отделениях) интенсивной терапии для инфекционных больных', 0, 0, '', '', 0),
(58, 'количество смотровых боксов в приемном отделениях ', 0, 0, '', '59', 0),
(59, '% боксированности', 1, 1, '(id49+id58)*100/id1', '', 0),
(60, 'Умерло больных от инфекционной патологии (в инфекц. стационарах, отделениях)', 1, 1, 'id61+id62+id63+id64+id65+id66', '', 0),
(61, 'ОКИ', 0, 0, '', '60', 0),
(62, 'ОРВИ, грипп и их осложнения', 0, 0, '', '60', 0),
(63, 'Менингит', 0, 0, '', '60', 0),
(64, 'ГЛПС', 0, 0, '', '60', 0),
(65, 'Хронический вирусный гепатит', 0, 0, '', '60', 0),
(66, 'ВИЧ-инфицированных', 0, 0, '', '60', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `district_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`id`, `title`, `district_id`) VALUES
(1, 'Город федерального значения Москва', 1),
(2, 'Белгородская область', 1),
(3, 'Брянская область', 1),
(4, 'Владимирская область', 1),
(5, 'Воронежская область', 1),
(6, 'Ивановская область', 1),
(7, 'Калужская область', 1),
(8, 'Костромская область', 1),
(9, 'Курская область', 1),
(10, 'Липецкая область', 1),
(11, 'Московская область', 1),
(12, 'Орловская область', 1),
(13, 'Рязанская область', 1),
(14, 'Смоленская область', 1),
(15, 'Тамбовская область', 1),
(16, 'Тверская область', 1),
(17, 'Тульская область', 1),
(18, 'Ярославская область', 1),
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
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  `fio` varchar(255) NOT NULL,
  `district_id` int(11) DEFAULT '0',
  `subject_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`, `fio`, `district_id`, `subject_id`) VALUES
(1, 'mikrit@mail.ru', 'mikrit', '496259cb6b4d9f3d3eaaf530c8534b847acf4c15ff8c56c0f319a3e0211814ac', 48, 1515156452, 'Егор', 0, 0),
(2, 'test1@mail.ru', 'test1', '18c7a796f76b61d396800f649243f7a58ed370154a3b39af52c48a819d0f0040', 11, 1512926568, 'Видит всё', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user_tokens`
--

DROP TABLE IF EXISTS `user_tokens`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `user_agent`, `token`, `created`, `expires`) VALUES
(3, 1, '4967c12be75611dd5228cefc4da133e1652fc191', '772c31a52ab95de08c38221cf9000e300157f2f4', 1498739398, 1499948998),
(4, 1, '426e2d5a0dfe954005ba65bbfb4eb5121cf98e1f', 'c038fbf96fe269c8e5721033628efaf146170921', 1510125049, 1511334649),
(5, 1, '426e2d5a0dfe954005ba65bbfb4eb5121cf98e1f', '6f22b825de92d457481d22cd2241e18a4fda1c32', 1510125360, 1511334960),
(6, 1, '426e2d5a0dfe954005ba65bbfb4eb5121cf98e1f', 'cfbf597a5f9df34a07ad72eea7754fa7e97dd757', 1512889026, 1514098626),
(9, 1, '426e2d5a0dfe954005ba65bbfb4eb5121cf98e1f', 'b8021d41ccfcd3f3346118e4c220a0f8ed252ce6', 1512926635, 1514136235);

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

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 23 2016 г., 22:38
-- Версия сервера: 5.6.17
-- Версия PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `hotels`
--

-- --------------------------------------------------------

--
-- Структура таблицы `class_nomera`
--

CREATE TABLE IF NOT EXISTS `class_nomera` (
  `naimenov_id` int(11) NOT NULL AUTO_INCREMENT,
  `naimenov` varchar(50) NOT NULL,
  `cena_chel_sutki` decimal(10,0) NOT NULL,
  PRIMARY KEY (`naimenov_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `class_nomera`
--

INSERT INTO `class_nomera` (`naimenov_id`, `naimenov`, `cena_chel_sutki`) VALUES
(1, 'Эконом', '800'),
(2, 'Сьют', '1000'),
(3, 'Стандарт', '1034'),
(4, 'Стандарт улучшенный', '1100'),
(5, 'Семейный', '1180'),
(6, 'Дуплекс', '1500'),
(7, 'Полулюкс', '2100'),
(8, 'Полулюкс "Студия"', '2150'),
(9, 'Люкс', '2345'),
(10, 'Аппартаменты', '2500');

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `passport` varchar(20) NOT NULL,
  `familia` varchar(40) NOT NULL,
  `imya` varchar(40) NOT NULL,
  `otchestvo` varchar(50) NOT NULL,
  `adres` text NOT NULL,
  `telephone` varchar(20) NOT NULL,
  PRIMARY KEY (`passport`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`passport`, `familia`, `imya`, `otchestvo`, `adres`, `telephone`) VALUES
('\n                   ', '', '', '', '', ''),
('МТ 233372', 'Лесницкая', 'Ирина', 'Петровна', 'Московский проспект, 5', '(095)6180530'),
('МТ 264373', 'Попова', 'Ирина', 'Сергеевна', 'пр.Победы, 78', '(095)6080531'),
('МТ 384956', 'Миненко', 'Виктория', 'Александровна', 'пр.Людвига Свободы, 1', '(095)6080532'),
('МТ 453723', 'Бахмаров', 'Денис', 'Сергеевич', 'ул.Боевая, 34', '(095)6080533'),
('МТ 526384', 'Куценко', 'Илона', 'Михайловна', 'пр. Победы, 6', '(095)6080537');

-- --------------------------------------------------------

--
-- Структура таблицы `dolzhnost`
--

CREATE TABLE IF NOT EXISTS `dolzhnost` (
  `dolzhnost_id` int(11) NOT NULL AUTO_INCREMENT,
  `dolzhnost` varchar(60) NOT NULL,
  PRIMARY KEY (`dolzhnost_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `dolzhnost`
--

INSERT INTO `dolzhnost` (`dolzhnost_id`, `dolzhnost`) VALUES
(1, 'Администратор'),
(2, 'Бухгалтер'),
(3, 'Менеджер по бронированию'),
(4, 'Менеджер по групповому бронированию'),
(5, 'Помощник менеджера по персоналу'),
(6, 'Секретарь-референт'),
(7, 'Руководитель информатического отдела'),
(8, 'Помощник бухгалтера'),
(9, 'Специалист по управленческому учету'),
(10, 'Ведущий управляющий');

-- --------------------------------------------------------

--
-- Структура таблицы `nomer`
--

CREATE TABLE IF NOT EXISTS `nomer` (
  `nom_komnaty` int(11) NOT NULL,
  `etazh` int(11) NOT NULL,
  `kol_mest` int(11) NOT NULL,
  `tel_nomera` varchar(20) NOT NULL,
  `vremya_uborki` time NOT NULL,
  `naimenov_id` int(11) NOT NULL,
  PRIMARY KEY (`nom_komnaty`),
  UNIQUE KEY `nom_komnaty` (`nom_komnaty`),
  KEY `naimenov_id` (`naimenov_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nomer`
--

INSERT INTO `nomer` (`nom_komnaty`, `etazh`, `kol_mest`, `tel_nomera`, `vremya_uborki`, `naimenov_id`) VALUES
(1, 1, 5, '4656981', '10:30:00', 1),
(2, 1, 3, '4656982', '09:45:00', 2),
(3, 1, 2, '4656983', '10:30:00', 1),
(4, 1, 4, '4656984', '13:30:00', 5),
(5, 2, 2, '1234567', '06:56:05', 1),
(6, 1, 3, '4656986', '09:45:00', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `registr_id` int(11) NOT NULL AUTO_INCREMENT,
  `passport` varchar(20) NOT NULL,
  `data_zas` date NOT NULL,
  `data_vis` date NOT NULL,
  `nom_komnaty` int(11) NOT NULL,
  `oplata_id` int(11) NOT NULL,
  `sotrudnik_id` int(11) NOT NULL,
  PRIMARY KEY (`registr_id`),
  KEY `passport` (`passport`),
  KEY `nom_komnaty` (`nom_komnaty`),
  KEY `oplata_id` (`oplata_id`),
  KEY `sotrudnik_id` (`sotrudnik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `registration`
--

INSERT INTO `registration` (`registr_id`, `passport`, `data_zas`, `data_vis`, `nom_komnaty`, `oplata_id`, `sotrudnik_id`) VALUES
(1, 'МТ 233372', '2016-04-03', '2016-04-23', 2, 1, 4),
(2, 'МТ 264373', '2016-03-07', '2016-03-11', 1, 2, 3),
(3, 'МТ 384956', '2016-05-01', '2016-05-06', 3, 2, 2),
(4, 'МТ 453723', '2016-04-13', '2016-04-26', 4, 1, 1),
(7, 'МТ 384956', '2016-05-26', '2016-05-28', 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `sotrudnik`
--

CREATE TABLE IF NOT EXISTS `sotrudnik` (
  `sotrudnik_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_familia` varchar(40) NOT NULL,
  `s_imya` varchar(40) NOT NULL,
  `s_otchestvo` varchar(50) NOT NULL,
  `s_tel` varchar(20) NOT NULL,
  `dolzhnost_id` int(11) NOT NULL,
  PRIMARY KEY (`sotrudnik_id`),
  KEY `dolzhnost_id` (`dolzhnost_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `sotrudnik`
--

INSERT INTO `sotrudnik` (`sotrudnik_id`, `s_familia`, `s_imya`, `s_otchestvo`, `s_tel`, `dolzhnost_id`) VALUES
(1, 'Петрова', 'Надежда', 'Сергеевна', '(095)60-805-37', 1),
(2, 'Михайлова', 'Дина', 'Борисовна', '(095)60-805-39', 3),
(3, 'Грач', 'Дмитрий', 'Сергеевич', '(093)60-805-37', 6),
(4, 'Бабуркин', 'Всеволод', 'Дмитриевич', '(066)60-895-37', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `vid_oplaty`
--

CREATE TABLE IF NOT EXISTS `vid_oplaty` (
  `oplata_id` int(11) NOT NULL AUTO_INCREMENT,
  `oplata` varchar(40) NOT NULL,
  PRIMARY KEY (`oplata_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `vid_oplaty`
--

INSERT INTO `vid_oplaty` (`oplata_id`, `oplata`) VALUES
(1, 'Наличный расчет'),
(2, 'Безналичный расчет');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `nomer`
--
ALTER TABLE `nomer`
  ADD CONSTRAINT `nomer_ibfk_1` FOREIGN KEY (`naimenov_id`) REFERENCES `class_nomera` (`naimenov_id`);

--
-- Ограничения внешнего ключа таблицы `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`passport`) REFERENCES `client` (`passport`),
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`nom_komnaty`) REFERENCES `nomer` (`nom_komnaty`),
  ADD CONSTRAINT `registration_ibfk_3` FOREIGN KEY (`oplata_id`) REFERENCES `vid_oplaty` (`oplata_id`),
  ADD CONSTRAINT `registration_ibfk_4` FOREIGN KEY (`sotrudnik_id`) REFERENCES `sotrudnik` (`sotrudnik_id`);

--
-- Ограничения внешнего ключа таблицы `sotrudnik`
--
ALTER TABLE `sotrudnik`
  ADD CONSTRAINT `sotrudnik_ibfk_1` FOREIGN KEY (`dolzhnost_id`) REFERENCES `dolzhnost` (`dolzhnost_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Хост: sql4.freemysqlhosting.net
-- Время создания: Ноя 29 2015 г., 11:46
-- Версия сервера: 5.5.46-0ubuntu0.12.04.2
-- Версия PHP: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `sql497000`
--

-- --------------------------------------------------------

--
-- Структура таблицы `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `country` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `street` varchar(256) NOT NULL,
  `number_home` varchar(256) NOT NULL,
  `number_apartment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `addresses_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `country`, `city`, `street`, `number_home`, `number_apartment`) VALUES
(1, 2, 'Украина', 'Киев', 'Академика Янгеля', '20', 527);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `comments_user_id` (`user_id`),
  KEY `comments_post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `exercises`
--

CREATE TABLE IF NOT EXISTS `exercises` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `approach` int(10) unsigned NOT NULL,
  `repetition` int(10) unsigned NOT NULL,
  `value` float unsigned DEFAULT NULL,
  `result` float DEFAULT NULL,
  `intensity` tinyint(3) unsigned DEFAULT NULL,
  `kind_of_exercise` bigint(20) NOT NULL,
  `training_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `exercise_kind_of_exercise` (`kind_of_exercise`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `exercises`
--

INSERT INTO `exercises` (`id`, `approach`, `repetition`, `value`, `result`, `intensity`, `kind_of_exercise`, `training_id`) VALUES
(1, 1, 1, 5000, 1200, 3, 1, 1),
(2, 1, 1, 15, 2400, 3, 12, 2),
(3, 1, 5, NULL, NULL, 5, 4, 3),
(4, 1, 3, NULL, NULL, 5, 5, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `follower_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `followers_user_id` (`user_id`),
  KEY `followers_follower_id` (`follower_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follower_id`) VALUES
(1, 1, 2),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `kinds_of_exercises`
--

CREATE TABLE IF NOT EXISTS `kinds_of_exercises` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `measure_of_value` varchar(256) DEFAULT NULL,
  `measure_of_result` varchar(256) DEFAULT NULL,
  `kind_of_sport` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `kinds_of_exercises_kind_of_sport` (`kind_of_sport`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `kinds_of_exercises`
--

INSERT INTO `kinds_of_exercises` (`id`, `name`, `description`, `measure_of_value`, `measure_of_result`, `kind_of_sport`) VALUES
(1, 'Пробежка', 'Преодоление бегом произвольной дистанции.', 'м', 'сек', 1),
(2, 'Спринт 30м', 'Бег с максимально возможной скоростью на 30м.', NULL, 'сек', 1),
(3, 'Спринт 60м', 'Бег с максимально возможной скоростью на 60м.', NULL, 'сек', 1),
(4, 'Спринт 100м', 'Бег с максимально возможной скоростью на 100м, классическая олимпийская дисциплина.', NULL, 'сек', 1),
(5, 'Спринт 200м', 'Бег с максимально возможной скоростью на 200м, олимпийская дисциплина.', NULL, 'сек', 1),
(6, 'Спринт 400м', 'Бег с максимально возможной скоростью на 400м, олимпийская дисциплина.', NULL, 'сек', 1),
(7, 'Бег на среднюю дистанцию 800м', 'Бег с максимально возможной скоростью на 800м, олимпийская дисциплина.', NULL, 'сек', 1),
(8, 'Бег на среднюю дистанцию 1500м', 'Дисциплина относящаяся к средним дистанциям беговой легкоатлетической программы, олимпийская дисциплина.', NULL, 'сек', 1),
(9, 'Бег н длинную дистанцию 5000м', 'Дисциплина лёгкой атлетики, относится к бегу на длинные дистанции, олимпийская дисциплина.', NULL, 'сек', 1),
(10, 'Бег на длинную дистанцию 10000м', 'Дисциплина лёгкой атлетики, относится к бегу на длинные дистанции, олимпийская дисциплина.', NULL, 'сек', 1),
(11, 'Марафон', 'Дисциплина лёгкой атлетики, представляющая собой забег на дистанцию 42 километра 195 метров, классическая олимпийская дисциплина.', NULL, 'сек', 1),
(12, 'Велозаезд', 'Преодоление на велосипеде произвольной дистанции.', 'км', 'сек', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `kinds_of_sport`
--

CREATE TABLE IF NOT EXISTS `kinds_of_sport` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(256) NOT NULL,
  `icon` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `kinds_of_sport`
--

INSERT INTO `kinds_of_sport` (`id`, `name`, `description`, `type`, `icon`) VALUES
(1, 'Бег', 'Один из способов передвижения человека и животных; отличается наличием так называемой «фазы полёта» и осуществляется в результате сложной координированной деятельности скелетных мышц и конечностей. Для бега характерен, в целом, тот же цикл движений, что и при ходьбе, те же действующие силы и функциональные группы мышц. Отличием бега от ходьбы является отсутствие при беге фазы двойной опоры.', 'Циклический', NULL),
(2, 'Велоспорт', 'Перемещение по земле с использованием транспортных средств (велосипедов), движимых мускульной силой человека.', 'Циклический', NULL),
(3, 'Ходьба', 'Один из способов перемещения человека и животных; осуществляется в результате сложной координированной деятельности скелетных мышц и конечностей, в каждый момент времени хотя бы одна конечность касается земли.', 'Циклический', NULL),
(4, 'Беговые лыжи', 'Совокупность различных видов зимнего спорта, в соревнованиях по которым спортсмены используют  беговые лыжи.', 'Циклический', NULL),
(5, 'Плавание', 'Вид спорта или спортивная дисциплина, заключающаяся в преодолении вплавь за наименьшее время различных дистанций.', 'Циклический', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `likes_user_id` (`user_id`),
  KEY `likes_post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `follower_id` bigint(20) unsigned NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `messages_user_id` (`user_id`),
  KEY `messages_follower_id` (`follower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photos_post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text,
  `is_photos` tinyint(1) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `training_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`),
  KEY `posts_training_id` (`training_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `date`, `text`, `is_photos`, `user_id`, `training_id`) VALUES
(1, '2015-11-26 13:14:41', 'крытое поле MAX_FILE_SIZE (значение необходимо указывать в байтах) должно предшествовать полю для выбора файла, и его значение является максимально допустимым размером принимаемого файла в PHP. Рекомендуется всегда использовать эту переменную, так как она предотвращает тревожное ожидание пользователей при передаче огромных файлов, только для того, чтобы узнать, что файл слишком большой и передача фактически не состоялась. Помните, обойти это ограничение на стороне браузера достаточно просто, следовательно, вы не должны полагаться на то, что все файлы большего размера будут блокированы при помощи этой возможности. Это по большей части удобная возможность для пользователей клиентской части вашего приложения. Тем не менее, настройки PHP (на сервере) касательно максимального размера обойти невозможно. ', 0, 1, NULL),
(2, '2015-11-26 13:14:41', ' Данная возможность позволяет загружать как текстовые, так и бинарные файлы. С помощью PHP-функций авторизации и манипуляции файлами вы получаете полный контроль над тем, кому разрешено загружать файлы и что должно быть сделано после их загрузки.\r\n\r\nPHP способен получать загруженные файлы из любого браузера, совместимого со стандартом RFC-1867. ', 0, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` mediumtext NOT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `training`
--

CREATE TABLE IF NOT EXISTS `training` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `date` date NOT NULL,
  `total_time` time DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `feeling` tinyint(3) unsigned DEFAULT NULL,
  `description` text,
  `status` enum('done','sheduled','missed','template') NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `program_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `posts_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `training`
--

INSERT INTO `training` (`id`, `name`, `date`, `total_time`, `calories`, `feeling`, `description`, `status`, `user_id`, `program_id`) VALUES
(1, 'Еженевная пробежка', '2015-11-27', '30:00:00', 300, 5, 'Первобытный человек вставал с первыми лучами восходящего солнца. После недолгих сборов он уходил на охоту – нужно было успеть найти хорошую добычу до наступления темноты, ведь от этого зависело выживание всего рода. Сейчас добыча ждет нас на полках супермаркетов, а подниматься с рассветом нужно только некоторым представителям рабочих специальностей. Но несмотря на эти изменения в жизни, наш организм и сейчас выплескивает в кровь гормональный коктейль, позволяющий ощутить себя сильным, храбрым и находчивым охотником именно утром. Поэтому утро – лучшее время для пробежки.', 'done', 2, NULL),
(2, 'Уренний велозаезд', '2015-11-27', '40:00:00', 400, 5, 'Велозаезд – это ежегодное и самое массовое в Иркутске мероприятие для велосипедистов. Проводится с 2007 года. В 2014 году приехало 2519 человек. Участники проедут по центральным улицам города на велосипедах. Длина маршрута 5 км. Мероприятие полностью легальное и согласовано с администрацией города.', 'done', 1, NULL),
(3, 'Спринтерская тренировка', '2015-11-23', '30:00:00', 500, 5, 'Соточки', 'done', 2, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `birthday` date NOT NULL,
  `height` smallint(6) NOT NULL,
  `weight` smallint(6) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `adout_me` text,
  `avatar` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `birthday`, `height`, `weight`, `gender`, `adout_me`, `avatar`) VALUES
(1, 'Антон', 'Петров', '1995-04-12', 185, 80, 1, 'Типичный каток)', 'images/Anton.jpg'),
(2, 'Валерий', 'Мезеря', '1996-03-09', 173, 60, 1, 'Еще один каток', 'images/Valera.jpg');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

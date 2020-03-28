-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 28 2020 г., 16:21
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cr11_anton_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_anton_petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_anton_petadoption`;

-- --------------------------------------------------------

--
-- Структура таблицы `animals`
--

CREATE TABLE `animals` (
  `animId` int(11) NOT NULL,
  `name` varchar(63) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `type` enum('sm','lg','sen') DEFAULT 'sm',
  `website` varchar(255) DEFAULT NULL,
  `hobbies` varchar(255) DEFAULT NULL,
  `ad_date` date DEFAULT NULL,
  `loca` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `animals`
--

INSERT INTO `animals` (`animId`, `name`, `img`, `descr`, `type`, `website`, `hobbies`, `ad_date`, `loca`) VALUES
(1, 'Chuppy', 'img/Chuppy.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor. Nunc ultrices dolor ut ante efficitur accumsan.', 'sm', 'https://www.chuppy.facebook.com', NULL, NULL, 1),
(2, 'Johnson', 'img/Johnson.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor. Nunc ultrices dolor ut ante efficitur accumsan.', 'sm', 'https://www.johnson.facebook.com', NULL, NULL, 1),
(3, 'Teresa', 'img/Teresa.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor. Nunc ultrices dolor ut ante efficitur accumsan.', 'sm', 'https://www.teresa.facebook.com', NULL, NULL, 1),
(4, 'Tomas', 'img/Tomas.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor. Nunc ultrices dolor ut ante efficitur accumsan.', 'sm', 'https://www.tomas.facebook.com', NULL, NULL, 1),
(5, 'Akela', 'img/Akela.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor.', 'lg', NULL, 'run', NULL, 1),
(6, 'Fierce', 'img/Fierce.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor.', 'lg', NULL, 'eat, play', NULL, 1),
(7, 'Lady', 'img/Lady.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor.', 'lg', NULL, 'sleep', NULL, 1),
(8, 'Misha', 'img/Misha.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor.', 'lg', NULL, 'fishing', NULL, 1),
(9, 'Bart', 'img/Bart.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor.', 'sen', NULL, NULL, '2019-06-23', 1),
(10, 'Martin', 'img/Martin.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor.', 'sen', NULL, NULL, '2019-03-17', 1),
(11, 'Po', 'img/Po.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor.', 'sen', NULL, NULL, '2018-09-11', 1),
(12, 'Vasya', 'img/Vasya.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla egestas vulputate. Aliquam vitae urna a elit venenatis egestas ut eget tortor.', 'sen', NULL, NULL, '2014-02-07', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `location`
--

CREATE TABLE `location` (
  `locId` int(11) NOT NULL,
  `zip` int(11) NOT NULL DEFAULT 1010,
  `city` varchar(127) NOT NULL DEFAULT 'Vienna',
  `address` varchar(255) DEFAULT NULL,
  `loc_x` double(11,7) DEFAULT 48.2205998,
  `loc_y` double(11,7) DEFAULT 16.2399769
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `location`
--

INSERT INTO `location` (`locId`, `zip`, `city`, `address`, `loc_x`, `loc_y`) VALUES
(1, 1010, 'Vienna', '', 48.2205998, 16.2399769);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `emailUsr` varchar(255) NOT NULL,
  `passUsr` varchar(255) NOT NULL,
  `nameUsr` varchar(127) DEFAULT NULL,
  `user_type` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`userID`, `emailUsr`, `passUsr`, `nameUsr`, `user_type`) VALUES
(1, 'admin@mail.com', '65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5', 'admin', 'admin'),
(2, 'anton@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Anton', 'user'),
(3, 'lena@mail.com', '65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5', 'Lena', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animId`),
  ADD KEY `loca` (`loca`);

--
-- Индексы таблицы `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locId`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `emailUsr` (`emailUsr`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `animals`
--
ALTER TABLE `animals`
  MODIFY `animId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `location`
--
ALTER TABLE `location`
  MODIFY `locId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`loca`) REFERENCES `location` (`locId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

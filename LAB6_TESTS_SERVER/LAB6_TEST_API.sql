-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 10 2019 г., 11:56
-- Версия сервера: 5.6.38
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `LAB6_TEST_API`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Answer`
--

CREATE TABLE `Answer` (
  `ID_Answer` int(11) NOT NULL,
  `name_Answer` varchar(150) NOT NULL,
  `Question_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Answer`
--

INSERT INTO `Answer` (`ID_Answer`, `name_Answer`, `Question_ID`) VALUES
(1, 'Это C# модуль', 1),
(2, 'Это веб серверный язык программирования', 1),
(3, 'Просто разметка', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Question`
--

CREATE TABLE `Question` (
  `ID_Question` int(11) NOT NULL,
  `name_Question` text NOT NULL,
  `answer_Question` varchar(150) DEFAULT NULL,
  `Test_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Question`
--

INSERT INTO `Question` (`ID_Question`, `name_Question`, `answer_Question`, `Test_ID`) VALUES
(1, 'Что такое PHP?', 'Это веб серверный язык программирования', 2),
(9, 'Встроенная функция на PHP \"preg_split\" используется при ...', NULL, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Test`
--

CREATE TABLE `Test` (
  `ID_Test` int(11) NOT NULL,
  `name_Test` text NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Test`
--

INSERT INTO `Test` (`ID_Test`, `name_Test`, `User_ID`) VALUES
(2, 'Веб программирование', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE `User` (
  `ID_User` int(11) NOT NULL,
  `login_User` varchar(100) NOT NULL,
  `password_User` varchar(100) NOT NULL,
  `admin_User` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`ID_User`, `login_User`, `password_User`, `admin_User`) VALUES
(1, 'admin', 'admin', 1),
(2, 'user1', 'user1', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Answer`
--
ALTER TABLE `Answer`
  ADD PRIMARY KEY (`ID_Answer`);

--
-- Индексы таблицы `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`ID_Question`);

--
-- Индексы таблицы `Test`
--
ALTER TABLE `Test`
  ADD PRIMARY KEY (`ID_Test`);

--
-- Индексы таблицы `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`ID_User`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Answer`
--
ALTER TABLE `Answer`
  MODIFY `ID_Answer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Question`
--
ALTER TABLE `Question`
  MODIFY `ID_Question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `Test`
--
ALTER TABLE `Test`
  MODIFY `ID_Test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `User`
--
ALTER TABLE `User`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

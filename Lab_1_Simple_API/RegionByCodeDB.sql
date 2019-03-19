-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 19 2019 г., 17:42
-- Версия сервера: 5.6.38
-- Версия PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `RegionByCodeDB`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Region`
--

CREATE TABLE `Region` (
  `id_region` int(11) NOT NULL,
  `code_region` int(11) NOT NULL,
  `name_region` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Region`
--

INSERT INTO `Region` (`id_region`, `code_region`, `name_region`) VALUES
(1, 72, 'Тюмень'),
(2, 77, 'г. Москва'),
(3, 78, 'Санкт-Петербург'),
(4, 66, 'Свердловская область');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Region`
--
ALTER TABLE `Region`
  ADD PRIMARY KEY (`id_region`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Region`
--
ALTER TABLE `Region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

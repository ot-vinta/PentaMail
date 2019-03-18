-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 18 2019 г., 15:18
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `PentaMailDB`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Пользователи`
--

CREATE TABLE `Пользователи` (
  `Email` varchar(35) COLLATE utf8_bin NOT NULL,
  `Пароль` varchar(30) COLLATE utf8_bin NOT NULL,
  `Резервная_почта` varchar(35) COLLATE utf8_bin NOT NULL,
  `Открытый_ключ` int(10) NOT NULL,
  `Закрытый_ключ` int(10) NOT NULL,
  `Уровень_доступа` enum('u','a') COLLATE utf8_bin NOT NULL DEFAULT 'u',
  `Телефон` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `Пользователи`
--

INSERT INTO `Пользователи` (`Email`, `Пароль`, `Резервная_почта`, `Открытый_ключ`, `Закрытый_ключ`, `Уровень_доступа`, `Телефон`) VALUES
('admin@penta.ru', 'admin', 'none', 1, 1, 'u', '1111111111');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Пользователи`
--
ALTER TABLE `Пользователи`
  ADD PRIMARY KEY (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

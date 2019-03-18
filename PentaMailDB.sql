-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 18 2019 г., 18:02
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
-- Структура таблицы `Беседы`
--

CREATE TABLE `Беседы` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Название` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `Оформление`
--

CREATE TABLE `Оформление` (
  `Путь_к_фону` varchar(255) COLLATE utf8_bin NOT NULL,
  `Шрифт` varchar(35) COLLATE utf8_bin NOT NULL,
  `Email_пользователя` varchar(35) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `Папки`
--

CREATE TABLE `Папки` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Название` varchar(20) COLLATE utf8_bin NOT NULL,
  `Email_пользователя` varchar(35) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

-- --------------------------------------------------------

--
-- Структура таблицы `Пользователи_Беседы`
--

CREATE TABLE `Пользователи_Беседы` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Email_пользователя` varchar(35) COLLATE utf8_bin NOT NULL,
  `Id_беседы` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `Сообщения`
--

CREATE TABLE `Сообщения` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Заголовок` varchar(20) COLLATE utf8_bin NOT NULL,
  `Содержимое` varchar(255) COLLATE utf8_bin NOT NULL,
  `Дата_отправления` date NOT NULL,
  `Получатель` varchar(35) COLLATE utf8_bin NOT NULL,
  `Отправитель` varchar(35) COLLATE utf8_bin NOT NULL,
  `id_папки` int(10) UNSIGNED NOT NULL,
  `ЭЦП` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Беседы`
--
ALTER TABLE `Беседы`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `Оформление`
--
ALTER TABLE `Оформление`
  ADD PRIMARY KEY (`Путь_к_фону`),
  ADD KEY `Email_пользователя` (`Email_пользователя`);

--
-- Индексы таблицы `Папки`
--
ALTER TABLE `Папки`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Email_пользователя` (`Email_пользователя`);

--
-- Индексы таблицы `Пользователи`
--
ALTER TABLE `Пользователи`
  ADD PRIMARY KEY (`Email`);

--
-- Индексы таблицы `Пользователи_Беседы`
--
ALTER TABLE `Пользователи_Беседы`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Email_пользователя` (`Email_пользователя`,`Id_беседы`),
  ADD KEY `Id_беседы` (`Id_беседы`);

--
-- Индексы таблицы `Сообщения`
--
ALTER TABLE `Сообщения`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `id_папки` (`id_папки`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Беседы`
--
ALTER TABLE `Беседы`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Папки`
--
ALTER TABLE `Папки`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Пользователи_Беседы`
--
ALTER TABLE `Пользователи_Беседы`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Сообщения`
--
ALTER TABLE `Сообщения`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Оформление`
--
ALTER TABLE `Оформление`
  ADD CONSTRAINT `Оформление_ibfk_1` FOREIGN KEY (`Email_пользователя`) REFERENCES `Пользователи` (`Email`);

--
-- Ограничения внешнего ключа таблицы `Папки`
--
ALTER TABLE `Папки`
  ADD CONSTRAINT `Папки_ibfk_1` FOREIGN KEY (`Email_пользователя`) REFERENCES `Пользователи` (`Email`);

--
-- Ограничения внешнего ключа таблицы `Пользователи_Беседы`
--
ALTER TABLE `Пользователи_Беседы`
  ADD CONSTRAINT `Пользователи_Беседы_ibfk_1` FOREIGN KEY (`Email_пользователя`) REFERENCES `Пользователи` (`Email`),
  ADD CONSTRAINT `Пользователи_Беседы_ibfk_2` FOREIGN KEY (`Id_беседы`) REFERENCES `Беседы` (`Id`);

--
-- Ограничения внешнего ключа таблицы `Сообщения`
--
ALTER TABLE `Сообщения`
  ADD CONSTRAINT `Сообщения_ibfk_1` FOREIGN KEY (`id_папки`) REFERENCES `Папки` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

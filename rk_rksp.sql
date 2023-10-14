-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 15 2023 г., 00:15
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rk_rksp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `time` datetime NOT NULL,
  `avatar` int(11) NOT NULL,
  `login` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `message`, `time`, `avatar`, `login`) VALUES
(1, 'Hello there', '2023-05-17 22:27:06', 6, 'RokS'),
(2, 'Pretty nice weather today', '2023-05-21 15:47:00', 8, 'PipnL'),
(3, 'No I am not tired\r\nAnd don\'t need a pill\r\nJust if it not forwarded\r\nBy beast in the ci(e)ll\r\n', '2023-06-01 00:22:21', 5, 'oColins'),
(4, 'Without any flood pls', '2023-06-03 00:52:44', 1, 'Admin'),
(5, 'Haha,it\'s hard not to laugh because of you, guys.\r\nBut if to be honest,I like this website. It\'s better to work with style,but other things works fine', '2023-07-01 10:54:08', 10, 'Lolipop'),
(6, 'I\'ll be back', '2023-07-03 18:50:48', 6, 'RokS'),
(7, '5 out of 5 stars to this message posting', '2023-07-06 02:00:28', 8, 'PipnL'),
(18, 'Bububu😂', '2023-10-15 00:52:39', 6, 'RokS');

-- --------------------------------------------------------

--
-- Структура таблицы `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `avatar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_data`
--

INSERT INTO `user_data` (`id`, `login`, `password`, `avatar`) VALUES
(1, 'Admin', '123page', 1),
(2, 'RokS', '3355', 6),
(3, 'oColins', 'superDuper', 5),
(4, 'PipnL', 'pip', 8),
(5, 'Lolipop', 'haha', 10);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

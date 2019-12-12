-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Дек 12 2019 г., 20:01
-- Версия сервера: 5.7.26
-- Версия PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `catalog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `login` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id_admin`, `login`, `password`, `name`) VALUES
(1, 'admin', '$2y$10$aPBPQR1nvNiUs00nzjB6quANz2ScuIhKfolVoydaUC7CX23BH2QoS', 'Nikita Kozhevnikov');

-- --------------------------------------------------------

--
-- Структура таблицы `model`
--

CREATE TABLE `model` (
  `id_model` int(11) NOT NULL,
  `pattern` int(11) NOT NULL COMMENT 'выкройка',
  `size` int(11) NOT NULL,
  `em` text NOT NULL COMMENT 'расходный материал',
  `et` varchar(25) NOT NULL COMMENT 'время выполнения',
  `name` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `model`
--

INSERT INTO `model` (`id_model`, `pattern`, `size`, `em`, `et`, `name`, `images`) VALUES
(3, 45, 45, 'хлопок', '20.12.2020', 'футболка', '');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `login` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='таблица пользователя';

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `password`, `fullname`, `login`) VALUES
(28, '$2y$10$OOHr98El18STCw.Iof/zS.2x0oMWKSBPAS8Vvssz/se4Q/4Np9nJK', 'Nikita Kozhevnikov', 'nikita'),
(29, '$2y$10$PfR2nry4DK2Bb7vdGoTWi.yjAzUfLb9LvjuFrQNI8uj0.yMU/Pn.a', 'Kozhevnikov', 'user_1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id_model`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `model`
--
ALTER TABLE `model`
  MODIFY `id_model` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

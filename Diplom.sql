-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 17 2024 г., 10:33
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diplom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(39, 16, 11, 1),
(40, 16, 8, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `catalogue`
--

CREATE TABLE `catalogue` (
  `id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `catalogue`
--

INSERT INTO `catalogue` (`id`, `product_name`, `image_url`, `price`) VALUES
(1, 'SS season` 24 black jacket', 'img/2.jpg', 8999),
(2, 'CJ grey zip hoodie', 'img/4.jpg', 4999),
(3, 'CJ pink fleece jacket', 'img/5.jpg', 10999),
(4, 'SS season` 24 black leather coat', 'img/6.jpg', 12999),
(5, 'CJ dark grey zip hoodie', 'img/7.jpg', 4999),
(6, 'CJ black puffer', 'img/8.jpg', 14999),
(7, 'CJ grey zip hoodie women', 'img/9.jpg', 4499),
(8, 'CJ jeans pants women', 'img/10.jpg', 3999),
(9, 'CJ brown puffer', 'img/11.jpg', 25499),
(10, 'CJ knitted skimask', 'img/12.jpg', 3499),
(11, 'CJ blue jeans jacket', 'img/13.jpg', 11499),
(12, 'CJ custom hockey jersey', 'img/14.jpg', 6799);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `product_name`, `image_url`, `price`) VALUES
(4, 'SS season` 24 black jacket', 'img/2.jpg', 8999),
(5, 'CJ grey zip hoodie', 'img/4.jpg', 4999),
(6, 'CJ pink fleece jacket', 'img/5.jpg', 10999),
(8, 'Чехол для телефона', 'img/val300.jpg', 600),
(11, 'Чехол для телефона', 'Default_phone_case_0.jpg', 50000);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES
(1, '12', '12@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710'),
(16, '21', '21@21.ru', '3c59dc048e8850243be8079a5c74d079'),
(17, '32', '32322@32.ru', '6364d3f0f495b6ab9dcf8d3b5c6e0b01'),
(18, '12а', '12@gmail.com', '202cb962ac59075b964b07152d234b70'),
(19, 'wed', 'sai@mail.ru', '$2y$10$a24XhPwQgAq3f3rVS0m7zuzMRMOTxi6c4OkFreaHCRPxDVfXdFY6G'),
(31, '', 'sai@20', '123'),
(32, '', 'sai@20', '123'),
(33, '', 'sai@20', '123'),
(34, '', 'sai@20', '123'),
(35, '', 'sai@20', '123'),
(36, '', 'sai@20', '123'),
(37, '', 'sai@20', '123'),
(38, '', 'sai@20', '123'),
(39, '', 'sai@20', '123'),
(40, '', 'sai@20', '123'),
(41, '', 'sai@20', '123'),
(42, '', 'sai@20', '123'),
(43, '', 'sai@20', '123'),
(44, '', 'sai@20', '123'),
(45, '', 'sai@20', '123'),
(46, '', 'sai@20', '123'),
(47, '', 'sai@20', '123'),
(48, '', 'sai@20', '123'),
(49, '', 'sai@20', '123'),
(50, '', 'sai@20', '123'),
(51, '', 'sai@20', '123'),
(52, '', 'sai@20', '123'),
(53, '', 'sai@20', '123'),
(67, 'sai19', '12@gmail.com', '123'),
(68, 'sai19', '12@gmail.com', '$2y$10$dlEGnkmFQd0PUSbRrz3d4O.iF7E2jsFJIJ4YQUmkASNT9sz9.4wym'),
(69, 'admin', '123@mail.ru', '$2y$10$4pzRXO88AmaVmSAqdRI6nOu67Uy77HezCxaa1iuyIMRzz9kIVrsCy'),
(70, 'admin', '123@mail.ru', '$2y$10$2Bv37gz7RKuzJ4goisV8tux5vBywwxphZVEED7OU9aZICjC1OnFuC'),
(71, 'ivan', '123@mail.ru', '$2y$10$/iehOhuX9CL4kafoD7i5Y.Ho1jLlDlVcMMnnwCzKD0Exd.W4SrIHu'),
(72, 'ivan', '123@mail.ru', '$2y$10$I9JwkkG5D9vurmcZcSuLo.z45PpcjAHG0TAdCby2iPwdbyclpepC.'),
(73, 'wed12', '123@mfwsa', '$2y$10$oJeZuNd6nnCnZc3yxAERRe.2wb1P7OQiERj1pUaB6caSRUDr9mvhy'),
(74, 'sai19', 'ff@ff', '$2y$10$9f0oVEzmxFdVDDfrPOAB6ugjut97Z/fXQdWceb61mrHqUEcqCgrX2'),
(75, 'saeed', 'sairas1245@mail.ru', '123'),
(76, 'saeed', 'ff@ff', '$2y$10$F2XgNS5f3d83fhzDcKmiEeYXLalosKJRZWgXJ0Gju3GCVEbZ7LDG6'),
(77, '1', '23@mail.com', '$2y$10$Piv37Y0XoOobzM3MrPv2D.tGPyGJQ/R3FQwlD6s/KI.4sJOWB7U/q'),
(78, '2', '2@gmail.com', '$2y$10$zfqvA95Wel5bmmKHMALXzu8/pDm7..MSrWXKxM1l4ep6sXJYg5KaS'),
(79, '4', '4@mail.ru', '$2y$10$mXdBPaJk8WjGG81Jf.VZU.RDrfnxiU4Nx6YOWlfmBIkVNi4BizWDm'),
(80, '7', '7@mail.ru', '$2y$10$SOBYC.qca4yBf7X1j1vnNOEyHJOwfKEdoN55Qn41XVLKserSTATx2'),
(81, '9', '9@mail.ru', '9'),
(82, '5', '5@mail.ru', '5');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `catalogue`
--
ALTER TABLE `catalogue`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `catalogue`
--
ALTER TABLE `catalogue`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

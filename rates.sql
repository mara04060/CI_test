
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `homestead`
--

-- --------------------------------------------------------

--
-- Структура таблицы `rates`
--

CREATE TABLE `rates` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `nameBase` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'UAH',
  `valCurrency` float(10,4) NOT NULL,
  `dateTim` datetime NOT NULL COMMENT 'Data'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `rates`
--

INSERT INTO `rates` (`id`, `name`, `nameBase`, `valCurrency`, `dateTim`) VALUES
(1, 'USD', 'UAH', 25.6000, '2019-07-07 19:12:16'),
(2, 'EUR', 'UAH', 28.7000, '2019-07-07 19:18:56'),
(3, 'RUR', 'UAH', 0.3700, '2019-07-07 19:18:56'),
(4, 'BTC', 'USD', 10883.9580, '2019-07-07 19:18:56'),
(5, 'BTC', 'USD', 10906.6133, '2019-07-07 19:20:47');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`nameBase`,`valCurrency`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

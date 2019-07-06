
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
  `valCurrency` float NOT NULL,
  `dateTim` date NOT NULL COMMENT 'Data'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `rates`
--

INSERT INTO `rates` (`id`, `name`, `nameBase`, `valCurrency`, `dateTim`) VALUES
(78, 'USD', 'UAH', 25.65, '2019-07-05'),
(79, 'EUR', 'UAH', 28.8, '2019-07-05'),
(80, 'RUR', 'UAH', 0.37, '2019-07-05'),
(81, 'BTC', 'USD', 10425.7, '2019-07-05'),
(82, 'BTC', 'USD', 10482.8, '2019-07-05'),
(83, 'BTC', 'USD', 10563.2, '2019-07-05'),
(84, 'BTC', 'USD', 10597.3, '2019-07-05'),
(85, 'USD', 'UAH', 25.6, '2019-07-06'),
(86, 'EUR', 'UAH', 28.7, '2019-07-06'),
(87, 'RUR', 'UAH', 0.37, '2019-07-06'),
(88, 'BTC', 'USD', 10916.3, '2019-07-06'),
(89, 'BTC', 'USD', 10903.7, '2019-07-06'),
(90, 'BTC', 'USD', 10929.7, '2019-07-06'),
(91, 'BTC', 'USD', 10935.2, '2019-07-06');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`valCurrency`,`dateTim`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

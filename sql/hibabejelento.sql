-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Ápr 06. 14:53
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `hibabejelento`
--
CREATE DATABASE IF NOT EXISTS `hibabejelento` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hibabejelento`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `megnevezes` varchar(20) NOT NULL,
  `jellege` varchar(30) NOT NULL,
  `akadalyoz` tinyint(4) NOT NULL,
  `datum` date NOT NULL,
  `teremSzam` int(11) NOT NULL,
  `leiras` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `group` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `group`) VALUES
(1, 'Rózsa István', 'admin', 'admin', 1),
(9, 'Bob', 'VALAKI', '$2y$10$Ne2pZmCz21Oy4XX4EmPmiuiFavmDUc6dh', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

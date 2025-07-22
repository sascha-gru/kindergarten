-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 22. Jul 2025 um 06:17
-- Server-Version: 8.0.40
-- PHP-Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `login_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eltern`
--

CREATE TABLE `eltern` (
  `user_id` int NOT NULL,
  `e_vorname` varchar(100) DEFAULT NULL,
  `e_nachname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `eltern`
--

INSERT INTO `eltern` (`user_id`, `e_vorname`, `e_nachname`) VALUES
(14, 'test', 'omat'),
(15, 'tom', 'mot');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eltern_info`
--

CREATE TABLE `eltern_info` (
  `eltern_id` int NOT NULL,
  `kind_id` int NOT NULL,
  `e_vorname` varchar(100) DEFAULT NULL,
  `e_nachname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kind`
--

CREATE TABLE `kind` (
  `kind_id` int NOT NULL,
  `user_id` int NOT NULL,
  `k_vorname` varchar(100) DEFAULT NULL,
  `k_nachname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `kind`
--

INSERT INTO `kind` (`kind_id`, `user_id`, `k_vorname`, `k_nachname`) VALUES
(5, 15, 'divers', 'imernst'),
(7, 14, 'alem', 'derBoss');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter`
--

CREATE TABLE `mitarbeiter` (
  `user_id` int NOT NULL,
  `mitarbeiter_vorname` varchar(100) DEFAULT NULL,
  `mitarbeiter_nachname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`user_id`, `mitarbeiter_vorname`, `mitarbeiter_nachname`) VALUES
(21, 'der', 'boss'),
(22, 'boss', 'der');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `benutzername` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `rolle` enum('eltern','mitarbeiter','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `benutzername`, `passwort`, `rolle`) VALUES
(14, 'm', '$2y$10$qdDi4425D.bXXBBhOq6QxO/eg92ynscas0K/UH3RAAZ5qJoLUwJVy', 'eltern'),
(15, 's', '$2y$10$eFwBuLpBJHh49e5J/uJpk.mbmBiwMxZU/t/M0JGtqlwZKkJLQ7fJK', 'eltern'),
(21, 'mitarbeiter3', '$2y$10$YnqjeOmLgb9M.sxcb.jIY.W9KTvO.dVJEk/CWPTwG0o69/9JxtKxu', 'mitarbeiter'),
(22, 'mitarbeiter4', '$2y$10$VUdoEM6lq.v3t./R5o3J8.ry00CXBb2n2AgRXQZvYt4rnPFfVJdSy', 'mitarbeiter'),
(23, 'admin', '$2y$10$YcOWITCHkLo5kofNc6Ba.uk9Mg.EMMlcvlQL1JUwDno3Zv5g9wJmW', 'admin');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `eltern`
--
ALTER TABLE `eltern`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `eltern_info`
--
ALTER TABLE `eltern_info`
  ADD PRIMARY KEY (`eltern_id`),
  ADD KEY `kind_id` (`kind_id`);

--
-- Indizes für die Tabelle `kind`
--
ALTER TABLE `kind`
  ADD PRIMARY KEY (`kind_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `benutzername` (`benutzername`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `eltern_info`
--
ALTER TABLE `eltern_info`
  MODIFY `eltern_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `kind`
--
ALTER TABLE `kind`
  MODIFY `kind_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `eltern`
--
ALTER TABLE `eltern`
  ADD CONSTRAINT `eltern_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `eltern_info`
--
ALTER TABLE `eltern_info`
  ADD CONSTRAINT `eltern_info_ibfk_1` FOREIGN KEY (`kind_id`) REFERENCES `kind` (`kind_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `kind`
--
ALTER TABLE `kind`
  ADD CONSTRAINT `kind_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  ADD CONSTRAINT `mitarbeiter_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

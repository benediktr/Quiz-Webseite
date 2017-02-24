-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 24. Feb 2017 um 10:01
-- Server-Version: 10.1.16-MariaDB
-- PHP-Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `questions`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_animals_nature_easy`
--

CREATE TABLE `q_animals_nature_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_animals_nature_hard`
--

CREATE TABLE `q_animals_nature_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_animals_nature_normal`
--

CREATE TABLE `q_animals_nature_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_art_design_easy`
--

CREATE TABLE `q_art_design_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_art_design_hard`
--

CREATE TABLE `q_art_design_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_art_design_normal`
--

CREATE TABLE `q_art_design_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_bible_easy`
--

CREATE TABLE `q_bible_easy` (
  `id` int(255) NOT NULL,
  `question` int(255) NOT NULL,
  `r_answer` int(255) NOT NULL,
  `f_answer_1` int(255) NOT NULL,
  `f_answer_2` int(255) NOT NULL,
  `f_answer_3` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_bible_hard`
--

CREATE TABLE `q_bible_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_bible_normal`
--

CREATE TABLE `q_bible_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(2552) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_eating_drinking_easy`
--

CREATE TABLE `q_eating_drinking_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_eating_drinking_hard`
--

CREATE TABLE `q_eating_drinking_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_eating_drinking_normal`
--

CREATE TABLE `q_eating_drinking_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_geography_countries_easy`
--

CREATE TABLE `q_geography_countries_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_geography_countries_hard`
--

CREATE TABLE `q_geography_countries_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_geography_countries_normal`
--

CREATE TABLE `q_geography_countries_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_movies_easy`
--

CREATE TABLE `q_movies_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_movies_hard`
--

CREATE TABLE `q_movies_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_movies_normal`
--

CREATE TABLE `q_movies_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_music_easy`
--

CREATE TABLE `q_music_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_music_hard`
--

CREATE TABLE `q_music_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_music_normal`
--

CREATE TABLE `q_music_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_politics_easy`
--

CREATE TABLE `q_politics_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_politics_hard`
--

CREATE TABLE `q_politics_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_politics_normal`
--

CREATE TABLE `q_politics_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_science_easy`
--

CREATE TABLE `q_science_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_science_hard`
--

CREATE TABLE `q_science_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_science_normal`
--

CREATE TABLE `q_science_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_sport_freetime_easy`
--

CREATE TABLE `q_sport_freetime_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_sport_freetime_hard`
--

CREATE TABLE `q_sport_freetime_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_sport_freetime_normal`
--

CREATE TABLE `q_sport_freetime_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_technology_easy`
--

CREATE TABLE `q_technology_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_technology_hard`
--

CREATE TABLE `q_technology_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_technology_normal`
--

CREATE TABLE `q_technology_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_time_history_easy`
--

CREATE TABLE `q_time_history_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_time_history_hard`
--

CREATE TABLE `q_time_history_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_time_history_normal`
--

CREATE TABLE `q_time_history_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_tv_easy`
--

CREATE TABLE `q_tv_easy` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_tv_hard`
--

CREATE TABLE `q_tv_hard` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `q_tv_normal`
--

CREATE TABLE `q_tv_normal` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r_answer` varchar(255) NOT NULL,
  `f_answer_1` varchar(255) NOT NULL,
  `f_answer_2` varchar(255) NOT NULL,
  `f_answer_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `q_animals_nature_easy`
--
ALTER TABLE `q_animals_nature_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_animals_nature_hard`
--
ALTER TABLE `q_animals_nature_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_animals_nature_normal`
--
ALTER TABLE `q_animals_nature_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_art_design_easy`
--
ALTER TABLE `q_art_design_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_art_design_hard`
--
ALTER TABLE `q_art_design_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_art_design_normal`
--
ALTER TABLE `q_art_design_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_bible_easy`
--
ALTER TABLE `q_bible_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_bible_hard`
--
ALTER TABLE `q_bible_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_bible_normal`
--
ALTER TABLE `q_bible_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_eating_drinking_easy`
--
ALTER TABLE `q_eating_drinking_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_eating_drinking_hard`
--
ALTER TABLE `q_eating_drinking_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_eating_drinking_normal`
--
ALTER TABLE `q_eating_drinking_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_geography_countries_easy`
--
ALTER TABLE `q_geography_countries_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_geography_countries_hard`
--
ALTER TABLE `q_geography_countries_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_geography_countries_normal`
--
ALTER TABLE `q_geography_countries_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_movies_easy`
--
ALTER TABLE `q_movies_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_movies_hard`
--
ALTER TABLE `q_movies_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_movies_normal`
--
ALTER TABLE `q_movies_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_music_easy`
--
ALTER TABLE `q_music_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_music_hard`
--
ALTER TABLE `q_music_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_music_normal`
--
ALTER TABLE `q_music_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_politics_easy`
--
ALTER TABLE `q_politics_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_politics_hard`
--
ALTER TABLE `q_politics_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_politics_normal`
--
ALTER TABLE `q_politics_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_science_easy`
--
ALTER TABLE `q_science_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_science_hard`
--
ALTER TABLE `q_science_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_science_normal`
--
ALTER TABLE `q_science_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_sport_freetime_easy`
--
ALTER TABLE `q_sport_freetime_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_sport_freetime_hard`
--
ALTER TABLE `q_sport_freetime_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_sport_freetime_normal`
--
ALTER TABLE `q_sport_freetime_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_technology_easy`
--
ALTER TABLE `q_technology_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_technology_hard`
--
ALTER TABLE `q_technology_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_technology_normal`
--
ALTER TABLE `q_technology_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_time_history_easy`
--
ALTER TABLE `q_time_history_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_time_history_hard`
--
ALTER TABLE `q_time_history_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_time_history_normal`
--
ALTER TABLE `q_time_history_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_tv_easy`
--
ALTER TABLE `q_tv_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_tv_hard`
--
ALTER TABLE `q_tv_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `q_tv_normal`
--
ALTER TABLE `q_tv_normal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `q_animals_nature_easy`
--
ALTER TABLE `q_animals_nature_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_animals_nature_hard`
--
ALTER TABLE `q_animals_nature_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_animals_nature_normal`
--
ALTER TABLE `q_animals_nature_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_art_design_easy`
--
ALTER TABLE `q_art_design_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_art_design_hard`
--
ALTER TABLE `q_art_design_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_art_design_normal`
--
ALTER TABLE `q_art_design_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_bible_easy`
--
ALTER TABLE `q_bible_easy`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_bible_hard`
--
ALTER TABLE `q_bible_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_bible_normal`
--
ALTER TABLE `q_bible_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_eating_drinking_easy`
--
ALTER TABLE `q_eating_drinking_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_eating_drinking_hard`
--
ALTER TABLE `q_eating_drinking_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_eating_drinking_normal`
--
ALTER TABLE `q_eating_drinking_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_geography_countries_easy`
--
ALTER TABLE `q_geography_countries_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_geography_countries_hard`
--
ALTER TABLE `q_geography_countries_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_geography_countries_normal`
--
ALTER TABLE `q_geography_countries_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_movies_easy`
--
ALTER TABLE `q_movies_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_movies_hard`
--
ALTER TABLE `q_movies_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_movies_normal`
--
ALTER TABLE `q_movies_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_music_easy`
--
ALTER TABLE `q_music_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_music_hard`
--
ALTER TABLE `q_music_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_music_normal`
--
ALTER TABLE `q_music_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_politics_easy`
--
ALTER TABLE `q_politics_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_politics_hard`
--
ALTER TABLE `q_politics_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_politics_normal`
--
ALTER TABLE `q_politics_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_science_easy`
--
ALTER TABLE `q_science_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_science_hard`
--
ALTER TABLE `q_science_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_science_normal`
--
ALTER TABLE `q_science_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_sport_freetime_easy`
--
ALTER TABLE `q_sport_freetime_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_sport_freetime_hard`
--
ALTER TABLE `q_sport_freetime_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_sport_freetime_normal`
--
ALTER TABLE `q_sport_freetime_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_technology_easy`
--
ALTER TABLE `q_technology_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_technology_hard`
--
ALTER TABLE `q_technology_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_technology_normal`
--
ALTER TABLE `q_technology_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_time_history_easy`
--
ALTER TABLE `q_time_history_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_time_history_hard`
--
ALTER TABLE `q_time_history_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_time_history_normal`
--
ALTER TABLE `q_time_history_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_tv_easy`
--
ALTER TABLE `q_tv_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_tv_hard`
--
ALTER TABLE `q_tv_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `q_tv_normal`
--
ALTER TABLE `q_tv_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Lis 2021, 15:11
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mymess`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `ifRead` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `conversations`
--

INSERT INTO `conversations` (`id`, `id_user`, `id_sender`, `ifRead`) VALUES
(24, 1, 2, 1),
(25, 2, 1, 1),
(26, 7, 6, 1),
(27, 6, 7, 1),
(28, 8, 6, 0),
(29, 6, 8, 1),
(30, 5, 6, 0),
(31, 6, 5, 1),
(32, 0, 6, 1),
(33, 6, 0, 1),
(34, 6, 10, 1),
(35, 10, 6, 0),
(36, 8, 10, 1),
(37, 10, 8, 0),
(38, 5, 10, 1),
(39, 10, 5, 0),
(40, 6, 11, 1),
(41, 11, 6, 1),
(42, 5, 1, 1),
(43, 1, 5, 1),
(44, 5, 7, 1),
(45, 7, 5, 1),
(46, 5, 8, 1),
(47, 8, 5, 1),
(48, 5, 9, 1),
(49, 9, 5, 1),
(50, 5, 12, 1),
(51, 12, 5, 1),
(52, 5, 13, 1),
(53, 13, 5, 1),
(54, 5, 14, 1),
(55, 14, 5, 1),
(56, 5, 15, 1),
(57, 15, 5, 1),
(58, 5, 16, 1),
(59, 16, 5, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `text` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `sendDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `id_receiver`, `id_sender`, `text`, `sendDate`) VALUES
(31, 2, 1, 'siema', '2021-11-24 15:01:24'),
(32, 1, 2, 'o siema', '2021-11-24 15:01:24'),
(33, 2, 0, 'hmmm', '2021-11-24 15:01:24'),
(34, 2, 1, 'co tam ', '2021-11-24 15:01:24'),
(35, 1, 2, 'dobrze', '2021-11-24 15:01:24'),
(36, 7, 6, 'oooo siema', '2021-11-24 15:01:24'),
(37, 8, 6, 'halo ?', '2021-11-24 15:01:24'),
(38, 6, 5, 'siema kutasie', '2021-11-24 15:01:24'),
(39, 6, 5, 'co tam wariacie?', '2021-11-24 15:01:24'),
(40, 5, 6, 'Siema chuju nie myty', '2021-11-24 15:01:24'),
(41, 5, 6, 'niezle jest', '2021-11-24 15:01:24'),
(42, 6, 5, 'kocham ciebie ze zrobiles tego mymessa to nprawde super projekt, w wolnym czasie wruc to na githuba czyc os i ja pododaje smaczki frontendowe', '2021-11-24 15:01:24'),
(43, 6, 5, 'siem aheheh masz jakies ziulko na sell / ;PPpp', '2021-11-24 15:01:24'),
(44, 5, 6, 'ty mi tu nie slodz tylko zrub zeby na telefonie sie dalo', '2021-11-24 15:01:24'),
(45, 5, 6, 'mam krakersy', '2021-11-24 15:01:24'),
(46, 5, 6, 'ziolowe', '2021-11-24 15:01:24'),
(47, 6, 5, 'to wez to wrzuc na githuba i daj mi permisje to ogarne to ;)', '2021-11-24 15:01:24'),
(48, 5, 6, 'dobra lece robic commita', '2021-11-24 15:01:24'),
(49, 5, 6, 'ye', '2021-11-24 15:01:24'),
(50, 6, 5, 'chyba ze na gitlaba sie wrzuci bo teraz na praktykach na gitlabie robimy i fajnei sie robi w tym', '2021-11-24 15:01:24');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `prof_pic` varchar(20) NOT NULL DEFAULT 'user (1).png',
  `code` varchar(5) NOT NULL,
  `ifGroup` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `prof_pic`, `code`, `ifGroup`) VALUES
(1, 'user1', 'haslo', 'uzyt', 'user (1).png', 'abc13', 0),
(5, 'pdudo', 'haslo', 'pdudo', 'user (1).png', 'hehe1', 0),
(6, 'mieczejko', 'haslo', 'tak', 'user (1).png', 'hehe2', 0),
(7, 'szymek', 'haslo', 'szykon', 'man.png', 'hehe3', 0),
(8, 'jagna', 'haslo', 'jagnahomie', 'user (1).png', 'hehe4', 0),
(9, 'dzejkob', 'haslo', 'Odyn', 'user (1).png', 'hehe5', 0),
(10, '8awsG7au20241rhTiH', 'fE7IK4GXhUZXIItO5k', 'deksis', '10kotek.jpg', 'hAbUE', 1),
(12, 'xxx', 'xxx', 'ktos', 'user (1).png', 'abc14', 0),
(13, 'xxx', 'xxx', 'ktos2', 'user (1).png', 'abc15', 0),
(14, 'xxx', 'xxx', 'ktos3', 'user (1).png', 'abc16', 0),
(15, 'Uo5DdPeHumMk8IM6Gv', 'aXhrv027CuFxGUFhLi', 'grupa1', '15kotek.jpg', 'VIO0g', 1),
(16, 'oYqPLycp6DfcDDKSmO', 'rflcQVn9COQB675ssZ', 'grupa2', '16orzel.jpg', 'o68jB', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=554;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

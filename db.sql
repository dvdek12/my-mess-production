-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Lis 2021, 09:59
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
(30, 5, 6, 1),
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
  `text` mediumtext COLLATE utf8mb4_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `id_receiver`, `id_sender`, `text`) VALUES
(31, 2, 1, 'siema'),
(32, 1, 2, 'o siema'),
(33, 2, 0, 'hmmm'),
(34, 2, 1, 'co tam '),
(35, 1, 2, 'dobrze'),
(36, 7, 6, 'oooo siema'),
(37, 8, 6, 'halo ?'),
(38, 6, 5, 'siema kutasie'),
(39, 6, 5, 'co tam wariacie?'),
(40, 5, 6, 'Siema chuju nie myty'),
(41, 5, 6, 'niezle jest'),
(42, 6, 5, 'kocham ciebie ze zrobiles tego mymessa to nprawde super projekt, w wolnym czasie wruc to na githuba czyc os i ja pododaje smaczki frontendowe'),
(43, 6, 5, 'siem aheheh masz jakies ziulko na sell / ;PPpp'),
(44, 5, 6, 'ty mi tu nie slodz tylko zrub zeby na telefonie sie dalo'),
(45, 5, 6, 'mam krakersy'),
(46, 5, 6, 'ziolowe'),
(47, 6, 5, 'to wez to wrzuc na githuba i daj mi permisje to ogarne to ;)'),
(48, 5, 6, 'dobra lece robic commita'),
(49, 5, 6, 'ye'),
(50, 6, 5, 'chyba ze na gitlaba sie wrzuci bo teraz na praktykach na gitlabie robimy i fajnei sie robi w tym'),
(51, 5, 6, '<h1>git</h1'),
(52, 6, 5, 'yeeee'),
(53, 6, 5, 'wychodzisz dzis?'),
(54, 5, 6, 'wychodze'),
(55, 6, 5, ''),
(56, 5, 6, 'w sensie nie wiem czy natloka'),
(57, 6, 5, 'git mam blad'),
(58, 5, 6, 'jaki'),
(59, 6, 5, 'jak wysle pusta wiad to wysyla sie  a nie powinna'),
(60, 5, 6, 'a wiem o tym'),
(61, 5, 6, 'trzeba bledow poszukac'),
(62, 5, 6, 'jak najwiecej'),
(63, 6, 5, 'moge wrzucic na QA dla seby u nas ;))))'),
(64, 5, 6, '<a href=\"www.google.com\">kliknij</a>'),
(65, 6, 5, 'dobra ja lece ogarniac logging do pythona nauuura'),
(66, 5, 6, 'dobra'),
(67, 6, 5, ''),
(68, 5, 6, 'trzymaj sie d'),
(69, 5, 6, 'siema'),
(70, 8, 6, 'jagna'),
(71, 8, 6, 'zyj'),
(72, 6, 0, 'hej'),
(73, 6, 0, 'co tam'),
(74, 6, 0, 'slodziaku'),
(75, 5, 6, 'jak tam tlok'),
(76, 5, 6, 'ðŸ˜¥'),
(77, 5, 6, 'ðŸš¬ðŸš¬ðŸš¬ðŸ˜ðŸ˜‘ðŸ˜'),
(78, 6, 8, '.'),
(79, 6, 8, 'hm'),
(80, 6, 8, 'wtf'),
(131, 6, 5, 'ERROR 4025: HACKED, SEND ME PIN OF CARD '),
(132, 6, 5, 'ERROR 4026: HACKED, SEND ME PIN OF CARD '),
(133, 6, 5, 'ERROR 4027: HACKED, SEND ME PIN OF CARD '),
(134, 6, 5, 'ERROR 4028: HACKED, SEND ME PIN OF CARD '),
(135, 6, 5, 'ERROR 4029: HACKED, SEND ME PIN OF CARD '),
(136, 6, 5, 'ERROR 4030: HACKED, SEND ME PIN OF CARD '),
(137, 6, 5, 'ERROR 4031: HACKED, SEND ME PIN OF CARD '),
(138, 6, 5, 'ERROR 4032: HACKED, SEND ME PIN OF CARD '),
(139, 6, 5, 'ERROR 4033: HACKED, SEND ME PIN OF CARD '),
(140, 6, 5, 'ERROR 4034: HACKED, SEND ME PIN OF CARD '),
(543, 8, 6, 'ðŸ˜ºðŸ˜ºðŸ˜ºðŸ˜º'),
(542, 10, 6, 'siema'),
(541, 10, 6, 'ye'),
(540, 10, 5, 'ðŸ˜˜ðŸ˜˜'),
(539, 10, 5, 'ðŸ˜˜ðŸ˜˜ðŸ˜˜ðŸ˜˜ðŸ˜˜ðŸ˜˜'),
(484, 5, 6, 'przemek chodz tu'),
(485, 5, 6, 'juz dziala wszystko'),
(486, 5, 6, 'ðŸ’²ðŸ’²ðŸ’²ðŸ’²ðŸ’²ðŸ’¹ðŸ’³ðŸ’³ðŸ’°ðŸ’°ðŸ’·ðŸ’¶ðŸ’¶ðŸ’¶ðŸ’·'),
(487, 6, 5, 'uyguguy'),
(488, 5, 6, 'hej'),
(489, 5, 6, 'ðŸ–•ðŸ–•ðŸ–•ðŸ–•'),
(490, 5, 6, 'jak to dalej strone refreshuje'),
(491, 6, 5, 'refreshuje dalej strone'),
(492, 5, 6, 'w sensie ze non stop ?'),
(493, 5, 6, 'co sekunde ?'),
(494, 6, 5, 'i juz widze problem jeden bo patrz jak pisze wiadomosc dluzsza i ty wyslesz w tym czasie wiadomosc to mi refreshuje i jest pusty input'),
(495, 6, 5, 'nie nonstop'),
(496, 5, 6, 'okurwa'),
(497, 5, 6, 'bez kitu'),
(498, 6, 5, 'ty ale dobra dzisiaj dawaj dc ogarniemy te repo z tym bo ja bym juz porobil smaczki jakies przejscia animacje przyjemne dla oka'),
(499, 5, 6, 'noooo'),
(500, 5, 6, 'ale kurde'),
(501, 5, 6, 'ciezko bedzie to naprtawic'),
(502, 5, 6, 'ðŸ˜±ðŸ˜±ðŸ˜±'),
(503, 6, 5, 'a ty dodales ajaxa wkoncu?'),
(504, 6, 5, 'ðŸ‰'),
(505, 5, 6, 'tak'),
(506, 5, 6, 'musze wykombinowac'),
(507, 5, 6, 'jak js wyswietlic wiadomosci'),
(508, 5, 6, 'i u siebie dodalem zmiane nazwy'),
(509, 7, 6, 'ðŸ˜˜'),
(510, 10, 6, 'czesc'),
(511, 10, 8, 'czesc'),
(512, 10, 6, 'dziala wszystko niezle â˜¹'),
(513, 6, 8, 'ujkbbj'),
(514, 10, 5, 'siemano czarnuchy'),
(515, 10, 6, 'siemaaaa'),
(516, 10, 5, 'niggers'),
(517, 10, 5, 'nigga '),
(518, 10, 6, 'ðŸ˜Ž'),
(519, 10, 5, 'alt girl nie zabroni mowic mi nigga'),
(520, 10, 5, 'jestem nigga w 2%'),
(521, 10, 5, 'musimy zrobic meeting '),
(522, 10, 6, 'musimy nigga'),
(523, 10, 6, 'jagna tu nir wejdzir'),
(524, 10, 6, 'mozemy pisac co chcemy'),
(525, 10, 5, 'ehheheheh emo emo'),
(526, 10, 5, 'sprzedamm 5g kokainy'),
(527, 10, 6, 'hehe'),
(528, 10, 5, 'mymess > messenger jakis od fb'),
(529, 10, 6, 'nie ma podjazdu '),
(530, 10, 5, 'ty ja wiem jakie animacje pododaje seksowne'),
(531, 10, 5, 'przy wysylaniu wiadomosci zeby smooth bylo'),
(532, 10, 6, 'ooooo'),
(533, 10, 6, 'dobts'),
(534, 10, 5, 'a i dodaj kacpi usuwanie wiadomosci jeszcze moze i godzine o ktorej wyslano'),
(535, 10, 5, 'taki pomysl'),
(536, 10, 6, 'akurat mi sie skoncxyly pomysly co dodac'),
(537, 10, 5, 'dobra ja lece ucyc sie okienkowego pythona '),
(538, 10, 5, 'zgadamy sie na discordzie pozniej co ?');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=544;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

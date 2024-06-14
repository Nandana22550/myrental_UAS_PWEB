-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2024 pada 02.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rental`
--
CREATE DATABASE IF NOT EXISTS `db_rental` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_rental`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kaset`
--

CREATE TABLE `kaset` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kaset`
--

INSERT INTO `kaset` (`id`, `judul`, `genre`, `deskripsi`, `kategori`, `img`) VALUES
(4, 'Black', 'Fps', 'Black is a 2006 first-person shooter video game developed by Criterion Games and published by Electronic Arts. It was released for the PlayStation 2 and Xbox in February 2006. The player assumes control of Jack Kellar, a black ops agent being interrogated about his previous missions involving a terrorist operation. Gameplay involves players confronting enemies by using firearms and grenades. The game is notable for its heavily stylized cinema-inspired action as well as its sound quality and focus on destructive effects during gameplay.', 'PS2', '120620242111054424779-black-playstation-2-front-cover.jpg'),
(5, 'Resident Evil 4', 'Action', 'Resident Evil 4[b] is a survival horror game by Capcom, originally released for the GameCube in 2005. Players control the special agent Leon S. Kennedy on a mission to rescue the US presidents daughter, Ashley Graham, who has been kidnapped by a religious cult in rural Spain. Leon fights hordes of enemies infected by a mind-controlling parasite and reunites with the spy Ada Wong. In a departure from the fixed camera angles and slower gameplay of previous Resident Evil games, Resident Evil 4 features a dynamic camera system and action-oriented gameplay.', 'PS2', '120620242112344480917-resident-evil-4-playstation-2-front-cover.jpg'),
(6, 'The Godfather', 'Action', 'The Godfather is a 2006 open world action-adventure video game developed by EA Redwood Shores and published by Electronic Arts. It was originally released in March 2006 for Microsoft Windows, PlayStation 2, and Xbox. It was later released for the PlayStation Portable (as The Godfather: Mob Wars), Xbox 360, Wii (as The Godfather: Blackhand Edition), and PlayStation 3 (as The Godfather: The Dons Edition).', 'PS2', '12062024211343519LcsTrICL._AC_UF1000,1000_QL80_.jpg'),
(7, 'Alone in the Dark', 'Horror', 'Alone in the Dark is a survival horror video game published by Atari Interactive and is the fifth installment of the series under the same name. The game was released for Microsoft Windows, PlayStation 2, Xbox 360 and Wii in Europe, North America, and Australia in June 2008. The PlayStation 3 version, titled Alone in the Dark: Inferno, was released in November 2008 and includes several enhancements from the other versions. The Windows, Xbox 360 and PlayStation 3 versions were released by Electronic Arts in Japan on December 25, 2008', 'PS3', '12062024211542Alone-in-the-Dark.jpg'),
(8, 'Assassins Creed II', 'Adventure', 'Assassins Creed II is a 2009 action-adventure video game developed by Ubisoft Montréal and published by Ubisoft. It is the second major installment in the Assassins Creed series, and the sequel to 2007s Assassins Creed. The game was first released on the PlayStation 3 and Xbox 360 in November 2009, and was later made available on Microsoft Windows in March 2010 and OS X in October 2010. Remastered versions of the game and its two sequels, Assassins Creed: Brotherhood and Assassins Creed: Revelations, were released as part of The Ezio Collection compilation for the PlayStation 4 and Xbox One on November 15, 2016, and for the Nintendo Switch on February 17, 2022.', 'PS3', '12062024211649Assassins-Creed-II.jpg'),
(9, 'Uncharted 4: A Thief End', 'Action', 'Uncharted 4: A Thief End is a 2016 action-adventure game developed by Naughty Dog and published by Sony Computer Entertainment. It is the fourth main entry in the Uncharted series. Set several years after the events of Uncharted 3: Drake Deception, players control Nathan Drake, a former treasure hunter coaxed out of retirement by his presumed-dead brother Samuel. With Nathans longtime partner, Victor Sullivan, they search for clues to the location of Henry Averys long-lost treasure. A Thiefs End is played from a third-person perspective, and incorporates platformer elements. Players solve puzzles and use firearms, melee combat, and stealth to combat enemies. In the online multiplayer mode, up to ten players engage in co-operative and competitive modes.', 'PS4', '1206202421183015018614_f9c2c73b-9e65-4ec1-a86e-d125f817b3a9_1203_1500.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sewa`
--

CREATE TABLE `sewa` (
  `id` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `id_kaset` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sewa`
--

INSERT INTO `sewa` (`id`, `id_users`, `id_kaset`, `status`) VALUES
(10, 3, 4, 'Disetujui'),
(11, 3, 9, 'Menunggu'),
(12, 4, 8, 'Menunggu'),
(13, 3, 7, 'Ditolak'),
(14, 10, 6, 'Menunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', '123', 'Admin'),
(2, 'super', 'super@gmail.com', '123', 'SuperAdmin'),
(3, 'user', 'user@gmail.com', '123', 'User'),
(4, 'tes', 'tes@gmail.com', '123', 'User'),
(5, 'tes1', 'tes1@gmail.com', '123', 'User'),
(6, 'tes2', 'tes2@gmail.com', '123', 'User'),
(7, 'tes3', 'tes3@gmail.com', '123', 'User'),
(10, 'asep', 'asep@gmail.com', '123', 'User');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kaset`
--
ALTER TABLE `kaset`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kaset`
--
ALTER TABLE `kaset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

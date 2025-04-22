-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 20. 10:43
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `travel_agency`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `accommodation`
--

CREATE TABLE `accommodation` (
  `id` int(11) NOT NULL,
  `name_of_accommoda` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `rating` char(5) DEFAULT NULL,
  `price_per_night_per_per` bigint(20) NOT NULL,
  `destination_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `accommodation`
--

INSERT INTO `accommodation` (`id`, `name_of_accommoda`, `address`, `rating`, `price_per_night_per_per`, `destination_id`) VALUES
(1, 'Hotel Paris', 'Champs-Élysées 10, Párizs', '★★★★', 50000, 1),
(2, 'London Inn', 'Oxford Street 5, London', '★★★', 40000, 2),
(5, 'MinasMorgul', 'Középfölde', '★★★★★', 125000, 3),
(6, 'Dede', '', NULL, 5, NULL),
(7, 'Zsiszik', '', NULL, 96, NULL),
(10, 'Kolosseum motel', '', NULL, 165151, 4),
(13, 'Maci tábor', '', NULL, 25000, 7),
(14, 'Getto', '', NULL, 12, 1),
(15, 'Rádió torony', '', NULL, 36000, 7);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `clients_id` int(11) NOT NULL,
  `trips_id` int(11) NOT NULL,
  `accommodation_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `number_of_passengers` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `bookings`
--

INSERT INTO `bookings` (`id`, `clients_id`, `trips_id`, `accommodation_id`, `booking_date`, `number_of_passengers`, `total_price`) VALUES
(19, 3, 1, 1, '2025-03-23', 6, 1500000),
(26, 3, 4, 5, '2025-04-08', 4, 1500000),
(27, 3, 1, 1, '2025-04-08', 10, 2500000),
(28, 3, 11, 1, '2025-04-08', 20, 3400000),
(30, 3, 2, 2, '2025-04-14', 6, 1740000),
(31, 3, 2, 2, '2025-04-14', 4, 1160000),
(32, 3, 2, 2, '2025-04-14', 2, 580000),
(33, 3, 4, 5, '2025-04-14', 8, 3000000),
(36, 3, 44, 15, '2025-04-18', 3, 29718000);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `password`) VALUES
(3, 'Sári', 'sarika@gmail.com', '$2y$10$xkR1dzXA3rImlgxjMX40wOhLPnnR1a3Mo2ylNLBC40erZ/l87Cu1C'),
(6, 'pekedli', 'pekedli@gmail.com', '$2y$10$EJVNh6qhIqKLURm4BC31x.AnywcKm4jdNp1s1//ken55PV7E8WbAW');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `user_id`, `name`, `email`, `message`, `created_at`) VALUES
(1, NULL, 'Sikukuk', 'pika@yahoo.com', 'Eladó bojler!', '2025-04-20 07:55:37'),
(2, NULL, 'dasc', 'cadsc@gmail.com', 'fe', '2025-04-20 07:57:56'),
(4, 3, 'Sarika', 'sarika@gmail.com', 'Fasza volt minden!', '2025-04-20 08:19:10');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `destinations`
--

INSERT INTO `destinations` (`id`, `destination`, `city`, `country`) VALUES
(1, 'Párizs', 'Párizs', 'Franciaország'),
(2, 'London', 'London', 'Egyesült Királyság'),
(3, 'Minas Morgul', 'Minas Morgul', 'Középfölde'),
(4, 'Róma', 'Róma', 'Olaszország'),
(5, 'Zsizsik', 'Pekedli', 'Dikol'),
(7, 'Endor', 'Tábor', 'Galaktikus Birodalom');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `bookings_id` int(11) NOT NULL,
  `date_of_payment` date NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `method_of_payment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `departure` date NOT NULL,
  `arrival` date NOT NULL,
  `price_per_person` bigint(20) NOT NULL,
  `available_spots` bigint(20) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `full_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `trips`
--

INSERT INTO `trips` (`id`, `destination_id`, `departure`, `arrival`, `price_per_person`, `available_spots`, `image_url`, `short_description`, `full_description`) VALUES
(1, 1, '2025-06-10', '2025-06-20', 200000, 10, 'paris.jpg', 'Romantikus városnézés Párizsban, Eiffel-toronnyal és kulturális programokkal.', NULL),
(2, 2, '2025-07-15', '2025-07-25', 250000, 8, 'london.jpg', 'Fedezd fel Londont, a híres Big Ben, London Eye és a Temze mentén!', NULL),
(4, 3, '2025-07-15', '2025-07-25', 250000, 8, 'minas_morgul.jpg', 'Fedezd fel ezt az igazán romantikus és hidegrázó helyet, látogasd meg a nazgulok termét, és fedezd fel a híres banyapók kamráit!', NULL),
(11, 4, '2025-07-01', '2025-07-07', 120000, 8, 'rome.jpg', 'Történelmi kirándulás Rómába.', 'Fedezd fel az ókori Róma nevezetességeit: a Colosseum, a Forum Romanum és a Vatikán világhírű látnivalói várnak rád.'),
(44, 7, '2025-04-26', '2025-05-11', 9870000, 20, 'endor.jpg', 'Fedezd fel az Endor sűrű erdőit és ismerd meg az Ewokok barátságos világát egy varázslatos űrutazás során!', 'Csatlakozz hozzánk egy felejthetetlen utazásra a Galaxis peremén fekvő Endor holdra! Ez a különleges program elvezet a fák lombjai fölé épített Ewok falvakba, ahol megismerkedhetsz ezzel az ősi és bölcs fajjal. A program részeként túrázhatsz az endori erdők mélyén, ahol a növényzet szinte saját életet él, és felfedezheted a birodalmi múlt nyomait is – köztük egy elhagyatott lépegetőroncsot és egy titkos lázadó bázist.\r\n\r\nAz utazás során profi idegenvezetőnk gondoskodik róla, hogy minden mozzanat izgalmas és biztonságos legyen. Esténként a csillagok alatt, ewok dobkíséret mellett pihenhetsz, miközben a galaktikus történetek hallgatása közben újraálmodhatod a csillagok háborúját.');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `accommodation`
--
ALTER TABLE `accommodation`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- A tábla indexei `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_id` (`clients_id`),
  ADD KEY `trips_id` (`trips_id`),
  ADD KEY `accommodation_id` (`accommodation_id`);

--
-- A tábla indexei `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A tábla indexei `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_id` (`bookings_id`);

--
-- A tábla indexei `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `accommodation`
--
ALTER TABLE `accommodation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT a táblához `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT a táblához `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`trips_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodation` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `contact_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL;

--
-- Megkötések a táblához `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`bookings_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 02 juil. 2019 à 21:40
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `restaurant`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `blog`
--

INSERT INTO `blog` (`id`, `title`, `content`, `date`) VALUES
(16, 'CÃ©lÃ©bration de la saint Valentin', 'La saint Valentin approche Ã  grand pas, si vous venez chez nous avec votre compagnon vous bÃ©nÃ©ficierez d\'une rÃ©duction de 20% !   ', '2019-02-01'),
(15, 'Ouverture du site', ' Le restaurant Van Ã  Pho ouvre ses portes !', '2018-12-05'),
(17, 'Ouverture pour le nouvel an', ' Le restaurant sera ouvert dans la nuit du 31 DÃ©cembre afin de cÃ©lÃ©brer le nouvel, n\'hÃ©sitez Ã  venir nombreux ', '2018-12-11'),
(18, 'CÃ©lÃ©bration du nouvel an chinois', ' Venez cÃ©lÃ©brer la nouvelle annÃ©e du cochon avec nous ! -50% sur les plats Ã  base de porc aujourd\'hui seulement !', '2019-01-04'),
(19, 'CÃ©lÃ©bration du nouvel an thaÃ¯', ' Venez cÃ©lÃ©brer avec nous la nouvelle annÃ©e thaÃ¯landaise, pendant la durÃ©e de la cÃ©lÃ©bration, tout les plats thaÃ¯landais seront a -30% ! ', '2019-03-20');

-- --------------------------------------------------------

--
-- Structure de la table `criteria`
--

DROP TABLE IF EXISTS `criteria`;
CREATE TABLE IF NOT EXISTS `criteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `criteria`
--

INSERT INTO `criteria` (`id`, `libelle`) VALUES
(1, 'Chaud'),
(2, 'Froid'),
(3, 'Porc'),
(4, 'Poulet'),
(5, 'Boeuf'),
(6, 'Fruit de mer'),
(11, 'Frit'),
(12, 'LÃ©gumes'),
(13, 'Alcool');

-- --------------------------------------------------------

--
-- Structure de la table `dishes`
--

DROP TABLE IF EXISTS `dishes`;
CREATE TABLE IF NOT EXISTS `dishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `category` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `img_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `description`, `price`, `category`, `available`, `img_link`) VALUES
(65, 'Riz cantonais', ' Riz garni de porc, d\'oeuf et de lÃ©gumes', 4, 2, 1, 'public/img/65.jpg'),
(58, 'Porc sauce aigre douce', ' Morceaux de porc dans une pÃ¢te Ã  beignet frits avec une sauce acidulÃ©e et sucrÃ©e', 4, 2, 1, 'public/img/58.jpg'),
(56, 'Gyoza', ' Raviolis frits au chou et au porc', 0.8, 1, 1, 'public/img/56.jpg'),
(55, 'Nem', 'Galette de riz farcie Ã  partir de viandes ou de crustacÃ©s', 0.4, 1, 1, 'public/img/55.jpg'),
(57, 'Samoussa', ' Beignet composÃ© d\'une fine pÃ¢te de blÃ© qui enrobe une farce traditionnellement faite de lÃ©gumes ou de viande, de piment et d\'Ã©pices', 0.4, 1, 1, 'public/img/57.jpg'),
(71, 'Sushi', ' Boule de riz vinaigrÃ©e sur laquelle est posÃ© un sashimi', 1, 2, 1, 'public/img/71.jpg'),
(70, 'Sashimi', ' Tranches de poisson frais consommÃ©e cru', 1, 2, 1, 'public/img/70.jpg'),
(68, 'Tamarin', 'Servi en coupelle ', 3, 3, 1, 'public/img/68.jpg'),
(69, 'ThÃ©', ' DiffÃ©rentes saveurs disponible', 2, 4, 1, 'public/img/69.jpg'),
(67, 'Litchi', ' Servi en coupelle', 2, 3, 1, 'public/img/67.jpg'),
(59, 'Brochette de Boeuf', ' Brochette cuite au grill', 2, 2, 1, 'public/img/59.jpg'),
(66, 'Sorbet', ' Disponible avec diffÃ©rents goÃ»ts', 2, 3, 1, 'public/img/66.jpg'),
(61, 'Eau', '  ', 2, 4, 1, 'public/img/61.jpg'),
(62, 'Coca', ' ', 2.5, 4, 1, 'public/img/62.jpg'),
(63, 'BiÃ¨re', 'Plusieurs marques disponibles', 4, 4, 1, 'public/img/63.jpg'),
(64, 'Pho', 'Bouillon de boeuf accompagnÃ© de nouilles de riz et de lamelles de boeuf', 5, 2, 1, 'public/img/64.jpg'),
(60, 'Pad Thai', 'Nouilles de riz  accompagnÃ© d\'oeuf et de divers lÃ©gumes et de crevettes grillÃ©es avec une sauce sucrÃ©e Ã  base de tamarin et de citron vert', 5, 2, 1, 'public/img/60.jpg'),
(72, 'Maki', 'Rouleau d\'algue nori sÃ©chÃ©e entourant du riz blanc mÃ©langÃ© Ã  du vinaigre de riz sucrÃ©, et farci par divers aliments', 0.8, 2, 1, 'public/img/72.jpg'),
(73, 'Poulet frit', 'Poulet passÃ© dans une mixture Ã  paner puis frit dans de l\'huile', 1.5, 2, 1, 'public/img/73.jpg'),
(74, 'Nouilles sautÃ©es', ' Nouilles sautÃ©es au wok avec diffÃ©rents accompagnements possible', 5, 2, 1, 'public/img/74.jpg'),
(75, 'Brownie', 'GÃ¢teau au chocolat cuit au four nappÃ© de chocolat', 1, 3, 1, 'public/img/75.jpg'),
(76, 'CafÃ©', ' ', 1, 4, 1, 'public/img/76.jpg'),
(77, 'Perle de coco', 'PÃ¢tisserie de riz gluant Ã  la poudre de coco', 1.2, 3, 1, 'public/img/77.jpg'),
(78, 'Salade de papaye', 'Salade prÃ©parÃ©e Ã  base de lamelle de papaye verte pilÃ©e avec de la sauce de poisson et du jus de citron', 1.5, 1, 1, 'public/img/78.jpg'),
(79, 'Salade', ' Salade composÃ©e uniquement de lÃ©gumes', 1.5, 1, 1, 'public/img/79.jpg'),
(80, 'Rouleau de printemps', ' Galette de riz enroulant de la salade, vermicelle et crevette', 0.8, 1, 1, 'public/img/80.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `dish_criteria`
--

DROP TABLE IF EXISTS `dish_criteria`;
CREATE TABLE IF NOT EXISTS `dish_criteria` (
  `dish_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dish_criteria`
--

INSERT INTO `dish_criteria` (`dish_id`, `criteria_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(3, 1),
(52, 1),
(2, 4),
(5, 1),
(5, 3),
(55, 1),
(55, 3),
(55, 4),
(55, 11),
(56, 1),
(56, 3),
(56, 11),
(57, 1),
(57, 11),
(57, 5),
(78, 2),
(78, 12),
(79, 2),
(79, 12),
(80, 2),
(80, 12),
(80, 6),
(58, 1),
(58, 3),
(58, 11),
(59, 1),
(59, 5),
(60, 1),
(60, 6),
(64, 1),
(64, 5),
(65, 1),
(65, 3),
(70, 2),
(70, 6),
(71, 2),
(71, 6),
(72, 2),
(72, 6),
(73, 4),
(73, 11),
(74, 1),
(74, 3),
(74, 4),
(74, 5),
(74, 6),
(74, 12),
(66, 2),
(67, 2),
(61, 2),
(62, 2),
(63, 2),
(63, 13),
(69, 1),
(76, 1);

-- --------------------------------------------------------

--
-- Structure de la table `guestbook`
--

DROP TABLE IF EXISTS `guestbook`;
CREATE TABLE IF NOT EXISTS `guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `guestbook`
--

INSERT INTO `guestbook` (`id`, `content`, `date`, `users_id`) VALUES
(43, 'Je recommande !!', '2019-01-15 11:09:39', 0),
(44, '5/5', '2019-01-18 19:20:44', 0),
(45, 'Je reviendrai avec certitude', '2019-01-21 15:30:06', 0),
(46, 'Serveur gentil et rapide', '2019-01-21 21:10:25', 0),
(47, 'Le menu pourrait utiliser plus de choses, mais c\'est correct', '2019-02-04 13:12:12', 0),
(48, '5/7 pas mal', '2019-02-11 16:18:33', 0),
(49, 'Je suis venue pour la Saint-valentin, nous avons Ã©tÃ© gatÃ©s', '2019-02-15 09:12:52', 0),
(50, 'Les nems sont les meilleurs !!', '2019-02-27 14:13:11', 0),
(51, 'J\'adooooore les sushis', '2019-03-12 20:13:14', 0),
(52, 'Je tire mon chapeau au chef !', '2019-04-10 16:20:32', 0),
(53, 'Site simple et facile d\'accÃ¨s !', '2019-04-24 09:44:47', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_amount` int(11) NOT NULL,
  `table_amount` int(11) NOT NULL,
  `reservation_day` date NOT NULL,
  `reservation_timeslot` int(11) NOT NULL,
  `reservation_time` time NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `client_amount`, `table_amount`, `reservation_day`, `reservation_timeslot`, `reservation_time`, `users_id`) VALUES
(70, 2, 1, '2019-06-02', 2, '19:50:00', 5),
(67, 4, 2, '2019-06-02', 1, '12:00:00', 5),
(60, 5, 3, '2019-06-01', 1, '12:45:00', 12),
(59, 7, 4, '2019-05-30', 1, '12:45:00', 12),
(66, 3, 2, '2019-06-01', 1, '12:45:00', 5),
(65, 5, 3, '2019-05-31', 2, '19:45:00', 5),
(69, 3, 2, '2019-06-01', 2, '19:00:00', 5),
(68, 4, 2, '2019-05-31', 2, '20:00:00', 5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authority` int(11) NOT NULL DEFAULT '1',
  `phone` varchar(10) NOT NULL,
  `authentication_string` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `password`, `authority`, `phone`, `authentication_string`) VALUES
(5, 'sourignavannapho@gmail.com', 'Vannapho', 'Sourigna', '$2y$10$gVT7PKxH7/Fry.PwdsR63.d9aMBS.7E27cVh6zHRFWxMMpgTGyRAq', 3, '0987654323', 'Completed'),
(13, 'kghrsn@gmail.com', 'Kevin', 'Dupuis', '$2y$10$MGQapM80skCsqlSYbl5jn.GXvbep36hz0IFF5IvXH9B4b79D1XmG6', 1, '0123456788', 'Completed'),
(12, 'laos_yoshi@hotmail.com', 'James', 'Smith', '$2y$10$SsxIqopNkhZEw4Rf.NMzYuDSPPonspdrQw0A2GR2EFy9A4iO3t35m', 2, '0123456789', 'Completed');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

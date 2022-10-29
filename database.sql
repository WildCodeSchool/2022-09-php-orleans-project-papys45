-- phpMyAdmin SQL Dump

-- version 4.5.4.1deb2ubuntu2

-- http://www.phpmyadmin.net

--

-- Client :  localhost

-- Généré le :  Jeu 26 Octobre 2017 à 13:53

-- Version du serveur :  5.7.19-0ubuntu0.16.04.1

-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */

;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */

;

/*!40101 SET NAMES utf8mb4 */

;

--

-- Base de données :  `simple-mvc`

--

-- --------------------------------------------------------

--

-- Structure de la table `item`

--

CREATE TABLE
    `item` (
        `id` int(11) UNSIGNED NOT NULL,
        `title` varchar(255) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Contenu de la table `item`

--

INSERT INTO
    `item` (`id`, `title`)
VALUES (1, 'Stuff'), (2, 'Doodads');

--

-- Index pour les tables exportées

--

--

-- Index pour la table `item`

--

ALTER TABLE `item` ADD PRIMARY KEY (`id`);

--

-- AUTO_INCREMENT pour les tables exportées

--

--

-- AUTO_INCREMENT pour la table `item`

--

ALTER TABLE
    `item` MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;

CREATE TABLE
    `actuality` (
        `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
        `title` VARCHAR(80),
        `content` VARCHAR(140)
    );

INSERT INTO
    `actuality` (`title`, `content`)
VALUES (
        'A vos agendas !',
        'La prochaine réunion aura lieu le 8 novembre 2022 à la salle Jean Bernard'
    ), (
        'A vos agendas !',
        'Samedi 17 décembre 2022, repas de fin d\'année du club'
    ), (
        'L\'hiver vient !',
        'Dernière sortie avant clôture, le 27 novembre 2022.'
    ), (
        'Vive les PR !',
        'Grâce à mon formateur préféré, j\'aime les PR.'
    ), (
        'C\'est qui ton meilleur ami ?',
        'Mon meilleur ami c\'est GRUMP.'
    );

/*----------------------------------------------------------------*/

CREATE TABLE
    `member` (
        `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
        `firstname` VARCHAR(80) NOT NULL,
        `lastname` VARCHAR(80) NOT NULL,
        `role` CHAR(20),
        `dateOfBirth` DATE NOT NULL,
        `mail` VARCHAR(255) NOT NULL,
        `photo` TEXT
    );

INSERT INTO
    `member` (
        `firstname`,
        `lastname`,
        `role`,
        `dateOfBirth`,
        `mail`,
        `photo`
    )
VALUES (
        'Roger',
        'Edarde',
        'Président',
        '1944-10-30',
        'roger@edarde.fr',
        'RogerEdarde.png'
    ), (
        'Frédéric',
        'Milier',
        'Vice-Président',
        '1964-03-28',
        'fred@milier.fr',
        'FredMilier.png'
    ), (
        'Guy',
        'Hauger',
        'Secrétaire',
        '1967-12-02',
        'guy@hauger.fr',
        'GuyHauger.png'
    ), (
        'Pierre',
        'Bernard',
        'Secrétaire-Adjoint',
        '1945-08-18',
        'pierre@bernard.fr',
        'PierreBernard.png'
    ), (
        'Raymond',
        'Poulidor',
        'Comptable',
        '1968-08-28',
        'raymond@poulidor.fr',
        'RaymondPoulidor.png'
    ), (
        'John',
        'Doe',
        '',
        '1980-12-02',
        'john@doe.fr',
        'default.png'
    );
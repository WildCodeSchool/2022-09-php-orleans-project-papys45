-- Active: 1665561486420@@127.0.0.1@3306@papys45

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
    `route` (
        `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `date` DATE NOT NULL,
        `time` TIME NOT NULL,
        `start` VARCHAR(255) NOT NULL,
        `finish` VARCHAR(255) NOT NULL,
        `ravito` VARCHAR(255),
        `distance` INT NOT NULL,
        `difficulty` INT NOT NULL,
        `gpx` VARCHAR(255),
        `description` VARCHAR(255),
        `rapport` VARCHAR(255)
    );

INSERT INTO
    `route` (
        `date`,
        `time`,
        `start`,
        `finish`,
        `ravito`,
        `distance`,
        `difficulty`
    )
VALUES (
        '2022-10-27',
        '16:00:00',
        '45 rue de la voiture gauche, Orléans',
        '20 rue du velo en mer, Chécy',
        '250 avenue du raton',
        80,
        1
    );

INSERT INTO
    `route` (
        `date`,
        `time`,
        `start`,
        `finish`,
        `ravito`,
        `distance`,
        `difficulty`
    )
VALUES (
        '2022-10-28',
        '08:00:00',
        '66 avenue de la figue, Fleury-Les-Aubrays',
        '13 rue de Babylone , St Cyr en Val',
        '48 faubourg du bourg, Olivet',
        100,
        2
    );

INSERT INTO
    `route` (
        `date`,
        `time`,
        `start`,
        `finish`,
        `ravito`,
        `distance`,
        `difficulty`
    )
VALUES (
        '2023-01-03',
        '08:00:00',
        '66 avenue du chimpanzé, Orléans',
        '13 rue du couteau de Cécile, Beaugency',
        '48 rue de la rue, Chécy',
        20,
        3
    );

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
        'president',
        '1957-12-02',
        'roger@edarde.fr',
        ''
    ), (
        'Frédérick',
        'Milier',
        'vice',
        '1947-12-02',
        'fred@milier.fr',
        ''
    ), (
        'Guy',
        'Hauger',
        'secretary',
        '1967-12-02',
        'guy@hauger.fr',
        ''
    ), (
        'Pierre',
        'Bernard',
        'adjSecretary',
        '1945-08-18',
        'pierre@bernard.fr',
        ''
    ), (
        'Raymond',
        'Poulidor',
        'accoutant',
        '1968-08-28',
        'raymond@poulidor.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1980-12-02',
        'john@doe.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1979-12-02',
        'john@doe.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1978-12-02',
        'john@doe.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1977-12-02',
        'john@doe.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1976-12-02',
        'john@doe.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1975-12-02',
        'john@doe.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1974-12-02',
        'john@doe.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1973-12-02',
        'john@doe.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1972-12-02',
        'john@doe.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1971-12-02',
        'john@doe.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1970-12-02',
        'john@doe.fr',
        ''
    ), (
        'John',
        'Doe',
        'member',
        '1969-12-02',
        'john@doe.fr',
        ''
    ), (
        'Serge',
        'Moreau',
        'member',
        '1959-12-02',
        'john@doe.fr',
        ''
    );

CREATE TABLE
    `login` (
        `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
        `email` VARCHAR(255) NOT NULL,
        `password` VARCHAR(255) NOT NULL
    );

INSERT INTO
    `login` (`email`, `password`)
    /*mdp = bilbo */
VALUES (
        'admin@connexion.fr',
        '$2y$10$fB15ED93ls/uDwhdSg4wQO9OmYXlNkfeAIG9ZlBsSf2UVGDoXxC.G'
    );

CREATE TABLE
    `register` (
        `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
        CONSTRAINT `fk_member` FOREIGN KEY (`member_id`) REFERENCES `member`(id),
        CONSTRAINT `fk_route` FOREIGN KEY (`route_id`) REFERENCES `route`(id)
    );
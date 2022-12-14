-- Active: 1665753972491@@127.0.0.1@3306@papys45

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
        `rapport` TEXT
    );

INSERT INTO
    `route` (
        `date`,
        `time`,
        `start`,
        `finish`,
        `ravito`,
        `distance`,
        `difficulty`,
        `gpx`,
        `description`,
        `rapport`
    )
VALUES (
        '2022-10-27',
        '16:00:00',
        '45 rue de la voiture gauche, Orléans',
        '20 rue du velo en mer, Chécy',
        '250 avenue du raton',
        80,
        1,
        '7oy3KJ4XqY',
        'Une courte description de la sortie.
        Passage par la jolie ville de St Cyr en Val, ravitaillement prévu par la femme de Bernard.',
        ''
    );

INSERT INTO
    `route` (
        `date`,
        `time`,
        `start`,
        `finish`,
        `ravito`,
        `distance`,
        `difficulty`,
        `gpx`,
        `description`,
        `rapport`
    )
VALUES (
        '2022-10-28',
        '08:00:00',
        '66 avenue de la figue, Fleury-Les-Aubrays',
        '13 rue de Babylone , St Cyr en Val',
        '48 faubourg du bourg, Olivet',
        100,
        2,
        '7oy3KJ4XqY',
        'Sortie sous une pluie battante.
Pensez à prendre vos gilets de sécurité et les signes de visibilité nécessaires.',
        'Une belle journée d\'automne.
Nous nous sommes arrêtés pour le ravitaillement devant le moulin. Profitant du soleil, nous avons circulé sans encombre.'
    );

INSERT INTO
    `route` (
        `date`,
        `time`,
        `start`,
        `finish`,
        `ravito`,
        `distance`,
        `difficulty`,
        `gpx`,
        `description`,
        `rapport`
    )
VALUES (
        '2023-01-03',
        '08:00:00',
        '66 avenue du chimpanzé, Orléans',
        '13 rue du couteau de Cécile, Beaugency',
        '48 rue de la rue, Chécy',
        20,
        3,
        '7oy3KJ4XqY',
        'Journée magnifique pour circuler.
Températures négatives prévues, pensez à vous couvrir suffisamment pour éviter les coups de froid.',
        'La route était difficile.
Beaucoup de voitures sur ce tracé et avec la pluie, notre vitesse moyenne en a été diminuée.'
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
        'accountant',
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
    `photo` (
        `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
        `photo` TEXT,
        `route_id` int NOT NULL,
        CONSTRAINT `fk_route` FOREIGN KEY (`route_id`) REFERENCES `route`(id)
    );

CREATE TABLE
    `registration` (
        `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
        `member_id` int NOT NULL,
        `route_id` int NOT NULL,
        CONSTRAINT `fk_member` FOREIGN KEY (`member_id`) REFERENCES `member`(id) ON DELETE CASCADE,
        CONSTRAINT `fk_route1` FOREIGN KEY (`route_id`) REFERENCES `route`(id) ON DELETE CASCADE
    );

INSERT INTO
    `registration`(`member_id`, `route_id`)
VALUES (1, 2), (1, 3), (2, 1), (3, 1), (4, 1), (5, 1), (6, 1), (7, 1), (8, 1), (9, 1), (10, 1), (11, 1);

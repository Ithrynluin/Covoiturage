-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 23 Octobre 2014 à 19:22
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `covoiturage`
--

--
-- Contenu de la table `personne`
--

UPDATE `personne` SET `per_num` = 1,`per_nom` = 'Marley',`per_prenom` = 'Bob',`per_tel` = '0555555555',`per_mail` = 'Bob@unilim.fr',`per_login` = 'Bob',`per_pwd` = '67556b88cecd723a1c4556b1cd6515a199a92c97' WHERE `personne`.`per_num` = 1;
UPDATE `personne` SET `per_num` = 3,`per_nom` = 'Duchemin',`per_prenom` = 'Paul',`per_tel` = '0555555555',`per_mail` = 'paul@yahoo.fr',`per_login` = 'Paul',`per_pwd` = '72ebdb9152d3d0586cd8aec060475d78af79548c' WHERE `personne`.`per_num` = 3;
UPDATE `personne` SET `per_num` = 38,`per_nom` = 'Michu',`per_prenom` = 'Marcel',`per_tel` = '0555555555',`per_mail` = 'Michu@sfr.fr',`per_login` = 'Marcel',`per_pwd` = '677fdee7bf91d15964a417413a3a04374d73be6a' WHERE `personne`.`per_num` = 38;
UPDATE `personne` SET `per_num` = 39,`per_nom` = 'Renard',`per_prenom` = 'Pierrot',`per_tel` = '0655555555',`per_mail` = 'Pierrot@gmail.fr',`per_login` = 'sql',`per_pwd` = 'd29757f1972f644107fb7591526f91cb47e2c854' WHERE `personne`.`per_num` = 39;
UPDATE `personne` SET `per_num` = 52,`per_nom` = 'Adam',`per_prenom` = 'Pomme',`per_tel` = '0555775555',`per_mail` = 'Pomme@apple.com',`per_login` = 'Pomme',`per_pwd` = 'd29757f1972f644107fb7591526f91cb47e2c854' WHERE `personne`.`per_num` = 52;
UPDATE `personne` SET `per_num` = 53,`per_nom` = 'Delmas',`per_prenom` = 'Sophie',`per_tel` = '0789562314',`per_mail` = 'Sophie@unilim.fr',`per_login` = 'Soso',`per_pwd` = '677fdee7bf91d15964a417413a3a04374d73be6a' WHERE `personne`.`per_num` = 53;
UPDATE `personne` SET `per_num` = 54,`per_nom` = 'Dupuy',`per_prenom` = 'Pascale',`per_tel` = '0554565859',`per_mail` = 'pascale@free.fr',`per_login` = 'Pascale',`per_pwd` = 'ef414896f162a1887ae33a4a7dd2392a49850bb9' WHERE `personne`.`per_num` = 54;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

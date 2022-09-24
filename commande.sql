-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Client: sql303.hebergratuit.net
-- Généré le: Ven 12 Juillet 2019 à 04:51
-- Version du serveur: 5.6.41-84.1
-- Version de PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `heber_23524845_commande`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `login` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `fonction` varchar(100) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`login`, `mdp`, `fonction`) VALUES
('daf', 'daf', 'daf'),
('Niry', 'gestion', 'Controleur');

-- --------------------------------------------------------

--
-- Structure de la table `bordereau`
--

CREATE TABLE IF NOT EXISTS `bordereau` (
  `num` int(11) NOT NULL,
  `num_havas` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bordereau`
--

INSERT INTO `bordereau` (`num`, `num_havas`) VALUES
(19190, 25);

-- --------------------------------------------------------

--
-- Structure de la table `budget_commande`
--

CREATE TABLE IF NOT EXISTS `budget_commande` (
  `id_budget` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cmd` varchar(250) NOT NULL,
  `pu_cmd` double NOT NULL,
  `sous_rubrique` varchar(250) NOT NULL,
  `num_cmd` varchar(15) NOT NULL,
  `date_cmd` date NOT NULL,
  `budget_service` varchar(75) NOT NULL,
  `budget_agence` varchar(75) NOT NULL,
  `budget_validation` int(11) NOT NULL DEFAULT '0',
  `qte_cmd` int(11) NOT NULL,
  `devise` varchar(20) NOT NULL,
  `montant_cmd` double NOT NULL,
  PRIMARY KEY (`id_budget`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Contenu de la table `budget_commande`
--

INSERT INTO `budget_commande` (`id_budget`, `nom_cmd`, `pu_cmd`, `sous_rubrique`, `num_cmd`, `date_cmd`, `budget_service`, `budget_agence`, `budget_validation`, `qte_cmd`, `devise`, `montant_cmd`) VALUES
(12, 'desktop', 5000, 'FORMATION A L', '1819153', '2018-04-04', 'informatique', 'tanjombato', 1, 2, '', 10000),
(13, 'desktop', 91601, 'FORMATION LOCALE', '1819154', '2018-04-04', 'informatique', 'tanjombato', 1, 2, 'Ar', 194002),
(25, 'desk', 1500000, 'KDO FIN D', '1819164', '2018-04-10', 'informatique', 'tanjombato', 1, 2, 'Ar', 3000000),
(26, 'jabra casque', 4500, 'FORMATION LOCALE', '1819164', '2018-04-10', 'informatique', 'tanjombato', 1, 2, 'Ar', 9000),
(27, 'bjkbkb', 89, 'SPORT', '1819164', '2018-04-10', 'informatique', 'tanjombato', 1, 2, 'Ar', 178),
(28, 'njj', 4856, 'MARATHON DAY', '1819164', '2018-04-10', 'informatique', 'tanjombato', 1, 1, 'Ar', 4856),
(29, 'jjghh', 5, 'FORMATION LOCALE', '1819164', '2018-04-10', 'informatique', 'tanjombato', 1, 2, 'Ar', 10),
(30, 'hp pc cor i5 hd250 4go ram', 41200, 'FORMATION LOCALE', 'BC TEST', '2019-05-13', 'informatique', 'tanjombato', 0, 2, 'Ar', 82400),
(31, 'hp pc cor i5 hd250 4go ram', 41200, 'FORMATION LOCALE', 'BC TEST', '2019-05-13', 'informatique', 'tanjombato', 0, 2, 'Ar', 82400),
(32, 'hp pc cor i5 hd250 4go ram', 41200, 'FORMATION LOCALE', 'BC TEST', '2019-05-13', 'informatique', 'tanjombato', 0, 2, 'Ar', 82400),
(33, 'hp pc cor i5 hd250 4go ram', 41200, 'FORMATION LOCALE', 'BC TEST', '2019-05-13', 'informatique', 'tanjombato', 0, 2, 'Ar', 82400),
(34, 'hp pc cor i5 hd250 4go ram', 41200, 'FORMATION LOCALE', 'BC TEST', '2019-05-13', 'informatique', 'tanjombato', 0, 2, 'Ar', 82400),
(35, 'hp pc cor i5 hd250 4go ram', 41200, 'FORMATION LOCALE', 'BC TEST', '2019-05-13', 'informatique', 'tanjombato', 0, 2, 'Ar', 82400),
(36, 'STYLO', 100000, 'KDO AIDE SCOLAIRE', '1919166', '2019-07-03', 'informatique', 'tanjombato', 0, 1, 'Ar', 100000),
(37, 'STYLO', 100000, 'KDO AIDE SCOLAIRE', '1919167', '2019-07-03', 'informatique', 'tanjombato', 0, 1, 'Ar', 100000),
(38, 'STYLO', 100000, 'KDO AIDE SCOLAIRE', 'BC TEST', '2019-07-03', 'informatique', 'tanjombato', 0, 1, 'Ar', 100000),
(39, 'STYLO', 100000, 'KDO AIDE SCOLAIRE', '1919168', '2019-07-03', 'informatique', 'tanjombato', 0, 1, 'Ar', 100000),
(40, 'stylo', 10000, 'FORMATION LOCALE', '1919169', '2019-07-03', 'informatique', 'tanjombato', 0, 1, 'Ar', 10000),
(41, 'stylo', 10000, 'KDO AIDE SCOLAIRE', '1919170', '2019-07-03', 'informatique', 'tanjombato', 0, 1, 'Ar', 10000),
(42, 'hp pc cor i5 hd250 4go ram', 14000, 'FORMATION A L', '1919171', '2019-07-03', 'informatique', 'tanjombato', 0, 3, 'Ar', 42000),
(43, 'test', 563000, 'FORMATION LOCALE', '1919171', '2019-07-03', 'informatique', 'tanjombato', 0, 2, 'Ar', 1126000),
(44, 'hp pc cor i5 hd250 4go ram', 14000, 'FORMATION A L', '1919172', '2019-07-03', 'informatique', 'tanjombato', 0, 3, 'Ar', 42000),
(45, 'test', 563000, 'FORMATION LOCALE', '1919172', '2019-07-03', 'informatique', 'tanjombato', 0, 2, 'Ar', 1126000),
(46, 'stylo', 100000, 'FORMATION LOCALE', '1919173', '2019-07-03', 'informatique', 'tanjombato', 0, 1, 'Ar', 100000),
(47, 'hp pc cor i5 hd250 4go ram', 14000, 'FORMATION A L', 'BC TEST', '2019-07-03', 'informatique', 'tanjombato', 0, 3, 'Ar', 42000),
(48, 'test', 563000, 'FORMATION LOCALE', 'BC TEST', '2019-07-03', 'informatique', 'tanjombato', 0, 2, 'Ar', 1126000),
(49, 'hp pc cor i5 hd250 4go ram', 14000, 'FORMATION A L', 'BC TEST', '2019-07-03', 'informatique', 'tanjombato', 0, 3, 'Ar', 42000),
(50, 'test', 563000, 'FORMATION LOCALE', 'BC TEST', '2019-07-03', 'informatique', 'tanjombato', 0, 2, 'Ar', 1126000),
(51, 'hp pc cor i5 hd250 4go ram', 14000, 'FORMATION A L', '1919175', '2019-07-03', 'informatique', 'tanjombato', 0, 3, 'Ar', 42000),
(52, 'test', 563000, 'FORMATION LOCALE', '1919175', '2019-07-03', 'informatique', 'tanjombato', 0, 2, 'Ar', 1126000),
(53, 'PAPIER', 10000, 'KDO AIDE SCOLAIRE', '1919176', '2019-07-04', 'informatique', 'tanjombato', 0, 1, 'Ar', 10000),
(54, 'KIT', 50000, 'KDO AIDE SCOLAIRE', '1919177', '2019-07-04', 'informatique', 'tanjombato', 0, 1, 'Ar', 50000),
(55, 'KIT', 50000, 'KDO AIDE SCOLAIRE', '1919178', '2019-07-04', 'informatique', 'tanjombato', 0, 1, 'Ar', 50000),
(56, 'KIT', 20000, 'KDO AIDE SCOLAIRE', '1919179', '2019-07-04', 'informatique', 'tanjombato', 0, 6, 'Ar', 120000),
(57, 'KIT', 20000, 'KDO AIDE SCOLAIRE', '1919180', '2019-07-04', 'informatique', 'tanjombato', 0, 6, 'Ar', 120000),
(58, 'PAPIER', 10000, 'KDO AIDE SCOLAIRE', '1919181', '2019-07-04', 'informatique', 'tanjombato', 0, 1, 'Ar', 10000);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE IF NOT EXISTS `commandes` (
  `date_compta` date NOT NULL,
  `id_cmd` int(11) NOT NULL,
  `liste` text NOT NULL,
  `service` varchar(75) NOT NULL,
  `agence` varchar(50) NOT NULL,
  `fournisseur` varchar(100) NOT NULL,
  `ref` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `ttc` decimal(11,2) NOT NULL,
  `etat` varchar(15) NOT NULL,
  `cmd_devise` varchar(10) NOT NULL,
  `num_bl` varchar(50) NOT NULL,
  `date_bl` date NOT NULL,
  `num_facture` varchar(50) NOT NULL,
  `date_facture` date NOT NULL,
  `montant_facture` float NOT NULL,
  `statut` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cmd`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commandes`
--

INSERT INTO `commandes` (`date_compta`, `id_cmd`, `liste`, `service`, `agence`, `fournisseur`, `ref`, `date`, `ttc`, `etat`, `cmd_devise`, `num_bl`, `date_bl`, `num_facture`, `date_facture`, `montant_facture`, `statut`) VALUES
('0000-00-00', 1819156, 'a:1:{i:0;a:1:{s:9:"458 lopop";a:1:{i:2;s:4:"7200";}}}', 'informatique', 'tanjombato', 'ELECTRA-TOP', 'NZ002582', '2018-04-04', '8640.00', 'f', '', '', '0000-00-00', 'FACT-001', '2019-06-18', 0, ''),
('2019-07-09', 1819157, 'a:1:{i:0;a:1:{s:7:"desktop";a:1:{i:4;s:7:"2797200";}}}', 'informatique', 'tanjombato', 'SIDEF', '', '2018-04-04', '3356640.00', 'fc', '', 'BL-001', '2019-06-18', 'FACTURE001', '2019-06-18', 0, ''),
('2018-04-06', 1819158, 'a:2:{i:0;a:1:{s:4:"allo";a:1:{i:2;s:5:"29040";}}i:1;a:1:{s:5:"phone";a:1:{i:4;s:4:"4800";}}}', 'informatique', 'tanjombato', 'SIDEF', 'NZ001354', '2018-04-04', '40608.00', 'fc', 'Ar', '', '0000-00-00', '', '0000-00-00', 0, ''),
('0000-00-00', 1819159, 'a:2:{i:0;a:1:{s:4:"allo";a:1:{i:2;s:5:"10800";}}i:1;a:1:{s:12:"jabra casque";a:1:{i:2;s:6:"179136";}}}', 'informatique', 'tanjombato', 'ELECTRA-TOP', 'NZ002582', '2018-04-04', '227923.20', 'BL', '', '', '0000-00-00', '', '0000-00-00', 0, ''),
('0000-00-00', 1819160, 'a:1:{i:0;a:1:{s:9:"bloc note";a:1:{i:2;s:5:"31560";}}}', 'informatique', 'tanjombato', 'SIDEF', 'NZ001354', '2018-04-05', '37872.00', 'BC', '', '', '0000-00-00', '', '0000-00-00', 0, ''),
('0000-00-00', 1819161, 'a:1:{i:0;a:1:{s:9:"bloc note";a:1:{i:2;s:3:"600";}}}', 'informatique', 'tanjombato', 'ELECTRA-TOP', 'NZ002582', '2018-04-05', '600.00', 'BL', '', 'BL-001', '2019-06-18', '', '0000-00-00', 0, ''),
('2018-04-06', 1819163, 'a:1:{i:0;a:1:{s:4:"desk";a:1:{i:2;s:5:"90000";}}}', 'informatique', 'tanjombato', 'SIDEF', '', '2018-04-06', '108000.00', 'fc', 'Ar', '', '0000-00-00', '', '0000-00-00', 0, ''),
('0000-00-00', 1819164, 'a:3:{i:0;a:1:{s:4:"desk";a:1:{i:2;s:7:"3000000";}}i:1;a:1:{s:12:"jabra casque";a:1:{i:2;s:4:"9000";}}i:2;a:1:{s:6:"bjkbkb";a:1:{i:2;s:3:"178";}}}', 'informatique', 'tanjombato', 'ELECTRA-TOP', 'NZ002582', '2018-04-10', '3616852.80', 'BC', 'Ar', '', '0000-00-00', '', '0000-00-00', 0, ''),
('0000-00-00', 1919175, 'a:2:{i:0;a:1:{s:26:"hp pc cor i5 hd250 4go ram";a:1:{i:3;s:5:"42000";}}i:1;a:1:{s:4:"test";a:1:{i:2;s:7:"1126000";}}}', 'informatique', 'tanjombato', 'SIDEF', 'NZ001354', '2019-07-03', '1401600.00', 'BC', 'Ar', '', '0000-00-00', '', '0000-00-00', 0, ''),
('0000-00-00', 1919177, 'a:1:{i:0;a:1:{s:3:"KIT";a:1:{i:1;s:5:"50000";}}}', 'informatique', 'tanjombato', 'SIDEF', 'NZ001354', '2019-07-04', '60000.00', 'BC', 'Ar', '', '0000-00-00', '', '0000-00-00', 0, ''),
('0000-00-00', 1919178, 'a:1:{i:0;a:1:{s:3:"KIT";a:1:{i:1;s:5:"50000";}}}', 'informatique', 'tanjombato', 'SIDEF', 'NZ001354', '2019-07-04', '60000.00', 'BC', 'Ar', '', '0000-00-00', '', '0000-00-00', 0, ''),
('0000-00-00', 1919179, 'a:1:{i:0;a:1:{s:3:"KIT";a:1:{i:6;s:6:"120000";}}}', 'informatique', 'tanjombato', 'UNICAF', 'MG661000', '2019-07-04', '144000.00', 'BL', 'Ar', '5210', '2019-07-04', '', '0000-00-00', 0, ''),
('0000-00-00', 1919180, 'a:1:{i:0;a:1:{s:3:"KIT";a:1:{i:6;s:6:"120000";}}}', 'informatique', 'tanjombato', 'UNICAF', 'MG661000', '2019-07-04', '144000.00', 'BC', 'Ar', '', '0000-00-00', '', '0000-00-00', 0, ''),
('0000-00-00', 1919181, 'a:1:{i:0;a:1:{s:6:"PAPIER";a:1:{i:1;s:5:"10000";}}}', 'informatique', 'tanjombato', 'SIDEF', 'NZ001354', '2019-07-04', '12000.00', 'BC', 'Ar', '', '0000-00-00', '', '0000-00-00', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fournisseur` varchar(250) NOT NULL,
  `ref_iris` varchar(250) NOT NULL,
  `id_login` int(11) NOT NULL,
  PRIMARY KEY (`id_fournisseur`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id_fournisseur`, `nom_fournisseur`, `ref_iris`, `id_login`) VALUES
(1, 'SIDEF', 'NZ001354', 1),
(2, 'ELECTRA-TOP', 'NZ002582', 1),
(5, 'ELECKTA', 'NZ003585', 1),
(8, 'test', '13549649', 3),
(9, 'TEST', 'NZ00000', 15),
(10, 'UNICAF', 'MG661000', 1),
(11, 'BLUESTORAGE', 'MG415400', 1);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(100) NOT NULL,
  `agence` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `login`
--

INSERT INTO `login` (`id_login`, `service`, `agence`, `mdp`) VALUES
(1, 'Informatique', 'Tanjombato', 'Alcatel'),
(2, 'Logistique', 'Tanjombato', 'password'),
(3, 'Finance', 'Tanjombato', 'password'),
(4, 'Protocole', 'Tanjombato', 'password'),
(5, 'Direction', 'Tanjombato', 'password'),
(6, 'Import', 'Tanjombato', 'tapitra12fev'),
(7, 'Export', 'Tanjombato', 'tapitra12fev'),
(8, 'Razafy', 'Tanjombato', 'tapitra12fev'),
(9, 'Eugenie', 'Tanjombato', 'tapitra12fev'),
(10, 'Juridique', 'Tanjombato', 'tapitra12fev'),
(11, 'Gestion', 'Tanjombato', 'gestion'),
(12, 'Commercial', 'Tanjombato', 'password'),
(13, 'Qhse', 'Tanjombato', 'tapitra12fev'),
(14, 'TRANSITMM', 'Tamatave', 'password'),
(15, 'SHIPTMM', 'Tamatave', 'password'),
(16, 'ADMINTMM', 'Tamatave', 'password'),
(17, 'LOGTMM', 'Tamatave', 'password'),
(18, 'IMPIVT', 'Ivato', 'tapitra12fev'),
(19, 'EXPIVT', 'Ivato', 'tapitra12fev'),
(20, 'ADMINMJN', 'Mahajanga', 'password'),
(21, 'ADMINDIE', 'Diego ', 'password'),
(22, 'ADMINFTU', 'Fortdauphin', 'password'),
(23, 'SHIPMJN', 'Mahajanga', 'password'),
(24, 'TRANSITMJN', 'Mahajanga', 'password'),
(25, 'LOGMJN', 'Mahajanga', 'password'),
(26, 'SHIPDIE', 'Diego ', 'password'),
(27, 'TRANSITDIE', 'Diego ', 'password'),
(28, 'RH', 'Tanjombato', 'password'),
(29, 'SAGA', 'Tanjombato', 'password'),
(30, 'TRANSITFTU', 'Fort Dauphin', 'password'),
(31, 'TRANSITIVT', 'Ivato', 'password'),
(32, 'APPROTJB', 'Tanjombato', 'password'),
(33, 'APPROTMM', 'Tamatave', 'password'),
(34, 'DIRTMM', 'Tamatave', 'password'),
(35, 'TRANSITTJB', 'Tanjombato', 'password'),
(37, 'compta', 'tanjombato', '12345'),
(38, 'DEBTJB', 'tanjombato', '123456');

-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

CREATE TABLE IF NOT EXISTS `rubrique` (
  `rub_id` int(11) NOT NULL AUTO_INCREMENT,
  `rub_lib` text NOT NULL,
  PRIMARY KEY (`rub_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `rubrique`
--

INSERT INTO `rubrique` (`rub_id`, `rub_lib`) VALUES
(1, 'FORMATION DU PERSONNEL'),
(2, 'GRATIFICATION FIN D''ANNEE'),
(3, 'AUTRES');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('150677d7d088f498721ab457961d94bf', '197.149.29.191', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:67.0) Gecko/20100101 Firefox/67.0', 1562656369, 'a:7:{s:9:"user_data";s:0:"";s:7:"service";s:6:"compta";s:6:"agence";s:10:"tanjombato";s:8:"id_login";s:2:"37";s:5:"acces";s:2:"FG";s:5:"login";s:3:"daf";s:3:"mdp";s:5:"admin";}');

-- --------------------------------------------------------

--
-- Structure de la table `sous_rubrique`
--

CREATE TABLE IF NOT EXISTS `sous_rubrique` (
  `sr_id` int(11) NOT NULL AUTO_INCREMENT,
  `rub_id` int(11) NOT NULL,
  `sr_lib` text NOT NULL,
  `sr_montant` int(11) NOT NULL,
  PRIMARY KEY (`sr_id`),
  KEY `rub_id` (`rub_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `sous_rubrique`
--

INSERT INTO `sous_rubrique` (`sr_id`, `rub_id`, `sr_lib`, `sr_montant`) VALUES
(1, 1, 'FORMATION LOCALE', 30400000),
(2, 1, 'FORMATION A L''EXTERIEUR', 15600000),
(3, 2, 'KDO AIDE SCOLAIRE', 28225000),
(7, 2, 'KDO FETE NATIONAL', 4867500),
(10, 3, 'NON ASSIGNE', 3000000),
(16, 1, 'FORMATION INFORMATIQUE', 38000000),
(17, 1, 'TALENT SOFT', 7344000),
(18, 1, 'GLOBE', 18000000),
(25, 2, 'KDO FIN D''ANNEE', 32450000),
(26, 2, 'KDO PERE NOEL', 3894000),
(27, 3, 'CANTINE IVT-TJB', 69000000),
(28, 3, 'FRAIS SCOLAIRE DUMONT', 15000000),
(29, 3, 'SPORT', 4000000),
(30, 3, 'MUTUELLE', 4000000),
(31, 3, 'MARATHON DAY', 7480000);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(100) NOT NULL,
  `user_mdp` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `user_login`, `user_mdp`, `user_type`) VALUES
(2, 'onja', '0nj@', 'rubrique'),
(3, 'sylvain', 's1l20', 'fournisseur'),
(4, 'admin', 'admin', 'rubrique'),
(5, 'admin', 'admin', 'fournisseur');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

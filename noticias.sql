-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 18 Février 2015 à 06:49
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `noticias`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `news` smallint(6) NOT NULL,
  `auteur` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `contenu` text COLLATE latin1_general_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `auteur` varchar(30) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `dateAjout` datetime NOT NULL,
  `dateModif` datetime NOT NULL,
  `photo` varchar(200) NOT NULL,
  `enlace` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `auteur`, `titre`, `contenu`, `dateAjout`, `dateModif`, `photo`, `enlace`) VALUES
(5, 'David Monedero', '7 raccourcis clavier qui vont vous changer la vie au bureau (pour Mac et PC)', 'VIE DE BUREAU - Vous croyez maîtriser votre principal outil de travail, être un as de Windows ou de Mac? Ou bien vous en avez plus que marre de vous embrouiller entre les touches du Mac que vous avez à la maison, et celles du PC qui trône sur votre bureau (ou l''inverse)?  Voici quelques raccourcis clavier dont vous ne soupçonniez peut-être pas l''existence qui vont rendre vos journées de travail bien plus simples (et efficaces).', '2014-08-03 11:36:36', '2015-02-17 18:32:55', '../img/RACCOURCIS-CLAVIER.jpg', 'http://www.huffingtonpost.fr/2014/04/02/raccourcis-clavier-bureau_n_5076324.html'),
(14, 'Malin Jacob', 'Cada año ocho millones de toneladas de plásticos van a parar al mar', 'En los océanos está prohibido desde hace décadas verter residuos radiactivos y también se vigilan otro tipo de vertidos pero no se han tomado medidas efectivas hasta ahora para disminuir, al menos, la contaminación por materiales plásticos, que es probablemente la más preocupante de todas.\r\n\r\nEn forma de pequeñas partículas que alcanzan los sedimentos marinos para quedarse durante centenares de años, los restos de plásticos concluyen su ciclo contaminante en todos los mares del mundo, en cantidades crecientes con consecuencias desconocidas a largo plazo y causan innumerables víctimas entre los animales marinos que los ingieren. Sin embargo, aunque todo el mundo ha visto restos de plásticos al bañarse en una playa, la dimensión del problema no se conoce realmente porque cuantificar estos restos es difícil. Ahora lo ha intentado un equipo científico que ha llegado a la conclusión de que unos ocho millones de toneladas de plástico pasan todos los años de la tierra al mar en las costas de 192 países ribereños (entre ellos España) por no tratarse los residuos convenientemente.', '2015-02-17 19:39:55', '2015-02-17 19:39:55', '../img/54e25282179af.jpg', 'http://www.publico.es/ciencias/ocho-millones-toneladas-plasticos-dar.html'),
(15, 'Vincen Navarro', 'Grecia sugiere que Alemania bloqueó el acuerdo sobre la deuda', 'BRUSELAS.-"En la historia de la UE, nunca ha salido nada bueno de los ultimátums", ha dicho Varoufakis, ministro de Finanzas griego en rueda de prensa tras el Eurogrupo en el que se han roto las negociaciones entre la UE y Grecia. "No tengo ninguna duda de que en los próximos días se retirará cualquier noción de ultimátum", ha resaltado.\r\n\r\nEl ministro de Finanzas griego opina que el Eurogrupo se ha dejado sugestionar por los intereses alemanes, lo que ha provocado el bloqueo de la firma cualquier posible un acuerdo, algo que él creía cercano. Varoufakis ha asegurado que el comisario de Asuntos Económicos, Pierre Moscovici, le presentó un borrador de comunicado que preveía la prórroga del crédito que pide Grecia como paso intermedio para firmar un "nuevo contrato de crecimiento" y que ofrecía la asistencia de Bruselas a Atenas para seguir con las reformas.\r\n', '2015-02-17 20:06:31', '2015-02-17 20:06:31', '../img/Grecia.jpg', 'http://blogs.publico.es/vicenc-navarro/2015/02/17/el-ataque-frontal-del-gobierno-aleman-y-el-bce-a-grecia/'),
(16, 'Pau Collantes', 'Alemania se impone en el Eurogrupo: ultimátum a Grecia para que pida una extensión del rescate', ' La que parecía iba a ser una reunión interminable, la del Eurogrupo de este lunes, finalmente ha sido un fracaso en toda regla que pone a la eurozona y a sus 19 países miembros al límite, con la divisa comunitaria pendiendo sobre un fino alambre. Al término de la breve reunión, el presidente del Eurogrupo, el holandés Jeroen Dijsselbloem, se ha declarado en rueda de prensa “muy decepcionado” y ha dado hasta el viernes un ultimátum al Gobierno de Grecia para que acepte la extensión del rescate, el programa de 130.000 millones de euros lanzado en 2012 a cambio de reformas. Atenas tiene cuatro días, hasta el viernes, para decidirse.\r\n\r\n“Está claro que el próximo paso tiene que venir de las autoridades griegas”, ha señalado Dijsselbloem. “A la vista del calendario, podemos estar hablando de esta semana, pero no tenemos más tiempo”, ha agregado el neerlandés, confirmando que el límite de la paciencia del Eurogrupo finaliza el viernes. En realidad, el plan de rescate a Grecia concluye más tarde, el 28 de febrero.', '2015-02-17 20:13:34', '2015-02-17 20:14:16', '../img/Varufakis-Berlin-hablado-posible.jpg', 'http://www.eldiario.es/economia/Alemania-Eurogrupo-ultimatum-Grecia-extension_0_357315240.html'),
(17, 'Geoffroy Clavel', '49.3 et Loi Macron : le gouvernement Valls ne sera pas censuré mais...', 'POLITIQUE - Contraint de passer par l''article 49.3 de la Constitution pour imposer l''adoption de la loi Macron, le premier ministre Manuel Valls sort grandement fragilisé d''une journée tendue à l''Assemblée nationale. Alors que le chef du gouvernement semblait sur un nuage depuis les attentats de la mi-janvier et la victoire in extremis du PS lors de la législative partielle du Doubs, celui-ci a été brutalement rappelé ce mardi 17 février à la réalité politique des divisions de sa propre majorité.\r\n\r\nComme le précise la Constitution, l''article 49.3 permet à l''exécutif d''imposer l''adoption d''un texte de loi en engageant sa responsabilité. Seul le vote d''une motion de censure à la majorité absolue des députés peut l''empêcher, ce qui précipiterait la chute du gouvernement Valls.\r\n\r\nAvant même la confirmation du recours à cet article très critiqué par la gauche, le groupe UMP présidé par Christian Jacob s''est empressé d''annoncer qu''il déposerait une motion de censure qui devrait donc être votée ce jeudi dans la soirée. Il suffit de 60 députés signataires (l''UMP en compte plus de 180) pour qu''une motion soit soumise au vote. Et l''UDI a annoncé qu''elle s''y joindrait.', '2015-02-17 20:22:00', '2015-02-17 20:22:00', '../img/n-VALLS-MACRON-large570.jpg', 'http://www.huffingtonpost.fr/?country=FR');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

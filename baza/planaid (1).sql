-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2015 at 09:45 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `planaid`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE IF NOT EXISTS `komentari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime NOT NULL,
  `autor` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `vijest` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vijest` (`vijest`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `datum`, `autor`, `email`, `tekst`, `vijest`) VALUES
(4, '2015-05-25 18:20:15', 'Aida', 'aploco1@etf.unsa.ba', 'Ovo je neki komentar', 4),
(8, '2015-05-25 19:06:55', 'Ploco', 'aploco1@etf.unsa.ba', 'Ovo je drugi komentar', 4),
(9, '2015-05-25 19:07:54', 'Aidaaa', 'aploco1@etf.unsa.ba', 'Ovo je opet komentar', 4),
(10, '2015-05-26 13:23:04', 'Aida', 'aploco1@etf.unsa.ba', 'pa to je sjajnoooo', 11),
(11, '2015-05-26 13:25:00', 'Aida', 'aploco1@etf.unsa.ba', 'fenomenalnooo', 11),
(12, '2015-05-26 13:28:01', 'Aida', 'aploco1@etf.unsa.ba', 'aa daaaaj', 10),
(13, '2015-05-26 13:30:10', 'ajajaa', 'ajaaj@email.com', 'rekurzija', 3),
(14, '2015-05-26 13:34:22', '', '', 'ovo je komentar', 6),
(25, '2015-05-26 14:49:37', '', '', 'kommmm', 3),
(27, '2015-05-26 14:57:27', 'pjazno', '', 'ovo je komentarr', 10);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `sifra` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `username`, `sifra`, `email`) VALUES
(1, 'admin', 'adminpass', 'aploco1@etf.unsa.ba'),
(2, 'zloco', 'zlocoo', 'email@email.com'),
(3, 'user1', 'user123', 'user1@email.com'),
(5, 'user2', 'user222', 'user2@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE IF NOT EXISTS `novosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime NOT NULL,
  `autor` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `naslov` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `slika` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `detaljnije` text COLLATE utf8_slovenian_ci NOT NULL,
  `vrsta_novosti` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`id`, `datum`, `autor`, `naslov`, `slika`, `tekst`, `detaljnije`, `vrsta_novosti`) VALUES
(3, '2015-03-28 00:00:00', 'Aida Pločo', 'Carl cox skenderija', 'http://primate.hu/wp-content/uploads/2014/12/Carl-Cox-Garnier_zps035219de.jpg', 'VinylRecords vam predstavlja DJ Carl Cox-a globalnu techno i house zvijezdu. Proglašen je najboljim DJ-em 1996. i 1997. od strane DJ Magazine. Nastupao je na mnogim festivalima, među kojima su i Ultra Music Festival, Tomorrowland, Global Gathering i Electric Daisy Carnival. ', 'Ovdje sada slijedi detaljniji tekst novosti. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'nove_vijesti'),
(4, '2015-05-25 14:02:55', 'Aida Pločo', 'Petar dundov vip arena zenica', 'http://www.pozitivanritam.hr/sites/default/files/clubbing/petar2.jpg', 'Iz naše susjedne države stiže nam DJ Petar Dundov. Nastupat će u VIP Areni Zenica u subotu 9. maja 2015. godine. Karte se već mogu naći u pretprodaji za 8KM, a na dan eventa iznosit će 10KM. ', 'Ovdje sada slijedi detaljniji tekst novosti. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'nove_vijesti'),
(5, '2015-05-23 00:00:00', 'Aida Pločo', 'Eminem otkazan', 'http://onwaxmagazine.com/owm/wp-content/uploads/2011/03/Eminem-300x200.jpg', 'Nastup najpoznatije svjetske hip-hop zvijezde Marshall Mathers, poznatiji kao Eminem, je nažalost otkazan. Zbog vremenskih nepogoda, slavni reper nije mogao doputovati u Sarajevo. Organizator se ovom prilikom izvinjava, te će se detalji o ', 'Ovdje sada slijedi detaljniji tekst novosti. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'sve_vijesti'),
(6, '2015-05-24 00:00:00', 'Aida Pločo', 'Oliver dragojevic coloseum club sarajevo', 'http://www.mojportal.ba/img/sd2/400x300/slike/novosti/AAA%20SHOWBIZ/MUZIKA/oliver_dragojevic3.jpg', 'Omiljeni hrvatski pjevač Oliver Dragojević, popularan i među starijim i mlađim generacijama je potvrdio svoj nastup u Sarajevu. Njegov album Dvi, tri riči je prodan u platinastoj tiraži. On je jedan od rijetkih hrvatskih pjevača koji se mogu pohvaliti sa nastupima u ', 'Ovdje sada slijedi detaljniji tekst novosti. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'sve_vijesti'),
(7, '2015-05-25 15:52:59', 'Aida Pločo', 'Iron maiden zetra', 'http://static.underthegunreview.net/uploads/2012/02/iron-maiden-300x170.jpg', 'Sa velikim ponosom vam predstavljamo, po prvi put u BiH nastupat će Iron Maiden, koji mnogi smatraju sinonimom heavy metala. Bend koji iza sebe ima 15 albuma i preko 85 miliona prodanih albuma širom svijeta će nastupati u sarajev ', 'Ovdje sada slijedi detaljniji tekst novosti. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'sve_vijesti'),
(8, '2015-05-25 15:53:33', 'Aida Pločo', 'Carl cox skenderija', 'http://primate.hu/wp-content/uploads/2014/12/Carl-Cox-Garnier_zps035219de.jpg', 'VinylRecords vam predstavlja DJ Carl Cox-a globalnu techno i house zvijezdu. Proglašen je najboljim DJ-em 1996. i 1997. od strane DJ Magazine. Nastupao je na mnogim festivalima, među kojima su i Ultra Music Festival, Tomorrowland, Global Gathering i Electric Daisy Carnival. ', 'Ovdje sada slijedi detaljniji tekst novosti. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'sve_vijesti'),
(9, '2015-05-25 15:54:07', 'Aida Pločo', 'Petar dundov vip arena zenica', 'http://www.pozitivanritam.hr/sites/default/files/clubbing/petar2.jpg', 'Iz naše susjedne države stiže nam DJ Petar Dundov. Nastupat će u VIP Areni Zenica u subotu 9. maja 2015. godine. Karte se već mogu naći u pretprodaji za 8KM, a na dan eventa iznosit će 10KM. ', 'Ovdje sada slijedi detaljniji tekst novosti. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'sve_vijesti'),
(10, '2015-05-23 00:00:00', 'Aida Pločo', 'Eminem otkazan', 'http://onwaxmagazine.com/owm/wp-content/uploads/2011/03/Eminem-300x200.jpg', 'Nastup najpoznatije svjetske hip-hop zvijezde Marshall Mathers, poznatiji kao Eminem, je nažalost otkazan. Zbog vremenskih nepogoda, slavni reper nije mogao doputovati u Sarajevo. Organizator se ovom prilikom izvinjava, te će se detalji o ', 'Ovdje sada slijedi detaljniji tekst novosti. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'najcitanije_vijesti'),
(11, '2015-05-25 15:55:11', 'Aida Pločo', 'Iron maiden zetra', 'http://static.underthegunreview.net/uploads/2012/02/iron-maiden-300x170.jpg', 'Sa velikim ponosom vam predstavljamo, po prvi put u BiH nastupat će Iron Maiden, koji mnogi smatraju sinonimom heavy metala. Bend koji iza sebe ima 15 albuma i preko 85 miliona prodanih albuma širom svijeta će nastupati u sarajev ', 'Ovdje sada slijedi detaljniji tekst novosti. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'najcitanije_vijesti');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`vijest`) REFERENCES `novosti` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- maak database WATERBUDDY_STORE 
DROP DATABASE IF EXISTS `waterbuddy_store`;
CREATE DATABASE `waterbuddy_store`;
USE `waterbuddy_store`;

SET NAMES utf8 ;
SET character_set_client = utf8mb4 ;

-- maak tabel `klanten`
CREATE TABLE `customers` (
	`customernr` 	INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` 		VARCHAR(50) NOT NULL,
	`address` 		VARCHAR(40) NOT NULL,
	`zipcode` 	VARCHAR(7) NOT NULL,
	`city`		VARCHAR(40) NOT NULL,
	`emailaddress`	VARCHAR(60) NOT NULL,
  password 	CHAR(40) NOT NULL,
  `klantnr` 	INT UNSIGNED NOT NULL,
	`naam` 		VARCHAR(50) NOT NULL,
	`adres` 		VARCHAR(40) NOT NULL,
	`postcode` 	VARCHAR(7) NOT NULL,
	`stad`		VARCHAR(40) NOT NULL,
	`emailadres`	VARCHAR(60) NOT NULL,
	KEY(customernr),
	PRIMARY KEY (emailaddress)
);

INSERT INTO `customers` (`name`, `address`, `zipcode`, `city`, `emailaddress`, `password`, `naam`, `adres`, `postcode`, `stad`, `emailadres`) VALUES
('test', 'Koningsweg 34', '2351GF', 'Test', 'test@test.nl', SHA1('test'), 'test', 'Koningsweg 34', '2351GF', 'Test', 'test@test.nl');

-- maak tabel `leveranciers`
CREATE TABLE `leveranciers` (
	`leverancier_id` smallint(6) NOT NULL AUTO_INCREMENT,
    `naam` varchar(50) NOT NULL,
    PRIMARY KEY (`leverancier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5;
INSERT INTO `leveranciers` VALUES (1,'AHOLD');
INSERT INTO `leveranciers` VALUES (2,'NLTECH');
INSERT INTO `leveranciers` VALUES (3,'HORNBACH');
INSERT INTO `leveranciers` VALUES (4,'GAMMA');

-- maak tabel `medewerkers`
CREATE TABLE `medewerkers` (
	`medewerker_id` int(11) NOT NULL AUTO_INCREMENT,
    `voornaam` varchar(50) NOT NULL,
    `achternaam` varchar(50) NOT NULL,
    `functie` varchar(50) NOT NULL,
    `telefoon` varchar(50) NULL,
    `email` varchar(50) NOT NULL,
    `toetredings_datum` Date NOT NULL,
    `salaris` int(10) NOT NULL,
    `rapporteert_aan` int(10) NULL,
    PRIMARY KEY (`medewerker_id`),
    KEY `fk_medewerkers_medewerkers_idx` (`rapporteert_aan`),
    CONSTRAINT `fk_medewerkers_managers` FOREIGN KEY (`rapporteert_aan`) 
			REFERENCES `medewerkers` (`medewerker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6;
INSERT INTO `medewerkers` VALUES (1,'Huseyin','Tufekci','CEO',0680254166,'h.tufekci@waterbuddy.nl','2021-12-01',110150,NULL);
INSERT INTO `medewerkers` VALUES (2,'Lieke','Span','Commercieel directeur',NULL,'l.span@waterbuddy.nl','2021-09-20',62871,1);
INSERT INTO `medewerkers` VALUES (3,'Milan','Toen','Financieel directeur',0688139155,'m.toen@waterbuddy.nl','2021-11-01',98926,1);
INSERT INTO `medewerkers` VALUES (4,'Ekko','Oosterhout','Operationeel directeur',0612214590,'e.oosterhout@waterbuddy.nl','2021-02-13',94860,2);
INSERT INTO `medewerkers` VALUES (5,'Maria','Baas','Marketing medewerker',NULL,'m.baas@waterbuddy.nl','2021-01-28',63996,3);

-- maak tabel `gebruikers`
CREATE TABLE `gebruikers` (
    `gebruiker_id` int(11) NOT NULL AUTO_INCREMENT,
    `gebruikersnaam` varchar(50) NOT NULL,
    `wachtwoord` varchar(50) NOT NULL,
    -- `klant_id` int(11) NULL,
    `medewerker_id` int(11) NULL,
    PRIMARY KEY (`gebruiker_id`),
    -- KEY `fk_gebruikers_klanten` (`klant_id`),
    KEY `fk_gebruikers_medewerkers` (`medewerker_id`),         
    -- CONSTRAINT `fk_gebruikers_klanten` FOREIGN KEY (`klant_id`) REFERENCES `klanten` (`klant_id`) ON UPDATE CASCADE,
    CONSTRAINT `fk_gebruikers_medewerkers` FOREIGN KEY (`medewerker_id`) REFERENCES `medewerkers` (`medewerker_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4;
INSERT INTO `gebruikers` VALUES (1,'Huseyin','hu07',1);
INSERT INTO `gebruikers` VALUES (2,'Milan','mi05',3);
INSERT INTO `gebruikers` VALUES (3,'Hans','ha09',1);

-- maak tabel `rollen`
CREATE TABLE `rollen` (
    `rol_id` int(11) NOT NULL AUTO_INCREMENT,
    `type` varchar(50) NOT NULL,
    `gebruiker_id` int(11) NOT NULL,
    PRIMARY KEY (`rol_id`),
    KEY `fk_rollen_gebruikers` (`gebruiker_id`),
    CONSTRAINT `fk_rollen_gebruikers` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruikers` (`gebruiker_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5;
INSERT INTO `rollen` VALUES (1,'medewerker',1);
INSERT INTO `rollen` VALUES (2,'klant',3);
INSERT INTO `rollen` VALUES (3,'medewerker',2);

-- maak tabel `bestellingen`
CREATE TABLE `orders` (
  `ordernumber` 	INT(10) NOT NULL AUTO_INCREMENT,
  `customernr` 	INT(6) NOT NULL,
  `orderdate` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `status`			ENUM('open', 'payed', 'send' ) DEFAULT 'open',
  `totalprice` 	DECIMAL(5,2) NOT NULL,
  `bestelnummer` 	INT(10) NOT NULL,
  `klantnr` 	INT(6) NOT NULL,
  `besteldatum` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `staat`			ENUM('open', 'payed', 'send' ) DEFAULT 'open',
  `totaalprijs` 	DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (`ordernumber`, `customernr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Maak tabel `orderline` 
CREATE TABLE `orderline` (
  `ordernumber` 	INT(10) NOT NULL,
  `productnumber` 	INT(10) NOT NULL,
  `productprice` 	DECIMAL(5,2) NOT NULL,
  `amount_ordered` 	INT(3) NOT NULL,
  `bestelnummer` 	INT(10) NOT NULL,
  `productnummer` 	INT(10) NOT NULL,
  `productprijs` 	DECIMAL(5,2) NOT NULL,
  `bestelde_hoevelheid` 	INT(3) NOT NULL,
  PRIMARY KEY (`ordernumber`, `productnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- maak tabel `products`
CREATE TABLE `products` (
  `productnumber`   	INT(10) NOT NULL,
  `productname` 	    varchar(30) NOT NULL,
  `price` 			      DECIMAL(5,2) NOT NULL,
  `description` 	    varchar(9999) NOT NULL, 
  `deliverable`       ENUM('yes', 'no'),
  `stock` 		        INT(5),  
  `productnummer`   	INT(10) NOT NULL,
  `productnaam` 	    varchar(30) NOT NULL,
  `prijs` 			      DECIMAL(5,2) NOT NULL,
  `beschrijving` 	    varchar(9999) NOT NULL, 
  `leverbaar`         ENUM('yes', 'no'),
  `voorraad` 		      INT(5),  
  PRIMARY KEY (`productnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `products` (`productnumber`, `productname`, `price`, `description`,  `deliverable`, `stock`, `productnummer`, `productnaam`, `prijs`, `beschrijving`,  `leverbaar`, `voorraad`) VALUES
('001', 'WaterBuddy Basic', '14.99', 'The WaterBuddy basic is your Basic smart plant helper.', 'yes', '30','001', 'WaterBuddy Basis', '14.99', 'The WaterBuddy basis is jou beste slimme plant helper.', 'ja', '30'),
('002', 'WaterBuddy Pro', '24.99', 'The WaterBuddy Pro is your plants best friend!', 'yes', '24','002', 'WaterBuddy Pro', '24.99', 'The WaterBuddy Pro je plants beste vriend!', 'ja', '24');

-- maak tabel `zoekresultaten`
CREATE TABLE `zoekresultaten` (
	`product_id` int(11) NOT NULL AUTO_INCREMENT,
    `naam` varchar(50) NOT NULL,
    `voorraad` int(10) NOT NULL,
    `prijs` decimal(5,2) NOT NULL,
    PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11;
INSERT INTO `zoekresultaten` VALUES (1,'Waterbuddy basic model, A',160,9.95);
INSERT INTO `zoekresultaten` VALUES (2,'Waterbuddy basic model, B',145,19.95);
INSERT INTO `zoekresultaten` VALUES (3,'Waterbuddy basic model, C',120,29.35);
INSERT INTO `zoekresultaten` VALUES (4,'Waterbuddy basic model, D',115,49.53);
INSERT INTO `zoekresultaten` VALUES (5,'Waterbuddy basic model, E',107,55.63);
INSERT INTO `zoekresultaten` VALUES (6,'Waterbuddy pro model, PRO1',85,69.96);
INSERT INTO `zoekresultaten` VALUES (7,'Waterbuddy pro model, PRO2',70,144.80);
INSERT INTO `zoekresultaten` VALUES (8,'Waterbuddy pro model, PRO3',57,176.90);
INSERT INTO `zoekresultaten` VALUES (9,'Waterbuddy pro model, PRO4',18,199.95);
INSERT INTO `zoekresultaten` VALUES (10,'Waterbuddy pro model, PRO5',4,255.17);

-- maak tabel `inkomende berichten`
CREATE TABLE `message_incoming` (
    `message_id` int(11) NOT NULL AUTO_INCREMENT,
    `firstname` varchar(50) NOT NULL,
    `lastname` varchar(50) NOT NULL,
    `email` varchar(255) NOT NULL,
    `subject` varchar(255) NOT NULL,
    PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4;
INSERT INTO `message_incoming` VALUES (1,'Hans','Anders','hans_anders@avans.nl', 'Hallo, Welcome bij Waterbuddy!');
INSERT INTO `message_incoming` VALUES (2,'Jan','Smith','jan_smith@avans.nl', 'Hallo Wereld!');
INSERT INTO `message_incoming` VALUES (3,'Johan','Cruijff','johan_cruijff@avans.nl', 'Dit is een test!');

-- maak tabel `zoektermen`
CREATE TABLE `zoektermen` (
	`zoeknummer` int(11) NOT NULL AUTO_INCREMENT,
    `zoekterm` varchar(50) NOT NULL,
    PRIMARY KEY (`zoeknummer`)
) ENGINE=InnoDB AUTO_INCREMENT=7;
INSERT INTO `zoektermen` VALUES (1,'basic');
INSERT INTO `zoektermen` VALUES (2,'advanced');

-- maak tabel `nieuwsbrieven`
CREATE TABLE `nieuwsbrieven` (
    `nieuwsbrief_id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(255) NOT NULL,
    PRIMARY KEY (`nieuwsbrief_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2;
INSERT INTO `nieuwsbrieven` VALUES (1,'jan_smith@avans.nl');

-- maak tabel `images` 
CREATE TABLE `images` (
	`image_id` 	  tinyint(3) NOT NULL AUTO_INCREMENT,
	`image_type` 	varchar(25) NOT NULL,
	`image` 		  longblob NOT NULL,
	`image_size` 	varchar(25) NOT NULL,
	`image_ctgy` 	varchar(25) NOT NULL,
	`image_name` 	varchar(50) NOT NULL,
	KEY `image_id` (`image_id`)
);

INSERT INTO `images` (`image_id`, `image_type`, `image`, `image_size`, `image_ctgy`, `image_name`)
VALUES 
(1, 'image/png', 'C:\XAMPP\htdocs\WaterBuddy\CSS\Images\WaterBuddy_Basic_Plant.png', 'width="180" height="180"', '', 'WaterBuddy_Basic_Plant.png' ),
(2, 'image/png', 'C:\XAMPP\htdocs\WaterBuddy\CSS\Images\Webshop\WaterBuddy_Pro_Plant.png', 'width="180" height="180"', '', 'WaterBuddy_Pro_Plant.png' );


-- maak tabel
CREATE TABLE `product_images` (
  `productnumber` int(10) NOT NULL,
  `image_id` tinyint(3) NOT NULL,
  PRIMARY KEY (`productnumber`, `image_id`),
  KEY `fk_image` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product_images` (`productnumber`, `image_id`) VALUES 
(001, 1),
(002, 2);

ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`) ON UPDATE CASCADE;
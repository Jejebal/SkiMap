-- Project      : SkiMap
-- Description  : Un site web permettant de vérifier les station de ski Suisse.
-- File         : 05-data.sql
-- Authors      : Jérémy Ballanfat
-- Date         : 2 Février 2024

USE ski_map;

-- ---------------------------------------------------------------
-- Tables domaines
-- ---------------------------------------------------------------

INSERT INTO `domaines` (`domaines`.`nom_domaine`) 
VALUE ("Les 3 Vallées");

-- ---------------------------------------------------------------
-- Tables stations
-- ---------------------------------------------------------------

INSERT INTO `stations` (`stations`.`nom_station`, `stations`.`id_domaine`) VALUES 
("Courchevel", 1),
("Méribel", 1),
("Les Menuires / Saint-Martin-de-Belleville", 1),
("Val Thorens", 1),
("Orelle", 1);

-- ---------------------------------------------------------------
-- Tables points
-- ---------------------------------------------------------------

INSERT INTO `points` (`points`.`latitude`, `points`.`longitude`, `points`.`id_station`) VALUES
();
-- Project      : SkiMap
-- Description  : Un site web permettant de vérifier les station de ski Suisse.
-- File         : backend/sql/03-tables.sql
-- Authors      : Jérémy Ballanfat
-- Date         : 2 Février 2024

USE ski_map;

-- ---------------------------------------------------------------
-- Tables principale
-- ---------------------------------------------------------------

CREATE TABLE IF NOT EXISTS domaines (
	id_domaine INT PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
    nom_domaine VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS stations (
	id_station INT PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
    nom_station VARCHAR(100) NOT NULL UNIQUE,
    id_domaine INT NOT NULL
);

CREATE TABLE IF NOT EXISTS points (
	id_point INT PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
    latitude FLOAT NOT NULL,
    longitude FLOAT NOT NULL,
    id_station INT NOT NULL
);

CREATE TABLE IF NOT EXISTS utilisateur (
	id_utilisateur INT PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
    pseudo VARCHAR(100) NOT NULL UNIQUE,
    mot_passe VARCHAR(256) NOT NULL
);
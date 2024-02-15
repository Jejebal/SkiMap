-- Project      : SkiMap
-- Description  : Un site web permettant de vérifier les station de ski Suisse.
-- File         : backend/sql/04-constrainte.sql
-- Authors      : Jérémy Ballanfat
-- Date         : 2 Février 2024

USE ski_map;

------------------------------------------------
-- Contraintes
------------------------------------------------

ALTER TABLE stations
ADD CONSTRAINT fk_stations_domaines
FOREIGN KEY (id_domaine)
REFERENCES domaines(id_domaine);

ALTER TABLE points
ADD CONSTRAINT fk_points_stations
FOREIGN KEY (id_station)
REFERENCES stations(id_station);
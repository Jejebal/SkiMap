-- Project      : SkiMap
-- Description  : Un site web permettant de vérifier les station de ski Suisse.
-- File         : backend/sql/02-user.sql
-- Authors      : Jérémy Ballanfat
-- Date         : 2 Février 2024

USE ski_map;

DROP USER IF EXISTS "ski_user"@"localhost";

CREATE USER "ski_user"@"localhost" IDENTIFIED BY "ski_super";

GRANT INSERT ON ski_map.* TO "ski_user"@"localhost";
GRANT SELECT ON ski_map.* TO "ski_user"@"localhost";
GRANT UPDATE ON ski_map.* TO "ski_user"@"localhost";
GRANT DELETE ON ski_map.* TO "ski_user"@"localhost";
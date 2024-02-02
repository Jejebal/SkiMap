<?php

/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : backend/php/function/constantes.php
 * Authors      : Jérémy Ballanfat
 * Date         : 2 Février 2024
 */

// Constantes liées à la base de données
define('BDD_HOTE', 'localhost');
define('BDD_NOM', 'ski_map');
define('BDD_UTILISATEUR', 'ski_user');
define('BDD_MOT_DE_PASSE', 'ski_super');
define('BDD_CHARSET', 'utf8mb4');

define('RETOURNE_INFORMATION', 200);
define('MODIFIE_RESSOURCE', 200);
define('EFFACE_RESSOURCE', 200);
define('CREE_RESSOURCE', 201);
define('INCOMPLET', 400);
define('AUTHENTIFIER', 401);
define('ACCES_REFUSER', 403);
define('RESSOURCE_INTROUVABLE', 404);
define('THEIERE', 418);
define('SERVEUR_PROBLEME', 500);
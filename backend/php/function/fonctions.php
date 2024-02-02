<?php
/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : backend/php/function/constantes.php
 * Authors      : Jérémy Ballanfat
 * Date         : 2 Février 2024
 */

require_once("constantes.php");

/**
 * 
 * Permet de créez le lien entre la base de données et l'api si cela n'a pas déjà été éffectuez.
 * 
 * @return PDO Le liens utilisez pour éffctuez toute les commande.
 * 
 */
function connexionBDD() : PDO {
    static $pdo = null;

    if ($pdo === null){
        
        $dsn = "mysql:host=" . BDD_HOTE . ";dbname=" . BDD_NOM . ";charset=" . BDD_CHARSET;

        $option = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $pdo = new PDO($dsn, BDD_UTILISATEUR, BDD_MOT_DE_PASSE, $option);
        
    }

    return $pdo;
}

/**
 * 
 * Permet d’exécuté les commandes avec les condition données en choisissent si oui ou non on veut récupérez des information et si il y en a plusieurs ou non.
 * 
 * @param PDO Le lien a la base de données utilisez pour effectuez les commande.
 * @param string $sql La commande a effectuez.
 * @param array $condition Les condition avec les quel la commande doit être effectuez.
 * @param bool $all Permet de spécifier si oui ou non il y aura plusieurs ou juste une donnée a récupérez.
 * @param bool $recupere Permet de spécifier si oui ou non des données a la fin doivent être récupérez.
 * 
 * @return array Les différent données récupérez après l’effectuation de la commande.
 * @return false Retourne false si une erreur occurre pendant l’effectuation de la commande.
 * @return null Retourne null si aucune données n'est a récupérez.
 * 
 */
function effectuezCommande(PDO $bdd, string $sql, array $condition, bool $all = false, bool $recupere = true) : array | false | null{

    $statement = $bdd->prepare($sql);

    $statement->execute($condition);

    if($recupere){

        if($all){
    
            return $statement->fetchAll(PDO::FETCH_ASSOC);
    
        }
        else {
    
            return $statement->fetch(PDO::FETCH_ASSOC);
    
        }

    }

    return null;

}

function recuperDonner() : array{

    $chaine = file_get_contents('php://input');
    if(!$chaine){

        return[];

    }

    $tableau = json_decode($chaine, true);

    if(!is_array($tableau)){

        return[];
        
    }

    return $tableau;
}
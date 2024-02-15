<?php

/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : /src/model/Utilisateur.php
 * Authors      : Jérémy Ballanfat
 * Date         : 15 Février 2024
 */

namespace Jeremybllnf\Skimap\model;

use Jeremybllnf\Skimap\model\BaseModel as BaseModel;

use Jeremybllnf\Skimap\model\Database as DataBase;

class Utilisateur extends BaseModel {

    protected $map = [
        "id_utilisateur" => "idUtilisateur",
        "pseudo" => "pseudo",
        "mot_passe" => "motPasse"
    ];

    /** Identifiant d'un user */
    public int $idUtilisateur;

    /** Le pseudo caractérisant un user  */
    public string $pseudo;

    /**  Le mot de pass du user */
    public string $motPasse;

    /**
     * 
     * La fonction permettant de créer un user avec les information données.
     * 
     */

    public function __construct(array $init= [])
    {

        $this->idUtilisateur = $init["id_utilisateur"] ?? -1;
        $this->pseudo = $init["pseudo"] ?? "";
        $this->motPasse = $init["mot_passe"] ?? "";
        
    }


    /**
     * 
     * Permet de hacher un mot de passe données.
     * 
     * @param string $password Le mot de passe a hacher.
     * @return string|false Si les étape sont passer sans erreur le mot de passe hacher est retourner au sinon retourne false.
     * 
     */
    public function passwordHash(string $motPasse) : string | false{

        if(strlen($motPasse) > 8){

            return password_hash($motPasse, PASSWORD_DEFAULT);

        }

        return false;

    }

    /**
     * 
     * Lit un user à partir de son pseudo puis vérifier le mot de passe corespondent.
     * 
     * @param string $pseudo Le pseudo du user à cherchez.
     * @param string $password Le mot de passe a vérifié avec le hash dans la base de données.
     * @return Utilisateur|null Retourne le user si toute les étape sont valider ou false si une seul ne l'est pas.
     * 
     */
    public static function selectByLogin(string $pseudo, string $motPasse) : Utilisateur | false{

        $user = Utilisateur::pseudoExist($pseudo);

        if(is_a($user, "Jeremybllnf\Skimap\model\Utilisateur")){

            if(password_verify($motPasse, $user->motPasse)){

                $user->motPasse = "";

                return $user;

            }

        }

        return false;

    }

    public static function pseudoExist(string $pseudo) : Utilisateur | false{

        $query = "SELECT * 
        FROM `utilisateur` 
        WHERE `utilisateur`.`pseudo` = :pseudo;";

        $param = [":pseudo" => $pseudo];

        $statement = DataBase::getDB()->run($query, $param);
        $statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, __CLASS__);
        $user = $statement->fetch();

        return $user;

    }

    /**
     * 
     * Permet d'insérez un user dans la base de données.
     * 
     */
    public function insert() : int{

        $query = "INSERT INTO `utilisateur` (`utilisateur`.`pseudo`, `utilisateur`.`mot_passe`)
        VALUE (:pseudo, :password);";

        $this->motPasse = $this->passwordHash($this->motPasse);

        $param = [
            
            ":pseudo" => $this->pseudo,
            ":password" => $this->motPasse

        ];

        DataBase::getDB()->run($query, $param);
        return DataBase::getDB()->lastInsertId();

    }

    public static function saveLogin(Utilisateur $user): void{

        $_SESSION["user"] = $user;

    }

    public static function clearLogin() : void{

        $_SESSION["user"] = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

    }

    public static function isConnected() : bool{

        if(isset($_SESSION["user"])){

            return true;

        }

        return false;

    }

}
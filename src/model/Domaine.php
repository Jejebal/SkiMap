<?php 

/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : /src/model/Domaine.php
 * Authors      : Jérémy Ballanfat
 * Date         : 12 Février 2024
 */

namespace Jeremybllnf\Skimap\model;

use Jeremybllnf\Skimap\model\BaseModel as BaseModel;
use Jeremybllnf\Skimap\model\Database as Database;

class Domaine extends BaseModel{

    protected $map = [
        "id_domaine" => "idDomaine",
        "nom_domaine" => "nomDomaine"
    ];

    /** Identifiant d'un domaine */
    public int $idDomaine;

    /** Le nom caractérisant un domaine  */
    public string $nomDomaine;

    /** Une list des stations contenue dans un domaine  */
    public array $stations;

    public function __construct(array $init = [])
    {

        $this->idDomaine = $init["id_domaine"] ?? -1;
        $this->nomDomaine = $init["nom_domaine"] ?? "";
        $this->stations = [];

        
    }

    /**
     * 
     * Cette fonction permet de récupérez touts les domaines de la base de données.
     * 
     * @return array|false Retourne une list de domaine si la requête sql passe sans problème.
     * 
     */
    public static function getAllDomaine() : array | false{

        $query = "SELECT * FROM `domaines`;";

        $statement = DataBase::getDB()->run($query);
        $statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, __CLASS__);
        return $statement->fetchAll();

    }

}
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

    public int $idDomaine;

    public string $nomDomaine;

    public array $stations;

    public function __construct(array $init = [])
    {

        $this->idDomaine = $init["id_domaine"] ?? -1;
        $this->nomDomaine = $init["nom_domaine"] ?? "";
        $this->stations = [];

        
    }

    public static function getAllDomaine() : array | false{

        $query = "SELECT * FROM `domaines`;";

        $statement = DataBase::getDB()->run($query);
        $statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, __CLASS__);
        return $statement->fetchAll();

    }

}
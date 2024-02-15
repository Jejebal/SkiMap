<?php 

/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : /src/model/Station.php
 * Authors      : Jérémy Ballanfat
 * Date         : 12 Février 2024
 */

namespace Jeremybllnf\Skimap\model;

use Jeremybllnf\Skimap\model\BaseModel as BaseModel;
use Jeremybllnf\Skimap\model\Database as Database;
 
class Station extends BaseModel{
 
    protected $map = [
        "id_station" => "idStation",
        "nom_station" => "nomStation",
        "id_domaine" => "idDomaine"
    ];
 
    public int $idStation;
 
    public string $nomStation;

    public int $idDomaine;

    public array $points;
 
    public function __construct(array $init = [])
    {
 
        $this->idPoint = $init["id_station"] ?? -1;
        $this->latitude = $init["nom_station"] ?? "";
        $this->longitude = $init["id_domaine"] ?? -1;
        $this->points = [];
         
    }

    public static function getAllStationByDomaine(int $id) : array | false{

        $query = "SELECT * FROM `stations`
        WHERE `stations`.`id_domaine` = :id;";

        $param = [":id" => $id];

        $statement = DataBase::getDB()->run($query, $param);
        $statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, __CLASS__);
        return $statement->fetchAll();

    }
 
}
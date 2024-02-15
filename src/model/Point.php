<?php 

/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : /src/model/Point.php
 * Authors      : Jérémy Ballanfat
 * Date         : 12 Février 2024
 */

namespace Jeremybllnf\Skimap\model;

use Jeremybllnf\Skimap\model\BaseModel as BaseModel;
use Jeremybllnf\Skimap\model\Database as Database;
 
class Point extends BaseModel{
 
    protected $map = [
        "id_point" => "idPoint",
        "latitude" => "latitude",
        "longitude" => "longitude",
        "id_station" => "idStation"
    ];
 
    public int $idPoint;
 
    public float $latitude;

    public float $longitude;

    public int $idStation;
 
    public function __construct(array $init = [])
    {
 
        $this->idPoint = $init["id_point"] ?? -1;
        $this->latitude = $init["latitude"] ?? -1.0;
        $this->longitude = $init["longitude"] ?? -1.0;
        $this->idStation = $init["id_station"] ?? -1;
 
         
    }

    /**
     * 
     * Cette fonction permet de récupérez toutes les points liez à un domaine.
     * 
     * @param int $id L'identifiant du domaine
     * 
     * @return array|false Retourne une list de station si la requête sql passe sans problème.
     * 
     */
    public static function getAllPointByStation(int $id) : array | false{

        $query = "SELECT * FROM `points`
        WHERE `points`.`id_station` = :id;";

        $param = [":id" => $id];

        $statement = DataBase::getDB()->run($query, $param);
        $statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, __CLASS__);
        return $statement->fetchAll();

    }
 
}
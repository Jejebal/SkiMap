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
 
    /** Identifiant d'une station */
    public int $idStation;
 
    /** Le nom caractérisant une station  */
    public string $nomStation;

    /** L'identifiant du domaine lier à une station  */
    public int $idDomaine;

    /** Une list des points délimitant une station  */
    public array $points;
 
    public function __construct(array $init = [])
    {
 
        $this->idPoint = $init["id_station"] ?? -1;
        $this->latitude = $init["nom_station"] ?? "";
        $this->longitude = $init["id_domaine"] ?? -1;
        $this->points = [];
         
    }

    /**
     * 
     * Cette fonction permet de récupérez toutes les stations liez à une station.
     * 
     * @param int $id L'identifiant de la station
     * 
     * @return array|false Retourne une list de point si la requête sql passe sans problème.
     * 
     */
    public static function getAllStationByDomaine(int $id) : array | false{

        $query = "SELECT * FROM `stations`
        WHERE `stations`.`id_domaine` = :id;";

        $param = [":id" => $id];

        $statement = DataBase::getDB()->run($query, $param);
        $statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, __CLASS__);
        return $statement->fetchAll();

    }
 
}
<?php

/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : /src/controller/MapCtrl.php
 * Authors      : Jérémy Ballanfat
 * Date         : 12 Février 2024
 */

namespace Jeremybllnf\Skimap\controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Jeremybllnf\Skimap\controller\MainCtrl as MainCtrl;

use Jeremybllnf\Skimap\model\Domaine as Domaine;
use Jeremybllnf\Skimap\model\Station as Station;
use Jeremybllnf\Skimap\model\Point as Point;

class MapCtrl {

    /**
     * 
     * Cette fonction permet d'afficher la view map.
     * 
     */
    public function showMap(Request $request, Response $response){

        session_start();

        $main = new MainCtrl();

        if(isset($_SESSION["user"])){

            if(!isset($_SESSION["domaine"])){

                $domaines = Domaine::getAllDomaine();
    
                foreach($domaines as $key => $domaine){
    
                    $domaines[$key]->stations = Station::getAllStationByDomaine($domaine->idDomaine);
    
                }
    
                foreach($domaines as $key => $domaine){
    
                    foreach($domaine->stations as $key => $station){
    
                        $domaine->stations[$key]->points = Point::getAllPointByStation($station->idStation);
    
                    }
    
                }
    
            }
    
            return $main->makeLayout($request, $response, "Map", "map.php", ["error" => "", "donnees" => json_encode($domaines)]);

        }
        else{

            return $main->redirection($request, $response, "login");

        }

    }

}
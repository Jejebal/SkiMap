<?php

/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : frontend/main.js
 * Authors      : Jérémy Ballanfat
 * Date         : 12 Février 2024
 */


use Jeremybllnf\Skimap\controller\MapCtrl as MapCtrl;
use Jeremybllnf\Skimap\controller\LoginCtrl as LoginCtrl;

$app->get("/", [LoginCtrl::class, "loginShow"])
    ->setName("login");

$app->post("/", [LoginCtrl::class, "loginCheck"]);

$app->get("/inscrire", [LoginCtrl::class, "inscriptionShow"])
    ->setName("inscrire");

$app->post("/inscrire", [LoginCtrl::class, "inscriptionCreate"]);


$app->get("/map", [MapCtrl::class, "showMap"])
    ->setName("map");
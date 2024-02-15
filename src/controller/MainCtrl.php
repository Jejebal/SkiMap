<?php

/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : /src/controller/MainCtrl.php
 * Authors      : Jérémy Ballanfat
 * Date         : 12 Février 2024
 */

namespace Jeremybllnf\Skimap\controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

use Slim\Routing\RouteContext;

class MainCtrl {

    /**
     * 
     * Cette fonction permet de créer la page a afficher avec les information nécessaire dedans.
     * 
     */
    public static function makeLayout(Request $request, Response $response, string $title, string $page, array $element){

        $phpView = new PhpRenderer(
            "../src/view",
            ["title" => $title, /*..*/]
        );

        $phpView->setLayout("layout.php");

        return $phpView->render(
            $response,
            $page,
            $element
        );

    }

    /**
     * 
     * Cette fonction permet de redirigé la navigation vers une autre page.
     * 
     */
    public static function redirection(Request $request, Response $response, string $page){

        $reouteParser = RouteContext::fromRequest($request)->getRouteParser();
            
            return $response
                ->withHeader("Location", $reouteParser->urlFor($page))
                ->withStatus(302);

    }

}
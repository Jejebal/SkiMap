<?php

/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : /src/controller/LoginCtrl.php
 * Authors      : Jérémy Ballanfat
 * Date         : 12 Février 2024
 */

namespace Jeremybllnf\Skimap\controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Jeremybllnf\Skimap\model\Utilisateur as Utilisateur;

class LoginCtrl {

    /**
     * 
     * Cette fonction permet d'afficher la view inscrire pour la création d'un compte.
     * 
     */
    public function inscriptionShow(Request $request, Response $response){

        session_start();

        $main = new MainCtrl();

        if(isset($_SESSION["user"])){

            return $main->redirection($request, $response, "map");

        }

        return $main->makeLayout($request, $response, "Inscrire", "inscrire.php", 
        [

            "titre" => "Formulaire d'inscription", 
            "erreur" => ""

        ]);

    }

    /**
     * 
     * Cette fonction permet de vérifiez si l'utilisateur qui veut être créez est valide.
     * 
     */
    public function inscriptionCreate(Request $request, Response $response){

        $main = new MainCtrl();

        $pseudo = filter_input(INPUT_POST, "pseudo");
        $pseudo = strip_tags($pseudo);

        $password = filter_input(INPUT_POST, "password");

        var_dump($password);

        $checkPassword = filter_input(INPUT_POST, "confirmation");
        
        var_dump($checkPassword);

        if($pseudo != "" && (strlen($password) >= 8 && $password == $checkPassword)){

            if(is_a(Utilisateur::pseudoExist($pseudo), "Jeremybllnf\Skimap\model\Utilisateur")){

                return $main->makeLayout($request, $response, "Inscrire", "inscrire.php", 
                [
                    "titre" => "Formulaire d'inscription", 
                    "erreur" => "Le pseudo que vous essayez de rentrez existe déjà. Choisissez en un autre."
                ]);

            }
            else{

                $user = new Utilisateur(["pseudo" => $pseudo, "mot_passe" => $password]);

                $user->idUtilisateur = $user->insert();

                return $main->redirection($request, $response, "login");

            }

        }
        else{

            return $main->makeLayout($request, $response, "Inscrire", "inscrire.php", 
            [
                "titre" => "Formulaire d'inscription", 
                "erreur" => "Votre mot de passe ou votre pseudo ne sont pas valide. Vérifiez que votre mot de passe contient bien 8 caractère minimum."
            ]);

        }

    }

    /**
     * 
     * Cette fonction permet d'afficher la view login pour la connection à un compte.
     * 
     */
    public function loginShow(Request $request, Response $response){

        session_start();

        $main = new MainCtrl();

        if(isset($_SESSION["user"])){

            return $main->redirection($request, $response, "map");

        }

        return $main->makeLayout($request, $response, "Login", "login.php", 
        [

            "titre" => "Formulaire de connection", 
            "erreur" => ""

        ]);

    }

    /**
     * 
     * Cette fonction permet de vérifiez si l'utilisateur qui veut se connectez existe.
     * 
     */
    public function loginCheck(Request $request, Response $response){

        session_start();

        $main = new MainCtrl();

        $pseudo = filter_input(INPUT_POST, "pseudo");
        $pseudo = strip_tags($pseudo);

        $password = filter_input(INPUT_POST, "password");

        if($pseudo != "" && strlen($password) >= 8){

            $user = Utilisateur::selectByLogin($pseudo, $password);

            if(is_a($user, "Jeremybllnf\Skimap\model\Utilisateur")){

                Utilisateur::saveLogin($user);

                return MainCtrl::redirection($request, $response, "map");

            }

        }
        
        return $main->makeLayout($request, $response, "Login", "login.php", 
        [
            "titre" => "Formulaire de connection", 
            "erreur" => "Votre mot de passe ou votre pseudo ne sont pas valide. Vérifiez que votre mot de passe contient bien 8 caractère minimum."
        ]);

    }

}
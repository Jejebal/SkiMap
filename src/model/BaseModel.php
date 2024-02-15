<?php

/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : /src/model/BaseModel.php
 * Authors      : Jérémy Ballanfat
 * Date         : 12 Février 2024
 */

namespace Jeremybllnf\Skimap\model;

class BaseModel {

    /** List des noms de la base de données dans les noms php */

    protected $map = [];

    /**
     * 
     * Vérifie que $name existe dans $map et le change sous la forme php
     * 
     * @param string $name le nom de la variable
     * @param string $value la valeur qui est essayez d'être ajouter
     * 
     */
    public function __set($name, $value): void
    {
        
        if(array_key_exists($name, $this->map)){

            $name = $this->map[$name];

        }

        $this->$name = $value;

    }

}
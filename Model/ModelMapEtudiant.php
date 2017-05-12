<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 08/05/2017
 * Time: 01:17
 */

class ModelMapEtudiant extends Model{
    private $mapEtudiant;

    public function getData(){
        return $this->mapEtudiant;
    }

    public function __construct()
    {
        $this->mapEtudiant = array();
        $this->dataError = array();
    }

    public static function getModelEtudiantAll(){
        $model = new self(array());
        $model-> mapEtudiant = EtudiantGateway::getAllEtudiantsMap();
        return $model;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 10/05/2017
 * Time: 13:57
 */

class ModelCollectionCursus extends Model{

    private $collectionCursus;

    public function getData()
    {
        return $this->collectionCursus;
    }

    public function __construct()
    {
        $this->collectionCursus = array();
        $this->dataError = array();
    }

    public static function getModelCursusAll(){
        $model = new self(array());
        $model->collectionCursus = CursusGateway::getCursusAll();
        return $model;
    }
}
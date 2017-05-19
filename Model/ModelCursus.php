<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 17/05/2017
 * Time: 13:16
 */
class ModelCursus extends model{
    private $cursus;

    public function __construct()
    {
        $this->dataError = array();
    }

    public function getData(){
        return $this->cursus;
    }

    public static function getCrususById($id){
        $model = new self(array());
        $model->cursus = CursusGateway::getCursusById($model->dataError,$id);
        return $model;
    }
}
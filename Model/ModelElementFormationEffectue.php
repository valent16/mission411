<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 01/06/2017
 * Time: 15:14
 */

class ModelElementFormationEffectue extends Model{
    private $element_formation_effectue;

    public function getData(){
        return $this->element_formation_effectue;
    }

    public function __construct()
    {
        $this->dataError = array();
    }

    public static function getElementFormationEffectueById($id){
        $model = new self(array());
        $model->element_formation_effectue = ElementFormationGateway::getElementFormationById($model->dataError, $id);
        return $model;
    }

    public static function deleteElementFormationEffectue($id){
        $model = new self(array());
        $model->element_formation_effectue = ElementFormationGateway::deleteElementFormation($model->dataError, $id);
        return $model;
    }


    public static function getModelElementFormationPost($elementFormationEffectue){
        $model = new self(array());
        $model->element_formation_effectue = ElementFormationGateway::postElementFormation($model->dataError, $elementFormationEffectue);
        return $model;
    }

    public static function getModelElementFormationPut($elementFormationEffectue, $id_cursus){
        $model = new self(array());
        $model->element_formation_effectue = ElementFormationGateway::putElementFormationEffectue($model->dataError,$elementFormationEffectue,$id_cursus);
        return $model;
    }
}
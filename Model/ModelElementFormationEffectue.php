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

    public static function getElementFormationEffectue($idCursus, $id_element_formation, $sem_label){
        $model = new self(array());
        $model->element_formation_effectue = ElementFormationGateway::getElementFormationById($model->dataError, $idCursus, $id_element_formation, $sem_label);
        return $model;
    }

}
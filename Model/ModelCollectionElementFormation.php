<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 19/05/2017
 * Time: 10:33
 */


class ModelCollectionElementFormation extends model{
    private $collectionElementFormation;

    public function getData()
    {
        return $this->collectionElementFormation;
    }

    public static function getModelElementsFormationByIdCursus($idCursus){
        $model = new self(array());
        $model->collectionElementFormation = ElementFormationGateway::getElementFormationByCursus($model->dataError, $idCursus);
        return $model;
    }
}
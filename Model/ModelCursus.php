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

    public static function getCursusById($id){
        $model = new self(array());
        $model->cursus = CursusGateway::getCursusById($model->dataError,$id);
        return $model;
    }

    public static function getModelCursusPut($cursus){
        $model = new self(array());
        $model->cursus = CursusGateway::putCursus($model->dataError, $cursus);
        return $model;
    }

    public static function getModelDeleteCursus($idCursus){
        $model = new self(array());

        $modelElementsFormation = ModelCollectionElementFormation::getModelElementsFormationByIdCursus($idCursus);
        $elementsFormationEffectue = $modelElementsFormation->getData();

        foreach($elementsFormationEffectue as $e){
            ModelElementFormationEffectue::getModelElementFormationDelete($e);
        }

        CursusGateway::deleteCursus($model->dataError, $idCursus);
    }
}
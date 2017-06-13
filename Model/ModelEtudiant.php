<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 17/05/2017
 * Time: 14:27
 */

class ModelEtudiant extends Model{

    private $etudiant;

    public function __construct()
    {
        $this->dataError = array();
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->etudiant;
    }

    /**
     * @param mixed $etudiant
     */
    private function setEtudiant($etudiant)
    {
        $this->etudiant = $etudiant;
    }

    public static function getEtudiantById($numEtu){
        $model = new self(array());
        $model->setEtudiant(EtudiantGateway::getEtudiantByNumEtu($numEtu));
        return $model;
    }

    public static function getModelEtudiantPut($etudiant){
        $model = new self(array());
        $model->etudiant = EtudiantGateway::putEtudiant($model->dataError, $etudiant);
        return $model;
    }

    public static function etudiantExist($numEtu){
        if(EtudiantGateway::existEtudiant($numEtu)){
            return true;
        }
        else return false;
    }
}
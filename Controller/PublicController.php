<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 04/05/2017
 * Time: 19:54
 */

class PublicController{

    function __construct()
    {
        $role = "public";
        try{
            if (isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
            }else{
                $action=null;
            }
            switch($action){

                case "ajoutCursus":
                    require(Config::getViews()["ajoutCursus"]);
                    break;

                case "modifierCursus":
                    $modif = true;
                    require(Config::getViews()["ajoutCursus"]);
                    break;

                case "effectuerModif":
                    $id_cursus = $_GET['id_cursus'];
                    if (isset($id_cursus)){
                        ModelCursus::getModelDeleteCursus($id_cursus);
                    }
                    require(Config::getReception()['receptionCursus']);
                    break;

                case "home":
                    require(Config::getViews()["home"]);
                    break;

                case "detailCursus":
                    require(Config::getViews()["detailCursus"]);
                    break;

                case "visualisationCursus":
                    require(Config::getViews()["visualisationCursus"]);
                    break;

                case "modifierElementFormation":
                    require(Config::getViews()["modifierElementFormation"]);
                    break;

                case "enregistrementElementFormation":
                    require(Config::getReception()['receptionElementFormation']);
                    break;

                case "receptionCursus":
                    require(Config::getReception()['receptionCursus']);
                    break;

                case "applicationReglementCursus":
                    require(Config::getViews()["applicationReglementCursus"]);
                    break;

                case "suppressionElementFormation":
                    $id=$_GET['id'];
                    $modelElementFormation = ModelElementFormationEffectue::deleteElementFormationEffectue($id);
                    if (false === $modelElementFormation -> getError()){
                        require(Config::getViews()["detailCursus"]);
                    }else{
                        require(Config::getViews()["detailCursus"]);
                    }
                    break;

                case "dupliquerCursus":
                    $id_cursus = $_GET['id_cursus'];
                    if (isset($id_cursus)){
                        $modelCursus = ModelCursus::getCursusById($id_cursus);
                        $cursus = $modelCursus->getData();
                        $cursus->setNom($cursus->getNom().' (copie)');
                        $modelCollectionElement = ModelCollectionElementFormationEffectue::getModelElementsFormationByIdCursus($cursus->getId());
                        ModelCursus::getModelCursusPut($cursus);
                        foreach ($modelCollectionElement->getData() as $e){
                            $modelElementFormationEffectue = ModelElementFormationEffectue::getModelElementFormationPut($e, $cursus->getId());
                        }
                    }
                    require(Config::getViews()["home"]);
                    break;

                case "suppressionCursus":
                    $id_cursus = $_GET['id_cursus'];
                    if (isset($id_cursus)){
                        ModelCursus::getModelDeleteCursus($id_cursus);
                    }
                    require(Config::getViews()["home"]);
                    break;

                default :
                    require(Config::getViews()["home"]);
                    break;
            }
        }catch(Exception $e){
            $error = new Error(array('exception' => $e->getMessage()));
            //require(Config::getVuesErreur()['']);
        }
    }
}

?>
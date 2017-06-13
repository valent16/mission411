<?php

/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 14/05/2017
 * Time: 17:43
 */
//require_once ('dataBaseManager.php');
//require_once ('../Controller/RuleChecker.php');
//require_once ('../Metier/Etudiant.php');
//require_once ('../Metier/Cursus.php');
//require_once ('../Metier/ElementFormationEffectue.php');
//require_once ('../Metier/ElementFormation.php');
//require_once ('../Metier/Regulation.php');

class RegulationFiller
{
    public static function getRegulation($idEtudiant,$idCursus,$titreReglement)
    {
        $etudiant = ModelEtudiant::getEtudiantById($idEtudiant)->getData();
        $cursus = ModelCursus::getCursusById($idCursus)->getData();

        if($etudiant->getNumCarteEtu() == $cursus->getNumEtu()){
            //Opt
            $etudiant->addCursus($cursus);
            $cursus->affectationElementsFormation(ModelCollectionElementFormation::getModelElementsFormationByIdCursus($idCursus)->getData());

            //Chargement du reglement...
            $regulation = new Regulation($titreReglement);

            //Validation du reglement...
            $regulation = RuleChecker::evaluateRules($regulation,$cursus->getElementsFormationEffectues());
            return $regulation;
        }
        else {
            echo "Error : num etu not matching";
            return null;
        }
    }
}

?>
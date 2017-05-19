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

    private static function studentLoader($idEtudiant)
    {
        //Chargement profil etudiant...
        $etudiantQuery = DataBaseManager::getInstance()->prepareAndExecuteQuery("SELECT nom, prenom, admission, filiere 
                      FROM etudiant
                      WHERE numCarteEtu=?",[$idEtudiant]);
        $data = $etudiantQuery->fetch(PDO::FETCH_ASSOC);
        $etudiant = new Etudiant($idEtudiant,$data['nom'],$data['prenom'],$data['admission'],$data['filiere']);
        return $etudiant;
    }

    private static function cursusLoader($idCursus)
    {
        //Chargement du cursus...
        $cursusQuery = DataBaseManager::getInstance()->prepareAndExecuteQuery("SELECT nom_cursus, num_etu 
                    FROM cursus
                    WHERE id_cursus=?",[$idCursus]);
        $data = $cursusQuery->fetch(PDO::FETCH_ASSOC);
        $cursus = new Cursus($idCursus,$data['nom_cursus'],$data['num_etu']);
        return $cursus;
    }

    public static function getRegulation($idEtudiant,$idCursus,$titreReglement)
    {
        $etudiant = self::studentLoader($idEtudiant);
        $cursus = self::cursusLoader($idCursus);

        if($etudiant->getNumCarteEtu() == $cursus->getNumEtu()){
            //Opt
            $etudiant->addCursus($cursus);

            $resultSet = DataBaseManager::getInstance()->prepareAndExecuteQuery("SELECT * 
                    FROM element_formation, element_formation_effectue
                    WHERE element_formation.id = element_formation_effectue.id_element_formation
                    AND element_formation_effectue.id_cursus = ?",[$idCursus]);

            while($data = $resultSet->fetch(PDO::FETCH_ASSOC))
            {
                //Chargment des elements de formation du cursus
                $cursus->addElementFormationEffectues(new ElementFormationEffectue(
                    new ElementFormation($data['id'],$data['sigle'],$data['utt'],$data['categorie']), $data['affectation'],
                    $data['sem_label'],$data['sem_seq'],$data['credit'],$data['resultat']));
            }

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
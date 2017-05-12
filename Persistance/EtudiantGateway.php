<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 04/05/2017
 * Time: 20:13
 */

class EtudiantGateway{


    //retourne un dictionnaire avec en clef le numéro de l'étudiant et en valeur l'étudiant correspondant
    public static function getAllEtudiantsMap(){
        try{
            $stmt = DataBaseManager::getInstance()->prepareAndExecuteQuery('SELECT * FROM Etudiant', array());
        }
        catch(Exception $e){
            $dataError['persistance-get'] = "Impossible d'accéder aux données";
        }

        $collectionEtudiant = array();

        if ($stmt !== false){
            foreach($stmt as $row){
                $etudiant = new Etudiant($row['numCarteEtu'], $row['nom'], $row['prenom'], $row['admission'], $row['filiere']);
                $collectionEtudiant[$etudiant->getNumCarteEtu()] = $etudiant;

            }
        }else{
            $dataError['persistance-get'] = "Aucun cursus trouvé.";
        }
        return $collectionEtudiant;
    }
}

?>
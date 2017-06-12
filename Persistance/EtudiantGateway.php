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
                $etudiant = new Etudiant($row['num_carte_etu'], $row['nom'], $row['prenom'], $row['admission'], $row['filiere']);
                $collectionEtudiant[$etudiant->getNumCarteEtu()] = $etudiant;

            }
        }else{
            $dataError['persistance-get'] = "Aucun cursus trouvé.";
        }
        return $collectionEtudiant;
    }


    public static function getEtudiantByNumEtu($numEtu){
        if (isset($numEtu)) {
            try {
                $stmt = DataBaseManager::getInstance()->prepareAndExecuteQuery('SELECT * FROM Etudiant WHERE num_carte_etu=?', array($numEtu));
            } catch (Exception $e) {
                $dataError['persistance-get'] = "Impossible d'accéder aux données";
            }

            if ($stmt !== false) {
                $count = 0;
                foreach ($stmt as $row) {
                    $etudiant = new Etudiant($row['num_carte_etu'], $row['nom'], $row['prenom'], $row['admission'], $row['filiere']);
                    $count++;
                }
                if ($count != 1) {
                    $dataError['persistance-get'] = "Etudiant Introuvable";
                }
                return $etudiant;
            } else {
                $dataError['persistance-get'] = "Etudiant Introuvable";
            }
        }else{
            $dataError['persistance-get'] = "Etudiant Introuvable";
        }
    }

    public static function putEtudiant(&$dataError, $etudiant){
        $statement = false;
        $count = 0;

        $statement = DataBaseManager::getInstance()->prepareAndExecuteQuery('INSERT INTO etudiant(num_carte_etu, nom, prenom, admission, filiere) VALUES(?, ?, ?, ?, ?)', array($etudiant->getNumCarteEtu(), $etudiant->getNom(), $etudiant->getPrenom(), $etudiant->getAdmission(), $etudiant->getfiliere()));
        if ($statement->rowCount() < 1){
            $statement = false;
        }

        if ($statement === false){
            $dataError["persistence-put"] = "Problème d'exécution de la requete";
        }else{
            DataBaseManager::destroyQueryResults($statement);
        }
        return $etudiant;
    }
}

?>
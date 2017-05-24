<?php

/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 13/05/2017
 * Time: 21:21
 */
require_once ('dataBaseManager.php');
class CursusSaver
{
    public static function isUserInDB($data){
            if(isset($data['num_etu'])){
                $etudiantQuery = DataBaseManager::getInstance()->prepareAndExecuteQuery("SELECT Count(*) as nb
                FROM etudiant
                WHERE num_carte_etu=?",[$data['num_etu']]);
                $nb = $etudiantQuery->fetch(PDO::FETCH_ASSOC);
                if($nb['nb'] > 0) return true;
                else return false;
            }
            else return false;
    }

    public static function cursusExist($data){
        if(isset($data['nom_cursus'])){
            $cursusQuery = DataBaseManager::getInstance()->prepareAndExecuteQuery("SELECT id_cursus
            FROM cursus
            WHERE nom_cursus=?",[$data['nom_cursus']]);
            $result = $cursusQuery->fetch(PDO::FETCH_ASSOC);
            if($result['id_cursus'] != null) return $result['id_cursus'];
            else return false;
        }
        else return false;
    }

    public static function elementExist($data,$i)
    {
        if(isset($data['sigle'][$i])){
            $elementQuery = DataBaseManager::getInstance()->prepareAndExecuteQuery("SELECT id
            FROM element_formation
            WHERE sigle=?",[$data['sigle'][$i]]);
            $result = $elementQuery->fetch(PDO::FETCH_ASSOC);
            if($result['id'] != null) return $result['id'];
            else return false;
        }
        else return false;
    }

    public static function insertUser($data){
        DataBaseManager::getInstance()->prepareAndExecuteQuery("INSERT INTO etudiant (num_carte_etu,nom,prenom,admission,filiere)
                        VALUES (?,?,?,?,?)",[$data['num_etu'],$data['nom_etu'],$data['prenom_etu'],$data['admission'],$data['filiere']]);
    }

    public static function insertCursus($data)
    {
        DataBaseManager::getInstance()->prepareAndExecuteQuery("INSERT INTO cursus (nom_cursus,num_etu)
                        VALUES (?,?)",[$data['nom_cursus'],$data['num_etu']]);
    }

    public static function deleteElementCursus($id_cursus)
    {
        DataBaseManager::getInstance()->prepareAndExecuteQuery("DELETE FROM element_formation_effectue
                                                                       WHERE id_cursus=?",[$id_cursus]);
    }

    public static function insertElementFormation($data,$i)
    {
        $ok = 1;
        if($data['utt'][$i] == 'non') $ok=0;

        DataBaseManager::getInstance()->prepareAndExecuteQuery("INSERT INTO element_formation (sigle,utt,categorie)
                        VALUES (?,?,?)",[$data['sigle'][$i],$ok,$data['categorie'][$i]]);
    }

    public static function insertElementFormationEffectue($id_cursus,$id_element_formation,$data,$i)
    {
        DataBaseManager::getInstance()->prepareAndExecuteQuery("INSERT INTO element_formation_effectue (id_cursus,id_element_formation,affectation,sem_label,sem_seq,credit,resultat)
                        VALUES (?,?,?,?,?,?,?)",[$id_cursus,$id_element_formation,$data['affectation'][$i],$data['sem_label'][$i],$data['sem_seq'][$i],$data['credits'][$i],$data['resultat'][$i]]);
    }

    public static function save($data){
        if(isset($data)){
            if(!CursusSaver::isUserInDB($data)){
                //Insertion d'un nouvel étudiant dans la bdd
                //echo "<p> Insertion étudiant <\p>";
                CursusSaver::insertUser($data);
            }
            if(!(CursusSaver::cursusExist($data))){
                //Insertion d'un nouveau cursus
                //echo "<p> Insertion cursus <\p>";
                CursusSaver::insertCursus($data);
            }

            $id_cursus = CursusSaver::cursusExist($data);
            //Suppression des données du cursus pour être mis à jours ensuite
            CursusSaver::deleteElementCursus($id_cursus);

            for($i=0;$i<count($data['sigle']);$i++){
                if(!(CursusSaver::elementExist($data,$i))){
                    //Insertion d'un nouvel element de formation
                    CursusSaver::insertElementFormation($data,$i);
                }
                $id_element_formation = CursusSaver::elementExist($data,$i);
                //Insertion d'un nouvel element de formation effectue
                CursusSaver::insertElementFormationEffectue($id_cursus,$id_element_formation,$data,$i);
            }
            return $id_cursus;
        }
    }


}

?>
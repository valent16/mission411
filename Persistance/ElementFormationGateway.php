<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 19/05/2017
 * Time: 10:35
 */

class ElementFormationGateway{
    public static function getElementFormationByCursus(&$dataError, $idCursus){
        $collectionFormation = array();
        if (isset($idCursus)) {
            try {
                $stmt = DataBaseManager::getInstance()->prepareAndExecuteQuery('SELECT * FROM element_formation ef, element_formation_effectue efe WHERE id_cursus=? AND ef.id=efe.id_element_formation', array($idCursus));
            } catch (Exception $e) {
                $dataError['persistance-get'] = "Impossible d'accéder aux données";
            }

            if ($stmt !== false) {
                $count = 0;
                foreach ($stmt as $row) {
                    $elementFormation = new ElementFormation( $row['id_element_formation'], $row['sigle'], $row['utt'], $row['categorie']);

                    $elementFormationEffectue = new ElementFormationEffectue($row['id'], $elementFormation, $row['affectation'], $row['sem_label'], $row['sem_seq'], $row['credit'], $row['resultat']);

                    $collectionFormation[] = $elementFormationEffectue;
                }
                if ($count != 1) {
                    $dataError['persistance-get'] = "Cursus Introuvable";
                }
            } else {
                $dataError['persistance-get'] = "Cursus Introuvable";
            }
        }else{
            $dataError['persistance-get'] = "Crusus Introuvable";
        }
        return  $collectionFormation;
    }

    public static function getElementFormationById(&$dataError, $id){
        if (isset($id)){
            try {
                $stmt = DataBaseManager::getInstance()->prepareAndExecuteQuery('SELECT * FROM element_formation ef, element_formation_effectue efe WHERE efe.id=? AND efe.id_element_formation=ef.id', array($id));
            } catch (Exception $e) {
                $dataError['persistance-get'] = "Impossible d'accéder aux données";
            }

            if ($stmt !== false) {
                $count = 0;
                foreach ($stmt as $row) {
                    $element_formation = new ElementFormation($row['id_element_formation'], $row['sigle'], $row['utt'], $row['categorie']);
                    $element_formation_effectue = new ElementFormationEffectue($id, $element_formation, $row['affectation'], $row['sem_label'], $row['sem_seq'], $row['credit'], $row['resultat']);
                    return $element_formation_effectue;

                    $count++;
                }
                if ($count != 1) {
                    $dataError['persistance-get'] = "Cursus Introuvable";
                }
            }else{
                $dataError['persistance-get'] = "Cursus introuvable";
            }
        }else {
            $dataError['persistance-get'] = "Element de formation introuvable";
        }
    }

    public static function deleteElementFormation(&$dataError, $id){
        $elementFormation = self::getElementFormationById($dataError, $id);

        if (empty($dataError)){
            $statement = DataBaseManager::getInstance()->prepareAndExecuteQuery('DELETE FROM element_formation_effectue WHERE id=?',array($id));

            if ($statement === false){
                $dataError['persistance-delete'] = "Problème d'exécutioon de la requete";
            }
            DataBaseManager::destroyQueryResults($statement);
        }
        return $elementFormation;
    }

    public static function postElementFormation(&$dataError, $elementFormationEffectue){
        $compteElementFormation = self::countElementFormationEffectue($elementFormationEffectue->getElementFormation()->getIdElementFormation());
        echo "coucou";
        if ($compteElementFormation > 1){
            echo "coucou";
            $elementFormation = self::getElementFormationById($dataError, $elementFormationEffectue->getElementFormation()->getIdElementFormation());
            if (!$elementFormation->getElementFormation()->isEqualTo($elementFormationEffectue->getElementFormation())){
                $statement = false;
                $count = 0;
                while ($statement === false && $count <=3){
                    $elementFormationEffectue->getElementFormation()->setIdElementFormation(Config::generateRandomID());
                    $count++;
                    $statement = DataBaseManager::getInstance()->prepareAndExecuteQuery('INSERT INTO element_formation(id, sigle, utt, categorie) VALUES(?, ?, ?, ?)', array($elementFormationEffectue->getElementFormation()->getIdElementFormation(), $elementFormationEffectue->getElementFormation()->getSigle(), $elementFormationEffectue->getElementFormation()->getUtt(), $elementFormationEffectue->getElementFormation()->getCategorie()));
                    if ($statement->rowCount() < 1) {
                        $statement = false;
                    }
                }
            }
            $statement = DataBaseManager::getInstance()->prepareAndExecuteQuery('UPDATE element_formation_effectue SET id_element_formation=?, affectation=?, sem_label=?, sem_seq=?, credit=?, resultat=? Where id = ?', array($elementFormationEffectue->getElementFormation()->getIdElementFormation(), $elementFormationEffectue->getAffectation(), $elementFormationEffectue->getSemLabel(), $elementFormationEffectue->getSemSeq(), $elementFormationEffectue->getCredit(), $elementFormationEffectue->getResultat(), $elementFormationEffectue->getIdentifiant()));
            if ($statement === false){
                $dataError["persistence-put"] = "Problème d'exécution de la requete";
            }
        }else{
            $statement = DataBaseManager::getInstance()->prepareAndExecuteQuery('UPDATE element_formation_effectue SET affectation=?, sem_label=?, sem_seq=?, credit=?, resultat=? Where id = ?', array($elementFormationEffectue->getAffectation(), $elementFormationEffectue->getSemLabel(), $elementFormationEffectue->getSemSeq(), $elementFormationEffectue->getCredit(), $elementFormationEffectue->getResultat(), $elementFormationEffectue->getIdentifiant()));
            if ($statement === false){
                $dataError["persistence-put"] = "Problème d'exécution de la requete";
            }
            DataBaseManager::destroyQueryResults($statement);
            $statement = DataBaseManager::getInstance()->prepareAndExecuteQuery('UPDATE element_formation SET sigle=?, utt=?, categorie=? WHERE id=? ', array($elementFormationEffectue->getElementFormation()->getSigle(), $elementFormationEffectue->getElementFormation()->getUtt(),$elementFormationEffectue->getElementFormation()->getCategorie(), $elementFormationEffectue->getElementFormation()->getIdElementFormation()));
            if ($statement === false){
                $dataError["persistence-put"] = "Problème d'exécution de la requete";
            }
            DataBaseManager::destroyQueryResults($statement);
        }
        return $elementFormationEffectue;
    }

    public static function putElementFormationEffectue(&$dataError,$elementFormationEffectue, $id_cursus){
            $statement = false;
            $count = 0;

            while ($statement === false && $count <=3){
                $elementFormationEffectue->getElementFormation()->setIdElementFormation(Config::generateRandomId());
                $count++;
                $statement = DataBaseManager::getInstance()->prepareAndExecuteQuery('INSERT INTO element_formation(id, sigle, utt, categorie) VALUES(?, ?, ?, ?)', array($elementFormationEffectue->getElementFormation()->getIdElementFormation(), $elementFormationEffectue->getElementFormation()->getSigle(), $elementFormationEffectue->getElementFormation()->getUtt(), $elementFormationEffectue->getElementFormation()->getCategorie()));
                if ($statement->rowCount() < 1) {
                    $statement = false;
                }
            }

            if ($statement === false){
                $dataError["persistence-put"] = "Problème d'exécution de la requete";
            }else{
                DataBaseManager::destroyQueryResults($statement);
                $statement = false;
                $statement = DataBaseManager::getInstance()->prepareAndExecuteQuery('INSERT INTO element_formation_effectue(id_cursus, id_element_formation, affectation, sem_label, sem_seq, credit, resultat) VALUES(?, ?, ?, ?, ?, ?, ?)', array($id_cursus, $elementFormationEffectue->getElementFormation()->getIdElementFormation(), $elementFormationEffectue->getAffectation(), $elementFormationEffectue->getSemLabel(), $elementFormationEffectue->getSemSeq(), $elementFormationEffectue->getCredit(), $elementFormationEffectue->getResultat()));
                if ($statement === false){
                    $dataError["persistence-put"] = "Problème d'exécution de la requete";
                }
            }
            return $elementFormationEffectue;
    }

    public static function countElementFormationEffectue($idElementFormation){
        $statement = DataBaseManager::getInstance()->prepareAndExecuteQuery('SELECT count(*) FROM element_formation_effectue WHERE id_element_formation=?', array($idElementFormation));
        if ($statement === false) {
            $dataError['persistance-count'] = "Problème d'exécutioon de la requete";
        }
        return $statement->fetch()[0];
    }
}
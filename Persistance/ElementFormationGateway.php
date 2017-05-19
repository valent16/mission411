<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 19/05/2017
 * Time: 10:35
 */

class ElementFormationGateway{
    public static function getElementFormationByCursus(&$dataError, $idCursus){
        if (isset($idCursus)) {
            try {
                $stmt = DataBaseManager::getInstance()->prepareAndExecuteQuery('SELECT * FROM element_formation ef, element_formation_effectue efe WHERE id_cursus=? AND ef.id=efe.id_element_formation', array($idCursus));
            } catch (Exception $e) {
                $dataError['persistance-get'] = "Impossible d'accéder aux données";
            }

            $collectionFormation = array();

            if ($stmt !== false) {
                $count = 0;
                foreach ($stmt as $row) {
                    $elementFormation = new ElementFormation($row['id_element_formation'], $row['sigle'], $row['utt'], $row['categorie']);

                    $elementFormationEffectue = new ElementFormationEffectue($elementFormation, $row['affectation'], $row['sem_label'], $row['sem_seq'], $row['credit'], $row['resultat']);

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
}
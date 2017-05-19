<?php

/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 08/05/2017
 * Time: 18:06
 */
class CursusGateway
{
    public static function getCursusAll(){
        try{
            $stmt = DataBaseManager::getInstance()->prepareAndExecuteQuery('SELECT * FROM Cursus', array());
        }
        catch(Exception $e){
            $dataError['persistance-get'] = "Impossible d'accéder aux données";
        }

        $collectionCursus = array();

        if ($stmt !==false){
            foreach($stmt as $row){
                $cursus = new Cursus($row['id_cursus'], $row['nom_cursus'], $row['num_etu']);
                $collectionCursus [] = $cursus;
            }
        }else{
            $dataError['persistance-get'] = "Aucun cursus trouvé.";
        }
        DataBaseManager::destroyQueryResults($stmt);
        return $collectionCursus;
    }

    public static function getCursusById(&$dataError, $id){
        if (isset($id)) {
            try {
                $stmt = DataBaseManager::getInstance()->prepareAndExecuteQuery('SELECT * FROM Cursus WHERE id_cursus=?', array($id));
            } catch (Exception $e) {
                $dataError['persistance-get'] = "Impossible d'accéder aux données";
            }

            if ($stmt !== false) {
                $count = 0;
//                $row = $stmt->fetch();
                foreach ($stmt as $row) {
//                    echo "coucou";
                    $cursus = new Cursus($row['id_cursus'], $row['nom_cursus'], $row['num_etu']);
                    return $cursus;
                    $count++;
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
    }
}
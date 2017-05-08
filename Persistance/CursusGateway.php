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
                $cursus = new Cursus($row['nom_cursus'], $row['id_cursus']);
                $collectionCursus [] = $cursus;
            }
        }else{
            $dataError['persistance-get'] = "Aucun cursus trouvé.";
        }
        DataBaseManager::destroyQueryResults($stmt);
        return $collectionCursus;
    }
}
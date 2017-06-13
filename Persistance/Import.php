<?php

/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 12/06/2017
 * Time: 21:41
 */
class Import
{
    public static function fromCSV($path,$name){
        $createStudent = true;
        $student=null;
        $cursus=null;
        if (($handle = fopen($path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0,';')) !== FALSE) {
                //print_r($data);
                if($data[0] == 'ID' && ModelEtudiant::etudiantExist($data[1])){
                    echo 'Etudiant déja présent dans la base </br>';
                    $modelStudent = ModelEtudiant::getEtudiantById($data[1]);
                    $student = $modelStudent->getData();
                    $createStudent = false;
                }
                else if($data[0] == 'ID' && !ModelEtudiant::etudiantExist($data[1])){
                    echo 'Création d\'un étudiant </br>';
                    $student = new Etudiant(null,null,null,null,null);
                }
                if($createStudent){
                    switch ($data[0]){
                        case 'ID':
                            $student->setNumCarteEtu($data[1]);
                            break;
                        case 'NO':
                            $student->setNom($data[1]);
                            break;
                        case 'PR':
                            $student->setPrenom($data[1]);
                            break;
                        case 'AD':
                            $student->setAdmission($data[1]);
                            break;
                        case 'FI':
                            $student->setFiliere($data[1]);
                            break;
                    }
                }
                if($data[0] == '=='){
                    if($createStudent){
                        ModelEtudiant::getModelEtudiantPut($student);
                    }
                    echo $student->getNumCarteEtu().'</br>';
                    $cursus = new Cursus(null,null,null);
                    $cursus->setNom(explode('.',$name)[0]);
                    $cursus->setNumEtu($student->getNumCarteEtu());
                    //Insertion du nouveau cursus
                    $modelCursus = ModelCursus::getModelCursusPut($cursus);
                    $cursus = $modelCursus->getData();
                    echo $cursus->getId().'</br>';
                }
                if($data[0] == 'EL'){
                    $modelElementFormationEffectue = ModelElementFormationEffectue::getModelElementFormationPut(
                        new ElementFormationEffectue(null,new ElementFormation(
                            null,$data[3],$data[6],$data[4]
                        ),$data[5],$data[2],$data[1],$data[8],$data[9]),$cursus->getId()
                    );
                    $elementFormation = $modelElementFormationEffectue->getData();
                    echo $elementFormation->getIdentifiant().'</br>';
                }

            }
            fclose($handle);
        }

        return $cursus->getId();
    }

}
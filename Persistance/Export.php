<?php

/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 12/06/2017
 * Time: 19:12
 */
class Export
{
    public static function toCSV($numCursus){
        header('Content-Type: text/csv');
        header("Content-Disposition: attachment; filename='cursus".$numCursus.".csv'");

        $modelCollectionElementFormation = ModelCollectionElementFormationEffectue::getModelElementsFormationByIdCursus($numCursus);
        $collectionElementFormation = $modelCollectionElementFormation->getData();

        $modelCursus = ModelCursus::getCrususById($numCursus);
        $cursus = $modelCursus->getData();

        $modelEtudiant = ModelEtudiant::getEtudiantById($cursus->getNumEtu());
        $etudiant = $modelEtudiant->getData();


        $data = array(
            'ID;'.$etudiant->getNumCarteEtu().';;;;;;;;',
            'NO;'.$etudiant->getNom().';;;;;;;;',
            'PR;'.$etudiant->getPrenom().';;;;;;;;',
            'AD;'.$etudiant->getAdmission().';;;;;;;;',
            'FI;'.$etudiant->getFiliere().';;;;;;;;'
        );

        array_push($data,'==;s_seq;s_label;sigle;categorie;affectation;utt;profil;credit;resultat');

        foreach ($collectionElementFormation as $elem){

            $utt = ($elem->getElementFormation()->getUtt() == 1 ? 'Y' : 'N');
            $profil = ($elem->getElementFormation()->getCategorie() == 'HP' ? 'N' : 'Y');

            array_push($data,'EL;'.$elem->getSemSeq().';'.$elem->getSemLabel().';'.$elem->getElementFormation()->getSigle().';'.$elem->getElementFormation()->getCategorie().';'.
            $elem->getAffectation().';'.$utt.';'.$profil.';'.$elem->getCredit().';'.$elem->getResultat());
        }

        $fp = fopen('php://output', 'w');
        foreach ( $data as $line ) {
            $val = explode(";", $line);
            fputcsv($fp, $val,";");
        }
        fclose($fp);
        exit();
    }
}
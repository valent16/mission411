<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 11/06/2017
 * Time: 23:30
 */

$id_element_formation = $_GET['id_element_formation'];

$ModelElementFormation = ModelElementFormationEffectue::getElementFormationEffectueById($id_element_formation);
$elementFormation = $ModelElementFormation->getData();



//Faire les filtres au niveau des valeurs
$sigle = $_POST['sigle'];

if ($_POST['utt'] == "oui"){
    $utt = 1;
}else{
    $utt = 0;
}


//$utt = $_POST['utt'];
$categorie = $_POST['categorie'];
$affectation = $_POST['affectation'];
$sem_label = $_POST['sem_label'];
$sem_seq = $_POST['sem_seq'];
$credits = $_POST['credits'];
$resultat = $_POST['resultat'];


$elementFormation->setAffectation($affectation);
$elementFormation->setSemLabel($sem_label);
$elementFormation->setSemSeq($sem_seq);
$elementFormation->setCredit($credits);
$elementFormation->setResultat($resultat);

$elementFormation->getElementFormation()->setSigle($sigle);
$elementFormation->getElementFormation()->setUtt($utt);
$elementFormation->getElementFormation()->setCategorie($categorie);

ModelElementFormationEffectue::getModelElementFormationPost($elementFormation);
require (Config::getViews()['home']);
?>
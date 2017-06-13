<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 12/06/2017
 * Time: 00:33
 */

$etu = new Etudiant($_POST['num_etu'],$_POST['nom_etu'],$_POST['prenom_etu'],$_POST['admission'],$_POST['filiere']);
$modelEtudiant = ModelEtudiant::getModelEtudiantPut($etu);

$nbElementFormation =  count($_POST['sigle']);

$cursus = new Cursus("0",$_POST['nom_cursus'],$etu->getNumCarteEtu());
$modelCursus = ModelCursus::getModelCursusPut($cursus);

for ($i=0;$i<$nbElementFormation;$i++) {
    if ($_POST['utt'][$i] == "oui") {
        $utt = 1;
    } else {
        $utt = 0;
    }
    $elementFormation = new ElementFormation("0", $_POST['sigle'][$i], $utt, $_POST['categorie'][$i]);
    $elementFormationEffectue = new ElementFormationEffectue("0", $elementFormation, $_POST['affectation'][$i], $_POST['sem_label'][$i], $_POST['sem_seq'][$i], $_POST['credits'][$i], $_POST['resultat'][$i]);

    $elementFormationEffectue->toString();
    $modelElementFormationEffectue = ModelElementFormationEffectue::getModelElementFormationPut($elementFormationEffectue, $modelCursus->getData()->getId());

    //affectation, sem_label, resultat
    //categorie
}

//require (Config::getViews()['home']);
?>
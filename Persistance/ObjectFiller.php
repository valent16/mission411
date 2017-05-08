<?php
/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 08/05/2017
 * Time: 12:07
 */
//Script permettant le remplissage d'objet Cursus, ElementFormation, Etudiant etc... à partir de la bdd
require_once ('dataBaseManager.php');
require_once ('../Metier/ElementFormationEffectue.php');
require_once ('../Metier/ElementFormation.php');
require_once ('../Metier/Regulation.php');

$idCursus = 1;
$titreReglement = 'R_ACTUEL_BR';

$elementsFormationEffectue = [];

$resultSet = DataBaseManager::getInstance()->prepareAndExecuteQuery("SELECT * 
    FROM element_formation, element_formation_effectue
    WHERE element_formation.id = element_formation_effectue.id_element_formation
    AND element_formation_effectue.id_cursus = ?",[$idCursus]);


while($data = $resultSet->fetch(PDO::FETCH_ASSOC))
{
    //Les objets sont remplis
    array_push($elementsFormationEffectue, new ElementFormationEffectue(
        new ElementFormation($data['id'],$data['sigle'],$data['utt'],$data['categorie']), $data['affectation'],
        $data['sem_label'],$data['sem_seq'],$data['credit'],$data['resultat']));
}



$regulation = new Regulation($titreReglement);

?>
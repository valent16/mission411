<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 08/05/2017
 * Time: 00:34
 */

class Cursus{
    private $nom;

    private $id;

    private $numEtu;

    private $elementsFormationEffectues = [];

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    private function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNumEtu()
    {
        return $this->numEtu;
    }

    /**
     * @param mixed $numEtu
     */
    public function setNumEtu($numEtu)
    {
        $this->numEtu = $numEtu;
    }

    public function addElementFormationEffectues($elementFormationEffectue){
        array_push($this->elementsFormationEffectues,$elementFormationEffectue);
    }

    /**
     * @return array
     */
    public function getElementsFormationEffectues()
    {
        return $this->elementsFormationEffectues;
    }

    public function __construct($id,$nom, $numEtu)
    {
        $this->setNom($nom);
        $this->setId($id);
        $this->setNumEtu($numEtu);
    }

    //Retourne un dictionnaire clef valeur avec en clef le numéro du semestre de TC et en valeur la liste des élements de formation effectués
    public function getMapSortTC(){
        $mapSortTC = array();

        foreach($this->elementsFormationEffectues as $elementFormation){
            if (preg_match('#^TC[0-9]*$#',$elementFormation->getSemLabel())){
                if (!isset($mapSortTC[$elementFormation->getSemSeq()])){
                    $mapSortTC[$elementFormation->getSemSeq()] = array();
                }
                $mapSortTC[$elementFormation->getSemSeq()][] = $elementFormation;
            }
        }

        ksort($mapSortTC);
        return $mapSortTC;
    }

    //Retourne un dictionnaire clef valeur avec en clef le numéro du semestre de Branche et en valeur la liste des élements de formation effectués
    public function getMapSortBranche(){
        $mapSortBranche = array();

        foreach($this->elementsFormationEffectues as $elementFormation){
            if (!preg_match('#^TC[0-9]*$#',$elementFormation->getSemLabel())){
                if (!isset($mapSortBranche[$elementFormation->getSemSeq()])){
                    $mapSortBranche[$elementFormation->getSemSeq()] = array();
                }
                $mapSortBranche[$elementFormation->getSemSeq()][] = $elementFormation;
            }
        }

        ksort($mapSortBranche);
        return $mapSortBranche;
    }

    //Permet l'association des elements de formation au cursus
    public function affectationElementsFormation($listeElementsFormation){
        $this->elementsFormationEffectues = $listeElementsFormation;
    }
}
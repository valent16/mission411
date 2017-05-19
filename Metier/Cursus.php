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
}
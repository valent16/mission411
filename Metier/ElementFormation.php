<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 08/05/2017
 * Time: 00:34
 */

class ElementFormation{
    private $idElementFormation;

    private $sigle;

    private $utt;

    private $categorie;

    /**
     * @return mixed
     */
    public function getIdElementFormation()
    {
        return $this->idElementFormation;
    }

    /**
     * @param mixed $idElementFormation
     */
    public function setIdElementFormation($idElementFormation)
    {
        $this->idElementFormation = $idElementFormation;
    }

    /**
     * @return mixed
     */
    public function getSigle()
    {
        return $this->sigle;
    }

    /**
     * @param mixed $sigle
     */
    public function setSigle($sigle)
    {
        $this->sigle = $sigle;
    }

    /**
     * @return mixed
     */
    public function getUtt()
    {
        return $this->utt;
    }

    /**
     * @param mixed $utt
     */
    public function setUtt($utt)
    {
        $this->utt = $utt;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function __construct($idElementFormation, $sigle, $utt, $categorie)
    {
        $this->setIdElementFormation($idElementFormation);
        $this->setCategorie($categorie);
        $this->setUtt($utt);
        $this->setCategorie($categorie);
        $this->setSigle($sigle);
    }

    public function isEqualTo($elementFormation){
        if ($this->getIdElementFormation() === $elementFormation->getIdElementFormation() &&
            $this->getCategorie() === $elementFormation->getCategorie() &&
            $this->getIdElementFormation() === $elementFormation->getIdElementFormation() &&
            $this->getSigle() === $elementFormation->getSigle() &&
            $this->getUtt() == $elementFormation->getUtt()){
            return true;
        }
        return false;
    }
}
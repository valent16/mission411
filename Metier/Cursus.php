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

    private function setID($id){
        $this->id = $id;
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

    public function __construct($nom, $id, $numEtu)
    {
        $this->setNom($nom);
        $this->setID($id);
        $this->setNumEtu($numEtu);
    }
}
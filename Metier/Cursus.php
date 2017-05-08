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

    public function __construct($nom, $id)
    {
        $this->setNom($nom);
        $this->setID($id);
    }
}
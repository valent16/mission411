<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 08/05/2017
 * Time: 00:34
 */

class Etudiant{

    private $numCarteEtu;

    private $nom;

    private $prenom;

    private $admission;

    private $filiere;

    /**
     * @return mixed
     */
    public function getNumCarteEtu()
    {
        return $this->numCarteEtu;
    }

    /**
     * @param mixed $numCarteEtu
     */
    public function setNumCarteEtu($numCarteEtu)
    {
        $this->numCarteEtu = $numCarteEtu;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getAdmission()
    {
        return $this->admission;
    }

    /**
     * @param mixed $admission
     */
    public function setAdmission($admission)
    {
        $this->admission = $admission;
    }

    /**
     * @return mixed
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * @param mixed $filiere
     */
    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;
    }

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


    public function __construct($numCarteEtu, $nom, $prenom, $admission, $filiere)
    {
        $this->setNumCarteEtu($numCarteEtu);
        $this->setAdmission($admission);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setFiliere($filiere);
    }
}
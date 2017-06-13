<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 08/05/2017
 * Time: 00:35
 */

class ElementFormationEffectue{

    private $identifiant;

    private $elementFormation;

    private $affectation;

    private $semLabel;

    private $semSeq;

    private $credit;

    private $resultat;

    /**
     * @return mixed
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * @param mixed $identifiant
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;
    }

    /**
     * @return mixed
     */
    public function getElementFormation()
    {
        return $this->elementFormation;
    }

    /**
     * @param mixed $elementFormation
     */
    public function setElementFormation($elementFormation)
    {
        $this->elementFormation = $elementFormation;
    }

    /**
     * @return mixed
     */
    public function getAffectation()
    {
        return $this->affectation;
    }

    /**
     * @param mixed $affectation
     */
    public function setAffectation($affectation)
    {
        $this->affectation = $affectation;
    }

    /**
     * @return mixed
     */
    public function getSemLabel()
    {
        return $this->semLabel;
    }

    /**
     * @param mixed $semLabel
     */
    public function setSemLabel($semLabel)
    {
        $this->semLabel = $semLabel;
    }

    /**
     * @return mixed
     */
    public function getSemSeq()
    {
        return $this->semSeq;
    }

    /**
     * @param mixed $semSeq
     */
    public function setSemSeq($semSeq)
    {
        $this->semSeq = $semSeq;
    }

    /**
     * @return mixed
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * @param mixed $credit
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;
    }

    /**
     * @return mixed
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * @param mixed $resultat
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;
    }

    public function __construct($id, $elementFormation, $affectation, $semLabel, $semSeq, $credit, $resultat)
    {
        $this->setIdentifiant($id);
        $this->setElementFormation($elementFormation);
        $this->setAffectation($affectation);
        $this->setSemLabel($semLabel);
        $this->setSemSeq($semSeq);
        $this->setCredit($credit);
        $this->setResultat($resultat);
    }

    public function toString(){
        echo $this->identifiant."--";
        echo $this->affectation."--";
        echo $this->semLabel."--";
        echo $this->semSeq."--";
        echo $this->credit."--";
        echo $this->resultat."--";

        echo "</br>";
        $this->elementFormation->toString();
        echo "</br>";
        echo "</br>";
    }
}
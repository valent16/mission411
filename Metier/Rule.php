<?php

/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 07/05/2017
 * Time: 14:53
 */
class Rule
{
    private $num;
    private $rule;
    private $cadre = null;
    private $categories = [];
    private $affectation;
    private $score;
    private $scoreEffectif = -1;

    public function __construct($ligne)
    {

        $array = explode(';',$ligne);

        $this->num = $array[0];
        $this->rule = $array[1];

        if($array[2] == 'ALL'){
            array_push($this->categories, 'ALL');
            $this->score = $array[3];
        }
        else{
            if(strpos($array[2],'(') !== false && strpos($array[2],')') !== false){
                $subArray = explode('(',$array[2]);
                $this->cadre = $subArray[0];
                $array[2] = str_replace(')','',$subArray[1]);
            }

            $catArray = explode('+',$array[2]);
            foreach ($catArray as $cat){
                array_push($this->categories, $cat);
            }

            $this->affectation = $array[3];
            $this->score = $array[4];
        }
    }

    /**
     * @return mixed
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @return mixed
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @return null
     */
    public function getCadre()
    {
        return $this->cadre;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return mixed
     */
    public function getAffectation()
    {
        return $this->affectation;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return int
     */
    public function getScoreEffectif()
    {
        return $this->scoreEffectif;
    }

    /**
     * @param int $scoreEffectif
     */
    public function setScoreEffectif($scoreEffectif)
    {
        $this->scoreEffectif = $scoreEffectif;
    }
}

?>
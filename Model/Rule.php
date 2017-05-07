<?php

/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 07/05/2017
 * Time: 14:53
 */
class Rule
{
    public $num;
    public $rule;
    public $cadre = null;
    public $categories = [];
    public $affectation;
    public $score;

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

}

?>
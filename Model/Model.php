<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 10/05/2017
 * Time: 13:40
 */

class Model{
	protected $dataError;

    public function getError(){
        if(empty($this->dataError)){
            return false;
        }
        return $this->dataError;
    }

    public function __construct($dataError){
        $this->dataError = $dataError;
    }
}

?>
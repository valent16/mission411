<?php
/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 07/05/2017
 * Time: 14:40
 */
require_once('Rule.php');

class Regulation
{
    private $title;
    private $rules = [];

    public function __construct($title)
    {
        $this->title = $title;

        $handle = fopen("../Ressources/" . $title . ".csv", 'r');
        if ($handle) {
            while (!feof($handle)) {
                array_push($this->rules, new Rule(fgets($handle)));
            }
            fclose($handle);
        }
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }
}

?>
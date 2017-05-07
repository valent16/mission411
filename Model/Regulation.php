<?php
/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 07/05/2017
 * Time: 14:40
 */
require_once ('Rule.php');

class Regulation
{
    public $title;
    public $rules = [];

    public function __construct($title)
    {
        $this->title = $title;

        $handle = fopen("Ressources/" . $title . ".csv", 'r');
        if ($handle) {
            while (!feof($handle)) {
                array_push($this->rules, new Rule(fgets($handle)));
            }
            fclose($handle);
        }
    }
}

?>
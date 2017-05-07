<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 07/05/2017
 * Time: 12:39
 */

class Config{
    public static function getViews(){
        global $rootDirectory;

        $vueDirectory = $rootDirectory."Vues/";

        return array("home" => $vueDirectory."home.php",
                    "commonFunction" => $vueDirectory."commonFunction.php");
    }

    public static function getCSS(){
        global $rootDirectory;

        $cssDirectory = $rootDirectory."assets/";

        return array("bootstrap" => $cssDirectory."bootstrap/css/bootstrap.css");
    }
}

?>
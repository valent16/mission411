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
                    "commonFunction" => $vueDirectory."commonFunction.php",
                    "ajoutCursus" => $vueDirectory."ajoutCursus.php",
                    "applicationReglementCursus" => $vueDirectory."applicationReglementCursus.php",
                    "detailCursus" => $vueDirectory."detailCursus.php",
                    "modifierElementFormation" => $vueDirectory."modificationElementFormation.php");
    }

    public static function getCSS(){
        $cssDirectory = "http://".$_SERVER['HTTP_HOST']."/mission411.git/trunk/Assets/";

        return array("bootstrap" => $cssDirectory."bootstrap/css/bootstrap.css",
                    "cssPerso" => $cssDirectory."cssPerso/design.css");
    }

    public static function getScript(){
        $scriptDirectory = "http://".$_SERVER['HTTP_HOST']."/mission411.git/trunk/Assets/";

        return array("scriptBootstrap" => $scriptDirectory."bootstrap/js/bootstrap.min.js",
                    "jQuery" => $scriptDirectory."JQuery/jquery.min.js");
    }
}

?>
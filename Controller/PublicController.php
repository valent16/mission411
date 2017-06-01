<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 04/05/2017
 * Time: 19:54
 */

class PublicController{

    function __construct()
    {
        $role = "public";
        try{
            if (isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
            }else{
                $action=null;
            }
            switch($action){

                case "ajoutCursus":
                    require(Config::getViews()["ajoutCursus"]);
                    break;

                case "home":
                    require(Config::getViews()["home"]);
                    break;

                case "detailCursus":
                    require(Config::getViews()["detailCursus"]);
                    break;

                case "visualisationCursus":
                    require(Config::getViews()["visualisationCursus"]);
                    break;

                case "modifierElementFormation":
                    require(Config::getViews()["modifierElementFormation"]);
                    break;

                default :
                    require(Config::getViews()["home"]);
                    break;
            }
        }catch(Exception $e){
            $error = new Error(array('exception' => $e->getMessage()));
            //require(Config::getVuesErreur()['']);
        }
    }
}

?>
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
                case "":
                    break;

                default :
                    require(Config::getVues()["default"]);
                    break;
            }
        }catch(Exception $e){
            $error = new Error(array('exception' => $e->getMessage()));
            //require(Config::getVuesErreur()['']);
        }
    }
}

?>
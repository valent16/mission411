<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 04/05/2017
 * Time: 20:27
 */
$rootDirectory = dirname(__FILE__).'/';

require_once ($rootDirectory.'/config/Autoload.php');

//Ajouter gestion Exception
Autoload::load();

$cont = new ControleurFront();
?>
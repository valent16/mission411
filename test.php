<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 09/06/2017
 * Time: 10:59
 */
$rootDirectory = dirname(__FILE__).'/';

require_once ($rootDirectory.'config/Autoload.php');
Autoload::load();

$rs =  ElementFormationGateway::countElementFormationEffectue(7);
?>
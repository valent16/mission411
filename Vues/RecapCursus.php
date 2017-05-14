<?php
/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 13/05/2017
 * Time: 21:23
 */
require_once ('../config/Config.php');
require_once('commonFunction.php');
require_once ('../Persistance/CursusSaver.php');
enTeteHTML("Récapitulation cursus", "UTF-8", Config::getCSS(), "");

var_dump($_POST);

CursusSaver::save($_POST);

?>


<h1>Récapitulation cursus</h1>
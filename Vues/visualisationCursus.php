<?php
/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 08/05/2017
 * Time: 13:53
 */
require_once('../Persistance/RegulationFiller.php');
require_once ('../config/Config.php');
require_once('commonFunction.php');
enTeteHTML("Visualisation debug", "UTF-8", Config::getCSS(), "");



?>

<div>
    <nav class="navbar-fixed-top navbar-inverse" role="navigation">
        <div class="collapse navbar-collapse navbar-exinverse-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#">
                        <i class="glyphicon glyphicon-home"></i>
                        Accueil
                    </a>
                </li>
                <li class="divider-vertical"></li>

                <li class="dropdown">
                    <a data-target="#" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Actions
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">Ajouter Cursus</a>
                        </li>
                        <li>
                            <a href="#">Importer Règlement</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="container">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="text-center">
            <h1>Visualisation d'un cursus en fonction d'un règlement </h1>
            </br>
            </br>
        </div>
    </div>
</div>
<?php
    function printCategories($categories){
        $conc = '';
        $count = 1;
        foreach ($categories as $cat){
            if($count == 1) $conc .= $cat;
            else $conc .= ', '.$cat;
            $count++;
        }
        return $conc;
    }

    function progressBar($x, $y){
        $res = ($x / $y)*100;
        if($res <= 0){
            echo "<div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='0' 
                    style='min-width: 2em; width: 0%;'>";
        }
        elseif($res >= 100){
            echo "<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='0' 
                    style='min-width: 2em; width: 100%;'>";

        }
        else {
            echo "<div class='progress-bar progress-bar-warning' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='0' 
                    style='min-width: 2em; width:".$res."%;'>";

        };
    }

    function glyphIcon($scoreEffectif){
        if($scoreEffectif > -1){
           echo '<span style="font-size: 30px" class="glyphicon glyphicon-ok text-success" ></span>';
        }
        else{
            echo '<span style="font-size: 30px" class="glyphicon glyphicon-remove text-danger" ></span>';
        }
    }

    $regulation = RegulationFiller::getRegulation($_GET['num_etu'],$_GET['num_cursus'],$_GET['reglement']);

    echo "<div class='container'>";
    echo "<div class='col-lg-8 col-lg-offset-2'>";
    echo "<table width='100%' align='center'>";
    foreach($regulation->getRules() as $rule){
    //Pour chacune des règles du règlement
        echo "<tr>";
        switch ($rule->getRule()){
            case 'SUM' :
                echo "<td width='50%'>";
                        if($rule->getCategories()[0] == 'ALL') echo '<h4> Somme des toutes les matières effectuées </h4>';
                        else echo '<h4> Somme des '.printCategories($rule->getCategories()).' de '.$rule->getAffectation().' </h4>';
                echo "</td>";

                echo "<td width='50%'>";
                        echo '<div class="progress" style="width: 100%">';
                            progressBar($rule->getScoreEffectif(),$rule->getScore());
                            echo $rule->getScoreEffectif()."/".$rule->getScore();
                            echo '</div>';
                        echo '</div>';
                echo "</td>";
                break;
            case 'EXIST' :
                echo "<td width='50%'>";
                    echo '<h4> Existance de '.printCategories($rule->getCategories()).' effectuée en '.$rule->getAffectation().' </h4>';
                echo "</td>";
                echo "<td width='50%'>";
                    glyphIcon($rule->getScoreEffectif());
                echo "</td>";
                break;
            default : echo 'Règle inconnue';
                break;
        }
        echo "</tr>";
    }
    echo "</table>";
?>


<?php
loadJavaScript();
finFichierHTML();
?>
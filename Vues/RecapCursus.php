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

//var_dump($_POST);

CursusSaver::save($_POST);

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
                            <a href="Vues/ajoutCursus.php"> Ajouter Cursus</a>
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
            <h1>Récapitualtif du cursus</h1>
            </br>
            </br>
            <p>
                Vous pouvez visualiser le cursus en fonction d'un règlement
                </br>
                </br>
                Sélectionnez un règlement dans la liste déroulante ci dessous puis cliquez sur visualiser
            </p>
        </div>

        <form class="form-horizontal" method="get" action="visualisationCursus.php" target="_blank">
            <div class="form-group">
                <label class="control-label col-sm-3" for="reglement">Règlement:</label>
                <div class="col-sm-8">
                    <select class="form-control" id="reglement" name="reglement">
                        <option value="R_ACTUEL_BR">Règlement actuel de branche</option>
                    </select>
                </div>
                <?php
                    echo "<input type='hidden' name='num_etu' value='".$_POST['num_etu']."'/>";
                    echo "<input type='hidden' name='num_cursus' value='".CursusSaver::cursusExist($_POST)."'/>";
                ?>
                <br></br>
                <div align="center">
                    <button type="submit" class="btn btn-primary" >Visualiser</button>
                </div>
            </div>

        </form>
    </div>
</div>

<?php
loadJavaScript();
finFichierHTML();
?>
<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 07/05/2017
 * Time: 12:38
 */
    $cursus = array();
    $cursus[] = new Cursus("cursus_antoine",1);
    $cursus[] = new Cursus("cursus_valentin",2);
    require_once(Config::getViews()["commonFunction"]);
    enTeteHTML("UTT Cursus", "UTF-8", Config::getCSS(), "");
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
            <h1>Bienvenue sur l'outil de manipulation de cursus des étudiants</h1>
            </br>
            </br>
            <p>
                Pour ajouter un cursus, sélectionnez le bouton "Action de la barre de tache puis le bouton "Ajouter Cursus"
                </br>
                </br>
                La liste ci-dessous présente les cursus de chaque étudiant. Pour voir le détail d'un cursus, vous pouvez rechercher par nom de cursus ou par nom d'étudiant
            </p>
        </div>
    </div>
</div>


<div class="container">
    <div class="col-lg-6 col-lg-offset-3">
        <form >
            <div class="form-group">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-search"></i>
                    </span>

                    <input id="searchBox" class="form-control" placeholder="nom cursus, nom etudiant" name="searchBox" type="text" onkeyup="affichageCursus()">
                    <span class="input-group-addon">
                        <button class="btn-inverse" type="submit">Rechercher</button>
                    </span>
                </div>
            </div>
        </form>

<!--        Affichage de la liste des cursus et des noms    -->
        <div class="pre-scrollable" id="listeCursus">

            <table>
            <?php
                foreach ($cursus as $c){
                    echo "<tr>";
                    echo "<td class=\"nomCursus\">".$c->getNom()."</td>";
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    function affichageCursus(){
        var chaine = document.getElementById("searchBox").value;
        var elements = document.getElementsByClassName("nomCursus");
        if (chaine != ""){
            var regex = new RegExp(".*"+chaine+".*");
            for(var i=0; i<elements.length;i++){
                if (!regex.test(elements[i].innerHTML)){
                    elements[i].classList.add('hidden');
                }else{
                    elements[i].classList.remove('hidden');
                }
            }
        }else{
            for(var i=0; i<elements.length;i++) {
                elements[i].classList.remove('hidden');
            }
        }
    }
</script>



<?php
    loadJavaScript();
    finFichierHTML();
?>

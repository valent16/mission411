<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 07/05/2017
 * Time: 12:38
 */
    //$cursus = array();
    //$cursus[] = new Cursus("cursus_antoine",1);
    //$cursus[] = new Cursus("cursus_valentin",2);

    $modelEtudiant = ModelMapEtudiant::getModelEtudiantAll();
    $mapEtudiant = $modelEtudiant->getData();

//    foreach ($mapEtudiant as $k => $v){
//        echo "$k : ".$v->getNumCarteEtu()."</br>";
//    }

    $modelCursus = ModelCollectionCursus::getModelCursusAll();
    $collectionCursus = $modelCursus->getData();

    require_once(Config::getViews()["commonFunction"]);
    enTeteHTML("UTT Cursus", "UTF-8", Config::getCSS(), "");
    controlePublic();
?>


<div class="container container-background ">
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

    <div class="col-lg-6 col-lg-offset-3">
        <form >
            <div class="form-group">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-search"></i>
                    </span>

                    <input id="searchBox" class="form-control" placeholder="nom cursus, nom etudiant" name="searchBox" type="text" onkeyup="affichageCursus()">
<!--                    <span class="input-group-addon">-->
<!--                        <button class="btn-inverse" type="submit">Rechercher</button>-->
<!--                    </span>-->
                </div>
            </div>
        </form>

<!--        Affichage de la liste des cursus et des noms    -->
        <div class="pre-scrollable list-group" id="listeCursus">
            <table class="table-striped table table-hover">
            <?php
                foreach ($collectionCursus as $c){
                    $loc = "index.php?action=detailCursus&id_cursus=".$c->getId();
                    echo "<tr class=\"ligne-selectionnable nomCursus\"onclick=\"document.location='".$loc."'\">";
                    echo "<td class=\"nom_cursus col-lg-6\">".$c->getNom()."</td>";
                    echo "<td class=\"nom_etu col-lg-3\">".$mapEtudiant[$c->getNumEtu()]->getNom()."</td>";
                    echo "<td class=\"prenom_etu col-lg-3\">".$mapEtudiant[$c->getNumEtu()]->getPrenom()."</td>";
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="detailCursus"/>
            <div class="form-group" align="center">
                <input type="file" name="cursusCSV" id="cursusCSV">
                <input type="submit" value="Importer" name="submit">
            </div>
        </form>
    </div>

</div>



<script type="text/javascript">
    function affichageCursus(){
        var chaine = document.getElementById("searchBox").value;
        var elements = document.getElementsByClassName("nomCursus");
        var noms_cursus = document.getElementsByClassName("nom_cursus");
        var nom_etu = document.getElementsByClassName("nom_etu");
        var prenom_etu = document.getElementsByClassName("prenom_etu");

        if (chaine != ""){
            tableauR = chaine.split(" ");
            var tabRegex = new Array();

            for (var i=0; i<tableauR.length;i++){
                tabRegex.push(new RegExp(".*"+tableauR[i].toLowerCase()+".*"));
            }

            for(var i=0; i<elements.length;i++){
                element_chaine = new Array(noms_cursus[i].innerHTML,nom_etu[i].innerHTML,prenom_etu[i].innerHTML);
                if (!testChaine(tabRegex, element_chaine)){
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

    function testChaine(tableauRegex, tableauElement){
        for (var i=0; i<tableauRegex.length; i++){
            var match = false;
            for(var j=0; j<tableauElement.length; j++){
                if (tableauRegex[i].test(tableauElement[j].toLowerCase())){
                    match = true;
                }
            }
            if (!match){
                return false;
            }
        }
        return true;
    }
</script>



<?php
    loadFooter();
    loadJavaScript();
    finFichierHTML();
?>

<?php
/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 13/05/2017
 * Time: 21:23
 */

require_once(Config::getViews()["commonFunction"]);

$numCursus = null;
if(isset($_GET["id_cursus"])){
    $numCursus = $_GET["id_cursus"];
}

if(isset($_GET["export"])){
    //On exporte le cursus du monsieur en CSV
    Export::toCSV($numCursus);
}

if(isset($_FILES['cursusCSV'])){
    //On importe le cursus du monsieur et on retourne le numéro de cursus
    $numCursus = Import::fromCSV($_FILES['cursusCSV']['tmp_name'],$_FILES['cursusCSV']['name']);
}

enTeteHTML("Récapitulation cursus", "UTF-8", Config::getCSS(), "");
controlePublic();

$modelCollectionElementFormation = ModelCollectionElementFormationEffectue::getModelElementsFormationByIdCursus($numCursus);
$collectionElementFormation = $modelCollectionElementFormation->getData();
$modelCursus = ModelCursus::getCursusById($numCursus);
//print_r($modelCollectionElementFormation->getError());
//print_r($modelCursus->getError());
$cursus = $modelCursus->getData();
$cursus->affectationElementsFormation($collectionElementFormation);
$modelEtudiant = ModelEtudiant::getEtudiantById($cursus->getNumEtu());

?>
<div class="container">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="row">
            <div class="col-lg-4">
                <h1>
                    Etudiant
                </h1>

                <?php
                echo "<p>
                    Nom: ".$modelEtudiant->getData()->getNom()."</br>
                    Prenom: ".$modelEtudiant->getData()->getPrenom()."</br></br>
                    Numéro carte étudiant: ".$modelEtudiant->getData()->getNumCarteEtu()."</br></br>
                    Admission: ".$modelEtudiant->getData()->getAdmission()."</br></br>
                    Filière: ".$modelEtudiant->getData()->getFiliere()."</br></br>
                </p>";
                ?>
            </div>


            <div class="col-lg-8">
                <h1>Simulation d'un règlement</h1>
                </br>
                </br>
                <p>
                    Vous pouvez visualiser le cursus en fonction d'un règlement
                    </br>
                    </br>
                    Sélectionnez un règlement dans la liste déroulante ci dessous puis cliquez sur visualiser
                </p>

                <form class="form-horizontal" method="get" action="index.php?action=applicationReglementCursus" target="_blank">
                    <input type="hidden" name="action" value="applicationReglementCursus" />
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="reglement">Règlement:</label>
                        <div class="col-sm-8">
                            <?php
                                $files = scandir(dirname(__FILE__).'/../Ressources/reglements');
                                $reglements=[];
                                for($i=2;$i<count($files);$i++){
                                    $name = explode('.',$files[$i])[0];
                                    $reglements[$name] = $name;
                                }
                                echo select("form-control","reglement","reglement",$reglements,"");
                            ?>
                        </div>

                        <?php
                        echo "<input type='hidden' name='num_etu' value='".$modelEtudiant->getData()->getNumCarteEtu()."'/>";
                        echo "<input type='hidden' name='num_cursus' value='".$numCursus."'/>";
                        ?>
                        <br></br>
                        <div align="center">
                            <button type="submit" class="btn btn-primary" >Visualiser</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <div class="row text-center">
            <?php
                //génération de la liste de cursus
                $elementsFormationsTC = $cursus->getMapSortTC();
                $elementsFormationsBranche = $cursus->getMapSortBranche();

                if ($modelEtudiant->getData()->getAdmission() ==='TC'){
                    echo "<h1>Elements de formation suivis en TC</h1>";
                    afficherElementsFormation($cursus, $elementsFormationsTC, true);
                }


                echo "<h1>Elements de formation suivis en Branche</h1>";
                afficherElementsFormation($cursus, $elementsFormationsBranche, false);


                function afficherElementsFormation($cursus, $elementsFormations, $isTC){
                    if ($isTC){
                        $cycle="TC";
                    }else {
                        $cycle = "Branche";
                    }

                    if (count($elementsFormations) == 0){
                        echo "Aucun élément de formation pour le cycle ".$cycle;
                    }

                    $listeElements = array();

                    foreach($elementsFormations as $k=>$elementsFormations){

                        echo '
                    <a class="btn btn-primary btn-block margin-bottom-20 btn-sem" id="Semestre-'.$k.'-'.$cycle.'" >Semestre '.$k.'</a>';

                        echo '<div class="text-left" id="div-Semestre-'.$k.'-'.$cycle.'">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <ul class="list-group">';

                        //Parcours des elements de formation effectués
                        foreach($elementsFormations as $e){
                            $listeElements[] = $e;
                            echo '<li class="list-group-item">
                                <a data-toggle="modal" href="#'.$e->getSemLabel().''.$e->getElementFormation()->getSigle().'">'.$e->getElementFormation()->getSigle().'</a>
                                <div class="pull-right action-buttons">
                                    <a href="index.php?action=modifierElementFormation&id='.$e->getIdentifiant().'&id_cursus='.$cursus->getId().'
                                  "><span class="glyphicon glyphicon-pencil"></span></a>
                                 </div>
                              </li>';
                        }
                        echo '        </ul>
                                </div>
                            </div>
                        </div>';
                    }
                    genererDetailElementFormation($listeElements);
                }

                //Permet de générer les pages présentant le détail des cursus
                function genererDetailElementFormation($elementsFormations){
                    foreach($elementsFormations as $e) {
                        if ($e->getElementFormation()->getUtt()){
                            $realisationModuleUtt = "oui";
                        }else{
                            $realisationModuleUtt = "non";
                        }

                        echo '
                        <div class="modal fade" id="' .$e->getSemLabel().''.$e->getElementFormation()->getSigle().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Détail du module '.$e->getElementFormation()->getSigle().'</h4>
                                    </div>
                                    <div class="modal-body">
                                            <p>Affectation: '.$e->getAffectation().'</p>
                                            <p>Catégorie:  '.$e->getElementFormation()->getCategorie().'</p>
                                            <p>UV réalisée à l\'UTT: '.$realisationModuleUtt.'</p>
                                            <p>Numéro du semestre: '.$e->getSemLabel().'</p>
                                            <p>Résultat: '.$e->getResultat().'</p>
                                            <p>Crédits obtenus '.$e->getCredit().'</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                }

            echo '</br></br>';
            echo '<a type="button" class="btn btn-primary" href="index.php?action=modifierCursus&num_cursus='.$numCursus.'">Modifier Cursus</a>';
            ?>

            </br>
            </br>
            <form class="form-horizontal" method="get" action="index.php">
                <input type="hidden" name="action" value="detailCursus"/>
                <input type="hidden" name="export" value="export" />
                <?php echo "<input type='hidden' name='id_cursus' value='".$numCursus."'/>"; ?>
                    <div class="col-lg-8 col-lg-offset-2" align="center">
                    <button type="submit" class="btn btn-primary">Exporter en CSV</button>
                </div>
            </form>

            </br>
            </br>
            <?php
            echo '<a type="button" class="btn btn-danger" href="index.php?action=suppressionCursus&id_cursus='.$numCursus.'">Supprimer Cursus</a>';
            echo '<a type="button" class="btn btn-primary" href="index.php?action=dupliquerCursus&id_cursus='.$numCursus.'">Dupliquer Cursus</a>';
            ?>
        </div>
    </div>
</div>

    <script>
        $( document ).ready(function() {
//            $('#div-Semestre-1').hide();
//            $('div').filter(function() {
//                    return this.id.match(/Semestre.*/);
//                }).hide();
            $('a.btn-sem').addClass("active");
        });


        $(function() {
            $('a').click(function(){
                var valeur;
                if (valeur = $(this).attr("id").match(/^Semestre-[0-9]*-[A-Za-z]*$/)){
                    if ( $('#div-'+valeur).is(":visible")){
                        $('#'+valeur).removeClass("active");
                        $('#div-'+valeur).hide(1000);
                    }else{
                        $('#'+valeur).addClass("active");
                        $('#div-'+valeur).show('slow');
                    }

                }
            });
        });
    </script>
<?php
    loadFooter();
    loadJavaScript();
    finFichierHTML();
?>
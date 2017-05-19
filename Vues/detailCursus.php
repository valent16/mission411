<?php
/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 13/05/2017
 * Time: 21:23
 */

require_once(Config::getViews()["commonFunction"]);
enTeteHTML("Récapitulation cursus", "UTF-8", Config::getCSS(), "");
//var_dump($_POST);
//CursusSaver::save($_POST);
controlePublic();

$numCursus = $_GET["id"];
$modelCollectionElementFormation = ModelCollectionElementFormation::getModelElementsFormationByIdCursus($numCursus);
$collectionElementFormation = $modelCollectionElementFormation->getData();
$modelCursus = ModelCursus::getCrususById($numCursus);
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

                <form class="form-horizontal" method="get" action="applicationReglementCursus.php" target="_blank">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="reglement">Règlement:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="reglement" name="reglement">
                                <option value="R_ACTUEL_BR">Règlement actuel de branche</option>
                            </select>
                        </div>

                        <?php
                        echo "<input type='hidden' name='num_etu' value='".$modelEtudiant->getData()->getNumCarteEtu()."'/>";
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



        <div class="row text-center">
            <h1>Récapitulatif du cursus</h1>

            <?php
                //génération de la liste de cursus
                $elementsFormationsTC = $cursus->getMapSortTC();
                $elementsFormationsBranche = $cursus->getMapSortBranche();
                echo "<h1>Elements de formation suivis en TC</h1>";
                afficherElementsFormation($elementsFormationsTC, true);
                echo "<h1>Elements de formation suivis en Branche</h1>";
                afficherElementsFormation($elementsFormationsBranche, false);


                function afficherElementsFormation($elementsFormations, $isTC){
                    if ($isTC){
                        $cycle="TC";
                    }else {
                        $cycle = "Branche";
                    }

                    if (count($elementsFormations) == 0){
                        echo "Aucun élément de formation pour le cycle ".$cycle;
                    }

                    foreach($elementsFormations as $k=>$elementsFormations){
                        echo '
                    <a class="btn btn-primary btn-block margin-bottom-20 " id="Semestre-'.$k.'-'.$cycle.'" >Semestre '.$k.'</a>';

                        echo '<div class="text-left" id="div-Semestre-'.$k.'-'.$cycle.'">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <ul class="list-group">';
                        foreach($elementsFormations as $e){
                            echo '<li class="list-group-item">
                                <span>'.$e->getElementFormation()->getSigle().'</span>
                                <div class="pull-right action-buttons">
                                    <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                 </div>
                              </li>';
                        }
                        echo '        </ul>
                                </div>
                            </div>
                        </div>';
                    }
                }

            ?>
        </div>
    </div>
</div>


    <script>
        $( document ).ready(function() {
            $('#div-Semestre-1').hide();
            $('div').filter(function() {
                    return this.id.match(/Semestre.*/);
                }).hide();
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
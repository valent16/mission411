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
$modelCursus = ModelCursus::getCrususById($numCursus);
$cursus = $modelCursus->getData();
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

            <button type="button" class="btn btn-primary btn-block" id="Semestre-1">
                Semestre 1
<!--                <span class="pull-right">-->
<!--                <span class="glyphicon glyphicon-trash "></span>-->
<!--                </span>-->
            </button>

            <a class="btn btn-primary btn-block" id="lien-a" >bonjur</a>
        </div>

        <div class="row" id="div-Semestre-1">
            <p>
                Coucou les amis
            </p>

        </div>
    </div>
</div>


    <button id="affiche">Faire apparaître les lignes paires</button>

    <button id="cache">Faire disparaître les lignes paires</button><br />

    <table border>

        <tr><td>a</td><td>b</td><td>c</td></tr>

        <tr><td>d</td><td>e</td><td>f</td></tr>

        <tr><td>g</td><td>h</td><td>i</td></tr>

        <tr><td>j</td><td>k</td><td>l</td></tr>

        <tr><td>m</td><td>n</td><td>o</td></tr>

    </table>




    <script src="jquery.js"></script>

    <script>
        $( document ).ready(function() {
            $('#div-Semestre-1').hide();
        });


        $(function() {
            $('tr:even').css('background','yellow');
            $('td').css('width','200px');
            $('td').css('text-align','center');

            $('#affiche').click(function() {
                $('tr:even').show('slow');
            } );

            $('#cache').click(function() {
                $('tr:even').hide(1000);
            });

            $('button').click(function(){
                //alert($(this).attr("id"));

                if ( $('#div-'+$(this).attr("id")+'').is(":visible")){
                    $('#div-'+$(this).attr("id")+'').hide(1000);
                }else{
                    $('#div-'+$(this).attr("id")+'').show('slow');
                }

                //console.log('div-'+$(this).attr("id")+'');

            })



            $('a').click(function(){
                //alert($(this).attr("id"));

                if ( $('#div-Semestre-1').is(":visible")){
                    $('#lien-a').removeClass("active");
                    $('#div-Semestre-1').hide(1000);
                }else{
                    $('#lien-a').addClass("active");
                    $('#div-Semestre-1').show('slow');
                }
                //console.log('div-'+$(this).attr("id")+'');

            })

        });

    </script>

<?php
    loadFooter();
    loadJavaScript();
    finFichierHTML();
?>
<?php
/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 13/05/2017
 * Time: 14:08
 */

//require_once ('../config/Config.php');
//require_once('commonFunction.php');
require_once(Config::getViews()["commonFunction"]);
enTeteHTML("Ajout d'un Cursus", "UTF-8", Config::getCSS(), "");
controlePublic();


$modelEtudiant = null;
$cursus = null;
if(isset($_GET['num_cursus'])){
    $numCursus = $_GET['num_cursus'];
    $modelCollectionElementFormation = ModelCollectionElementFormationEffectue::getModelElementsFormationByIdCursus($numCursus);
    $collectionElementFormation = $modelCollectionElementFormation->getData();
    $modelCursus = ModelCursus::getCrususById($numCursus);
    $cursus = $modelCursus->getData();
    $cursus->affectationElementsFormation($collectionElementFormation);
    $modelEtudiant = ModelEtudiant::getEtudiantById($cursus->getNumEtu());
}

?>

<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="text-center">
            <h1>Bienvenue sur l'outil d'ajout de cursus</h1>
            </br>
            </br>
        </div>
    </div>
</div>

<form class="form-horizontal" method="post" action="index.php?action=receptionCursus">
<!--    <input type="hidden" name="action" value="detailCursus" />-->
    <div class="container">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="form-group">
                <label class="control-label col-sm-3" for="num_etu">Numéro étudiant:</label>
                <div class="col-sm-9">
                    <?php
                        echo input("text","form-control","num_etu","num_etu",($modelEtudiant==null ? "" : $modelEtudiant->getData()->getNumCarteEtu()),"Entrer numéro étudiant");
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="nom_etu">Nom:</label>
                <div class="col-sm-9">
                    <?php echo input("text","form-control","nom_etu","nom_etu",($modelEtudiant==null ? "" : $modelEtudiant->getData()->getNom()),"Entrer nom étudiant"); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="prenom_etu">Prenom:</label>
                <div class="col-sm-9">
                    <?php echo input("text","form-control","prenom_etu","prenom_etu",($modelEtudiant==null ? "" : $modelEtudiant->getData()->getPrenom()),"Entrer prénom étudiant"); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="admission">Admission:</label>
                <div class="col-sm-9">
                    <?php echo select("form-control","admission","admission",["Tronc Commun" => "TC", "Branche" => "BR"],($modelEtudiant==null ? "" : $modelEtudiant->getData()->getAdmission())); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="filiere">Filière:</label>
                <div class="col-sm-9">
                    <?php echo select("form-control","filiere","filiere",["?" => "?", "MPL" => "MPL","MSI" => "MSI","MRI" => "MRI", "LIB" => "LIB"],($modelEtudiant==null ? "" : $modelEtudiant->getData()->getFiliere())); ?>
                </div>
            </div>
        </div>
    </div>
    <br></br>

    <div class="container">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="form-group">
                <label class="control-label col-sm-3" for="nom_cursus">Nom Cursus:</label>
                <div class="col-sm-9">
                    <?php echo input("text","form-control","nom_cursus","nom_cursus",($cursus==null ? "" : $cursus->getNom()),"Entrer nom cursus"); ?>
                </div>
            </div>
        </div>
    </div>
    <br></br>


    <div class="elements_formation">
        <?php
        $max = 0;
        if($cursus == null){
            $max = 1;
        }
        else{
            $max = count($cursus->getElementsFormationEffectues());
        }
        for($i = 0; $i<$max; $i++) {
        ?>
            <div class="element">
                <div class="container">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="sigle">Sigle:</label>
                            <div class="col-sm-9">
                                <?php echo input("text", "form-control", "sigle", "sigle[]", ($cursus==null ? "" : $cursus->getElementsFormationEffectues()[$i]->getElementFormation()->getSigle()), "Entrer sigle"); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="utt">Validé à l'UTT</label>
                            <div class="col-sm-2">
                                <?php echo select("form-control", "utt", "utt[]", ["Oui" => "oui", "Non" => "non"], ($cursus==null ? "cc" : $cursus->getElementsFormationEffectues()[$i]->getElementFormation()->getUtt())); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="categorie">Catégorie</label>
                            <div class="col-sm-9">
                                <?php echo select("form-control", "categorie", "categorie[]", ["CS" => "CS", "TM" => "TM", "ST" => "ST", "EC" => "EC"
                                    , "ME" => "ME", "CT" => "CT", "HP" => "HP", "NPML" => "NPML"], ($cursus==null ? "" : $cursus->getElementsFormationEffectues()[$i]->getElementFormation()->getCategorie())); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="affectation">Affectation:</label>
                            <div class="col-sm-9">
                                <?php echo select("form-control", "affectation", "affectation[]", ["Tronc Commun" => "TC", "Tronc Commun de Branche" => "TCBR", "Filière" => "FCBR"], ($cursus==null ? "" : $cursus->getElementsFormationEffectues()[$i]->getAffectation())); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="sem_label">Libellé du semestre:</label>
                            <div class="col-sm-9">
                                <?php echo select("form-control", "sem_label", "sem_label[]", ["TC" => "TC", "ISI" => "ISI", "SRT" => "SRT", "MTE" => "MTE"], ($cursus==null ? "" : $cursus->getElementsFormationEffectues()[$i]->getSemLabel())); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="sem_seq">Numéro de semestre:</label>
                            <div class="col-sm-9">
                                <?php echo input("number", "form-control", "sem_seq", "sem_seq[]", ($cursus==null ? "" : $cursus->getElementsFormationEffectues()[$i]->getSemSeq()), "Entrer numéro semestre"); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="credits">Nombre de crédits:</label>
                            <div class="col-sm-9">
                                <?php echo input("number", "form-control", "credits", "credits[]", ($cursus==null ? "" : $cursus->getElementsFormationEffectues()[$i]->getCredit()), "Entrer nombre crédits"); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="resultat">Résultat:</label>
                            <div class="col-sm-9">
                                <?php echo select("form-control", "resultat", "resultat[]", ["A" => "A", "B" => "B", "C" => "C", "D" => "D"
                                    , "FX" => "FX", "F" => "F","ADM"=>"ADM","EQU"=>"EQU"], ($cursus==null ? "" : $cursus->getElementsFormationEffectues()[$i]->getResultat())); ?>
                            </div>
                        </div>
                        <div class="remove_field_button" align="center">
                            <button type="button" class="btn btn-danger">Supprimer</button>
                        </div>
                    </div>
                </div>
                <br></br>
            </div>
            <?php
        }
        ?>
        </div>

    <div class="container">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="add_field_button" align="center">
                <button type="button" class="btn btn-success">Ajouter</button>
            </div>
        </div>
    </div>
    <br></br>
    <div class="container">
        <div class="col-lg-8 col-lg-offset-2" align="center">
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </div>
    </div>
</form>

<script type="text/javascript" >
    $(document).ready(function() {

        var wrapper = $(".elements_formation");
        var element = $(".element").last().clone();
        var add_button = $(".add_field_button");

        $(add_button).click(function(e){
            e.preventDefault();
            $(element).clone(true)
                .find("input").val("").removeAttr('selected').end()
                .appendTo(wrapper);
        });

        $(".element").on("click",".remove_field_button", function(e){
            console.log("Click");
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove();
        });

        $(element).on("click",".remove_field_button", function(e){
            console.log("Click");
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove();
        });

        $('#sigle').on('input', function() {
            console.log("Input");
            if($(this).val().length == 4) {
                console.log("4 char");
                var sigle = $(this).val();

            }
        });

    });
</script>

<?php
loadFooter();
loadJavaScript();
finFichierHTML();
?>

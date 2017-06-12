<?php
/**
 * Created by PhpStorm.
 * User: gilbe
 * Date: 01/06/2017
 * Time: 15:12
 */


require_once(Config::getViews()["commonFunction"]);
enTeteHTML("Modification element de formation", "UTF-8", Config::getCSS(), "");
controlePublic();

if (isset($_GET["id"])) {
    //faire le check au niveau des input
    $id_element_formation_effectue = $_GET["id"];
    $id_cursus = $_GET["id_cursus"];
    $modelElementFormationEffectue = ModelElementFormationEffectue::getElementFormationEffectueById($id_element_formation_effectue);
    $elementFormationEffectue = $modelElementFormationEffectue->getData();
}
?>

<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="text-center">
            <h1>Bienvenue sur l'outil de modification d'un élément de formation</h1>
            </br>
            </br>
        </div>
    </div>
</div>
<?php
    echo '<form class="form-horizontal" method="post" action="index.php?action=enregistrementElementFormation&id_cursus='.$id_cursus.'&id_element_formation='.$id_element_formation_effectue.'">';
?>
    <div class="container">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="form-group">
                <label class="control-label col-sm-3" for="sigle">Sigle:</label>
                <div class="col-sm-9">
                    <?php echo input("text", "form-control", "sigle", "sigle", $elementFormationEffectue->getElementFormation()->getSigle(), "Entrer sigle"); ?>
                </div>
            </div>
            <div class="form-group w-100">
                <label class="control-label col-sm-3" for="utt">Validé à l'UTT</label>
                <div class="col-sm-2">
                    <?php echo select("form-control", "utt", "utt", ["Oui" => "oui", "Non" => "non"], $elementFormationEffectue->getElementFormation()->getUtt()); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="categorie">Catégorie</label>
                <div class="col-sm-9">
                    <?php echo select("form-control", "categorie", "categorie", ["CS" => "CS", "TM" => "TM", "ST" => "ST", "EC" => "EC"
                        , "ME" => "ME", "CT" => "CT", "HP" => "HP", "NPML" => "NPML"], $elementFormationEffectue->getElementFormation()->getCategorie()); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="affectation">Affectation:</label>
                <div class="col-sm-9">
                    <?php echo select("form-control", "affectation", "affectation", ["Tronc Commun" => "TC", "Tronc Commun de Branche" => "TCBR", "Filière" => "FCBR"], $elementFormationEffectue->getAffectation()); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="sem_label">Libellé du semestre:</label>
                <div class="col-sm-9">
                    <?php echo select("form-control", "sem_label", "sem_label", ["TC" => "TC", "ISI" => "ISI", "SRT" => "SRT", "MTE" => "MTE"],$elementFormationEffectue->getSemLabel()); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="sem_seq">Numéro de semestre:</label>
                <div class="col-sm-9">
                    <?php echo input("number", "form-control", "sem_seq", "sem_seq", $elementFormationEffectue->getSemSeq(), "Entrer numéro semestre"); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="credits">Nombre de crédits:</label>
                <div class="col-sm-9">
                    <?php echo input("number", "form-control", "credits", "credits", $elementFormationEffectue->getCredit(), "Entrer nombre crédits"); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="resultat">Résultat:</label>
                <div class="col-sm-9">
                    <?php echo select("form-control", "resultat", "resultat", ["A" => "A", "B" => "B", "C" => "C", "D" => "D"
                        , "FX" => "FX", "F" => "F"],$elementFormationEffectue->getResultat()); ?>
                </div>
            </div>
            <div class="text-center">
                <?php
                    echo '<a type="button" class="btn btn-danger" href="index.php?action=suppressionElementFormation&id='.$id_element_formation_effectue.'&id_cursus='.$id_cursus.'">Supprimer</a>';
                    echo '<a type="button" class="btn btn-default" href="index.php?action=detailCursus&id_cursus='.$id_cursus.'">Annuler</a>';
                ?>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>

        </div>
    </div>
    <br></br>
</form>
<?php
loadFooter();
loadJavaScript();
finFichierHTML();
?>
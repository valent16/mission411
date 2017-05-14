<?php
/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 13/05/2017
 * Time: 14:08
 */

require_once ('../config/Config.php');
require_once('commonFunction.php');
enTeteHTML("Ajout d'un Cursus", "UTF-8", Config::getCSS(), "");
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

<form class="form-horizontal" method="post" action="RecapCursus.php">
    <div class="container">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="form-group">
                <label class="control-label col-sm-3" for="num_etu">Numéro étudiant:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="num_etu" name="num_etu" placeholder="Entrer numéro étudiant"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="nom_etu">Nom:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nom_etu" name="nom_etu" placeholder="Entrer nom"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="prenom_etu">Prenom:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="prenom_etu" name="prenom_etu" placeholder="Entrer prénom"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="admission">Admission:</label>
                <div class="col-sm-9">
                    <select class="form-control" id="admission" name="admission">
                        <option value="tc">Tronc Commun</option>
                        <option value="br">Branche</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="filiere">Filière:</label>
                <div class="col-sm-9">
                    <select class="form-control" id="filiere" name="filiere">
                        <option value="?">Pas encore en filière</option>
                        <option value="MPL">MPL</option>
                        <option value="MSi">MSI</option>
                        <option value="MRI">MRI</option>
                        <option value="LIB">LIB</option>
                    </select>
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
                    <input type="text" class="form-control" id="nom_cursus" name="nom_cursus" placeholder="Entrer nom cursus"/>
                </div>
            </div>
        </div>
    </div>
    <br></br>

    <div class="elements_formation">
        <div class="element">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="sigle">Sigle:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="sigle" name="sigle[]" placeholder="Entrer sigle"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="utt">Validé à l'UTT</label>
                        <div class="col-sm-2">
                            <select class="form-control" id="utt" name="utt[]">
                                <option value="oui">Oui</option>
                                <option value="non">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="categorie">Catégorie</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="categorie" name="categorie[]">
                                <option value="CS">CS</option>
                                <option value="TM">TM</option>
                                <option value="EC">CT</option>
                                <option value="HT">HT</option>
                                <option value="ME">ME</option>
                                <option value="ST">ST</option>
                                <option value="SE">SE</option>
                                <option value="HP">HP</option>
                                <option value="NPML">NPML</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="affectation">Affectation:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="affectation" name="affectation[]">
                                <option value="TC">Tronc Commun</option>
                                <option value="TCBR">Tronc Commun de Branche</option>
                                <option value="FCBR">Filière</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="sem_label">Libellé du semestre:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="sem_label" name="sem_label[]">
                                <option value="TC">TC</option>
                                <option value="ISI">ISI</option>
                                <option value="SRT">SRT</option>
                                <option value="MTE">MTE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="sem_seq">Numéro de semestre:</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="sem_seq" name="sem_seq[]" placeholder="Entrer numéro semestre"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="credits">Nombre de crédits:</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="credits" name="credits[]" placeholder="Entrer nombre crédits"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="resultat">Résultat:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="resultat" name="resultat[]">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="FX">FX</option>
                                <option value="F">F</option>
                            </select>
                        </div>
                    </div>
                    <div class="remove_field_button" align="center">
                        <button type="button" class="btn btn-danger">Supprimer</button>
                    </div>
                </div>
            </div>
            <br></br>
        </div>
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
        var element = $(".element").clone(true);
        var add_button = $(".add_field_button");

        $(add_button).click(function(e){
            e.preventDefault();
            $(element).clone(true).appendTo(wrapper);
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
    });
</script>

<?php
loadJavaScript();
finFichierHTML();
?>

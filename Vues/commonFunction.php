<?php

function enTeteHTML($title, $charset, $css_sheet, $class_body){
	echo "<!doctype html>\n";
	echo "<html lang=\"fr\">\n";
	echo "<head>\n";
	echo "<meta charset=\"$charset\"/>\n";
	foreach($css_sheet as $k => $s){
        echo "<link rel=\"stylesheet\" href=\"".$s."\" />\n";
    }
    echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
	echo "<title>$title</title>\n";
	echo "</head>\n<body class=\"$class_body\" id=\"body-bg\">\n";
}	

function finFichierHTML(){
	echo "</body<\n</html>\n";
}

//fonction permettant de générer la barre d'entêtes du document
function controlePublic(){
    echo '<div>
            <nav class="navbar-fixed-top navbar-inverse" role="navigation">
                <div class="collapse navbar-collapse navbar-exinverse-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="index.php?action=home">
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
                                    <a href="index.php?action=ajoutCursus">Ajouter Cursus</a>
                                </li>
                                <li>
                                    <a href="#">Importer Règlement</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>';
}

//fonction permettant de générer le footer du document
function loadFooter(){
    echo '<footer class="margin-top-20">
            <nav class="navbar-fixed-bottom navbar-inverse">
                <div class="row text-center text-muted">
                    <p>Réalisé par CROISILLE Antoine et GILBERT Valentin. Utilise <a class="liens-footer" href="http://getbootstrap.com/">Bootstrap</a>.
                    </p>
                </div>

                <div class="row text-center text-muted">
                    <p>© 2017<a class="liens-footer" href="https://fr.linkedin.com/in/antoine-croisille-4781b213a"> A. Croisille</a> <a class="liens-footer" href="https://fr.linkedin.com/in/valentin-gilbert-147683139">V.Gilbert</a>, All rights reserved 2017.</p>
                </div>
             </nav>
           </footer>';
}

//Fonction permettant de générer la structure de fin du fichier html
function EndStructureFichierHTML(){
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
}

function loadJavaScript(){
    echo "<script type=\"text/javascript\" src=\"Assets/JQuery/jquery.min.js\"></script>";
    echo "<script type=\"text/javascript\" src=\"Assets/bootstrap/js/bootstrap.min.js\"></script>";
}

function input($type,$class,$id,$name,$value,$placeholder){
    $input = "<input ";
    $input .= "type='$type' ";
    $input .= "class='$class' ";
    if(strlen($id) > 0){
        $input .= "id='$id' ";
    }
    $input .= "name='$name' ";
    if($value != null && strlen($value) > 0){
        $input .= "value='$value' ";
    }
    if(strlen($placeholder) > 0){
        $input .= "placeholder='$placeholder' ";
    }
    $input .= " />";

    return $input;
}

function select($class,$id,$name,$options,$selected){
    $select = " <select ";
    $select .= "class='$class' ";
    if(strlen($id) >0 ){
        $select .= "id='$id' ";
    }
    $select .= "name='$name' ";
    $select .= "> ";
    foreach ($options as $key => $value){
        $select .= "<option ";
        $select .= "value='$value' ";
        if($selected == $value){
            $select .= "selected ";
        }
        $select .= ">";
        $select .= "$key</option> ";
    }
    $select .= "<select>";

    return $select;
}

?>
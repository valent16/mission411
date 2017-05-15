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
	echo "</head>\n<body class=\"$class_body\">\n";
}	

function finFichierHTML(){
	echo "</body<\n</html>\n";
}

function StructureFichierHTML(){
	echo "<div id=\"page-wrapper\">\n";
	echo "<div id=\"header-wrapper\">\n";
	echo "<div id=\"banner\">\n";
	echo "<img src=\"Ressources/banner.jpg\"/>\n";
	echo "</div>\n";
	echo "<div id=\"header\">\n";
	echo "<nav id=\"nav\">\n";
	echo "<ul>\n";
	echo "<li class=\"current\"><a href=\"index.php?action=default\">Accueil</a></li>\n";
	echo "<li>\n";
	echo "<a href=\"#\">Episodes</a>\n";
	echo "<ul>\n";
	echo "<li><a href=\"index.php?action=episode13\">Saison 3 Episode 13</a></li>\n";
	echo "<li><a href=\"index.php?action=episode12\">Saison 3 Episode 12</a></li>\n";
	echo "<li><a href=\"index.php?action=episode11\">Saison 3 Episode 11</a></li>\n";
	echo "<li><a href=\"index.php?action=episode10\">Saison 3 Episode 10</a></li>\n";
	echo "</ul>\n";
	echo "</li>\n";					
	echo "<li>\n";
	echo "<a href=\"#\">Media</a>\n";
	echo "<ul>\n";
	echo "<li><a href=\"#\">Photos</a></li>\n";
	echo "<li><a href=\"#\">Videos</a></li>\n";
	echo "</ul>\n";
	echo "</li>\n";				
	echo "<li>\n";
	echo "<a href=\"index.php?action=affichePersonnage\">Personnages</a>\n";
	echo "</li>\n";
	echo "<li><a href=\"index.php?action=synopsis\">Synopsis</a></li>\n";
	echo "</ul>\n";
	echo "</nav>\n";
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
    echo "<script type=\"text/javascript\" src=\"assets/JQuery/jquery.min.js\"></script>";
    echo "<script type=\"text/javascript\" src=\"assets/bootstrap/js/bootstrap.min.js\"></script>";
}
?>
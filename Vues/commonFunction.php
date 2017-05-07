<?php

function enTeteHTML($title, $charset, $css_sheet, $class_body){
	echo "<!doctype html>\n";
	echo "<html lang=\"fr\">\n";
	echo "<head>\n";
	echo "<meta charset=\"".$charset."\"/>\n";
	echo "<link rel=\"stylesheet\" href=\"".$css_sheet."\" />\n";
	echo "<title>".$title."</title>\n";
	echo "</head>\n<body class=\"".$class_body."\">\n";
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


function ControleUser(){
echo "<div class=\"login\">\n";
	echo "<div class=\"heading\">\n";
		echo "<h2 class=\"h2User\">Gestion du compte</h2>\n";
		echo "<nav id=\"nav2\">\n";
			echo "<ul>\n";
			echo "<li class=\"current\"><a href=\"index.php?action=commentaireUser\">Commentaires</a></li>\n";
			echo "</ul>\n";
		echo "</nav>\n";
		
		echo "<nav id=\"nav2\">\n";
			echo "<ul>\n";
			echo "<li class=\"current\"><a href=\"index.php?action=actuUser\">Actualités</a></li>\n";
			echo "</ul>\n";
		echo "</nav>\n";
		
		echo "<nav id=\"nav2\">\n";
			echo "<ul>\n";
			echo "<li class=\"current\"><a href=\"index.php?action=afficheUser\">Mon Profil</a></li>\n";
			echo "</ul>\n";
		echo "</nav>\n";
	echo "</div>\n";
echo "</div>\n";
}


function ControleAdmin(){
echo "<div class=\"login\">\n";
	echo "<div class=\"heading\">\n";
		echo "<h2 class=\"h2User\">Gestion du site</h2>\n";
		echo "<nav id=\"nav2\">\n";
			echo "<ul>\n";
			echo "<li class=\"current\"><a href=\"index.php?action=commentaireUser\">Commentaires</a></li>\n";
			echo "</ul>\n";
		echo "</nav>\n";
		
		echo "<nav id=\"nav2\">\n";
			echo "<ul>\n";
			echo "<li class=\"current\"><a href=\"index.php?action=actuUser\">Actualités</a></li>\n";
			echo "</ul>\n";
		echo "</nav>\n";
		
		echo "<nav id=\"nav2\">\n";
			echo "<ul>\n";
			echo "<li class=\"current\"><a href=\"index.php?action=personnageAdmin\">Personnages</a></li>\n";
			echo "</ul>\n";
		echo "</nav>\n";
		
		echo "<nav id=\"nav2\">\n";
			echo "<ul>\n";
			echo "<li class=\"current\"><a href=\"index.php?action=afficheUser\">Mon Profil</a></li>\n";
			echo "</ul>\n";
		echo "</nav>\n";
		
		echo "<nav id=\"nav2\">\n";
			echo "<ul>\n";
			echo "<li class=\"current\"><a href=\"index.php?action=afficheUser\">Utilisateurs</a></li>\n";
			echo "</ul>\n";
		echo "</nav>\n";
	echo "</div>\n";
echo "</div>\n";
}

function ConnectedUser(){
	
}

function ConnectedAdmin(){

}

function EndStructureFichierHTML(){
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
}

function LoadJavaScript(){
	echo "<script src=\"Assets/js/jquery.min.js\"></script>\n";
	echo "<script src=\"Assets/js/jquery.dropotron.min.js\"></script>\n";
	echo "<script src=\"Assets/js/skel.min.js\"></script>\n";
	echo "<script src=\"Assets/js/skel-viewport.min.js\"></script>\n";
	echo "<script src=\"Assets/js/util.js\"></script>\n";
	echo "<!--[if lte IE 8]><script src=\"../Assets/js/ie/respond.min.js\"></script><![endif]-->\n";
	echo "<script src=\"Assets/js/main.js\"></script>\n";
}
?>
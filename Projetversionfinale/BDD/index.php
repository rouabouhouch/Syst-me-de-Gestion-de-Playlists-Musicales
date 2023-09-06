<?php
//nom étudiant:BARKA zakaria
//numéro:p2106670

session_start(); // démarre ou reprend une session
ini_set('display_errors', 1); // affiche les erreurs (au cas où)
ini_set('display_startup_errors', 1); // affiche les erreurs (au cas où)
error_reporting(E_ALL); // affiche les erreurs (au cas où)
if(file_exists('../private/config-bd.php'))  // vous n'avez pas besoin des lignes 7 à 9
	require('../private/config-bd.php'); // inclut un fichier de config "privé"
else
	require('inc/config-bd.php'); // vous pouvez inclure directement ce fichier de config (sans le if ... else précédent)
require('modele/modele.php'); // inclut le fichier modele
require('inc/includes.php'); // inclut des constantes et fonctions du site (nom, slogan)
require('inc/routes.php'); // fichiers de routes

$connexion = getConnexionBD(); // connexion à la BD

?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>playlist de zakaria</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<!--haut-->	
	<div class="header">
		<?php include('static/header.php'); ?>
	</div>
<!--principal-->
		<main>
			<?php
			$controleur = 'controleurAccueil'; // par défaut, on charge accueil.php
			$vue = 'vueAccueil'; // par défaut, on charge accueil.php
			if(isset($_GET['page'])) {
				$nomPage = $_GET['page'];
				if(isset($routes[$nomPage])) { // si la page existe dans le tableau des routes, on la charge
					$controleur = $routes[$nomPage]['controleurs'];
					$vue = $routes[$nomPage]['vue'];
				}
			}
			include('controleurs/' . $controleur . '.php');
			include('vue/' . $vue . '.php');
		?>
		</main>
<!--bas-->	
	<?php include('static/footer.php'); ?>
	
    </div>
</body>
</html>
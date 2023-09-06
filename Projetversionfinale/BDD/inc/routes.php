<?php

/*
** Il est possible d'automatiser le routing, notamment en cherchant directement le fichier controleur et le fichier vue.
** ex, pour page=afficher : verification de l'existence des fichiers controleurs/controleurAfficher.php et vues/vueAfficher.php
** Cela impose un nommage strict des fichiers.
*/

$routes = array(
	'ajouter' => array('controleurs' => 'controleurajout', 'vue' => 'vueajout'),
	'gerer'=>array('controleurs' => 'controleurGerer', 'vue' => 'vueGerer'),
	'visualiser' =>array('controleurs' => 'controleurVisualiser', 'vue' => 'vueVisualiser'),
	'ajoutVersion' =>array('controleurs' => 'controleurAjouterVersion', 'vue' => 'vueAjouterVersion'),
	'visualiser' =>array('controleurs' => 'controleurVisualiser', 'vue' => 'vueVisualiser'),
	'Integration' =>array('controleurs' => 'controleurIntegration', 'vue' => 'vueIntegration'),
	'ListeAleatoire' =>array('controleurs' => 'ControleurListeAleatoire', 'vue' => 'VueListeAleatoire')
	
);

?>
<?php
$connexion = getConnexionBD(); // connexion à la BD
$resultas = getInstances($connexion, 'ListeLecture'); //affichage des listes lectures dans la selection


if(isset($_POST['visualiser'])){
    $selected = $_POST['selection'];
    $row = voirIDLecture($connexion,$selected);
    $row2 = voirIDLecture($connexion,$selected);

    $row4 = getInstances($connexion,'VersionC');
    $message = "vous avez choisi $selected";

}

//la partie pour supprimer la chanson

if(isset($_POST['delete'])){
    $selected = $_POST['selection3'];

    $selected2 = $_POST['selectionSupp'];
    $resultatSupression = delete($connexion,$selected,$selected2);
    $messageRes = "le chanson numero $selected2 a été supprimé de la liste $selected";
    $row = $_POST['postId'];

}

?>
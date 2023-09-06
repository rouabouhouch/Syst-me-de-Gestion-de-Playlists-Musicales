<?php
$connexion = getConnexionBD(); // connexion à la BD
$resultas = getInstances($connexion, 'ListeLecture'); //affichage des listes lectures dans la selection






if(isset($_POST['visualiser'])){
    $selected = $_POST['selection'];
    $row = voirIDLecture($connexion,$selected);
    $row2 = voirIDLecture($connexion,$selected);

    $row4 = getInstances($connexion,'Chanson');
    $message = "vous avez choisi $selected";

}

//la partie pour ajouter la chanson
if(isset($_POST['Add'])){
    $idlecture3 = $_POST['selectionLEcture'];
    $chanson = $_POST['selectionAjout'];
    
    $numv= RandVersiondeIDC($connexion, $chanson);
    $quantite= VerifieVersionIfExist($connexion,$idlecture3,$chanson,$numv);
    if ($quantite == 0){
        $res=ajout($connexion,$idlecture3,$chanson,$numv);
       if ($res==true)
       {
        $messageRes2="LA version $numv de la chanson $chanson a été insérée dans la liste lecture $idlecture3"; 
       }
       else{
        $messageRes2="erreur insertions";
       }
    }
    else{
        $messageRes2="LA version $numv de la chanson $chanson existe déja";
  
    }

}



?>
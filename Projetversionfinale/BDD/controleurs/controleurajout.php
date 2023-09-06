<?php 

$IDG = getInstances($connexion, "Groupe");
$IDGenre = getInstances($connexion, "Genre");
$IDchanson = getInstances($connexion, "Chanson");


if(isset($_POST['boutonValider'])) { // formulaire soumis

	$Nomchanson = $_POST['Nomchanson'];
	$datechanson = $_POST['datechanson'];
	$Groupe = $_POST['Groupe'];
    $Genre= $_POST['Genre'];
    
    $groupeexiste=VerifieGroupeExiste($connexion,$Groupe);
    $genrexiste=VerifieGenreExiste($connexion,$Genre);





	if($groupeexiste> 0 && $genrexiste> 0 )
    {
		$message2 = "Ce Groupe Existe et genre existe ";
        $resultat=Insertchanson($connexion,$Nomchanson,$datechanson,$Groupe);
        if ($resultat["res"]== true)
        {
            $ID=$resultat["ID"];
            $message = "votre chanson $Nomchanson a bien été ajoutée ! Elle a pour valeur $ID";
            // on a ajouter la chanson maintenant on ajoute son ID dans le tableau EstDeGenre avec le genre correspendant
          
            $insert=InsertEstDeGenre($connexion,$ID,$Genre);
            if ($insert== true)
            {
                $message3="le genre et la chanson sont mise en relation";
            }
            else
            {
                $message3="Erreur mise en relation de genre et de relation";
            }
            
        }
        else {
            $message = "Erreur lors de l'insertion de la chanson de  $Nomchanson.";
        }
    
        
	}
	else {
		$message = "groupe ou genre existe pas ou il y a plus de 1 groupe avec le meme ID";
	}

}


if(isset($_POST['boutonValider2']))
 { // formulaire soumis

    $IDchansonV= $_POST['chanson'];
    $NumV= GetnewVersionID($connexion);
    $DureeV= $_POST['DureeVersion'];
    $NomfichierV= $_POST['Nomfichier'];
    $datev= $_POST['Dateversion'];
    global $Nomchanson;
    global $insertversion;

   //  On vérifie que la chanson existe 
    $IDchansonexiste= VerifiechansonExiste($connexion,$IDchansonV);

    if ($IDchansonexiste==true)
    {
        $message4="cette chanson existe bien";
        // on récupère le nom de chanson
        $Nomchanson=GetchansonByID($connexion,$IDchansonV);
      
        $message4="cette chanson existe bien $Nomchanson";
     

        // enfin on insère tout dans version
         $insertversionc=InsertVersion($connexion, $Nomchanson,$NumV,$DureeV,$NomfichierV, $datev, $IDchansonV);
   


        if (isset($insertversionc))
        {
            if ($insertversionc==true)
            {
                $message5="une nouvelle version de la chanson $Nomchanson a été ajoutée";
            }
            else
            {   
                $message5="Erreur lors de l'insertion de la version de c $Nomchanson ";
            }
    
        }
        else
        {
            $message5="Insert version not set so failure of query ";

        }
 
    
    }


}
?>
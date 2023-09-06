<?php
	$top5G = top5Genre($connexion);
    $rand5 = randMusique($connexion);




    $nb = countInstances($connexion, "EstDeGenre");
    if($nb <= 0)
        $messageGenres = "Aucune instance n'a été trouvée dans la base de données !";
    else
        $messageGenres = "Actuellement $nb instances dans EstDeGenre .";
    
    $nb = countInstances($connexion, "Groupe");
    if($nb <= 0)
        $messageGroupes = "Aucune instance n'a été trouvée dans la base de données !";
    else
        $messageGroupes = "Actuellement $nb instances dans Groupe.";


?>


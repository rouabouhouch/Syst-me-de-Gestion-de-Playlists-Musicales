<?php
$IDGenre = getInstances($connexion, "Genre");

if(isset($_POST['boutonValider'])) 
{ // formulaire soumis
//On récupère tous les valeurs soumis
$DureePlaylist= $_POST['DureePlaylist'];
$Genre= $_POST['Genre'];
$Preference= $_POST['Preference'];
$ListName= $_POST['ListName'];
// on convertit le durée de minutes en secondes
$DureePlaylist=convertminutestoseconds($DureePlaylist);


$finallistName;
$ID;
$listcontents;
//on génère la playlist

                  if ($ListName==NULL) // utilisateur a entrée une valeur pour le nom de la liste
                  {
                     // utilisateur a pas choisit un nom de liste
                     //on le génère
                     $myRandomString = generateRandomString(5);
                     
                     $listeinserer=InsertListe($connexion,$myRandomString);
                     if ($listeinserer["res"]==true)
                     {  $ID=$listeinserer["ID"];
                        $message="la liste ".$myRandomString ."a été insérée elle a pour ID  $ID";
                     }
                     else
                     {
                        $message="Erreur,la liste $myRandomString Non insérée ";
                     }

                     $finallistName=$myRandomString; //pour selection de nom liste
                  }
                  else
                  {
                  $listeinserer=InsertListe($connexion,$ListName);
                  if ($listeinserer["res"]==true)
                  {  $ID=$listeinserer["ID"];
                     $message="la liste $ListName a été insérée elle a pour  $ID ";
                  }
                  else
                  {
                     
                     $message="Erreur,la liste $ListName Non insérée";
                  }
                  $finallistName=$ListName;

                  }

// une fois on a généré les liste on va gérer les différents cas selon la selection

               // cas par defaut: aucune préférence et aucun genre == les version de chanson random

                     if ($Preference=="null" && $Genre== "null")
                     {      
                        $list=GenerateDefault($connexion,$DureePlaylist,$finallistName,$ID);   
                           //get the contents of the list to show them on the page

                           $listcontents=GetcontentsByListID($connexion,$ID);

                           $message2="aucun genre et aucune preference la liste $finallistName a pour durée $list";

                     }
               // cas avec genre et aucune preference 50%= liste random de ce genre là 30% liste random pas de ce genre là
               //cas genre avec chanson plus joués
               //cas genre avec chanson
               if ($Preference==="null" && $Genre!== "null")
                        {
                        
                        $list=GeneratelisteGenre($connexion,$DureePlaylist,$Genre,$ID);


                        $listcontents=GetListcontentsGenreSelected($connexion,$ID,$Genre);
                        $notofgenrecontents=GetListcontentsGenreSelectedNot($connexion,$ID,$Genre);

                        $message4="Genre $Genre et aucune preference la liste $finallistName a pour durée $list";
                           
                        }
                // cas avec genre et chanson les plus jouée 70%= liste  de ce genre là order by les plus joués 30% liste  pas de ce genre là les plus joués
               //cas genre avec chanson plus joués
               //cas genre avec chanson
               if ($Preference==="playcount" && $Genre!== "null")
               {
                        $list= GeneratelisteGenrecount($connexion,$DureePlaylist,$Genre,$ID,"playcount");
                        $listcontents=GetListcontentsGenreSelectedPreference($connexion,$ID,$Genre,"playcount");
                        $notofgenrecontents= GetListcontentsGenreSelectedNotcount($connexion,$ID,$Genre,"playcount");


                        $message3="Genre $Genre et playcount la liste $finallistName a pour durée $list";

               }
                                                  
   // cas avec genre et chanson les plus jouée 70%= liste  de ce genre là order by les plus joués 30% liste  pas de ce genre là les plus joués
               //cas genre avec chanson plus joués
               //cas genre avec chanson
               if ($Preference==="skipcount" && $Genre!== "null")
               {
                        $list= GeneratelisteGenrecount($connexion,$DureePlaylist,$Genre,$ID,"skipcount");
                        $listcontents=GetListcontentsGenreSelectedPreference($connexion,$ID,$Genre,"skipcount");
                        $notofgenrecontents= GetListcontentsGenreSelectedNotcount($connexion,$ID,$Genre,"skipcount");


                        $message5="Genre $Genre et skipcount la liste $finallistName a pour durée $list";

               }
                            
               if ($Preference==="lastplayed" && $Genre!== "null")
               {
                        $list= GeneratelisteGenrecount($connexion,$DureePlaylist,$Genre,$ID,"lastplayed");
                        $listcontents=GetListcontentsGenreSelectedPreference($connexion,$ID,$Genre,"lastplayed");
                        $notofgenrecontents= GetListcontentsGenreSelectedNotcount($connexion,$ID,$Genre,"lastplayed");


                        $message6="Genre $Genre et lastplayed la liste $finallistName a pour durée $list";

               }
               // cas aucun genre et chansons plus sautés
               if (($Preference==="playcount" || $Preference==="skipcount"||  $Preference==="lastplayed")  && $Genre=== "null"){
                 $list= Preferencesansgenre($connexion,$DureePlaylist,$ID,$Preference);
                 $listcontents=GetListcontentsGenreSelectedPreferencenogenre($connexion,$ID,$Preference);
                 $message7="aucun genre et playcount la liste $finallistName a pour durée $list";


               }

}

?>
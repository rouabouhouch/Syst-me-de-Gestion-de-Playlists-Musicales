<?php

// connexion à la BD, retourne un lien de connexion
function getConnexionBD() {
	$connexion = mysqli_connect(SERVEUR, UTILISATRICE, MOTDEPASSE, BDD);
	if (mysqli_connect_errno()) {
	    printf("Échec de la connexion : %s\n", mysqli_connect_error());
	    exit();
	}
	return $connexion;
}

// déconnexion de la BD
function deconnectBD($connexion) {
	mysqli_close($connexion);
}

// nombre d'instances d'une table $nomTable
function countInstances($connexion, $nomTable) {
	$requete = "SELECT COUNT(*) AS nb FROM $nomTable";
	$res = mysqli_query($connexion, $requete);
	if($res != FALSE) {
		$row = mysqli_fetch_assoc($res);
		return $row['nb'];
	}
	return -1;  // valeur négative si erreur de requête (ex, $nomTable contient une valeur qui n'est pas une table)
}

// retourne les instances d'une table $nomTable
function getInstances($connexion, $nomTable) {
	$requete = "SELECT * FROM $nomTable";
	$res = mysqli_query($connexion, $requete); //effectue une requete sur base donnée
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC); //recupere tout les lignes de res sous forme tableau
	return $instances;
}


//---------------------------------top 5 dans page d'accueil-----------------------------------------------------------------------------

//---------------------------------top 5 dans page d'accueil-----------------------------------------------------------------------------
function top5Genre($connexion){
	$requete = "select *,COUNT(*) as nb FROM EstDeGenre GROUP BY IDGenre ORDER BY nb DESC LIMIT 5;";
	$res=mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}


function randMusique($connexion){
	$requete = "SELECT IDC FROM Chanson ORDER BY rand() LIMIT 5;";
	$res=mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

///-----------------------------------------------------cette partie pour la fonctionalité 1 insertion de chanson	----------------------------------------------------------------
//insertion de chanson dans la BDD
//retourne un resultat sous forme Vrai faut et l'ID auto increment de la chanson qu'on vien d'insérer avec un array


// insère une chanson

function Insertchanson($connexion, $titreC, $dateC, $IDG) {
	$titreC = mysqli_real_escape_string($connexion, $titreC);
	$dateC = date('Y-m-d', strtotime($dateC));
	$req = "INSERT INTO Chanson(TitreC, Datecreation, IDG) VALUES (?,?,?)";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "ssi", $titreC,$dateC,$IDG) ;
	$res=mysqli_stmt_execute($stmt) ;
	$ID=mysqli_insert_id($connexion);
	return array("res"=>$res,"ID"=>$ID);
}

// insère une version

function InsertVersion($connexion, $titreC,$NumV,$dureeV,$NomfichierV, $datev, $IDCV) 
{
	$datev = date('Y-m-d', strtotime($datev));
	$NomfichierV = mysqli_real_escape_string($connexion, $NomfichierV);

	$req = "INSERT INTO VersionC( NumV, Durée,NomdeFichierVersion,DateChanson,IDC) VALUES (?,?,?,?,?)";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "iissi", $NumV,$dureeV,$NomfichierV, $datev, $IDCV) ;
	$res=mysqli_stmt_execute($stmt) ;
	return $res ;
}
// On verifie que le groupe existe
function VerifieGroupeExiste($connexion, $IDG) {
	$req = "SELECT COUNT(*) FROM Groupe AS Number WHERE IDG = ?";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "i", $IDG) ;
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
    $quantity = mysqli_stmt_num_rows($stmt) ;
	return $quantity;
}

// On verifie que le genre existe
function VerifieGenreExiste($connexion, $IDGenre) {
	$req = "SELECT COUNT(*) FROM Genre AS Number WHERE IDGenre = ?";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "i", $IDGenre) ;
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
    $quantity = mysqli_stmt_num_rows($stmt) ;
	return $quantity;
}


// On verifie que la chanson existe
function VerifiechansonExiste($connexion, $IDC) {
	$req = "SELECT COUNT(*) FROM Chanson AS Number WHERE IDC = ?";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "i", $IDC) ;
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
    $quantity = mysqli_stmt_num_rows($stmt) ;
	return $quantity;
}

// on effectue la relation entre le genre et la chanson

function InsertEstDeGenre($connexion, $IDC, $IDGenre) {

	$req = "INSERT INTO EstDeGenre(IDC, IDGenre) VALUES (?,?)";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "ii", $IDC,$IDGenre) ;

	$res = 	mysqli_stmt_execute($stmt);

	return $res;
}

//récupère une chanson par son ID


function GetchansonByID($connexion, $IDC) {
	$req = "SELECT TitreC FROM Chanson WHERE IDC = ?";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "i", $IDC) ;
	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	foreach($res3 as $res3)
	{
		$Nomchanson=$res3["TitreC"];
	}
	return $Nomchanson;

}

//fonction qui récupère le max ID version et l'incremente


function GetnewVersionID($connexion)
 {
	$req = "SELECT Max(NumV) as NumV FROM VersionC";
	$stmt = mysqli_prepare($connexion, $req);
	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	foreach($res3 as $res3)
	{
		$Numversion2=$res3["NumV"];
	}
	return $Numversion2+1;

}

//Fonctionalité numéro 3


function convertminutestoseconds($minutes)
{
    return $minutes*60;
}



function InsertListe($connexion, $Nomliste) 
{	
	$date= date("Y-m-d H:i:s");
	$date = date('Y-m-d', strtotime($date));
	$Nomliste = mysqli_real_escape_string($connexion, $Nomliste);

	$req = "INSERT INTO ListeLecture(Titreliste	,DateDeListe) VALUES (?,?)";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "ss", $Nomliste,$date) ;
	$res=mysqli_stmt_execute($stmt) ;
	$ID=mysqli_insert_id($connexion);
	return array("res"=>$res,"ID"=>$ID);
}
//génère un nom de liste lecture aleatoire
function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters); //longueur chaine
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// mise en relation entre chanson et liste de lecture

function InsertInclut($connexion, $IDC,$NumV,$IDLecture) 
{	
	
	$req = "INSERT INTO Inclut(IDC,NumV	,IDLecture) VALUES (?,?,?)";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "iii",$IDC,$NumV,$IDLecture) ;
	$res=mysqli_stmt_execute($stmt) ;
	return $res ;
}

//selectionne des valeur random de  Version

function Randomversio($connexion) {
	$req = "SELECT * FROM `VersionC` order BY rand()";
	$stmt = mysqli_prepare($connexion, $req);
	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	return $res3;

}
function Randomversionbygenre($connexion,$IDGenre) {
	$req = "SELECT * FROM
	VersionC NATURAL JOIN Chanson NATURAL JOIN EstDeGenre
	WHERE IDGenre=?
	order BY rand() ";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "i",$IDGenre) ;

	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	return $res3;

}
// avec pref
function Randomversionbygenrecount($connexion,$IDGenre,$count) {
	$req = "SELECT * FROM
	VersionC NATURAL JOIN Chanson NATURAL JOIN EstDeGenre NATURAL JOIN Apourproprietésupplémentaire
	WHERE IDGenre=? And NomP=?
	order BY ValeurdeProprieté desc ";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "is",$IDGenre,$count) ;

	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	return $res3;

}
function Randomversionwithoutgenrecount($connexion,$IDGenre,$count) {
	$req = "SELECT DISTINCT IDC,NumV,Durée FROM
	VersionC NATURAL JOIN Chanson NATURAL JOIN EstDeGenre Natural JOIN Apourproprietésupplémentaire
	WHERE IDGenre !=? and NomP=?
	order BY ValeurdeProprieté DESC
    LIMIT 200";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "is",$IDGenre,$count) ;

	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	return $res3;

}
function Randomversionwithoutgenre($connexion,$IDGenre) {
	$req = "SELECT * FROM
	VersionC NATURAL JOIN Chanson NATURAL JOIN EstDeGenre
	WHERE IDGenre !=?
	order BY rand() 
    LIMIT 200";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "i",$IDGenre) ;

	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	return $res3;

}


//generation de liste par defaut
Function GenerateDefault($connexion,$DureePlaylist,$finallistName,$ID)
{
	$dureeaccumelée=0;
	$res3=Randomversio($connexion);
	foreach ($res3 as $res3)
	{
		if ($dureeaccumelée>$DureePlaylist-60)
		{
			break;
		}
		InsertInclut($connexion,$res3["IDC"],$res3["NumV"],$ID);
		$dureeaccumelée=$dureeaccumelée+$res3["Durée"];

	}
	$dureefinale=gmdate("H:i:s", $dureeaccumelée);
	return $dureefinale;

}
// les chansons de la liste
function GetcontentsByListID($connexion,$listID)
{
  	$req = "SELECT *
	  FROM Inclut as I INNER JOIN VersionC as V INNER JOIN Chanson as C
	  ON I.IDC=V.IDC AND I.NumV=V.NumV and V.IDC=C.IDC
	  WHERE I.IDLecture=?";

	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "i", $listID) ;
	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	return $res3;
}

function GetListcontentsGenreSelected($connexion,$listID,$IDGenre)
{
	$req = "SELECT * FROM Inclut Natural Join VersionC NATURAL JOIN Chanson NATURAL JOIN EstDeGenre
	WHERE IDLecture=? AND IDGenre=?;";

  $stmt = mysqli_prepare($connexion, $req);
  $strmt2=mysqli_stmt_bind_param($stmt, "ii", $listID,$IDGenre) ;
  $res=mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  return $res3;
}

function GetListcontentsGenreSelectedPreference($connexion,$listID,$IDGenre,$count)
{
	$req = "SELECT * FROM Inclut Natural Join VersionC NATURAL JOIN Chanson NATURAL JOIN EstDeGenre NATURAL JOIN Apourproprietésupplémentaire
	WHERE IDLecture=? AND IDGenre=? And NomP=?
	order by ValeurdeProprieté	DESC ;";

  $stmt = mysqli_prepare($connexion, $req);
  $strmt2=mysqli_stmt_bind_param($stmt, "iis", $listID,$IDGenre,$count) ;
  $res=mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  return $res3;
}
function GetListcontentsGenreSelectedNotcount($connexion,$listID,$IDGenre,$count)
{
	$req = "SELECT *
    FROM (SELECT distinct IDC,NumV FROM Inclut Natural Join VersionC NATURAL JOIN Chanson NATURAL JOIN EstDeGenre
    WHERE IDLecture=? AND IDGenre!=?
    EXCEPT
    SELECT  distinct IDC,NumV FROM Inclut Natural Join VersionC NATURAL JOIN Chanson NATURAL JOIN EstDeGenre
    WHERE IDLecture=? AND IDGenre=? ) as table1 NATURAL JOIN VersionC NATURAL JOIN Chanson NATURAL JOIN Apourproprietésupplémentaire
	WHERE NomP=?";

  $stmt = mysqli_prepare($connexion, $req);
  $strmt2=mysqli_stmt_bind_param($stmt, "iiiis", $listID,$IDGenre, $listID,$IDGenre,$count) ;
  $res=mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  return $res3;
}

function GetListcontentsGenreSelectedNot($connexion,$listID,$IDGenre)
{
	$req = "SELECT *
    FROM (SELECT distinct IDC,NumV FROM Inclut Natural Join VersionC NATURAL JOIN Chanson NATURAL JOIN EstDeGenre
    WHERE IDLecture=? AND IDGenre!=?
    EXCEPT
    SELECT  distinct IDC,NumV FROM Inclut Natural Join VersionC NATURAL JOIN Chanson NATURAL JOIN EstDeGenre
    WHERE IDLecture=? AND IDGenre=? ) as table1 NATURAL JOIN VersionC NATURAL JOIN Chanson";

		$stmt = mysqli_prepare($connexion, $req);
		$strmt2=mysqli_stmt_bind_param($stmt, "iiii", $listID,$IDGenre, $listID,$IDGenre) ;
		$res=mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		return $res3;
}
//generate a version for each song button
function generateVersionsforsongs($connexion)
{	$table="Chanson";
	$song=getInstances($connexion,$table);
	foreach( $song as $song)
	{
		$NumV=GetnewVersionID($connexion);
		$titreC=$song["TitreC"];
		$dureeV=200;
		$NomfichierV=generateRandomString(5);
		$date= date("Y-m-d H:i:s");
		$date = date('Y-m-d', strtotime($date));
		$IDCV=$song["IDC"];
		InsertVersion($connexion, $titreC,$NumV,$dureeV,$NomfichierV, $date, $IDCV) ;

	}
}

//cas 2

Function GeneratelisteGenre($connexion,$DureePlaylist,$IDGenre,$ID)
{
	$Majoritéduree=0.51*$DureePlaylist;
	$res3=Randomversionbygenre($connexion,$IDGenre);
	$dureeaccumelée=0;
	foreach ($res3 as $res3)
	{
		if ($dureeaccumelée>$Majoritéduree)
		{
			break;
		}
		InsertInclut($connexion,$res3["IDC"],$res3["NumV"],$ID);
		$dureeaccumelée=$dureeaccumelée+$res3["Durée"];

	}

	//
	$res4=Randomversionwithoutgenre($connexion,$IDGenre);
	foreach ($res4 as $res4)
	{
		if ($dureeaccumelée>$DureePlaylist-60)
		{
			break;
		}
		InsertInclut($connexion,$res4["IDC"],$res4["NumV"],$ID);
		$dureeaccumelée=$dureeaccumelée+$res4["Durée"];

	}
	$dureefinale=gmdate("H:i:s", $dureeaccumelée);
	return $dureefinale;

}


Function GeneratelisteGenrecount($connexion,$DureePlaylist,$IDGenre,$ID,$count)
{
	$Majoritéduree=0.51*$DureePlaylist;
	$res3=Randomversionbygenrecount($connexion,$IDGenre,$count);
	$dureeaccumelée=0;
	foreach ($res3 as $res3)
	{
		if ($dureeaccumelée>$Majoritéduree-60)
		{
			break;
		}
		InsertInclut($connexion,$res3["IDC"],$res3["NumV"],$ID);
		$dureeaccumelée=$dureeaccumelée+$res3["Durée"];

	}

	//
	$res4=Randomversionwithoutgenrecount($connexion,$IDGenre,$count);
	foreach ($res4 as $res4)
	{
		if ($dureeaccumelée>$DureePlaylist-60)
		{
			break;
		}
		InsertInclut($connexion,$res4["IDC"],$res4["NumV"],$ID);
		$dureeaccumelée=$dureeaccumelée+$res4["Durée"];

	}
	$dureefinale=gmdate("H:i:s", $dureeaccumelée);
	return $dureefinale;

}
//requete sql pour preference et pas de genre
function randomPreferencesansgenre($connexion,$count)
{	$req = "SELECT DISTINCT IDC ,NumV,Durée FROM
	VersionC NATURAL JOIN Chanson NATURAL JOIN EstDeGenre NATURAL JOIN Apourproprietésupplémentaire
	WHERE  NomP=?
	order BY ValeurdeProprieté desc 
	limit 500";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "s",$count) ;

	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	return $res3;
}
// pref sans genre

function Preferencesansgenre($connexion,$DureePlaylist,$ID,$count)
{
	$dureeaccumelée=0;

	$res4=randomPreferencesansgenre($connexion,$count);
	foreach ($res4 as $res4)
	{
		if ($dureeaccumelée>$DureePlaylist-60)
		{
			break;
		}
		InsertInclut($connexion,$res4["IDC"],$res4["NumV"],$ID);
		$dureeaccumelée=$dureeaccumelée+$res4["Durée"];

	}

		$dureefinale=gmdate("H:i:s", $dureeaccumelée);
		return $dureefinale;


}


function GetListcontentsGenreSelectedPreferencenogenre($connexion,$listID,$count)
{
	$req = "SELECT * FROM Inclut Natural Join VersionC NATURAL JOIN Chanson  NATURAL JOIN Apourproprietésupplémentaire
	WHERE IDLecture=? And NomP=?
	order by ValeurdeProprieté	DESC ;";

  $stmt = mysqli_prepare($connexion, $req);
  $strmt2=mysqli_stmt_bind_param($stmt, "is", $listID,$count) ;
  $res=mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  return $res3;
}
//-------------------- population bdd

function populateproperties($connexion,$IDC,$NumV,$propertieName,$value)
{
	
	$req = "INSERT INTO  Apourproprietésupplémentaire(IDC,NumV,NomP,ValeurdeProprieté)
	VALUES (?,?,?,?)";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "iisi",$IDC,$NumV,$propertieName,$value) ;
	$res=mysqli_stmt_execute($stmt) ;
	return $res ;	
}
//---------------------------------------------------------
//...........................................partie 

function differenceL($connexion,$IDlecture1,$IDLecture2)
{
    

        $req = "SELECT *FROM Inclut NATURAL JOIN VersionC
        WHERE IDLecture= ?
        Except
 		SELECT * FROM Inclut NATURAL JOIN VersionC
        WHERE IDLecture=?";

        $stmt = mysqli_prepare($connexion, $req);
    
        $strmt2=mysqli_stmt_bind_param($stmt, "ii", $IDlecture1,$IDLecture2) ;
    
        mysqli_stmt_execute($stmt);
    
        $res=mysqli_stmt_get_result($stmt);
        $res2 = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $res2;
    
    }

function compare2lists($connexion,$IDLecture1,$IDlecture2){
	$nbchansonliste1=nombretotalechanson($connexion,$IDLecture1);
	$nbchansonliste2=nombretotalechanson($connexion,$IDlecture2);
	$differenceL=differenceL($connexion,$IDLecture1,$IDlecture2);
	$compteurdifference=0; 
	// On compare les deux chanson
	if($nbchansonliste1>$nbchansonliste2){
		$totale=$nbchansonliste1;
	} 
	else{
	$totale=$nbchansonliste2;
	}
	foreach ($differenceL as $differenceL)
	{
		$compteurdifference=$compteurdifference+1;
	}

	$compteurressemblence=$totale-$compteurdifference;
	if ($totale>0)
	{
		return ($compteurressemblence/$totale)*100;
	}
	else
	{
		return 0;
	}

}

//-----------------------------------------------------fonctionalité 2


//fonction selection depuis bdd songs de chansons
function Getsongsfromdataset($connexion) {
	$req = "SELECT Distinct year,title FROM dataset.songs2000 ";
	$stmt = mysqli_prepare($connexion, $req);
	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $res3;

}

function getIDCwithnameyear($connexion,$title,$year) {
	$req = "SELECT MAX(IDC) as IDC FROM Chanson WHERE TitreC=? AND DateCreation=? ";
	$stmt = mysqli_prepare($connexion, $req);
	$strmt2=mysqli_stmt_bind_param($stmt, "ss",$title,$year) ;

	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	
	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$IDC;
	foreach($res3 as $res3)
	{
		$IDC=$res3["IDC"];
	}
	return $IDC;
}

//fonction selection depuis bdd songs de versions
function Getversionsfromdataset($connexion) {
	$req = "SELECT Distinct year,title,length,filename FROM dataset.songs2000 ";
	$stmt = mysqli_prepare($connexion, $req);
	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $res3;

}

//retourne groupe random;

function getrandomgroup($connexion) {
	$req = "SELECT IDG FROM Groupe ORDER BY RAND() LIMIT 1 ";
	$stmt = mysqli_prepare($connexion, $req);
	$res=mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$res3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$MAX;
	foreach($res3 as $res3)
	{
		$MAX=$res3["IDG"];
	}
	return $MAX;

}

//fonction transformation et insertion de chansons
function integratesongs($connexion)
{	
	
	$insert;
	$res3=Getsongsfromdataset($connexion);
	foreach($res3 as $res3)
	{
	
		$year=strval($res3["year"])."-03-21";
		$newDate = date("d-m-Y", strtotime($year));
		$titre=$res3["title"];
		$groupe=getrandomgroup($connexion);
		$insert=Insertchanson($connexion, $titre, $newDate, $groupe);

	}

	$res4=Getversionsfromdataset($connexion);
	foreach($res4 as $res4)
	{
	
		$year=strval($res4["year"])."-03-21";
		$newDate = date("d-m-Y", strtotime($year));
		$titre=$res4["title"];
		$duration=$res4["length"];
		$file=$res4["filename"];
		$IDC=getIDCwithnameyear($connexion,$titre,$newDate);
		$NumV= GetnewVersionID($connexion);
		$insert=InsertVersion($connexion, $titre,$NumV,$duration,$file, $newDate, $IDC) ;

	}

	return $insert;
}




// ----------- partie fonctionnalité 4 gere liste de lecture

function sumTime($connexion, $IDlecture){
	$dureetotale=0;

	$resultat=leschansondelistelecture($connexion,$IDlecture);
	foreach ($resultat as $resultat) 
	{
		$dureetotale=$dureetotale+$resultat["Durée"];
	}
	$dureefinale=gmdate("H:i:s", $dureetotale);
	return $dureefinale;}

function leschansondelistelecture($connexion,$IDlecture)
{
	

		$req = "SELECT Durée FROM Inclut NATURAL JOIN VersionC
		WHERE IDLecture=?";

		$stmt = mysqli_prepare($connexion, $req);
	
		$strmt2=mysqli_stmt_bind_param($stmt, "i", $IDlecture) ;
	
		mysqli_stmt_execute($stmt);
	
		$res=mysqli_stmt_get_result($stmt);
		$res2 = mysqli_fetch_all($res, MYSQLI_ASSOC);
		return $res2;
	
	}





function getInstancesListeLecture($connexion,$nomTable ) {
	$requete = "SELECT * FROM ListeLecture";
	$res = mysqli_query($connexion, $requete); //effectue une requete sur base donnée
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC); //recupere tout les lignes de res sous forme tableau
	return $instances;
}


function nombretotalechanson($connexion,$IDlecture){
	$req =
	"SELECT COUNT(IDLecture) as nb
	FROM Inclut
	WHERE IDLecture=?;";

	$stmt =mysqli_prepare($connexion,$req);


	$strmt2=mysqli_stmt_bind_param($stmt,"i", $IDlecture) ;

	mysqli_stmt_execute($stmt);
	$res=mysqli_stmt_get_result($stmt);

	$res2 = mysqli_fetch_all($res, MYSQLI_ASSOC);
	$nb;
	foreach ($res2 as $res2){
		$nb=$res2["nb"];	
	}
	return $nb;

}


function voirIDLecture($connexion,$selected){
	$requete = "SELECT  * FROM Inclut I NATURAL JOIN Chanson as C NATURAL LEFT JOIN VersionC WHERE IDLecture =$selected;";
	$res=mysqli_query($connexion, $requete);
	$row = mysqli_fetch_all($res,MYSQLI_ASSOC);
	return $row;
}

function delete($connexion,$selected,$selected2){
	$requete = "DELETE FROM Inclut WHERE IDLecture =$selected AND IDC =$selected2;";
	$res=mysqli_query($connexion, $requete);
	return $res;
}



function ajout($connexion,$idlecture3,$IDC,$NumV){
	$requete = "INSERT INTO Inclut (IDLecture, IDC , NumV) VALUES ( $idlecture3 , $IDC , $NumV )";
	$res=mysqli_query($connexion, $requete);
	return $res;
}


function VerifieVersionIfExist($connexion, $idlecture3,$IDC,$NumV) {
	$requete = "SELECT COUNT(*) FROM Inclut AS Number WHERE IDLecture = '". $idlecture3 . "' AND IDC  = '". $IDC . "' AND NumV  = '". $NumV . "'";
	$result = mysqli_query($connexion, $requete);
	$result = $result->fetch_array(); //mets res dans un tab
    $quantity = intval($result[0]); //compte nb de ligne dans tab
	return $quantity;
}


function RandVersiondeIDC($connexion, $IDC){
	$requete = "SELECT NumV FROM VersionC WHERE IDC =  $IDC ORDER BY rand() LIMIT 1 ;";
	$res=mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	$NumV;
	foreach ($instances as $instances)
	{
		$NumV=$instances["NumV"];
	}
	return $NumV;
}

?>

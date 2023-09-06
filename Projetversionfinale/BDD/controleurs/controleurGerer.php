<?php 
$connexion = getConnexionBD(); // connexion à la BD

$resultas = getInstances($connexion, 'ListeLecture');
$resultas2 = getInstances($connexion, 'ListeLecture');
$resultas3 = getInstances($connexion, 'ListeLecture');


if(isset($_POST['Valid'])) {
	$nomTable	= mysqli_real_escape_string($connexion, $_POST['selection']);
}

if(isset($_POST['Ressemblance'])) {
	$IDliste1=$_POST['selection1'];
	$IDliste2=$_POST['selection2'];

	$compare=compare2lists($connexion,$IDliste1,$IDliste2);
	$message4="les listes on un degré rassemblence de $compare %";
}
	//$voir = visualiser($connexion);

?>
<main>
<h1> Comparez deux listes de lecture! </h1>

<form
method ="POST" action="#">  <!-- Parameters are placed inside
 body -->

    <label
for="IDLecture">chosissez une liste de lecture</label>

    <select name="selection1">

    <?php foreach($resultas2 as $resultas2) { ?>
	<option value='<?= $resultas2['IDLecture'] ?>'><?= $resultas2['Titreliste']; ?></option>
    <?php } ?>
    
    </select>
    <br></br>
    <select name="selection2">

    <?php foreach($resultas3 as $resultas3) { ?>
	<option value='<?= $resultas3['IDLecture'] ?>'> <?= $resultas3['Titreliste']; ?>  </option>
    <?php } ?>
    
    </select>

    <br></br>

    <input type="submit"name="Ressemblance"value="Ressemblance">

</form>


<?php if(isset($message4)) { ?>
            <p style="background-color: yellow;"><?= $message4 ?></p>
            <?php echo "$compare"?>
        <?php } ?>  



<table id="results">
    <h2>afficher les listes de lecture stockées en base (titre, durée totale, nombre de chansons) </h2>
    <tbody>
		<tr class="titreTab">
			<th>les titres </th>
			<th>la durée totale </th>
            <th>nombre de chanson</th>
		</tr>
        <?php foreach($resultas as $resultas) { ?>
            <td><?=$resultas['Titreliste']?></td>
            <?php  $idLecture = $resultas["IDLecture"];
            ?>
            <td><?=  sumTime($connexion,$idLecture);?></td>
            <td><?=  nombretotalechanson($connexion,$idLecture);?></td>
        </tr>
        <?php } ?>

 </tbody>
 </table>       
</table> 

</main>





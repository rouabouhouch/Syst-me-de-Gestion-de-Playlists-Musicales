<main>
<h1> Fonctionalité 4 partie ajout de version dans une liste</h1>
<?php

if(isset($message)){
   ?>
   <br>choisissez la chanson que vous souhaitez ajouter à la liste de lecture</br>
   <form method = "POST" action="#">
   <label for="selectionAjout">les identifiants des chansons qu'on veut ajouter</label>

   <select name="selectionAjout">

   <?php
       foreach($row4 as $row4) { ?>
           <option value='<?= $row4['IDC']?>'><?= strval($row4['IDC'])?></option>
   <?php } ?>
   </select>
       
        <label for="selection3">l'identifiant de liste de lecture</label>

       <select name="selectionLEcture">

       <option value='<?= $selected ;?>'><?= $selected  ?></option>
       </select>
       <input  type="submit" name="Add" value="ajoutez!">

   </form>

   
<?php } ?>



<?php if(isset($messageRes2)) { ?>
   <p style="background-color: yellow;"><?= $messageRes2 ?></p>
<?php } ?>

<form method = "POST" action="#">  <!-- Parameters are placed inside body -->
    <label for="IDLecture">chosissez une liste de lecture</label>
    <select name="selection">
    <?php 
         foreach($resultas as $res) { ?>
        <option value='<?= $res['IDLecture'];?>'><?= strval($res['Titreliste']).' '.$res['IDLecture'] ?>       </option>
    <?php } ?>
    <input type="submit" name="visualiser" value="Afficher">
</form>

</main>


        




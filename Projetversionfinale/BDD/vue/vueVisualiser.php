<?php
if(isset($message)){
    
    //if(!empty($_POST['selection'])) {
        
?>
<article>
    <h2>Les chansons de la liste</h2>
    <table id ='results'>
        <tbody>
                <tr>
                    <th>IDC</th>
                    <th>IDLecture</th>
                    <th>TitreC</th>
                    <th>Datecreation</th>
                    <th>numV</th>
                </tr>
                    <?php
                        foreach($row as $row){ ?>
                        <tr>
                            <td><?= $row['IDC'];?></td>
                            <td><?= $row['IDLecture'];?></td>
                            <td><?= $row['TitreC'];?></td>
                            <td><?= $row['Datecreation'];?></td>
                            <td><?= $row['NumV'];?></td> 
                        </tr>
                    <?php
                        } ?>
                
        </tbody>
    </table>

    <!------------------  partie supprimer ---------------------->

    <?php if(isset($message)){ ?>
        <h2> choisissez l'ID chanson que vous souhaitez supprimer</h2>
    <form method = "POST" action="#">
        <label for="selectionSupp">les identifiants des chansons</label>
        <select name="selectionSupp">
    <?php 
        foreach($row2 as $row2) { ?>
        <option value='<?= $row2['IDC'];?>'><?= strval($row2['IDC']) ?></option>
    <?php } ?>
        </select>
        <label for="selection3">l'identifiant de liste de lecture</label>

        <select name="selection3">
    

        <option value='<?= $selected ;?>'><?= $selected  ?></option>
        </select>
        <input type="hidden" id="postId" name="postId" value="<?= $row ;?>"/>
    <input type="submit" name="delete" value="supprimer">
    </form>
    
<?php
}
        
?>
<?php
}
     ?>

<?php if(isset($messageRes)){ ?>
        <p style="backgroud-color: yellow;"><?= $messageRes ?></p>
    <?php
    } ?>
</article>




<h1> affichage data </h1>
<form method = "POST" action="#">  <!-- Parameters are placed inside body -->
    <label for="IDLecture">chosissez une liste de lecture</label>
    <select name="selection">
    <?php 
         foreach($resultas as $res) { ?>
        <option value='<?= $res['IDLecture'];?>'><?= strval($res['Titreliste']).' '.$res['IDLecture'] ?>       </option>
    <?php } ?>
    <input type="submit" name="visualiser" value="Afficher">
</form>
<?php


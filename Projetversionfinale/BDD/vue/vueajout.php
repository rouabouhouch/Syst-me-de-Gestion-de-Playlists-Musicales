<div id="container2">
<div id="item">

<h2>patie 1/2: Ajout d'une chanson</h2>
<div class="container">

<form method="post" action="#">
	
    <label for="Nomchanson">Nom de chanson </label>
	<input type="text" name="Nomchanson" id="Nomchanson" placeholder="Enemy" required />
	<br/><br/>

	<label for="datechanson">username </label>
	<input type="date" name="datechanson" id="datechanson" required />
	<br/><br/>
	
    <label for="Groupe">chosissez un groupe</label>
    <select  name="Groupe" id="Groupe">
    <?php foreach($IDG as $IDG) { ?>
	<option value='<?= $IDG['IDG'] ?>'><?= strval($IDG['IDG']).' '.$IDG['NomG'] ?></option>
    <?php } ?>
    
    </select>
    <br/><br/>
    <label for="Genre">chosissez un Genre</label>
    <select name="Genre" id="Genre">
    <?php foreach($IDGenre as $IDGenre) { ?>
	<option value='<?= $IDGenre['IDGenre'] ?>'><?= strval($IDGenre['IDGenre']).' '.$IDGenre['NomGenre'] ?></option>
    <?php } ?>
    </select>
    <br/><br/>

            <input type="submit" name="boutonValider" value="Ajouter"/>
        </form>

        <?php if(isset($message)) { ?>
            <p style="background-color: yellow;"><?= $message ?></p>
        <?php } ?>


        <?php if(isset($message2)) { ?>
            <p style="background-color: yellow;"><?= $message2 ?></p>
        <?php } ?>

        <?php if(isset($message3)) { ?>
            <p style="background-color: yellow;"><?= $message3 ?></p>
        <?php } ?>

        </div>
<div id="item">
        <h2>Partie 2/2: Ajout d'une version de chanson</h2>
        <form method="post" action="#">

            <label for="chanson">chosissez une chanson</label>
            <select name="chanson" id="chanson">

            <?php foreach($IDchanson as $IDchanson) { ?>
            <option value='<?= $IDchanson['IDC'] ?>'><?= strval($IDchanson['IDC']).' '.$IDchanson['TitreC'] ?></option>
            <?php } ?>

            
            </select>
            <br/><br/>


            <label for="DureeVersion">Entrez la durée de votre version</label>
            <input type="number" name="DureeVersion" id="DureeVersion" placeholder="1" required />
            <br/><br/>
            <label for="Nomfichier">Entrez le nom de fichier</label>
            <input type="text" name="Nomfichier" id="Nomfichier" placeholder="aaaa"  />
            <br/><br/>

            <label for="Dateversion">Entrez la date de fichier</label>
            <input type="date" name="Dateversion" id="Dateversion"  />

            <input type="submit" name="boutonValider2" value="Ajouter"/>


        </form>

        <?php if(isset($message4)) { ?>
            <p style="background-color: yellow;"><?= $message4 ?></p>
        <?php } ?>   
          <?php if(isset($message5)) { ?>
            <p style="background-color: yellow;"><?= $message5 ?></p>
        <?php } ?>

        
          </div>
          </div>
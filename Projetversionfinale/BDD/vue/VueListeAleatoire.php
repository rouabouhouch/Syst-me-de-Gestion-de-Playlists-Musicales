    
    
    <h2>Fonctionalité 3 ajout liste aléatoire </h2>

    
<?php if(isset($message)) { ?>
        <p style="background-color: yellow;"><?= $message ?></p>
    <?php } ?>


    <?php if(isset($message2)) { ?>
        <p style="background-color: yellow;"><?= $message2 ?></p>
        <h2>la liste:<?= $finallistName ?></h2>
            <table id="results">
                <thead>
                    <tr>
                    <th>IDC</th>
                    <th>NumV</th>
                    <th>Datecreation</th>
                    <th>TitreC</th>
                    <th>Durée</th>
                    <th>NomdeFichierVersion</th>

                    </tr>
                </thead>
                <tbody>
            <?php foreach($listcontents as $listcontents) { ?>
            
                    <tr>
                                                    
                    <td><?=$listcontents['IDC']?></td>
                        <td><?=$listcontents['NumV']?></td>
                    <td><?=$listcontents['Datecreation']?></td>
                    <td><?=$listcontents['TitreC']?></td>
                    <td><?=$listcontents['Durée']?></td>
                    <td><?=$listcontents['NomdeFichierVersion']?></td>

                    </tr>
                
            <?php } ?>           
                    </tbody>
                    </table>
    <?php } ?>





    <?php if(isset($message7)) { ?>
        <p style="background-color: yellow;"><?= $message7 ?></p>
        <h2>la liste:<?= $finallistName ?></h2>
        <table id="results">
            <thead>
                <tr>
                <th>IDC</th>
                <th>NumV</th>
                <th>Datecreation</th>
                <th>TitreC</th>
                <th>Durée</th>
                <th>NomdeFichierVersion</th>
                <th>playcount</th>

                </tr>
            </thead>
            <tbody>
        <?php foreach($listcontents as $listcontents) { ?>
           
                <tr>
                                                
                <td><?=$listcontents['IDC']?></td>
                    <td><?=$listcontents['NumV']?></td>
                <td><?=$listcontents['Datecreation']?></td>
                <td><?=$listcontents['TitreC']?></td>
                <td><?=$listcontents['Durée']?></td>
                <td><?=$listcontents['NomdeFichierVersion']?></td>
                <td><?=$listcontents['ValeurdeProprieté']?></td>

                </tr>
            
        <?php } ?>           
                 </tbody>
                 </table>
    <?php } ?>


    <?php if(isset($message3)) { ?>
        <p style="background-color: yellow;"><?= $message3 ?></p>

        <h2>la liste:<?= $finallistName ?></h2>
        <table id="results">
            <thead>
                <tr>
                <th>IDC</th>
                    <th>NumV</th>
                <th>Datecreation</th>
                <th>TitreC</th>
                <th>Durée</th>
                <th>NomdeFichierVersion</th>
                <th>IDGenre</th>
                <th>playcount</th>


                </tr>
            </thead>
            <tbody>
        <?php foreach($listcontents as $listcontents) { ?>
           
                <tr>
                                              
                <td><?=$listcontents['IDC']?></td>
                    <td><?=$listcontents['NumV']?></td>  
                <td><?=$listcontents['Datecreation']?></td>
                <td><?=$listcontents['TitreC']?></td>
                <td><?=$listcontents['Durée']?></td>
                <td><?=$listcontents['NomdeFichierVersion']?></td>
                <td><?=$listcontents['IDGenre']?></td>
                <td><?=$listcontents['ValeurdeProprieté']?></td>

                </tr>
            
        <?php } ?>        
        <?php foreach($notofgenrecontents as $notofgenrecontents) { ?>
            <tr>
            <td><?=$notofgenrecontents['IDC']?></td>
                <td><?=$notofgenrecontents['NumV']?></td>
                <td><?=$notofgenrecontents['Datecreation']?></td>
                <td><?=$notofgenrecontents['TitreC']?></td>
                <td><?=$notofgenrecontents['Durée']?></td>
                <td><?=$notofgenrecontents['NomdeFichierVersion']?></td>
                <td> Plusieurs Genres</td>
                <td><?=$notofgenrecontents['ValeurdeProprieté']?></td>


                </tr>
            
            <?php } ?>        

                 </tbody>
                 </table>
    <?php } ?>

    <?php if(isset($message4)) { ?>
        <p style="background-color: yellow;"><?= $message4 ?></p>

       <h2>la liste:<?= $finallistName ?></h2>
        <table id="results">
            <thead>
                <tr>
                <th>IDC</th>
                    <th>NumV</th>
                <th>Datecreation</th>
                <th>TitreC</th>
                <th>Durée</th>
                <th>NomdeFichierVersion</th>
                <th>IDGenre</th>


                </tr>
            </thead>
            <tbody>
        <?php foreach($listcontents as $listcontents) { ?>
           
                <tr>
                                                
                <td><?=$listcontents['IDC']?></td>
                    <td><?=$listcontents['NumV']?></td>
                <td><?=$listcontents['Datecreation']?></td>
                <td><?=$listcontents['TitreC']?></td>
                <td><?=$listcontents['Durée']?></td>
                <td><?=$listcontents['NomdeFichierVersion']?></td>
                <td><?=$listcontents['IDGenre']?></td>

                </tr>
            
        <?php } ?>        
        <?php foreach($notofgenrecontents as $notofgenrecontents) { ?>
            <tr>
            <td><?=$notofgenrecontents['IDC']?></td>
                <td><?=$notofgenrecontents['NumV']?></td>
                <td><?=$notofgenrecontents['Datecreation']?></td>
                <td><?=$notofgenrecontents['TitreC']?></td>
                <td><?=$notofgenrecontents['Durée']?></td>
                <td><?=$notofgenrecontents['NomdeFichierVersion']?></td>
                <td> Plusieurs Genres</td>


                </tr>
            
            <?php } ?>        

                 </tbody>
                 </table>
    <?php } ?>
    <?php if(isset($message5)) { ?>
        <p style="background-color: yellow;"><?= $message5 ?></p>

            <h2>la liste:<?= $finallistName ?></h2>
            <table id="results">
                <thead>
                    <tr>
                    <th>IDC</th>
                    <th>NumV</th>
                    <th>Datecreation</th>
                    <th>TitreC</th>
                    <th>Durée</th>
                    <th>NomdeFichierVersion</th>
                    <th>IDGenre</th>
                    <th>skipcount</th>


                    </tr>
                </thead>
                <tbody>
            <?php foreach($listcontents as $listcontents) { ?>
            
                    <tr>
                                                    
                    <td><?=$listcontents['IDC']?></td>
                    <td><?=$listcontents['NumV']?></td>
                    <td><?=$listcontents['Datecreation']?></td>
                    <td><?=$listcontents['TitreC']?></td>
                    <td><?=$listcontents['Durée']?></td>
                    <td><?=$listcontents['NomdeFichierVersion']?></td>
                    <td><?=$listcontents['IDGenre']?></td>
                    <td><?=$listcontents['ValeurdeProprieté']?></td>

                    </tr>
                
            <?php } ?>        
            <?php foreach($notofgenrecontents as $notofgenrecontents) { ?>
                <tr>
                <td><?=$notofgenrecontents['IDC']?></td>
                <td><?=$notofgenrecontents['NumV']?></td>
                    <td><?=$notofgenrecontents['Datecreation']?></td>
                    <td><?=$notofgenrecontents['TitreC']?></td>
                    <td><?=$notofgenrecontents['Durée']?></td>
                    <td><?=$notofgenrecontents['NomdeFichierVersion']?></td>
                    <td> Plusieurs Genres</td>
                    <td><?=$notofgenrecontents['ValeurdeProprieté']?></td>


                    </tr>
                
                <?php } ?>        

                    </tbody>
                    </table>
                    <?php } ?>


                    <?php if(isset($message6)) { ?>
        <p style="background-color: yellow;"><?= $message6 ?></p>

            <h2>la liste:<?= $finallistName ?></h2>
            <table id="results">
                <thead>
                    <tr>
                    <th>IDC</th>
                    <th>NumV</th>
                    <th>Datecreation</th>
                    <th>TitreC</th>
                    <th>Durée</th>
                    <th>NomdeFichierVersion</th>
                    <th>IDGenre</th>
                    <th>lastplayed</th>


                    </tr>
                </thead>
                <tbody>
            <?php foreach($listcontents as $listcontents) { ?>
            
                    <tr>
                        
                    <td><?=$listcontents['IDC']?></td>
                    <td><?=$listcontents['NumV']?></td>

                    <td><?=$listcontents['Datecreation']?></td>
                    <td><?=$listcontents['TitreC']?></td>
                    <td><?=$listcontents['Durée']?></td>
                    <td><?=$listcontents['NomdeFichierVersion']?></td>
                    <td><?=$listcontents['IDGenre']?></td>
                    <td><?=$listcontents['ValeurdeProprieté']?></td>

                    </tr>
                
            <?php } ?>        
            <?php foreach($notofgenrecontents as $notofgenrecontents) { ?>
                <tr>
                <td><?=$notofgenrecontents['IDC']?></td>
                <td><?=$notofgenrecontents['NumV']?></td>

                    <td><?=$notofgenrecontents['Datecreation']?></td>
                    <td><?=$notofgenrecontents['TitreC']?></td>
                    <td><?=$notofgenrecontents['Durée']?></td>
                    <td><?=$notofgenrecontents['NomdeFichierVersion']?></td>
                    <td> Plusieurs Genres</td>
                    <td><?=$notofgenrecontents['ValeurdeProprieté']?></td>


                    </tr>
                
                <?php } ?>        

                    </tbody>
                    </table>
                    <?php } ?>

<form method="post" action="#">

       <label for="DureePlaylist">Entrez la durée de votre Playlist en minutes</label>
        <input type="number" name="DureePlaylist" id="DureePlaylist" placeholder=20  min="0" required />
        <br/><br/>
        <label for="Genre">chosissez un Genre</label>
        <select name="Genre" id="Genre">
        <option value='null'> Pas de genre specifiques</option>

        <?php foreach($IDGenre as $IDGenre) { ?>
        <option value='<?= $IDGenre['IDGenre'] ?>'><?= strval($IDGenre['IDGenre']).' '.$IDGenre['NomGenre'] ?></option>
        <?php } ?>
        </select>

        <br/><br/>
        <label for="Preference">Préférence pour la liste</label>

        <select name="Preference" id="Preference">
        <option value='null'>Aucune Préférence</option>
        <option value='playcount'>Les chansons les plus jouée</option>
        <option value='skipcount'>Les chansons les les plus sautées</option>
        <option value='lastplayed'>Les chansons  jouées le plus récemment</option>

        </select>
        <br/><br/>

        <label for="ListName">Entrez le nom de votre liste de lecture</label>
        <input type="text" name="ListName" id="ListName" placeholder="Unknown" />
        <br/><br/>

        <input type="submit" name="boutonValider" value="Ajouter"/>
        <br/><br/>


</form>

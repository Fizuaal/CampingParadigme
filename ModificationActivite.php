<?php require 'Header.php';?>

<script defer type="text/javascript" src="css\MDL_SELECT\dist/mdl-selectfield.min.js"></script>
<link rel="stylesheet" type="text/css" href="css\MDL_SELECT\dist/mdl-selectfield.min.css"/>

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
<?php 
$req = $bdd->prepare('SELECT *
FROM  activite AC, animation AN, etat_act E, type_anim T
WHERE AC.codeanim = \''.$_POST['codeAnim'].'\'
AND AC.codeanim = AN.codeanim
AND DATEACT = \''.$_POST['dateAct'].'\'
AND E.CODEETATACT = AC.CODEETATACT
AND AN.CODETYPEANIM = T.CODETYPEANIM ');
$req->execute();
$resultat = $req->fetchAll();
//var_dump($resultat);
?>
    <form action="ActModif.php" method="post">
        <table>    
            <tr>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" value="<?php echo $resultat[0]["NOMANIM"]; ?>" type="text" id="nomAnim" name="nomAnim">
                        <label class="mdl-textfield__label" for="nomAnim">Nom de l'animation</label>
                    </div>
                </td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="date" value="2019-07-22" name="dtFinValidite" id="dtFinValidite">
                        <label class="mdl-textfield__label" for="dtFinValidite"> Date de Fin de validité :</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" value="<?php echo $resultat[0]["DUREEANIM"]; ?>" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="dureeAnim" name="dureeAnim">
                        <label class="mdl-textfield__label" for="dureeAnim">Temps de l'animation (en heure)</label>
                        <span class="mdl-textfield__error">Entrez un nombre !</span>
                    </div>
                </td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" value="<?php echo $resultat[0]["LIMITEAGE"]; ?>" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="limAge" name="limAge">
                        <label class="mdl-textfield__label" for="limAge">Limite d'âge</label>
                        <span class="mdl-textfield__error">Entrez un nombre !</span>
                    </div>
                <td>
            </tr>
            <tr>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" value="<?php echo $resultat[0]["TARIFANIM"]; ?>" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="tarifAnim" name="tarifAnim">
                        <label class="mdl-textfield__label" for="tarifAnim">Tarif (en €)</label>
                        <span class="mdl-textfield__error">Entrez un nombre !</span>
                    </div>
                </td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" value="<?php echo $resultat[0]["NBREPLACEANIM"]; ?>" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="nbrPlaces" name="nbrPlaces">
                        <label class="mdl-textfield__label" for="nbrPlaces">Nombre de places maximum</label>
                        <span class="mdl-textfield__error">Entrez un nombre !</span>
                    </div>
                <td>
            </tr>
            <tr>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" value="<?php echo $resultat[0]["COMMENTANIM"]; ?>" type="text" id="commentaire" name="commentaireAnim">
                        <label class="mdl-textfield__label" for="commentaire">Commentaire</label>
                    </div>
                </td>
                <td>
                    <div id="SelecteurType" class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                        <select id="difficulte" class="mdl-selectfield__select" value="<?php echo $resultat[0]["DIFFICULTEANIM"]; ?>" name="difficulteAnim">
                            <option value="Facile">Facile</option>
                            <option value="Moyen">Moyen</option>
                            <option value="Difficile">Difficile</option>
                        </select>
                        <div class="mdl-selectfield__icon"><i class="material-icons">arrow_drop_down</i></div>
                        <label class="mdl-selectfield__label" for="difficulte">Difficulté</label>
                    </div>
                <td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="resize: none;width: 40vw !important;height: 24vh !important;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label areaDesc">
                        <textarea style="resize: none;width: 40vw !important;height: 19vh !important;" class="mdl-textfield__input" type="text" rows= "1" id="Desc" name="descAnim"><?php echo $resultat[0]["DESCRIPTANIM"]; ?></textarea>
                        <label class="mdl-textfield__label" for="Desc">Description</label>
                    </div>
                <td>
            </tr>
        </table>
        <button style="float: right;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored decale" id="Creer" type="submit">Mettre à jour</button>
    </form>
</div>

<?php require 'Footer.php'; ?>
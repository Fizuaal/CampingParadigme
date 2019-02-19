<?php require 'Header.php' ?>

<script defer type="text/javascript" src="css\MDL_SELECT\dist/mdl-selectfield.min.js"></script>
<link rel="stylesheet" type="text/css" href="css\MDL_SELECT\dist/mdl-selectfield.min.css"/>

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <form action="AnimCreatfct.php" method="post">
        <div style="width:100%;margin: auto;">
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="Exist" onClick="montreSelecteurType()">
                <input type="radio" id="Exist" class="mdl-radio__button" name="nvType" value="0" checked>
                <span class="mdl-radio__label">Type existant</span>
            </label><br/>
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="Nv" onClick="cacheSelecteurType()">
                <input type="radio" id="Nv" class="mdl-radio__button" name="nvType" value="1">
                <span class="mdl-radio__label">Nouveau type d'activité</span>
            </label>
        </div>
        <div>
            <div id="SelecteurType" class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                <select id="typeAnim" class="mdl-selectfield__select" name="typeAnim">
                    <?php listTypesAnim($bdd); ?>
                </select>
                <div class="mdl-selectfield__icon"><i class="material-icons">arrow_drop_down</i></div>
                <label class="mdl-selectfield__label" for="typeAnim">Type d'animation</label>
            </div>
            <div id="newType" style="display: none;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="sample3" name="newTypeAnim">
                <label class="mdl-textfield__label" for="sample3">Nouveau type d'animation</label>
            </div>
        </div>
        <table>    
            <tr>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="nomAnim" name="nomAnim">
                        <label class="mdl-textfield__label" for="nomAnim">Nom de l'animation</label>
                    </div>
                </td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="date" value="2019-07-22"
                        name="dtFinValidite" id="dtFinValidite">
                        <label class="mdl-textfield__label" for="dtFinValidite"> Date de Fin de validité :</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="dureeAnim" name="dureeAnim">
                        <label class="mdl-textfield__label" for="dureeAnim">Temps de l'animation (en heure)</label>
                        <span class="mdl-textfield__error">Entrez un nombre !</span>
                    </div>
                </td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="limAge" name="limAge">
                        <label class="mdl-textfield__label" for="limAge">Limite d'âge</label>
                        <span class="mdl-textfield__error">Entrez un nombre !</span>
                    </div>
                <td>
            </tr>
            <tr>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="tarifAnim" name="tarifAnim">
                        <label class="mdl-textfield__label" for="tarifAnim">Tarif (en €)</label>
                        <span class="mdl-textfield__error">Entrez un nombre !</span>
                    </div>
                </td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="nbrPlaces" name="nbrPlaces">
                        <label class="mdl-textfield__label" for="nbrPlaces">Nombre de places maximum</label>
                        <span class="mdl-textfield__error">Entrez un nombre !</span>
                    </div>
                <td>
            </tr>
            <tr>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="commentaire" name="commentaireAnim">
                        <label class="mdl-textfield__label" for="commentaire">Commentaire</label>
                    </div>
                </td>
                <td>
                    <div id="SelecteurType" class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                        <select id="difficulte" class="mdl-selectfield__select" name="difficulteAnim">
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
                        <textarea style="resize: none;width: 40vw !important;height: 19vh !important;" class="mdl-textfield__input" type="text" rows= "1" id="Desc" name="descAnim"></textarea>
                        <label class="mdl-textfield__label" for="Desc">Description</label>
                    </div>
                <td>
            </tr>
        </table>
        <button style="float: right;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored decale" id="Creer" type="submit">Créer</button>
    </form>
</div>

<?php require 'Footer.php' ?>
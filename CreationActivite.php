<?php require 'Header.php'; ?>

<script defer type="text/javascript" src="css\MDL_SELECT\dist/mdl-selectfield.min.js"></script>
<link rel="stylesheet" type="text/css" href="css\MDL_SELECT\dist/mdl-selectfield.min.css"/>

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <form action="ActCreatfct.php" method="post">
    <input class="mdl-textfield__input" type="text" value="<?php echo $_POST['codeAnim'] ?>" name="codeAnim" id="codeAnim">
        <table>    
            <tr>
                <H2>Création d'une activité de <?php returnAnim($bdd, $_POST['codeAnim']); ?></H2>
            </tr>
            <tr>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="date" value="2019-07-22"
                        name="dtRDV" id="dtRDV">
                        <label class="mdl-textfield__label" for="dtRDV"> Date :</label>
                    </div>
                </td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="time" value="14:30"
                        name="HRDV" id="HRDV">
                        <label class="mdl-textfield__label" for="HRDV"> Heure de rendez-vous :</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="time" value="14:45"
                        name="HDebut" id="HDebut">
                        <label class="mdl-textfield__label" for="HDebut"> Heure de début :</label>
                    </div>
                </td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="time" value="17:30"
                        name="HFin" id="HFin">
                        <label class="mdl-textfield__label" for="HFin"> Heure de fin :</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="SelecteurType" class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                        <select id="Animateur" class="mdl-selectfield__select" name="Animateur">
                            <?php listAnimateurs($bdd); ?>
                        </select>
                        <div class="mdl-selectfield__icon"><i class="material-icons">arrow_drop_down</i></div>
                        <label class="mdl-selectfield__label" for="Animateur">Type d'animation</label>
                    </div>
                </td>
                <td>
                    <button style="float: right;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored decale" id="Creer" type="submit">Créer</button>
                </td>
            </tr>
        </table>    
    </form>
</div>

<?php require 'Footer.php'; ?>
<?php require 'Header.php' ?>

<script defer type="text/javascript" src="css\MDL_SELECT\dist/mdl-selectfield.min.js"></script>
<link rel="stylesheet" type="text/css" href="css\MDL_SELECT\dist/mdl-selectfield.min.css"/>

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <form action="">
        <div style="width:100%;margin: auto;">
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="Exist" onClick="montreSelecteurType()">
                <input type="radio" id="Exist" class="mdl-radio__button" name="options" value="1" checked>
                <span class="mdl-radio__label">Type existant</span>
            </label>
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="Nv" onClick="cacheSelecteurType()">
                <input type="radio" id="Nv" class="mdl-radio__button" name="options" value="2">
                <span class="mdl-radio__label">Nouveau type d'activité</span>
            </label>
        </div>
        <div id="SelecteurType" class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
            <select id="typeAnim" class="mdl-selectfield__select">
                <?php listTypesAnim($bdd); ?>
            </select>
            <div class="mdl-selectfield__icon"><i class="material-icons">arrow_drop_down</i></div>
            <label class="mdl-selectfield__label" for="typeAnim">Type d'animation</label>
        </div>
    </form>
</div>

<?php require 'Footer.php' ?>
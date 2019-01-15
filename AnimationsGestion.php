<?php require 'Header.php' ?>
<script type="text/javascript" src="js/getmdl-select.js"></script>

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" 
    onClick="javascript:document.location.href='AnimationsCreation.php'">
    Créer une Animation
    </button>
    <ul class="demo-list-three mdl-list">
        <?php ListAllAnimations($bdd) ?>
    </ul>
</div>

<?php require 'Footer.php' ?>
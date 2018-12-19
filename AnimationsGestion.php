<?php require 'Header.php' ?>
<script type="text/javascript" src="js/getmdl-select.js"></script>

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <ul class="demo-list-three mdl-list">
        <?php ListAllAnimations($bdd) ?>
    </ul>
</div>

<?php require 'Footer.php' ?>
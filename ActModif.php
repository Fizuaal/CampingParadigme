<?php require 'Header.php';?>

<!-- <meta http-equiv="refresh" content="0 ; url=Accueil.php"> -->

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <?php 
    ModifAanimation($bdd, $_POST['nomAnim'], $_POST['dtFinValidite'], $_POST['dureeAnim'], $_POST['HDebut'],  $_POST['limAge'], $_POST['tarifAnim'], $_POST['nbrPlaces'], $_POST['commentaireAnim'], $_POST['difficulteAnim'], $_POST['Desc']);

    ?>
</div>

<?php require 'Footer.php'; ?>
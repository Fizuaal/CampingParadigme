<?php require 'Header.php';?>

<meta http-equiv="refresh" content="0 ; url=Accueil.php">

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <?php 
    $tblResultats = RecupAnimationEtAnimateur($bdd, $_POST['codeAnim'], $_POST['Animateur']);
    CreationActivité($bdd, $_POST['codeAnim'], $_POST['dtRDV'], $_POST['HRDV'], $tblResultats[1], $_POST['HDebut'],  $_POST['HFin'], $tblResultats[3], $tblResultats[2]);

    ?>
</div>

<?php require 'Footer.php'; ?>
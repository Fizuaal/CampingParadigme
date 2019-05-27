<?php require 'Header.php';?>

<meta http-equiv="refresh" content="0 ; url=Accueil.php">

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <?php 
        InscriptionActivité($bdd, $_SESSION['ID'], $_POST['codeAnim'], $_POST['dateAct'],  date("Y-m-d")) 
    ?>
</div>

<?php require 'Footer.php'; ?>
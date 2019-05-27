<?php require 'Header.php';?>
<!-- La ligne du dessous est un test, si bug, supprimer le Meta -->
<meta http-equiv="refresh" content="0 ; url=Accueil.php">

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <?php DeleteAnim($bdd, $_POST['codeAnim'], $_POST['dateAct']);?>
</div>

<?php require 'Footer.php'; ?>
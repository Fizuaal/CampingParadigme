<?php require'Header.php' ?>

<?php
    // Suppression des variables de session et de la session
    $_SESSION = array();
    session_destroy();

    // Suppression des cookies de connexion automatique
    setcookie('login', '');
    setcookie('pass_hache', '');

    echo "<script type='text/javascript'>document.location.replace('Accueil.php');</script>"
?>

<?php require'Footer.php' ?>
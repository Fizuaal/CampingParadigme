<?php require 'Header.php' ?>

<form method="post">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" name="pseudo" id="pseudo">
        <label class="mdl-textfield__label" for="pseudo"> Pseudo ou Mail : </label>
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="password" name="mdp" id="mdp">
        <label class="mdl-textfield__label" for="mdp"> Mot de passe :</label>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored decale" id="envoyer" type="submit">Envoyer</button>
</form>

<?php 
    if (!empty($_POST['pseudo']))
    {
        connect($bdd);
    }
    else
    {
        exit('');
    }
?>
                
<?php require 'Footer.php' ?>
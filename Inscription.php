<?php require 'Header.php' ?>


<div style="height: 100vh;max-width: 1000px;margin: auto;" class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <div style="width: 100%"><h2 class="titre">Inscription</h2></div>
    <form method="post">
        <table class="inscr">
            <tr>
                <td>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                    <input type="radio" id="option-1" class="mdl-radio__button" name="sexe" value="M" checked>
                    <span class="mdl-radio__label">Monsieur</span>
                    </label>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                    <input type="radio" id="option-2" class="mdl-radio__button" name="sexe" value="Mme">
                    <span class="mdl-radio__label">Madame</span>
                    </label>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
                    <input type="radio" id="option-3" class="mdl-radio__button" name="sexe" value="Autre">
                    <span class="mdl-radio__label">Autre</span>
                    </label>
                </td>
            </table>
            <table class="inscr">
                <tr>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text"  name="prenom" id="prenom">
                            <label class="mdl-textfield__label" for="prenom">Prénom : </label>
                        </div>
                    </td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" name="nom" id="nom">
                            <label class="mdl-textfield__label" for="nom">Nom  : </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" name="pseudo" min="5" id="pseudo">
                            <label class="mdl-textfield__label" for="pseudo"> Pseudo : </label>
                        </div>
                    </td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="date" value="2018-07-22"
                            name="dtnais" id="dtnais">
                            <label class="mdl-textfield__label" for="dtnais"> Date de Naissance :</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label decale2">
                            <input class="mdl-textfield__input" type="email" name="mail" id="mail" maxlength="80" onBlur="checkMail()">
                            <label class="mdl-textfield__label" for="mail">Email  : </label>
                            <span class="mdl-textfield__error">Exemple@domaine.fr</span>
                        </div>
                    </td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label decale2">
                            <input class="mdl-textfield__input" type="email" id="ConfMail" maxlength="80" onBlur="checkMail()">
                            <label class="mdl-textfield__label" for="ConfMail">Confirmer email  : </label>
                        </div><br>
                        <span style="font-size: 12px; color:red;" id="divcompmail"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="password" name="mdp" min="6" id="mdp" onBlur="checkPass()">
                            <label class="mdl-textfield__label" for="mdp"> Mot de passe :</label>                    
                            <span class="mdl-textfield__error">Le mot de passeest trop court </span>
                        </div>
                    </td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="password" id="Confmdp" onBlur="checkPass()">
                            <label class="mdl-textfield__label" for="Confmdp">Confirmer mot de passe : </label>
                        </div><br>
                        <span style="font-size: 12px; color:red;" id="divcomp"></span>
                    <td>
                </tr>
                <tr>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="date" value="2018-07-22"
                            name="dtDebSej" id="dtDebSej">
                            <label class="mdl-textfield__label" for="dtDebSej"> Date de Début de séjour :</label>
                        </div>
                    </td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="date" value="2018-07-22"
                            name="dtFinSej" id="dtFinSej">
                            <label class="mdl-textfield__label" for="dtFinSej"> Date de Fin de séjour :</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" name="noTel" id="noTel">
                            <label class="mdl-textfield__label" for="noTel"> Numéro de téléphone: </label>
                        </div>
                    </td>
                    <td>
                        <button style="left: 46%" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" 
                        id="envoyer" type="submit">Envoyer</button>
                        <?php
                            newUser($bdd);
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>

<?php require 'Footer.php' ?>
<?php require 'Header.php' ?>

<!-- Liste des activités -->

<table>
        <tr>
            <td>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" 
                onClick="javascript:document.location.href='Accueil.php'">
                Afficher toutes les activités
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <ul class="demo-list-three mdl-list">
                    <?php ListAllActivitesDepensiere($bdd) ?>
                </ul>
            </td>
        </tr>
    </table>

<?php require 'Footer.php' ?>
<?php require 'Header.php' ?>

<!-- Liste des activités -->

<table>
        <tr>
            <td>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" 
                onClick="javascript:document.location.href='AccueilDepense.php'">
                Afficher les 5 activités les plus dépensières
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <ul class="demo-list-three mdl-list">
                    <?php ListAllActivités($bdd) ?>
                </ul>
            </td>
        </tr>
    </table>

<?php require 'Footer.php' ?>
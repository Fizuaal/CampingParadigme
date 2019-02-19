<?php require 'Header.php' ?>
<script type="text/javascript" src="js/getmdl-select.js"></script>

<div style="padding: 10px;">
    <table>
        <tr>
            <td>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" 
                onClick="javascript:document.location.href='AnimationsCreation.php'">
                Créer une Animation
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <ul class="demo-list-three mdl-list">
                    <?php ListAllAnimations($bdd) ?>
                </ul>
            </td>
        </tr>
    </table>
</div>

<?php require 'Footer.php' ?>
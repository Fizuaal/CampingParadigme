<?php require 'Header.php' ?>
<script type="text/javascript" src="js/getmdl-select.js"></script>

<div #Selecteur class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
    <input type="text" value="" class="mdl-textfield__input" id="typeUtlisateur" readonly>
    <input type="hidden" value="" name="typeUtlisateur">
    <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
    <label for="typeUtlisateur" class="mdl-textfield__label">Catégorie</label>
    <ul for="typeUtlisateur" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
        <li class="mdl-menu__item" data-val="All" data-selected="true">Tous</li>
        <li class="mdl-menu__item" data-val="Admins">Admins</li>
        <li class="mdl-menu__item" data-val="Visiteurs">Visiteurs</li>
        <li class="mdl-menu__item" data-val="Animateurs">Animateurs</li>
        <li class="mdl-menu__item" data-val="Désactivés">Désactivés</li>
        <li class="mdl-menu__item" data-val="Activés">Activés</li>
    </ul>
</div>

Activités


<?php require 'Footer.php' ?>
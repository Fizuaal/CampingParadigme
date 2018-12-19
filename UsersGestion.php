<?php require 'Header.php' ?>
<script type="text/javascript" src="css/GET_MDL_SELECT/getmdl-select.min.js"></script>
<script type="text/javascript" src="js/Filtres.js"></script>
<?php 

if(!isset($_SESSION['TYPEPROFIL']) || $_SESSION['TYPEPROFIL'] != 'Admin'){
    exit("Vous n'avez pas les droits nécéssaires");
}
?>

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <!-- Barre de recherche -->
    <div style="width: 100%;">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: flex;">
            <input class="mdl-textfield__input" type="text" id="Rechercher">
            <label class="mdl-textfield__label" for="Rechercher">Rechercher un Utilisateur</label><i class="material-icons">search</i>
        </div>
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
    </div>
    
    <!-- List des Users -->
    <div class="list flex-container">
        <?php GetAllUsers($bdd) ?>
    </div>
</div>

<?php require 'Footer.php' ?>
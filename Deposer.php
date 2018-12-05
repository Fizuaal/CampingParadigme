<?php require'Header.php' ?>


	<h2 class="titre">Déposer votre annonce</h2>
<br /> <br />
<form method="POST" action="">
<table class="tableau">
	<tr>
		<td>
			<form action="#">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample3">
				<label class="mdl-textfield__label" for="sample3">Titre de l'annonce</label>
				</div>
			</form>
		</td>
		<td rowspan="3">
			<form action="#">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label areaDesc">
					<textarea class="mdl-textfield__input" type="text" rows= "1" id="Desc"></textarea>
					<label class="mdl-textfield__label" for="Desc">Description</label>
				</div>
			</form>
		</td>
	</tr>
	<tr>
		<td> 
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
				<input type="text" value="" class="mdl-textfield__input" id="sample4" readonly>
				<input type="hidden" value="" name="sample4">
				<i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
				<label for="sample4" class="mdl-textfield__label">Catégorie</label>
				<ul for="sample4" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
					<li class="mdl-menu__item" data-val="MT">Motos</li>
					<li class="mdl-menu__item" data-val="VTR">Voitures</li>
					<li class="mdl-menu__item" data-val="FRN">Fournitures</li>
					<li class="mdl-menu__item" data-val="MBL">Meubles</li>
					<li class="mdl-menu__item" data-val="ELC">Electronique</li>
					<li class="mdl-menu__item" data-val="ANM">Animaux</li>
					<li class="mdl-menu__item" data-val="EQP">Equipement</li>
					<li class="mdl-menu__item" data-val="ATR">Autres</li>
				</ul>
			</div>
		</td>
	</tr>
	<tr>
		<td>
		<form action="#">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="sample4">
			<label class="mdl-textfield__label" for="sample4">Prix (en €)</label>
			<span class="mdl-textfield__error">Le prix doit être un nombre</span>
			</div>
		</form>
		</td>
	</tr>	
</table>
<h2 class="titreContact"> Informations de contact</h2>
<table>
	<tr>		
		<td>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label decale2">
				<input class="mdl-textfield__input" type="tel" id="sample4" minlength="10" maxlength="14">
				<label class="mdl-textfield__label" for="sample4">Téléphone : </label>
				<span class="mdl-textfield__error">Saisir un numéro de téléphone valable</span>
			</div>
		</td>
		<td>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label decale2">
				<input class="mdl-textfield__input" type="tel" id="sample4" minlength="10" maxlength="14">
				<label class="mdl-textfield__label" for="sample4"> Fixe : </label>
				<span class="mdl-textfield__error">Saisir un numéro de téléphone valable</span>
			</div>
		</td>
	</tr>
	<tr>		
		<td>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label decale2">
				<input class="mdl-textfield__input" type="email" id="sample4" maxlength="80">
				<label class="mdl-textfield__label" for="sample4">Email  : </label>
				<span class="mdl-textfield__error">Exemple@domaine.fr</span>
			</div>
		</td>
		<td>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label decale2">
				<input class="mdl-textfield__input" type="text" id="sample4" maxlength="80">
				<label class="mdl-textfield__label" for="sample4"> Lieu: </label>
			</div>
		</td>
	</tr>
</table>
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored decale" id="envoyer" type="button">Envoyer</button>
		<div id="send" class="mdl-js-snackbar mdl-snackbar">
			<div class="mdl-snackbar__text"></div>
			<button class="mdl-snackbar__action" type="button"></button>
			<div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active"></div>
		</div>
		<script>
		(function() {
			'use strict';
			var snackbarContainer = document.querySelector('#send');
			var showToastButton = document.querySelector('#envoyer');
			showToastButton.addEventListener('click', function() {
			'use strict';
			var data = {message: 'Publication en cours... '};
			snackbarContainer.MaterialSnackbar.showSnackbar(data);
			});
		}());
		</script>
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored decale" id="reinit" type="button">Réinitialiser</button>
		
		<?php require'Footer.php' ?>
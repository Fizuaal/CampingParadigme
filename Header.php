<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8"/> 
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="./css/MDL/material.min.css">
		<script defer src="./css/MDL/material.min.js"></script>
		<script src="js/jquery-3.2.1.js"></script>
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <script type="text/javascript" src="js/Fonctions_DIY.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<title>Camping Paradigme</title>
	</head>
	<body>

	<?php 
		require 'BDD.php';
		$bdd = accesBDD();
	?>

	<div class="page">
		<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
			  <header class="mdl-layout__header">
				<div class="mdl-layout__header-row">
				  <div class="mdl-layout-spacer"></div> <!--  MARKER -->
				  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
					
					<?php if(!empty($_SESSION['ID'])): ?>
					
					<div style="cursor: pointer;" onclick="window.location='./Moncompte.php';">
						<span class="mdl-chip mdl-chip--contact">
							<img class="mdl-chip__contact" src="<?php 
													if(!empty($_SESSION['Photo']))
													{
															echo $_SESSION['Photo'];
													}
													else
													{
															echo "UsersIMG/_Vide.jpg";
													}
													?>"/>
							<span class="mdl-chip__text" id="Username"></span>
					</div>

						<button onClick="javascript:document.location.href='deconnexion.php'" style="position: absolute; right: 8vw !important;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
							Deconnexion
						</button>

					<?php else: ?>

						<button onClick="javascript:document.location.href='Inscription.php'" style="position: absolute;bottom: 5px !important;right: 100px !important;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
							Inscription
						</button>
						<button onClick="javascript:document.location.href='Connexion.php'" style="position: absolute;bottom: 5px !important;right: -30px !important;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
							Connexion
						</button>

					<?php endif; ?>

				  </div>
				</div>
			  </header>


				<?php
 
				if(!empty($_SESSION['ID']))
				{
					
				$Username = $_SESSION['ID'];
				$F_L_Username = $Username[0];
				?>
					<script language="JavaScript" type="text/JavaScript">
						var F_L_Username = document.getElementById("F_L_Username");
						var Username = document.getElementById("Username");
						Username.innerHTML = '<?php echo ($Username); ?>';
					</script>
				<?php
				}
				?>

			  <div class="mdl-layout__drawer">
				<span class="mdl-layout-title">Camping Paradigme</span>
				<nav class="mdl-navigation">
				  <a class="mdl-navigation__link" href="Accueil.php">Accueil</a>
					<?php 
					if(isset($_SESSION['TYPEPROFIL'])){
						if($_SESSION['TYPEPROFIL'] == 'Admin'){
							echo '<a class="mdl-navigation__link" href="UsersGestion.php">Gestion des utilisateurs</a>';
						}
						if($_SESSION['TYPEPROFIL'] == 'Animateur' || $_SESSION['TYPEPROFIL'] == 'Admin'){
							echo '<a class="mdl-navigation__link" href="AnimationsGestion.php">Gestion des Animations</a>';
						}
						if($_SESSION['TYPEPROFIL'] == 'Vacancier' || $_SESSION['TYPEPROFIL'] == 'Admin' || $_SESSION['TYPEPROFIL'] == 'Animateur'){
							echo '<a class="mdl-navigation__link" href="CalculCalories.php">Calculateur de calories</a>';
						}
					}
					?>
				</nav>
			  </div>
			  <main style="background-color: rgba(220, 220, 220, 1);" class="mdl-layout__content">
				<div class="page-content">
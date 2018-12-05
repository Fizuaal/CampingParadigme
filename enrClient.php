<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">		
	</head>
<div>
	<?php
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=lbc_v;charset=utf8', 'root', '');
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
    ?>
	<?php
		
		// récupération des valeurs en provenance du formulaire (avec traitement
		// des apostrophes) puis affectation à des variables
			$nom = addslashes($_POST['nom']);
			$prenom = addslashes($_POST['prenom']);
			$pseudo = addslashes($_POST['pseudo']);
			$mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
			$mail = $_POST['mail'];
			$dtnais = $_POST['dtnais'];
			$dateInscription = date("F j, Y, g:i a"); //Récupère la date du jour
			$dtDebutSejour = $_POST['dtDebutSejour'];
			$dtFinSejour = $_POST['dtFinSejour'];
			$typeProfile = 'Vacancier';
			$noTel = $_POST['noTel'];
			
		// requête d'enregistrement du client

			$bdd->exec("INSERT INTO UTILISATEURS ( USER, MDP, NOMCOMPTE, PRENOMCOMPTE, ADRMAILCOMPTE, DATENAISCOMPTE,
			DATEDEBSEJOUR, DATEFINSEJOUR, DATEINSCRIP, TYPEPROFIL, NOTELCOMPTE)
			VALUES ( '$pseudo', '$mdp', '$nom', '$prenom', '$mail', '$dtnais')");
			

			//Commentaire de finu
			echo "<p>Vous avez bien été enregistré(e).\n";
			echo "Si la page ne vous redirige pas automatiquement, cliquez ici:<a href='accueil.html'>retour</a>.</p>";
			

	?>
	<META HTTP-EQUIV="Refresh" CONTENT="2; Connexion.php">
</div>
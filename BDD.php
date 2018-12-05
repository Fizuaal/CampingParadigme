<?php
    function accesBDD()
    {
        $bdd = null;
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=campingparadigme;charset=utf8', 'root', '');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

        session_start();

        return ($bdd);
    }
    
    function searchIfUserExist($bdd)
    {
        $pseudo = addslashes($_POST['pseudo']);
        $req = $bdd->prepare('SELECT USER, MDP, TYPEPROFIL, PHOTO_DIR, DATEFERME FROM COMPTE WHERE USER = :pseudo OR ADRMAILCOMPTE = :pseudo');
            $req->execute(array(
                'pseudo' => $pseudo));
            $resultat = $req->fetch();
        return $resultat;
    }

    function newUser($bdd) 
    {
        if(!empty($_POST['pseudo']))
        {
            $pseudo = addslashes($_POST['pseudo']);
            $resultat = searchIfUserExist($bdd, $pseudo);

            if(isset($resultat))
            {
                // récupération des valeurs en provenance du formulaire (avec traitement
                // des apostrophes) puis affectation à des variables

                //Données Brut

                $nom = addslashes($_POST['nom']);
                $prenom = addslashes($_POST['prenom']);
                $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                $mail = addslashes($_POST['mail']);
                $dtInscrip = date("Y/m/d");
                $typeProfil = "Vacancier";
                $noTel = addslashes($_POST['noTel']);

                //Conversion des dates

                $dtDebSej = new DateTime(addslashes($_POST['dtDebSej']));
                $dtDebSej = $dtDebSej->format("Y/m/d");

                $dtFinSej = new DateTime(addslashes($_POST['dtFinSej']));
                $dtFinSej = $dtFinSej->format("Y/m/d");

                $dtnais = new DateTime(addslashes($_POST['dtnais']));
                $dtnais = $dtnais->format("Y/m/d");
                
                // requête d'enregistrement du client

                $requete = "INSERT INTO COMPTE ( USER, MDP, NOMCOMPTE, PRENOMCOMPTE, ADRMAILCOMPTE, DATENAISCOMPTE,
                DATEINSCRIP, TYPEPROFIL, DATEDEBSEJOUR, DATEFINSEJOUR, NOTELCOMPTE)
                VALUES ( '$pseudo', '$mdp', '$nom', '$prenom', '$mail', '$dtnais', '$dtInscrip', '$typeProfil', '$dtDebSej', '$dtFinSej', '$noTel')";

                $verif = $bdd->exec($requete);

                if($verif != 0)
                {
                    //Aucun retour si erreur
                    echo "<script type='text/javascript'>document.location.replace('Connexion.php');</script>";
                }
                else{
                    echo "Verrifiez vos informations";
                }
            }
        }
    }

    
    // function newUserInconnu($bdd) 
    // {
    //         for($i=0; $i<50; $i++)
    //         {
    //             // récupération des valeurs en provenance du formulaire (avec traitement
    //             // des apostrophes) puis affectation à des variables

    //             //Données Brut
    //             $pseudo = 'Visit'.$i;
    //             $nom = 'Visiteur'.$i;
    //             $prenom = 'Visiteur'.$i;
    //             $mdp = password_hash('Visiteur'.$i, PASSWORD_DEFAULT);
    //             $mail = 'Visiteur'.$i;
    //             $dtInscrip = date("Y/m/d");
    //             $typeProfil = "Vacancier";
    //             $noTel = '0606060606';

    //             //Conversion des dates
                
    //             $dtDebSej = new DateTime(addslashes($_POST['dtDebSej']));
    //             $dtDebSej = $dtDebSej->format("Y/m/d");
        
    //             $dtFinSej = new DateTime(addslashes($_POST['dtFinSej']));
    //             $dtFinSej = $dtFinSej->format("Y/m/d");
        
    //             $dtnais = new DateTime(addslashes($_POST['dtnais']));
    //             $dtnais = $dtnais->format("Y/m/d");

    //             // requête d'enregistrement du client

    //             $requete = "INSERT INTO COMPTE ( USER, MDP, NOMCOMPTE, PRENOMCOMPTE, ADRMAILCOMPTE, DATENAISCOMPTE,
    //             DATEINSCRIP, TYPEPROFIL, DATEDEBSEJOUR, DATEFINSEJOUR, NOTELCOMPTE)
    //             VALUES ( '$pseudo', '$mdp', '$nom', '$prenom', '$mail', '$dtnais', '$dtInscrip', '$typeProfil', '$dtDebSej', '$dtFinSej', '$noTel')";

    //             $verif = $bdd->exec($requete);

    //             if($verif != 0)
    //             {
    //                 //Aucun retour si erreur
    //                 echo "<script type='text/javascript'>document.location.replace('Connexion.php');</script>";
    //             }
    //             else{
    //                 echo "Verrifiez vos informations";
    //             }
    //         }
    //     }

    function connect($bdd)
    {
        $resultat = searchIfUserExist($bdd);

        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($_POST['mdp'], $resultat['MDP']);

        if (!isset($resultat))
        {
            echo 'Mauvais identifiant ou mot de passe !';
        }
        else
        {
            if ($isPasswordCorrect) {
                $_SESSION['ID'] = $resultat['USER'];
                $_SESSION['TYPEPROFIL'] = $resultat['TYPEPROFIL'];     
                $_SESSION['Photo'] = $resultat['PHOTO_DIR'];     
                echo 'Vous êtes connecté !';
                echo "<script type='text/javascript'>document.location.replace('Accueil.php');</script>";

            }
            else {
                echo 'Mauvais identifiant ou mot de passe !';
            }
        }
    }

    function ChangeRole($bdd){
        $resultat = searchIfUserExist($bdd);
        if ($resultat['TYPEPROFIL'] == 'Vacancier'){
            $newRole = 'Animateur';
        } else {
            $newRole = 'Vacancier';
        }
        $req = $bdd->prepare("UPDATE compte SET TYPEPROFIL = '".$newRole."' WHERE USER = '".$resultat['USER']."'");
            $req->execute();
    }

    function Delete($bdd){
        $dtFerm = '\''.date("Y/m/d").'\'';
        $resultat = searchIfUserExist($bdd);
        if (isset($resultat['DATEFERME'])){
            $dtFerm = stripslashes('NULL');
        }
        $req = $bdd->prepare("UPDATE compte SET DATEFERME = ".$dtFerm." WHERE USER= '".$resultat['USER']."'");
            $req->execute();
    }

    function GetAllUsers($bdd){
        $req = $bdd->prepare('SELECT USER, ADRMAILCOMPTE, TYPEPROFIL, DATEFERME  FROM COMPTE');
            $req->execute();
            $resultat = $req->fetchAll();
            //var_dump($resultat);
            foreach($resultat as $key=>$user)
            {
                $isDisabled = '';
                $isDisabledBackground = '';
                if($user['TYPEPROFIL'] == 'Admin'){
                    $icon = 'verified_user';
                    $promotion = '<li disabled class="mdl-menu__item">Aucun paramètre modifiable</li>';
                    $retrograde = '';
                    $delete = '';
                }
                elseif ($user['TYPEPROFIL'] == 'Animateur'){
                    $icon = 'school';
                    $promotion = '<li disabled class="mdl-menu__item">Promouvoir</li>';
                    $retrograde = '
                    <form id="Action'.$user['USER'].'" method="POST" action="ChangeRole.php">
                        <li onclick="getElementById(\'Action'.$user['USER'].'\').submit()" class="mdl-menu__item">
                            <input type="hidden" name="pseudo" value="'.$user['USER'].'" />Rétrograder
                        </li>
                    </form>
                    ';
                    $delete = '
                    <form id="Suppr'.$user['USER'].'" method="POST" action="Delete.php">
                        <li onclick="getElementById(\'Suppr'.$user['USER'].'\').submit()" class="mdl-menu__item">
                            <input type="hidden" name="pseudo" value="'.$user['USER'].'" />Desactiver
                        </li>
                    </form>
                    ';
                }
                else{
                    $icon = 'person';
                    $promotion = '
                    <form id="Action'.$user['USER'].'" method="POST" action="ChangeRole.php">
                        <li onclick="getElementById(\'Action'.$user['USER'].'\').submit()" class="mdl-menu__item">
                            <input type="hidden" name="pseudo" value="'.$user['USER'].'" />Promouvoir
                        </li>
                    </form>
                    ';
                    $retrograde = '<li disabled class="mdl-menu__item">Rétrograder</li>';
                    $delete = '
                    <form id="Suppr'.$user['USER'].'" method="POST" action="Delete.php">
                        <li onclick="getElementById(\'Suppr'.$user['USER'].'\').submit()" class="mdl-menu__item">
                            <input type="hidden" name="pseudo" value="'.$user['USER'].'" />Desactiver
                        </li>
                    </form>
                    ';
                }
                if(isset($user['DATEFERME'])){
                    $isDisabled = 'yesIsDisabled';
                    $isDisabledBackground = 'yesIsDisabledBackground';
                    $promotion = '';
                    $retrograde = '';
                    $delete = '
                    <form id="Suppr'.$user['USER'].'" method="POST" action="Delete.php">
                        <li onclick="getElementById(\'Suppr'.$user['USER'].'\').submit()" class="mdl-menu__item">
                            <input type="hidden" name="pseudo" value="'.$user['USER'].'" />Réactiver
                        </li>
                    </form>
                    ';
                }
                echo ('
                <div #Utilisateurs class="mdl-list__item mdl-list__item--two-line '.$isDisabled.' '.$user['TYPEPROFIL'].'">
                    <span class="mdl-list__item-primary-content">
                        <i class="material-icons mdl-list__item-avatar '.$isDisabledBackground.'">person</i>
                        <span>'.$user['USER'].':</span>
                        <span class="mdl-list__item-sub-title">'.$user['ADRMAILCOMPTE'].'</span>
                    </span>
                        <span class="mdl-list__item-secondary-content">
                        <i class="material-icons">'.$icon.'</i>
                    </span>
                    <span>
                        <button id="Menu'.$key.'" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect"
                            for="Menu'.$key.'">
                        '.$promotion.'
                        '.$retrograde.'
                        '.$delete.'
                        </ul>
                    </span>
                </div>
                ');
            }
    }
    
  ?>
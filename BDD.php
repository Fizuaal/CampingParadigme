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

    function NewAnimation($bdd){
        if($_POST['nvType'] == true){
            $cdType = NewTypeAnimation($bdd);
            
        }
        else{
            $cdType = $_POST['typeAnim']; 
        }
        $req = $bdd->prepare('
        INSERT INTO `animation`(`CODEANIM`, `CODETYPEANIM`, `NOMANIM`, `DATECREATIONANIM`, `DATEVALIDITEANIM`, `DUREEANIM`, 
        `LIMITEAGE`, `TARIFANIM`, `NBREPLACEANIM`, `DESCRIPTANIM`, `COMMENTANIM`, `DIFFICULTEANIM`) 
        VALUES ("'.substr($_POST['nomAnim'], 0 , 5).substr($cdType, 0 , 3).'","'.$cdType.'", "'.$_POST['nomAnim'].'","'.date("Y-m-d").'", "'.$_POST['dtFinValidite'].'", '.$_POST['dureeAnim'].', '.$_POST['limAge'].', '.$_POST['tarifAnim'].',
        '.$_POST['nbrPlaces'].', "'.$_POST['descAnim'].'", "'.$_POST['commentaireAnim'].'", "'.$_POST['difficulteAnim'].'")');
        var_dump($req);
        $req->execute();
        $resultat = $req->fetchAll();
    }

    function NewTypeAnimation($bdd){
        $nvTypeAnim = ucfirst(strtolower($_POST['newTypeAnim']));
        $nvCode = substr($nvTypeAnim, 0 , 4);
        $req = $bdd->prepare('INSERT INTO `type_anim`(`CODETYPEANIM`, `NOMTYPEANIM`) VALUES ("'.$nvCode.'","'.$nvTypeAnim.'")');
        var_dump($req);
        $req->execute();
        return $nvCode;
    }

    function listTypesAnim($bdd){
        $req = $bdd->prepare('SELECT * FROM `type_anim`');
        $req->execute();
        $resultat = $req->fetchAll();
        foreach($resultat as $key=>$type_anim)
        {   
            echo ('<option value="'.$type_anim['CODETYPEANIM'].'">'.$type_anim['NOMTYPEANIM'].'</option>');
        }
    }

    function ListAllAnimations($bdd){
        $req = $bdd->prepare('SELECT CODEANIM, NOMTYPEANIM, NOMANIM, DATEVALIDITEANIM, DUREEANIM, LIMITEAGE, TARIFANIM, NBREPLACEANIM, DESCRIPTANIM, DIFFICULTEANIM
        FROM animation A, type_anim TA
        where A.CODETYPEANIM = TA.CODETYPEANIM');
            $req->execute();
            $resultat = $req->fetchAll();

            foreach($resultat as $key=>$anim)
            {     
                $dtFinAnim = new DateTime(addslashes($resultat[$key]['DATEVALIDITEANIM']));
                $dtFinAnim = $dtFinAnim -> format("Y/m/d");
                if($dtFinAnim >= date("Y/m/d")){
                    echo ('
                    <li class="mdl-list__item mdl-list__item--three-line demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"
                    style="width: calc(80vw - 16px);height: 100px;">
                        <span class="mdl-list__item-primary-content">
                        <i style="margin-top: 15px;" class="material-icons mdl-list__item-icon">assignment</i>
                        <span>'.$anim['NOMTYPEANIM'].' - '.$anim['NOMANIM'].'</span>
                        <span class="mdl-list__item-text-body">
                            '.$anim['DESCRIPTANIM'].'
                        </span>
                        </span>
                        <span class="mdl-list__item-secondary-content">
                            <span class="mdl-list__item-secondary-info">'.$dtFinAnim.'</span>
                            <span class="mdl-list__item-secondary-info" style="font-size: 20px;margin-top: 5px;">'.$anim['TARIFANIM'].'€</span>
                            <span class="mdl-list__item-secondary-info" style="font-size: 20px;margin-top: 17px;">'.$anim['NBREPLACEANIM'].' Places</span>
                        </span>
                        <span class="mdl-list__item-secondary-content">
                        <form id="Action'.$anim['CODEANIM'].'" method="POST" action="CreationActivite.php">
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" 
                            onclick="getElementById(\'Action'.$anim['CODEANIM'].'\').submit()">
                            Créer une activité
                            </button>
                            <input type="hidden" name="codeAnim" value="'.$anim['CODEANIM'].'" />
                            <input type="hidden" name="ID" value="'.$_SESSION['ID'].'" />
                        </form>
                        <form id="Edit'.$anim['CODEANIM'].'" method="POST" action="ModificationAnimation.php" style="margin-top: 10px;">
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" 
                            onclick="getElementById(\'Action'.$anim['CODEANIM'].'\').submit()">
                            Editer l\'animation
                            </button>
                            <input type="hidden" name="codeAnim" value="'.$anim['CODEANIM'].'" />
                            <input type="hidden" name="ID" value="'.$_SESSION['ID'].'" />
                        </form>
                        </span>
                    </li>                
                ');
                }
            }
    }

    function returnAnim($bdd, $codeAnim){
        $req = $bdd->prepare('SELECT `NOMANIM` FROM `animation` WHERE `CODEANIM` = "'.$codeAnim.'"');
        $req->execute();
        $resultat = $req->fetchAll();
        echo($resultat[0][0]);
    }

    function CreationActivité($bdd, $codeAct, $date, $HRRDVACT,$Prix, $Hdebut, $Hfin, $preAnim, $nomAnim){

        $requete = $bdd->prepare("INSERT INTO `activite`(`CODEANIM`, `DATEACT`, `CODEETATACT`, `HRRDVACT`, `PRIXACT`, `HRDEBUTACT`, `HRFINACT`, `NOMRESP`, `PRENOMRESP`) 
        VALUES (\"".$codeAct."\",\"".$date."\",1,\"".$HRRDVACT."\",\"".$Prix."\",\"".$Hdebut."\", \"".$Hfin."\",\"".$preAnim."\", \"".$nomAnim."\")");
        var_dump($requete);
        $requete->execute();
    }

    function RecupAnimationEtAnimateur($bdd, $codeAnim, $user){
        $requete1 = $req1 = $bdd->prepare('SELECT NOMCOMPTE, PRENOMCOMPTE FROM compte WHERE user = "'.$user.'"');
        $req1->execute();
        $resultat1 = $req1->fetchAll();

        $requete = $req = $bdd->prepare('SELECT CODEANIM, TARIFANIM FROM animation A where A.CODEANIM =  "'.$codeAnim.'"');
        $req->execute();
        $resultat = $req->fetchAll();
        return  [$resultat[0]['CODEANIM'],$resultat[0]['TARIFANIM'], $resultat1[0]['NOMCOMPTE'], $resultat1[0]['PRENOMCOMPTE']];
    }

    function listAnimateurs($bdd){
        $req = $bdd->prepare('SELECT * FROM `compte` WHERE `TYPEPROFIL` = "Animateur"');
        $req->execute();
        $resultat = $req->fetchAll();
        foreach($resultat as $key=>$anim)
        {   
            echo ('<option value="'.$anim['USER'].'">'.$anim['PRENOMCOMPTE']." ".$anim['NOMCOMPTE'].'</option>');
        }
    }

    function InscriptionActivité($bdd, $user, $codeAnim, $dateAct, $dateeInsc) { 
        $req = $bdd->prepare('INSERT INTO inscription (USER, CODEANIM, DATEACT, DATEINSCRIP) 
        VALUES (\''.$user.'\',\''.$codeAnim.'\',\''.$dateAct.'\',\''.$dateeInsc.'\')');
        $req->execute();
    }

    function comptePlaces($bdd, $codeAnim, $dateAnim){
        $req = $bdd->prepare('SELECT Count(*)
        FROM inscription 
        WHERE CODEANIM = \''.$codeAnim.'\'
        AND DATEACT = \''.$dateAnim.'\'');
        $req->execute();
        $resultat = $req->fetchAll();
        return $resultat[0][0];
    }

    function ListAllActivités($bdd){
        $req = $bdd->prepare('SELECT AC.CODEANIM, T.NOMTYPEANIM, DATEACT, E.NOMETATACT, HRRDVACT, PRIXACT, HRDEBUTACT, HRFINACT, NOMRESP, PRENOMRESP, NBREPLACEANIM, AN.COMMENTANIM
        FROM  activite AC, animation AN, etat_act E, type_anim T
        WHERE AC.codeanim = AN.codeanim
        AND E.CODEETATACT = AC.CODEETATACT
        AND AN.CODETYPEANIM = T.CODETYPEANIM ');
        $req->execute();
        $resultat = $req->fetchAll();
        //var_dump($resultat);
        //var_dump($resultat[0]['DATEACT']);
        foreach($resultat as $key=>$anim)
        {
            if($anim['DATEACT'] >= date("Y-m-d")){
                echo ('
                <li class="mdl-list__item mdl-list__item--three-line demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"
                style="width: calc(80vw - 16px);height: 150px;">
                    <span class="mdl-list__item-primary-content">
                    <i style="margin-top: 15px;" class="material-icons mdl-list__item-icon">assignment</i>
                    <span>'.$anim['NOMTYPEANIM'].' - '.$anim['NOMETATACT'].'</span>
                    <span class="mdl-list__item-text-body">
                        '.$anim['COMMENTANIM'].'
                    </span>
                    </span>
                    <span class="mdl-list__item-secondary-content">
                        <span class="mdl-list__item-secondary-info">'.$anim['DATEACT'].'</span>
                        <span class="mdl-list__item-secondary-info" style="font-size: 20px;margin-top: 5px;">'.$anim['PRIXACT'].'€</span>');
                        if(($anim['NBREPLACEANIM'] - comptePlaces($bdd, $anim['CODEANIM'], $anim['DATEACT'])) == 0){
                            echo ('
                            <span class="mdl-list__item-secondary-info" style="font-size: 20px;margin-top: 17px;">Complet</span>
                            ');
                            if($anim['NOMETATACT'] != 'Complet'){
                                $req = $bdd->prepare('UPDATE Activite SET  CODEETATACT = 2
                                WHERE codeanim = \''.$anim['CODEANIM'].'\'
                                AND DATEACT =  \''.$anim['DATEACT'].'\'');
                                $req->execute();
                                var_dump($req);
                                
                            }
                        }
                        else{
                            echo ('
                            <span class="mdl-list__item-secondary-info" style="font-size: 20px;margin-top: 17px;">'.
                            ($anim['NBREPLACEANIM'] - comptePlaces($bdd, $anim['CODEANIM'], $anim['DATEACT'])).'/'.$anim['NBREPLACEANIM'].' Places restantes</span>
                            ');
                        }
                        echo ('
                    </span>
                    <span class="mdl-list__item-secondary-content">');
                    
                    if(isset($_SESSION['ID']))
                    {
                        $requete = $bdd->prepare('SELECT * 
                        FROM inscription 
                        WHERE USER = \''.$_SESSION['ID'].'\'
                        AND CODEANIM = \''.$anim['CODEANIM'].'\'
                        AND DATEACT = \''.$anim['DATEACT'].'\'');
                        $requete->execute();
                        $resultat2 = $requete->fetchAll();
                        if(!empty($resultat2))
                        {
                            echo('
                            <form id="Action'.$anim['CODEANIM'].'" method="POST" action="InscriptionAct.php">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" disabled>
                                Déjà inscrit
                                </button>
                            </form>
                        ');
                        }
                        else
                        {
                            echo('
                            <form id="Action'.$anim['CODEANIM'].'" method="POST" action="InscriptionAct.php">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" 
                                onclick="getElementById(\'Action'.$anim['CODEANIM'].'\').submit()">
                                S\'inscrire
                                </button>
                                <input type="hidden" name="codeAnim" value="'.$anim['CODEANIM'].'" />
                                <input type="hidden" name="ID" value="'.$_SESSION['ID'].'" />
                                <input type="hidden" name="dateAct" value="'.$anim['DATEACT'].'" />
                            </form>
                            ');
                        }
                        // echo('
                        // <form id="Edit'.$anim['CODEANIM'].'" method="POST" action="ModificationAnimation.php" style="margin-top: 10px;">
                        //     <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" 
                        //     onclick="getElementById(\'Action'.$anim['CODEANIM'].'\').submit()">
                        //     Editer l\'animation
                        //     </button>
                        //     <input type="hidden" name="codeAnim" value="'.$anim['CODEANIM'].'" />
                        //     <input type="hidden" name="dateAct" value="'.$anim['DATEACT'].'" />
                            
                        // </form>
                        // ');
                        echo('
                        <form id="Edit'.$anim['CODEANIM'].'" method="POST" action="AnnuleAnimation.php" style="margin-top: 10px;">
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" 
                            onclick="getElementById(\'Action'.$anim['CODEANIM'].'\').submit()">
                            Annuler l\'activité
                            </button>
                            <input type="hidden" name="codeAnim" value="'.$anim['CODEANIM'].'" />
                            <input type="hidden" name="dateAct" value="'.$anim['DATEACT'].'" />
                            
                        </form>
                        ');
                        $requeteInscrits = $bdd->prepare('SELECT * 
                        FROM inscription 
                        WHERE CODEANIM = \''.$anim['CODEANIM'].'\'
                        AND DATEACT = \''.$anim['DATEACT'].'\'');
                        $requeteInscrits->execute();
                        $resultatInscrits = $requeteInscrits->fetchAll();
                        if(!empty($resultatInscrits)){
                            $message = "Inscrits: ";
                            foreach($resultatInscrits as $key=>$user){
                                $message .= $user['USER'].", ";
                            }
                            echo('
                            <div style="margin-top: 10px;">
                                <button id="toast'.$anim['CODEANIM'].$key.'" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" 
                                type="button">Consulter les inscrits</button>
                            </div>
                            <div id="toastEx" class="mdl-js-snackbar mdl-snackbar">
                            <div class="mdl-snackbar__text"></div>
                            <button class="mdl-snackbar__action" type="button"></button>
                            </div>
                            <script>
                            (function() {
                            \'use strict\';
                            window[\'counter\'] = 0;
                            var snackbarContainer = document.querySelector(\'#toastEx\');
                            var showToastButton = document.querySelector(\'#toast'.$anim['CODEANIM'].$key.'\');
                            showToastButton.addEventListener(\'click\', function() {
                                \'use strict\';
                                var data = {message: "'.$message.'"};
                                snackbarContainer.MaterialSnackbar.showSnackbar(data);
                            });
                            }());
                            </script>
                            ');
                        }
                    }
                        echo ('
                    </span>
                </li>                
            ');
            }
        }
    }

    // function ModifAnimation($bdd, $nomAnim, $dtFin, $duree, $HDebut, $limAge, $tarifAnim, $nbrPlaces, $commentaireAnim, $difficulteAnim){

    //     $requete = $bdd->prepare("INSERT INTO `activite`(`CODEANIM`, `DATEACT`, `CODEETATACT`, `HRRDVACT`, `PRIXACT`, `HRDEBUTACT`, `HRFINACT`, `NOMRESP`, `PRENOMRESP`) 
    //     VALUES (\"".$codeAct."\",\"".$date."\",1,\"".$HRRDVACT."\",\"".$Prix."\",\"".$Hdebut."\", \"".$Hfin."\",\"".$preAnim."\", \"".$nomAnim."\")");
    //     var_dump($requete);
    //     $requete->execute();
    // }

    function DeleteAnim($bdd, $codeAnim, $dateAct)
    {
        $requete = $bdd->prepare('DELETE FROM `activite` WHERE `CODEANIM` = "'.$codeAnim.'" AND `DATEACT`= "'.$dateAct.'"');
        $requete->execute();
    }
  ?>
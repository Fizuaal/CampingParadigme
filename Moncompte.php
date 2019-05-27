<?php require 'Header.php' ?>

<?php

if (empty($_SESSION['ID']))
{
    exit('Vous n\'êtes pas connecté');
}
else
{
$pseudo = ($_SESSION['ID']);    

?>


<div style="position: absolute;top: 15px;right: 15px;height:200px;width:200px;">
    <?php
    if(!empty($_SESSION['Photo']))
    {
        echo'<img src="'.$_SESSION['Photo'].'" style="border: solid 1px black;width: 100%;" title="No_Photo" />';
    }
    else
    {
        echo'<img src="UsersIMG/_Vide.jpg" style="border: solid 1px black;width: 100%;" title="No_Photo" />';
    }
    ?>

    <div style="padding-top: 5px;">
        <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored decale" for="fichier_a_uploader">Changer de photo de profil</label>
            <input style="display:none;" name="fichier" type="file" id="fichier_a_uploader" onchange="document.getElementById('submit').click();" />
            <input style="display:none;" id="submit" type="submit" name="submit" value="Uploader" />
        </form>
    </div>
</div>


<?php

  // Constantes
  define('TARGET', 'UsersIMG/');    // Repertoire cible
  define('MAX_SIZE', 1000000);    // Taille max en octets du fichier
  define('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
  define('HEIGHT_MAX', 800);    // Hauteur max de l'image en pixels
  
  // Tableaux de donnees
  $tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
  $infosImg = array();
  
  // Variables
  $extension = '';
  $message = '';
  $nomImage = '';
  
  /************************************************************
   * Creation du repertoire cible si inexistant
   *************************************************************/
  if( !is_dir(TARGET) ) {
    if( !mkdir(TARGET, 0755) ) {
      exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
    }
  }
  
  /************************************************************
   * Script d'upload
   *************************************************************/
  if(!empty($_POST))
  {
    // On verifie si le champ est rempli
    if( !empty($_FILES['fichier']['name']) )
    {
      // Recuperation de l'extension du fichier
      $extension  = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
  
      // On verifie l'extension du fichier
      if(in_array(strtolower($extension),$tabExt))
      {
        // On recupere les dimensions du fichier
        $infosImg = getimagesize($_FILES['fichier']['tmp_name']);
  
        // On verifie le type de l'image
        if($infosImg[2] >= 1 && $infosImg[2] <= 14)
        {
          // On verifie les dimensions et taille de l'image
          if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE))
          {
            // Parcours du tableau d'erreurs
            if(isset($_FILES['fichier']['error']) 
              && UPLOAD_ERR_OK === $_FILES['fichier']['error'])
            {
              // On renomme le fichier
              $nomImage = md5(uniqid()) .'.'. $extension;
  
              // Si c'est OK, on teste l'upload
              if(move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET.$nomImage))
              {
                $message = 'Upload réussi !';
                
                if(!empty($_SESSION['Photo']))
                {
                    unlink ($_SESSION['Photo']);
                }
                $photo = TARGET.$nomImage;
                $req = $bdd->prepare("UPDATE COMPTE
                    SET PHOTO_DIR='$photo'
                    WHERE USER = :USER");
                $req->execute(array(
                    'USER' => $_SESSION['ID']));

                    $_SESSION['Photo'] = $photo;
                    echo "<script type='text/javascript'>document.location.replace('Moncompte.php');</script>";

              }
              else
              {
                // Sinon on affiche une erreur systeme
                $message = 'Problème lors de l\'upload !';
              }
            }
            else
            {
              $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
            }
          }
          else
          {
            // Sinon erreur sur les dimensions et taille de l'image
            $message = 'Erreur dans les dimensions de l\'image !';
          }
        }
        else
        {
          // Sinon erreur sur le type de l'image
          $message = 'Le fichier à uploader n\'est pas une image !';
        }
      }
      else
      {
        // Sinon on affiche une erreur pour l'extension
        $message = 'L\'extension du fichier est incorrecte !';
      }
    }
    else
    {
      // Sinon on affiche une erreur pour le champ vide
      $message = '';
    }
  }
  if(!empty($message) ) 
    {
    echo '<p>',"\n";
    echo "\t\t<strong>", htmlspecialchars($message) ,"</strong>\n";
    echo "\t</p>\n\n";
    }
if(!empty($_POST['ville']))
{
// récupération des valeurs en provenance du formulaire (avec traitement
// des apostrophes) puis affectation à des variables
    $nom = addslashes($_POST['nom']);
    $prenom = addslashes($_POST['prenom']);
    $pseudo = addslashes($_POST['pseudo']);
    $adresse = addslashes($_POST['adresse']);
    $cdpost = addslashes($_POST['cdpost']);
    $ville = addslashes($_POST['ville']);
    $pays = addslashes($_POST['pays']);
    $dtnais= addslashes($_POST['dtnais']);
    
// requête d'enregistrement du client
$req = $bdd->prepare("UPDATE UTILISATEURS
    SET PSEUDO = '$pseudo', NOM = '$nom', PRENOM = '$prenom', ADRESSE = '$adresse', DT_NAIS = '$dtnais', PAYS = '$pays', VILLE = '$ville', CD_POSTAL = '$cdpost' 
    WHERE USER_ID = :USER_ID");
$req->execute(array(
    'USER_ID' => $_SESSION['ID']));
    echo "<script type='text/javascript'>document.location.replace('Moncompte.php');</script>";
}
?>

<?php } ?>

<?php require 'Footer.php' ?>
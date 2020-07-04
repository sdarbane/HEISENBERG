<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>


<?php for_not_logged(); ?>



<?php


$nomErr = $prenomErr = $emailErr = $ddnErr = $mdpErr = $mdpcErr = $pseudoErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $pseudo = $_POST['pseudo'];
  $email = $_POST['email'];
  $ddn = $_POST['ddn'];
  $mdp = $_POST['mdp'];
  $mdpc = $_POST['mdpc'];

  $errors = 0;


  if (empty($_POST["nom"])) {
    $nomErr = "Champ obligatoire";
    $errors++;
  }
  if (empty($_POST["prenom"])) {
    $prenomErr = "Champ obligatoire";
    $errors++;
  }
  if (empty($_POST["pseudo"])) {
    $pseudoErr = "Champ obligatoire";
    $errors++;
  }else if(pseudo_dans_bdd($pseudo)) {
          $pseudoErr = "Désolé, ce pseudo est déjà utilisé, veuillez en choisir un autre.";
          $errors++;
  }
  if (empty($_POST["email"])) {
    $emailErr = "Champ obligatoire";
    $errors++;
  }else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $emailErr = "La forme de l'email est invalide"; 
    $errors +=1;
  }else if(email_dans_bdd($email)) {
    $emailErr = "Désolé, cet e-mail est déjà associé à un autre compte. ";
    $errors++;
  }
  
  if (empty($_POST["ddn"])) {
    $ddnErr = "Champ obligatoire";
    $errors++;
  }
  if (empty($_POST["mdp"])) {
    $mdpErr = "Champ obligatoire";
    $errors++;
  }
  if (empty($_POST["mdpc"])) {
    $mdpcErr = "Champ obligatoire";
    $errors++;
  }else if($_POST["mdp"] != $_POST["mdpc"]) {
          $mdpcErr = "Attention, les mots de passe ne sont pas identiques";
          $errors++;
  }
  $bdd = bdd_connexion();


 $requete = mysqli_query($bdd, "SELECT id_m FROM membres ORDER BY id_m DESC");
 while ($donnees = mysqli_fetch_assoc($requete))
 {
            $id=$donnees['id_m'];
            break;
    
 }
 mysqli_close($bdd);
 $id++;
// Constantes
define('TARGET', 'images/avatars/');    // Repertoire cible
define('MAX_SIZE', 10000000000);    // Taille max en octets du fichier
define('WIDTH_MAX', 8000);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 8000);    // Hauteur max de l'image en pixels
 
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
    $_SESSION['flash']['danger'] = "Erreur dans l'avatar:dossier" ;
    exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
  }
}
 
/************************************************************
 * Script d'upload
 *************************************************************/

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
            $nomImage = $id.".".$extension;
 
            // Si c'est OK, on teste l'upload
            if(move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET.$nomImage))
            {
              $avatar = TARGET.$nomImage;
            }
            else
            {
              // Sinon on affiche une erreur systeme
              $_SESSION['flash']['danger'] = "Erreur dans l'avatar.1" ;
            }
          }
          else
          {
            $_SESSION['flash']['danger'] = "Erreur dans l'avatar.2" ;
          }
        }
        else
        {
          // Sinon erreur sur les dimensions et taille de l'image
          $_SESSION['flash']['danger'] = "Erreur dans l'avatar:taille" ;
        }
      }
      else
      {
        // Sinon erreur sur le type de l'image
        $_SESSION['flash']['danger'] = "Erreur dans l'avatar:type" ;
      }
    }
    else
    {
      // Sinon on affiche une erreur pour l'extension
      $_SESSION['flash']['danger'] = "Erreur dans l'avatar:extension" ;
    }
  }else
  {
    $avatar = "images/avatars/anonyme.png";
  }


  if (!$errors) {

   
   ajouter_membre($nom,$prenom,$avatar,$pseudo,$ddn,$mdp,$email);
   

   $_SESSION['flash']['success'] = "Vous etes maintenant connecté." ;
   $_SESSION['user'] =  get_user_by_pseudo($pseudo);
   header('Location: dashboard.php');

    

}





}
?>

<div class="content">  


<form enctype="multipart/form-data" class="form-horizontal" autocomplete="on" method="POST" action="">

  <fieldset>

    <div class="form-group ">
      <label for="textArea">Nom</label>
      <input type="text" class="form-control <?php if($nomErr){echo "is-invalid";} ?>" name="nom" placeholder="Entrer votre nom">
      <?php if($nomErr): ?>
      <div class="invalid-feedback"><?php echo $nomErr ; ?></div>
      <?php endif; ?>     
    </div>

    <div class="form-group">
      <label for="textArea">Prénom</label>
      <input type="text" class="form-control <?php if($prenomErr){echo "is-invalid";} ?>" name="prenom" placeholder="Entrer votre prenom">
      <?php if($prenomErr): ?>
      <div class="invalid-feedback"><?php echo $prenomErr ; ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="textArea">Pseudo</label>
      <input type="text" class="form-control  <?php if($pseudoErr){echo "is-invalid";} ?> " name="pseudo" placeholder="Entrer votre pseudo">
      <?php if($pseudoErr): ?>
      <div class="invalid-feedback"><?php echo $pseudoErr ; ?></div>
      <?php endif; ?>

    </div>

    <div class="form-group">
      <label for="textArea">Choisissez votre avatar : (pas obligatoire) </label>
      <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
      <input name="fichier" type="file" id="fichier_a_uploader" />
    </div>

    <div class="form-group">
      <label for="textArea">Email</label>
      <input type="email" class="form-control <?php if($emailErr){echo "is-invalid";} ?>  " name="email" placeholder="Entrer votre email">
      <?php if($emailErr): ?>
      <div class="invalid-feedback"><?php echo $emailErr ; ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="textArea">Date de naissance</label><div class="valid-feedback">mois/jour/année</div>
      <input class="form-control <?php if($dnnErr){echo "is-invalid";} ?> " type="date" value="<?php echo date('Y-m-d'); ?>" id="example-date-input" name="ddn">
      <div class="valid-feedback">mois/jour/année</div>
      <?php if($ddnErr): ?>
      <div class="invalid-feedback"><?php echo $ddnErr ; ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="textArea">Mot de passe</label>
      <input type="password" class="form-control <?php if($mdpErr){echo "is-invalid";} ?>" name="mdp" placeholder="Entrer un mot de passe">
      <?php if($mdpErr): ?>
      <div class="invalid-feedback"><?php echo $mdpErr ; ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="textArea">Confirmer le mot de passe</label>
      <input type="password" class="form-control <?php if($mdpcErr){echo "is-invalid";} ?>" name="mdpc" placeholder="Repeter votre mot de passe">
      <?php if($mdpcErr): ?>
      <div class="invalid-feedback"><?php echo $mdpcErr ; ?></div>
      <?php endif; ?>
    </div>



   


    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-dark">Effacer</button>
        <button type="submit" class="btn btn-primary">M'inscrire</button>
      </div>
    </div>


  </fieldset>

</form>

</div>

<?php include("includes/footer.php"); ?>
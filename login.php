<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>


<?php for_not_logged(); ?>


<div class="content">

<?php


 $mdpErr = $emailErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


   $errors = 0;

  if (empty($_POST["email"])) {
    $emailErr = "Champ obligatoire";
    $errors++;
  }else if(!email_dans_bdd($_POST["email"])) {
          $emailErr = "Désolé, l'email est incorrect";
          $errors++;
  }else{
    $email = $_POST['email'];
    }

if (empty($_POST["mdp"])) {
    $mdpErr = "Champ obligatoire";
    $errors++;
} else {
    $mdp = $_POST['mdp'];
}

if ($errors == 0) {

    $mdp_t = mdp_m_avec_email($email);

    if ($mdp == $mdp_t) {

        $_SESSION['user'] =  get_user_by_email($email);
        $_SESSION['time']= time();

        $_SESSION['flash']['success'] = "Vous etes maintenant connecté." ;
        header('Location: dashboard.php');
    }else{
      $_SESSION['flash']['warning'] = "Mot de passe incorrect." ;
        header('Location: login.php');
    }
}
}
?>
<form class="form-horizontal" autocomplete="on" method="POST" action="">

  <fieldset>


    <div class="form-group">
      <label for="textArea">Email</label>
      <input type="email" class="form-control <?php if($emailErr){echo "is-invalid";} ?>" name="email" placeholder="Entrer votre email" required>
      <?php if($emailErr): ?>
      <div class="invalid-feedback"><?php echo $emailErr ; ?></div>
      <?php endif; ?>
    </div>





    <div class="form-group">
      <label for="textArea">Mot de passe</label>
      <input type="password" class="form-control <?php if($mdpErr){echo "is-invalid";} ?>" name="mdp" placeholder="Entrer un mot de passe" required>
      <?php if($mdpErr): ?>
      <div class="invalid-feedback"><?php echo $mdpErr ; ?></div>
      <?php endif; ?>
    </div>


    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-dark">Effacer</button>
        <button type="submit" class="btn btn-primary">M'authentifier</button>
      </div>
    </div>


    </fieldset>
  </form>
  </div>


<?php include("includes/footer.php"); ?>

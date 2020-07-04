
<?php session_start() ; ?>
<?php
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    $_SESSION['flash']['success'] = "Vous etes maintenant déconnecté." ;
    if (isset($a))
    {
      $_SESSION['flash']['warning'] = "Temps de connexion écoulé. Veuillez vous reconnecter" ;
    }

    header('Location: login.php');
}else{
    header('Location: login.php');
}


?>

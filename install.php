<?php?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>DEBSTER</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">

    <!-- favicon -->
    <link rel="icon" href="images/favicon.ico" />  

    <!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-green.min.css" />
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="styles/styles.css">

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    

  </head>


  <body>

  <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">

<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">

<div class="mdl-layout__header-row" 
style=" color: white;
background-color: #263238;"
>


</header>


<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
<div class="logo">
  <h1><a href="index.php" >DEBSTER</a></h1>
  <h6>Your favorite app</h6>
</div>

<?php if (isset($_SESSION['user'])) : ?>   
<header class="demo-drawer-header">

<img src=<?php echo image_m_avec_id_m($id); ?> class="demo-avatar">
<div class="demo-avatar-dropdown">
  <span><?php echo fullname_id($id) ; ?></span>
   </div>
</header>
<?php endif; ?>
<nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
<?php if (isset($_SESSION['user'])) : ?> 

<a class="mdl-navigation__link" href="dashboard.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">dashboard</i>Tableau de bord</a>
<a class="mdl-navigation__link" href="profil.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">face</i>Mon profil</a>
<a class="mdl-navigation__link" href="dettes.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">attach_money</i>Dettes et créances</a>
<a class="mdl-navigation__link" href="friend.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">sentiment_satisfied_alt</i>Mes amis</a>
<a class="mdl-navigation__link" href="groupes.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">sentiment_satisfied_alt</i>Mes groupes</a>

<a class="mdl-navigation__link" href="logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">not_interested</i>Se déconnecter</a>
<a class="mdl-navigation__link" href="contact.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">attach_money</i>Contact</a>

<?php else: ?>
<a class="mdl-navigation__link" href="index.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">dashboard</i>Accueil</a>
<a class="mdl-navigation__link" href="login.php"><i class="material-icons">
arrow_upward
</i>Se connecter</a>
<a class="mdl-navigation__link" href="register.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">face</i>S'inscrire</a>
<a class="mdl-navigation__link" href="contact.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">attach_money</i>Contact</a>
<?php endif; ?>
</nav>
</div>

<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-grid demo-content">
<div class="container">


<?php 

  if(isset($_SESSION['flash'])){
    foreach($_SESSION['flash'] as $type => $message){
       echo"<div class='alert alert-dismissible alert-$type'> <button type='button' class='close' data-dismiss='alert'>&times;</button>$message </div>";
      
    }
    unset($_SESSION['flash']);
  }

?>


<h1>INSTALLATION DE L'APPLICATION :</h1>





<?php include("includes/config.php"); ?>
<?php

$qDb = "CREATE DATABASE IF NOT EXISTS `heisenberg`";

$qSelDb = "USE heisenberg";

$qTbgroupes = "CREATE TABLE IF NOT EXISTS `groupes` (
  `id_g` int(255) AUTO_INCREMENT NOT NULL  ,
  `nom_g` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `membres_g` text COLLATE latin1_general_ci NOT NULL,
  `description_g` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_g`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$qTbtransactions = "CREATE TABLE IF NOT EXISTS `transactions` (
  `id_t` int(255) AUTO_INCREMENT NOT NULL,
  `date_t` date NOT NULL,
  `id_src` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `montant_t` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `id_groupe` int(255) DEFAULT NULL,
  `id_dest` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `statut_t` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `description_t` text COLLATE latin1_general_ci NOT NULL,
  `datef_t` date DEFAULT NULL,
  `motif_t` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_t`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 ";

$qTbmembres = "CREATE TABLE IF NOT EXISTS `membres` (
  `id_m` int(255) AUTO_INCREMENT NOT NULL,
  `image_m` text COLLATE latin1_general_ci NOT NULL,
  `nom_m` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `prenom_m` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pseudo_m` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `ddn_m` date DEFAULT NULL,
  `mdp_m` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email_m` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `amis_m` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY(`id_m`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 ";
$qInitTbgroupes1= "INSERT INTO `groupes` ( `nom_g`, `membres_g`, `description_g`) VALUES ('heisenberg', '|1|8|3|4|', 'voyage')";
$qInitTbgroupes2= "INSERT INTO `groupes` (`nom_g`, `membres_g`, `description_g`) VALUES ( 'lannister', '|4|8|5|', 'paiement de dettes')";
$qInitTbgroupes3= "INSERT INTO `groupes` (`nom_g`, `membres_g`, `description_g`) VALUES ('winterfell', '|4|2|', 'nourriture')";
$qInitTbgroupes4= "INSERT INTO `groupes` ( `nom_g`, `membres_g`, `description_g`) VALUES ('Drakarys', '|5|6|7|', 'Achat de dragons')";
$qInitTbgroupes5= "INSERT INTO `groupes` ( `nom_g`, `membres_g`, `description_g`) VALUES ('Donuts party', '|7|8|', 'Achat de donuts')";
$qInitTbgroupes6= "INSERT INTO `groupes` ( `nom_g`, `membres_g`, `description_g`) VALUES ('enseirb matmeca', '|7|8|2|1|', 'Achat de serveur')";
$qInitTbtransactions1="INSERT INTO `transactions` ( `date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t`, `motif_t`) VALUES ( '2019-04-01', '1', '200', NULL, '2', 'ouvert', 'los pollos hermanos', '2019-04-01', 'NULL' )";
$qInitTbtransactions2="INSERT INTO `transactions` (`date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t`, `motif_t`) VALUES ( '2015-04-01', '2', '200', NULL, '1', 'rembourse', 'monstre', '2019-04-01', 'NULL' )";
$qInitTbtransactions11="INSERT INTO `transactions` (`date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t`, `motif_t`) VALUES ( '2015-04-01', '8', '200', NULL, '2', 'rembourse', 'monstre', '2019-04-01', 'NULL' )";
$qInitTbtransactions3="INSERT INTO `transactions` ( `date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t`, `motif_t`) VALUES ( '2019-04-01', '5', '200', NULL, '4', 'ouvert', 'Armement', '2019-04-01', 'NULL' )";
$qInitTbtransactions4="INSERT INTO `transactions` ( `date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t`) VALUES ( '2019-04-01', '6', '20', '4', '|7|5|', 'annule', 'achat donuts( Mmm donuts) au chocolat', '2019-04-01' )";
$qInitTbtransactions5="INSERT INTO `transactions` ( `date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t` ) VALUES ( '2019-04-01', '7', '12', '5', '|8|', 'ouvert', 'achat de café ', '2019-04-01')";
$qInitTbtransactions6="INSERT INTO `transactions` ( `date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t` ) VALUES ( '2019-04-01', '8', '300', '5', '|7|', 'ouvert', 'achat de lait ', '2019-04-01')";
$qInitTbtransactions7="INSERT INTO `transactions` ( `date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t`, `motif_t`) VALUES ( '2019-04-01', '|2|', '200', NULL, '|8|', 'ouvert', 'los pollos hermanos', '2019-04-01', 'NULL' )";
$qInitTbtransactions8="INSERT INTO `transactions` ( `date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t`, `motif_t`) VALUES ( '2019-04-01', '8', '200', NULL, '3', 'rembourse', 'monstre', '2019-04-01', 'NULL' )";
$qInitTbtransactions10="INSERT INTO `transactions` ( `date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t`, `motif_t`) VALUES ( '2019-04-01', '|8|', '53', NULL, '|2|', 'ouvert', 'voyages a talence', '2019-04-01', 'NULL' )";
$qInitTbmembres1= "INSERT INTO `membres` ( `image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/1.png', 'walter', 'walt', 'heisenberg', '666-06-6', 'azerty', 'walter.walt@enseirb.fr', '|2|3|4|6')";
$qInitTbmembres2= "INSERT INTO `membres` (`image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/2.png', 'jesse', 'pinkman', 'jesse', '666-06-7', 'azerty1', 'pinkman@enseirb.fr', '|1|7|8|')";
$qInitTbmembres3= "INSERT INTO `membres` (`image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/1.png', 'John', 'Snow', 'Egon', '666-06-7', 'azerty12', 'snow@enseirb.fr', '|4|1|8|')";
$qInitTbmembres4= "INSERT INTO `membres` ( `image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/3.png', 'Arya', 'Arya', 'Stark', '666-06-7', 'azerty1', 'arya@enseirb.fr', '|1|3|8|')";
$qInitTbmembres5= "INSERT INTO `membres` ( `image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/3.png', 'Daenyris', 'Targaryen', 'Khalissee', '666-06-7', 'azerty1', 'got@enseirb.fr', '|3|7|')";
$qInitTbmembres6= "INSERT INTO `membres` ( `image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/3.png', 'Homer', 'Simpson', 'Le chauve', '666-06-7', 'azerty1', 'homer@enseirb.fr', '|1|5|7|8|')";
$qInitTbmembres7= "INSERT INTO `membres` ( `image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/3.png', 'Chef', 'Wigom', 'Chef', '666-06-7', 'azerty1', 'ralf@enseirb.fr', '|6|2|')";
$qInitTbmembres8= "INSERT INTO `membres` ( `image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/1.png', 'jane', 'Doe', 'Any', '666-06-6', 'mdp', 'tester@gmail.com', '|2|3|4|6|')";
echo "Connexion au serveur MySQL.";
$con = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD);

echo "Création de la bdd ";
echo "<br>";
mysqli_query($con, $qDb);
echo mysqli_info($con);
echo mysqli_error($con);

echo "Utilisation de la bdd";
echo "<br>";
mysqli_query($con, $qSelDb);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";


echo "Création de la table groupes";
echo "<br>";
mysqli_query($con, $qTbgroupes);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du groupe ...";
echo "<br>";
mysqli_query($con, $qInitTbgroupes1);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du groupe ...";
echo "<br>";
mysqli_query($con, $qInitTbgroupes2);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du groupe ...";
echo "<br>";
mysqli_query($con, $qInitTbgroupes3);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du groupe ...";
echo "<br>";
mysqli_query($con, $qInitTbgroupes4);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du groupe ...";
echo "<br>";
mysqli_query($con, $qInitTbgroupes5);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du groupe ...";
echo "<br>";
mysqli_query($con, $qInitTbgroupes6);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la table membres.";
echo "<br>";
mysqli_query($con, $qTbmembres);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ...";
echo "<br>";
mysqli_query($con, $qInitTbmembres1);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ..";
echo "<br>";
mysqli_query($con, $qInitTbmembres2);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ..";
echo "<br>";
mysqli_query($con, $qInitTbmembres3);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ..";
echo "<br>";
mysqli_query($con, $qInitTbmembres4);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ...";
echo "<br>";
mysqli_query($con, $qInitTbmembres5);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ...";
echo "<br>";
mysqli_query($con, $qInitTbmembres6);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ...";
echo "<br>";
mysqli_query($con, $qInitTbmembres7);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ...";
echo "<br>";
mysqli_query($con, $qInitTbmembres8);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la table transaction.";
echo "<br>";
mysqli_query($con, $qTbtransactions);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la transaction.";
echo "<br>";
mysqli_query($con, $qInitTbtransactions1);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la transaction..";
echo "<br>";
mysqli_query($con, $qInitTbtransactions2);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la transaction..";
echo "<br>";
mysqli_query($con, $qInitTbtransactions3);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la transaction..";
echo "<br>";
mysqli_query($con, $qInitTbtransactions4);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la transaction..";
echo "<br>";
mysqli_query($con, $qInitTbtransactions5);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la transaction..";
echo "<br>";
mysqli_query($con, $qInitTbtransactions6);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la transaction..";
echo "<br>";
mysqli_query($con, $qInitTbtransactions7);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la transaction..";
echo "<br>";
mysqli_query($con, $qInitTbtransactions8);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";


echo "Création de la transaction..";
echo "<br>";
mysqli_query($con, $qInitTbtransactions10);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la transaction..";
echo "<br>";
mysqli_query($con, $qInitTbtransactions11);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";



mysqli_close($con);
?>



<a href="index.php"> COMMENCER</a>
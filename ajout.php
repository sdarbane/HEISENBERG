<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>

<?php 

if (isset($_GET['action'])) {
  $action = $_GET['action'];

  if (isset($_GET['id_g'])) {
    $action = "depense";
    $id_g = $_GET['id_g'];
  }

  switch ($action) {
    case 'groupes':
      include('ajout/ajout_group.php');
      break;
    case 'friend':
      include('ajout/ajout_ami.php');
      break;
    case 'depense':
      include('ajout/ajout_depense_groupe.php');
      break;
    default:
     include('ajout/ajout_depense.php');
      break;
  }

} else{
  header('Location:index.php');
}
?>


<?php include("includes/footer.php"); ?>
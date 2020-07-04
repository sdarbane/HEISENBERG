<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>

<?php

$id_t = $_GET['id_t'];

if ($_SERVER["REQUEST_METHOD"] == "POST"){

if ( !empty($_POST['description']) && !empty($_POST['montant']) && !empty($_POST['debiteur']) ) {
  $description = $_POST['description'];
  $montant = $_POST['montant'];
 
    modif_montant($id_t, $montant);
    modif_motif($id_t, $description);

    if (pseudo_exists($_POST['debiteur'])) {
      modif_destinataire($id_t, id_m_avec_pseudo_m($_POST['debiteur']));
      $_SESSION['flash']['success'] = "La transaction a bien été modifiée";
      header('Location:dettes.php');
    }else {
      $_SESSION['flash']['warning'] = "Utilisateur introuvable";
      header('Location:modif_t.php?id_t='.$id_t);
    }
    
  

}else{
  $_SESSION['flash']['warning'] = "Veuillez remplire tout les champs.";
  header('Location:modif_t.php?id_t='.$id_t);
}

}


if (isset($id_t)){

?>

<form method="POST" action="">
  <fieldset>
    <legend>Modifier une dépense entre amis:</legend>

    	<?php
        $requete = mysqli_query($mysqli, "SELECT * FROM transactions WHERE id_t = $id_t");
        while ($donnees = mysqli_fetch_assoc($requete))
        {
        ?>
              <div class="form-group" action="modif.php?id_t=$id_t">
    			<label for="description">Description</label>
        		<input type="text" class="form-control" name="description" value="<?php echo $donnees['description_t'];?>">
            <br>
        		<label for="description">Montant</label>
        		<input type="number" class="form-control" name="montant" value="<?php echo $donnees['montant_t'];?>">
            <br>

      			<label for="description">Débiteur</label>
        		<input type="text" class="form-control" name="debiteur" placeholder ="Entrer le pseudo du debiteur" value="<?php echo pseudo_m_avec_id_m($donnees['id_dest']);?>">

             </div>
              <p>
                <button type="submit" class="btn btn-primary">Modifier</button>
            <?php
    	} ?>

  </fieldset>
</form>

<?php }
include("includes/footer.php"); ?>
<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST"){

  if ( isset($_POST['nom']) || isset($_POST['prenom']) || isset($_POST['pseudo']) || isset($_POST['ddn']) || isset($_POST['email'])) {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $ddn = $_POST['ddn'];
  $pseudo = $_POST['pseudo'];
  $email = $_POST['email'];
  
  modif_nom($id, $nom); 
  modif_prenom($id, $prenom);
  modif_ddn($id, $ddn);
  if (pseudo_dans_bdd($pseudo) == false){
     modif_pseudo($id, $pseudo);
  }
  modif_email($id, $email);
  
  $_SESSION['flash']['success'] = "Le profil a bien été modifiée";
  header('Location:profil.php');
  }
}
?>

<form method="POST" action="">
  <fieldset>
    <legend>Modifier mon profil</legend>

    	<?php
        $requete = mysqli_query($mysqli, "SELECT * FROM membres");
        while ($donnees = mysqli_fetch_assoc($requete))
        {
        	if($donnees['id_m'] == $id ){
        ?>
              <div class="form-group" action="modif_p.php?id=$id">
    			 <label for="nom">Nom</label>
        		<input type="text" class="form-control" name="nom" value="<?php echo $donnees['nom_m'];?>">
        		<label for="prenom">Prenom</label>
        		<input type="text" class="form-control" name="prenom" value="<?php echo $donnees['prenom_m'];?>">
        		<label for="prenom">Pseudo</label>
        		<input type="text" class="form-control" name="pseudo" value="<?php echo $donnees['pseudo_m'];?>">
        		<label for="prenom">Date de naissance</label>
        		<input type="date" class="form-control" name="ddn" value="<?php echo $donnees['ddn_m'];?>">
        		<label for="email">Adresse e-mail</label>
        		<input type="text" class="form-control" name="email" value="<?php echo $donnees['email_m'];?>">
              </div>
              <p>
                <button type="submit" class="btn btn-primary">Modifier</button>
            <?php
        	}
    	} ?>

  </fieldset>
</form>


  
  


<?php 
include("includes/footer.php"); ?>
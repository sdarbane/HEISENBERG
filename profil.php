
<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php 
for_logged(); 
?>

<div class="jumbotron">
  <h1 class="display-4">Mon profil</h1>
</div>

<div class="card-deck">
	<div class="card">
	<li class="list-group-item"><center>Avatar : 
    	<?php 
    	echo "<img class='demo-avatar' src='".image_m_avec_id_m($id)."'>";
    	?>
	</center></li>
	<li class="list-group-item"><center>Nom : 
    	<?php 
    	echo nom_m_avec_id_m($id)
    	?>
	</center></li>
	<li class="list-group-item"><center>Prénom :
        <?php 
        echo prenom_m_avec_id_m($id)
        ?>
    </center></li>
	<li class="list-group-item"><center>Pseudo :
    	<?php 
    	echo pseudo_m_avec_id_m($id)
    	?>
    </center></li>
	<li class="list-group-item"><center>Date de naissance :
		<?php 
		echo ddn_m_avec_id_m($id)
		?>
    </center></li>		
	<li class="list-group-item"><center>Adresse mail :
		<?php 
		echo mail_m_avec_id_m($id)
		?>
    </center></li>	
	</div>
</div>

<br>
<br>

<center>
<div class="btn-group" role="group" aria-label="Basic example">
  <?php  
  echo "<a href=\"modif_p.php\">";
  echo "<button type=\"button\" class=\"btn btn-primary\">Modifier le profil</button>";
  echo "</a>";
  ?>
</div>
</center>



<?php include("includes/footer.php"); ?>